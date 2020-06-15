// pages/home/index.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
const moment = require('../../static/js/moment.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    showGrid: false, // 是否显示功能模块
    pageInitialized: false, // 页面已初始化
    options: {},
    showAuthDialog: false, // 是否显示登录授权对话框
    userId: '', // 员工号
    showQyBoundDialog: false, // 是否显示资料完善对话框
    nickName: 'Hi，请先登录~', //用户名字
    avatarUrl: '/static/images/unknown.png', //用户头像 https://wx.qlogo.cn/mmopen/vi_32/Q3auHgzwzM7VUvsH88ty2hSl0krhmsRIGPMlAflk7qzmGicDBe0icL24d22HysEJ01Jiaia1geBFlNBoaqn0qhARPA/132
    showSettingDialog: false, // 是否显示设置对话框
    activityInfo: null,
    integral: 0, // 用户拥有的积分
    userLevel: 1, // 当前段位
    userLevelName: '...', // 当前段位名称
    userLevelImage: '', // 当前段位图标
    recvMessageEnabled: App.globalData.recvMessageEnabled, // 接收消息设置
    gameVoiceEnabled: App.globalData.gameVoiceEnabled, // 游戏音效设置
    seasonTitle: '', // 赛季标题
    seasonSubtitle: '', // 赛季副标题
    seasonEndDate: '', // 活动结束时间
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
    this.setData({
      options: options,
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady() {},

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {
    let that = this;
    Utils.keepScreenOn(false);
    // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
    // 所以此处加入 callback 以防止这种情况
    App.userInfoReadyCallback = res => {
      // that.getSeasonInfo();
      that.getGameLevel(() => {
        that.getUserInfo(res => {
          Utils.hideLoading();
          if (!App.globalData.userId && res.returnData.needbind == 1) {
            that.setData({
              showQyBoundDialog: true,
            })
          }
        });
      });
      that.setData({
        pageInitialized: true
      });
      // 如果是通过点击好友对战邀请链接进入的
      if (that.data.options.roomId) {
        wx.navigateTo({
          url: '../friends/index?roomId=' + that.data.options.roomId
        });
      } else if (that.data.options.teamId) { // 通过团队赛邀请进入
        wx.navigateTo({
          url: '../team/create?teamId=' + that.data.options.teamId + '&mode=' + that.data.options.mode
        });
      }

      // 登录授权成功回调
      if (that.authSuccessCallback) {
        that.authSuccessCallback();
        that.authSuccessCallback = null;
      }
    }

    that.getSeasonInfo();
    that.grantAuthorization(false);
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {},

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {},

  /**
   * 点击登录
   */
  clickLogin() {
    this.grantAuthorization(true);
  },

  /**
   * 微信授权登录
   */
  grantAuthorization(immediate, callback) {
    let that = this;
    if (!that.data.pageInitialized) {
      wx.getSetting({
        success: res => {
          if (!res.authSetting['scope.userInfo']) {
            immediate && that.setData({
              showAuthDialog: true
            })
            that.authSuccessCallback = callback;
          } else {
            that.getWxUserInfo();
          }
        }
      });
    } else {
      that.getIntegral(); // 刷新用户积分
      typeof callback == 'function' && callback();
    }
  },

  /**
   * 隐藏授权登录提示框
   */
  hideAuthDialog() {
    this.setData({
      showAuthDialog: false,
    })
  },

  bindUserIdInput: function(e) {
    this.setData({
      userId: e.detail.value
    })
  },

  /**绑定企业微信 */
  bindQyWechat() {
    if (!this.data.userId) {
      wx.showToast({
        icon: 'none',
        title: '请输入员工号',
      })
    } else {
      Utils.ajax(Config.service.userUrl, {
        data: {
          interfaceName: 'bind',
          param: {
            openid: App.globalData.openid,
            userid: this.data.userId,
          }
        }
      }, res => {
        if (res.returnCode == 0 && res.returnData.name) {
          Utils.showModal('成功', `“${res.returnData.name}”，欢迎您！`);
          this.setData({
            showQyBoundDialog: false,
          })
          this.getUserInfo(); // 重新获取用户的信息
        } else {
          Utils.showModal('失败', `员工号不存在！\r\n1、检查员工号是否输入正确；\r\n2、确认是否已加入企业微信。`);
        }
      })
    }
  },

  doGetUserInfo(e) {
    if (e.detail.userInfo) {
      this.getWxUserInfo();
      this.setData({
        showAuthDialog: false,
      })
    } else {
      //用户按了拒绝按钮
    }
  },

  /**获取微信用户信息 */
  getWxUserInfo() {
    // 获取用户信息
    wx.getUserInfo({
      lang: 'zh_CN',
      success: res => {
        this.setData({
          avatarUrl: res.userInfo.avatarUrl
        });
        wx.showLoading({
          title: '正在登录...',
        })
        App.doLogin(res.userInfo, () => {
          // 如果获取openid失败，尝试再次调用
          App.doLogin(res.userInfo, () => {
            Utils.hideLoading();
            Utils.showModal('提示', `获取用户信息失败！请退出后重新进入。`);
          })
        });
      }
    });
  },

  /**获取段位信息 */
  getGameLevel(callback) {
    let that = this;
    Utils.ajax(Config.service.gameLevelUrl, {
      data: {
        interfaceName: 'list',
        param: {}
      }
    }, res => {
      if (res.returnCode == 0) {
        // 缓存到本地
        wx.setStorageSync(Config.Keys.GAME_LEVEL, res.returnData);
      }

      let gameLevel = wx.getStorageSync(Config.Keys.GAME_LEVEL) || [];
      gameLevel.sort((s, t) => {
        return s.level > t.level ? 1 : (s.level == t.level ? 0 : -1)
      }).forEach(item => {
        App.globalData.gameLevelMap[item.level] = {
          star: item.star,
          name: item.name,
          integral: item.score,
          image: `/static/images/level${item.level}.png`
        }
      })

      typeof callback == 'function' && callback(res);
    });
  },

  /**获取用户信息 */
  getUserInfo(callback) {
    let that = this;
    Utils.ajax(Config.service.userUrl, {
      data: {
        interfaceName: 'get',
        param: {
          openid: wx.getStorageSync('openid')
        }
      }
    }, res => {
      let level = 1;
      if (res.returnCode == 0) {
        level = res.returnData.level;
        App.globalData.userId = res.returnData.userid || '';
        App.globalData.department = res.returnData.department || '';
        App.globalData.qyName = res.returnData.nickname || '';
      }
      let currLevelInfo = App.globalData.gameLevelMap[level];
      that.setData({
        userLevel: level,
        userLevelName: currLevelInfo.name,
        userLevelImage: currLevelInfo.image,
        // nickName: App.globalData.department + '-' + App.globalData.qyName,
        nickName: App.globalData.qyName,
        integral: (res.returnData || {}).integral || 0
      })

      // 更新用户积分缓存
      App.globalData.integral = that.data.integral;
      typeof callback == 'function' && callback(res);
    })
  },

  /**查询用户积分 */
  getIntegral(callback) {
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
      typeof callback == 'function' && callback();
    })
  },

  /**查询活动信息 */
  getSeasonInfo() {
    let that = this;
    Utils.ajax(Config.service.seasonUrl, {
      data: {
        interfaceName: 'list',
        param: {
          ruletype: '1005'
        }
      }
    }, res => {
      if (res.returnCode == 0) {
        if (res.returnData && res.returnData.length > 0) {
          let record = res.returnData[0];
          that.setData({
            seasonTitle: record['headline'],
            seasonSubtitle: record['subhead'],
            seasonEndDate: moment(record['endtime']).format('YYYY/MM/DD HH:mm:ss'),
          })
        }
        setTimeout(() => {
          that.setData({
            showGrid: true
          })
        }, 300)
      }
    })
  },

  /**好友对战 */
  showFriendsPK() {
    this.grantAuthorization(true, () => {
      wx.navigateTo({
        url: "../friends/index"
      });
    })
  },

  /**团队赛 */
  showTeamPK() {
    this.grantAuthorization(true, () => {
      wx.navigateTo({
        url: "../team/index"
      });
    })
  },

  /**设置 */
  showSettingDialog(e) {
    this.setData({
      showSettingDialog: e.currentTarget.dataset.show
    });
  },

  /**签到 */
  showSignin() {
    this.grantAuthorization(true, () => {
      wx.navigateTo({
        url: "../signin/index"
      });
    })
  },

  /**每日答题 */
  showDaily() {
    this.grantAuthorization(true, () => {
      wx.navigateTo({
        url: "../daily/index"
      });
    })
  },

  /**排位赛 */
  showPersonal() {
    this.grantAuthorization(true, () => {
      wx.navigateTo({
        url: "../personal/index"
      });
    })
  },

  /**排行榜 */
  showRankingList() {
    wx.navigateTo({
      url: "../ranking/index"
    });
  },

  /**公告 */
  showNotice() {
    wx.navigateTo({
      url: "../notice/index"
    });
  },

  /**背包 */
  showPackage() {
    wx.navigateTo({
      url: "../backpack/index"
    });
  },

  /**个人信息 */
  showUserinfo() {
    this.grantAuthorization(true, () => {
      wx.navigateTo({
        url: "../userinfo/index"
      });
    })
  },

  /**保存设置 */
  saveSetting(event) {
    switch (event.currentTarget.dataset.index) {
      case '1':
        wx.setStorageSync(Config.Keys.SETTING_RECV_MESSAGE, event.detail.value);
        App.globalData.recvMessageEnabled = event.detail.value;
        break;
      case '2':
        wx.setStorageSync(Config.Keys.SETTING_GAME_VOICE, event.detail.value);
        App.globalData.gameVoiceEnabled = event.detail.value;
        break;
    }
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh() {
    wx.showNavigationBarLoading();
    this.getIntegral(() => {
      wx.stopPullDownRefresh();
      wx.hideNavigationBarLoading();
    })
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom() {},

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage() {},
})