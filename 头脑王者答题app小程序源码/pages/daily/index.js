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
        maxIntegral: 0, // 连续答对可以获得的积分
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad(options) {},

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
        Utils.showLoading();
        this.getAnswerTimes();
        this.getGameRules();
    },

    /**
     * 生命周期函数--监听页面隐藏
     */
    onHide() {},

    /**
     * 生命周期函数--监听页面卸载
     */
    onUnload() {},

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

            try {
                // 规则-1004
                let gameRules = wx.getStorageSync(Config.Keys.RULES)['1004'];
                let award = JSON.parse(gameRules['award']);
                let questions = JSON.parse(gameRules['questions']);
                let questionCount = 0;
                Object.keys(questions).forEach(key => {
                    questionCount += Number(questions[key]);
                })
                this.setData({
                    maxIntegral: Number(award['one']) * questionCount + Number(award['continuous']) * (questionCount - 1)
                })
            } catch (err) {
                // 忽略错误，不做任何处理
            }
        });
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
                if (res.returnData && res.returnData['1004']) {
                    that.setData({
                        availableTimes: res.returnData['1004'] < 0 ? 0 : res.returnData['1004']
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
                url: "../daily/play"
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