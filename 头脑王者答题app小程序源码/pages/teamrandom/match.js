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
    yourTeamMembers: [], // 你的队员
    opponentTeamMembers: [], // 对方队员
    groupId: '', // 分组编号
    exitGameNormally: false, // 是否正常退出游戏
    matchingCostTime: 0, // 匹配用时（秒）
    isMatched: false, // 是否匹配成功
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
    this.setData({
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
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {
    // 保持屏幕常亮
    Utils.keepScreenOn();
    this.connectWebSocket();
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {
    this.cancelMatch();
    // 关闭连接
    wx.closeSocket();
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {
    this.cancelMatch();
    // 关闭连接
    wx.closeSocket();
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
            ruletype: '1007',
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
        case 'heart':
          console.log('收到心跳回复', res);
          break;
        case 'grouproom': // 推送匹配结果
          console.log('匹配结果', res);
          clearInterval(countUpTimerId);
          let yourTeamMembers = []; // 你的队员
          let opponentTeamMembers = []; // 对方队员
          let yourGroupId = msg.returnData.groupid; // 分组编号
          msg.returnData.userinfos.forEach(item => {
            if (item.groupid == yourGroupId) {
              yourTeamMembers.push(item);
            } else {
              opponentTeamMembers.push(item);
            }
          })

          that.setData({
            isMatched: true,
            groupId: yourGroupId,
            roomId: msg.returnData.roomid,
            yourTeamMembers: yourTeamMembers,
            opponentTeamMembers: opponentTeamMembers,
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

      if (this.data.matchingCostTime == 20 && !this.data.isMatched) {
        this.cancelMatch();
        Utils.showModal('提示', '当前参赛人数不足，请稍候重试！', () => {
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
          param: '{}'
        })
      })
    }, 5000);
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
          url: '../team/play?gameInfo=' + JSON.stringify({
            groupId: that.data.groupId,
            roomId: that.data.roomId,
            yourTeamMembers: that.data.yourTeamMembers,
            opponentTeamMembers: that.data.opponentTeamMembers,
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