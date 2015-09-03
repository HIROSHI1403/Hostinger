<?php 
if (empty($_SESSION['basicAuth'])){
	header("Location: {$rootURL}basicAuth.php");
}
//session_start();
error_reporting(E_ALL & ~E_NOTICE);
require_once 'functions.php';

rewrite($_SESSION['USER_ID']);
rewrite($_SESSION['USER_MAIL']);
rewrite($_SESSION['USER_PASS']);

if (isset($_POST["set_user_submit"])){
	if (empty($_POST['user_name']) && empty($_POST['user_email'])){
		$result = error_MSG(11);
		goto exi;
	}elseif (empty($_POST['user_name'])){
		$result = error_MSG(2);
		goto exi;
	}elseif (empty($_POST['user_email'])){
		$result = error_MSG(12);
		goto exi;
	}

	$yyyymmdd = $_REQUEST['year'].$_REQUEST['month'].$_REQUEST['day'];
	// 	$result = check_same_username($_POST['user_name']);
	// 	if ($result == "same_user_ng"){
	// 		$result = error_MSG(9);
	// 		exit($result);
	// 	}
	$userpassword_1 = password_hash('1234', PASSWORD_DEFAULT);
	$result = regist_query("INSERT INTO user (user_name,user_password,user_email,user_birth) VALUES ('{$_POST['user_name']}','{$userpassword_1}','{$_POST['user_email']}',{$yyyymmdd})",$_POST['user_name']);
	if ($result == "checkok"){
		//die("good");
		//		header("Location: " . $_SERVER['PHP_SELF']);
		$result = success_MSG(4);
	}elseif ($result == "same_user_ng"){
		$result = error_MSG(9);
	}else{
		$result = success_MSG(4);
	}
	exi:
}


