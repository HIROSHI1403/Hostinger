<?php
if (empty($_SESSION['basicAuth'])){
	header("Location: {$rootURL}basicAuth.php");
}
// function sendMail($mailAddress){
// 	if (empty($mailAddress)){
// 		return error_MSG(13);
// 		exit;
// 	}

// 	die("here");

// 	mb_language("Japanese");
// 	mb_internal_encoding("UTF-8");

// 	$subject="JISOシステム：ユーザー登録";
// 	$message="JISOユーザー様　テストメールです。";

// 	if (mb_send_mail("{$mailAddress}", "{$subject}", "{$message}")){
// 		return "OK";
// 	}else {
// 		return "NG";
// 	}
// }


mb_language("Japanese");
mb_internal_encoding("UTF-8");

$mailAddress = "yuki.jamjamjam@gmail.com";
$subject="JIOSシステム：ユーザー登録";
$message="JIOSユーザー様　テストメールです。";

// $result = mb_send_mail($mailAddress, $subject, $message);
// var_dump($result);


// $result = mb_send_mail("yuki.jamjamjam@gmail.com", "TEST", "TESTメール");
// var_dump($result);

if (mb_send_mail("yuki.jamjamjam@gmail.com","JIOSシステム：ユーザー登録","JIOSユーザー様　テストメールです。")){
	echo "成功";
}else{
	echo "失敗";
}


// if (mail("yuki.jamjamjam@gmail.com", "TEST MAIL", "This is a test message.", "From: yuki.jamjamjam@gmail.com")) {
// 	die("sending success!");
// } else {
// 	die("sending false");
// }

?>