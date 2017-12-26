<?php
session_start();
include_once './dbconnect.php';
//未ログイン時はログインページへ
if( isset($_SESSION['user']) == "") {
	header("Location: login.php");
	}

if(isset($_POST['pass'])) {
	$password_now =$_POST['password_now'];
	$password_new =$_POST['password_new'];
	if(empty($password_now)) { $error['password_now'] = "<div class=\"alert alert-warning\" role=\"alert\">現在のパスワードを入力してください。</div>"; }
	if(empty($password_new)) { $error['password_new'] = "<div class=\"alert alert-warning\" role=\"alert\">新しいパスワードを入力してください。</div>"; }
	
	if(!empty($password_now) AND !empty($password_new) ) {
	$query_pass = "SELECT * FROM user WHERE no=".$_SESSION['user']."";
	$result_pass = $mysqli->query($query_pass);
	if (!$result_pass) {
		print('クエリーが失敗しました。' . $mysqli->error);
		$mysqli->close();
		exit();
	}
	// パスワード(暗号化済み）とユーザーIDの取り出し
	while ($row_pass = $result_pass->fetch_assoc()) {
		$db_hashed_pwd = $row_pass['pass'];
		$no = $row_pass['no'];

	}
	// ハッシュ化されたパスワードがマッチするかどうかを確認
	if (password_verify($password_now, $db_hashed_pwd)) {

		echo "<br />";
		echo "$password_now";
		echo "<br />";
		echo "$password_new";
		$password_new = password_hash($password_new, PASSWORD_DEFAULT);
		$password_now = password_hash($password_now, PASSWORD_DEFAULT);
		echo "<br />";
		echo "$password_new";

		$query_path_in = "UPDATE user SET pass = '$password_new' WHERE no=".$_SESSION['user']."";
		$result_path_in = $mysqli->query($query_path_in);
		if (!$result_path_in) {
		print('クエリーが失敗しました。11' . $mysqli->error);
		$mysqli->close();
		exit();
	    }
		
		
		
	} else {
		$error['password_now'] = "<div class=\"alert alert-warning\" role=\"alert\">現在のパスワードが違います。</div>"; 
	}
	}
	
	}
	
if( isset($_SESSION['user']) != "") {
	$query = "SELECT * FROM user INNER JOIN prof ON user.no = prof.no JOIN fm ON prof.no = fm.no WHERE user.no = ".$_SESSION['user']."";	
	$result = $mysqli->query($query);
	if (!$result) {
		print('クエリーが失敗しました。' . $mysqli->error);
		$mysqli->close();
		exit();
	}
	// ユーザー情報の取り出し
	$row = $result->fetch_assoc();
	$name = $row['name'];
	$mode = $row['mode'];
	$email = $row['email'];
	$no = $row['no'];
	$pass = $row['pass'];
	$img_sub_prof_path = $row['img_sub_prof_path'];

	
}

// データベースの切断
$result->close();
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

    <title>タイトル</title>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    


	    
  </head>
  <body>

  <!--上部へ戻る-->
  <p id="page-top"><a href="#wrap">PAGE TOP</a></p>
  	  
	<!--マイページメニュー-->
	<?php 
	include('mypage_menu.php');?>
	<!--マイページメニュー-->
  
  
	<div class="wrapper">
		
		<!--ヘッダー-->
		<?php 
		include('header.php');?>
		<!--ヘッダー-->
		
		<div id="main-content">
		    <section id="user_config_main" class="clearfix">
			  <div class="container">
			  	  <div class="col-xs-12 col-sm-3">
				  	  <div class="pall-20">
				  		  <img src="upload/<?php echo $img_sub_prof_path; ?>" alt="" class="img-responsive img-circle center-block">
				  	  </div>
			  	  </div>
			  	  <div class="col-xs-12 col-sm-9">
			  		  <div class="pall-20">
				  		  <h1><?php echo $name; ?><span class="fs80">（<?php echo $name; ?>）</span></h1>
				  		  <p>自分のプロフィールURL：<br class="sc-none" /><a href="#">https://365market/prof.php?=21</a></p>
				  		  <p class="star">ユーザーランク：<br class="sc-none" /><i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i><br class="sc-none" />（ブロンズ）</p>
			  		  </div>
			  	  </div>
			  	  <div class="col-xs-12">
			  	      <ul class="cf">
			  	       <li><a href="user_fm_message.php"><i class="fa fa-commenting-o" aria-hidden="true"></i> <span class="sp-none">メッセージ</span></a></li>
			  	       <li><a href="user_fm_favorite.php"><i class="fa fa-heart" aria-hidden="true"></i> <span class="sp-none">お気に入りの案件</span></a></li>
			  	       <li><a href="user_fm_progress_apply.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span class="sp-none">案件の進捗状況管理</span></a></li>
			  	       <li><a href="user_fm_team.php"><i class="fa fa-users" aria-hidden="true"></i> <span class="sp-none">マイチーム</span></a></li>
			  	       <li><a href="user_pay_list.php"><i class="fa fa-jpy" aria-hidden="true"></i> <span class="sp-none">報酬管理</span></a></li>
			  	       <li><a href="user_config_prof.php" class="active"><i class="fa fa-cog" aria-hidden="true"></i> <span class="sp-none">各種設定</span></a></li>
			  	      </ul>
			  	  </div>
			  </div>
		    </section>
		    <section id="user_config" class="clearfix">
			    <div class="container">
				    <div class="col-xs-12 col-sm-3 mb30">
					    <div class="pall-10">
						    <ul>
							    <li><a href="user_config_prof.php#top">プロフィール編集<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_notice.php#top">通知設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_mail.php#top">メール設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_pass.php#top" class="active">パスワード設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_address.php#top">住所・連絡先設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">パスワード設定</h2>
						    <p class="caution"></p>
						    <form method="post">
						    <table class="user_config_table">
			  					<tr>
			  						<th>現在のパスワード</th>
			  						<td><input class="form-control" type="password" id="password_now" placeholder="現在のパスワード" name="password_now" value="<?php if(isset($_POST['password_now'])) { echo $_POST['password_now']; } ?>"><?php if(isset($error['password_now'])) { echo $error['password_now']; } ?></td>
			  					</tr>
			  				</table>
			  				<table class="user_config_table">
			  					<tr>
			  						<th>新しいパスワード</th>
			  						<td><input class="form-control" type="password" id="password_new" placeholder="新しいパスワード" name="password_new" value="<?php if(isset($_POST['password_new'])) { echo $_POST['password_new']; } ?>"><?php if(isset($error['password_new'])) { echo $error['password_new']; } ?></td>
			  					</tr>
			  				</table>
			  				<button type="submit" class="btn btn-success btn-lg" name="pass">登録する <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
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