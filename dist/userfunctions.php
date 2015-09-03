<?php
//ini_set('display_errors', 'Off');

$rootURLdist = "http://development.roundstone.besaba.com/jios/dist/";
$mySQLAddress = "mysql.hostinger.jp";
$mainDbUserName = "u406628090_root2";
$mainDbPass = "rnw1234";
$mainDbName = "u406628090_demo";

session_start();

if (strstr($_SERVER["REQUEST_URI"], 'userlogin.php')){
	if (!isset($_SESSION)){
		session_start();
	}
}elseif (strstr($_SERVER["REQUEST_URI"], 'userfirst.php')){
	if (!isset($_SESSION)){
		session_start();
	}
}else {
	if (!isset($_SESSION)){
		session_start();
		header("Location: {$rootURLdist}userlogin.php");
	}elseif($_SESSION['FIRST']===false){
		header("Location: {$rootURLdist}userfirst.php?login=first");
	}elseif (!isset($_SESSION['USERNAME'])){
		header("Location: {$rootURLdist}userlogin.php");
	}
}

$user_mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
if ($user_mysqli->connect_error){
	$user_mysqli->close();
	exit();
}

$msg_row = array();
$query_str_msg = "SELECT msg FROM msg";
$msg_result = $user_mysqli->query($query_str_msg);
if (!$msg_result){
	exit();
}else {
	while ($rowrow = $msg_result->fetch_assoc()) {
		$msg_row[] = $rowrow;
	}
	// $msg_row = $msg_result->fetch_array();
}

function rewrite($var){
	$ver=null;
}

function RUN_SQLI_DEFAULTLOGIN($SQL_STR){
	if (!isset($SQL_STR)) {
		return $msg_row['3']['msg'];
	}
	global $mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName,$rootURLmanage,$user_mysqli,$msg_row;
	return $user_mysqli->query($SQL_STR);
}

function PAGING($get_page_num,$main_str_query,$categoryVal){
	$page = $get_page_num;
	if ($page==''){
		$page=1;
	}
	if ($categoryVal==""){
		$categoryVal=4;
	}
	$page=max($page,1);
	$count = RUN_SQLI_DEFAULTLOGIN($main_str_query);
	$stmt = $count->num_rows;
	$maxPage = ceil($stmg/$categoryVal);
	$page = min($page,$maxPage);

	$startPage = ($page-1);

	return RUN_SQLI_DEFAULTLOGIN($main_str_query.' '.$startPage.','.$categoryVal);
}

function userheader(){
	global $rootURLdist;
	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;


	if (strstr($_SERVER["REQUEST_URI"], 'userlogin.php')){
		echo <<< EOT
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="{$rootURLdist}swipeTest.php">JIOS system</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
    </div>
</div>

EOT;
	}elseif (strstr($_SERVER["REQUEST_URI"], 'login=first')){
		echo <<< EOT
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="{$rootURLdist}swipeTest.php">JIOS system</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
    </div>
</div>

EOT;
	}else{
		echo <<< EOT
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{$rootURLdist}swipeTest.php">JIOS system</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
        <ul class="nav navbar-nav">
            <li class=""><a href="{$rootURLdist}swipeTest.php#main_cal">カレンダー</a></li>
            <li class="dropdown">
                <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">求人票<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{$rootURLdist}swipeTest.php#main_jobvote_pickup">ピックアップ求人</a></li>
                    <li><a href="{$rootURLdist}swipeTest.php#main_jobvote_new">新着求人</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li style="background:#EEE;color:#999;"><a href="javascript:void(0)">{$_SESSION['USERNAME']}</a></li>
            <li class="dropdown">
                <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-right:15px;">ユーザーメニュー <b class="caret"></b> </a>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)">情報</a></li>
                    <li><a href="{$rootURLdist}userfirst.php">設定</a></li>
                    <li><a href="javascript:void(0)">担当へ連絡</a></li>
                    <li class="divider"></li>
                    <li><a href="{$rootURLdist}userlogout.php">ログアウト</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

EOT;
	}
}

function userlistgroup(){
	echo <<< EOT
<div class="list-group">
    <div class="list-group-item">
        <div class="row-action-primary checkbox">
            <label><input type="checkbox"></label>
        </div>
        <div class="row-content">
            <h4 class="list-group-item-heading">Tile with a checkbox in it</h4>
            <p class="list-group-item-text">Donec id elit non mi risus varius blandit.</p>
        </div>
    </div>

    <div class="list-group-separator"></div>
</div>
EOT;
}

function userlistgroup_demo(){
	echo <<< EOT
<div class="list-group">
    <div class="list-group-item">
        <div class="row-picture">
            <img class="circle" src="http://lorempixel.com/56/56/people/1" alt="icon">
        </div>
        <div class="row-content">
            <h4 class="list-group-item-heading">Tile with avatar</h4>
            <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus</p>
        </div>
    </div>
    <div class="list-group-separator"></div>
    <div class="list-group-item">
        <div class="row-picture">
            <img class="circle" src="http://lorempixel.com/56/56/people/6" alt="icon">
        </div>
        <div class="row-content">
            <h4 class="list-group-item-heading">Tile with another avatar</h4>
            <p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
        </div>
    </div>
    <div class="list-group-separator"></div>
    <div class="list-group-item">
        <div class="row-action-primary checkbox">
            <label><input type="checkbox"></label>
        </div>
        <div class="row-content">
            <h4 class="list-group-item-heading">Tile with a checkbox in it</h4>
            <p class="list-group-item-text">Donec id elit non mi risus varius blandit.</p>
        </div>
    </div>
    <div class="list-group-separator"></div>
</div>
EOT;
}