require_once 'functions.php';
/* HTML特殊文字をエスケープする関数 */
function h($str) {
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// XHTMLとしてブラウザに認識させる
// (IE8以下はサポート対象外ｗ)
// header('Content-Type: application/xhtml+xml; charset=utf-8');

try {

	// データベースに接続
	$pdo = new PDO(
			'mysql:host=localhost;dbname=testOpenDev1_db;charset=utf8',
			'root',
			'pass',
			[
					PDO::ATTR_EMULATE_PREPARES => false,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			]
	);

	/* アップロードがあったとき */
	if (isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error'])) {

		// バッファリングを開始
		ob_start();

		try {

			// $_FILES['upfile']['error'] の値を確認
			switch ($_FILES['upfile']['error']) {
				case UPLOAD_ERR_OK: // OK
					break;
				case UPLOAD_ERR_NO_FILE:   // ファイル未選択
					throw new RuntimeException('ファイルが選択されていません', 400);
				case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
				case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
					throw new RuntimeException('ファイルサイズが大きすぎます', 400);
				default:
					throw new RuntimeException('その他のエラーが発生しました', 500);
			}

			// $_FILES['upfile']['mime']の値はブラウザ側で偽装可能なので
			// MIMEタイプを自前でチェックする
			if (!$info = @getimagesize($_FILES['upfile']['tmp_name'])) {
				throw new RuntimeException('有効な画像ファイルを指定してください', 400);
			}
			if (!in_array($info[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
				throw new RuntimeException('未対応の画像形式です', 400);
			}

			// サムネイルをバッファに出力
			$create = str_replace('/', 'createfrom', $info['mime']);
			$output = str_replace('/', '', $info['mime']);
			if ($info[0] >= $info[1]) {
				$dst_w = 120;
				$dst_h = ceil(120 * $info[1] / max($info[0], 1));
			} else {
				$dst_w = ceil(120 * $info[0] / max($info[1], 1));
				$dst_h = 120;
			}
			if (!$src = @$create($_FILES['upfile']['tmp_name'])) {
				throw new RuntimeException('画像リソースの生成に失敗しました', 500);
			}
			$dst = imagecreatetruecolor($dst_w, $dst_h);
			imagecopyresampled($dst, $src, 0, 0, 0, 0, $dst_w, $dst_h, $info[0], $info[1]);
			$output($dst);
			imagedestroy($src);
			imagedestroy($dst);

			// INSERT処理
			$stmt = $pdo->prepare('INSERT INTO image(name,type,raw_data,thumb_data,date) VALUES(?,?,?,?,?)');
			$stmt->execute([
					$_FILES['upfile']['name'],
					$info[2],
					file_get_contents($_FILES['upfile']['tmp_name']),
					ob_get_clean(), // バッファからデータを取得してクリア
					(new DateTime('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s'),
			]);

			$msgs[] = ['green', 'ファイルは正常にアップロードされました'];

		} catch (RuntimeException $e) {

			while (ob_get_level()) {
				ob_end_clean(); // バッファをクリア
			}
			http_response_code($e instanceof PDOException ? 500 : $e->getCode());
			$msgs[] = ['red', $e->getMessage()];

		}

		/* ID指定があったとき */
	} elseif (isset($_GET['id'])) {

		try {

			$stmt = $pdo->prepare('SELECT type, raw_data FROM image WHERE id = ? LIMIT 1');
			$stmt->bindValue(1, $_GET['id'], PDO::PARAM_INT);
			$stmt->execute();
			if (!$row = $stmt->fetch()) {
				throw new RuntimeException('該当する画像は存在しません', 404);
			}
			header('X-Content-Type-Options: nosniff');
			header('Content-Type: ' . image_type_to_mime_type($row['type']));
			echo $row['raw_data'];
			exit;

		} catch (RuntimeException $e) {

			http_response_code($e instanceof PDOException ? 500 : $e->getCode());
			$msgs[] = ['red', $e->getMessage()];

		}

	}

	// サムネイル一覧取得
	$rows = $pdo->query('SELECT id,name,type,thumb_data,date FROM image ORDER BY date DESC')->fetchAll();

} catch (PDOException $e) {

	http_response_code(500);
	$msgs[] = ['red', $e->getMessage()];

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example that shows off a blog page with a list of posts.">

    <title>TOP &ndash; JIOSystem</title>

    


<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">



<!--[if lte IE 8]>
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
  
<![endif]-->
<!--[if gt IE 8]><!-->
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
  
<!--<![endif]-->





  
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/blog-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="/testOpenDev1/css/layouts/blog.css">
    <!--<![endif]-->
  


    

    

</head>
<body>







<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            <h1 class="brand-title">JIOSystem</h1>
            <h2 class="brand-tagline">求人票管理</h2>
            <?php
            signup_navi(); 
            ?>
        </div>
    </div>
    <div class="content pure-u-1 pure-u-md-3-4">
	    <div class="posts">
	            <h1 class="content-subhead">JOB SLIP MANAGEMENT</h1>
	
	            <!-- A single blog post -->
	            <section class="post">
	                <header class="post-header">
	                    <h2 class="post-title">求人票管理</h2>
	                </header>
	
	                <div class="post-description">
	                    <p>新規登録</p>
	                    <?php
	                    	if (empty($result)){
	                    	} else{
	                    		echo "<p style='color:red;'>$result</p>";
	                    	}
// 	                    	var_dump($result);
	                    ?>
	                        <form class="pure-form pure-form-aligned" name="set_user" method="post" action="#">
							    <fieldset>
							        <div class="pure-control-group">
							            <label for="name">企業名検索</label>
							            <input class="pure-input-2-3" name="user_name" type="text" placeholder="Free Text">
							        </div>
							
<!-- 							        <div class="pure-control-group"> -->
<!-- 							            <label for="password">パスワード</label> -->
<!-- 							            <input class="pure-input-2-3" id="password" type="password" placeholder="Password"> -->
<!-- 							        </div> -->
							
							        <div class="pure-control-group">
							            <label for="email">メールアドレスで検索</label>
							            <input class="pure-input-2-3" name="user_email" type="email" placeholder="Email Address">
							        </div>
							
							
							        <div class="pure-controls">
							            <button type="submit" class="pure-button pure-button-primary" name="set_user_submit">検索する</button>
							        </div>
							    </fieldset>
							</form>
	                </div>
	            </section>
	        </div>
	        
	        <div class="posts">
	            <h1 class="content-subhead">Search Result</h1>
	
	            <!-- A single blog post -->
	            <section class="post">
	                <header class="post-header">
	                    <h2 class="post-title">検索結果</h2>
	                </header>
	
	                <div class="post-description">
	                    <p>
	                    	
	                    </p>
	                </div>
	            </section>
	        </div>
		</div>
	        

    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <div class="footer">
                <div class="pure-menu pure-menu-horizontal">
                    <ul>
                        <li class="pure-menu-item"><a href="#" class="pure-menu-link">About</a></li>
                        <li class="pure-menu-item"><a href="#" class="pure-menu-link">Twitter</a></li>
                        <li class="pure-menu-item"><a href="#" class="pure-menu-link">GitHub</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>






</body>
</html>