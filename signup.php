<?php
if (empty($_SESSION['basicAuth'])){
	header("Location: {$rootURL}basicAuth.php");
}
//session_start();
error_reporting(E_ALL & ~E_NOTICE);
require_once 'functions.php';

rewrite($_SESSION['USER_ID']);
rewrite($_SESSION['USER_MAIL']);
rewrite($_SESSION['USER_PASS']);

if (isset($_POST["set_user_submit"])){
	if (empty($_POST['user_name']) && empty($_POST['user_email'])){
		$result = error_MSG(11);
		goto exi;
	}elseif (empty($_POST['user_name'])){
		$result = error_MSG(2);
		goto exi;
	}elseif (empty($_POST['user_email'])){
		$result = error_MSG(12);
		goto exi;
	}
	
	$yyyymmdd = $_REQUEST['year'].$_REQUEST['month'].$_REQUEST['day'];
// 	$result = check_same_username($_POST['user_name']);
// 	if ($result == "same_user_ng"){
// 		$result = error_MSG(9);
// 		exit($result);
// 	}
	$userpassword_1 = password_hash('1234', PASSWORD_DEFAULT);
	$result = regist_query("INSERT INTO user (user_name,user_password,user_email,user_birth) VALUES ('{$_POST['user_name']}','{$userpassword_1}','{$_POST['user_email']}',{$yyyymmdd})",$_POST['user_name']);
	if ($result == "checkok"){
		//die("good");
//		header("Location: " . $_SERVER['PHP_SELF']);
		$result = success_MSG(4);
	}elseif ($result == "same_user_ng"){
		$result = error_MSG(9);
	}else{
		$result = success_MSG(4);
	}
	
	exi:
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
            <h2 class="brand-tagline">新規登録画面</h2>
            <?php
            signup_navi(); 
            ?>
        </div>
    </div>
    <div class="content pure-u-1 pure-u-md-3-4">
	    <div class="posts">
	            <h1 class="content-subhead">SIGNUP</h1>
	
	            <!-- A single blog post -->
	            <section class="post">
	                <header class="post-header">
	                    <h2 class="post-title">新規登録</h2>
	                </header>
	
	                <div class="post-description">
	                    <p>登録したいユーザーの情報を入力してください。</p>
	                    <?php
	                    	if (empty($result)){
	                    	} else{
	                    		echo "<p style='color:red;'>$result</p>";
	                    	}
// 	                    	var_dump($result);
	                    ?>
	                        <form class="pure-form pure-form-aligned" name="set_user" method="post" action="#">
							    <fieldset>
							        <div class="pure-control-group">
							            <label for="name">ユーザーネーム</label>
							            <input class="pure-input-2-3" name="user_name" type="text" placeholder="Username">
							        </div>
							
<!-- 							        <div class="pure-control-group"> -->
<!-- 							            <label for="password">パスワード</label> -->
<!-- 							            <input class="pure-input-2-3" id="password" type="password" placeholder="Password"> -->
<!-- 							        </div> -->
							
							        <div class="pure-control-group">
							            <label for="email">メールアドレス</label>
							            <input class="pure-input-2-3" name="user_email" type="email" placeholder="Email Address">
							        </div>
							
							        <div class="pure-control-group">
							            <label for="foo">誕生日</label>
							            	<?php 
							            	$time = time();
							            	$year = date("Y",$time);
							            	$month = date("n",$time);
							            	$day = date("j",$time);
							            	
							            	print("<select name=\"year\">");
							            	for ($i=1900;$i<=$year;$i++	){
							            		if ($i == $year){
							            			print("<option value=\"$i\" selected>$i</option>");
							            		}else{
							            			print("<option value=\"$i\">$i</option>");
							            		}
							            	}
							            	print("</select> 年");
							            	
							            	print("<select name=\"month\">");
							            	for( $j = 1; $j <= 12; $j++ ){
							            		if ($j<10){
								            		if( $j == $month ){
								            			print("<option value=\"0$j\" selected>0$j</option>");
								            		}else{
								            			print("<option value=\"0$j\">0$j</option>");
								            		}
							            		}else{
							            			if( $j == $month ){
							            				print("<option value=\"$j\" selected>$j</option>");
							            			}else{
							            				print("<option value=\"$j\">$j</option>");
							            			}
							            		}
							            	}
							            	print("</select> 月 ");
							            	
							            	print("<select name=\"day\">");
							            	for( $k = 1; $k <=31 ; $k++ ){
							            		if ($k<10){
								            		if( $k == $day ){
								            			print("<option value=\"0$k\" selected>0$k</option>");
								            		}else{
								            			print("<option value=\"0$k\">0$k</option>");
								            		}
							            		}else{
							            			if( $k == $day ){
							            				print("<option value=\"$k\" selected>$k</option>");
							            			}else{
							            				print("<option value=\"$k\">$k</option>");
							            			}
							            		}
							            	}
							            	print("</select> 日　");
							            	
							            	?>
							        </div>
							
							        <div class="pure-controls">							
							            <button type="submit" class="pure-button pure-button-primary" name="set_user_submit">登録する</button>
							        </div>
							    </fieldset>
							</form>
	                </div>
	            </section>
	        </div>
	        
	        <div class="posts">
	            <h1 class="content-subhead">USER UPLOAD</h1>
	
	            <!-- A single blog post -->
	            <section class="post">
	                <header class="post-header">
	                    <h2 class="post-title">一括ユーザー登録</h2>
	                </header>
	
	                <div class="post-description">
	                    <p>
	                    	<button class="pure-button pure-button-primary">アップロードファイルの選択</button>                    	
	                    	<button class="button-secondary pure-button" style="background: rgb(66, 184, 221);">エクセル雛形ダウンロード</button>
	                    </p>
	                </div>
	            </section>
	        </div>
	        
	        <div class="posts">
	            <h1 class="content-subhead">REGISTED USERS</h1>
	
	            <!-- A single blog post -->
	            <section class="post">
	                <header class="post-header">
	                    <h2 class="post-title">登録済み一覧</h2>
	                </header>
	
	                <div class="post-description">
	                    <p>
	                    	<button class="pure-button pure-button-primary" onclick="location.href='http://192.168.1.119/testOpenDev1/registed_user_login.php'">登録済みユーザーの一覧を確認する</button>
	                    </p>
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
