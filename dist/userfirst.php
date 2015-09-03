<?php
require_once 'userfunctions.php';

if (isset($_POST['userfirst'])){
	if ($_POST['userfirst_pass1']==='1234' or $_POST['userfirst_pass2']==='1234'){
		header("Location:{$rootURLdist}userfirst.php?login=first");
	}elseif ($_POST['userfirst_pass1']===$_POST['userfirst_pass2']){
		$newpass = password_hash($_POST['userfirst_pass1'], PASSWORD_DEFAULT);
		$uf_pass_result = RUN_SQLI_DEFAULTLOGIN("UPDATE user SET user_password = '{$newpass}' WHERE no = {$_SESSION['NO']}");
		if (!$uf_pass_result){
			header("Location:{$rootURLdist}userfirst.php?login=first");
		}else{
			$_SESSION['FIRST'] = true;
			header("Location:{$rootURLdist}swipeTest.php");
		}
	}else {
		header("Location:{$rootURLdist}userfirst.php?login=first");
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
			<div class="container">
			
			<?php
				userbreadcrumbs_demo();
			?>
			
			<?php 
			
				if ($_GET['login']=='first'){
					echo <<< EOT
					<div class="bs-docs-section">
						<div class="row">
							<div class="col-lg-6">
								<div class="well bs-component">
									<form class="form-horizontal" method="POST">
										<fieldset>
											<legend>初回認証・パスワード変更</legend>
											<div class="form-group" id="f1">
												<label for="inputEmail" class="col-lg-2 control-label">新<br>PASSWORD</label>
												<div class="col-lg-10">
													<div class="form-control-wrapper">
														<input class="form-control floating-label" id="pass_first_1" name="userfirst_pass1" type="Password" placeholder="パスワード" data-hint="初期パスワード以外にしてください。">
													</div>
												</div>
											</div>
						<div id="first_pass_error1">
							<div id="first_pass_error_contents1">
								<p class="text-danger"><strong id="error_p1"></strong></p>
							</div>
						</div>
											<div class="form-group" id="f2">
												<label for="inputEmail" class="col-lg-2 control-label">再入力<br>PASSWORD</label>
												<div class="col-lg-10">
													<div class="form-control-wrapper">
														<input class="form-control floating-label" id="pass_first_2" name="userfirst_pass2" type="Password" placeholder="再パスワード" data-hint="パスワードの入力ミスにご注意ください。">
													</div>
												</div>
											</div>
						<div id="first_pass_error2">
							<div id="first_pass_error_contents2">
								<p class="text-danger"><strong id="error_p2"></strong></p>
							</div>
						</div>
											<div class="form-group">
												<div class="col-lg-10 col-lg-offset-2">
													<p class="" id="pass_first_okchk"><strong id="error_p3"></strong></p>
													<button type="submit" class="btn btn-primary" name="userfirst">パスワード更新</button>
												</div>
											</div>
						<div id="first_pass_error3">
							<div id="first_pass_error_contents3">
							</div>
						</div>
										</fieldset>
									</form>
								<div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
							</div>
					<div class="col-lg-4 col-lg-offset-1">
						<h2>ようこそJIOSへ<br>{$_SESSION['USERNAME']}さん</h2>
						<p>初回認証を終えている方はこちらかログインしてください。</p>
						<a href="{$rootURLdist}userlogin.php" class="btn btn-success">ログイン</a>
						<h2>各種問い合わせ</h2>
						<p>各種お問い合わせは下記ボタンよりお問い合わせフォームにてお問い合わせ出来ます。</p>
						<a href="javascript:void(0)" id="pass_first_submit" class="btn btn-info btn-raised">問合わせ</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p><strong>※下記設定も同時にできます。この作業は後で「設定」からも可能です。</strong></p>
				</div>
			</div>
EOT;
				}
				
				$userfirst_sqli = RUN_SQLI_DEFAULTLOGIN("SELECT * FROM user WHERE no = {$_SESSION['NO']}");
				$uf_result = $userfirst_sqli->fetch_assoc();
				echo<<<EOT
            <div class="row">
					<div class="col-md-12">
						<h1>各種初期設定</h1>
						<ul class="nav nav-tabs nav-justified" style="margin-bottom: 15px;">
						    <li class="" style="border:1px solid rgb(238, 238, 238);"><a href="#user_set_base" data-toggle="tab">基本設定</a></li>
						    <li class="" style="border:1px solid rgb(238, 238, 238);"><a href="#user_set_likes" data-toggle="tab">求人情報設定</a></li>
						    <li class="" style="border:1px solid rgb(238, 238, 238);"><a href="#user_set_others" data-toggle="tab">その他の設定</a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
						    <div class="tab-pane fade active in" id="user_set_base">
								<div class="panel panel-primary">
								    <div class="panel-heading">
								        <h3 class="panel-title">基本設定</h3>
								    </div>
								    <div class="panel-body">
								        <form class="form-horizontal" method="POST">
								        	<div class="form-group">
												<label class="col-sm-2 control-label">名前</label>
												<div class="col-sm-10">
											    	<p class="form-control-static">{$uf_result['user_name']}</p>
											    </div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">メール</label>
												<div class="col-sm-10">
											    	<p class="form-control-static">{$uf_result['user_email']}</p>
											    </div>
											</div>
						    				<div class="form-group">
												<label class="col-sm-2 control-label">通知メール</label>
												<div class="col-sm-10">
											    	<div class="togglebutton">
		                                                <label>
		                                                    <input type="checkbox" name="set_mailsend_system" checked="checked">  システム：メール送信機能をONにしますか？
		                                                </label>
		                                            </div>
													<div class="togglebutton">
														<label>
		                                                    <input type="checkbox" name="set_mailsend_new" checked="checked">  新着通知：メール送信機能をONにしますか？
		                                                </label>
													</div>
													<div>
														<p><span>※通知メールは上記のメールに送信されます。</span></p>
													</div>
													<div class="form-group">
														<button type="submit" name="base" class="btn btn-primary">更新</button>
													</div>
											    </div>
											</div>
										</form>
								    </div>
								</div>
						    </div>
						    <div class="tab-pane fade" id="user_set_likes">
						        <div class="panel panel-success">
								    <div class="panel-heading">
								        <h3 class="panel-title">求人情報設定</h3>
								    </div>
								    <div class="panel-body">
						
								        <form class="form-horizontal" method="POST">
											<div class="row">
												<div class="form-group col-md-6">
													<label class="col-sm-2 control-label">雇用形態</label>
													<div class="col-sm-10">
EOT;
				$userfirst_koyou_sql = RUN_SQLI_DEFAULTLOGIN("SELECT DISTINCT business_form FROM job_info");
				while ($uf_koyou_result = $userfirst_koyou_sql->fetch_assoc()){
					echo <<<EOT
						<div class="checkbox">
						<label>
	                        <input type="checkbox" name="bknum" value="{{$uf_koyou_result['business_form']}" checked="checked"> {$uf_koyou_result['business_form']}
	                    </label>
	                    </div>
EOT;
				}
	echo <<< EOT
												    </div>
												</div>
		                                        <div class="form-group col-md-6">
													<label class="col-sm-2 control-label">業種</label>
													<div class="col-sm-10">
EOT;
				$userfirst_gyousyu_sql = RUN_SQLI_DEFAULTLOGIN("SELECT DISTINCT comp_business FROM comp_info");
				while ($uf_gyousyu_result = $userfirst_gyousyu_sql->fetch_assoc()){
					echo <<<EOT
						<div class="checkbox">
						<label>
	                        <input type="checkbox" name="bknum" value="{{$uf_gyousyu_result['comp_business']}" checked="checked"> {$uf_gyousyu_result['comp_business']}
	                    </label>
	                    </div>
EOT;
				}
	echo<<<EOT
		                                            </div>
												</div>
		                                        <div class="form-group col-md-6">
													<label class="col-sm-2 control-label">職種</label>
													<div class="col-sm-10">
EOT;
				$userfirst_syokusyu_sql = RUN_SQLI_DEFAULTLOGIN("SELECT DISTINCT job_category FROM job_info");
				while ($uf_syokusyu_result = $userfirst_syokusyu_sql->fetch_assoc()){
					echo <<<EOT
						<div class="checkbox">
						<label>
	                        <input type="checkbox" name="bknum" value="{{$uf_syokusyu_result['job_category']}" checked="checked"> {$uf_syokusyu_result['job_category']}
	                    </label>
	                    </div>
EOT;
				}
	echo<<<EOT
		                                            </div>
												</div>
												<div class="form-group col-md-6">
													<label class="col-sm-2 control-label">企業</label>
													<div class="col-sm-10">
EOT;
				$userfirst_comp_sql = RUN_SQLI_DEFAULTLOGIN("SELECT DISTINCT comp_name FROM comp_info");
				while ($uf_comp_result = $userfirst_comp_sql->fetch_assoc()){
					echo <<<EOT
						<div class="checkbox">
						<label>
	                        <input type="checkbox" name="bknum" value="{{$uf_comp_result['comp_name']}" checked="checked"> {$uf_comp_result['comp_name']}
	                    </label>
	                    </div>
EOT;
				}
	echo<<<EOT
		                                            </div>
												</div>
											</div>
										</form>
						
								    </div>
								</div>
						    </div>
							<div class="tab-pane fade" id="user_set_others">
								<div class="panel panel-info">
								    <div class="panel-heading">
								        <h3 class="panel-title">その他の設定</h3>
								    </div>
								    <div class="panel-body">
								        現在はその他の設定はありません…
								    </div>
								</div>
						    </div>
						</div>
					</div>
				</div>

EOT;
			?>	
				
			
    	</div>
    
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <script src="js/ripples.min.js"></script>
        <script src="js/material.min.js"></script>
        <script>
            $(document).ready(function(event) {
                // This command is used to initialize some elements and make them work properly
                $.material.init();

                var check = false;
                var error = '';
                var pass1 = $("#pass_first_1");
                var pass2 = $("#pass_first_2");
                var errorMsg1 = $("#first_pass_error1");
                var errorMsg2 = $("#first_pass_error2");
                var errorMsg3 = $("#first_pass_error3");
                var errorMsgContent1 = $("#first_pass_error_contents1");
                var errorMsgContent2 = $("#first_pass_error_contents2");
                var errorMsgContent3 = $("#first_pass_error_contents3");
                var errorp1 = $("#error_p1");
                var errorp2 = $("#error_p2");
                var errorp3 = $("#error_p3");
                var button = $("#pass_first_submit");
                var f1 = $("#f1");
                var f2 =$("#f2");
                var chk = '';
                var samechk = $("#pass_first_okchk");
				var errortip1 = "<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button><strong>パスワードが一致しません</strong></div>";
				var errortip2 = "<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button><strong>初期パスワードです。初期パスワード以外にしてください。</strong></div>";
				var errortip3 = "<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button><strong>パスワードが一致していません。入力したパスワードを再度ご確認ください。</strong></div>";
				var flag1,flag2;

				
				
				function pass_first_check1(){
					if (pass1.val()==="1234") {
						console.log("bad1");
						f1.addClass('has-error');
						errorp1.text('※※初期パスワードです。初期パスワード以外にしてください。');
						flag1 = false;
					}else if(pass1.val()!=="1234"){
						console.log("success!");
						f1.removeClass('has-error');
						errorp1.text('');
						flag1 = false;
					}else if(pass1.val()===""){
						console.log("Null!");
						f1.removeClass('has-error');
						errorp1.text('');
						flag1 = true;
					};
					console.log("connect1");
				}
				function pass_first_check2(){
					if (pass2.val()==="1234") {
						console.log("bad2");
						f2.addClass('has-error');
						errorp2.text('※※初期パスワードです。初期パスワード以外にしてください。');
						flag2 = false;
					}else if(pass2.val()!=="1234"){
						console.log("success!");
						f2.removeClass('has-error');
						errorp2.text('');
						flag2 = false;
					}else if(pass2.val()===""){
						console.log("Null!");
						f2.removeClass('has-error');
						errorp2.text('');
						flag2 = true;
					};
					console.log("connect2");
				}

				function pass_first_samechk(){
					if(pass1.val()!=='1234' || pass2.val()!=='1234'){
						if(pass1.val()!=='' && pass2.val()!==''){
							if(pass1.val()!==pass2.val()){
								console.log('not same pass');
								f1.addClass('has-error');
								f2.addClass('has-error');
								samechk.addClass('text-danger');
								samechk.removeClass('text-info');
								errorp3.text('パスワードが一致していません。入力したパスワードを再度ご確認ください。');
								flag2 = false;
								flag1 = false;
							}else if(pass1.val()===pass2.val()){
								console.log('same pass');
								f1.removeClass('has-error');
								f2.removeClass('has-error');
								samechk.addClass('text-info');
								samechk.removeClass('text-danger');
								errorp3.text('パスワードが一致しました。更新できます。');	
								flag2 = true;
								flag1 = true;
							}
						}else{
							f1.removeClass('has-error');
							f2.removeClass('has-error');
							samechk.removeClass('text-info');
							samechk.removeClass('text-danger');
							errorp3.text('');
						}
					}else{
						errorp3.text('');
					}
				}
	
				pass1.on("keyup blur",function(){
						pass_first_check1();
						pass_first_samechk();
				});
				pass2.on("keyup blur",function(){
						pass_first_check2();
						pass_first_samechk();
				});

				button.on("blur keyup",function(){
					pass_first_check1();
					pass_first_check2();
					pass_first_samechk();
				});

                
            });
        </script>

    </body>

</html>