function userpanel_date(){
	echo <<<EOT
<div class="panel panel-default sampleBox">
    <div class="panel-body">
        Basic panel<br>
			こんにちはこれはデモのパネルです。<br>
			基本的にここには、求人票が入ります。<br>
			もっと文字を入力したり。<br>
			画像をクリックできるようにIDなどを基準にします。<br>
			ここに入る文字制限は基本的にありません。
    </div>
</div>
EOT;
}

function userpanel_n(){


	echo <<<EOT
<div class="panel panel-default">
    <div class="panel-body linkbox">
        <h4>Basic panel</h4>
			こんにちはこれはデモのパネルです。<br>
			基本的にここには、求人票が入ります。<br>
			もっと文字を入力したり。<br>
			画像をクリックできるようにIDなどを基準にします。<br>
			ここに入る文字制限は基本的にありません。
		<a href="#"></a>
    </div>
</div>
EOT;
}

function userpanel_pick(){
	echo <<<EOT
<div class="panel panel-default sampleBox">
    <div class="panel-body">
		<span class="label label-success">PICK UP</span>
        <h4>Basic panel</h4>
			こんにちはこれはデモのパネルです。<br>
			基本的にここには、求人票が入ります。<br>
			もっと文字を入力したり。<br>
			画像をクリックできるようにIDなどを基準にします。<br>
			ここに入る文字制限は基本的にありません。
    </div>
</div>
EOT;
}

function userpanel_pick_adopt($pageNum,$content_num){
	global $rootURLdist;
	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;

	$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
	if ($mysqli->connect_error){
		return error_MSG(1);
		$mysqli->close();
		exit();
	}else {

		$page = $pageNum;
		if ($page==''){
			$page = 1;
		}
		$page=max($page,1);

		$query_str = "SELECT comp_info.comp_name,comp_name_kana,job_info.* FROM comp_info INNER JOIN job_info ON comp_info.comp_id = job_info.comp_id";


		$count = $mysqli->query($query_str);
		$stmt = $count->num_rows;
		$maxPage = ceil($stmt/$content_num);
		$page = min($page,$maxPage);

		$start=($page-1)*$content_num;

		$result = $mysqli->query($query_str.' LIMIT '.$start.','.$content_num);
		if (!$result){
			return error_MSG(6);
			exit();
		}else {

			echo <<<EOT
			<div class="col-md-12">
				<ul class="pager">
EOT;

			$minus=$page-1;
			$plus=$page+1;
			$minus_url = $rootURLdist.'swipeTest.php?page='.$minus.'#main_jobvote_pickup';
			$plus_url = $rootURLdist.'swipeTest.php?page='.$plus.'#main_jobvote_pickup';
			if ($page<$maxPage){
				echo<<<EOT
				<li class="next"><a href="{$plus_url}">NEXT →</a></li>
EOT;
			}
			if ($page>1){
				echo<<<EOT
				<li class="previous"><a href="{$minus_url}">← PREV</a></li>
EOT;
			}
			echo<<<EOT
				</ul>
			</div>
EOT;

			while ($row = $result->fetch_assoc()){
				$business_form_str = mb_strimwidth($row['business_form'], 0, 13,'…','utf-8');
				$job_discription_str = mb_strimwidth($row['job_discription'], 0, 40,'…','utf-8');
				$base_salary_str = mb_strimwidth($row['base_salary'], 0, 40,'…','utf-8');
				$bonus_str = mb_strimwidth($row['bonus'], 0, 40,'…','utf-8');
				echo <<<EOT
				<div class="col-md-6 linkbox">
					<div class="panel panel-default">
					    <div class="panel-body">
							<span class="label label-success">PICK UP</span>
					        <h4>{$row['comp_name']}</h4>
					        <ul class="list-group">
					        	<li class="list-group-item"><strong>雇用形態 ＞ </strong>{$business_form_str}</li>
					        	<li class="list-group-item"><strong>仕事内容 ＞ </strong>{$job_discription_str}</li>
					        	<li class="list-group-item"><strong>基本給　 ＞ </strong>{$base_salary_str}</li>
					        	<li class="list-group-item"><strong>賞与　　 ＞ </strong>{$bonus_str}</li>
					        </ul>
					    </div>
					</div>
					<a href="{$rootURLdist}compad.php?comp_id={$row['comp_id']}&job_info_id={$row['job_info_id']}"></a>
				</div>
EOT;
			}
		}
		echo <<<EOT
			<div class="col-md-12">
				<ul class="pager">
EOT;

		$minus=$page-1;
		$plus=$page+1;
		$minus_url = $rootURLdist.'swipeTest.php?page='.$minus.'#main_jobvote_pickup';
		$plus_url = $rootURLdist.'swipeTest.php?page='.$plus.'#main_jobvote_pickup';
		if ($page<$maxPage){
			echo<<<EOT
				<li class="next"><a href="{$plus_url}">NEXT →</a></li>
EOT;
		}
		if ($page>1){
			echo<<<EOT
				<li class="previous"><a href="{$minus_url}">← PREV</a></li>
EOT;
		}
		echo<<<EOT
				</ul>
			</div>
EOT;

	}
}

function userbreadcrumbs_demo(){

	global $rootURLdist;

	if (preg_match("/compad.php/", $_SERVER["REQUEST_URI"])){
		echo <<< EOT
<ul class="breadcrumb" style="margin-bottom: 5px; margin-top: 65px;">
    <li><a href="{$rootURLdist}swipeTest.php" class="">Home</a></li>
    <li class="active">求人詳細</li>
</ul>
EOT;
	}elseif (preg_match("/swipeTest.php/", $_SERVER["REQUEST_URI"])){
		echo <<<EOT
<ul class="breadcrumb" style="margin-bottom: 5px; margin-top: 65px;">
    <li class="active">Home</a></li>
</ul>
EOT;
	}elseif (preg_match("/userfirst.php/", $_SERVER["REQUEST_URI"])){
		echo <<<EOT
		<ul class="breadcrumb" style="margin-bottom: 5px; margin-top: 65px;">
		    <li><a href="{$rootURLdist}userlogin.php" class="">Home(login)</a></li>
		    <li class="active">初回認証・パスワード・設定</li>
		</ul>
EOT;
	}else {
		echo <<<EOT
<ul class="breadcrumb" style="margin-bottom: 5px; margin-top: 65px;">
    <li class="active">Home</a></li>
</ul>
EOT;
	}
}

