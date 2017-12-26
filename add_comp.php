<?php
ob_start();
session_start();

include_once 'dbconnect.php';

$token = $_GET['token'];
$query_add = "SELECT * FROM user_temp WHERE token = '$token'";	
$result_add = $mysqli->query($query_add);
$row_add = $result_add->fetch_assoc();
$id_add = $row_add['id'];
$mail_add = $row_add['mail'];
$token_add = $row_add['token'];

if(isset($_POST['comp'])){
	$email = $_POST['mail_add'];
	$token = $_POST['token'];
	
	$name_first = $_POST['name_first'];
	$name_last = $_POST['name_last'];
	$name = "$name_first $name_last";
	$pass = $_POST['pass'];
	$pass = password_hash($pass, PASSWORD_DEFAULT);

	$query_user_in = "INSERT INTO user (email, name, pass) VALUES ('$email','$name','$pass')";
	$result_user_in = $mysqli->query($query_user_in);
	
	//仮トークンの削除
	$sql_user_temp_del = "DELETE FROM user_temp WHERE token = '$token'";
	$res_user_temp_del = $mysqli->query( $sql_user_temp_del );
	
	$query_id = "SELECT * FROM user WHERE email = '$email'";	
	$result_id = $mysqli->query($query_id);
	$row_id = $result_id->fetch_assoc();
	$user_id = $row_id['id'];
	
	$query_prof_in = "INSERT INTO prof (no, mode) VALUES ('$user_id','1')";
	$result_prof_in = $mysqli->query($query_prof_in);
	
	$query_fm_in = "INSERT INTO fm (no) VALUES ('$user_id')";
	$result_fm_in = $mysqli->query($query_fm_in);
	
	$query_co_in = "INSERT INTO co (no) VALUES ('$user_id')";
	$result_co_in = $mysqli->query($query_co_in);
	
	$query_fa_in = "INSERT INTO fa (no) VALUES ('$user_id')";
	$result_fa_in = $mysqli->query($query_fa_in);
	
	$query_user_update = "UPDATE user SET no = '$user_id' WHERE id = '$user_id'";
	$result_user_update = $mysqli->query($query_user_update);
	
	//メール送信　最後の数字flag 0：両方送信　1：片方送信
	mail_send("$email",'suzuki@vacavo.co.jp','test@365market.jp','【会員登録完了】365market','【会員登録がありました】365market',"会員登録完了。身に覚えない場合は下記までご連絡ください。\n$mail_footer","会員登録がありました",'0');
	
	//echo($email);
		
	header("Location: add_thanks.php");
	
}


		
	 
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta property="og:site_name" content="">
	<meta property="og:title" content="">
	<meta property="og:description" content="">
	<meta property="og:image" content="">
	<meta property="og:url" content="">
	<meta property="og:type" content="website">
	<meta property="og:locale" content="ja_JP">
	<meta property="fb:app_id" content="">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/normalize.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/grid-sys.min.css" rel="stylesheet">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">
    
    <title>タイトル</title>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
	  
  <!--上部へ戻る-->
  <p id="page-top"><a href="#wrap">PAGE TOP</a></p>
	<div class="wrapper-short">
		<!--ヘッダー-->
		<?php 
		include('header.php');?>
		<!--ヘッダー-->
		<div id="main-content" class="">
		    <section id="login">
		  	  <div class="container">
		  		  <div class="col-xs-12 col-sm-12 bglocor_gray">
		  			  <div class="pall-40 cf">
		  			        <h2 class="form-signin-heading">メール確認完了</h2>
		  			        <p>メールが確認できました。引き続き下記を入力いただき、登録を完了させてください。</p>
		  			        <form method="post" class="form-signin">
		  			        <label for="inputEmail" class="sr-only">お名前</label>
		  			        <input type="text" id="name_first" class="form-control form-group" name="name_first" placeholder="姓" required autofocus><input type="text" id="name_last" class="form-control form-group" name="name_last" placeholder="名" required autofocus>
		  			        <label for="inputPassword" class="sr-only">パスワード</label>
		  			        <input type="password" id="inputPassword" class="form-control form-group" name="pass" placeholder="パスワード" required>
		  			        <button class="btn btn-lg btn-primary btn-block form-group" type="submit" name="comp">登録する</button>
		  			        <input type="hidden" name="mail_add" value="<?php echo $mail_add; ?>" >
		  			        <input type="hidden" name="token" value="<?php echo $token_add; ?>" >
		  			      </form>
		  			  </div>
		  		  </div>
		  	  </div>
		    </section>
		</div>
		<!--add_member-->
		<?php 
		include('add_member.php');?>
	    <!--add_member-->	
		  
		<!--フッター-->
		<?php 
		include('footer.php');?>
	    <!--フッター--> 
	</div>
	<!--jquery-->
	<?php 
	include('jquery.php');?>
    <!--jquery--> 		
  </body>
</html>