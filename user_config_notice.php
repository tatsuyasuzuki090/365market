<?php
session_start();
include_once './dbconnect.php';
//未ログイン時はログインページへ
if( isset($_SESSION['user']) == "") {
	header("Location: login.php");
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
	$img_path = $row['img_path'];
	$img_sub_prof_path = $row['img_sub_prof_path'];
	
	$zip = $row['zip'];
	$address = $row['address'];
	$address1 = $row['address1'];
	$address2 = $row['address2'];
	$address3 = $row['address3'];
	$tel = $row['tel'];
	$fax = $row['fax'];
	
	$title = $row['title'];
	$license = $row['license'];
	$copy = $row['copy'];
	$fan = $row['fan'];
	
	$facebook_url = $row['facebook_url'];
	$twitter_url = $row['twitter_url'];
	$instagram_url = $row['instagram_url'];
	
	$link1 = $row['link1'];
	$link2 = $row['link2'];
	
	$other = $row['other'];
	
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
							    <li><a href="user_config_notice.php#top" class="active">通知設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_mail.php#top">メール設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_pass.php#top">パスワード設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_address.php#top">住所・連絡先設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">メール通知設定</h2>
						    <p class="caution"></p>
						    <form method="post">
						    <table class="user_config_table">
				  				<tr>
			  						<th>ニュースレター</th>
			  						<td class="form-inline">
										<div class="radio-inline">
										  <input type="radio" value="1" name="gender" id="man">
										    <label for="man">受け取る</label>
										</div>
										<div class="radio-inline">
										  <input type="radio" value="2" name="gender" id="woman">
										  <label for="woman">受け取らない</label>
										</div>
										<p class="caution_table"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>365Marketよりお知らせメールが送信されます。</p>
			  						</td>
			  					</tr>
						    </table>
						    <table class="user_config_table">
			  					<tr>
			  						<th>ログイン時</th>
			  						<td class="form-inline">
										<div class="radio-inline">
										  <input type="radio" value="1" name="gender" id="man">
										    <label for="man">受け取る</label>
										</div>
										<div class="radio-inline">
										  <input type="radio" value="2" name="gender" id="woman">
										  <label for="woman">受け取らない</label>
										</div>
										<p class="caution_table"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>ログイン時にメールが送信されます。セキュリティ上「受け取る」に選択することをおすすめします。</p>
			  						</td>
			  					</tr>
						    </table>
						    <table class="user_config_table">
			  					<tr>
			  						<th>案件応募</th>
			  						<td class="form-inline">
										<div class="radio-inline">
										  <input type="radio" value="1" name="gender" id="man">
										    <label for="man">受け取る</label>
										</div>
										<div class="radio-inline">
										  <input type="radio" value="2" name="gender" id="woman">
										  <label for="woman">受け取らない</label>
										</div>
										<p class="caution_table"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>案件に応募したときに確認メールを送信します。</p>
			  						</td>
			  					</tr>
						    </table>
						    <table class="user_config_table">
			  					<tr>
			  						<th>メッセージ受信時</th>
			  						<td class="form-inline">
										<div class="radio-inline">
										  <input type="radio" value="1" name="gender" id="man">
										    <label for="man">受け取る</label>
										</div>
										<div class="radio-inline">
										  <input type="radio" value="2" name="gender" id="woman">
										  <label for="woman">受け取らない</label>
										</div>
										<p class="caution_table"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>企業・フードメッセンジャー等からメッセージを受信したときにメール通知されます。</p>
			  						</td>
			  					</tr>
			  				</table>
			  				<table class="user_config_table">
			  					<tr>
			  						<th>仕事開始1日前事前メール</th>
			  						<td class="form-inline">
										<div class="radio-inline">
										  <input type="radio" value="1" name="gender" id="man">
										    <label for="man">受け取る</label>
										</div>
										<div class="radio-inline">
										  <input type="radio" value="2" name="gender" id="woman">
										  <label for="woman">受け取らない</label>
										</div>
										<p class="caution_table"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>お仕事開始の1日前にメール通知されます。</p>
			  						</td>
			  					</tr>
			  				</table>

			  				<button type="submit" class="btn btn-success btn-lg" name="prof">登録する <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
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