function userpanel_n_adopt($serchpt_query_str){
	global $rootURLdist;
	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;


	$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
	if ($mysqli->connect_error){
		return error_MSG(1);
		$mysqli->close();
		exit();
	}else {
		if (isset($serchpt_query_str)){
			$query_str = $serchpt_query_str;
		}else {
			$query_str = "SELECT comp_info.comp_name,comp_name_kana,job_info.* FROM comp_info INNER JOIN job_info ON comp_info.comp_id = job_info.comp_id";
		}
		$result = $mysqli->query($query_str);
		if (!$result){
			return error_MSG(6);
			exit();
		}else {
			while ($row = $result->fetch_assoc()){
				$comp_name_str = mb_strimwidth($row['comp_name'], 0, 30,'…','utf-8');
				$business_form_str = mb_strimwidth($row['business_form'], 0, 13,'…','utf-8');
				$job_discription_str = mb_strimwidth($row['job_discription'], 0, 25,'…','utf-8');
				$base_salary_str = mb_strimwidth($row['base_salary'], 0, 40,'…','utf-8');
				$bonus_str = mb_strimwidth($row['bonus'], 0, 40,'…','utf-8');
				echo <<< EOT
				<div class="col-md-4 linkbox">
					<div class="panel panel-default">
					    <div class="panel-body">
					        <h4>{$comp_name_str}</h4>
							<ul class="list-group">
							  	<li class="list-group-item"><strong>雇用形態 ＞ </strong>{$business_form_str}</li>
					        	<li class="list-group-item"><strong>仕事内容 ＞ </strong>{$job_discription_str}</li>
					        	<li class="list-group-item"><strong>基本給　 ＞ </strong>{$base_salary_str}</li>
					        	<li class="list-group-item"><strong>賞与　　 ＞ </strong>{$bonus_str}</li>
							</ul>
					    </div>
					</div>
					<a href="{$rootURLdist}compad.php?comp_id={$row['comp_id']}&job_info_id={$row['job_info_id']}"></a>
				</div>
EOT;
			}
		}


	}

}

function userpanel_n_demo(){
	echo <<<EOT
<div class="panel panel-default">
    <div class="panel-body">
        Basic panel
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Panel heading</div>
    <div class="panel-body">
        Panel content
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        Panel content
    </div>
    <div class="panel-footer">Panel footer</div>
</div>
EOT;
}

function  userblocklevel_demo(){
	echo <<<EOT
<div class="btn-toolbar">
    <div class="btn-group">
        <a href="javascript:void(0)" class="btn btn-default">1</a>
        <a href="javascript:void(0)" class="btn btn-default">2</a>
        <a href="javascript:void(0)" class="btn btn-default">3</a>
        <a href="javascript:void(0)" class="btn btn-default">4</a>
    </div>

    <div class="btn-group">
        <a href="javascript:void(0)" class="btn btn-default">5</a>
        <a href="javascript:void(0)" class="btn btn-default">6</a>
        <a href="javascript:void(0)" class="btn btn-default">7</a>
    </div>

    <div class="btn-group">
        <a href="javascript:void(0)" class="btn btn-default">8</a>
        <div class="btn-group">
            <a href="" data-target="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Dropdown
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="javascript:void(0)">Dropdown link</a></li>
                <li><a href="javascript:void(0)">Dropdown link</a></li>
                <li><a href="javascript:void(0)">Dropdown link</a></li>
            </ul>
        </div>
    </div>
</div>
EOT;
}

function userdateselect(){
	$time = time();
	$result_month = "";
	$result_year = "";
	$result_day = "";
	$month = date("n",$time);
	$year = date("Y",$time);
	$day = date("j",$time);

	for ($i=1900;$i<=$year+4;$i++	){
		if ($i == $year){
			$result_year .= "<option value=\"$i\" selected>$i</option>";
		}else{
			$result_year .= "<option value=\"$i\">$i</option>";
		}
	}

	for( $j = 1; $j <= 12; $j++ ){
		if ($j<10){
			if( $j == $month ){
				$result_month .= "<option value=\"0$j\" selected>0$j</option>";
			}else{
				$result_month .= "<option value=\"0$j\">0$j</option>";
			}
		}else{
			if( $j == $month ){
				$result_month .= "<option value=\"$j\" selected>$j</option>";
			}else{
				$result_month .= "<option value=\"$j\">$j</option>";
			}
		}
	}

	for( $k = 1; $k <=31 ; $k++ ){
		if ($k<10){
			if( $k == $day ){
				$result_day .= "<option value=\"0$k\" selected>0$k</option>";
			}else{
	            $result_day .= "<option value=\"0$k\">0$k</option>";
			}
		}else{
			if( $k == $day ){
				$result_day .= "<option value=\"$k\" selected>$k</option>";
			}else{
				$result_day .= "<option value=\"$k\">$k</option>";
			}
		}
	}

	echo <<<EOT

<div class="panel panel-default">
    <div class="panel-heading">年月日の選択</div>
    <div class="panel-body">
		<form class="form-horizontal">
		    <fieldset>
		        <div class="form-group">
	            	<div class="col-lg-10">
		                <select class="form-control" id="select">
		                    <option>年</option>
							{$result_year}
		                </select>
		                <br>
		                <select class="form-control" id="select">
		                    <option>月</option>
							{$result_month}
		                </select>
						<br>
						<select class="form-control" id="select">
							<option>日</option>
							{$result_day}
						</select>
					</div>
		        </div>
		        <div class="form-group" style="text-align: center;">
					<button type="submit" class="btn btn-primary">選択</button>
		        </div>
		    </fieldset>
		</form>
    </div>
</div>
EOT;
}

