// components/ui-toast/index.js
Component({
    options: {
        // 在组件定义时的选项中启用多slot支持
        multipleSlots: true
    },

    /**
     * 组件的属性列表
     */
    properties: {},

    /**
     * 组件的初始数据
     */
    data: {
        hidden: true,
        animationData: {},
        imageUrl: '',
        content: '提示内容'
    },

    /**
     * 组件的方法列表
     */
    methods: {
        /** 
         * 显示toast，定义动画
         */
        showToast(message, icon = 'info', callback) {
            var animation = wx.createAnimation({
                duration: 300,
                timingFunction: 'ease',
            })
            animation.opacity(1).step()
            let iconUrl = ''
            if (icon && 'info,success,error'.indexOf(icon) !== -1) {
                iconUrl = '/static/images/' + icon + '.png'
            }
            this.setData({
                hidden: false,
                animationData: animation.export(),
                content: message,
                imageUrl: iconUrl
            })
            /**
             * 延时消失
             */
            setTimeout(function() {
                animation.opacity(0).step()
                this.setData({
                    hidden: true,
                    animationData: animation.export()
                })
                typeof callback == 'function' && callback();
            }.bind(this), 1500)
            return {};
        }
    }
})