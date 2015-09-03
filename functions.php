<?php

require_once 'errorMsg.php';
ini_set('display_errors', 'Off');

$rootURL = "http://development.roundstone.besaba.com/jios/";
$rootURLjobvote = "http://development.roundstone.besaba.com/jios/jobvote/";
$mySQLAddress = "localhost";
$mainDbUserName = "root";
$mainDbPass = "pass";
$mainDbName = "testOpenDev1_db";

function rewrite($var){
	$ver=null;
}

function signup_navi(){
	global $rootURL;
echo <<<EOT
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="pure-button" href="{$rootURL}signup.php">新規登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="pure-button" href="{$rootURL}registed_user_login.php">登録済一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="pure-button" href="{$rootURL}jobvote/jobSlipManage_login.php">求人票管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="pure-button" href="{$rootURL}comp_add.php">各種設定</a>
                    </li>
                    <li class="nav-item">
                        <a class="pure-button" style="background:red;" href="{$rootURL}logout.php">ログアウト</a>
                    </li>
                </ul>
            </nav>

EOT;
}

function signup_footer(){
echo <<<EOT
<div class="footer">
	<div class="pure-menu pure-menu-horizontal">
		<ul>
			<li class="pure-menu-item"><a href="#" class="pure-menu-link">About</a></li>
			<li class="pure-menu-item"><a href="#" class="pure-menu-link">Twitter</a></li>
			<li class="pure-menu-item"><a href="#" class="pure-menu-link">GitHub</a></li>
		</ul>
	</div>
</div>
EOT;
}

function db_signin_mysql(){

	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;
	global $rootURL;

	$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);

	if ($mysqli->connect_error){
		return error_MSG(1);
		$mysqli->close();
	}else{
		return $mysqli;
	}

}

function signup_admin_login($submit_name,$id,$pass){
	switch ($submit_name){
		case 'registed_user_login':
			if (empty($id) && empty($pass)){
				return error_MSG(4);
				exit();
			}elseif (empty($id)){
				return error_MSG(2);
				exit();
			}elseif (empty($pass)){
				return error_MSG(3);
				exit();
			}

			global $mySQLAddress;
			global $mainDbUserName;
			global $mainDbPass;
			global $mainDbName;
			global $rootURL;

			$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);

			if ($mysqli->connect_error){
				return error_MSG(1);
				$mysqli->close();
				exit();
			}

			$query_str = "SELECT * FROM admin_user WHERE admin_un = '".$id."'";
			$result = $mysqli->query($query_str);

			if (!$result){
				return error_MSG(6);
				exit();
			}else {
				while ($row = $result->fetch_assoc()){
					if (password_verify($pass, $row['admin_pw'])){
						return success_MSG(3);
					}else{
						return error_MSG(7);
						exit();
					}
				}
			}
			if (mysql_num_rows($result)==0){
				return error_MSG(7);
				exit();
			}

			break;
	}
}

function regist_query($query,$username){
	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;
	global $rootURL;

	$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
	if ($mysqli->connect_error){
		return error_MSG(1);
		$mysqli->close();
		exit();
	}
	$result = $mysqli->query("SELECT * FROM user WHERE user_name = '{$username}';");
	if (mysqli_num_rows($result)!=0){
		return error_MSG(10);
		exit();
	}

// 	$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
// 	if ($mysqli->connect_error){
// 		return error_MSG(1);
// 		$mysqli->close();
// 		exit();
// 	}

	$result = $mysqli->query($query);
	if (!$result){
		return error_MSG(8);
		exit();
	}else{
		return success_MSG(3);
	}
}

function check_same_username($username){
	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;
	global $rootURL;
	$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
	if ($mysqli->connect_error){
		return error_MSG(1);
		$mysqli->close();
		exit();
	}
	$result = $mysqli->query("SELECT * FROM user WHERE user_name = '{$username}';");
	if (mysqli_num_rows($result)!=0){
		return error_MSG(10);
		exit();
	}
}

