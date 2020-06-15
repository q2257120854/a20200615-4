// pages/friends/play.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
const START_ANGLE = 1.5 * Math.PI; // 起始弧度，单位弧度（在3点钟方向）
const END_ANGLE = -0.5 * Math.PI; // 终止弧度

let countdownId = null; // 答题倒计时计时器ID
let count = 0; // 倒计时累计秒数
let answerStartTime = 0; // 答题开始时间，从收到题目开始计时(毫秒)
let leaveGame = false; // 用户切换到其他应用，暂时离开对战
let heartbeatTimerId = null; // 心跳定时器
let heartbeatCheckTimerId = null; // 心跳检测定时器
let toastInst = null;
let toastMessages = [];
let toastTimerId = null; // 答题结果提示定时器
let answerIndexChar = ['A', 'B', 'C', 'D', 'E', 'F'];
Page({

  /**
   * 页面的初始数据
   */
  data: {
    successful: false, // 显示挑战成功
    defeated: false, // 显示挑战失败
    roomId: '', // 房间号
    groupId: '', // 分组编号
    yourTeamMembers: [
      // { avatarUrl: 'https://wx.qlogo.cn/mmopen/vi_32/Q3auHgzwzM7TjLjUQpnHUG7IvrpGKCly8GicZ25y53NxMXQJHeHWtZP656PRiaTsFbnd6NGcUg09mR775xvYUOsQ/132' },
      // { avatarUrl: 'https://wx.qlogo.cn/mmhead/DMISX8wFsMv9zWvrd7lwFGM3XBZckjNvIXsXXCQzDOQ/132' },
      // { avatarUrl: 'https://wx.qlogo.cn/mmhead/sqQgKibuRZS9fbTG4dicGwu71smcttBupUgSwf01ly9Lo/132' },
      // { avatarUrl: 'https://wx.qlogo.cn/mmhead/FIXyyk7kSRh2FLYFibAceibaiaNMelkmlus6L0OTpDVRicM/132' },
      // { avatarUrl: 'https://wx.qlogo.cn/mmhead/1AxfZEb2lWrZL9J3CbhdFo3kbDtyn2vT4OCIcEqXWZU/132' },
    ], // 你的队员
    opponentTeamMembers: [], // 对方队员
    totalRightAnswer: 0, // 回答正确的题目数量(个人)
    yourRightAnswer: 0, // 回答正确的题目数量(团队)
    yourAnswerTime: 0, // 累计答题用时(团队)
    yourAnswerTimeText: '0\'0"', // 累计答题用时(团队)
    opponentRightAnswer: 0,
    opponentAnswerTime: 0,
    opponentAnswerTimeText: '0\'0"',
    subject: '', //当前题目名
    questionType: '', //题目类型
    questionTypeId: '', //题目类型ID
    questionImageUrl: '', //题目图片地址
    answerList: [], //当前题目答案选项
    questionIdList: [], //返回的本次挑战题目所有数据的ID
    questionIndex: 0, //当前答题数组下标
    yourAnswer: -1, // 用户选择的答案
    rightAnswer: -1, // 正确答案
    userAnswerResultClass: '', // 用户选择答案的样式
    userAnswerResult: [], // 用户答题结果记录，答对1，答错0
    showGameResult: false, // 是否显示游戏结果
    everyQuestionIntegral: 0, // 每道题答对可获得积分
    winnerIntegral: 0, // 获胜方可额外获得积分
    gainedIntegral: 0, // 本次挑战获得的积分
    leftSeconds: 20, // 倒计时总时间（秒）
    questionNo: '', // 题目编号
    questionNoStyle: 'display:none;', // 题目编号样式
    questionNoHidden: true, // 是否显示题目编号
    questionNoAnimData: {}, // 题目编号显示特效
    subjectAnimData: {}, // 题目显示特效
    answerAnimData: {}, // 答案显示特效
    isGameOver: false, // 挑战是否正常结束
    isRewardObtained: false, // 挑战结束后，用户是否领取了奖励
    isAnswerLoaded: false, // 答案是否加载完成（动画完成）
    propsDoubleIntegral: 0, // 积分翻倍卡数量
    propsJump: 0, // 跳跃卡数量
    joinedRoom: false, // 是否已加入房间
    heartbeatReplyRecvTime: 0, // 心跳回复接收时间（毫秒）
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
    let gameInfo = JSON.parse(options.gameInfo || '{}');

    // 初始动画
    var initAnimation = wx.createAnimation({
      duration: 500,
      timingFunction: 'linear'
    })
    initAnimation.opacity(0).scale(0, 0).step({
      duration: 0
    });
    count = 0; // 重置为0
    heartbeatCheckTimerId = null;
    this.getGameRules();
    this.setData({
      questionNoHidden: true,
      questionNoAnimData: initAnimation.export(),
      roomId: gameInfo.roomId,
      groupId: gameInfo.groupId,
      yourTeamMembers: gameInfo.yourTeamMembers,
      opponentTeamMembers: gameInfo.opponentTeamMembers,
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady() {
    // 保持屏幕常亮
    Utils.keepScreenOn();
    wx.hideShareMenu(); // 隐藏转发按钮
    let that = this;
    // 初始化连接
    that.connectWebSocket();
    that.drawCountdownBg();
    that.drawCountdownCircle();
    that.toast = that.selectComponent("#toast");
    toastTimerId = setInterval(() => {
      if (!toastInst && toastMessages.length > 0) {
        toastInst = that.toast.showToast(toastMessages.shift(), '', () => {
          toastInst = null;
        });
      }
    }, 500)
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {
    if (leaveGame && !this.data.isGameOver) {
      leaveGame = false;
      heartbeatCheckTimerId = null;
      this.connectWebSocket(); // 初始化连接
    }
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {
    leaveGame = true;
    wx.closeSocket(); // 关闭连接
    clearInterval(countdownId);
    clearInterval(heartbeatCheckTimerId);
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {
    let that = this;
    if (!that.data.isGameOver) {
      // 发送放弃挑战消息
      wx.sendSocketMessage({
        data: JSON.stringify({
          interfaceName: 'giveup',
          param: JSON.stringify({
            roomid: that.data.roomId,
          })
        })
      });
      Utils.showModal('提示', '您放弃了战斗!', () => {
        wx.navigateBack()
      });
    } else {
      if (!this.data.isRewardObtained) {
        this.updateUserIntegral();
      }
    }
    clearInterval(countdownId);
    clearInterval(heartbeatCheckTimerId);
    clearInterval(toastTimerId);
    wx.closeSocket();
  },

  /**获取比赛规则 */
  getGameRules() {
    let that = this;
    Utils.ajax(Config.service.questionUrl, {
      data: {
        interfaceName: 'rule',
        param: {}
      }
    }, res => {
      if (res.returnCode == 0) {
        // 如果获取成功，更新本地缓存
        wx.setStorageSync(Config.Keys.RULES, res.returnData);
      }

      // 规则-1007
      let gameRules = wx.getStorageSync(Config.Keys.RULES)['1007'];
      let awardRules = JSON.parse(gameRules['award']);
      that.setData({
        leftSeconds: gameRules['limit'],
        everyQuestionIntegral: Number(awardRules['one']),
        winnerIntegral: Number(awardRules['win']),
      })
    });
  },

  /**绘制倒计时背景 */
  drawCountdownBg() {
    var ctx = wx.createCanvasContext('countdownBgCanvas') // 使用 wx.createCanvasContext 获取绘图上下文context
    ctx.setLineWidth(10); // 设置圆环的宽度
    ctx.setStrokeStyle('#ffffff'); // 设置圆环的颜色
    ctx.setLineCap('round') // 设置圆环端点的形状
    ctx.beginPath(); //开始一个新的路径 
    ctx.arc(35, 35, 26, 0, 2 * Math.PI, false); //设置一个原点(100,100)，半径为90的圆的路径到当前路径
    ctx.stroke(); //对当前路径进行描边
    ctx.draw();
  },

  /**绘制倒计时圆环 */
  drawCountdownCircle(sAngle = START_ANGLE, eAngle = END_ANGLE, callback) {
    var context = wx.createCanvasContext('countdownCircleCanvas')
    var gradient = context.createLinearGradient(200, 100, 100, 200);
    gradient.addColorStop("0", "#2661DD");
    gradient.addColorStop("0.5", "#40ED94");
    gradient.addColorStop("1.0", "#5956CC");

    // 绘制圆环
    context.setStrokeStyle('#f2a955')
    context.beginPath()
    context.setLineWidth(8)
    context.arc(35, 35, 26, sAngle, eAngle, true)
    context.stroke()
    context.closePath()

    // 绘制倒计时文本
    context.beginPath()
    context.setLineWidth(1)
    context.setFontSize(24)
    context.setFillStyle('#ffffff')
    context.setTextAlign('center')
    context.setTextBaseline('middle')
    context.fillText((this.data.leftSeconds - count) + '', 35, 35, 26)
    context.fill()
    context.closePath()

    context.draw()

    typeof callback == 'function' && callback();
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
      that.initHeartbeat();
      // 如果尚未加入房间，发送加入房间消息
      if (!that.data.joinedRoom) {
        wx.sendSocketMessage({
          data: JSON.stringify({
            interfaceName: 'join',
            param: {
              roomid: that.data.roomId,
              groupid: that.data.groupId,
              nickname: App.globalData.nickName,
              avatarUrl: App.globalData.avatarUrl,
            }
          })
        })
      } else {
        console.log('发送对战场景恢复消息')
        wx.sendSocketMessage({
          data: JSON.stringify({
            interfaceName: 'gainscene',
            param: '{}'
          }),
        })
      }
    })
    wx.onSocketError(res => {
      clearInterval(heartbeatTimerId);
    })
    wx.onSocketClose(res => {
      clearInterval(heartbeatTimerId);
    })
    // 接收服务器消息
    wx.onSocketMessage(res => {
      var msg = JSON.parse(res.data);
      switch (msg.returnMessage) {
        case 'heart': // 心跳回复
          console.log('收到心跳回复');
          that.setData({
            heartbeatReplyRecvTime: new Date().getTime()
          })
          break;
        case 'joined':
          console.log('用户加入房间', res);
          that.setData({
            joinedRoom: true
          })
          break;
        case 'gainscene': // 恢复答题信息
          console.log('收到对战场景恢复消息', res);
          Utils.showToast('更新对战信息');
          if (msg.returnData.result) {
            msg.returnData.result.forEach(item => {
              // 恢复本队答题信息
              let sCostTime = Number(item.costtime).toFixed(2);
              if (item.groupid == that.data.groupId) {
                that.setData({
                  yourRightAnswer: item.rights,
                  yourAnswerTime: sCostTime,
                  yourAnswerTimeText: sCostTime.replace('.', '\'') + '"'
                })
              } else { // 对手答题信息
                that.setData({
                  opponentRightAnswer: item.rights,
                  opponentAnswerTime: sCostTime,
                  opponentAnswerTimeText: sCostTime.replace('.', '\'') + '"'
                })
              }
            })
          }
          // 恢复题目信息
          let questionInfo = msg.returnData.question;
          if (questionInfo && questionInfo.index != that.data.questionIndex) {
            that.showQuestion({
              questionIndex: questionInfo.index,
              type: questionInfo.type,
              typeid: questionInfo.typeid,
              question: questionInfo.question,
              url: questionInfo.url,
              answer: questionInfo.answer,
            });
            let answerInfo = questionInfo.curanswer;
            // 题目是否已抢答
            // if (answerInfo && answerInfo.isanswer) {
            //     if (answerInfo.openid != App.globalData.openid) {
            //         Utils.showToast(`【${answerInfo.nickname}】抢先回答了此题！`);
            //         that.setData({
            //             yourAnswer: answerInfo.answer,
            //             userAnswerResultClass: answerInfo.answer == that.data.rightAnswer ? 'right' : 'wrong',
            //         })
            //     }
            // }
          }
          break;
        case 'question': // 推送问题
          console.log('收到题目', res);
          let questionIndex = that.data.questionIndex + 1;
          that.showQuestion({
            questionIndex: questionIndex,
            type: msg.returnData.type,
            typeid: msg.returnData.typeid,
            question: msg.returnData.question,
            url: msg.returnData.url,
            answer: msg.returnData.answer,
          });
          break;
        case 'otherresult':
          console.log('收到对手答题结果', res);
          if (msg.returnData.groupid == that.data.groupId) { // 己方队伍答题结果
            if (msg.returnData.openid != App.globalData.openid) {
              toastMessages.push('第 ' + msg.returnData.index + ' 题\n『' + msg.returnData.nickname + '』选择答案 ' + answerIndexChar[msg.returnData.answer]);
            }
            // let sYourAnswerTime = (Number(msg.returnData.costtime) + Number(that.data.yourAnswerTime)).toFixed(2);
            let sYourAnswerTime = Number(msg.returnData.costtime).toFixed(2);
            let sYourTeamMembers = that.data.yourTeamMembers;
            let answerInfo = {};
            let answerTimeInfo = {};
            msg.returnData.rightArr.forEach(item => {
              answerInfo[item.openid] = item.right;
            })
            msg.returnData.costtimeArr.forEach(item => {
              answerTimeInfo[item.openid] = item.costtime;
            })
            sYourTeamMembers.forEach(item => {
              item['right'] = answerInfo[item.openid] || 0;
              item['costtime'] = Number(answerTimeInfo[item.openid] || 0).toFixed(2).replace('.', '\'') + '"';
            })

            that.setData({
              // yourAnswer: msg.returnData.answer,
              yourRightAnswer: msg.returnData.rights,
              // userAnswerResultClass: msg.returnData.answer == that.data.rightAnswer ? 'right' : 'wrong',
              yourAnswerTime: sYourAnswerTime,
              yourAnswerTimeText: sYourAnswerTime.replace('.', '\'') + '"',
              yourTeamMembers: sYourTeamMembers
            })
          } else { // 更新对方队伍答题结果
            // let sOpponentAnswerTime = (Number(msg.returnData.costtime) + Number(that.data.opponentAnswerTime)).toFixed(2);
            let sOpponentAnswerTime = Number(msg.returnData.costtime).toFixed(2);
            let sOpponentTeamMembers = that.data.opponentTeamMembers;
            let answerInfo = {};
            let answerTimeInfo = {};
            msg.returnData.rightArr.forEach(item => {
              answerInfo[item.openid] = item.right;
            })
            msg.returnData.costtimeArr.forEach(item => {
              answerTimeInfo[item.openid] = item.costtime;
            })
            sOpponentTeamMembers.forEach(item => {
              item['right'] = answerInfo[item.openid] || 0;
              item['costtime'] = Number(answerTimeInfo[item.openid] || 0).toFixed(2).replace('.', '\'') + '"';
            })

            that.setData({
              opponentRightAnswer: msg.returnData.rights,
              opponentAnswerTime: sOpponentAnswerTime,
              opponentAnswerTimeText: sOpponentAnswerTime.replace('.', '\'') + '"',
              opponentTeamMembers: sOpponentTeamMembers
            })
          }
          break;
        case 'end': // 结束
          console.log('比赛结束', res);
          clearInterval(countdownId);
          clearInterval(heartbeatTimerId);
          clearInterval(heartbeatCheckTimerId);
          wx.showToast({
            title: '比赛结束！',
            duration: 1500,
            image: '/static/images/info.png'
          })
          setTimeout(() => {
            let gainedIntegral = Number(msg.returnData.rights) * that.data.everyQuestionIntegral;
            if (msg.returnData.iswin) {
              gainedIntegral += that.data.winnerIntegral;
              that.setData({
                successful: true,
                isGameOver: true,
                gainedIntegral: gainedIntegral,
              })
            } else {
              that.setData({
                defeated: true,
                isGameOver: true,
                gainedIntegral: gainedIntegral,
              })
            }
          }, 2000)
          break;
      }
    });
  },

  /**显示题目 */
  showQuestion(data) {
    let that = this;
    clearInterval(countdownId);
    let questionIndex = data.questionIndex;
    that.setData({
      yourAnswer: -1,
      rightAnswer: -1,
      userAnswerResultClass: '',
      subject: '',
      answerList: [],
      questionImageUrl: '',
      isAnswerLoaded: false,
      questionType: data.type,
      questionTypeId: data.typeid,
      questionIndex: questionIndex,
      questionNo: '第' + questionIndex + '题',
    });

    count = 0;
    that.drawCountdownCircle();
    that.showQuestionNo(() => {
      that.setData({
        subject: data.question,
        questionImageUrl: data.url || '',
      });
      setTimeout(() => {
        // 取得正确答案
        var rightAnswer = -1;
        data.answer.forEach((item, index) => {
          if (item.right) {
            rightAnswer = index; // 正确答案
            return false;
          }
        })
        that.setData({
          rightAnswer: rightAnswer,
          answerList: data.answer,
        });
        setTimeout(() => {
          that.startCountdown(() => {
            answerStartTime = new Date().getTime();
            that.setData({
              isAnswerLoaded: true
            })
          });
        }, 500)
      }, 600)
    })
  },

  /**开启心跳定时发送 */
  initHeartbeat() {
    let that = this;
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
        param: '{}'
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
        Utils.showToast('连接断开，正在重连...');
        wx.closeSocket(); // 断开连接
        that.connectWebSocket(); // 重连
      }
    }, 3000)
  },

  /**显示当前是第几题 */
  showQuestionNo(callback) {
    this.setData({
      questionNoStyle: 'display:inline-block;',
    })

    setTimeout(() => {
      var animation = wx.createAnimation({
        duration: 500,
        timingFunction: 'linear'
      })

      animation.opacity(1).scale(1.4, 1.4).step({
        duration: 1000
      }).opacity(0).scale(0, 0).step({
        duration: 1500
      });
      this.setData({
        questionNoHidden: false,
        questionNoAnimData: animation.export()
      })

      setTimeout(() => {
        this.setData({
          questionNoHidden: true,
          questionNoStyle: 'display:none;',
        })
        typeof callback == 'function' && callback();
      }, 2500)
    }, 500)
  },

  /**开始倒计时 */
  startCountdown(callback) {
    let that = this;
    let step = 0; // 计数动画次数
    let sAngle = START_ANGLE; // 起始弧度，单位弧度（在3点钟方向）
    let eAngle = END_ANGLE; // 终止弧度

    // 动画函数
    function animation() {
      if (step < that.data.leftSeconds) {
        eAngle = eAngle + 2 * Math.PI / that.data.leftSeconds;
        that.drawCountdownCircle(sAngle, eAngle, () => {
          count++;
        });
        step++;
      } else {
        clearInterval(countdownId);

        if (that.data.yourAnswer == -1) {
          // 如果倒计时结束，用户还未选择答案，也算答错
          // 记录每道题答题结果
          var costtime = ((new Date().getTime() - answerStartTime) / 1000).toFixed(2);
          let userAnswerResult = that.data.userAnswerResult;
          userAnswerResult[that.data.questionIndex] = 0;
          let sYourAnswerTime = (Number(that.data.yourAnswerTime) + Number(costtime) - 1).toFixed(2);
          that.setData({
            userAnswerResult: userAnswerResult,
            yourAnswerTime: sYourAnswerTime,
            yourAnswerTimeText: sYourAnswerTime.replace('.', '\'') + '"'
          });

          // 发送答题结果
          wx.sendSocketMessage({
            data: JSON.stringify({
              interfaceName: 'answerresult',
              param: JSON.stringify({
                roomid: that.data.roomId,
                rights: that.data.yourRightAnswer,
                costtime: costtime,
                answer: -1,
                groupid: that.data.groupId,
                questionid: that.data.questionIndex,
              })
            })
          })
        }
      }
    };

    clearInterval(countdownId);
    countdownId = setInterval(animation, 1000);
    typeof callback == 'function' && callback();
  },

  /**答题并提交结果 */
  submitAnswer(event) {
    let that = this;
    if (that.data.isAnswerLoaded) { // 答案加载完成后才能答题
      // 用户选择的答案
      let yourAnswer = event.currentTarget.dataset.id;
      that.showAnswerResult(yourAnswer)
    }
  },

  /**显示答题结果 */
  showAnswerResult(yourAnswer, useJumpProps = false) {
    let that = this;
    // 答对的题目个数
    let totalRightAnswer = that.data.totalRightAnswer;
    if (that.data.rightAnswer == yourAnswer) {
      totalRightAnswer++;
    }

    // 播放声音
    if (App.globalData.gameVoiceEnabled) {
      if (that.data.rightAnswer == yourAnswer) {
        Utils.playRightVoice();
      } else {
        Utils.playWrongVoice();
      }
    }

    // 记录每道题答题结果
    let right = yourAnswer == that.data.rightAnswer;
    let userAnswerResult = that.data.userAnswerResult;
    userAnswerResult[that.data.questionIndex] = right ? 1 : 0;

    // 发送答题结果
    var costtime = ((new Date().getTime() - answerStartTime) / 1000).toFixed(2);
    wx.sendSocketMessage({
      data: JSON.stringify({
        interfaceName: 'answerresult',
        param: JSON.stringify({
          roomid: that.data.roomId,
          rights: totalRightAnswer,
          costtime: costtime,
          isright: right,
          answer: yourAnswer,
          typeid: that.data.questionTypeId,
          groupid: that.data.groupId,
          questionid: that.data.questionIndex,
        })
      })
    })

    let sYourAnswerTime = (Number(that.data.yourAnswerTime) + Number(costtime)).toFixed(2);
    that.setData({
      yourAnswer: yourAnswer,
      totalRightAnswer: totalRightAnswer,
      userAnswerResultClass: yourAnswer == that.data.rightAnswer ? 'right' : 'wrong',
      userAnswerResult: userAnswerResult,
      // yourAnswerTime: sYourAnswerTime,
      // yourAnswerTimeText: sYourAnswerTime.replace('.', '\'') + '"'
    });
  },

  /**更新用户积分 */
  updateUserIntegral(double, callback) {
    let that = this;
    Utils.ajax(Config.service.integralUrl, {
      data: {
        interfaceName: 'add',
        param: {
          openid: App.globalData.openid,
          number: that.data.gainedIntegral,
          double: double == true ? 1 : 0,
          ruletype: 1007,
          iswin: that.data.successful,
        }
      }
    }, res => {
      if (res.returnCode == 0) {
        typeof callback == 'function' && callback();
      } else {
        Utils.showModal('奖励领取失败！')
      }
    })
  },

  anotherGame() {
    let that = this;
    wx.navigateBack({
      delta: 2
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
  onShareAppMessage() {}
})