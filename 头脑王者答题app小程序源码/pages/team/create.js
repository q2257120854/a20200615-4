// pages/team/create.js
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
    mode: '', //对战模式
    teamId: '', //队伍id
    userName: '', //用户名字
    userAvatarUrl: '', //用户头像
    integral: 0, // 胜方可获取的积分
    questionCount: 5, // 对战题目数量
    answerTime: 0, // 每个题目的答题时间
    roomActiveTime: defaultRoomActiveTime, // 房间有效时间（秒）
    roomActiveTimeText: '',
    footerButtonHidden: true,
    pageLoaded: false, // 页面是否加载
    createRoomHidden: true, // 是否隐藏创建房间按钮
    startPKHidden: true, // 是否隐藏开始挑战按钮
    userOwnedRoom: true,
    friendOwnedRoom: true,
    shareButtonHidden: true, // 是否隐藏邀请按钮
    teamLeader: '', // 队长openid
    availableTimes: 0, // 挑战剩余次数
    heartbeatReplyRecvTime: 0, // 心跳回复接收时间（毫秒）
    roomNotExistsErrorProcessed: false, // 是否处理了“房间不存在”的错误
    teamMembers: [], //团队成员
    groupId: '', // 我所在的组
    roomId: '', //房间ID
    quitButtonHidden: false, //是否隐藏放弃按钮
    dismissButtonHidden: true, //是否隐藏解散按钮
    isMatching: false, //是否正在匹配
    isTeamDismissed: false, //队伍是否解散
  },

  /**设置标题 */
  setNavigationBarTitle(mode) {
    var gameModeText = mode == 2 ? '2v2' : (mode == 3 ? '3v3' : '5v5');
    wx.setNavigationBarTitle({
      title: '团队赛(' + gameModeText + ')'
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
    let that = this;
    var gameMode = options.mode;
    that.setNavigationBarTitle(gameMode);

    // 规则
    var gameRules = wx.getStorageSync(Config.Keys.RULES)['1008'];
    that.setData({
      mode: gameMode,
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
    // App.globalData.teamId = 662013;
    if (options.teamId && options.teamId != undefined && options.teamId != 'undefined') {
      // 如果是通过好友邀请进入
      console.log('通过邀请进入，队伍ID=' + options.teamId + ', 队伍人数=' + options.mode);
      that.setData({
        teamId: options.teamId,
        shareButtonHidden: true
      })
      that.connectWebSocket();
    } else {
      console.log('App.globalData.teamId = ', App.globalData.teamId)
      // 如果未创建房间或房间已过期，则调用接口创建房间
      if (!App.globalData.teamId) {
        that.connectWebSocket();
      } else {
        // 加入已存在的房间
        that.setData({
          teamId: App.globalData.teamId,
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
    !isPKStarted && that.leaveTeam();
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
    if (!that.data.isTeamDismissed) {
      // 如果队伍已解散，没必要再发送退出比赛的消息
      that.exitGame();
      App.globalData.teamId = '';
      Utils.showToast('已退出团队赛');
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
        if (res.returnData && res.returnData['1008']) {
          that.setData({
            availableTimes: res.returnData['1008'] < 0 ? 0 : res.returnData['1008']
          })
        }
      }
    })
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
      // 加入(创建)团队
      wx.sendSocketMessage({
        data: JSON.stringify({
          interfaceName: 'matching',
          param: {
            ruletype: '1008',
            capacity: that.data.mode,
            teamid: that.data.teamId,
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
        case 'grouproom-create':
          console.log('队伍创建成功', res);
          let teamMembers = [];
          if (msg.returnData.user) {
            teamMembers.push(Object.assign(msg.returnData.user, {
              iscaptain: true
            }));
          }
          that.setData({
            teamLeader: App.globalData.openid,
            teamId: msg.returnData.teamid,
            shareButtonHidden: false,
            teamMembers: teamMembers,
          })
          // 全局缓存队伍ID
          App.globalData.teamId = msg.returnData.teamid;
          break;
        case 'grouproom-join':
        case 'grouproom-gain':
          console.log('返回队伍信息', res);
          let teamLeader; // 队长ID
          msg.returnData.members.forEach(item => {
            if (item.iscaptain) {
              teamLeader = item.openid;
            }
          });
          // 队伍是否满员
          let isTeamFull = msg.returnData.members.length == msg.returnData.capacity;
          // 是否为队员
          let isNotTeamLeader = App.globalData.openid != teamLeader;
          that.setNavigationBarTitle(msg.returnData.capacity);
          that.setData({
            teamId: msg.returnData.teamid,
            teamMembers: msg.returnData.members,
            teamLeader: teamLeader,
            quitButtonHidden: isTeamFull,
            shareButtonHidden: isNotTeamLeader,
          });
          if (isTeamFull) {
            // 队伍满员时，在队长端显示解散按钮、开始匹配按钮
            that.setData({
              shareButtonHidden: isNotTeamLeader,
              dismissButtonHidden: isNotTeamLeader,
              footerButtonHidden: isNotTeamLeader,
              startPKHidden: isNotTeamLeader,
            })
          }
          break;
        case 'match-cancel': // 有人退出队伍
          console.log('退出队伍消息', res)
          Utils.stopRoomVoice();
          if (App.globalData.openid == that.data.teamLeader) {
            // 队员退出
            that.setData({
              footerButtonHidden: true,
              startPKHidden: true,
              shareButtonHidden: false
            })
          } else {
            // 队长退出
            that.setData({
              isTeamDismissed: true,
            })
            Utils.showModal('提示', '队长放弃了比赛', function() {
              wx.navigateBack();
            });
          }
          break;
        case 'group-invite-matching-cancel':
          // 匹配对手时，队长解散队伍
          console.log('匹配对手时，队长解散队伍', res)
          that.setData({
            isTeamDismissed: true,
          })
          Utils.hideLoading();
          Utils.showModal('提示', '队长放弃了比赛', function() {
            wx.navigateBack();
          });
          break;
        case 'matching-start':
          // 开始匹配
          console.log('开始匹配', res);
          that.setData({
            isMatching: true,
            footerButtonHidden: true,
            startPKHidden: true,
          })
          wx.showLoading({
            title: '匹配对手....',
            mask: App.globalData.openid != that.data.teamLeader,
          })
          break;
        case 'grouproom': // 匹配成功
          console.log('匹配成功', res)
          Utils.success('匹配成功');
          let yourTeamMembers = []; // 你的队员
          let opponentTeamMembers = []; // 对方队员
          let yourGroupId = msg.returnData.groupid; // 分组编号
          msg.returnData.userinfos.forEach(item => {
            //因为URL参数长度限制，只取一部分信息
            let memberInfo = {
              name: item.item,
              department: item.department,
              avatarUrl: item.avatarUrl,
              groupid: item.groupid,
              openid: item.openid,
            };
            if (item.groupid == yourGroupId) {
              yourTeamMembers.push(memberInfo);
            } else {
              opponentTeamMembers.push(memberInfo);
            }
          })

          that.setData({
            groupId: yourGroupId,
            roomId: msg.returnData.roomid,
            teamMembers: yourTeamMembers,
          })

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
            url: '../team/match?gameInfo=' + JSON.stringify({
              teamId: that.data.teamId,
              teamLeader: that.data.teamLeader,
              groupId: that.data.groupId,
              roomId: that.data.roomId,
              yourTeamMembers: yourTeamMembers,
              opponentTeamMembers: opponentTeamMembers,
            }),
          })
          break;
        case 'challengelimit':
          clearInterval(heartbeatCheckTimerId);
          // 如果是队长挑战次数受限制，发送退出比赛消息，通知另一方也退出比赛
          if (App.globalData.openid == that.data.teamLeader) {
            that.exitGame();
          }
          Utils.showModal('提示', '今日的挑战次数已用完！', () => {
            App.globalData.teamId = '';
            wx.navigateBack();
          });
          break;
        case 'cancel-matching-group-invite': //解散队伍
          App.globalData.teamId = '';
          that.setData({
            isTeamDismissed: true,
          })
          if (App.globalData.openid != that.data.teamLeader) {
            // 只有队员端提示消息弹出框
            Utils.showModal('提示', '队长解散了队伍！', () => {
              wx.navigateBack();
            });
          } else {
            Utils.showToast('队伍已解散');
            wx.navigateBack();
          }
          break;
        case 'ROOM_NOT_EXIST_ERROR': // 房间不存在
          clearInterval(heartbeatCheckTimerId);
          if (!that.data.roomNotExistsErrorProcessed) { // 避免重复弹出此提示
            that.setData({
              roomNotExistsErrorProcessed: true,
            })
            Utils.showModal('提示', '此对战房间已过期！', () => {
              App.globalData.teamId = '';
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
        App.globalData.teamId = '';
        that.data.pageLoaded && Utils.showModal('提示', '本次对战已过期，请重新开局！', res => {
          wx.navigateBack();
        });
      }
    }, 1000);
  },

  /**离开团队 */
  leaveTeam() {
    let that = this;
    // wx.sendSocketMessage({
    //   data: JSON.stringify({
    //     interfaceName: 'leave',
    //     param: {
    //       teamId: that.data.teamId
    //     }
    //   })
    // })
  },

  /**退出比赛 */
  exitGame() {
    let that = this;
    wx.sendSocketMessage({
      data: JSON.stringify({
        interfaceName: 'cancel',
        param: {
          teamid: that.data.teamId
        }
      }),
      success: () => {
        App.globalData.teamId = '';
      }
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
        that.leaveTeam();
        Utils.showToast('连接断开，正在重连...');
        wx.closeSocket(); // 断开连接
        that.connectWebSocket(); // 重连
      }
    }, 3000)
  },

  /**开始匹配 */
  startMatch() {
    // 发送开始消息
    let that = this;
    wx.sendSocketMessage({
      data: JSON.stringify({
        interfaceName: 'matching-start',
        param: {
          teamid: that.data.teamId,
          capacity: that.data.mode,
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
      content: '是否放弃对战并离开队伍？',
      success: res => {
        if (res.confirm) {
          isLeaveRoom = false;
          that.exitGame(); // 发送退出比赛消息
          App.globalData.teamId = '';
          clearInterval(roomTimerId);
          wx.navigateBack();
        }
      }
    })
  },

  /**解散队伍 */
  dismiss() {
    let that = this;
    wx.showModal({
      title: '提示',
      content: '确定要解散队伍？',
      success(res) {
        if (res.confirm) {
          wx.sendSocketMessage({
            data: JSON.stringify({
              interfaceName: that.data.isMatching ? 'cancel-matching-group-invite' : 'cancel',
              param: {
                teamid: that.data.teamId,
              }
            }),
            success: res => {
              that.setData({
                isTeamDismissed: true,
              })
              App.globalData.teamId = '';
              Utils.showToast('队伍已解散');
              wx.navigateBack();
            },
            fail: (res) => {
              console.log('解散队伍失败', res)
            }
          })
        }
      }
    })
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
      path: '/pages/home/index?teamId=' + this.data.teamId + '&mode=' + this.data.mode,
      imageUrl: '/static/images/share-pk.png',
      success: res => {
        if (res.errMsg == 'shareAppMessage:ok') {
          console.log('Share ok!')
        }
      }
    };
  }
})