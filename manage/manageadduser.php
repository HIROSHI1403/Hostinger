<?php
include 'managefunctions.php';
include 'manageHTMLdoc.php';
include 'manageContent.php';
include 'manageHeader.php';

if (empty($_SESSION['managename'])){
	$_SESSION['ERR_LOGIN'] = $msg_row['4']['msg'];
	header("Location: {$rootURLmanage}managelogin.php");
}

if (isset($_POST['user_submit'])){
	if ($_POST['username']=="" or $_POST['useremail']==""){
		$add_alert = $msg_row['7']['msg'];
	}else {
		$username = $_POST['username'];
		$useremail = $_POST['useremail'];
		$testResult = RUN_SQLI_DEFAULTLOGIN("SELECT * FROM user WHERE user_name = '{$username}';");
		if (!$testResult){
			$add_alert = $msg_row['4']['msg'];
		}elseif (mysqli_num_rows($testResult)!=0) {
			$add_alert = $msg_row['5']['msg'];
		}else {
			$testResult_email = RUN_SQLI_DEFAULTLOGIN("SELECT * FROM user WHERE user_email = '{$useremail}';");
			if (!$testResult_email){
				$add_alert = $msg_row['4']['msg'];
			}elseif (mysqli_num_rows($testResult_email)!=0){
				$add_alert = $msg_row['6']['msg'];
			}else{
				$yyyymmdd = $_REQUEST['year'].$_REQUEST['month'].$_REQUEST['day'];
				$userpassword_default = password_hash('1234', PASSWORD_DEFAULT);
				$result = RUN_SQLI_DEFAULTLOGIN("INSERT INTO user(user_name, user_password,user_email, user_birth) VALUES ('{$_POST['username']}','{$userpassword_default}','{$_POST['useremail']}','{$yyyymmdd}')");
				if (!$result){
					$add_alert = $msg_row['2']['msg'];
				}else {
					$add_alert = $msg_row['1']['msg'];
				}
			}
		}	
	}
}

if (isset($_POST['user_reset'])){
	header("Location: " . $_SERVER['PHP_SELF']);
}

?>


<?php 
	manage_htmlhead();
?>


<?php 
	manage_main_nav();
?>

        <div id="page-wrapper">
            <?php 
				manage_content_useradd($add_alert);
          	?>
        </div>
        <!-- /#page-wrapper -->
        
        
<?php 
	manage_htmlfoot();
?>
