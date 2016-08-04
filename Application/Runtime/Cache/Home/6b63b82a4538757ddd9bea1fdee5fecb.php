<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
<title><?php echo C('WEB_SITE_TITLE');?></title>
<link href="/me/Public/static/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="/me/Public/static/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="/me/Public/static/bootstrap/css/docs.css" rel="stylesheet">
<link href="/me/Public/static/bootstrap/css/onethink.css" rel="stylesheet">
<link href="/me/Public/static/layer/skin/layer.css" rel="stylesheet">

<link href="/me/Public/static/video_js/video-js.css" rel="stylesheet">



<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/me/Public/static/bootstrap/js/html5shiv.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="/me/Public/static/jquery-1.10.2.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/me/Public/static/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/me/Public/static/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/me/Public/static/layer/layer.js"></script>
<!--<![endif]-->
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>

</head>
<body>
	<!-- 头部 -->
	<!-- 导航条
================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo U('index/index');?>">OneThink</a>
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php $__NAV__ = M('Channel')->field(true)->where("status=1")->order("sort")->select(); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav["pid"]) == "0"): ?><li>
                            <a href="<?php echo (get_nav_url($nav["url"])); ?>" target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo ($nav["title"]); ?></a>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="nav-collapse collapse pull-right">
                <?php if(is_login()): ?><ul class="nav" style="margin-right:0">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left:0;padding-right:0"><?php echo get_username();?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo U('Share/add');?>">添加分享</a></li>
                                <li><a href="<?php echo U('User/profile');?>">修改密码</a></li>
                                <li><a href="<?php echo U('User/logout');?>">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="nav" style="margin-right:0">
                        <li>
                            <a href="<?php echo U('User/login');?>">登录</a>
                        </li>
                        <li>
                            <a href="<?php echo U('User/register');?>" style="padding-left:0;padding-right:0">注册</a>
                        </li>
                    </ul><?php endif; ?>
            </div>
        </div>
    </div>
</div>

	<!-- /头部 -->
	
	<!-- 主体 -->
	
    <header class="subhead" id="overview">
        <div class="containers">
            <h2>记录分享 回味生活</h2>
            <p class="lead"></p>
        </div>
    </header>
    <link rel="stylesheet" href="/me/Public/static/uploadify/uploadify.css" />

    <style>
        .lab{
            height: 40px;
            line-height: 40px;
            padding: 0 10px;
            background-color: #eeeff3;
            border: #dcdde1 1px solid;
            color: #666;
            width: 360px;
        }
        table tr td {
            font-size: 18px;
            margin-top: 30px;
            line-height: 30px;;
        }
        .upload-box{
            height:100px;
        }
        .upload-box img,.uploadify{
            float:left;
            margin-right:10px;
        }
        .imgbox{
            position:relative;
            float:left
        }
        .imgbox span{
            cursor:pointer;
            position:absolute;
            right:15px;
            top:5px;
            display:block;
            width:20px;
            height:20px;
            text-align:center;
            line-height:20px;
            background:rgba(0,0,0,0.5);
            color:#fff
        }

    </style>

<div id="main-container" class="container">
    <div class="row">
        
        <!-- 左侧 nav
        ================================================== -->
            <div class="span3 bs-docs-sidebar">
                
                <ul class="nav nav-list bs-docs-sidenav">
                    <?php echo W('Category/lists', array($category['id'], ACTION_NAME == 'index'));?>
                </ul>
            </div>
        
        
<div style="margin: 20px auto; width:80%; height: 500px; background-color: #fff; padding: 30px 40px 20px 40px" >
    <form  action="<?php echo U('Share/add');?>" method="post" enctype="multipart/form-data">
            <table  style="width: 100%;">
                <tr style="margin-top: 20px;">
                    <td width="300" align="right">
                        标题:
                    </td>
                    <td>
                        <input type="text" name="title" style="background-color: #eeeff3; height:28px; margin-left: 15px;" class="lab" placeholder="请输入媒体名称">
                    </td>
                </tr>
                <tr>
                    <td width="300" align="right">
                        关键字:
                    </td>
                    <td>
                        <input type="text" name="keywords" style="background-color: #eeeff3; height:28px; margin-left: 15px;" class="lab" placeholder="请输入媒体名称">
                    </td>
                </tr>
                <tr>
                    <td width="300" align="right">
                        上传图片:
                    </td>
                    <td>
                        <div class="upload-box">
                            <?php if(is_array($info['img'])): $i = 0; $__LIST__ = $info['img'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo) != "undefined"): ?><div class="imgbox"><span>X</span>
                                        <img src="<?php echo ($vo); ?>" class="imgView" style="height:100px;">
                                        <input type="hidden" name="img[]" value="<?php echo ($vo); ?>">
                                    </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            <input id="upfeng" type="file"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="300" align="right">
                        内容:
                    </td>
                    <td>
                       <textarea style="margin-left: 15px; width: 500px; height: 50px; margin-top: 20px;" name="content" class="content">

                       </textarea>
                    </td>
                </tr>
                <tr>
                    <td width="300" align="right">
                        视频地址:
                    </td>
                    <td>
                        <input type="text" name="source_vedio" style="background-color: #eeeff3; height:28px; margin-left: 15px;" class="lab" placeholder="请输入视频地址">
                    </td>
                </tr>
                <tr>
                    <td  width="300" align="right">
                        <input type="button"  class="btn" style="margin:20px 0px 0px 20px;  width: 100px; height: 50px; color: #fff; background-color: #3e90fe; cursor: pointer;" value="登陆">
                    </td>
                </tr>
            </table>
    </form>
