// pages/personal/index.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
const moment = require('../../static/js/moment.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        gameLevelList: [], // 游戏段位信息
        userIntegral: 0, // 用户当前积分
        userLevel: 1, // 当前段位
        starCount: 0, // 星星数量
        seasonId: '', // 赛季活动ID
        seasonTitle: '...', // 赛季标题
        seasonSubtitle: '...', // 赛季副标题
        seasonStartDate: '...', // 活动开始时间
        seasonEndDate: '', // 活动结束时间
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
        this.getSeasonInfo();
        Utils.showLoading();
    },

    /**
     * 生命周期函数--监听页面显示
     */
    onShow() {
        this.getUserInfo();
    },

    /**
     * 生命周期函数--监听页面隐藏
     */
    onHide() {},

    /**
     * 生命周期函数--监听页面卸载
     */
    onUnload() {},

    /**获取用户信息 */
    getUserInfo() {
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
            let userIntegral = 0;
            if (res.returnCode == 0) {
                level = res.returnData.level;
                userIntegral = res.returnData.integral;
                App.globalData.integral = userIntegral; // 更新全局值
            }

            let gameLevelList = [];
            Object.keys(App.globalData.gameLevelMap).forEach(key => {
                let levelInfo = {
                    value: Number(key)
                };
                gameLevelList.push(Object.assign(levelInfo, App.globalData.gameLevelMap[key]))
            })
            that.setData({
                userLevel: level,
                userIntegral: userIntegral,
                gameLevelList: gameLevelList,
                starCount: res.returnData.star || 0
            })
            Utils.hideLoading();
        })
    },

    /**获取赛季活动详情 */
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
            if (res.returnCode == 0 && res.returnData && res.returnData.length > 0) {
                let record = res.returnData[0];
                that.setData({
                    seasonId: record['id'],
                    seasonTitle: record['headline'],
                    seasonSubtitle: record['subhead'],
                    seasonStartDate: moment(record['starttime']).format('YYYY年MM月DD日'),
                    seasonEndDate: moment(record['endtime']).format('YYYY年MM月DD日'),
                })
            }
        })
    },

    /**介绍 */
    showIntro() {
        wx.navigateTo({
            url: "../personal/introduction"
        });
    },

    /**开始比赛 */
    startGame(event) {
        let seasonId = this.data.seasonId;
        let selectLevel = event.currentTarget.dataset.level;
        if (selectLevel <= this.data.userLevel) {
            wx.navigateTo({
                url: `../personal/match?seasonId=${seasonId}&level=${selectLevel}`
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