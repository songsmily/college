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
                        <div class="title">登录</div>
                        <div class="sc-3JRwrF-1 khjAih">
                            <div class="form-wrapper">
                                <div class="sc-2oZUsG bHHvBK">
                                    <div>
                                        <form action="">
                                            <div class="sc-3ksGSP kPTEpp" type="mobileOrEmail"><label class="label">输入姓名</label>
                                                <div class="input"><input id="username" type="text" placeholder="" autocomplete="off" autofocus value=""
                                                                          name="username"></div>
                                                <div class="tips" id="usernameTip"></div>
                                            </div>
                                            <div class="sc-3ksGSP kPTEpp" type="password"><label class="label">输入密码</label>
                                                <div class="input"><input id="password" type="password" placeholder="" autocomplete="off" value=""
                                                                          name="password">
                                                </div>
                                                <div class="tips" id="passwordTip"></div>
                                            </div>
                                        <button class="sm-button submit sc-1n784rm-0 bcuuIb" type="button" id="BT">立即登录</button>
                                        </form>
                                    </div>
                                    <div class="sc-2oZUsG-2 domidx">
                                        <div class="changeVerify"><span>管理员登录<!-- --> <span class="link" onclick="adminLogin();">点击登录</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sc-1duRon-2 pvvuG">
            <div class="sm-btn-group sc-1duRon-5 dvRHZl sc-17dnj82-0 dfsiVH"><span class="switch-tips">没有帐号？请</span>
                <a class="sm-button  sc-1n784rm-0 sfCUt" type="default" href="{{url('regist')}}" >注册</a>
            </div>
        </div>
        <div id="ToastsContainer_ShimoUI">
            <div class="Toastify"></div>
        </div>
    </div>
</div>
</body>
<script src="{{asset('resources/views/static/jquery/jquery.min.js')}}"></script>
<script src="{{asset("resources/views/app/js/sweetalert.js")}}"></script>

<script src="{{asset("resources/views/layer/layer.js")}}"></script>
<script type="text/javascript">
    function adminLogin(){
        checkUsername();
        checkPassword();
        if (checkUsername()&&checkPassword()){
            $.ajax({
                url:"{{url('login/adminLogin')}}",
                type:'post',
                data:$("form").serialize(),
                success:function (res) {
                    if (res == 1){
                        swal("登录成功!","即将跳转管理员界面" ,"",{
                            icon:"success",
                            buttons: false,
                            timer: 2000,
                        });
                        setTimeout(function () {
                            window.location.href="{{url("admin")}}"
                        },1000);
                    }else{
                        swal("登录失败!","请核对用户名和密码后重新登录" ,"",{
                            icon:"error",
                            buttons: false,
                            timer: 3000,

                        });
                    }
                }
            })
        }

    }

    $("#BT").click(function () {
        checkUsername();
        checkPassword();
        if (checkUsername() &&checkPassword()){
            jQuery.ajax({
                url:"{{url('login/doLogin')}}",
                type:"post",
                data:$("form").serialize(),
                success:function (res) {
                       if (res == 1){
                           swal("登录成功!","即将跳转考试界面" ,"",{
                               icon:"success",
                               buttons: false,
                               timer: 2000,
                           });
                           setTimeout(function () {
                               window.location.href="{{url("index")}}"
                           },1000);
                       }else{
                           swal("登录失败!","请核对姓名和密码后重新登录" ,"",{
                               icon:"error",
                               buttons: false,
                               timer: 3000,

                           });
                       }
                }
            })
        }


    });

    $("#username").bind("input propertychange",function(event){
        checkUsername();
    });

    $("#password").bind("input propertychange",function(event){
        $("#repassword").val("");
        checkPassword();
    });
    function  checkUsername() {
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
    function  checkPassword() {
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
</script>
</html>