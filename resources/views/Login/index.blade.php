<html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>第二课堂--登录</title>
    <link rel="shortcut icon" type="image/x-icon" href="__STATIC__/index/img/favicon.ico">
    <link href="{{asset('resources/views/Login/css/base.css') }}"
          tppabs="http://www.17sucai.com/preview/691104/2017-01-03/easyui/pages/css/base.css" rel="stylesheet">
    {{--<link href="__STATIC__/common/css/login/login.css" tppabs="http://www.17sucai.com/preview/691104/2017-01-03/easyui/pages/css/login/login.css" rel="stylesheet">--}}
    <link href="{{asset('resources/views/Login/css/login/login.css') }}"
          tppabs="http://www.17sucai.com/preview/691104/2017-01-03/easyui/pages/css/login/login.css" rel="stylesheet">
    <link href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js">
    <link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/animate.css/3.1.0/animate.min.css">
    <style>
        .pre-loader {
            background: white;
        }
        .loading {

            position: absolute;
            top: 0;
            left: 0;
            z-index: 200;
            width: 100%;
            height: 100%;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: .4em;
            visibility: hidden;
            opacity: 0;
            transition: visibility .2s linear 0s,opacity .2s cubic-bezier(.47,0,.745,.715) 0s
        }

        .loading.isShow {
            visibility: visible;
            opacity: 1;
            transition: visibility .8s linear 0s,opacity .8s cubic-bezier(.47,0,.745,.715) 0s
        }

        .loading_name {
            position: absolute;
            bottom: calc(50% + 25px);
            left: 0;
            width: 100%;
            text-align: center
        }

        .loading_bar {
            font: inherit;
            vertical-align: baseline;
            position: absolute;
            top: 50%;
            left: calc(50% - 150px);
            width: 300px;
            height: 1px;
            overflow: hidden
        }

        .loading_bar:before {
            content: "";
            position: absolute;
            width: 2400px;
            height: 1px;
            background: linear-gradient(to right,transparent 0,transparent 5.5555555556%,black 11.1111111111%,black 16.6666666667%,transparent 22.2222222222%,transparent 27.7777777778%,black 33.3333333333%,black 38.8888888889%,transparent 44.4444444444%,transparent 50%,transparent 55.5555555556%,black 61.1111111111%,black 66.6666666667%,transparent 72.2222222222%,transparent 77.7777777778%,black 83.3333333333%,black 88.8888888889%,transparent 94.4444444444%,transparent 100%);
            animation: loading_bar 2s linear 0s infinite
        }

        .loading.isFinish .loading_bar {
            visibility: hidden;
            opacity: 0;
            transition: visibility .1s linear 0s,opacity .1s cubic-bezier(.39,.575,.565,1) 0s
        }

        .loading:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #000;
            -ms-transform: scaleX(0);
            transform: scaleX(0);
            transition: transform 1s cubic-bezier(.645,.045,.175,1) 0s
        }

        .loading.isFinish:after {
            -ms-transform: scaleX(1);
            transform: scaleX(1)
        }

        @keyframes loading_bar {
            0% {
                transform: translateX(-1200px)
            }

            100% {
                transform: none
            }
        }
        *{
            font-family: "微软雅黑";
        }



    </style>

</head>
<body>
<div id="loading" class="loading isShow pre-loader" >
    <div class="loading_name">重庆第二师范学院<span class="termination">第二课堂</span></div>
    <span class="loading_bar"></span>
    <span class="loading_bar" style="margin-top: 5px"></span>
</div>

<nav class="navbar navbar-default" style="animation-duration:1s;animation-delay:0.5s;">
    <div class="container-fluid">
        <div class="navbar-header notice_active" style="overflow: hidden;">
            <img alt="Brand" src="{{asset('resources/views/Login/img/logo.png')}}" width="18%"
                 style="padding-left: 5%;border-left: 1px solid #BEA8E4;">
            <ul id="news" class=""
                style="float: right; font-size: 1.1em;color: #777;list-style-type: none;padding-right: 5%;">

                <li class="notice_active_ch"><i class="fa fa-volume-up"></i>&nbsp;&nbsp;做了一些小调整，使页面看起来更加美观。</li>
                <li class="notice_active_ch"><i class="fa fa-volume-up"></i>&nbsp;&nbsp;网站初次上线,请您提出宝贵的意见。</li>
                <li class="notice_active_ch"><i class="fa fa-volume-up"></i>&nbsp;&nbsp;我们将再接再厉。</li>

            </ul>
        </div>

    </div>
</nav>
<div class="login-bd  " style="animation-duration:3s;">
    <div class="bd-inner">
        <div class="inner-wrap">
            <div class="lg-zone">
                <div class="lg-box " style="animation-delay:0.5s;">
                    <div class="lg-label"><h4 style="color: #09825B">第二课堂--记录成长</h4></div>
                    <form>


                        <div class="lg-username input-item clearfix">
                            <i class="fa fa-user"></i>
                            <input type="text" id="username" name="username" placeholder="账号">
                        </div>
                        <div class="lg-password input-item clearfix">
                            <i class="fa fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="密码">
                        </div>
                        <div class="lg-check clearfix">
                            <div class="input-item">
                                <i class="fa fa-shield"></i>
                                <input type="text" id="check" placeholder="验证码">
                            </div>
                            <span><img src="{{ captcha_src() }}" onclick="this.src='{{ captcha_src() }}'+Math.random()"
                                       id="code" style="max-width: 100px;cursor: pointer;height: 40px;"/></span>
                        </div>
                        <div class="tips clearfix" style="color: black;padding-left: 5%;">
                            <input style="cursor: pointer;" id='a1' type='radio' name='A' value='student'
                                   checked="true"><label style="cursor: pointer;color: #5D5C68" for="a1">学生</label>
                            <input style="cursor: pointer;" id='a2' type='radio' name='A' value='school'><label
                                    style="cursor: pointer;color: #5D5C68" for="a2">校级管理员</label>

                            <input style="cursor: pointer;" id='a3' type='radio' name='A' value='depart'><label
                                    style="cursor: pointer;color: #5D5C68" for="a3">院系管理员</label>

                            <input style="cursor: pointer;" id='a4' type='radio' name='A' value='class'><label
                                    style="cursor: pointer;color: #5D5C68" for="a4">班级管理员</label>


                        </div>

                        <div class="enter" style="margin-left: 20%;padding-bottom: 5px;">

                            <a href="javascript:;" class="supplier"  onClick="login();">登录</a>
                            <a href="javascript:;" class=" purchaser" onclick="reset();">重置</a>

                        </div>
                        <div class="tips clearfix">
                            <label><input type="checkbox" checked="checked">记住用户名</label>
                            <a href="javascript:;" class="register" onclick="forget();">忘记密码?</a><br>


                        </div>


                    </form>
                </div>
            </div>
            <div class="lg-poster"></div>
        </div>
    </div>
