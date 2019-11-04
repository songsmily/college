<html class="modern vt-adaptive vt-lang-ltr k-webkit k-webkit78 js" style="" lang="zh-CN" dir="ltr"
      data-blockbyte-bs-uid="68815"><!--<![endif]-->
<head>
    <title>党建考试</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <noscript>
        <style>
            html {
                display: none;
            }

        </style>
        <meta http-equiv="refresh" content="0; url=/efm/se/3D3148E405DAF6A408D75DD644588B7B77/nojs/"/>
    </noscript>
    <link rel="stylesheet" type="text/css" href="{{asset("resources/views/css/bootstrap.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("resources/views/css/structure.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("resources/views/css/theme.css?31E83E4F000005F1")}}">
    <style>
        .response,input,label{
            cursor: pointer;
        }

    </style>
</head>
<body id="P1"  class="" style="" cz-shortcut-listen="true">
<form class="form-horizontal" role="form"
      action="/efm/se/3D3148E405DAF6A408D75DD644588B7B77/lang/zh-CN/?pl=en-US,ko-KR,zh-TW" method="post"
      enctype="multipart/form-data" onsubmit="return ProcessPage();" novalidate="">
    <div class="container-fluid page-content page-bg-image page-bg-color theme theme-simple">
        <main role="main">
            <div class="row" >
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 banner">
                        <img src="{{asset("resources/views/img/70.png")}}" style="width: 8%">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1 progressbar">
                        <div class="progress progress-incomplete-color" id="PB_1">
                            <div  class="progress-bar progress-complete-color" role="progressbar" style="width:100%;background-color: #EC414D"
                                 aria-hidden="true">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row content-questions">
                <p style="" class="text-block underage-disclaimer">你已经完成了:<strong>{{ Session::get('count') }}</strong>次考试,最高分为:<strong>{{ Session::get('maxScore')}}</strong>分。</p>
                <div class="col-md-10 col-md-offset-1" id="content">

                </div>
            </div>

            <div class="row rowButtons" style="padding-top: 30px;">
                <div class="col-md-10 col-md-offset-1 rowButton">
                    @if(Session::get('questions') != null)
                        <p id="BA" ><input id="BN" type="button" name="next" class="btn btn-primary button-text button-next"
                                                                 role="button" value="提交答案" style="background-color: #EC414D;border: none;"></p>
                    @else
                        <p id="loadData" style="text-align: center"><input id="loadData"  type="button" name="next" class="btn btn-primary button-text button-next"
                                                                           role="button" value="开启新一次考试" style="background-color: #EC414D;border: none;width: 264px;height: 44px;"></p>
                    @endif
                        <p id="BA" style="display: none;" ><input id="BN" type="button" name="next" class="btn btn-primary button-text button-next"
                                           role="button" value="提交答案" style="background-color: #EC414D;border: none;"></p>



                </div>
            </div>
            <div class="row rowFooter">
                <div class="col-md-10 col-md-offset-1 text-center">

                    <span id="underage">党建考试</span><br>
                    <span id="copyright" dir="ltr">Copyright © 2019 SongSmily@163.com</span>

                </div>
            </div>
        </main>
    </div>
</form>

</body>
<script src="{{asset('resources/views/static/jquery/jquery.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{asset("resources/views/layer/layer.js")}}"></script>
<script type="text/javascript">
    $("#loadData").click(function () {
        let timerInterval;
        swal.fire({
            title: '正在加载试卷!',
            timer: 200000,
            onBeforeOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                    Swal.getContent().querySelector('b')
                        .textContent = Swal.getTimerLeft()
                }, 100)
            },
            onClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.timer
            ) {
            }
        });
        jQuery.ajax({
            url: "{{url("/loadNewContent")}}",
            type: "post",
            success: function (res) {
                $("#content").html(res);
                swal.close();
                $("#loadData").hide();
                $("#BA").show();
            }
        });
    });
    $(function () {
        @if(Session::get('questions') != null)
        let timerInterval;
        swal.fire({
            title: '正在加载试卷!',
            timer: 200000,
            onBeforeOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                    Swal.getContent().querySelector('b')
                        .textContent = Swal.getTimerLeft()
                }, 100)
            },
            onClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.timer
            ) {
            }
        });
        jQuery.ajax({
            url: "{{url("/loadContent")}}",
            type: "post",
            success: function (res) {
                $("#content").html(res);
                swal.close();
            }
        });

        @endif
        return 0;

        // var i = 1;
        // setInterval(function () {
        //     $('.progress-bar').css("width",i + "%");
        //     i++;
        // },200)
    });
    $("li").click(function () {
        event.stopPropagation();
        var id =  $(this).attr("for");
        $("#" + id).prop("checked",!$("#" + id).prop("checked"));

    });
    $("#BN").click(function () {
        event.stopPropagation();
        var array1 = $("form").serializeArray();
        var quesArrayNum = [];
        for (let i = 0; i < array1.length ; i++) {
            quesArrayNum.push(array1[i]["name"]);
        }
        console.log(quesArrayNum);
        var new_arr=[];
        var answer = {};
        for(var i=0;i<quesArrayNum.length;i++) {
            var items=quesArrayNum[i];
            if($.inArray(items,new_arr)==-1) {

                new_arr.push(items);
            }
        }
        for (var item in new_arr){
            for(var prop in array1){
                if(array1.hasOwnProperty(prop)){
                    console.log(array1[prop]["name"]);
                    if (array1[prop]["name"] == new_arr[item]){
                        answer[new_arr[item]] = answer[new_arr[item]]==undefined?array1[prop]["value"] :answer[new_arr[item]] + array1[prop]["value"];

                    }

                }
            }
        }
        if (new_arr.length < 1){
            swal.fire({
                type: 'error',
                title: '不能提交空白答卷',
                text: '请继续作答!'
            });
            return 0;
        }

        if (new_arr.length < 5){
            swal.fire({
                type: 'warning', // 弹框类型
                title: '有未作答题目!', //标题
                text: "确认提交答案吗?", //显示内容

                confirmButtonColor: '#d33',// 确定按钮的 颜色
                confirmButtonText: '确定提交',// 确定按钮的 文字
                showCancelButton: true, // 是否显示取消按钮
                cancelButtonColor: '#3085d6', // 取消按钮的 颜色
                cancelButtonText: "继续作答", // 取消按钮的 文字

                focusCancel: true, // 是否聚焦 取消按钮
                reverseButtons: true  // 是否 反转 两个按钮的位置 默认是  左边 确定  右边 取消
            }).then((isConfirm) => {
                try {
                    if (isConfirm.value) {
                        //提交答案
                        doAnswer(answer);
                    }
                } catch (e) {
                    swal.fire("错误", "操作失败", "error");
                }
            });
        }else{
            swal.fire({
                type: 'warning', // 弹框类型
                title: '确认提交答案吗!', //标题
                confirmButtonColor: '#d33',// 确定按钮的 颜色
                confirmButtonText: '确定提交',// 确定按钮的 文字
                showCancelButton: true, // 是否显示取消按钮
                cancelButtonColor: '#3085d6', // 取消按钮的 颜色
                cancelButtonText: "继续作答", // 取消按钮的 文字

                focusCancel: true, // 是否聚焦 取消按钮
                reverseButtons: true  // 是否 反转 两个按钮的位置 默认是  左边 确定  右边 取消
            }).then((isConfirm) => {
                try {
                    if (isConfirm.value) {
                        //提交答案
                        doAnswer(answer);
                    }
                } catch (e) {
                    swal.fire("错误", "操作失败", "error");
                }
            });
        }
    });
    function doAnswer(Answer){
        jQuery.ajax({
            url:"{{url("/doAnswer")}}",
            type:"post",
            data:{answer:Answer},
            success:function (res) {
                layer.closeAll();
                if (res['pos']==1){
                    if (res['score']<3) {
                        var tittle = '本次得分:' + res['score'] + ',未通过考试!';
                    }else{
                        var tittle = '本次得分:' + res['score'] + ',已通过考试!';

                    }
                    swal.fire({
                        type: 'info',
                        title: tittle,
                        text: "历史最高分为:"+ res['maxScore'],
                        timer:20000,
                        showConfirmButton: false,
                    });
                    setTimeout(function () {
                       window.location.reload();
                    },2000);
                }
                {{--if (res == 1){--}}
                {{--    swal("注册成功!","即将跳转考试界面" ,"",{--}}
                {{--        icon:"success",--}}
                {{--        buttons: false,--}}
                {{--        timer: 2000,--}}
                {{--    });--}}
                {{--    setTimeout(function (){--}}
                {{--        window.location.href = "{{url('index')}}";--}}
                {{--    },2000)--}}
                {{--}else {--}}
                {{--    swal("注册失败!","请重新提交信息" ,"",{--}}
                {{--        icon:"error",--}}
                {{--        buttons: false,--}}
                {{--        timer: 3000,--}}

                {{--    });--}}
                {{--}--}}
            }
        })
    }

</script>
</html>