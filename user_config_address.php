<?php
session_start();
include_once './dbconnect.php';
//未ログイン時はログインページへ
if( isset($_SESSION['user']) == "") {
	header("Location: login.php");
	}


if(isset($_POST['edit'])) {
	$zip = $_POST['zip'];
	$address = $_POST['address'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$address3 = $_POST['address3'];
	$tel = $_POST['tel'];
	$fax = $_POST['fax'];
	
	if(empty($zip) OR empty($address) OR empty($address1) OR empty($address2) OR empty($address3) OR empty($tel) OR empty($fax)){
		if(empty($zip)){ $error['zip'] = "<div class=\"alert alert-warning\" role=\"alert\">郵便番号を入力してください。</div>"; }
		if(empty($address)){ $error['address'] = "<div class=\"alert alert-warning\" role=\"alert\">都道府県を入力してください。</div>"; }
		if(empty($address1)){ $error['address1'] = "<div class=\"alert alert-warning\" role=\"alert\">市区町村を入力してください。</div>"; }
		if(empty($address2)){ $error['address2'] = "<div class=\"alert alert-warning\" role=\"alert\">番地を入力してください。</div>"; }
		if(empty($address3)){ $error['address3'] = "<div class=\"alert alert-warning\" role=\"alert\">マンション・ビル名を入力してください。</div>"; }
		if(empty($tel)){ $error['tel'] = "<div class=\"alert alert-warning\" role=\"alert\">連絡先を入力してください。</div>"; }
		if(empty($fax)){ $error['fax'] = "<div class=\"alert alert-warning\" role=\"alert\">ファックスを入力してください。</div>"; }
	} else {
		$query_address_update = "UPDATE prof SET zip = '$zip', address = '$address', address1 = '$address1', address2 = '$address2', address3 = '$address3', tel = '$tel', fax = '$fax' WHERE no = ".$_SESSION['user']."";
		$result_address_update = $mysqli->query($query_address_update);
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
	$img_sub_prof_path = $row['img_sub_prof_path'];
	
	$zip = $row['zip'];
	$address = $row['address'];
	$address1 = $row['address1'];
	$address2 = $row['address2'];
	$address3 = $row['address3'];
	$tel = $row['tel'];
	$fax = $row['fax'];

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
							    <li><a href="user_config_pass.php#top">パスワード設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_address.php#top" class="active">住所・連絡先設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">住所設定</h2>
						    <p class="caution"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>こちらの情報は公開されません。銀行口座の名義や登録情報の信頼性向上の為に本部にて確認させていただきます情報になりますので、正確な情報の入力をお願い致します。</p>
						    <form method="post">
						    <table class="user_config_table">
				  				<tr>
			  						<th>郵便番号</th>
			  						<td><input class="form-control" type="text" onkeyup="AjaxZip3.zip2addr(this,'','address','address1','address2');" id="comment" placeholder="" name="zip" value="<?php echo $zip;?>">
				  						<?php if(isset($error['zip'])){ echo $error['zip']; }?>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>都道府県／市区町村</th>
			  						<td class="form-inline"><input class="form-control" type="text" id="comment" placeholder="" name="address" value="<?php echo $address;?>"> <input class="form-control" type="text" id="comment" placeholder="" name="address1" value="<?php echo $address1;?>">
				  						<?php if(isset($error['address'])){  echo $error['address']; }?><?php if(isset($error['address1'])){  echo $error['address1']; }?>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>住所・番地</th>
			  						<td><input class="form-control" type="text" id="comment" placeholder="" name="address2" value="<?php echo $address2;?>">
				  						<?php if(isset($error['address2'])){  echo $error['address2']; }?>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>マンション／ビル名</th>
			  						<td><input class="form-control" type="text" id="comment" placeholder="" name="address3" value="<?php echo $address3;?>">
				  						<?php if(isset($error['address3'])){  echo $error['address3']; }?>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>連絡先</th>
			  						<td><input class="form-control" type="text" id="comment" placeholder="" name="tel" value="<?php echo $tel;?>">
				  						<?php if(isset($error['tel'])){  echo $error['tel']; }?>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>ファックス</th>
			  						<td><input class="form-control" type="text" id="comment" placeholder="" name="fax" value="<?php echo $fax;?>">
				  						<?php if(isset($error['fax'])){  echo $error['fax']; }?>
			  						</td>
			  					</tr>
			  				</table>
			  				<button type="submit" class="btn btn-success btn-lg" name="edit">登録する <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
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