// pages/personal/match.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
const ANIMATION_OPTIONS = {
  duration: 500,
  timingFunction: 'linear',
};

let animation = null;
let otherAnimation = null;
let avatarAnimation = null;
let heartbeatTimerId = null; // 心跳定时器
let countUpTimerId = null;
Page({

  /**
   * 页面的初始数据
   */
  data: {
    seasonId: '', // 赛季活动ID
    gameLevel: 1, // 匹配段位
    showMatchResult: false,
    animationData: {},
    otherAnimationData: {},
    avatarAnimationData: {},
    isInit: false,
    roomId: '', // 房间编号
    yourName: '', // 你的昵称
    yourAvatarUrl: '', // 你的头像地址
    yourLocation: '', // 你的地点
    opponentId: '', //对手ID
    opponentName: '', // 对手的昵称
    opponentAvatarUrl: '', // 对手的头像地址
    opponentLocation: '', // 对手的地点
    integral: 0, // 拥有积分
    exitGameNormally: false, // 是否正常退出游戏
    matchingCostTime: 0, // 匹配用时（秒）
    isMatched: false, // 是否匹配成功
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
    this.setData({
      gameLevel: options.level,
      seasonId: options.seasonId,
      yourName: App.globalData.qyName,
      yourAvatarUrl: App.globalData.avatarUrl,
      yourLocation: App.globalData.department,
      integral: App.globalData.integral,
      matchingCostTime: 0,
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady() {
    wx.hideShareMenu(); // 隐藏转发按钮
    this.connectWebSocket();
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {
    // 保持屏幕常亮
    Utils.keepScreenOn();
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {
    this.cancelMatch();
    wx.closeSocket(); // 关闭连接
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {
    this.cancelMatch();
    wx.closeSocket(); // 关闭连接
  },

  /**连接websocket */
  connectWebSocket() {
    let that = this;
    wx.connectSocket({
      url: Config.service.wsUrl + '/' + App.globalData.openid,
      success: res => {
        that.initWebSocketListener();
      }
    });
  },

  /**初始化websocket监听 */
  initWebSocketListener() {
    let that = this;
    wx.onSocketOpen(res => {
      that.sendHeartBeat();
      // 开始匹配对手
      wx.sendSocketMessage({
        data: JSON.stringify({
          interfaceName: 'matching',
          param: {
            ruletype: '1005',
            level: that.data.gameLevel,
            seasonid: that.data.seasonId,
          }
        })
      })
      that.initCountUp();
    })
    wx.onSocketError(res => {
      clearInterval(heartbeatTimerId);
      Utils.showModal('提示', '连接到服务器失败', () => {
        wx.closeSocket();
        that.connectWebSocket();
      });
    })
    wx.onSocketClose(res => {
      clearInterval(heartbeatTimerId);
    })
    wx.onSocketMessage(res => {
      var msg = JSON.parse(res.data);
      switch (msg.returnMessage) {
        case 'rankroom': // 推送匹配结果
          clearInterval(countUpTimerId);
          that.setData({
            isMatched: true,
            roomId: msg.returnData.roomid,
          })
          msg.returnData.userinfos.forEach(item => {
            if (item.openid != App.globalData.openid) {
              that.setData({
                opponentName: item.name,
                opponentAvatarUrl: item.avatar_url,
                opponentLocation: item.department,
              })
            }
          })
          that.showMatchResult();
          break;
        case 'challengelimit':
          that.cancelMatch();
          Utils.showModal('提示', '今日的挑战次数已用完！', () => {
            wx.navigateBack();
          });
          break;
      }
    });
  },

  /**计算匹配用时 */
  initCountUp() {
    countUpTimerId = setInterval(() => {
      let costTime = this.data.matchingCostTime;
      this.setData({
        matchingCostTime: costTime + 1
      })

      if (this.data.matchingCostTime == 15 && !this.data.isMatched) {
        this.cancelMatch();
        Utils.showModal('提示', '当前段位匹配人数不足，请选择其他段位进行匹配！', () => {
          wx.navigateBack();
        })
      }
    }, 1000)
  },

  /**发送心跳 */
  sendHeartBeat() {
    heartbeatTimerId = setInterval(() => {
      wx.sendSocketMessage({
        data: JSON.stringify({
          interfaceName: 'heart',
          param: {}
        })
      })
    }, 5000);
  },

  /**显示匹配结果 */
  showMatchResult() {
    let that = this;
    animation = wx.createAnimation(ANIMATION_OPTIONS)
    animation.rotate(0).step();

    otherAnimation = wx.createAnimation(ANIMATION_OPTIONS)

    avatarAnimation = wx.createAnimation(ANIMATION_OPTIONS)
    avatarAnimation.rotate(-25).step();

    that.setData({
      isInit: true,
      showMatchResult: true,
      animationData: animation.export(),
      otherAnimationData: otherAnimation.export(),
      avatarAnimationData: avatarAnimation.export()
    })

    setTimeout(function() {
      animation.opacity(1).rotate(-335).left(-100).step();
      otherAnimation.opacity(1).rotate(385).right(-100).step()
      this.setData({
        exitGameNormally: true,
        animationData: animation.export(),
        otherAnimationData: otherAnimation.export(),
      })
      setTimeout(() => {
        wx.navigateTo({
          url: '../personal/play?gameInfo=' + JSON.stringify({
            roomId: that.data.roomId,
            opponentId: that.data.opponentId,
            opponentName: that.data.opponentName,
            opponentAvatarUrl: that.data.opponentAvatarUrl,
            opponentLocation: that.data.opponentLocation,
          }),
        })
      }, 2000)
    }.bind(this), 1000)

    that.initAvatarAnimation();
  },

  /**初始化头像动画 */
  initAvatarAnimation() {
    var next = true;
    setInterval(function() {
      if (next) {
        avatarAnimation.scale(1.1).step()
      } else {
        avatarAnimation.scale(0.9).step()
      }
      next = !next;
      this.setData({
        avatarAnimationData: avatarAnimation.export()
      })
    }.bind(this), 500)
  },

  /**取消匹配 */
  cancelMatch() {
    clearInterval(countUpTimerId);
    if (!this.data.exitGameNormally) {
      // 提前退出比赛时，取消匹配
      wx.sendSocketMessage({
        data: JSON.stringify({
          interfaceName: 'cancel'
        })
      })
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