(function(){
  window.TimerUtil = {

      /**
       * 返回当前服务器的时间
       * @returns {number} millisec
       */
      getCurServerTime: function () {
        $.ajax({
           type: 'GET',
           url: Context.base + "/register/getTime.htm",
           async:false,
           dataType: 'json',
           success: function(_data){
             if (!_data) return false;
             if (_data.retcode == 0000) {
               serverTime = +_data.retmsg;
             }
           },
           error: function(){
             serverTime = +new Date();
           }
         });
        return serverTime;
      },

      /**
       * 格式化倒计时的时间
       * @param {Number} start 当前时间
       * @param {Number} end 目标时间
       * @return {Array} 天时分秒
      */
      tiktok: function (start,end) {
          var now = start,
              offtime = +end - now,
              d, h, m, s;

          if (offtime < 0) {
              return '';
          }

          offtime = ~~(offtime / 1000);
          d = ~~(offtime / (3600 * 24));
          h = ~~((offtime - 3600 * 24 * d) / 3600);
          m = ~~((offtime - 3600 * 24 * d - 3600 * h) / 60);
          s = offtime - 3600 * 24 * d - 3600 * h - m * 60;

          return [d,h,m,s];//(d + '天' + h + '时' + m + '分' + s + '秒');
      }
  };
})();
