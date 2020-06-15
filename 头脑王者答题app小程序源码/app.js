//app.js
//更多资源请关注三岁半资源网-sansuib.com
const Config = require('config');
const Utils = require('/static/js/utils.js');

App({
  onLaunch() {
    // 获取规则
    Utils.ajax(Config.service.questionUrl, {
      data: {
        interfaceName: 'rule',
        param: {}
      }
    }, res => {
      // 缓存到本地
      wx.setStorageSync(Config.Keys.RULES, res.returnData);
    });
    this.getQuestionType();
    this.globalData.recvMessageEnabled = this.getSettingValue(wx.getStorageSync(Config.Keys.SETTING_RECV_MESSAGE));
    this.globalData.gameVoiceEnabled = this.getSettingValue(wx.getStorageSync(Config.Keys.SETTING_GAME_VOICE));
    // 版本检测
    let updateManager = wx.getUpdateManager();
    updateManager.onUpdateReady(() => {
      Utils.showToast('新版本已经准备好，即将重启应用！');
      updateManager.applyUpdate();
    })
  },

  /**获取问题分类 */
  getQuestionType() {
    let that = this;
    Utils.ajax(Config.service.questionTypeUrl, {
      data: {
        interfaceName: 'list',
        param: {}
      }
    }, res => {
      if (res.returnCode == 0) {
        res.returnData.forEach(item => {
          that.globalData.chartCategories.push(item.name);
        })
      }
    })
  },

  doLogin(userInfo, callback) {
    let that = this;
    that.globalData.nickName = userInfo.nickName;
    that.globalData.avatarUrl = userInfo.avatarUrl;
    that.globalData.location = userInfo.province + userInfo.city;
    // 登录
    wx.login({
      success: response => {
        if (response.code) {
          // 发送 res.code 到后台换取 openId, sessionKey, unionId
          Utils.ajax(Config.service.loginUrl, {
            data: {
              code: response.code,
              nickname: Utils.encode(userInfo.nickName),
              avatarUrl: userInfo.avatarUrl,
              province: Utils.encode(userInfo.province),
              city: Utils.encode(userInfo.city),
              country: Utils.encode(userInfo.country),
            }
          }, res => {
            if (res.returnCode == 0 && res.returnData) {
              if (res.returnData.openid) {
                that.globalData.openid = res.returnData.openid;
                // 缓存到本地
                wx.setStorageSync("openid", res.returnData.openid);
              }
              if (res.returnData.session_key) {
                that.globalData.sessionKey = res.returnData.session_key;
                wx.setStorageSync("sessionKey", res.returnData.session_key);
              }
              if (this.userInfoReadyCallback) {
                this.userInfoReadyCallback(res)
              }
            } else {
              typeof callback == 'function' && callback();
            }
          })
        } else {
          Utils.showModal('提示', '微信登录失败:' + response.errMsg)
        }
      }
    });
  },
  getSettingValue(value) {
    return value === '' ? true : value;
  },
  globalData: {
    openid: '',
    sessionKey: '',
    nickName: '', // 昵称
    avatarUrl: '', // 头像地址
    userId: '', // 工号
    department: '', // 部门
    qyName: '', //企业微信-姓名
    location: '', // 地点
    integral: 0, // 拥有积分
    recvMessageEnabled: true,
    gameVoiceEnabled: true,
    friendsRoom: undefined, //好友对战房间ID
    teamRoom: undefined, //团队赛房间ID
    teamId: undefined, // 团队ID
    gameLevelMap: {}, // 游戏等级信息
    chartCategories: [],
  }
})