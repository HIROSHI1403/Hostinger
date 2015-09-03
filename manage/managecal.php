<?php
include 'managefunctions.php';
include 'manageHTMLdoc.php';
include 'manageContent.php';
include 'manageHeader.php';

if (empty($_SESSION['managename'])){
	$_SESSION['ERR_LOGIN'] = $msg_row['4']['msg'];
	header("Location: {$rootURLmanage}managelogin.php");
}

if (isset($_POST['cal_submit'])){
	if ($_POST['cal_contents']=="" or $_POST['cal_sub_contents']==""){
		$alert_cal = $msg_row['13']['msg'];
	}else {
		$calcontents = $_POST['cal_contents'];
		$calsubcontents = $_POST['cal_sub_contents'];
		$cal_yyyymmdd = $_REQUEST['year'].'-'.$_REQUEST['month'].'-'.$_REQUEST['day'];
		
		if (isset($_POST['select_compname'])){
			$select_compid = $_POST['select_compname'];
		}else {
			$select_compid = $_POST['select_compname'];
		}
		$calqs = <<<EOM
		INSERT INTO 
			calData (
				cal_comp_id, 
				cal_job_id, 
				cal_date, 
				cal_contants, 
				cal_sub_contents
			) 
		VALUES (
			'{$select_compid}', 
			'', 
			'{$cal_yyyymmdd}', 
			'{$calcontents}', 
			'{$calsubcontents}'
		);
EOM;
		$calresult = RUN_SQLI_DEFAULTLOGIN($calqs);
		if (!$calresult){
			$alert_cal = $msg_row['2']['msg'];
		}else {
			$alert_cal = $msg_row['1']['msg'];
		}
	}
}

if (isset($_POST['cal_update'])){
	if ($_POST['cal_contents_update']=="" or $_POST['cal_sub_contents_update']==""){
		$alert_cal = $msg_row['13']['msg'];
	}else {
		$calcontents_update = $_POST['cal_contents_update'];
		$calsubcontents_update = $_POST['cal_sub_contents_update'];
		$cal_yyyymmdd_update = $_REQUEST['year'].'-'.$_REQUEST['month'].'-'.$_REQUEST['day'];
		$calupdateid = $_POST['cal_update'];
		
		if(isset($_POST['select_compname_update'])){
			$select_compid_update = $_POST['select_compname_update'];
		}else {
			$select_compid_update = $_POST['select_compname_update'];
		}
		
		$calqs_update = <<<EOM
			UPDATE	calData
			SET
				cal_comp_id = '{$select_compid_update}',
				cal_job_id = '',
				cal_date = '{$cal_yyyymmdd_update}',
				cal_contants = '{$calcontents_update}',
				cal_sub_contents = '$calsubcontents_update'
			WHERE
				cal_id	= {$calupdateid};
EOM;
		$calupdate_result = RUN_SQLI_DEFAULTLOGIN($calqs_update);
		if (!$calupdate_result){
			$alert_cal = $msg_row['4']['msg'];
		}else {
			$alert_cal = $msg_row['10']['msg'];
		}
		
	}
}

if (isset($_POST['caldel'])){
	$caldel_query_str =<<<EOM
	DELETE
	FROM
		calData
	WHERE
		cal_id = {$_POST['caldel']};
EOM;
	$caldel_result = RUN_SQLI_DEFAULTLOGIN($caldel_query_str);
	if (!$caldel_result){
		$alert_cal = $msg_row['15']['msg'];
	}else {
		$alert_cal = $msg_row['12']['msg'];
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
				manage_content_cal($alert_cal);
          	?>
        </div>
        <!-- /#page-wrapper -->
        
        
<?php 
	manage_htmlfoot();
?>
