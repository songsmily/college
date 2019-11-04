<!doctype html>
<html lang="utf-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('resources/views/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/css/flat-ui.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/css/demo.css')}}">
    <title>党建考试</title>
</head>
<body>
    <div class="container">
        <div class="demo-headline">
            <h1 class="demo-logo">
                <div class="logo"></div>
                党建考试
                <small ><button style="cursor:pointer;" class="btn btn-default" onclick="adminLogOut();">退出登录</button></small>
            </h1>
        </div>
        <h1 class="demo-section-title">题库选择</h1>
        <div class="row">

                <div class="col" style="">
                    @if(Session::get('resp') == 1 )

                        <label class="radio" style="">
                            <input type="radio" name="optionsRadios" checked id="optionsRadios1" value="1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                            深入学习习近平关于教育的重要论述
                        </label>
                    @else
                        <label class="radio" style="">
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                            深入学习习近平关于教育的重要论述
                        </label>

                    @endif
                    @if(Session::get('resp') == 2 )
                            <label class="radio">
                                <input type="radio" name="optionsRadios" checked id="optionsRadios2" value="2" data-toggle="radio"  class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                                习近平关于“不忘初心、牢记使命”论述摘编                    </label>
                    @else
                                <label class="radio">
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="2" data-toggle="radio"  class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                                    习近平关于“不忘初心、牢记使命”论述摘编                    </label>
                    @endif



                </div>
                <div class="col">
                    @if(Session::get('resp') == 3 )
                        <label class="radio" style="">
                            <input type="radio" name="optionsRadios" checked id="optionsRadios1" value="3" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                            习近平新时代中国特色社会主义思想学习纲要                    </label>
                    @else
                        <label class="radio" style="">
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="3" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                            习近平新时代中国特色社会主义思想学习纲要                    </label>
                    @endif

                    @if(Session::get('resp') == 4 )
                            <label class="radio">
                                <input type="radio" checked name="optionsRadios" id="optionsRadios2" value="4" data-toggle="radio"  class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                                中国共产党党内重要法规汇编                    </label>
                    @else
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="4" data-toggle="radio"  class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                                中国共产党党内重要法规汇编                    </label>
                    @endif


                </div>


        </div>
        <h1 class="demo-section-title" style="margin-top: 50px;">考试结果</h1>

        <div class="row demo-row">
            <div class="col">
                <a href="#" onclick="outScore();"  class="btn btn-block btn-lg btn-primary">成绩导出</a>
            </div>
            <div class="col">
                <a href="#" onclick="outTimes();" class="btn btn-block btn-lg btn-warning">考试次数导出</a>
            </div>

        </div>

    </div>

</body>
<script src="{{asset('resources/views/static/jquery/jquery.min.js')}}"></script>
<script src="{{asset('resources/views/js/flat-ui.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script type="text/javascript">
    function outScore() {
        window.location.href="{{url('admin/outScore')}}";
    }
    function outTimes() {
        window.location.href="{{url('admin/outTimes')}}";
    }
    function adminLogOut(){
        $.ajax({
            url:"{{url('admin/logout')}}",
            type:"post",
            success:function (res) {
                window.location.reload();
            }
        });
    }
    $('input[type=radio][name=optionsRadios]').change(function() {
        var value = $(this).val();
        swal.fire({
            type: 'info', // 弹框类型
            title: '确认修改题库吗?', //标题
            confirmButtonColor: '#d33',// 确定按钮的 颜色
            confirmButtonText: '确定修改',// 确定按钮的 文字
            showCancelButton: true, // 是否显示取消按钮
            cancelButtonColor: '#3085d6', // 取消按钮的 颜色
            cancelButtonText: "取消修改", // 取消按钮的 文字

            focusCancel: true, // 是否聚焦 取消按钮
            reverseButtons: true  // 是否 反转 两个按钮的位置 默认是  左边 确定  右边 取消
        }).then((isConfirm) => {
            try {
                if (isConfirm.value) {
                    changeQues(value);
                }else{
                    window.location.reload();
                }
            } catch (e) {
                swal.fire("错误", "操作失败", "error");
            }
        });

    });
    function changeQues(value) {
        $.ajax({
            url:"{{url('admin/changeQues')}}",
            type:"post",
            data:{value:value},
            success:function (res) {
                if (res==1){
                    swal.fire({
                        type: 'success',
                        title: "修改成功!",
                        timer:2000,
                    });
                }else{
                    swal.fire({
                        type: 'info',
                        title: "修改失败!",
                        timer:2000,
                    });
                    setTimeout(function () {
                        window.location.reload();
                    },2000)
                }
            }
        });

    }

</script>
</html>