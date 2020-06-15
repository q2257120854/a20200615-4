// pages/ranking/index.js
const App = getApp();
const Config = require('../../config.js');
const Utils = require('../../static/js/utils.js');

const INTERFACE_NAMES = ['all', 'challenge', 'rank', 'friend', 'group']; // 接口名称
const PAGES = []; // 当前第几页（包含所有tab）
const TABS_INIT_STATE = []; // tab数据是否加载的状态
const PAGESIZE = 10; // 默认每页显示数量

Page({

    /**
     * 页面的初始数据
     */
    data: {
        currentTab: 0,
        swiperHeight: Utils.WIN_HEIGHT - 50,
        nameWidth: Utils.WIN_WIDTH - 125,
        allRankingList: [], // 总榜
        dailyRankingList: [], // 每日答题
        rankingList: [], // 排位赛
        friendRankingList: [], // 好友对战
        teamRankingList: [], // 团队赛
        gameLevel: App.globalData.gameLevelMap,
        isLoading: false,
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad(options) {
        for (let i = 0; i < INTERFACE_NAMES.length; i++) {
            PAGES[i] = 1;
            TABS_INIT_STATE[i] = false;
        }
    },

    /**
     * 生命周期函数--监听页面初次渲染完成
     */
    onReady() {
        wx.hideShareMenu(); // 隐藏转发按钮
        this.initTabContent(this.data.currentTab)
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

    onScrollToLower(e) {
        let that = this;
        PAGES[this.data.currentTab] += 1
        that.getRankingData(that.data.currentTab)
    },

    /**滑动切换 */
    swiperTab(e) {
        this.initTabContent(e.detail.current)
    },

    /**点击切换 */
    clickTab(e) {
        let tabIndex = Number(e.currentTarget.dataset.current)
        if (this.data.currentTab != tabIndex) {
            this.initTabContent(tabIndex)
        }
    },

    /**初始化tab内容 */
    initTabContent(tabIndex) {
        this.setData({
            currentTab: tabIndex
        });
        if (!TABS_INIT_STATE[tabIndex]) {
            !this.data.isLoading && this.getRankingData(tabIndex, () => {
                TABS_INIT_STATE[tabIndex] = true; // 更新状态
            });
        }
    },

    /**获取排行榜数据 */
    getRankingData(tabIndex, callback) {
        let that = this;
        that.setData({
            isLoading: true
        })
        Utils.showLoading();
        Utils.ajax(Config.service.rankUrl, {
            data: {
                interfaceName: INTERFACE_NAMES[tabIndex],
                param: {
                    openid: App.globalData.openid,
                    page: PAGES[tabIndex],
                    pagesize: PAGESIZE,
                }
            }
        }, res => {
            if (res.returnCode == 0) {
                let rankingList = res.returnData.rank;
                if (rankingList.length > 0) {
                    switch (tabIndex) {
                        case 0: // 总榜
                            if (PAGES[tabIndex] > 1) {
                                rankingList = that.data.allRankingList.concat(rankingList);
                            }
                            that.setData({
                                allRankingList: rankingList
                            })
                            break;
                        case 1: // 每日答题
                            if (PAGES[tabIndex] > 1) {
                                rankingList = that.data.dailyRankingList.concat(rankingList);
                            }
                            that.setData({
                                dailyRankingList: rankingList
                            })
                            break;
                        case 2: // 排位赛
                            if (PAGES[tabIndex] > 1) {
                                rankingList = that.data.rankingList.concat(rankingList);
                            }
                            that.setData({
                                rankingList: rankingList
                            })
                            break;
                        case 3: // 好友对战
                            if (PAGES[tabIndex] > 1) {
                                rankingList = that.data.friendRankingList.concat(rankingList);
                            }
                            that.setData({
                                friendRankingList: rankingList
                            })
                            break;
                        case 4: // 团队赛
                            if (PAGES[tabIndex] > 1) {
                                rankingList = that.data.teamRankingList.concat(rankingList);
                            }
                            that.setData({
                                teamRankingList: rankingList
                            })
                            break;
                    }
                } else {
                    PAGES[this.data.currentTab] -= 1
                }
            }
            setTimeout(() => {
                wx.hideLoading();
                this.setData({
                    isLoading: false,
                })
            }, 1800)
            typeof callback == 'function' && callback();
        })
    },

    /**
     * 页面相关事件处理函数--监听用户下拉动作
     */
    onPullDownRefresh() {
        wx.showNavigationBarLoading()
        PAGES[this.data.currentTab] = 1
        this.getRankingData(this.data.currentTab, () => {
            wx.hideNavigationBarLoading();
            wx.stopPullDownRefresh();
        })
    },

    /**
     * 页面上拉触底事件的处理函数
     */
    onReachBottom() {
        PAGES[this.data.currentTab] += 1
        this.getRankingData(this.data.currentTab)
    },

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage() {}
})