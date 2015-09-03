<?php
	require_once 'userfunctions.php';
	$userloginERR="";
	if (isset($_POST['userlogin'])){
		if (empty($_POST['userlogin_mail']) or empty($_POST['userlogin_pass'])){
			$userloginERR = "ERROR";
		}else {
			$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
			if ($mysqli->connect_error){
				$userloginERR = "ERROR";
				$mysqli->close();
			}else {
				$query_str = "SELECT * FROM user WHERE user_email = '".$_POST['userlogin_mail']."'";
				$result = $mysqli->query($query_str);
				if (!$result){
					$userloginERR = "ERROR";
				}elseif ($_POST['userlogin_pass']=='1234'){
					while ($row = $result->fetch_assoc()){
						$userpassword = $_POST['userlogin_pass'];
						if (password_verify($userpassword, $row['user_password'])){
							$_SESSION['USERNAME'] = $row['user_name'];
							$_SESSION['USEREMAIL'] = $row['user_email'];
							$_SESSION['NO'] = $row['no'];
							$_SESSION['FIRST'] = false;
							$userloginERR = "first";
						}else {
							$userloginERR = "ERROR";
						}
					}
				}else {
					while ($row = $result->fetch_assoc()){
						$userpassword = $_POST['userlogin_pass'];
						if (password_verify($userpassword, $row['user_password'])){
							$_SESSION['USERNAME'] = $row['user_name'];
							$_SESSION['USEREMAIL'] = $row['user_email'];
							$_SESSION['NO'] = $row['no'];
							$_SESSION['FIRST'] = true;
							header("Location: {$rootURLdist}swipeTest.php");
						}else {
							$userloginERR = "ERROR";
						}
					}
				}
			}
			if (mysqli_num_rows($result)==0){
				$userloginERR = "ERROR";
			}
		}
	}
?>

<html>

    <head>
		<meta charset="utf-8">		
		
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.min.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        
        
    </head>

    <body>
    
			<?php 
				userheader();
			?>
			
			
			<!-- <div style="padding-left: 10px;padding-right: 10px;"> -->
			<div class="container">
			
			<?php
				userbreadcrumbs_demo(); 
			?>
			
			<?php 
				if (!empty($userloginERR)){
					if ($userloginERR == "first"){
						echo <<<EOT
						<div class="alert alert-dismissable alert-info">
						    <button type="button" class="close" data-dismiss="alert">×</button>
						    <h4><i class="mdi-action-done"></i>初回認証ログインを済ませてください。（パスワード変更）</h4>
						    <p>大変お手数をお掛けしております。<br>初回パスワードでログインをしようとしました。初回認証ログインよりパスワードを変更してください。
								<br><a href="{$rootURLdist}userfirst.php?login=first" class="btn btn-warning btn-raised">初回認証ログイン</a>
							</p>
						</div>
EOT;
					}else{
						echo <<<EOT
						<div class="alert alert-dismissable alert-warning">
						    <button type="button" class="close" data-dismiss="alert">×</button>
						    <h4>ログインに失敗しました</h4>
						    <p>大変お手数をお掛けしております。<br>メールアドレス、パスワードをご確認の上再度入力・ログインをしてください。</p>
						</div>
EOT;
					}
				}elseif ($_GET['logout']=='YES'){
					echo <<< EOT
					<div class="alert alert-dismissable alert-success">
					    <button type="button" class="close" data-dismiss="alert">×</button>
						<h4>ログアウトしました。</h4>
					</div>
EOT;
				}else {
					
				}
				userlogin_demo();
			?>	
				
			
    	</div>
    
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <script src="js/ripples.min.js"></script>
        <script src="js/material.min.js"></script>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

    </body>

</html>
