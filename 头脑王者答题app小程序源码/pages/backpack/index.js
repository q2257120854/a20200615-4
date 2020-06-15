// pages/backpack/index.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        propsMap: {
            '1': {
                image: '/static/images/props-double.png',
                textBgColor: '#ff6f18'
            },
            '2': {
                image: '/static/images/props-jump.png',
                textBgColor: '#259b24'
            }
        }, // 道具图片
        contentHeight: Utils.WIN_HEIGHT,
        propsDialogShown: false, // 是否显示道具说明对话框
        propsList: [], // 道具列表
        propsName: '', // 道具名称
        propsDescription: '' // 道具描述文本
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
        this.getPropsList();
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

    /**获取道具列表 */
    getPropsList(callback) {
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
                if (res.returnData.length == 0) {
                    Utils.showModal('提示', '您还没有获得任何道具！完成每日签到有机会获得道具。')
                } else {
                    that.setData({
                        propsList: res.returnData
                    })
                }
            }
            typeof callback == 'function' && callback();
        })
    },

    /**显示道具说明提示框 */
    showPropsDialog(e) {
        let dataset = e.currentTarget.dataset;
        this.setData({
            propsName: dataset.name || '',
            propsDescription: dataset.description || '',
            propsDialogShown: dataset.show
        });
    },

    /**
     * 页面相关事件处理函数--监听用户下拉动作
     */
    onPullDownRefresh() {
        wx.showNavigationBarLoading();
        this.getPropsList(() => {
            wx.hideNavigationBarLoading();
            wx.stopPullDownRefresh();
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