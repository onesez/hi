<?php
// 定义你的随机输出内容
$read_texts = [
	'2354351351235153135135135135135135135135135135',
	'如果你看到面前的阴影，别怕，那是因为你的背后有阳光！',
	'啊山东黄金噶是的空间拉屎的阿萨德',
	'阿萨德萨达所阿萨德',
];
$read_text = $read_texts[array_rand($read_texts, 1)];
?>
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
</head>

<body>
    <div id="app" style="flex-direction: column;min-height: 100%;justify-content: space-between;">
        <div class="recording">
            <p class="recording_title">请录制一段不少于5秒的音频</p>
            <div class="recording_title_hint">
                <span class="icon"></span>
                <span>内容可以参考以下文案</span>
                <span class="icon"></span>
            </div>
            <div class="recording_copywriting">
                <h4>一个有趣的文案建议</h4>
                <p>${read_text}</p>
            </div>
            <div class="recording_progress_box">
                <span :style="{width: recordingLength+'%' }" class="recording_progress_bar"></span>
                <span :style="{left: recordingLength+'%' }" class="recording_progress_point">${Math.ceil(recordingLength/10)}s</span>
            </div>
            <div @touchstart="onRecordingStart" @touchend="onRecordingEnd" class="recording_but">
                <span>长按</span>
                <span>录制</span>
            </div>
            <p class="recording_but_hint">完成录制可松开按钮～</p>
            <div v-if="isToast" class="recording_tosat">
                <span class="recording_tosat_icon"></span>
                <span>正在录音</span>
            </div>
            <div v-if="isTosatText" class="toast_text_box">
                <span class="toast_text">录制时间太短，请重新录制</span>
            </div>
            <div v-if="isAnalysis" class="recording_analysis">
                <div class="recording_analysis_box">
                    <h5>温馨小提示</h5>
                    <p>正在分析中，请稍等几秒哟～</p>
                    <div class="recording_analysis_box_but">
                        <span>疯狂分析中…</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="sound_entry_bottom_bg"></div>
    </div>
    <script>
    var opts = {
        data: {
            isToast: false,
            isTosatText: false,
            isAnalysis: false,
            recordingLength: 1,
            code: "<?=$_GET['code']?>",
            sid: "<?=$_GET['sid']?>",
            read_text: "<?=$read_text?>",
            sex: "<?=$_GET['sex']?>",
            nickname: "<?=$_GET['nickname']?>"
        },
        methods: {
            // 按下
            onRecordingStart: function() {
                var self = this;
                if (this.recordingLength >= 100) return false;
                this.times = setInterval(function() {
                    self.recordingLength++;
                    self.isToast = true;
                    if (self.recordingLength >= 100) {
                        clearInterval(this.times);
                        self.onAnalysis();
                    }
                }, 100);
            },
            // 抬起
            onRecordingEnd: function() {
                clearInterval(this.times);
                if (this.recordingLength < 40) {
                    // 录音时间太短重置
                    this.showToast();
                    this.recordingLength = 1;
                    this.isToast = false;
                    return false;
                }
                this.onAnalysis();
            },
            // 进入分析
            onAnalysis: function() {
                this.isAnalysis = true;
                this.isToast = false;
                setTimeout(function() {
                    var url = '3.php';
                    vm.redirectAction(url + '?sid=' + vm.sid + '&code=' + vm.code + '&sex=' + vm.sex + '&nickname=' + vm.nickname);
                }, 2000)


            },
            // 文字提示
            showToast: function() {
                var self = this;
                if (this.isTosatText) {
                    return false;
                } else {
                    this.isTosatText = true;
                    setTimeout(function() {
                        self.isTosatText = false;
                    }, 1000);
                }
            }
        }
    };
    vm = XVue(opts);
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