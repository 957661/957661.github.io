let signinUrl = 'https://hm.yunlan.ltd/account/login';
let signupUrl = 'http://hm.yunlan.ltd/account/reg';
let ID_MAP = {
    'www': 'd4unx52r',
    'adver5u7fgv': '5u7fgv',
    'adverhm1psm': 'hm1psm',
    'adverlx27rp': 'lx27rp',
    'adverov2tls': 'ov2tls',
    'adver6ysgra': '6ysgra',
    'adver7rwskw': '7rwskw',
    'adverwthkhp': 'wthkhp',
};

function invokeClick(element) {
    if (element.click)
        element.click(); //判断是否支持click() 事件
    else if (element.fireEvent)
        element.fireEvent('onclick'); //触发click() 事件
    else if (document.createEvent) {
        var evt = document.createEvent("MouseEvents"); //创建click() 事件
        evt.initEvent("click", true, true); //初始化click() 事件
        element.dispatchEvent(evt); //分发click() 事件
    }
}

function toSignin() {
    if (window.MXD_TF_ID) {
        window.location.href = signinUrl + '?r_c=' + ID_MAP[window.MXD_TF_ID];
    } else {
        window.location.href = signinUrl;
    }
}

function toSignup() {
    if (window.MXD_TF_ID) {
        window.location.href = signupUrl + '?r_c=' + ID_MAP[window.MXD_TF_ID];
    } else {
        window.location.href = signupUrl;
    }
}

function initBd() {
    if (window.isComCn) {
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "https://.baidu.com/hm.js?d9840c819949bbbb7adf5af9fd69a182";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    } else if (window.isCom) {
        var _hmt = _hmt || [];
        var hm = document.createElement("script");
        hm.src = "https://.baidu.com/hm.js?889ad94fb6b94563429e88655f62f4b6";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    }
}

$(function () {
    let url = window.location.href;
    let index = url.indexOf('.yunlan.ltd');
    if (index > -1) {
        window.isComCn = true;
        url = url.substring(0, index);
        let i = url.lastIndexOf('//');
        let id = url.substring(i + 2);
        window.MXD_TF_ID = id;
    } else {
        index = url.indexOf('.yunlan.ltd');
        if (index > -1) {
            //官网
            window.isCom = true;
        }
    }

    $('.tosignin').on('touchstart', function () {
        toSignin();
    })

    $('.tosignup').on('touchstart', function () {
        toSignup();
    });

    initBd();
});