</div>

    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(window).resize(function(){
            $("#main-container").css("min-height", $(window).height() - 343);
        }).resize();
    })
</script>
	<!-- /主体 -->

	<!-- 底部 -->
	
    <!-- 底部
    ================================================== -->
    <footer class="footer">
      <div class="container">
          <p> 本站由 <strong><a href="http://mingming0622.top" target="_blank">MeShop</a></strong> 强力驱动</p>
      </div>
    </footer>
<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "/me", //当前网站地址
		"APP"    : "/me/index.php", //当前项目地址
		"PUBLIC" : "/me/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>

    <script type="text/javascript" src="/me/Public/static/uploadify/jquery.uploadify.min.js"></script>
    <script>
        /*上传封面*/
        $('#upfeng').uploadify({
            'auto' : true,
            'removeTimeout' : 1,//文件队列上传完成1秒后删除
            'swf' : '/me/Public/static/uploadify/uploadify.swf',
            'uploader' : '<?php echo U("File/uploadImg");?>',
            'method' : 'post', //方法，服务端可以用$_POST数组获取数据
            'buttonText' : '上传图片 ',//设置按钮文本
            'buttonClass':'#fff;',
            "width": 100,		//设置按钮宽
            "height": 100,	//设置按钮高
            'multi' : true,	//允许同时上传多张图片
            'fileTypeDesc' : 'Image Files',//只允许上传图像
            'fileTypeExts' : '*.gif;*.jpg;*.png;*.bmp;*.jpeg',//限制允许上传的图片后缀
            'fileSizeLimit': '5MB',
            'progressData': 'percentage',
            'queueID': 'upload-img-tip',
            'onUploadSuccess' :function(file, data,response) {
                var data = $.parseJSON(data);
                var length = $('.upload-box img').length;
                if(length>=9){
                    alert('最多允许上传9张图片！');
                    return false
                }
                $(".upload-box").prepend(
                        '<div class="imgbox"><span>X</span>'+
                        '<img src="'+data.src+'" class="imgView" style="height:100px;">'+
                        '<input type="hidden" name="img[]" value="'+data.id+'"/></div>'
                );
            },
            'onFallback' : function() {
                alert('未检测到兼容版本的Flash.');
            }
        });

        //删除图片
        $(document).on('click','.imgbox span',function(){
            var $box = $(this).parent('.imgbox');
            $box.fadeOut('500',function(){
                $(this).remove()
            });
        });
    </script>
        <script>
            $(".btn").click(function(){
                 var title=$("input[name='title']").val();
                if(title==''){
                    layer.msg('标题不能为空')
                }
                var keywords=$("input[name='keywords']").val();
                if(keywords==''){
                    layer.msg('关键词不可为空')
                }
                var content=$("[name='content']").val();
                var source_vedio=$("[name='source_vedio']").val();
                if(content==''){
                    layer.msg('内容不可为空')
                }
                var medias = '';//媒体属性
                $(".imgbox input[name='img[]']").each(function () {
                    if (medias == '') {
                        medias = $(this).val();
                    } else {
                        medias += "," + $(this).val();
                    }
                });
                $.ajax({
                         type:"POST",
                        url:"<?php echo U('Share/add');?>",
                         data:{title:title,keywords:keywords,content:content,img:medias,source_vedio:source_vedio},
                        dataType:"json",
                        success:function(data){
                            if(data.status==1){
                              layer.msg(data.info);
                                window.location.href=data.jump;
                            }else{
                                layer.msg('data.info');
                                window.location.href='data.jump';
                            }
                        }
                })

            })

        </script>

 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>