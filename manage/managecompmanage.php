<?php
include 'managefunctions.php';
include 'manageHTMLdoc.php';
include 'manageContent.php';
include 'manageHeader.php';

if (empty($_SESSION['managename'])){
	$_SESSION['ERR_LOGIN'] = $msg_row['4']['msg'];
	header("Location: {$rootURLmanage}managelogin.php");
}

if (isset($_POST['compdel'])){
	RUN_SQLI_DEFAULTLOGIN("DELETE FROM `testOpenDev1_db`.`comp_info` WHERE `comp_info`.`comp_id` = {$_POST['compdel']}");
	$add_alert = $msg_row['12']['msg'];
}

if (isset($_POST['comp_update'])){
	$comp_update = RUN_SQLI_DEFAULTLOGIN("
		UPDATE comp_info 
		SET 
			comp_ad='',
			comp_name='{$_POST['comp_name']}',
			comp_name_kana='{$_POST['comp_name_kana']}',
			comp_zipcode='{$_POST['comp_zipcode']}',
			comp_street_address='{$_POST['comp_street_address']}',
			comp_ceo_name='{$_POST['comp_ceo_name']}',
			comp_adopt_name='{$_POST['comp_adopt_name']}',
			comp_fundation='{$_POST['comp_foundation']}',
			comp_public='{$_POST['comp_public']}',
			comp_capital='{$_POST['comp_capital']}',
			comp_annual_business='{$_POST['comp_annual_business']}',
			comp_tel_1='{$_POST['comp_tel1']}',
			comp_fax_1='{$_POST['comp_fax1']}',
			comp_tel_2='{$_POST['comp_tel2']}',
			comp_fax_2='{$_POST['comp_fax2']}',
			comp_url='{$_POST['comp_url']}',
			comp_email='{$_POST['comp_email']}',
			comp_employee_male='{$_POST['comp_employee_male']}',
			comp_employee_female='{$_POST['comp_employee_female']}',
			comp_a_ns='{$_POST['comp_a_ns']}',
			comp_b_ns='{$_POST['comp_b_ns']}',
			comp_c_ns='{$_POST['comp_c_ns']}',
			comp_business='{$_POST['comp_business']}',
			comp_other_1='{$_POST['comp_other1']}',
			comp_imageid_1='{$_POST['']}' 
		WHERE comp_id='{$_POST['comp_update']}';
	");
	if (!$comp_update){
		$add_alert = $msg_row['9']['msg'];
	}else{
		$add_alert = $msg_row['1']['msg'];
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
				manage_content_compmanage($add_alert);
          	?>
        </div>
        <!-- /#page-wrapper -->
        
        
<?php 
	manage_htmlfoot();
?>