function usercal_demo(){
	echo <<< EOT
	<div class="panel panel-default">
		<div class="panel-heading" style="padding:8px 15px 8px 15px; text-align:right;">
			<a href="javascript:void(0)" id="cal_numbered" class="btn btn-flat btn-default" style="padding:0; margin:0;"><i class="mdi-editor-format-list-numbered" style="padding:0 30px 0 30px;"></i></a>
			<a href="javascript:void(0)" id="cal_headline" class="btn btn-flat btn-default" style="padding:0; margin:0;"><i class="mdi-action-view-headline" style="padding:0 30px 0 30px;"></i></a>
			<a href="javascript:void(0)" id="cal_week" class="btn btn-flat btn-default" style="padding:0; margin:0;"><i class="mdi-action-view-week" style="padding:0 30px 0 30px;"></i></a>
		</div>
		<div class="panel-body">
			<div class="swiper-container">
				<div class="swiper-wrapper">
EOT;

	echo <<<EOT
					<div class="swiper-slide" style="text-algin:left;">1日</div>
					<div class="swiper-slide">2日</div>
					<div class="swiper-slide">3日</div>
					<div class="swiper-slide">4日</div>
EOT;

echo <<< EOT
				</div>
			</div>
		</div>
	</div>
EOT;
}

function usercal_demo_v2($cal_Page){
	global $rootURLdist;

	$date = new DateTime();

	$calpage = $cal_Page;
	if ($calpage==''){
		$calpage = 1;
		$count = 4 * $calpage;;
	}else {
		$count = 4 * $calpage;
	}

	$calpage = max($calpage,1);
	$cal_y = $date->format('Y');
	$cal_m = $date->format('m');
	$cal_d = $date->format('d');
	$count = $count -4;
	$cal_date_first = date('Y/m/d',strtotime($date->format('Y/m/d')." + ".$count." days"));


	echo <<< EOT
		<ul class="nav nav-tabs" style="margin-bottom: 1px;">
		    <li class="active"><a href="#home" data-toggle="tab"><i class="mdi-action-view-week"></i></a></li>
		    <li><a href="#profile" data-toggle="tab"><i class="mdi-action-view-module"></i></a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
		    <div class="tab-pane fade active in" id="home" style="border:1px solid #D7D7D7;">
				<div class="row">
EOT;

	$calpage_plus = $calpage +1;
	$calpage_minus = $calpage -1;
	if ($calpage>1){
	echo <<< EOT
				<div class="col-xs-6"><a href="{$rootURLdist}swipeTest.php?calpage={$calpage_minus}" class="btn btn-default btn-xs">〈 PREV</a></div>
				<div class="col-xs-6" style="text-align:right;"><a href="{$rootURLdist}swipeTest.php?calpage={$calpage_plus}" class="btn btn-default btn-xs">NEXT 〉</a></div>
EOT;
	}else {
		echo <<< EOT
				<div class="col-xs-6"></div>
				<div class="col-xs-6" style="text-align:right;"><a href="{$rootURLdist}swipeTest.php?calpage={$calpage_plus}" class="btn btn-default btn-xs">NEXT 〉</a></div>
EOT;
	}
	echo <<< EOT
				</div>
				<div class="row">

EOT;

	for ($i = 1; $i <= 4 ;$i++){
		$calresult = RUN_SQLI_DEFAULTLOGIN("SELECT * From calData LEFT OUTER JOIN comp_info ON calData.cal_comp_id = comp_info.comp_id");
		if ($i===1){
			$cal_date = $cal_date_first;
// 			$calresult = RUN_SQLI_DEFAULTLOGIN("SELECT * FROM calData");
			echo<<<EOT
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">{$cal_date}</div>
				    <div class="panel-body">
EOT;
					while ($calrow = $calresult->fetch_assoc()){
						if (str_replace("/", "-", $cal_date) == $calrow['cal_date']){
							$calrow_crlf = nl2br($calrow['cal_sub_contents']);
							echo<<<EOT
							<a type="button" class="btn btn-flat btn-success btn-xs" data-toggle="modal" data-target="#myModal{$calrow['cal_id']}" style="margin:0;">{$calrow['cal_contants']}</a>
							<!-- Modal -->
							<div class="modal fade bs-example-modal-lg" id="myModal{$calrow['cal_id']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">{$calrow['comp_name']}</h4>
							      </div>
							      <div class="modal-body">
							      	<div class="bs-component">
			                            <div class="progress progress-striped active">
			                                <div class="progress-bar" style="width: 100%"></div>
			                            </div>
								  	</div>
							      	<div class="list-group">
									    <div class="list-group-item">
									        <div class="row-action-primary">
									            <i class="mdi-content-flag"></i>
									        </div>
									        <div class="row-content">
									            <div class="action-secondary"><i class="mdi-material-info"></i></div>
									            <h4 class="list-group-item-heading">題名</h4>
									            <p class="list-group-item-text"><p>{$calrow['cal_contants']}</p></p>
									        </div>
									    </div>
									    <div class="list-group-separator"></div>
									    <div class="list-group-item">
									        <div class="row-action-primary">
									            <i class="mdi-content-content-paste"></i>
									        </div>
									        <div class="row-content">
									            <div class="action-secondary"><i class="mdi-material-info"></i></div>
									            <h4 class="list-group-item-heading">詳細</h4>
									            <p class="list-group-item-text"><p>{$calrow_crlf}</p></p>
									        </div>
									    </div>
									    <div class="list-group-separator"></div>
									</div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-danger" data-dismiss="modal">閉じる</button>
							      </div>
							    </div>
							  </div>
							</div>
EOT;
						}else {
							echo<<<EOT
EOT;
						}
					}
			echo<<<EOT
				    </div>
				</div>
			</div>
EOT;
		}elseif ($i===2){
// 			$calresult = RUN_SQLI_DEFAULTLOGIN("SELECT * FROM calData");
			$cal_date = date('Y/m/d',strtotime($cal_date_first." +1 days "));
			echo<<<EOT
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">{$cal_date}</div>
				    <div class="panel-body">
EOT;
					while ($calrow = $calresult->fetch_assoc()){
						if (str_replace("/", "-", $cal_date) == $calrow['cal_date']){
							$calrow_crlf = nl2br($calrow['cal_sub_contents']);
							echo<<<EOT
							<a type="button" class="btn btn-flat btn-success btn-xs" data-toggle="modal" data-target="#myModal{$calrow['cal_id']}" style="margin:0;">{$calrow['cal_contants']}</a>
							<!-- Modal -->
							<div class="modal fade bs-example-modal-lg" id="myModal{$calrow['cal_id']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">{$calrow['comp_name']}</h4>
							      </div>
							      <div class="modal-body">
								      <div class="bs-component">
				                            <div class="progress progress-striped active">
				                                <div class="progress-bar" style="width: 100%"></div>
				                            </div>
									  </div>
							      	<div class="list-group">
									    <div class="list-group-item">
									        <div class="row-action-primary">
									            <i class="mdi-content-flag"></i>
									        </div>
									        <div class="row-content">
									            <div class="action-secondary"><i class="mdi-material-info"></i></div>
									            <h4 class="list-group-item-heading">題名</h4>
									            <p class="list-group-item-text"><p>{$calrow['cal_contants']}</p></p>
									        </div>
									    </div>
									    <div class="list-group-separator"></div>
									    <div class="list-group-item">
									        <div class="row-action-primary">
									            <i class="mdi-content-content-paste"></i>
									        </div>
									        <div class="row-content">
									            <div class="action-secondary"><i class="mdi-material-info"></i></div>
									            <h4 class="list-group-item-heading">詳細</h4>
									            <p class="list-group-item-text"><p>{$calrow_crlf}</p></p>
									        </div>
									    </div>
									    <div class="list-group-separator"></div>
									</div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-danger" data-dismiss="modal">閉じる</button>
							      </div>
							    </div>
							  </div>
							</div>
EOT;
						}else {
							echo<<<EOT
EOT;
						}
					}
			echo<<<EOT
				    </div>
				</div>
			</div>
EOT;
		}elseif ($i===3){
// 			$calresult = RUN_SQLI_DEFAULTLOGIN("SELECT * FROM calData");
			$cal_date = date('Y/m/d',strtotime($cal_date_first." +2 days "));
			echo<<<EOT
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">{$cal_date}</div>
				    <div class="panel-body">
EOT;
					while ($calrow = $calresult->fetch_assoc()){
						if (str_replace("/", "-", $cal_date) == $calrow['cal_date']){
							$calrow_crlf = nl2br($calrow['cal_sub_contents']);
							echo<<<EOT
							<a type="button" class="btn btn-flat btn-success btn-xs" data-toggle="modal" data-target="#myModal{$calrow['cal_id']}" style="margin:0;">{$calrow['cal_contants']}</a>
							<!-- Modal -->
							<div class="modal fade bs-example-modal-lg" id="myModal{$calrow['cal_id']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">{$calrow['comp_name']}</h4>
							      </div>
							      <div class="modal-body">
							      	<div class="bs-component">
			                            <div class="progress progress-striped active">
			                                <div class="progress-bar" style="width: 100%"></div>
			                            </div>
								  	</div>
							      	<div class="list-group">
									    <div class="list-group-item">
									        <div class="row-action-primary">
									            <i class="mdi-content-flag"></i>
									        </div>
									        <div class="row-content">
									            <div class="action-secondary"><i class="mdi-material-info"></i></div>
									            <h4 class="list-group-item-heading">題名</h4>
									            <p class="list-group-item-text"><p>{$calrow['cal_contants']}</p></p>
									        </div>
									    </div>
									    <div class="list-group-separator"></div>
									    <div class="list-group-item">
									        <div class="row-action-primary">
									            <i class="mdi-content-content-paste"></i>
									        </div>
									        <div class="row-content">
									            <div class="action-secondary"><i class="mdi-material-info"></i></div>
									            <h4 class="list-group-item-heading">詳細</h4>
									            <p class="list-group-item-text"><p>{$calrow_crlf}</p></p>
									        </div>
									    </div>
									    <div class="list-group-separator"></div>
									</div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-danger" data-dismiss="modal">閉じる</button>
							      </div>
							    </div>
							  </div>
							</div>
EOT;
						}else {
							echo<<<EOT
EOT;
						}
					}
			echo<<<EOT
				    </div>
				</div>
			</div>
EOT;
		}elseif ($i===4){
// 			$calresult = RUN_SQLI_DEFAULTLOGIN("SELECT * FROM calData");
			$cal_date = date('Y/m/d',strtotime($cal_date_first." +3 days "));
			echo<<<EOT
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">{$cal_date}</div>
				    <div class="panel-body">
EOT;
					while ($calrow = $calresult->fetch_assoc()){
						if (str_replace("/", "-", $cal_date) == $calrow['cal_date']){
							$calrow_crlf = nl2br($calrow['cal_sub_contents']);
							echo<<<EOT
							<a type="button" class="btn btn-flat btn-success btn-xs" data-toggle="modal" data-target="#myModal{$calrow['cal_id']}" style="margin:0;">{$calrow['cal_contants']}</a>
							<!-- Modal -->
							<div class="modal fade bs-example-modal-lg" id="myModal{$calrow['cal_id']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">{$calrow['comp_name']}</h4>
							      </div>
							      <div class="modal-body">
							      	<div class="bs-component">
			                            <div class="progress progress-striped active">
			                                <div class="progress-bar" style="width: 100%"></div>
			                            </div>
								  	</div>
							      	<div class="list-group">
									    <div class="list-group-item">
									        <div class="row-action-primary">
									            <i class="mdi-content-flag"></i>
									        </div>
									        <div class="row-content">
									            <div class="action-secondary"><i class="mdi-material-info"></i></div>
									            <h4 class="list-group-item-heading">題名</h4>
									            <p class="list-group-item-text"><p>{$calrow['cal_contants']}</p></p>
									        </div>
									    </div>
									    <div class="list-group-separator"></div>
									    <div class="list-group-item">
									        <div class="row-action-primary">
									            <i class="mdi-content-content-paste"></i>
									        </div>
									        <div class="row-content">
									            <div class="action-secondary"><i class="mdi-material-info"></i></div>
									            <h4 class="list-group-item-heading">詳細</h4>
									            <p class="list-group-item-text"><p>{$calrow_crlf}</p></p>
									        </div>
									    </div>
									    <div class="list-group-separator"></div>
									</div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-danger" data-dismiss="modal">閉じる</button>
							      </div>
							    </div>
							  </div>
							</div>
EOT;
						}else {
							echo<<<EOT
EOT;
						}
					}
			echo<<<EOT
				    </div>
				</div>
			</div>
EOT;
		}
	}

	echo<<< EOT
EOT;



	echo <<< EOT

				</div>
				<div class="row">
EOT;
	if ($calpage>1){
		echo <<< EOT
				<div class="col-xs-6"><a href="{$rootURLdist}swipeTest.php?calpage={$calpage_minus}" class="btn btn-default btn-xs">〈 PREV</a></div>
				<div class="col-xs-6" style="text-align:right;"><a href="{$rootURLdist}swipeTest.php?calpage={$calpage_plus}" class="btn btn-default btn-xs">NEXT 〉</a></div>
EOT;
	}else {
		echo <<< EOT
				<div class="col-xs-6"></div>
				<div class="col-xs-6" style="text-align:right;"><a href="{$rootURLdist}swipeTest.php?calpage={$calpage_plus}" class="btn btn-default btn-xs">NEXT 〉</a></div>
EOT;
	}
	echo <<< EOT
				</div>
		    </div>

		    <div class="tab-pane fade" id="profile" style="border:1px solid #D7D7D7;">
				<p class="text-danger"><small>この機能は現在利用できません。</small></p>
		        <div class="row">
					<div class="col-xs-1" style="padding:0 1px 0 15px;"><div class="alert alert-primary" role="alert" style="text-align:center;padding:0 1px 0 1px;"><small>日</small></div></div>
					<div class="col-xs-2" style="padding:0 1px 0 1px;"><div class="alert alert-primary" role="alert" style="text-align:center;padding:0 1px 0 1px;"><small>月</small></div></div>
					<div class="col-xs-2" style="padding:0 1px 0 1px;"><div class="alert alert-primary" role="alert" style="text-align:center;padding:0 1px 0 1px;"><small>火</small></div></div>
					<div class="col-xs-2" style="padding:0 1px 0 1px;"><div class="alert alert-primary" role="alert" style="text-align:center;padding:0 1px 0 1px;"><small>水</small></div></div>
					<div class="col-xs-2" style="padding:0 1px 0 1px;"><div class="alert alert-primary" role="alert" style="text-align:center;padding:0 1px 0 1px;"><small>木</small></div></div>
					<div class="col-xs-2" style="padding:0 1px 0 1px;"><div class="alert alert-primary" role="alert" style="text-align:center;padding:0 1px 0 1px;"><small>金</small></div></div>
					<div class="col-xs-1" style="padding:0 15px 0 1px;"><div class="alert alert-primary" role="alert" style="text-align:center;padding:0 1px 0 1px;"><small>土</small></div></div>
				</div>


				<div class="row">

				</div>
		    </div>
		</div>

EOT;
}

