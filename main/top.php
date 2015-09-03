<?php

require_once '../functions.php';

if (empty($_SESSION['basicAuth'])){
	header("Location: {$rootURL}basicAuth.php");
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example that shows off a blog page with a list of posts.">

    <title>TOP &ndash; JIOSystem</title>

    


<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">



<!--[if lte IE 8]>
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
  
<![endif]-->
<!--[if gt IE 8]><!-->
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
  
<!--<![endif]-->





  
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/blog-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="/testOpenDev1/css/layouts/blog.css">
    <!--<![endif]-->
  


    

    

</head>
<body style="background: url('http://192.168.1.119/testOpenDev1/img/sampleTop.jpg'); background-size:cover;">







<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            <h1 class="brand-title">JIOSystem</h1>
            <h2 class="brand-tagline">管理者画面</h2>

            <nav class="nav">
                <ul class="nav-list">
<!--                     <li class="nav-item"> -->
<!--                         <a class="pure-button" href="#">LOGIN</a> -->
<!--                     </li> -->
                    <li class="nav-item">
                    	<a class="pure-button" href="/testOpenDev1/signup.php">新規登録画面へ</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="content pure-u-1 pure-u-md-3-4" style="padding-top: 20%;">
    	<section class="post">
	                    <header class="post-header">
	                        <h2 class="post-title">JOBS Intensive optimization SERVICE</h2>
	                        <p class="post-meta">
                            	管理者画面　＜生徒管理＞
                        	</p>
	                    </header>
		</section>
        <div>
            <div class="footer">
                <div class="pure-menu pure-menu-horizontal">
                    <ul>
<!--                         <li class="pure-menu-item"><a href="#" class="pure-menu-link">About</a></li> -->
<!--                         <li class="pure-menu-item"><a href="#" class="pure-menu-link">Twitter</a></li> -->
<!--                         <li class="pure-menu-item"><a href="#" class="pure-menu-link">GitHub</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>






</body>
</html>
