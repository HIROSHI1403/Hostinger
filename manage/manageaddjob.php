<?php
include 'managefunctions.php';
include 'manageHTMLdoc.php';
include 'manageContent.php';
include 'manageHeader.php';

if (empty($_SESSION['managename'])){
	$_SESSION['ERR_LOGIN'] = $msg_row['4']['msg'];
	header("Location: {$rootURLmanage}managelogin.php");
}

if (isset($_POST['submit_addjob'])){
	$compnameid = RUN_SQLI_DEFAULTLOGIN("SELECT comp_id FROM comp_info WHERE comp_name = '{$_REQUEST['select_compname']}'");
	if ($compnameid->num_rows!=0){
		$compnameid_result = $compnameid->fetch_assoc();
		
		if (empty($_POST['business_form']) or
				empty($_POST['business_educational']) or
				empty($_POST['business_job_category']) or
				empty($_POST['business_base_salary'])){
		
			$add_alert = $msg_row['8']['msg'];
		}else {
			die("
			INSERT INTO
				job_info(
					comp_id,
					business_form,
					educational,
					job_category,
					job_discription,
					base_salary,
					commuting_allowance,
					housing_allowance,
					family_allowance,
					bonus,
					salary_increase,
					other_allowance,
					ave_overtime,
					holiday,
					paid_leave,
					paid_acquisition_rate,
					join_insurance,
					trial_period,
					saverance_pay,
					base_union,
					dormitory_system,
					other1
				) VALUES (
					'{$compnameid_result['comp_id']}',
					'{$_POST['business_form']}',
					'{$_POST['business_educational']}',
					'{$_POST['business_job_category']}',
					'{$_POST['business_discription']}',
					'{$_POST['business_base_salary']}',
					'{$_POST['option_commuting_allowance']}',
					'{$_POST['option_housing_allowance']}',
					'{$_POST['option_family_allowance']}',
					'{$_POST['option_bonus']}',
					'{$_POST['option_salary_increase']}',
					'{$_POST['option_other_allowance']}',
					'{$_POST['ave_overtime']}',
					'{$_POST['holiday']}',
					'{$_POST['pail_leave']}',
					'{$_POST['accquisition_rate']}',
					'{$_POST['option_join_insurance']}',
					'{$_POST['trial_period']}',
					'{$_POST['saverance_pay']}',
					'{$_POST['base_union']}',
					'{$_POST['option_dormitory_system']}',
					'{$_POST['other_1']}'
				)
				");
			$jobadd_result = RUN_SQLI_DEFAULTLOGIN("
			INSERT INTO
				job_info(
					comp_id,
					business_form,
					educational,
					job_category,
					job_discription,
					base_salary,
					commuting_allowance,
					housing_allowance,
					family_allowance,
					bonus,
					salary_increase,
					other_allowance,
					ave_overtime,
					holiday,
					paid_leave,
					paid_acquisition_rate,
					join_insurance,
					trial_period,
					saverance_pay,
					base_union,
					dormitory_system,
					other1
				) VALUES (
					'{$compnameid_result['comp_id']}',
					'{$_POST['business_form']}',
					'{$_POST['business_educational']}',
					'{$_POST['business_job_category']}',
					'{$_POST['business_discription']}',
					'{$_POST['business_base_salary']}',
					'{$_POST['option_commuting_allowance']}',
					'{$_POST['option_housing_allowance']}',
					'{$_POST['option_family_allowance']}',
					'{$_POST['option_bonus']}',
					'{$_POST['option_salary_increase']}',
					'{$_POST['option_other_allowance']}',
					'{$_POST['ave_overtime']}',
					'{$_POST['holiday']}',
					'{$_POST['pail_leave']}',
					'{$_POST['accquisition_rate']}',
					'{$_POST['option_join_insurance']}',
					'{$_POST['trial_period']}',
					'{$_POST['saverance_pay']}',
					'{$_POST['base_union']}',
					'{$_POST['option_dormitory_system']}',
					'{$_POST['other_1']}'
				)
				");
		$add_alert = $msg_row['1']['msg'];
		}
	}else {
		$add_alert = $msg_row['11']['msg'];
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
				manage_content_addjob($add_alert);
          	?>
        </div>
        <!-- /#page-wrapper -->
        
        
<?php 
	manage_htmlfoot();
?>
