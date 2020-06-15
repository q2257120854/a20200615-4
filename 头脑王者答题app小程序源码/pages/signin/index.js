// pages/signin/index.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        weekSignIn: [], // 本周签到的记录
        currWeekDay: new Date().getDay() == 0 ? 6 : (new Date().getDay() - 1), // 今天是周几（周一从0开始,因为周日默认为0，这里设置为6）
        todayIntegral: 0, // 今天签到可以获得积分
        everydayIntegral: [50, 100, 200, 200, 200, 200, 200], // 连续签到时，每天可以获得的积分
        actualEverydayIntegral: [], // 实际签到所获得的积分
        signInDays: 0, // 已连续签到的天数
        propsMap: {
            '1': '积分翻倍卡',
            '2': '难题跳跃卡'
        }, // 道具卡说明
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad(options) {
        Utils.showLoading()
        this.getSignInInfo(() => {
            Utils.hideLoading()
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

    /**签到 */
    doSignIn(event) {
        let that = this;
        if (!event.currentTarget.dataset.disable) {
            Utils.showLoading('正在签到...');
            Utils.ajax(Config.service.signInUrl, {
                data: {
                    interfaceName: 'userSignature',
                    param: {
                        openid: App.globalData.openid
                    }
                }
            }, res => {
                if (res.returnCode == 1016) {
                    Utils.showModal('提示', '您今天已签到')
                } else {
                    let propsText = ''; // 奖励道具
                    if (res.returnData.award) {
                        propsText = '和【' + that.data.propsMap[res.returnData.award] + '（x1）】';
                    }

                    Utils.showModal('提示', `签到成功！您共获得${res.returnData.score}积分${propsText}。`)
                    that.getSignInInfo();
                }
                Utils.hideLoading();
            })
        }
    },

    /**获取签到信息 */
    getSignInInfo(callback) {
        let that = this;
        Utils.ajax(Config.service.signInUrl, {
            data: {
                interfaceName: 'userSignatureList',
                param: {
                    openid: App.globalData.openid
                }
            }
        }, res => {
            // let weekSignIn = Array(7).fill(0);
            // let actualEverydayIntegral = Array(7).fill(0);
            // let signInOff = false;// 是否存在漏签的情况
            // let signInOffIndex = 0;
            // if (res.returnData && res.returnData.length > 0) {
            //     res.returnData.forEach((item, index) => {
            //         weekSignIn[index] = item;
            //         if (signInOff) {
            //             actualEverydayIntegral[index] = that.data.everydayIntegral[index - signInOffIndex - 1];
            //         } else {
            //             if (index == 0) {
            //                 actualEverydayIntegral[index] = that.data.everydayIntegral[index];
            //             } else if (weekSignIn[index - 1] == 0) {
            //                 signInOff = true;
            //                 signInOffIndex = index;
            //                 actualEverydayIntegral[index] = that.data.everydayIntegral[0];
            //             } else {
            //                 actualEverydayIntegral[index] = that.data.everydayIntegral[index];
            //             }
            //         }

            //     })
            //     if (signInOffIndex < 7) {
            //         for (var i = res.returnData.length; i < 7; i++) {
            //             actualEverydayIntegral[i] = that.data.everydayIntegral[i - 2];
            //         }
            //     }
            //     console.log('actualEverydayIntegral', actualEverydayIntegral)
            // }
            if (res.returnCode == 0) {
                that.setData({
                    weekSignIn: res.returnData.arr,
                    todayIntegral: res.returnData.score,
                    signInDays: res.returnData.days,
                })
            }
            typeof callback == 'function' && callback();
        })
    },

    /**
     * 页面相关事件处理函数--监听用户下拉动作
     */
    onPullDownRefresh() {
        wx.showNavigationBarLoading();
        this.getSignInInfo(() => {
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