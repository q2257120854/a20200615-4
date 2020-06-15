// pages/friends/index.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
const defaultRoomActiveTime = 600; // 房间有效时间（秒）

let roomTimerId = null; // 房间有效计时器
let heartbeatTimerId = null; // 心跳定时器
let heartbeatCheckTimerId = null; // 心跳检测定时器
let isLeaveRoom = true; // 是否离开房间
let pageInitialized = false; // 页面是否已初始化
let isPKStarted = false; // 对战是否开始

Page({

  /**
   * 页面的初始数据
   */
  data: {
    roomId: '', //房间id
    userName: '', //用户名字
    userAvatarUrl: '', //用户头像
    friendOpenId: '', // 好友ID
    friendName: "...", //好友名字
    friendAvatarUrl: '/static/images/unknown.png', //好友头像
    integral: 0, // 胜方可获取的积分
    openidCount: 2, // 对战人数
    questionCount: 5, // 对战题目数量
    answerTime: 0, // 每个题目的答题时间
    roomActiveTime: defaultRoomActiveTime, // 房间有效时间（秒）
    roomActiveTimeText: '',
    footerButtonHidden: true,
    statusText: '等待对手加入...',
    pageLoaded: false, // 页面是否加载
    createRoomHidden: true, // 是否隐藏创建房间按钮
    startPKHidden: true, // 是否隐藏开始挑战按钮
    userOwnedRoom: true,
    friendOwnedRoom: true,
    shareButtonHidden: true, // 是否隐藏邀请按钮
    roomOwner: '', // 房主openid
    availableTimes: 0, // 挑战剩余次数
    heartbeatReplyRecvTime: 0, // 心跳回复接收时间（毫秒）
    roomNotExistsErrorProcessed: false, // 是否处理了“房间不存在”的错误
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
    let that = this;
    // 规则
    var gameRules = wx.getStorageSync(Config.Keys.RULES)['1006'];
    that.setData({
      pageLoaded: true,
      userName: App.globalData.qyName,
      userAvatarUrl: App.globalData.avatarUrl,
      questionCount: gameRules['total'],
      answerTime: gameRules['limit']
    });

    isLeaveRoom = true;
    isPKStarted = false;
    pageInitialized = false;
    heartbeatCheckTimerId = null;
    if (options.roomId && options.roomId != undefined && options.roomId != 'undefined') {
      App.globalData.friendsRoom = '';
      // 如果是通过好友邀请进入
      that.setData({
        roomId: options.roomId,
        shareButtonHidden: true
      })
      that.connectWebSocket();
    } else {
      // 如果未创建房间或房间已过期，则调用接口创建房间
      if (!App.globalData.friendsRoom) {
        that.createRoom(() => {
          that.connectWebSocket();
        });
      } else {
        // 加入已存在的房间
        that.setData({
          roomId: App.globalData.friendsRoom,
        });
        // 先关闭已存在的计时器
        clearInterval(roomTimerId);
        that.connectWebSocket();
      }
    }
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady() {
    // 保持屏幕常亮
    Utils.keepScreenOn();
    wx.hideShareMenu(); // 隐藏转发按钮
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {
    let that = this;
    that.getAnswerTimes();
    if (pageInitialized) { // 从对战答题页面返回
      that.setData({
        statusText: '等待对手加入...'
      })
      heartbeatCheckTimerId = null;
      that.connectWebSocket();
    } else {
      pageInitialized = true;
    }
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {
    let that = this;
    // 如果对战未开始，发送离开房间消息
    !isPKStarted && that.leaveRoom();
    // 关闭连接
    wx.closeSocket();
    clearInterval(roomTimerId);
    clearInterval(heartbeatCheckTimerId);
    Utils.stopRoomVoice();
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {
    let that = this;
    that.setData({
      pageLoaded: false
    })
    // 如果退出页面
    if (App.globalData.openid != that.data.roomOwner) {
      // 如果是好友（不是房主）点击了返回页面，即认为是放弃对战
      that.exitGame();
    } else {
      // 房主离开房间
      isLeaveRoom && that.leaveRoom();
    }
    // 关闭连接
    wx.closeSocket();
    clearInterval(roomTimerId);
    clearInterval(heartbeatCheckTimerId);
    pageInitialized = false;
    Utils.stopRoomVoice();
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
        if (res.returnData && res.returnData['1006']) {
          that.setData({
            availableTimes: res.returnData['1006'] < 0 ? 0 : res.returnData['1006']
          })
        }
      }
    })
  },

  /**创建房间 */
  createRoom(callback) {
    let that = this;
    Utils.ajax(Config.service.roomUrl, {
      data: {
        interfaceName: 'create',
        param: {
          type: 1006, // 好友对战
          openid: App.globalData.openid,
        }
      }
    }, res => {
      if (res.returnCode == 1017 || res.returnMessage == 'challengelimit') {
        Utils.showModal('提示', '今日挑战次数已用完！', () => {
          wx.navigateBack();
        })
      } else {
        that.setData({
          footerButtonHidden: true,
          roomId: res.returnData.roomid,
        });
        // 全局缓存房间ID
        App.globalData.friendsRoom = res.returnData.roomid;
        typeof callback == 'function' && callback();
      }
    });
  },

  /**连接websocket */
  connectWebSocket(callback) {
    let that = this;
    wx.connectSocket({
      url: Config.service.wsUrl + '/' + App.globalData.openid,
      success: res => {
        that.initWebSocketListener(callback);
      }
    });
  },

  /**初始化websocket监听 */
  initWebSocketListener(callback) {
    let that = this;
    wx.onSocketOpen(res => {
      // 加入房间
      wx.sendSocketMessage({
        data: JSON.stringify({
          interfaceName: 'join',
          param: {
            roomid: that.data.roomId,
            nickname: App.globalData.nickName,
            avatarUrl: App.globalData.avatarUrl,
          }
        })
      })
      that.initHeartbeat();
      typeof callback == 'function' && callback();
    })
    wx.onSocketError(res => {
      clearInterval(heartbeatTimerId);
      console.log('WebSocket连接打开失败，请检查！')
    })
    wx.onSocketClose(res => {
      clearInterval(heartbeatTimerId);
    })
    // 接收服务器消息
    wx.onSocketMessage(res => {
      var msg = JSON.parse(res.data);
      switch (msg.returnMessage) {
        case 'heart':
          console.log('收到心跳回复');
          that.setData({
            heartbeatReplyRecvTime: new Date().getTime()
          })
          break;
        case 'joined': // 加入房间成功
          console.log('加入房间成功', res);
          let owner = msg.returnData.owner; // 房主ID
          // 更新对战页面显示的信息
          let theRoomActiveTime = parseInt(Number(msg.returnData.outTime / 1000) - (new Date().getTime() - Number(msg.returnData.countdown)) / 1000);
          if (App.globalData.openid == owner) {
            that.setData({
              roomOwner: owner,
              userOwnedRoom: false,
              friendOwnedRoom: true,
              shareButtonHidden: false,
              roomActiveTime: theRoomActiveTime,
            })
          } else {
            that.setData({
              roomOwner: owner,
              userOwnedRoom: true,
              friendOwnedRoom: false,
              roomActiveTime: theRoomActiveTime
            })
          }

          if (msg.returnData && msg.returnData.userinfos) {
            var allUserReady = true; // 是否所有玩家已准备
            // 清空好友信息
            that.setData({
              friendName: '',
              friendAvatarUrl: '/static/images/unknown.png'
            })
            msg.returnData.userinfos.forEach(item => {
              if (item.openid != App.globalData.openid) {
                that.setData({
                  friendOpenId: item.openid,
                  friendName: item.name,
                  friendAvatarUrl: item.avatarUrl
                })
              }
              if (item.status != 'in') {
                allUserReady = false;
              }
            })
            // 如果人数到齐 且 玩家都做好了准备，房主端显示开始答题按钮
            if (msg.returnData.userinfos.length == that.data.openidCount && allUserReady) {
              if (App.globalData.gameVoiceEnabled) {
                Utils.playRoomVoice(); // 播放背景音乐
              }
              if (App.globalData.openid == owner) {
                // 添加好友
                Utils.ajax(Config.service.friendUrl, {
                  data: {
                    interfaceName: 'add',
                    param: {
                      openid: App.globalData.openid,
                      friendopenid: that.data.friendOpenId,
                    }
                  }
                })
                that.setData({
                  footerButtonHidden: false,
                  createRoomHidden: true,
                  startPKHidden: false,
                  statusText: '',
                  shareButtonHidden: true,
                });
              } else {
                that.setData({
                  statusText: '等待发起者开始',
                })
              }
            } else {
              that.setData({
                footerButtonHidden: true,
                createRoomHidden: true,
                startPKHidden: true,
                statusText: '等待对手加入...',
              });
            }
          }
          that.startCountdown();
          break;
        case 'quit': // 有人退出房间
          Utils.stopRoomVoice();
          if (App.globalData.openid == that.data.roomOwner) {
            // 好友退出
            that.setData({
              friendName: '',
              friendAvatarUrl: '',
              statusText: '等待对手加入...',
              footerButtonHidden: true,
              startPKHidden: true,
              shareButtonHidden: false
            })
          } else {
            // 房主退出
            Utils.showModal('提示', that.data.friendName + '放弃了对战', function() {
              wx.navigateBack();
            });
          }
          break;
        case 'ready': // 准备
          isPKStarted = true;
          clearInterval(roomTimerId);
          clearInterval(heartbeatCheckTimerId);
          Utils.stopRoomVoice();
          // 把按钮全部隐藏掉
          that.setData({
            footerButtonHidden: true,
            createRoomHidden: true,
            startPKHidden: true
          })
          wx.navigateTo({
            url: '../friends/play?gameInfo=' + JSON.stringify({
              roomId: that.data.roomId,
              roomOwner: that.data.roomOwner,
              friendName: that.data.friendName,
              friendAvatarUrl: that.data.friendAvatarUrl
            }),
          })
          break;
        case 'challengelimit':
          clearInterval(heartbeatCheckTimerId);
          // 如果是房主挑战次数受限制，发送退出比赛消息，通知另一方也退出比赛
          if (App.globalData.openid == that.data.roomOwner) {
            that.exitGame();
          }
          Utils.showModal('提示', '今日的挑战次数已用完！', () => {
            App.globalData.friendsRoom = '';
            wx.navigateBack();
          });
          break;
        case 'ROOM_NOT_EXIST_ERROR': // 房间不存在
          clearInterval(heartbeatCheckTimerId);
          if (!that.data.roomNotExistsErrorProcessed) { // 避免重复弹出此提示
            that.setData({
              roomNotExistsErrorProcessed: true,
            })
            Utils.showModal('提示', '此对战房间已过期！', () => {
              App.globalData.friendsRoom = '';
              wx.navigateBack();
            });
          }
          break;
      }
    });
  },

  /**房间有效时间倒计时 */
  startCountdown() {
    let that = this;
    clearInterval(roomTimerId);
    roomTimerId = setInterval(() => {
      let minute = Math.floor(that.data.roomActiveTime / 60);
      let minuteText = minute.toString();
      if (minuteText.length == 1) {
        minuteText = '0' + minuteText;
      }

      let second = that.data.roomActiveTime - minute * 60;
      let secondText = second.toString();
      if (secondText.length == 1) {
        secondText = '0' + secondText;
      }

      // 更新剩余时间
      that.setData({
        roomActiveTime: that.data.roomActiveTime - 1,
        roomActiveTimeText: minuteText + ':' + secondText
      })

      if (that.data.roomActiveTime < 0) {
        clearInterval(roomTimerId);
        clearInterval(heartbeatCheckTimerId);
        App.globalData.friendsRoom = '';
        that.data.pageLoaded && Utils.showModal('提示', '本次对战已过期，请重新开局！', res => {
          wx.navigateBack();
        });
      }
    }, 1000);
  },

  /**离开房间 */
  leaveRoom() {
    let that = this;
    wx.sendSocketMessage({
      data: JSON.stringify({
        interfaceName: 'leave',
        param: {
          roomid: that.data.roomId
        }
      })
    })
  },

  /**退出比赛 */
  exitGame() {
    let that = this;
    wx.sendSocketMessage({
      data: JSON.stringify({
        interfaceName: 'exit',
        param: {
          roomid: that.data.roomId
        }
      })
    })
  },

  /**开启心跳定时发送 */
  initHeartbeat() {
    let that = this;
    console.log('开启心跳')
    that.sendHeartbeatMessage();
    clearInterval(heartbeatTimerId);
    heartbeatTimerId = setInterval(() => {
      that.sendHeartbeatMessage();
    }, 5000);
  },

  /**发送心跳 */
  sendHeartbeatMessage() {
    let that = this;
    wx.sendSocketMessage({
      data: JSON.stringify({
        interfaceName: 'heart',
        param: {}
      }),
      success: (res) => {
        !heartbeatCheckTimerId && (
          console.log('开启心跳检测'),
          that.keepHeartbeatAlive()
        )
      },
      fail: (res) => {
        console.log('发送心跳失败', res)
      }
    })
  },

  /**根据心跳回复的间隔时间判断是否连接超时，如已超时，立刻进行重连 */
  keepHeartbeatAlive() {
    let that = this;
    heartbeatCheckTimerId = setInterval(() => {
      if (new Date().getTime() - that.data.heartbeatReplyRecvTime > 7000) {
        that.leaveRoom();
        Utils.showToast('连接断开，正在重连...');
        wx.closeSocket(); // 断开连接
        that.connectWebSocket(); // 重连
      }
    }, 3000)
  },

  /**开始对战 */
  startGame() {
    // 发送开始消息
    let that = this;
    wx.sendSocketMessage({
      data: JSON.stringify({
        interfaceName: 'start',
        param: {
          roomid: that.data.roomId,
        }
      }),
      fail: (res) => {
        console.log('开始对战失败', res)
      }
    })
  },

  /**放弃挑战 */
  giveUp() {
    var that = this;
    wx.showModal({
      title: '提示',
      content: '是否放弃对战并离开房间？',
      success: res => {
        if (res.confirm) {
          isLeaveRoom = false;
          that.exitGame(); // 发送退出比赛消息
          App.globalData.friendsRoom = '';
          clearInterval(roomTimerId);
          wx.navigateBack();
        }
      }
    })
  },

  /**新开一场 */
  startNewGame() {
    let that = this;
    that.createRoom(() => {
      that.setData({
        roomActiveTime: defaultRoomActiveTime
      });
      that.connectWebSocket();
    });
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
    // 关闭连接
    wx.closeSocket();
    clearInterval(roomTimerId);
    clearInterval(heartbeatCheckTimerId);
    heartbeatCheckTimerId = null;
    return {
      title: '[' + this.data.userName + '@你，向你发起了智商PK，点击应战！',
      path: '/pages/home/index?roomId=' + this.data.roomId,
      imageUrl: '/static/images/share-pk.png',
      success: res => {
        if (res.errMsg == 'shareAppMessage:ok') {
          console.log('Share ok!')
        }
      }
    };
  }
})