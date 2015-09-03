<?php
if (empty($_SESSION['basicAuth'])){
	header("Location: {$rootURL}basicAuth.php");
}
error_reporting(E_ALL & ~E_NOTICE);
require_once 'functions.php';

if (empty($_SESSION['admin_login_name'])){
	$_SESSION['ERR_LOGIN'] = "ログインしてください。";
	header("Location: {$rootURL}registed_user_login.php");
}

$result = "";

// if (isset($_POST["registed_user_login"])){
// 	$result =  signup_admin_login("registed_user_login",$_POST["admin_login_name"],$_POST["admin_login_password"]);
// }


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example that shows off a blog page with a list of posts.">

    <title>TOP &ndash; JIOSystem</title>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>    

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
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
            <h2 class="brand-tagline">登録済ユーザー</h2>
            <?php
            signup_navi(); 
            ?>
        </div>
    </div>
    <div class="content pure-u-1 pure-u-md-3-4">
	    <div class="posts">
            <h1 class="content-subhead">USER LIST-CHECK AND CHANGE</h1>

            <!-- A single blog post -->
            <section class="post">
                <header class="post-header">
                    <h2 class="post-title">ユーザーの一覧</h2>
                </header>

                <div class="post-description">
                    <p>ソート・検索・削除・情報変更などが可能です。</p>
                    <?php
	                    	if (empty($result)){
	                    	} else{
	                    		echo "<p style='color:red;'>$result</p>";
	                    	}
// 	                    	var_dump($result);
//							echo password_hash("pass",PASSWORD_DEFAULT);
	                    ?>
                    <table class="pure-table">
                    	<thead>
					        <tr>
					            <th>管理番号</th>
					            <th>ユーザーネーム</th>
					            <th>メールアドレス</th>
					            <th>誕生日</th>
					            <th>設定</th>
					        </tr>
					    </thead>
					        <?php 
					        	createTable();
					        ?>
					    </tbody>
					</table>
                </div>
            </section>
		</div>
		
		<div class="posts">
            <h1 class="content-subhead">SUB LIST</h1>
            <section class="post">
                <header class="post-header">
                    <h2 class="post-title">SUB LIST</h2>
                </header>
                
                <div class="post-description">
                	<p><?php 
	                	if (isset($_POST['sendmail'])){
	                		sendMail();
	                	}
                	?></p>
                	<form class="pure-form pure-form-aligned" name="sendmail_form" method="POST">
				        <div class="pure-controls">							
				            <button type="submit" class="pure-button pure-button-primary" name="sendmail">メール送信</button>
				        </div>
					</form>
				</div>
            </section>
		</div>
		
		
	</div>
	
	
	<?php 
		creatModal();	
	?>
	
	        

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
