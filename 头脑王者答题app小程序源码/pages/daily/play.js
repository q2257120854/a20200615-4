// pages/daily/play.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
const START_ANGLE = 1.5 * Math.PI; // 起始弧度，单位弧度（在3点钟方向）
const END_ANGLE = -0.5 * Math.PI; // 终止弧度
let countdownId = null; // 答题倒计时计时器ID
let count = 0; // 倒计时累计秒数

Page({

  /**
   * 页面的初始数据
   */
  data: {
    answerAwardRules: {}, // 奖励规则
    subject: '', //当前题目名
    questionType: '', //题目类型
    questionTypeId: '', //题目类型ID
    questionId: '', // 当前题目ID
    questionImageUrl: '', //题目图片地址
    answerList: [], //当前题目答案选项
    questionIdList: [], //返回的本次挑战题目所有数据的ID
    questionIndex: 0, //当前答题数组下标
    userAnswer: -1, // 用户选择的答案
    rightAnswer: -1, // 正确答案
    userAnswerResultClass: '', // 用户选择答案的样式
    userAnswerResult: [], // 用户答题结果记录，答对1，答错0
    showGameResult: false, // 是否显示游戏结果
    gainedIntegral: 0, // 本次挑战获得的积分
    leftSeconds: 20, // 倒计时总时间（秒）
    questionNo: '', // 题目编号
    questionNoStyle: 'display:none;', // 题目编号样式
    questionNoHidden: true, // 是否显示题目编号
    questionNoAnimData: {}, // 题目编号显示特效
    subjectAnimData: {}, // 题目显示特效
    answerAnimData: {}, // 答案显示特效
    isGameOver: false, // 挑战是否正常结束
    getRewardButtonClicked: false, // 挑战结束后，用户是否点击了“领取奖励”按钮
    isAnswerLoaded: false, // 答案是否加载完成（动画完成）
    propsDoubleIntegral: 0, // 积分翻倍卡数量
    propsJump: 0, // 跳跃卡数量
    correctionBtnHidden: true, // 是否隐藏纠错按钮
    errorOpsHidden: true, //是否隐藏错误选项
    opsClass: 'fadeInUp',
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad(options) {
    // 初始动画
    var initAnimation = wx.createAnimation({
      duration: 500,
      timingFunction: 'linear'
    })
    initAnimation.opacity(0).scale(0, 0).step({
      duration: 0
    });
    count = 0; // 重置为0
    this.getGameRules();
    this.setData({
      questionNoHidden: true,
      questionNoAnimData: initAnimation.export(),
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady() {
    wx.hideShareMenu(); // 隐藏转发按钮
    setTimeout(() => {
      this.drawCountdownBg();
      this.drawCountdownCircle();
    }, 500)
    this.initQuestion();
    this.getProps();
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow() {},

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide() {},

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload() {
    // 返回后，关闭计时器，避免后台继续调用题目接口
    clearInterval(countdownId);
    if (this.data.isGameOver) {
      // 如果用户忘记了“领取奖励”，在页面退出之前，自动进行领取
      if (!this.data.getRewardButtonClicked) {
        this.updateUserIntegral();
      }
    } else {
      // 提前退出，不能获取任何奖励
      Utils.showModal('提示', '您放弃了挑战!');
    }
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

      // 规则-1004
      let gameRules = wx.getStorageSync(Config.Keys.RULES)['1004'];
      that.setData({
        leftSeconds: gameRules['limit'],
        answerAwardRules: JSON.parse(gameRules['award']),
      })
    }, error => {
      that.getGameRules();
    });
  },

  /**获取道具信息 */
  getProps() {
    let that = this;
    Utils.ajax(Config.service.propsUrl, {
      data: {
        interfaceName: 'propsList',
        param: {
          openid: App.globalData.openid
        }
      }
    }, res => {
      if (res.returnCode == 0) {
        res.returnData.forEach(item => {
          if (item.type == 1) {
            that.setData({
              propsDoubleIntegral: item.sum
            })
          } else if (item.type == 2) {
            that.setData({
              propsJump: item.sum
            })
          }
        })
      }
    }, error => {
      that.getProps();
    })
  },

  /**绘制倒计时背景 */
  drawCountdownBg() {
    var ctx = wx.createCanvasContext('countdownBgCanvas') // 使用 wx.createCanvasContext 获取绘图上下文context
    ctx.setLineWidth(14); // 设置圆环的宽度
    ctx.setStrokeStyle('#ffffff'); // 设置圆环的颜色
    ctx.setLineCap('round') // 设置圆环端点的形状
    ctx.beginPath(); //开始一个新的路径 
    ctx.arc(36, 36, 26, 0, 2 * Math.PI, false); //设置一个原点(100,100)，半径为90的圆的路径到当前路径
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
    context.setLineWidth(10)
    context.arc(36, 36, 26, sAngle, eAngle, true)
    context.stroke()
    context.closePath()

    // 绘制倒计时文本
    context.beginPath()
    context.setLineWidth(1)
    context.setFontSize(20)
    context.setFillStyle('#ffffff')
    context.setTextAlign('center')
    context.setTextBaseline('middle')
    context.fillText((this.data.leftSeconds - count) + '', 36, 36, 26)
    context.fill()
    context.closePath()

    context.draw()

    typeof callback == 'function' && callback();
  },

  /**显示当前是第几题 */
  showQuestionNo(callback) {
    this.setData({
      questionNoStyle: 'display:inline-block;',
      errorOpsHidden: true,
    })

    var animation = wx.createAnimation({
      duration: 500,
      timingFunction: 'linear'
    })
    if (Config.options.qTitleAnimation) {
      setTimeout(() => {
        animation.opacity(1).scale(1.4, 1.4).step({
          duration: 1000
        }).opacity(0).scale(0, 0).step({
          duration: 1500
        });
        this.setData({
          questionNoHidden: false,
          questionNoAnimData: animation.export(),
          correctionBtnHidden: true,
        })

        setTimeout(() => {
          this.setData({
            questionNoHidden: true,
            questionNoStyle: 'display:none;',
            correctionBtnHidden: false,
          })
          typeof callback == 'function' && callback();
        }, 2500)
      }, 500)
    } else { // 无动画
      animation.opacity(1).scale(1, 1).step({
        duration: 100
      });
      this.setData({
        questionNoHidden: false,
        questionNoAnimData: animation.export(),
        correctionBtnHidden: true,
      })
      setTimeout(() => {
        this.setData({
          questionNoHidden: true,
          questionNoStyle: 'display:none;',
          correctionBtnHidden: false,
        })
        typeof callback == 'function' && callback();
      }, 1000)
    }
  },

  /**初始化题目 */
  initQuestion() {
    let that = this;
    Utils.ajax(Config.service.questionUrl, {
      data: {
        interfaceName: 'init',
        param: {
          openid: App.globalData.openid
        }
      }
    }, res => {
      if (res.returnCode == 0) {
        that.setData({
          questionNo: '第' + (that.data.questionIndex + 1) + '题',
          questionType: res.returnData.type,
          questionTypeId: res.returnData.typeid,
        });
        that.showQuestionNo(() => {
          that.setData({
            subject: res.returnData.question,
            questionImageUrl: res.returnData.url || '',
            questionIdList: res.returnData.questionids,
            questionId: res.returnData.questionid,
          });
          setTimeout(() => {
            that.setData({
              answerList: res.returnData.answer,
            });
            setTimeout(() => {
              that.startCountdown(() => {
                that.setData({
                  isAnswerLoaded: true
                })
              });
            }, 500)
          }, 600)
        })
      }
    }, error => {
      that.initQuestion();
    })
  },

  /**获取下一道题目 */
  getNextQuestion() {
    let that = this;
    // 题目数组下标
    let questionIndex = that.data.questionIndex + 1;
    // 避免出现多余的题目
    if (questionIndex >= that.data.questionIdList.length) {
      that.gameOver();
    } else {
      let nextQuestionId = that.data.questionIdList[questionIndex];
      that.doGetNextQuestion(questionIndex, nextQuestionId);
    }
  },
  doGetNextQuestion(questionIndex, nextQuestionId) {
    let that = this;
    Utils.ajax(Config.service.questionUrl, {
      data: {
        interfaceName: 'get',
        param: {
          questionid: nextQuestionId
        }
      }
    }, res => {
      count = 0;
      that.drawCountdownCircle();
      let questionNo = '第' + (questionIndex + 1) + '题';
      if (questionIndex == that.data.questionIdList.length - 1) {
        questionNo = '最后一题'
      }
      that.setData({
        userAnswer: -1,
        userAnswerResultClass: '',
        subject: '',
        answerList: [],
        questionImageUrl: '',
        isAnswerLoaded: false,
        questionType: res.returnData.type,
        questionTypeId: res.returnData.typeid,
        questionIndex: questionIndex,
        questionNo: questionNo,
        questionId: res.returnData.questionid,
      });

      setTimeout(() => {
        that.showQuestionNo(() => {
          that.setData({
            subject: res.returnData.question,
            questionImageUrl: res.returnData.url || ''
          });
          setTimeout(() => {
            that.setData({
              answerList: res.returnData.answer,
            });
            setTimeout(() => {
              that.startCountdown(() => {
                that.setData({
                  isAnswerLoaded: true
                })
              });
            }, 1000)
          }, 600)
        })
      }, 200)
    }, error => {
      that.doGetNextQuestion(questionIndex, nextQuestionId);
    })
  },

  /**答题并提交结果 */
  submitAnswer(event) {
    let that = this;
    if (that.data.isAnswerLoaded) { // 答案加载完成后才能答题
      // 用户选择的答案
      let userAnswer = event.currentTarget.dataset.id;
      that.showAnswerResult(userAnswer)
    }
  },

  /**显示答题结果 */
  showAnswerResult(userAnswer, useJumpProps = false) {
    let that = this;
    clearInterval(countdownId); // 清除计时器

    // 取得正确答案
    var rightAnswer = -1;
    that.data.answerList.forEach((item, index) => {
      if (item.right) {
        // 正确答案
        rightAnswer = index;
        return false;
      }
    })

    // 如果使用了跳跃卡，自动答对此题
    if (useJumpProps) {
      userAnswer = rightAnswer;
    }

    // 播放声音
    if (App.globalData.gameVoiceEnabled) {
      if (rightAnswer == userAnswer) {
        Utils.playRightVoice();
      } else {
        Utils.playWrongVoice();
      }
    }

    // 记录每道题答题结果
    let right = userAnswer == rightAnswer;
    let userAnswerResult = that.data.userAnswerResult;
    userAnswerResult[that.data.questionIndex] = right ? 1 : 0;

    that.setData({
      userAnswer: userAnswer,
      rightAnswer: rightAnswer,
      userAnswerResultClass: userAnswer == rightAnswer ? 'right' : 'wrong',
      userAnswerResult: userAnswerResult,
    });
    // 提交答案至后台
    that.submitAnswerToServer(userAnswer == rightAnswer, function() {
      // 最后一题
      if (that.data.questionIndex + 1 >= that.data.questionIdList.length) {
        that.gameOver();
      } else {
        setTimeout(() => {
          that.getNextQuestion();
        }, 1500)
      }
    });
  },

  /**提交答案给后台 */
  submitAnswerToServer(isRightAnswer, callback) {
    let that = this;
    Utils.ajax(Config.service.questionUrl, {
      data: {
        interfaceName: 'answer',
        param: {
          openid: App.globalData.openid,
          type: that.data.questionTypeId,
          isright: isRightAnswer ? 1 : 0,
        }
      }
    }, res => {
      typeof callback == 'function' && callback();
    }, error => {
      that.submitAnswerToServer(isRightAnswer, callback)
    })
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

        // 如果倒计时结束，用户还未选择答案，也算答错
        // 记录每道题答题结果
        let userAnswerResult = that.data.userAnswerResult;
        userAnswerResult[that.data.questionIndex] = 0;
        that.setData({
          userAnswerResult: userAnswerResult,
        });

        that.submitAnswerToServer(false);

        // 最后一题
        if (that.data.questionIndex + 1 >= that.data.questionIdList.length) {
          that.gameOver();
        } else {
          setTimeout(() => {
            that.getNextQuestion();
          }, 1000)
        }
      }
    };

    clearInterval(countdownId);
    countdownId = setInterval(animation, 1000);
    typeof callback == 'function' && callback();
  },

  /**比赛结束 */
  gameOver() {
    let that = this;
    that.calculateIntegral(); // 计算挑战积分
    setTimeout(() => {
      that.setData({
        isGameOver: true,
        showGameResult: true,
        correctionBtnHidden: true,
      })
    }, 1000)
  },

  /**跳过此题（使用跳跃卡） */
  jumpThisQuestion() {
    let that = this;
    if (that.data.propsJump <= 0) {
      Utils.showModal('提示', '跳跃卡数量不足')
    } else {
      Utils.ajax(Config.service.propsUrl, {
        data: {
          interfaceName: 'use',
          param: {
            openid: App.globalData.openid,
            type: '2'
          }
        }
      }, res => {
        if (res.returnCode == 0) {
          that.showAnswerResult(-1, true)
          that.getProps(); // 刷新道具数量
        } else {
          wx.showToast({
            title: res.returnCode == 1017 ? '跳跃卡数量不足' : '道具使用失败',
          })
        }
      })
    }
  },

  /**领取奖励 */
  getReward(event) {
    let double = event.currentTarget.dataset.double;
    if (double == true && this.data.propsDoubleIntegral == 0) {
      Utils.showModal('提示', '翻倍卡数量不足')
    } else {
      this.setData({
        getRewardButtonClicked: true
      })
      Utils.showLoading('正在领取...');
      this.updateUserIntegral(double, () => {
        Utils.hideLoading();
        Utils.showModal('提示', '奖励领取成功！', () => {
          wx.navigateBack();
        })
      });
    }
  },

  /**计算积分 */
  calculateIntegral() {
    let answerResult = this.data.userAnswerResult;
    let singleIntegral = Number(this.data.answerAwardRules['one']); // 每题答对可得积分
    let continuousIntegral = Number(this.data.answerAwardRules['continuous']); // 连续答对一题可得的额外积分
    let gainedIntegral = 0; //本次答题获得总积分
    let rightCount = 0; // 连续答对的题目数（从2开始算）
    answerResult.forEach((result, index) => {
      if (result == 1) {
        gainedIntegral += singleIntegral;
      }

      if (index == 0) {
        if (result == 1) {
          rightCount++;
        }
      } else {
        if (answerResult[index - 1] == 1 && result == 1) { // 上一题对，本题也对才算作连续对
          rightCount++;
          if (rightCount > 1) {
            gainedIntegral += continuousIntegral;
          }
        } else if (result == 1) { // 本题对，+1
          rightCount++;
        } else { // 否则置为0
          rightCount = 0;
        }
      }
    })
    this.setData({
      gainedIntegral: gainedIntegral
    })
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
          ruletype: 1004,
          iswin: true,
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

  /**显示错误选项 */
  showErrorOps() {
    this.setData({
      opsClass: 'fadeInUp',
      errorOpsHidden: false
    })
  },

  /**上报错误 */
  submitError(event) {
    let that = this;
    let content = event.currentTarget.dataset.content;
    Utils.ajax(Config.service.questionCorrectionUrl, {
      data: {
        interfaceName: 'submit',
        param: {
          openid: App.globalData.openid,
          questionid: that.data.questionId,
          description: content,
        }
      }
    }, res => {
      if (res.returnCode == 0) {
        Utils.showToast('上报成功')
      }
    })

    this.setData({
      opsClass: 'fadeOutDown',
    })
    setTimeout(() => {
      this.setData({
        errorOpsHidden: true,
      })
    }, 500)
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