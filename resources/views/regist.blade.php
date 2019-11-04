<html lang="zh-CN" class="" data-blockbyte-bs-uid="37271">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,user-scalable=no">
    <meta name="google" content="notranslate">
    <meta name="renderer" content="webkit">
    <meta name="Pragma" content="no-cache">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="applicable-device" content="pc,mobile">
    <title>党建考试</title>
    <link rel="stylesheet" href="{{asset("resources/views/css/login.css")}}">

</head>
<body class="" cz-shortcut-listen="true">
<noscript>You need to enable JavaScript to run this app.</noscript>
<div id="root">
    <div class="sc-1duRon bRYbqN">
        <div class="sc-1duRon-1 sbfRl">
                <p  class="sc-1I1iYs-3 kmwMDA" style='font-family: serif;font-size: 18px;color: #41464B;'>党建考试</p>
            </div>
        <div class="sc-1duRon-3 cPHJDB">
            <div class="sc-1duRon-4 doAKkT">
                <div class="sc-3JRwrF irtYus">
                    <div class="main">
                        <div class="title">注册</div>
                        <div class="sc-3JRwrF-1 khjAih">
                            <div class="form-wrapper">
                                <div class="sc-2oZUsG bHHvBK">
                                    <form id="form">
                                        <div>
                                            <div class="sc-3ksGSP kPTEpp" type="mobileOrEmail"><label class="label">输入姓名</label>
                                                <div class="input"><input id="username" type="text" placeholder="" autocomplete="off" autofocus value=""
                                                                          name="username"></div>
                                                <div class="tips" id="usernameTip"></div>
                                            </div>

                                            <div class="sc-3ksGSP kPTEpp" type="mobileOrEmail"><label class="label">输入手机号</label>
                                                <div class="input"><input id="phone" type="text" placeholder="" autocomplete="off"  value=""
                                                                          name="phone"></div>
                                                <div class="tips" id="phoneTip"></div>

                                            </div>
                                            <div class="sc-3ksGSP kPTEpp" type="mobileOrEmail"><label class="label">输入支部名称</label>
                                                <div class="input"><input id="zhibu" type="text" placeholder="" autocomplete="off"  value=""
                                                                          name="zhibu"></div>
                                                <div id="zhibuTip" class="tips"></div>

                                            </div>
                                            <div class="sc-3ksGSP kPTEpp" type="password"><label class="label">输入密码</label>
                                                <div class="input"><input id="password" type="password" placeholder="" autocomplete="off" value=""
                                                                          name="password">
                                                </div>
                                                <div class="tips" id="passwordTip"></div>
                                            </div>
                                            <div class="sc-3ksGSP kPTEpp" type="password"><label class="label">再次输入密码</label>
                                                <div class="input"><input disabled id="repassword" type="password" placeholder="" autocomplete="off" value=""
                                                                          name="repassword">
                                                </div>
                                                <div class="tips" id="repasswordTip"></div>
                                            </div>
                                            <button class="sm-button submit sc-1n784rm-0 bcuuIb" type="button">立即注册</button>
                                        </div>
                                </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sc-1duRon-2 pvvuG">
            <div class="sm-btn-group sc-1duRon-5 dvRHZl sc-17dnj82-0 dfsiVH"><span class="switch-tips">已有帐号？请</span>
                <a class="sm-button  sc-1n784rm-0 sfCUt" type="default" href="{{url('/')}}" >登录</a>
            </div>
        </div>
        <div id="ToastsContainer_ShimoUI">
            <div class="Toastify"></div>
        </div>
    </div>
</div>
<div id="feedback-root"></div>
<div id="blockbyte-bs-indicator" style="width: 8px; height: 27%; top: 0%;"></div>
</body>

<script src="{{asset('resources/views/static/jquery/jquery.min.js')}}"></script>
<script src="{{asset("resources/views/app/js/sweetalert.js")}}"></script>
<script src="{{asset("resources/views/layer/layer.js")}}"></script>

<script type="text/javascript">
    window.pos = 0;
    $(function () {
        $(".input").css("border","1px solid #e5e5e5");
        // $(".input").css("border","1px solid #cd4747");
    });
    function checkUsername(){
        var username = $("#username").val();
        if (username.length <= 2){
            $("#usernameTip").html("请输入正确的姓名");
            $("#username").css("border","1px solid #cd4747");
            return 0;
        }else{
            $("#usernameTip").html("");
            $("#username").css("border","1px solid #e5e5e5");
            return 1;

        }
    }
    function checkPhone(){
        var phone = $("#phone").val();
        var ret = /^1[345789]\d{9}$/;
        if (ret.test(phone)){
            $("#phoneTip").html("");
            $("#phone").css("border","1px solid #e5e5e5");
            return 1;
        }else{
            $("#phoneTip").html("请输入正确的电话");
            $("#phone").css("border","1px solid #cd4747");
            return 0;
        }

    }

    function checkZhibu(){
        var zhibu = $("#zhibu").val();
        if (zhibu.length <= 3){
            console.log(zhibu);
            $("#zhibuTip").html("请输入正确的支部名称");
            $("#zhibu").css("border","1px solid #cd4747");
            return 0;

        }else{
            $("#zhibuTip").html("");
            $("#zhibu").css("border","1px solid #e5e5e5");
            return 1;
        }


    }

    function checkPassword(){
        $("#repassword").removeAttr("disabled");

        var password = $("#password").val();
        if (password.length < 6 || password.length > 12){
            $("#passwordTip").html("密码长度在6-12位之间");
            $("#password").css("border","1px solid #cd4747");
            $("#repassword").attr("disabled","disabled");
            return 0;
        }else{
            $("#repassword").removeAttr("disabled");
            $("#passwordTip").html("");
            $("#password").css("border","1px solid #e5e5e5");
            return 1;
        }
    }

    function checkRepassword(){
        var password = $("#password").val();
        var repassword = $("#repassword").val();
        console.log(password);
        console.log(repassword);
        if (repassword != password){
            $("#repasswordTip").html("两次输入不匹配");
            $("#repassword").css("border","1px solid #cd4747");
            return 0;
        }else{
            $("#repasswordTip").html("");
            $("#repassword").css("border","1px solid #e5e5e5");
            return 1;

        }
    }

    $("#username").bind("input propertychange",function(event){
        checkUsername();
    });

    $("#password").bind("input propertychange",function(event){
        $("#repassword").val("");
        checkPassword();
    });
    $("#repassword").bind("input propertychange",function(event){

        checkRepassword();

    });
    $("#zhibu").bind("input propertychange",function(event){
        checkZhibu();
    });
    $("#phone").bind("input propertychange",function(event){
        checkPhone();
    });

    $("button").click(function () {
        checkUsername();
        checkPhone();
        checkZhibu();
        checkPassword();
        checkRepassword();
        if(checkUsername() && checkPhone() && checkZhibu() && checkPassword() && checkRepassword() ){
            layer.msg("正在注册中......",{time:100000,icon:6,shift:6});

            jQuery.ajax({
                url:"{{url("/doregist")}}",
                type:"post",
                data:$("#form").serialize(),
                success:function (res) {
                    layer.closeAll();
                    if (res == 1){
                        swal("注册成功!","即将跳转考试界面" ,"",{
                            icon:"success",
                            buttons: false,
                            timer: 2000,
                        });
                        setTimeout(function (){
                            window.location.href = "{{url('index')}}";
                        },2000)
                    }else {
                        swal("注册失败!","请重新提交信息" ,"",{
                            icon:"error",
                            buttons: false,
                            timer: 3000,

                        });
                    }
                }
            })
        }else{
        }
    })


</script>
</html>