function usertable_demo(){
	echo <<<EOT
<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>#</th>
            <th>Column heading</th>
            <th>Column heading</th>
            <th>Column heading</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
        </tr>
        <tr class="info">
            <td>3</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
        </tr>
    </tbody>
</table>
EOT;
}

function user_form_sort_v1(){
	global $rootURLdist;
	echo <<<EOT

<div class="panel panel-default">
    <div class="panel-body">
      	<form class="form-horizontal" action="{$rootURLdist}swipeTest.php#main_jobvote_new" method="GET">
		    <fieldset>
				<legend><i class="mdi-action-search"></i>検索</legend>
				<div class="row">
					<div class="col-md-6">
				        <div class="form-group">
				            <label for="textArea" class="col-lg-3 control-label">フリーワード検索</label>
				            <div class="col-lg-9">
				                <textarea name="ufs_ft" class="form-control" rows="3" placeholder="企業名（漢字・カナ）、所在地（漢字）などの部分一致検索" id="textArea"></textarea>
				                <span class="help-block">フリーワードで企業名、職種、紹介文などから検索します。</span>
				            </div>
				        </div>

						<div class="form-group">
				            <label for="select" class="col-lg-3 control-label">雇用形態</label>
				            <div class="col-lg-9">
				                <select class="form-control" name="ufs_bf" id="select">
									<option>--</option>
EOT;
	$businessform_option_sort = RUN_SQLI_DEFAULTLOGIN("SELECT DISTINCT business_form FROM job_info ORDER BY business_form DESC");
	while ($bfos = $businessform_option_sort->fetch_assoc()){
		echo <<<EOT
			<option>{$bfos['business_form']}</option>
EOT;
	}

echo <<< EOT
				                </select>
				            </div>
				        </div>



					</div>


					<div class="col-md-6">
				        <div class="form-group">
				            <label for="select" class="col-lg-2 control-label">業種</label>
				            <div class="col-lg-10">
				                <select class="form-control" name="ufs_cb" id="select">
									<option>--</option>
EOT;
	$compbusiness_option_sort = RUN_SQLI_DEFAULTLOGIN("SELECT DISTINCT comp_business FROM comp_info ORDER BY comp_business DESC");
	while ($cbos = $compbusiness_option_sort->fetch_assoc()){
		echo <<<EOT
			<option>{$cbos['comp_business']}</option>
EOT;
	}

echo <<< EOT
				                </select>
				            </div>
				        </div>

						<div class="form-group">
				            <label for="select" class="col-lg-2 control-label">職種</label>
				            <div class="col-lg-10">
				                <select class="form-control" name="ufs_jc" id="select">
									<option>--</option>
EOT;
	$jobcategory_option_sort = RUN_SQLI_DEFAULTLOGIN("SELECT DISTINCT job_category FROM job_info ORDER BY job_category DESC");
	while ($jcos = $jobcategory_option_sort->fetch_assoc()){
		echo <<<EOT
			<option>{$jcos['job_category']}</option>
EOT;
	}

echo <<< EOT
				                </select>
				            </div>
				        </div>

						<div class="form-group">
				            <label for="select" class="col-lg-2 control-label">企業</label>
				            <div class="col-lg-10">
				                <select class="form-control" name="ufs_cn" id="select">
									<option>--</option>
EOT;

	$comp_option_sort = RUN_SQLI_DEFAULTLOGIN("SELECT * FROM comp_info ORDER BY comp_name DESC");
	while ($cos_row = $comp_option_sort->fetch_assoc()){
		echo <<< EOT
			<option>{$cos_row['comp_name']}</option>
EOT;
	}
echo <<<EOT
				                </select>
				            </div>
				        </div>


					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="btn-group btn-group-justified" role="group" aria-label="">
						  <div class="btn-group" role="group">
							<button type="submit" class="btn btn-primary" name="serch_adoption"><i class="mdi-action-search"></i><span style="vertical-align: 5px;">検索</span></button>
						  </div>
						</div>
					</div>
				</div>
		    </fieldset>
		</form>
    </div>
</div>
EOT;
}

