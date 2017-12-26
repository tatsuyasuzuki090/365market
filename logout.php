<?php
session_start();
// logout.php?logoutにアクセスしたユーザーをログアウトする
if(isset($_GET['logout'])) {
	// セッション変数を解除
	$_SESSION = array();
	// セッションcookieを削除
	if (isset($_COOKIE[session_name()])) {
	    setcookie(session_name(), '', time()-42000, '/');
	}
	// セッションを破棄
	session_destroy();
	unset($_SESSION['user']);
	header("Location: index.php");
} else {
	header("Location: index.php");
}
