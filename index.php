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
        <div class="sound_entry">
            <div class="sound_entry_input">
                <input type="text" :placeholder="nickname?nickname:'给自己起一个好听的名字'" v-model="nickname" maxlength="10" />
            </div>
            <ul class="sound_entry_select">
                <li :class="['men',select_sex&&'selected_men']" @click="selectMale()"><span class="men_icon"></span>男神</li>
                <li :class="['women',!select_sex&&'selected_women']" @click="selectFemale()"><span class="women_icon"></span>女神
                </li>
            </ul>
            <div class="sound_entry_button" @click="go_voice_identify()"><span>声音鉴定</span></div>
            <span class="sound_entry_wire"></span>
            <div class="sound_entry_logo">
                <img src="m/images/logo2.png" alt="logo" />
                <span>Hi语音鉴定，必属精品</span>
            </div>
        </div>
        <div class="sound_entry_bottom_bg"></div>
    </div>
    <script>
    var opts = {
        data: {
            user: { "id": 1331305, "nickname": "<?=$_GET['name']?>", "avatar_url": "http:\/\/img.momoyuedu.cn\/chance\/users\/avatar\/20180708045b411e09c133a.jpg@!small", "sex": 1 },
            select_sex: true,
            sex: 1,
            sid: "1331305s8d294370b393695d5362b7bc97095e14c0",
            code: "yuewan",
            nickname: ""
        },
        methods: {
            go_voice_identify: function() {
                if (vm.nickname) {
                    var url = '2.php';
                    vm.redirectAction(url + '?sid=' + vm.sid + '&code=' + vm.code + '&sex=' + vm.sex + '&nickname=' + vm.nickname);
                } else {
                    alert('请输入昵称！');
                }
            },
            selectMale: function() {
                vm.select_sex = true;
                vm.sex = 1;
            },
            selectFemale: function() {
                vm.select_sex = false;
                vm.sex = 0;
            }
        }
    };
    vm = XVue(opts);
    $(function() {
        vm.sex = vm.user.sex;
        vm.nickname = vm.user.nickname;
        console.log(vm.nickname);
        if (vm.sex) {
            vm.select_sex = true;
        } else {
            vm.select_sex = false;
        }
    })
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