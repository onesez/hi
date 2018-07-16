<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hi</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <script src="js/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/vue/2.0.5/vue.min.js"></script>
    <script src="js/utils.js"></script>
    <link href="m/css/voice_main1.css" media="all" rel="stylesheet" />
    <script src="m/js/html2canvas.min.js" type="text/javascript"></script>
</head>

<body>
    <script>
    (function(doc, win) {
        var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            recalc = function() {
                var clientWidth = docEl.clientWidth;
                if (!clientWidth) return;
                docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
            };

        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener('DOMContentLoaded', recalc, false);
    })(document, window);
    </script>
    <div id="app" class="save_picture">
        <div :class="['save_picture_box',!sex&&'women']">
            <div class="save_picture_header" :style="{borderColor:!sex?'#F6427F':'#73B3FB'}">
                <img :src="avatar_url" alt="头像" />
            </div>
            <div class="save_picture_name_box">
                <p class="save_picture_name">
                    <span :style="{color:!sex?'#F53F7D':'#60A4F1',zIndex:1,position: 'relative'}">${nickname}</span>
                    <span class="wire" :style="{backgroundColor:!sex?'#ffe2ec':'#d4e7fc'}"></span>
                </p>
            </div>
            <div class="save_picture_li">
                <span class="title">主音色:</span>
                <p class="save_picture_li_line">
                    <span :style="{color:!sex?'#FF659A':'#71A7FC'}">${tonic}</span>
                    <span :style="{color:!sex?'#FF659A':'#71A7FC'}">${tonic_ratio}%</span>
                    <i :style="{backgroundColor:!sex?'#FF659A':'#71A7FC'}" class="wire"></i>
                </p>
            </div>
            <div class="save_picture_li">
                <span class="title">辅音色:</span>
                <div class="save_picture_libox">
                    <p class="save_picture_li_line" style="margin-bottom:10px;" v-for=" consonant1,consonant_ratio1 in consonant1">
                        <span :style="{color:!sex?'#FF659A':'#71A7FC'}">${consonant1}</span>
                        <span :style="{color:!sex?'#FF659A':'#71A7FC'}">${consonant_ratio1}%</span>
                        <i :style="{backgroundColor:!sex?'#FF659A':'#71A7FC'}" class="wire"></i>
                    </p>
                    <p class="save_picture_li_line" style="margin-bottom:10px;" v-for=" consonant2,consonant_ratio2 in consonant2">
                        <span :style="{color:!sex?'#FF659A':'#71A7FC'}">${consonant2}</span>
                        <span :style="{color:!sex?'#FF659A':'#71A7FC'}">${consonant_ratio2}%</span>
                        <i :style="{backgroundColor:!sex?'#FF659A':'#71A7FC'}" class="wire"></i>
                    </p>
                    <p class="save_picture_li_line" style="margin-bottom:10px;" v-for=" consonant3,consonant_ratio3 in consonant3">
                        <span :style="{color:!sex?'#FF659A':'#71A7FC'}">${consonant3}</span>
                        <span :style="{color:!sex?'#FF659A':'#71A7FC'}">${consonant_ratio3}%</span>
                        <i :style="{backgroundColor:!sex?'#FF659A':'#71A7FC'}" class="wire"></i>
                    </p>
                </div>
            </div>
            <div class="save_picture_li">
                <div>
                    <span class="title">攻受属性:</span>
                    <span :style="{color:!sex?'#FF659A':'#71A7FC'}" class="text">${property}</span>
                </div>
                <div>
                    <span class="title">推荐伴侣:</span>
                    <span :style="{color:!sex?'#FF659A':'#71A7FC'}" class="text">${mate}</span>
                </div>
            </div>
            <div class="save_picture_li">
                <div>
                    <span class="title">心动值:</span>
                    <span :style="{color:!sex?'#FF659A':'#71A7FC'}" class="text">${heartbeat_value}</span>
                </div>
                <div>
                    <span class="title">撩人值:</span>
                    <span :style="{color:!sex?'#FF659A':'#71A7FC'}" class="text">${flirt_value}</span>
                </div>
                <div>
                    <span class="title">扑倒值:</span>
                    <span :style="{color:!sex?'#FF659A':'#71A7FC'}" class="text">${fall_down_value}</span>
                </div>
            </div>
            <div class="save_picture_li">
                <div>
                    <span class="title">音色评价:</span>
                    <span :class="[!sex?(grade?'score_icon3':'score_icon4'):(grade?'score_icon1':'score_icon2')]"></span>
                </div>
            </div>
            <div class="save_picture_bom">
                <div class="save_picture_bomleft">
                    <div class="save_picture_bomleft_line">
                        <img src="m/images/logo2.png" alt="logo">
                        <p>Hi语音</p>
                    </div>
                    <p class="hint">扫一扫，生成你的声鉴卡</p>
                </div>
                <div :class="['save_picture_qr_code',!sex&&'women']">
                    <img src="m/images/wx.png" alt="">
                </div>
            </div>
        </div>
        <div class="save_picture_fl" :style="{backgroundColor:!sex?'#FF659A':'#71A7FC'}">
            <div class="save_picture_flbut">
                <div class="button" :style="{backgroundColor:!sex?'#FF659A':'#71A7FC'}" @click="go_voice_identify()"><span>重新鉴定</span>
                </div>
                <div @click="screenshotsImg('save')" class="button" :style="{backgroundColor:!sex?'#FF659A':'#71A7FC'}">
                    <span>存至相册</span></div>
            </div>
            <span @click="showShare" class="share_buttom">分享</span>
        </div>
        <div v-if="isShareToast" class="share_link_toast">
            <div class="share_link_box">
                <ul class="share_link">
                    <li @click="share('wx_friend','image','voice','share_image')">
                        <span class="weixin_icon"></span>
                        <span>微信</span>
                    </li>
                    <li @click="share('wx_moments','image','voice','share_image')">
                        <span class="friends_icon"></span>
                        <span>朋友圈</span>
                    </li>
                    <li @click="share('qq_friend','image','voice','share_image')">
                        <span class="qq_icon"></span>
                        <span>QQ</span>
                    </li>
                    <li @click="share('qq_zone','image','voice','share_image')">
                        <span class="kongjian_icon"></span>
                        <span>QQ空间</span>
                    </li>
                    <li @click="share('sinaweibo','image','voice','share_image')">
                        <span class="weibo_icon"></span>
                        <span>微博</span>
                    </li>
                </ul>
                <div @click="showShare" class="cancel_share_link"><span>取消</span></div>
            </div>
        </div>
        <div v-if="isShareSuccess" class="toast_text_box">
            <span class="toast_text">请稍后。。。</span>
        </div>
    </div>
    <script>
    var opts = {
        data: {
            isShareToast: false,
            isShareSuccess: false,
            sex: <?=$_GET['sex']?>, //0为女1为男 主题切换  原本是0为男1为女 现在样式中已全部取反
            code: "<?=$_GET['code']?>",
            sid: "<?=$_GET['sid']?>",
            tonic: "",
            nickname: "<?=$_GET['nickname']?>",
            consonants: [],
            tonic_ratio: "",
            property: '',
            mate: '',
            heartbeat_value: '',
            flirt_value: '',
            fall_down_value: '',
            grade: '',
            consonant1: '',
            consonant2: '',
            consonant3: '',
            avatar_url: '',
            redirect_url: '',
            image_data: ''
        },

        methods: {
            showShare: function() {
                this.isShareToast = !this.isShareToast;
            },
            screenshotsImg: function(type) {
                html2canvas(document.querySelector(".save_picture_box"), {
                    backgroundColor: 'transparent', // 设置背景透明
                    useCORS: true
                }).then(function(canvas) {
                    canvasTurnImg(canvas, type)
                });
            },
            go_voice_identify: function() {
                var url = '2.php';
                vm.redirectAction(url + '?sid=' + vm.sid + '&code=' + vm.code + '&sex=' + vm.sex + '&nickname=' + vm.nickname);
            },
            //platform => qq_friend：qq好友    qq_zone：qq空间    wx_friend：微信好友  wx_moments：朋友圈  sinaweibo：新浪微博
            //type => image：图片    web_page：网页   text：文本
            share: function(platform, type, share_source, action) {
                html2canvas(document.querySelector(".save_picture_box"), {
                    backgroundColor: 'transparent', // 设置背景透明
                    useCORS: true
                }).then(function(canvas) {
                    var image_data = canvasTurnImg(canvas, type)
                    var data = {
                        code: vm.code,
                        sid: vm.sid,
                        platform: platform,
                        type: type,
                        share_source: share_source,
                        image_data: image_data,
                        action: action
                    };

                    $.authPost('/m/shares/create', data, function(resp) {
                        vm.isShareSuccess = true;
                        setTimeout(function() {
                            vm.isShareSuccess = false;
                        }, 3000);
                        vm.redirect_url = resp.share_url;
                        console.log(vm.redirect_url);
                        location.href = vm.redirect_url;
                    })
                });
            }
        }
    };
    vm = XVue(opts);
    $(function() {
        getTonic();
    });

    function getTonic() {
        var data = {
            'sid': vm.sid,
            'code': vm.code,
            'sex': vm.sex
        };
        $.authGet('get_tonic.php', data, function(resp) {
            if (!resp.error_code) {
                vm.tonic = resp.tonic;
                vm.tonic_ratio = resp.tonic_ratio;
                if (resp.avatar_url) { vm.avatar_url = resp.avatar_url; } else {
                    if (vm.sex) {
                        vm.avatar_url = 'https://api.momoyuedu.cn/m/images/men_haeder.png';
                    } else {
                        vm.avatar_url = 'https://api.momoyuedu.cn/m/images/women_haeder.png';
                    }
                }

                getConsonants();
                getProperty();
                getCharmValue();
            }
        })
    }

    function getConsonants() {
        var data = {
            'sid': vm.sid,
            'code': vm.code,
            'sex': vm.sex,
            'tonic_ratio': vm.tonic_ratio
        };
        $.authGet('get_consonants.php', data, function(resp) {
            if (!resp.error_code) {
                vm.consonant1 = resp.consonant1;
                vm.consonant2 = resp.consonant2;
                vm.consonant3 = resp.consonant3;
            }
        })
    }

    function getProperty() {
        var data = {
            'sid': vm.sid,
            'code': vm.code,
            'sex': vm.sex
        };
        $.authGet('get_property.php', data, function(resp) {
            if (!resp.error_code) {
                vm.property = resp.property;
                vm.mate = resp.mate;
            }
        })
    }

    function getCharmValue() {
        var data = {
            'sid': vm.sid,
            'code': vm.code,
            'sex': vm.sex
        };
        $.authGet('get_charm_value.php', data, function(resp) {
            if (!resp.error_code) {
                vm.heartbeat_value = resp.heartbeat_value;
                vm.flirt_value = resp.flirt_value;
                vm.fall_down_value = resp.fall_down_value;
                vm.grade = resp.grade;
            }
        })
    }

    function canvasTurnImg(canvas, event_type) {
        // 图片导出为 png 格式
        var type = 'png';
        var imgData = canvas.toDataURL(type);
        /**
         * 获取mimeType
         * @param  {String} type the old mime-type
         * @return the new mime-type
         */
        var _fixType = function(type) {
            type = type.toLowerCase().replace(/jpg/i, 'jpeg');
            var r = type.match(/png|jpeg|bmp|gif/)[0];
            return 'image/' + r;
        };

        // 加工image data，替换mime type
        //imgData = imgData.replace(_fixType(type),'image/octet-stream');

        /**
         * 在本地进行文件保存
         * @param  {String} data     要保存到本地的图片数据
         * @param  {String} filename 文件名
         */
        function saveFile(data, filename) {
            var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a');
            save_link.href = data;
            save_link.download = filename;

            console.log(data);

            var event = document.createEvent('MouseEvents');
            event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
            save_link.dispatchEvent(event);
        };

        // 下载后的文件名
        var filename = 'screenshots_card_' + (new Date()).getTime() + '.' + type;
        // download
        //        saveFile(imgData,filename);
        switch (event_type) {
            case 'save':
                saveImage(imgData);
                break;
            case 'image':
                return imgData;
                break;
        }

    }

    var is_dev = false;
    is_dev = true;

    function saveImage(img_data) {
        var data = {
            'sid': vm.sid,
            'code': vm.code,
            'image_data': img_data
        };
        var file_type = 'base64';
        //图片链接
        //        img_data = 'http://mt-development.img-cn-hangzhou.aliyuncs.com/chance/avatar/20180118205a608c73d25c8.jpg';
        //        file_type = 'image_url';

        //        //音乐链接
        //        img_data = 'http://mt-development.img-cn-hangzhou.aliyuncs.com/chance/musics/file/5ae0721822525.mp3';
        //        file_type = 'music_url';

        var params = { data: img_data, file_type: file_type };
        params = JSON.stringify(params)

        if (is_dev) {
            if ($.isIos()) {
                //                    alert('ios begin');
                window.webkit.messageHandlers.saveImage.postMessage(params);
                //                    alert('ios end');
                //window.webkit.messageHandlers.saveMusic.postMessage('parameter');
            } else {
                //                JsCallback.saveImage(params);
                JsCallback.saveImageBase64(img_data); //保存图片
                //                JsCallback.saveMusic(img_data);  //保存音乐
                // JsCallback.saveMusic
            }
            alert('保存成功');
        } else {
            $.authPost('/m/save_image', data, function(resp) {
                alert(resp.error_reason);
            });
        }
    }
    </script>
</body>
<script>
//解决alert弹出网址
window.alert = function(name) {
    var iframe = document.createElement("IFRAME");
    iframe.style.display = "none";
    iframe.setAttribute("src", 'data:text/plain,');
    document.documentElement.appendChild(iframe);
    window.frames[0].window.alert(name);
    iframe.parentNode.removeChild(iframe);
};

var ua = navigator.userAgent.toLowerCase(); //获取浏览器的userAgent,并转化为小写——注：userAgent是用户可以修改的
var isIos = (ua.indexOf('iphone') != -1) || (ua.indexOf('ipad') != -1); //判断是否是苹果手机，是则是true

$(function() {
    if (isIos) {
        pushHistory();
    }
});

//解决ios后退无法刷新
function pushHistory() {
    window.addEventListener("popstate", function(e) {
        self.location.reload();
    }, false);
    var state = {
        title: "",
        url: "#"
    };
    window.history.replaceState(state, "", "#");
}
</script>

</html>