// 系统参数
const systemInfo = wx.getSystemInfoSync();
// 答对音效
const answerRightAudio = wx.createInnerAudioContext();
answerRightAudio.autoplay = false;
answerRightAudio.src = 'https://quwantuan.cn/sound/right.wav';
// 答错音效
const answerWrongAudio = wx.createInnerAudioContext();
answerWrongAudio.autoplay = false;
answerWrongAudio.src = 'https://quwantuan.cn/sound/wrong.mp3';
// 进入房间音效
const roomAudio = wx.createInnerAudioContext();
roomAudio.autoplay = false;
roomAudio.loop = true;
roomAudio.src = 'https://quwantuan.cn/sound/room.mp3';

const formatTime = date => {
  const year = date.getFullYear()
  const month = date.getMonth() + 1
  const day = date.getDate()
  const hour = date.getHours()
  const minute = date.getMinutes()
  const second = date.getSeconds()

  return [year, month, day].map(formatNumber).join('/') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

const formatNumber = n => {
  n = n.toString()
  return n[1] ? n : '0' + n
}

module.exports = {
  WIN_WIDTH: systemInfo.screenWidth,
  WIN_HEIGHT: systemInfo.screenHeight,
  IS_IOS: /ios/i.test(systemInfo.system),
  IS_ANDROID: /android/i.test(systemInfo.system),
  STATUS_BAR_HEIGHT: systemInfo.statusBarHeight,
  DEFAULT_HEADER_HEIGHT: 46, // systemInfo.screenHeight - systemInfo.windowHeight - systemInfo.statusBarHeight
  DEFAULT_CONTENT_HEIGHT: systemInfo.screenHeight - systemInfo.statusBarHeight - wx.DEFAULT_HEADER_HEIGHT,
  IS_APP: true,
  /**网络请求 */
  ajax(url, options, success, fail) {
    options = options || {};
    wx.request({
      url: url,
      method: options.type || 'post',
      dataType: options.dataType || 'json',
      data: options.data || {},
      success: function(res) {
        typeof success == 'function' && success(res.data);
      },
      fail: function(error) {
        console.log('请求失败', error);
        typeof fail == 'function' && fail(error);
      }
    })
  },
  /**显示模态对话框 */
  showModal(title, content, callback) {
    wx.hideToast();
    wx.showModal({
      title: title || '提示',
      content: content || '',
      showCancel: false,
      success: () => {
        typeof callback == 'function' && callback();
      }
    })
  },
  /**显示 loading 提示框 */
  showLoading(title, callback) {
    wx.hideLoading(); // 先关闭已存在的loading
    wx.showLoading({
      title: title || '正在加载...',
      mask: true,
      success: () => {
        typeof callback == 'function' && callback();
      }
    })
  },
  hideLoading() {
    setTimeout(() => {
      wx.hideLoading();
    }, 100)
  },
  showToast(title) {
    wx.showToast({
      icon: 'none',
      title: title,
      duration: 2000,
    })
  },
  success(title) {
    wx.showToast({
      image: '/static/images/success.png',
      title: title,
      duration: 2000,
    })
  },
  error(title) {
    wx.showToast({
      image: '/static/images/error.png',
      image: image,
      title: title,
      duration: 2000,
    })
  },
  encode(value) {
    return encodeURI(encodeURI(value))
  },
  /**播放答对声音 */
  playRightVoice() {
    // 在快速点击时，先停止再播放
    answerRightAudio.stop()
    answerRightAudio.play()
  },

  /**播放答错声音 */
  playWrongVoice() {
    // 在快速点击时，先停止再播放
    answerWrongAudio.stop()
    answerWrongAudio.play()
  },
  /**播放进入房间声音 */
  playRoomVoice() {
    // 在快速点击时，先停止再播放
    roomAudio.stop()
    roomAudio.seek(3)
    roomAudio.play()
  },
  /**停止房间音乐 */
  stopRoomVoice() {
    roomAudio.stop()
  },
  /**保持屏幕常亮 */
  keepScreenOn(value = true) {
    wx.setKeepScreenOn({
      keepScreenOn: value,
    })
  }
}