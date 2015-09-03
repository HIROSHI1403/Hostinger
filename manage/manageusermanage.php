<?php
include 'managefunctions.php';
include 'manageHTMLdoc.php';
include 'manageContent.php';
include 'manageHeader.php';

if (empty($_SESSION['managename'])){
	$_SESSION['ERR_LOGIN'] = $msg_row['4']['msg'];
	header("Location: {$rootURLmanage}managelogin.php");
}

if (isset($_POST['userdel'])){
	RUN_SQLI_DEFAULTLOGIN("DELETE FROM `testOpenDev1_db`.`user` WHERE `user`.`no` = {$_POST['userdel']}");
}


if (isset($_POST['user_update'])){
	if ($_POST['username']=="" or $_POST['useremail']==""){
		$add_alert = $msg_row['7']['msg'];
	}else {
		$username = $_POST['username'];
		$useremail = $_POST['useremail'];
		$yyyymmdd = $_REQUEST['year'].$_REQUEST['month'].$_REQUEST['day'];
		$result = RUN_SQLI_DEFAULTLOGIN("UPDATE user SET user_name='{$_POST['username']}',user_email='{$_POST['useremail']}',user_birth='{$yyyymmdd}' WHERE no = {$_POST['user_update']}");
		if (!$result){
			$add_alert = $msg_row['2']['msg'];
		}else {
			$add_alert = "「{$_POST['username']}」の情報を".$msg_row['10']['msg'];
		}
	}
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
				manage_content_usermanage($add_alert);
          	?>
        </div>
        <!-- /#page-wrapper -->
        
        
<?php 
	manage_htmlfoot();
?>
