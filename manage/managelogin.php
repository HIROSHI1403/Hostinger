<?php
require_once 'managefunctions.php';

if ($_GET['logout']=='YES') {
    $ERROR = "ログアウトしました。";
}

if (isset($_POST['managelogin'])){
	$result_login = manage_login($_POST['managename'], $_POST['managepassword']);
	if ($result_login == 'ok'){
		$_SESSION['managename'] = $_POST['managename'];
		header("Location: {$rootURLmanage}managetop.php");
	}else {
		$ERROR = $msg_row['3']['msg'];
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JIOS </title>

    <!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="./bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ログインしてください。</h3>
                    </div>
                    <div class="panel-body">

                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="アカウント名を入力してください。" name="managename" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="パスワードを入力してください。" name="managepassword" type="password" value="">
                                </div>
                                <div class="form-group">
									<input name="managelogin" class="btn btn-lg btn-success btn-block" type="submit" value="ログイン">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <?php
                	if (!empty($ERROR)){
						echo <<<EOT
							<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {$ERROR}
                            </div>
EOT;
                   	}
                ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="./bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src=".f/dist/js/sb-admin-2.js"></script>

</body>

</html>