function userlogin_demo(){
	global $rootURLdist;
	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;

	echo <<<EOT
		<div class="bs-docs-section">
                <div class="row">
					<div class="col-lg-6">
                        <div class="well bs-component">
                            <form class="form-horizontal" method="POST">
                                <fieldset>
                                    <legend>ログイン</legend>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-lg-2 control-label">Eメール</label>
                                        <div class="col-lg-10">
                                            <div class="form-control-wrapper">
												<input class="form-control floating-label" name="userlogin_mail" type="Email" placeholder="メールアドレス" data-hint="メールアドレス入力ミスにご注意ください。">
											</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">PASSWORD</label>
										<div class="col-lg-10">
                                        	<div class="form-control-wrapper">
												<input class="form-control floating-label" name="userlogin_pass" type="Password" placeholder="パスワード" data-hint="パスワードに入力ミスにご注意ください。">
											</div>
										</div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="submit" class="btn btn-primary" name="userlogin">ログイン</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
                    </div>
					<div class="col-lg-4 col-lg-offset-1">
						<h1>ようこそJIOSへ</h1>
						<h2>各種問い合わせ</h2>
						<p>各種お問い合わせは下記ボタンよりお問い合わせフォームにてお問い合わせ出来ます。</p>
						<a href="javascript:void(0)" class="btn btn-info btn-raised">問合わせ</a>
                    </div>
                </div>
            </div>
EOT;
}

