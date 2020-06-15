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
    yourTeamMembers: [], // 你的队员
    opponentTeamMembers: [], // 对方队员
    groupId: '', // 分组编号
    roomId: '', // 房间ID
    exitGameNormally: false, // 是否正常退出游戏
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
    let gameInfo = JSON.parse(options.gameInfo || '{}');
    this.setData({
      roomId: gameInfo.roomId,
      groupId: gameInfo.groupId,
      yourTeamMembers: gameInfo.yourTeamMembers,
      opponentTeamMembers: gameInfo.opponentTeamMembers,
    })
    this.showMatchResult();
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
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {},

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {},

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