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
	
    <style>
        .btn-file{
            width: 80%; height: 100px; background-color: #0a628f;
            margin: 20px auto ;
        }
        .showImg{
            width: 100px;
            height: 100px;;
            display: block;
            float: left;

        }

    </style>
    <header class="jumbotron subhead" id="overview">
        <div class="container">
            <h2><?php echo ($info["title"]); ?></h2>
            <span><?php echo ($info["keywords"]); ?></span>
            <p>
				<span  class="pull-left">
					<span class="author"><?php echo (get_username($info["uid"])); ?></span>
					<span> 发表于 <?php echo (date('Y-m-d H:i',$info["creat_time"])); ?></span>
				</span>

				<span class="pull-right">
					<?php $prev = D('Document')->prev($info); if(!empty($prev)): ?><a href="<?php echo U('?id='.$prev['id']);?>">上一篇</a><?php endif; ?>
                    <?php $next = D('Document')->next($info); if(!empty($next)): ?><a href="<?php echo U('?id='.$next['id']);?>">下一篇</a><?php endif; ?>
				</span>
            </p>
        </div>
    </header>

<div id="main-container" class="container">
    <div class="row">
        
        <!-- 左侧 nav
        ================================================== -->
            <div class="span3 bs-docs-sidebar">
                
                <ul class="nav nav-list bs-docs-sidenav">
                    <?php echo W('Category/lists', array($category['id'], ACTION_NAME == 'index'));?>
                </ul>
            </div>
        
        
    <div class="span9 main-content">
        <!-- Contents
        ================================================== -->
        <section><?php echo ($info["title"]); ?></section>
        <hr/>
        <div class="xm_show_main_left">

            <?php if(info.source_vedio): ?><!--<video controls="controls" src="<?php echo ($info["source_vedio"]); ?>" autoplay="autoplay" loop="loop" width="730" height="430"></video>-->
                <embed wmode="opaque"wmode="opaque"src="<?php echo ($info["source_vedio"]); ?>" allowFullScreen="true" quality="high" width="730" height="430" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed><?php endif; ?>
            <section id="contents"><?php echo ($info["content"]); ?></section>
        </div>
        <?php if(is_array($info["imgs"]["path"])): foreach($info["imgs"]["path"] as $ko=>$vo): ?><span class="btn-file" style="margin-top: 50px;">
                <img src="<?php echo ($vo); ?>" class="showImg" data-id="<?php echo ($ko); ?>">
            </span><?php endforeach; endif; ?>

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

    <script type="text/javascript"src="/me/Public/static/video_js/video-js.swf"></script>
    <script type="text/javascript"src="/me/Public/static/video_js/video.js"></script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>