function createTable(){
	$mysqli = db_signin_mysql();
	$result = $mysqli->query("SELECT * FROM user");
	if (!$result){
		return error_MSG(8);
		exit();
	}else {
		$roop_i=0;
		while ($row = $result->fetch_assoc()){
			if ($roop_i%2==0){
				echo <<<EOT
				<tr class="pure-table-odd">
		            <td>{$row['no']}</td>
		            <td>{$row['user_name']}</td>
		            <td>{$row['user_email']}</td>
		            <td>{$row['user_birth']}</td>
		            <td>
		            	<form class="pure-form pure-form-aligned" name="user_change_fromadmin" method="POST">
							<fieldset>
								<div class="">
									<button class="pure-button pure-button-primary" onclick="window.location.href='#div-modal{$row['no']}'" type="submit" data-toggle="modal" data-target="#div-modal{$row['no']}" name="change_user_info_id_{$row['no']}">変更</button>
								</div>
							</fieldset>
						</form>
		            </td>
		        </tr>
EOT;
			}else {
				echo <<<EOT
		        <tr>
		            <td>{$row['no']}</td>
		            <td>{$row['user_name']}</td>
		            <td>{$row['user_email']}</td>
		            <td>{$row['user_birth']}</td>
		            <td>
		            	<form class="pure-form pure-form-aligned" name="user_change_fromadmin" method="POST">
							<fieldset>
								<div class="">
									<button class="pure-button pure-button-primary" onclick="window.location.href='#div-modal{$row['no']}'" type="submit" data-toggle="modal" data-target="#div-modal{$row['no']}" name="change_user_info_id_{$row['no']}">変更</button>
								</div>
							</fieldset>
						</form>
		            </td>
		        </tr>
EOT;
			}
			$roop_i++;
		}
	}

}


function creatModal(){
	$mysqli = db_signin_mysql();
	$result = $mysqli->query("SELECT * FROM user");
	if (!$result){
		return error_MSG(8);
		exit();
	}else {
		$roop_i = 0;
		while ($row = $result->fetch_assoc()){
			echo <<<EOT
			<div id="div-modal{$row['no']}" class="modal fade" style="letter-spacing:0em;">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title">{$row['no']}です。</h4>
			      </div>
			      <div class="modal-body">
			        <p>One fine body&hellip;</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">ユーザーの削除</button>
			        <button type="button" class="btn btn-primary" onclick="">メールの送信</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div>
EOT;
		}
	}
}


function sendMail(){
// 	mb_language("Japanese");
// 	mb_internal_encoding("UTF-8");

// 	$mailAddress = "yuki.jamjamjam@gmail.com";
// 	$subject="JISOシステム：ユーザー登録";
// 	$message="JISOユーザー様　テストメールです。";

	// $result = mb_send_mail($mailAddress, $subject, $message);
	// var_dump($result);


	// $result = mb_send_mail("yuki.jamjamjam@gmail.com", "TEST", "TESTメール");
	// var_dump($result);

//	if (mb_send_mail($mailAddress, $subject, $message)){
	if (mb_send_mail("yuki.jamjamjam@gmail.com","JIOSシステム：ユーザー登録","JIOSユーザー様　テストメールです。")){
		echo "送信しました。";
	}else{
		echo "送信できませんでした。";
	}
}

function jobvote_menu(){
	echo <<< EOT
				<style>
					div .l-box{
						padding:1em;
						text-align:center;
					}
					.button-xsmall {
			            font-size: 70%;
			        }
				</style>
				<div class="pure-g">
							<div class="pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
								<div class="l-box">
									<a class="pure-button pure-button-primary button-xsmall" href="javascript:void(0)">企業登録（Regist）</a>
								</div>
							</div>
							<div class="pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
								<div class="l-box">
									<a class="pure-button pure-button-primary button-xsmall" style="background: rgb(223, 117, 20);" href="javascript:void(0)">企業編集（Edit）</a>
								</div>
							</div>
							<div class="pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
								<div class="l-box">
									<a class="pure-button pure-button-primary button-xsmall" href="javascript:void(0)">求人票登録（Regist）</a>
								</div>
							</div>
							<div class="pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
								<div class="l-box">
									<a class="pure-button pure-button-primary button-xsmall" style="background: rgb(223, 117, 20);" href="javascript:void(0)">求人票編集（Edit）</a>
								</div>
							</div>
				</div>
EOT;
}

function topnav_menu(){
	echo <<<EOT
	<div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="">Your Site</a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item pure-menu-selected"><a href="#" class="pure-menu-link">Home</a></li>
            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Tour</a></li>
            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Sign Up</a></li>
        </ul>
    </div>
EOT;
}
