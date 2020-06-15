// pages/personal/introduction.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        gameLevelList: [],
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad(options) {
        let gameLevel = wx.getStorageSync(Config.Keys.GAME_LEVEL) || [];
        let gameLevelList = [];
        gameLevel.sort((s, t) => {
            return s.level > t.level ? -1 : (s.level == t.level ? 0 : 1)
        }).forEach(item => {
            gameLevelList.push({
                name: item.name,
                integral: item.score,
                image: `/static/images/level${item.level}.png`
            })
        })
        this.setData({
            gameLevelList: gameLevelList,
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
    onShow() {},

    /**
     * 生命周期函数--监听页面隐藏
     */
    onHide() {},

    /**
     * 生命周期函数--监听页面卸载
     */
    onUnload() {},

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