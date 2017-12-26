<?php
ob_start();
session_start();
include_once 'dbconnect.php'; 
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
		  			        <h2 class="form-signin-heading">登録完了</h2>
		  			        <p>登録完了しました。</p>
		  			        <p><button class="btn btn-lg btn-primary btn-block form-group" onclick="location.href='login.php'" type="button" name="comp">ログインする</button></p>
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