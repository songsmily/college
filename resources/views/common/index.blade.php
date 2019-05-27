<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body id="page_one">
<form id="page_one" action="{{url('lll')}}" method="post">
    {{ csrf_field() }}
<img src="{{ captcha_src() }}" onclick="this.src='{{ captcha_src() }}'+Math.random()" alt="111">
<input type="text" name="captha">
<input type="submit" value="提交">
</form>
<button onclick="testImg();">pdf</button>
<img src="" style="z-index: -999;" id="img" alt="">
</body>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script src="/laravel/resources/views/common/js/htmlToPDF.js"></script>
<script>
        $(function(){

        var str="综合素质学分认证";
        var can = document.createElement('canvas');
        var page_one = document.getElementById("page_one");

        page_one.appendChild(can);
        can.width=400;
        can.height=200;
        can.style.display='none';


        var cans = can.getContext('2d');
        cans.rotate(-10*Math.PI/200);
        cans.font = "20px Microsoft JhengHei";
        cans.fillStyle = "rgba(242, 242, 242, 0.90)";
        cans.textAlign = 'left';
        cans.textBaseline = 'Middle';
        cans.fillText(str,0,can.height/2);

        page_one.style.backgroundImage="url("+can.toDataURL("image/png")+")";

    });
    var img_one = '';
    function testImg(){
        html2canvas($("#page_one")[0]).then(function(canvas) {
            var imgUri = canvas.toDataURL("image/png"); // 获取生成的图片的url
            var formdatapage = new FormData();
            formdatapage.append("img",imgUri);
            formdatapage.append("_token","{{csrf_token()}}");
            $.ajax({
                async: false, dataType: 'json', type: 'post',
                data:formdatapage,
                processData: false,
                contentType: false,
                url: '{{url('pdf')}}',
                success: function (re) {console.log(re);

                    if(re.state==1){
                        img_one = re.image_url;
                        // alert('111');
                        console.log(re.image_url);
                        // $('#img').attr('src',re.image_url);
                        window.location.href='{{url("test")}}'+'?img_one='+img_one;

                    }else{
                        // layer.msg(re.msg);
                    }
                }
            });
        });

    }
</script>
</html>