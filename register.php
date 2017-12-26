<?php
ob_start();
session_start();
if( !isset($_POST['email']) ) { header("Location: login.php"); }

include_once 'dbconnect.php';

$token = get_csrf_token();
$datetime_now = date('Y/m/d H:i:s');
$email = $_POST['email'];

$query = "INSERT INTO user_temp (mail, token ,datetime) VALUES ('$email', '$token', '$datetime_now')";
$result = $mysqli->query($query);

//メール送信　最後の数字flag 0：両方送信　1：片方送信
mail_send("$email",'','test@365market.jp','【メール確認】365market','',"下記クリックで登録を完了させてください。身に覚えない場合は下記までご連絡ください。\n$url/add_comp.php?token={$token}$mail_footer","",'1');
	 
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
		  			      <h2 class="form-signin-heading">メールをご確認ください。</h2>
		  			      <p>メールに記載されたURLをクリックの上、新規会員登録を続けてください。</p>
		  			      <p class=""><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>もしメールが届かない場合は、迷惑メールをご確認いただき、「@365market.jp」からのメール受信を許可してください。</p>
		  			      <div class="col-sm-3">
		  			      </div>
		  			      <div class="col-sm-3 text-center">
		  				      <div class="pall-10">
		  				      <button type="button" onclick="location.href='https://www.google.com/gmail/'" class="btn btn-primary btn-block btn-lg">Gmailへ</button>
		  				      </div>
		  			      </div>
		  			      <div class="col-sm-3 text-center">
		  				      <div class="pall-10">
		  				      <button type="button" onclick="location.href='https://mail.yahoo.co.jp/'" class="btn btn-primary btn-block btn-lg">Yahoo!メールへ</button>
		  				      </div>
		  			      </div>
		  			      <div class="col-sm-3">
		  			      </div>
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