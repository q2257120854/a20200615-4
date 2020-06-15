// pages/userinfo/index.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');

import wxCharts from "../../static/js/wxcharts.js";
Page({

  /**
   * 页面的初始数据
   */
  data: {
    nickName: '', // 昵称
    avatarUrl: '', // 头像地址
    openid: '',
    userId: '', // 员工号
    department: '', //部门
    level: 1, // 段位
    levelName: '', // 段位名称
    levelImage: '', // 段位图片
    integral: 0, // 积分
    total: 0, // 总场次
    winTimes: 0, // 胜场
    winningRate: 0, // 胜率
    categories: [],
    seriesData: [],
    radarMaxValue: 0,
    shareTimes: 0, // 分享剩余次数
    shareClicked: false, // 是否点击了分享
    score1004: 0, // 每日答题
    score1005: 0, // 排位赛
    score1006: 0, // 好友对战
    score1007: 0, // 团队赛
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {},

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady() {
    wx.hideShareMenu(); // 隐藏转发按钮
    let that = this;
    that.setData({
      openid: App.globalData.openid,
      nickName: App.globalData.qyName,
      avatarUrl: App.globalData.avatarUrl
    })
    Utils.showLoading();
    that.getUserDetail(() => {
      Utils.hideLoading();
      let radarChart = new wxCharts({
        type: "radar",
        canvasId: "radarCanvas",
        categories: that.data.categories,
        series: [{
          data: that.data.seriesData,
          color: '#ffffff'
        }],
        width: Utils.WIN_WIDTH,
        height: 200,
        extra: {
          radar: {
            max: that.data.radarMaxValue + 0.3,
            labelColor: "#ffffff",
            gridColor: '#ffffff',
            lineSize: 2
          }
        }
      });
    })
    that.getShareTimes();
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {
    let that = this;
    if (that.data.shareClicked) {
      Utils.ajax(Config.service.shareUrl, {
        data: {
          interfaceName: 'share',
          param: {
            openid: App.globalData.openid
          }
        }
      }, res => {
        if (res.returnCode == 0) {
          that.getIntegral();
          that.getShareTimes();
          that.setData({
            shareClicked: false
          })
        }
      })
    }
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {},

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {},

  /**获取分享次数 */
  getShareTimes() {
    let that = this;
    Utils.ajax(Config.service.userUrl, {
      data: {
        interfaceName: 'daychallenge',
        param: {
          openid: App.globalData.openid
        }
      }
    }, res => {
      if (res.returnCode == 0) {
        if (res.returnData && res.returnData['share']) {
          that.setData({
            shareTimes: res.returnData['share'] < 0 ? 0 : res.returnData['share']
          })
        }
      }
    })
  },

  /**查询用户积分 */
  getIntegral() {
    let that = this;
    Utils.ajax(Config.service.integralUrl, {
      data: {
        interfaceName: 'get',
        param: {
          openid: wx.getStorageSync('openid')
        }
      }
    }, res => {
      that.setData({
        integral: (res.returnData || {}).integral || 0
      })
      // 更新用户积分缓存
      App.globalData.integral = that.data.integral;
    })
  },

  /**获取用户详情 */
  getUserDetail(callback) {
    let that = this;
    Utils.ajax(Config.service.userUrl, {
      data: {
        interfaceName: 'challengeinfo',
        param: {
          openid: App.globalData.openid
        }
      }
    }, res => {
      let level = 1;
      let categories = [];
      let seriesData = [];
      let radarMaxValue = 0;
      if (res.returnCode == 0) {
        res.returnData.good.forEach(item => {
          categories.push(item.description);
          seriesData.push(item.accuracy);
          if (item.accuracy > radarMaxValue) {
            radarMaxValue = item.accuracy;
          }
        })

        // 如果比赛信息为空，也需要显示
        if (categories.length == 0) {
          categories = App.globalData.chartCategories;
          seriesData = Array(categories.length).fill(0);
        }

        level = res.returnData.level;
        let currLevelInfo = App.globalData.gameLevelMap[level];
        // 积分明细
        let scoreDetail = res.returnData.score || {};

        that.setData({
          level: level,
          levelName: currLevelInfo.name,
          levelImage: currLevelInfo.image,
          total: res.returnData.total,
          winTimes: res.returnData.win,
          winningRate: res.returnData.total > 0 ? (res.returnData.win / res.returnData.total * 100).toFixed(2) : 0,
          integral: res.returnData.integral,
          userId: res.returnData.userid || '',
          department: res.returnData.department || '',
          radarMaxValue: radarMaxValue,
          categories: categories,
          seriesData: seriesData,
          score1004: scoreDetail['1004'] || 0,
          score1005: scoreDetail['1005'] || 0,
          score1006: scoreDetail['1006'] || 0,
          score1007: scoreDetail['1007'] || 0,
        })
      }

      typeof callback == 'function' && callback();
    })
  },

  shareLimit() {
    Utils.showToast('今日分享次数已用完！');
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh() {},

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom() {},

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage() {
    let that = this;
    that.setData({
      shareClicked: true
    })
    return {
      title: '看看你的能力在公司排第几？',
      path: '/pages/home/index',
      imageUrl: '/static/images/share-pk.png',
      success: res => {
        if (res.errMsg == 'shareAppMessage:ok') {
          if (that.data.shareTimes <= 0) {
            Utils.showToast('今日分享次数已用完，无法继续获得积分！');
          } else {
            Utils.ajax(Config.service.shareUrl, {
              data: {
                interfaceName: 'share',
                param: {
                  openid: App.globalData.openid
                }
              }
            }, res => {
              that.getIntegral();
              that.getShareTimes();
            })
          }
        }
      }
    };
  }
})