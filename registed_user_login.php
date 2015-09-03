<?php
if (empty($_SESSION['basicAuth'])){
	header("Location: {$rootURL}basicAuth.php");
}
error_reporting(E_ALL & ~E_NOTICE);
require_once 'functions.php';

if (empty($_SESSION['admin_login_name'])){
}else {
	header("Location: {$rootURL}registed_user.php");
}

$result = "";

if (isset($_POST["registed_user_login"])){
	$result =  signup_admin_login("registed_user_login",$_POST["admin_login_name"],$_POST["admin_login_password"]);
	if ($result == "checkok"){
		$_SESSION['admin_login_name'] = $_POST['admin_login_name'];
		rewrite($_SESSION['ERR_LOGIN']);
		header("Location: {$rootURL}registed_user.php");
	}else{
	}
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
<body>







<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            <h1 class="brand-title">JIOSystem</h1>
            <h2 class="brand-tagline">管理者ログイン</h2>
            <?php
            signup_navi(); 
            ?>
        </div>
    </div>
    <div class="content pure-u-1 pure-u-md-3-4">
	    <div class="posts">
	            <h1 class="content-subhead">LOGIN</h1>
	
	            <!-- A single blog post -->
	            <section class="post">
	                <header class="post-header">
	                    <h2 class="post-title">ログイン</h2>
	                </header>
	
	                <div class="post-description">
	                    <p>管理者のユーザーID・パスワードでログインしてください。</p>
	                    <?php
	                    	if (empty($result)){
	                    	} else{
	                    		echo "<p style='color:red;'>$result</p>";
	                    	}
	                    	
	                    	if (empty($_SESSION['ERR_LOGIN'])){
	                    	}else {
	                    		$resule2 = $_SESSION['ERR_LOGIN'];
	                    		echo "<p style='color:red;'>$resule2</p>";
	                    	}
// 	                    	var_dump($result);
	                    ?>
	                        <form class="pure-form pure-form-aligned" name="admin_login" method="POST">
							    <fieldset>
							        <div class="pure-control-group">
							            <label for="name">ユーザーネーム</label>
							            <input class="pure-input-2-3" name="admin_login_name" type="text" placeholder="Username">
							        </div>
							
							        <div class="pure-control-group">
							            <label for="password">パスワード</label>
							            <input class="pure-input-2-3" name="admin_login_password" type="password" placeholder="Password">
							        </div>
							        <div class="pure-controls">							
							            <button type="submit" class="pure-button pure-button-primary" name="registed_user_login">ログイン</button>
							        </div>
							    </fieldset>
							</form>
	                </div>
	            </section>
	        </div>
		</div>
	        

    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <div class="footer">
                <div class="pure-menu pure-menu-horizontal">
                    <ul>
                        <li class="pure-menu-item"><a href="#" class="pure-menu-link">About</a></li>
                        <li class="pure-menu-item"><a href="#" class="pure-menu-link">Twitter</a></li>
                        <li class="pure-menu-item"><a href="#" class="pure-menu-link">GitHub</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>






</body>
</html>
