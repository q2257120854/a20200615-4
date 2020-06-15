/**
 *更多资源请关注三岁半资源网-sansuib.com
 * 小程序配置文件
 */
// const domain = "applet.taosf.xyz/answer-api"
const domain = "dati.beyond-itservice.com:8080/answer-api"
const baseUrl = `https://${domain}`

module.exports = {
  options: {
    // 是否显示题目动画
    qTitleAnimation: false,
  },
  Keys: {
    RULES: 'RULES',
    GAME_LEVEL: 'GAME_LEVEL',
    GROUP_PLAYERS: 'GROUP_PLAYERS',
    SETTING_RECV_MESSAGE: 'SETTING_RECV_MESSAGE',
    SETTING_GAME_VOICE: 'SETTING_GAME_VOICE',
  },
  service: {
    appId: 'wx93f5346ce47f3cd6',
    loginUrl: `${baseUrl}/weixin`,
    questionUrl: `${baseUrl}/question`,
    // wsUrl: `ws://taosf.xyz:20001/answer-api/websocket`,
    wsUrl: `wss://dati.beyond-itservice.com:8080/answer-api/websocket`,
    userUrl: `${baseUrl}/user`,
    roomUrl: `${baseUrl}/room`,
    integralUrl: `${baseUrl}/integral`,
    friendUrl: `${baseUrl}/friend`,
    rankUrl: `${baseUrl}/rank`,
    noticeUrl: `${baseUrl}/notice`,
    activityUrl: `${baseUrl}/activity`,
    signInUrl: `${baseUrl}/signature`,
    propsUrl: `${baseUrl}/props`,
    seasonUrl: `${baseUrl}/season`,
    shareUrl: `${baseUrl}/share`,
    gameLevelUrl: `${baseUrl}/dan`,
    questionTypeUrl: `${baseUrl}/questiontype`,
    questionCorrectionUrl: `${baseUrl}/answer/question/correction`,
  },
};