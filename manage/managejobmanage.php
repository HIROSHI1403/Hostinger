<?php
include 'managefunctions.php';
include 'manageHTMLdoc.php';
include 'manageContent.php';
include 'manageHeader.php';

if (empty($_SESSION['managename'])){
	$_SESSION['ERR_LOGIN'] = $msg_row['4']['msg'];
	header("Location: {$rootURLmanage}managelogin.php");
}

if (isset($_POST[''])){
	RUN_SQLI_DEFAULTLOGIN("");
}

if (isset($_POST['jobdel'])){
	RUN_SQLI_DEFAULTLOGIN("DELETE FROM job_info WHERE job_info.job_info_id = {$_POST['jobdel']}");
}

if (isset($_POST['job_update'])){
	$compnameid = RUN_SQLI_DEFAULTLOGIN("SELECT comp_id FROM comp_info WHERE comp_name = '{$_REQUEST['select_compname']}'");
	if ($compnameid->num_rows!=0){
		$compnameid_result = $compnameid->fetch_assoc();
		
		if (empty($_POST['business_form']) or
				empty($_POST['business_educational']) or
				empty($_POST['business_job_category']) or
				empty($_POST['business_base_salary'])){
		
			$add_alert = $msg_row['8']['msg'];
		}else {
			$job_update = RUN_SQLI_DEFAULTLOGIN("
				UPDATE
					job_info
				SET
					comp_id={$compnameid_result['comp_id']},
					business_form='{$_POST['business_form']}',
					educational='{$_POST['business_educational']}',
					job_category='{$_POST['business_job_category']}',
					job_discription='{$_POST['business_discription']}',
					base_salary='{$_POST['business_base_salary']}',
					commuting_allowance='{$_POST['option_commuting_allowance']}',
					housing_allowance='{$_POST['option_housing_allowance']}',
					family_allowance='{$_POST['option_family_allowance']}',
					bonus='{$_POST['option_bonus']}',
					salary_increase='{$_POST['option_salary_increase']}',
					other_allowance='{$_POST['option_other_allowance']}',
					ave_overtime='{$_POST['ave_overtime']}',
					holiday='{$_POST['holiday']}',
					paid_leave='{$_POST['pail_leave']}',
					paid_acquisition_rate='{$_POST['accquisition_rate']}',
					join_insurance='{$_POST['option_join_insurance']}',
					trial_period='{$_POST['trial_period']}',
					saverance_pay='{$_POST['saverance_pay']}',
					base_union='{$_POST['base_union']}',
					dormitory_system='{$_POST['option_dormitory_system']}',
					other1='{$_POST['other_1']}'
				WHERE job_info_id = {$_POST['job_update']}");
			if (!$job_update){
				$add_alert = $msg_row['9']['msg'];
			}else {
				$add_alert = $msg_row['1']['msg'];
			}	
		}
	}else {
		
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
				manage_content_jobmanage($add_alert);
          	?>
        </div>
        <!-- /#page-wrapper -->
        
        
<?php 
	manage_htmlfoot();
?>
