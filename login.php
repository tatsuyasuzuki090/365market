<?php
session_start();
if( isset($_SESSION['user']) != "") {
	header("Location: prof.php");
}
include_once 'dbconnect.php';

//メールアドレスログイン
if(isset($_POST['login'])) {
	$email = $mysqli->real_escape_string($_POST['email']);
	$pass = $mysqli->real_escape_string($_POST['pass']);
	// クエリの実行
	$query = "SELECT * FROM user WHERE email='$email'";
	$result = $mysqli->query($query);
	if (!$result) {
		print('クエリーが失敗しました。' . $mysqli->error);
		$mysqli->close();
		exit();
	}
	// パスワード(暗号化済み）とユーザーIDの取り出し
	while ($row = $result->fetch_assoc()) {
		$db_hashed_pwd = $row['pass'];
		$no = $row['no'];
	}
	// ハッシュ化されたパスワードがマッチするかどうかを確認
	if (password_verify($pass, $db_hashed_pwd)) {
		$_SESSION['user'] = $no;
		
		//メール送信　最後の数字flag 0：両方送信　1：片方送信
		mail_send('suzuki@vacavo.co.jp','','test@365market.jp','【ログイン】365market','',"ログイン操作が行われました。身に覚えない場合は下記までご連絡ください。\n$url/fm_prof_view.php?no={$no}$mail_footer","",'1');
	  
		header("Location: prof.php?no=$no");
		exit;
		} else { ?>
		<div class="alert alert-danger alertfadeOut" role="alert">メールアドレスとパスワードが一致しません。</div>
	<?php
	}?>
<?php
} ?>
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
		  		  <div class="col-xs-12 col-sm-6 col-sm-push-6">
		  			  <div class="pall-40 cf">
		  			  	<form method="post" class="form-signin">
		  			  	  <h2>ログイン</h2>
		  			  	  <p>メールアドレス</p>
		  			  	  <label for="inputEmail" class="sr-only">メールアドレス</label>
		  			  	  <input type="email" id="inputEmail" class="form-control form-group" name="email" placeholder="メールアドレス" required="" autofocus="">
		  			  	  <p>パスワード<label for="UserPassword" class="clearfix text-right">　<a href="/users/password_mail" class="rfloat">パスワードを思い出せない <i class="fa fa-frown-o"></i></a></label></p>
		  			  	  <label for="inputPassword" class="sr-only">パスワード</label>
		  			  	  <input type="password" id="inputPassword" class="form-control form-group" name="pass" placeholder="パスワード" required="">
		  			  	      <div class="checkbox">
		  			  	        <label>
		  			  	          <input type="checkbox" value="remember-me"> 次回からログインしたままにする
		  			  	        </label>
		  			  	      </div>
		  			  	  <button class="btn btn-primary form-group mt20 mb20" type="submit" name="login">ロ グ イ ン</button>
		  			  	</form>
		  			  	<hr />
		  			  	<div class="col-xs-12 col-md-6">
			  			  	<div class="pall-10">
		  				   <button class="btn btn-block btn-facebook form-group"><i class="fa fa-facebook"></i> | Facebookでログイン</button>
			  			  	</div>
		  				 </div>
		  				 <div class="col-xs-12 col-md-6">
			  				 <div class="pall-10">
		  				   <button class="btn btn-block btn-twitter form-group"><i class="fa fa-twitter"></i> | Twitterでログイン</button>
			  				 </div>
		  				 </div>
		  			  </div>
		  		  </div>
		  		  <div class="col-xs-12 col-sm-pull-6 col-sm-6 bglocor_gray">
		  			  <div class="pall-40 cf">
		  				 <h2>新規会員登録</h2>
		  				 <p>メールアドレスを利用して新規登録</p>
		  				 <form method="post" class="form-signin form-group" action="register.php">
		  				   <label for="inputEmail" class="sr-only">メールアドレス</label>
		  				   <input type="email" id="inputEmail" class="form-control form-group" name="email" placeholder="メールアドレス" required="" autofocus="">
		  				   <button class="btn btn-lg btn-success btn-block form-group" type="submit" name="register">確認メールを送信</button>
		  				 </form>
		  				 <hr />
		  				 <p class="lead"><span class="fs80">以下アカウントからもログインできます。<br />※承認なくFacebook、Twitterへポストすることはありません</span></p>
		  				 <div class="col-xs-12">
		  				   <button class="btn btn-block btn-facebook form-group"><i class="fa fa-facebook"></i> | Facebookで新規登録</button>
		  				 </div>
		  				 <div class="col-xs-12">
		  				   <button class="btn btn-block btn-twitter form-group"><i class="fa fa-twitter"></i> | Twitterで新規登録</button>
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