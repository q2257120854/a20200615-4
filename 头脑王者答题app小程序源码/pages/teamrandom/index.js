// pages/daily/index.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    availableTimes: 0, // 挑战剩余次数
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
    this.getIntegral();
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady() {
    wx.hideShareMenu(); // 隐藏转发按钮
    Utils.showLoading();
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {
    this.getAnswerTimes();
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {},

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {},

  /**查询用户积分 */
  getIntegral() {
    let that = this;
    Utils.ajax(Config.service.integralUrl, {
      data: {
        interfaceName: 'get',
        param: {
          openid: App.globalData.openid
        }
      }
    }, res => {
      // 更新用户积分缓存
      App.globalData.integral = (res.returnData || {}).integral || 0;
    })
  },

  /**获取答题次数 */
  getAnswerTimes() {
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
        if (res.returnData && res.returnData['1007']) {
          that.setData({
            availableTimes: res.returnData['1007'] < 0 ? 0 : res.returnData['1007']
          })
        }
      }
      Utils.hideLoading();
    })
  },

  /**开始答题 */
  startGame() {
    if (this.data.availableTimes <= 0) {
      Utils.showModal('提示', '今日挑战次数已用完！')
    } else {
      wx.navigateTo({
        url: "../team/match"
      });
    }
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
  onShareAppMessage() {}
})