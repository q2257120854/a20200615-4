// pages/notice/index.js
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        contentHeight: Utils.WIN_HEIGHT, // 内容高度
        noticeList: [], // 公告列表
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
        this.getNoticeList();
    },

    /**
     * 生命周期函数--监听页面隐藏
     */
    onHide() {},

    /**
     * 生命周期函数--监听页面卸载
     */
    onUnload() {},

    /**获取公告列表 */
    getNoticeList(callback) {
        let that = this;
        Utils.ajax(Config.service.noticeUrl, {
            data: {
                interfaceName: 'list'
            }
        }, res => {
            that.setData({
                noticeList: res.returnData || []
            })
            typeof callback == 'function' && callback();
            Utils.hideLoading();
        })
    },

    /**
     * 页面相关事件处理函数--监听用户下拉动作
     */
    onPullDownRefresh() {
        wx.showNavigationBarLoading();
        this.getNoticeList(() => {
            wx.stopPullDownRefresh();
            wx.hideNavigationBarLoading();
        })
    },

    /**
     * 页面上拉触底事件的处理函数
     */
    onReachBottom() {},

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage() {}
})