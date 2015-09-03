<?php
include 'managefunctions.php';
include 'manageHTMLdoc.php';
include 'manageContent.php';
include 'manageHeader.php';

if (empty($_SESSION['managename'])){
	$_SESSION['ERR_LOGIN'] = $msg_row['4']['msg'];
	header("Location: {$rootURLmanage}managelogin.php");
}

if (isset($_POST['submit_compadd'])){
	if (empty($_POST['comp_name']) or   
		empty($_POST['comp_name_kana']) or    
		empty($_POST['comp_zipcode']) or 
		empty($_POST['comp_street_address']) or    
		empty($_POST['comp_ceo_name']) or  
		empty($_POST['comp_adopt_name']) or 
		empty($_POST['comp_tel1']) or  
		empty($_POST['comp_email']) or  
		empty($_POST['comp_business'])){
		
	$add_alert = $msg_row['8']['msg'];
	
	}else {
		$compadd_result = RUN_SQLI_DEFAULTLOGIN("INSERT INTO 
					comp_info(
						comp_name,
						comp_name_kana,
						comp_zipcode,
						comp_street_address,
						comp_ceo_name,
						comp_adopt_name,
						comp_fundation,
						comp_public,
						comp_capital,
						comp_annual_business,
						comp_tel_1,
						comp_fax_1,
						comp_tel_2,
						comp_fax_2,
						comp_url,
						comp_email,
						comp_employee_male,
						comp_employee_female,
						comp_a_ns,
						comp_b_ns,
						comp_c_ns,
						comp_business,
						comp_other_1
					) VALUES (
						'{$_POST['comp_name']}',
						'{$_POST['comp_name_kana']}',
						'{$_POST['comp_zipcode']}',
						'{$_POST['comp_street_address']}',
						'{$_POST['comp_ceo_name']}',
						'{$_POST['comp_adopt_name']}',
						'{$_POST['comp_foundation']}',
						'{$_POST['comp_public']}',
						'{$_POST['comp_capital']}',
						'{$_POST['comp_annual_business']}',
						'{$_POST['comp_tel1']}',
						'{$_POST['comp_fax1']}',
						'{$_POST['comp_tel2']}',
						'{$_POST['comp_fax2']}',
						'{$_POST['comp_url']}',
						'{$_POST['comp_email']}',
						'{$_POST['comp_employee_mele']}',
						'{$_POST['comp_employee_female']}',
						'{$_POST['comp_a_ns']}',
						'{$_POST['comp_b_ns']}',
						'{$_POST['comp_c_ns']}',
						'{$_POST['comp_business']}',
						'{$_POST['comp_other1']}'
					)");
		if (!$compadd_result){
			$serch_compname = RUN_SQLI_DEFAULTLOGIN("SELECT comp_name FROM comp_info WHERE comp_name = '{$_POST['comp_name']}'");
			if (mysqli_num_rows($serch_compname)!=0){
				$add_alert = $msg_row['9']['msg']."<br>または「{$_POST['comp_name']}」はすでに登録されています。";
			}else {
				$add_alert = $msg_row['9']['msg'];
			}
		}else {
			$add_alert = $msg_row['1']['msg'];
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
				manage_content_addcomp($add_alert);
          	?>
        </div>
        <!-- /#page-wrapper -->


<?php
	manage_htmlfoot();
?>