function usercompadopt(){

	global $rootURLdist;
	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;

	$get_comp_id = $_GET['comp_id'];
	$get_job_info_id = $_GET['job_info_id'];

	$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
	if ($mysqli->connect_error){
		return error_MSG(1);
		$mysqli->close();
		exit();
	}else {
		$query_str = "SELECT comp_info.*,job_info.* FROM comp_info INNER JOIN job_info ON comp_info.comp_id = job_info.comp_id WHERE (((job_info.job_info_id)={$get_job_info_id}));";
		$query_str_image = "SELECT comp_info.*,job_info.*,image.* FROM (comp_info INNER JOIN job_info ON comp_info.comp_id = job_info.comp_id) INNER JOIN image ON job_info.job_info_id = image.job_info_id";
		$result = $mysqli->query($query_str);
		if (!$result){
			return error_MSG(6);
			exit();
		}else {
			while ($row = $result->fetch_assoc()){
				echo <<< EOT
		<div class = "row">
			<div class="col-md-8">
				<div class="panel panel-success">
				    <div class="panel-heading">
				        <h3 class="panel-title">求人情報</h3>
				    </div>
				    <div class="panel-body">
				        <a href="javascript:void(0)" class="btn btn-flat btn-success">他の類似求人を見る</a>
						<div class="bs-component">
                            <div class="progress progress-striped active">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
						<div class="list-group">
						    <div class="list-group-item">
						        <div class="row-action-primary">
						            <i class="mdi-action-assignment-ind"></i>
						        </div>
						        <div class="row-content">
						            <div class="least-content"></div>
						            <h4 class="list-group-item-heading">雇用形態</h4>
						            <p class="list-group-item-text">{$row['business_form']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>

						    <div class="list-group-item">
						        <div class="row-action-primary">
						            <i class="mdi-action-description"></i>
						        </div>
						        <div class="row-content">
						            <div class="least-content"></div>
						            <h4 class="list-group-item-heading">学歴</h4>
						            <p class="list-group-item-text">{$row['educational']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>

						    <div class="list-group-item">
						        <div class="row-action-primary">
						            <i class="mdi-action-perm-contact-cal"></i>
						        </div>
						        <div class="row-content">
						            <div class="least-content"></div>
						            <h4 class="list-group-item-heading">職種</h4>
						            <p class="list-group-item-text">{$row['job_category']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>

							<div class="list-group-item">
						        <div class="row-action-primary">
						            <i class="mdi-action-dns"></i>
						        </div>
						        <div class="row-content">
						            <div class="least-content"></div>
						            <h4 class="list-group-item-heading">仕事内容</h4>
						            <p class="list-group-item-text">{$row['job_discription']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>

							<div class="list-group-item">
						        <div class="row-action-primary">
						            <i class="glyphicon glyphicon-yen"></i>
						        </div>
						        <div class="row-content">
						            <div class="least-content"></div>
						            <h4 class="list-group-item-heading">基本給</h4>
						            <p class="list-group-item-text">{$row['base_salary']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>

						    <div class="list-group-item">
						        <div class="row-action-primary">
						            <i class="glyphicon glyphicon-yen"></i>
						        </div>
						        <div class="row-content">
						            <div class="least-content"></div>
						            <h4 class="list-group-item-heading">ボーナス</h4>
						            <p class="list-group-item-text">{$row['bonus']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>

							<div class="list-group-item">
						        <div class="row-action-primary">
						            <i class="mdi-file-folder"></i>
						        </div>
						        <div class="row-content">
						            <div class="least-content"></div>
						            <h4 class="list-group-item-heading">追加項目</h4>
						            <p class="list-group-item-text">追加項目</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>

						</div>
				    </div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-info">
				    <div class="panel-heading">
				        <h3 class="panel-title">企業情報</h3>
				    </div>
				    <div class="panel-body">
				        <a href="javascript:void(0)" class="btn btn-flat btn-info">この企業の求人一覧</a>
						<div class="bs-component">
                            <div class="progress progress-striped active">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>

						<div class="list-group">
						    <div class="list-group-item">
						        <div class="row-content" style="width:100%;">
						            <div class="action-secondary"><i class="mdi-material-info"></i></div>
						            <h4 class="list-group-item-heading">企業名</h4>
						            <p class="list-group-item-text" style="max-width:100%;">{$row['comp_name']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>
						    <div class="list-group-item">
						        <div class="row-content" style="width:100%;">
						            <div class="action-secondary"><i class="mdi-material-info"></i></div>
						            <h4 class="list-group-item-heading">企業カナ名</h4>
						            <p class="list-group-item-text" style="max-width:100%;">{$row['comp_name_kana']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>

						    <div class="list-group-item">
						        <div class="row-content" style="width:100%;">
						            <div class="action-secondary"><i class="mdi-material-info"></i></div>
						            <h4 class="list-group-item-heading">会社住所</h4>
						            <p class="list-group-item-text" style="max-width:100%;">{$row['comp_zipcode']}<br>{$row['comp_street_address']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>

						    <div class="list-group-item">
						        <div class="row-content" style="width:100%;">
						            <div class="action-secondary"><i class="mdi-material-info"></i></div>
						            <h4 class="list-group-item-heading">会社代表名</h4>
						            <p class="list-group-item-text" style="max-width:100%;">{$row['comp_ceo_name']}</p>
						        </div>
						    </div>
						    <div class="list-group-separator"></div>
						</div>
				    </div>
				</div>
			</div>
EOT;
			}
		}

		$contents_type = array(
				'jpg'  => 'image/jpeg',
				'jpeg' => 'image/jpeg',
				'png'  => 'image/png',
				'gif'  => 'image/gif',
				'bmp'  => 'image/bmp',
		);

		$result_image = $mysqli->query($query_str_image);
		if (!$result_image){
			return error_MSG(6);
			exit();
		}else {
			echo <<< EOT
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">添付写真</h3>
					</div>
					<div class="panel-body">
						            	<div class="swiper-container swiper-container-horizontal">
									        <div class="swiper-wrapper" style="height:auto;">
												<div class="swiper-slide"><img class="img-responsive" src="http://192.168.1.119/testOpenDev1/img/common/640x480.png" /></div>
									            <div class="swiper-slide"><img class="img-responsive" src="http://192.168.1.119/testOpenDev1/img/common/800x600.png" /></div>
EOT;
			while ($row_image = $result_image->fetch_assoc()){
				if ($get_job_info_id == $row_image['job_info_id']){
					echo <<< EOT
						<div class="swiper-slide"><img class="img-responsive" src="{$rootURLdist}imageload.php?id={$row_image['id']}" /></div>
EOT;
				}
			}
			echo <<<EOT

										        </div>
										        <!-- Add Pagination -->
										        <div class="swiper-pagination"></div>
										    </div>
						</div>
					</div>
				</div>
			</div>
EOT;
		}
	}
}

function userlogin_auth(){

	global $rootURLdist;
	global $mySQLAddress;
	global $mainDbUserName;
	global $mainDbPass;
	global $mainDbName;

	if (isset($_POST['userlogin'])){
		if (empty($_POST['userlogin_email']) or empty($_POST['userlogin_pass'])){
			$userloginERR = "ERROR";
		}else {
			$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
			if ($mysqli->connect_error){
				$userloginERR = "ERROR";
				$mysqli->close();
				exit();
			}else {
				$query_str = "SELECT * FROM user WHERE user_name = '".$_POST['userlogin_email']."'";
				$result = $mysqli->query($query_str);
				if (!$result){
					$userloginERR = "ERROR";
					exit();
				}else {
					while ($row = $result->fetch_assoc()){
						if (password_verify($_POST['userlogin_pass'], $row['user_password'])){
							header("Location:{$rootURLdist}swipeTest.php");
						}else {
							$userloginERR = "ERROR";
							exit();
						}
					}
				}
			}
			if (mysql_num_rows($result)==0){
				$userloginERR = "ERROR";
				header("Location:{$rootURLdist}userlogin.php");
				exit();
			}
		}
	}
}

?>