</div>
<div class="login-ft">
    <div class="ft-inner">
        <!-- <div class="about-us">
            <a href="javascript:;">关于我们</a>
            <a href="javascript:;">法律声明</a>
            <a href="javascript:;">服务条款</a>
            <a href="javascript:;">联系方式</a>
        </div> -->
        <div class="address">Copyright&nbsp;©&nbsp;2018&nbsp;-&nbsp;2019&nbsp;重庆第二师范学院-第二课堂&nbsp;版权所有</div>
        <!-- <div class="other-info">建议使用IE8及以上版本浏览器&nbsp;鲁ICP备&nbsp;012345678号&nbsp;E-mail：admin@easyui.com</div> -->
    </div>
</div>

<!-- <button type="hidden" id="username" onclick="username();"></button>
<button type="hidden" id="password" onclick="password();"></button>
<button type="hidden" id="check" onclick="check();"></button> -->
</body>
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://apps.bdimg.com/libs/layer/2.1/layer.js"></script>

<script type="text/javascript">
    var appMaster = {

        preLoader: function(){
            imageSources = []
            $('img').each(function() {
                var sources = $(this).attr('src');
                imageSources.push(sources);
            });
            if($("body").load()){

                setTimeout(
                    function(){
                        $('.pre-loader').fadeOut(2000);
                    },500);

            }
        },


    };

    $(document).ready(function() {
        appMaster.preLoader();
    });
    $(document).keyup(function(event){
        if(event.keyCode ==13){
            $(".supplier").trigger("click");
        }
    });
    function timer(opj) {
        $(opj).find('ul').animate({
            marginTop: "-3.5rem"
        }, 500, function () {
            $(this).css({marginTop: "0rem"}).find("li:first").appendTo(this);
        })
    }

    $(function () {
        wid = $(".navbar").height();

        $(".navbar-header").css('height', wid + "px");
        $("#news").css('line-height', wid + "px");
        var num = $('.notice_active').find('li').length;
        var num = $('.notice_active').find('li').length;
        if (num > 1) {
            var time = setInterval('timer(".notice_active")', 3500);
        }
        // var time = setInterval(function () {
        //         t();}, 5000)

    })
    // function t() {

    //          var he = $("#news>li").height();//找到li高
    //          $("#news>li").eq(0).appendTo($("#news")); //复制第一个到最后一个

    //          $("#news").animate({
    //              "marginTop": "-" + he+"px"
    //          }, 1000, function () {
    //              $("#news>li").css({
    //                  "marginTop": 0
    //              });

    //          })
    //      }
    function login() {
        pos = $("input[name='A']:checked").val();
        username = $('#username').val();
        password = $('#password').val();
        check = $('#check').val();
        if (username == '') {
            wusername();
            return false;
        }
        if (password == '') {
            wpassword();
            return false;
        }
        if (check == '') {
            wcheck();
            return false;
        }
        /*
        返回值描述:
                    0--代表验证码输入错误
                    -1--代表用户名或密码输入错误
                    1-代表学生成功
                    2--代表校级管理登录成功
                    3--代表院系管理登录成功
                    4--代表班级管理登录成功
         */
        jQuery.ajax({
            url: "{{url('login/validateUser')}}",
            type: 'post',
            dataType: 'text',
            data: {username: username, password: password, check: check, pos: pos},
            beforeSend: function () {
                layer.msg('正在登录！！！');
            },
            success: function (res) {
                if (res == 0) {
                    layer.msg('验证码错误！！！');
                    $('#code').click();

                } else if (res == -1) {
                    layer.msg('账号或密码输入错误！！！');
                } else if (res == 1) {
                    layer.msg('登录成功！！！');
                    window.location.href = "{{url('index')}}";
                } else if (res == 2) {
                    layer.msg('登录成功！！！');
                } else if (res == 3) {
                    layer.msg('登录成功！！！');
                } else if (res == 4) {
                    layer.msg('登录成功！！！');
                    window.location.href = "{{url('admin/index')}}";
                }
            }
        });

    }

    function reset() {
        $('#username').val('');
        $('#password').val('');
        $('#check').val('');
    }

    function forget() {
        layer.msg('请联系管理员进行密码重置！！！');
    }
</script>
<script type="text/javascript">
    function wpassword() {
        event.preventDefault();
        layer.msg('请输入密码！！！');

    }

    function wusername() {
        event.preventDefault();
        layer.msg('请输入账号！！！');

    }

    function wcheck() {
        event.preventDefault();
        layer.msg('请输入验证码！！！');

    }
</script>
</html>
    
