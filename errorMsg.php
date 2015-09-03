<?php
function error_MSG($no){
	switch ($no){
		case 0:
			return "NO++++S";
			break;
		case 1:
			return "DBに接続できませんでした。";
			break;
		case 2:
			return "ユーザーネームが入力されていません。";
			break;
		case 3:
			return "パスワードが入力されていません。"; 
			break;
		case 4:
			return "ユーザーネームまたは、パスワードが入力されていません。";
			break;
		case 5:
			return "ページを閲覧するには正確なログインが必要です。";
			break;
		case 6:
			return "管理者権限の情報でログインしてください。";
			break;
		case 7:
			return "管理者権限情報が間違っているか、ユーザーネーム、パスワードが間違っています。";
			break;
		case 8:
			return "nouser";
			break;
		case 9:
			return "すでに登録されているユーザー名です。他のユーザー名で登録してください。";
			break;
		case 10:
			return "same_user_ng";
			break;
		case 11:
			return "ユーザーネームもしくは、Eメールが入力されていません。";
			break;
		case 12:
			return "Eメールが入力されていません。";
			break;
		case 13:
			return "Eメールが保存されていません。";
			break;
		case 14:
			return "Eメールもしくはパスワードが入力されていません。";
			break;
	}		
}


function success_MSG($no){
	switch ($no){
		case 0:
			break;
		case 1:
			echo "DBに接続しました。";
			break;
		case 2:
			break;
		case 3:
			return "checkok";
			break;
		case 4:
			return "ユーザーを登録しました。";
			break;
	}
}