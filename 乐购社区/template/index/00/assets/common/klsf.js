if (typeof (toastr) !== 'undefined') {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.audioPlay = function () {
        var audioElement = document.createElement("audio");
        audioElement.setAttribute("src", "/assets/common/toastr/alert.mp3");
        //$.get();
        audioElement.addEventListener("load", function () {
            audioElement.play()
        }, true);
        audioElement.pause();
        audioElement.play()
    };
}

var ajaxLock = [];
$.klsf = {
    open: function (url) {
        var a = document.createElement('a');
        a.setAttribute('href', url);
        a.setAttribute('target', '_blank');
        a.setAttribute('id', 'goUrl');
        // 防止反复添加
        if (document.getElementById('goUrl')) {
            document.body.removeChild(document.getElementById('goUrl'));
        } else {
            document.body.appendChild(a);
        }
        a.click();
    },
    reset: function (name) {
        document.getElementById(name).reset();
    },
    loadScript: function (t, e) {
        var n = document.createElement("script");
        n.onload = n.onreadystatechange = function () {
            this.readyState && "loaded" !== this.readyState && "complete" !== this.readyState || ("function" == typeof e && e(), n.onload = n.onreadystatechange = null, n.parentNode && n.parentNode.removeChild(n))
        }, n.src = t, document.getElementsByTagName("head")[0].appendChild(n)
    },
    ajax: function (url, data, success, fail, showLoad) {
        var index = md5(url);
        if (ajaxLock[index] === true) {
            if (showLoad !== false) {
                $.klsf.toastrError("请不要频繁操作");
            }
            setTimeout(function () {
                ajaxLock[index] = false;
            }, 900);
            return false;
        }
        ajaxLock[index] = true;

        var load;
        if (showLoad !== false) {
            load = layer.open({
                type: 2, shadeClose: false
            });
        }
        jQuery.ajax({
            url: url,
            data: data,
            type: (data === null || data === undefined) ? 'get' : 'post',
            cache: false,
            dataType: 'json',
            success: function (data) {
                load !== undefined && layer.close(load);
                if (typeof (success) === 'function') {
                    success(data)
                }
                setTimeout(function () {
                    ajaxLock[index] = false;
                }, 900);
            },
            error: function (data) {
                load !== undefined && layer.close(load);
                setTimeout(function () {
                    ajaxLock[index] = false;
                }, 900);
                if (typeof (fail) === 'function') {
                    fail(data)
                } else {
                    layer.open({
                        content: '网络异常，请稍候再试'
                        , skin: 'msg'
                        , time: 1
                    });
                }
            }
        })
    },
    keyup: function (code, func) {
        $("body").bind('keyup', function (event) {
            if (event.keyCode === code) {
                func();
            }
        });
    },
    showMessage: function (message, type) {
        type = (type !== 'success') ? 'error' : type;
        toastr.audioPlay();
        toastr[type](message);
    },
    toastrSuccess: function (message) {
        toastr.audioPlay();
        toastr["success"](message);
    },
    toastrError: function (message) {
        toastr.audioPlay();
        toastr["error"](message);
    },
    showOrderStatus: function (status) {
        status = Number(status);
        switch (status) {
            case 0:
                return "<span class='text-info'>等待中</span>";
                break;
            case 1:
                return "<span class='text-primary'>进行中</span>";
                break;
            case 2:
                return "<span class='text-warning'>退单中</span>";
                break;
            case 3:
                return "<span class='text-warning'>已退单</span>";
                break;
            case 4:
                return "<span class='text-warning'>异常中</span>";
                break;
            case 5:
                return "<span class='text-warning'>补单中</span>";
                break;
            case 6:
                return "<span class='text-info'>已更新</span>";
                break;
            case 90:
                return "<span class='text-success'>已完成</span>";
                break;
            case 91:
                return "<span class='text-success'>已退款</span>";
                break;
            default:
                return "未知";
        }
    },
    href: function (url) {
        $.pjax({url: url, container: '#pjax-container'});
    },
    onClick: function (id, func) {
        $(document).off("click", id);
        $(document).on("click", id, func);
    }
};

$.klsf.loadScript("/report.php?r=" + Date.parse(new Date()));
setInterval(function () {
    $.klsf.loadScript("/report.php?r=" + Date.parse(new Date()));
}, 50000);
