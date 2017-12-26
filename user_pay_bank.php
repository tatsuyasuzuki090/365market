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
			  	  <div class="col-xs-12">
			  	      <ul class="cf">
			  	       <li><a href="user_fm_message.php"><i class="fa fa-commenting-o" aria-hidden="true"></i> <span class="sp-none">メッセージ</span></a></li>
			  	       <li><a href="user_fm_favorite.php"><i class="fa fa-heart" aria-hidden="true"></i> <span class="sp-none">お気に入りの案件</span></a></li>
			  	       <li><a href="user_fm_progress_apply.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span class="sp-none">案件の進捗状況管理</span></a></li>
			  	       <li><a href="user_fm_team.php"><i class="fa fa-users" aria-hidden="true"></i> <span class="sp-none">マイチーム</span></a></li>
			  	       <li><a href="user_pay_list.php" class="active"><i class="fa fa-jpy" aria-hidden="true"></i> <span class="sp-none">報酬管理</span></a></li>
			  	       <li><a href="user_config_prof.php"><i class="fa fa-cog" aria-hidden="true"></i> <span class="sp-none">各種設定</span></a></li>
			  	      </ul>
			  	  </div>
			  </div>
		    </section>
		    <section id="user_config" class="clearfix">
			    <div class="container">
				    <div class="col-xs-12 col-sm-3 mb30">
					    <div class="pall-10">
						    <ul>
							    <li><a href="user_pay_list.php">入金管理<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_pay_bank.php" class="active">口座管理<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_pay_receipt.php">領収・請求管理<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">

					    <div class="pall-10">
						    <h2 id="top">口座管理</h2>
						    <p class="caution"></p>
						    <table class="user_team_table">
			  					<tr>
			  						<th>振込口座設定</th>
			  						<td>
										<form class="form-inline">
										  <div class="form-group">
										    <label class="sr-only" for="bank_name">金融機関名</label>
										    <input type="text" class="form-control" placeholder="金融機関名" id="bank_name" name="bank_name" size="20">
										  </div>
										  <div class="form-group">
										    <label class="sr-only" for="bank_name_branch">支店名</label>
										    <input type="text" class="form-control" placeholder="支店名" id="bank_name_branch" name="bank_name_branch" size="14">
										  </div>
										  <div class="form-group">
											  <select class="form-control" id="fi1">
											      <option>普通</option>
											      <option>当座</option>
											  </select>
										  </div>
										  <div class="form-group">
										    <label class="sr-only" for="account_number">口座番号</label>
										    <input type="text" class="form-control" placeholder="口座番号" id="account_number" name="account_number" size="14">
										  </div>
										  <div class="form-group">
										    <label class="sr-only" for="account_name">口座名義（カナ）</label>
										    <input type="text" class="form-control" placeholder="口座名義（カナ）" id="account_name" name="account_name" size="24">
										  </div>
										</form>
										
									</td>
			  					</tr>
			  				</table>
						    
						    <div class="col-xs-12">
							    <div class="pall-40 bglocor_gray caution_gray">
								<div class="col-xs-12">
									<h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 振込確認</h4>
								</div>
							    <p class="fs90"><label class="checkbox-inline"><input type="checkbox" value="">口座名義人(カタカナ)と、登録情報の氏名(漢字)が一致している(一致していないと、お振り込みできません)</label></p>
							    <p class="fs90"><label class="checkbox-inline"><input type="checkbox" value="">登録情報の住所が、番地まで登録されている(登録されていないと、お振り込みできません)</label></p>
							    <div class="bglocor_w check mall-05 cf">
								    <h5>登録情報</h5>
								      <blockquote class="mt10">
									    <p>氏名(漢字): 鈴木達也<br>住所: 東京都目黒区 上目黒1-18-3sur-vill（シュービル）308号</p>
								      </blockquote>
									 <p class="fs90 pall-10">15日締め当月末、月末締め翌月15日の月2回の支払いとなります。<br>
									実際に振り込まれる金額は、ご登録口座の振込手数料を差し引いた金額となります。<br>
									振込口座にお間違いがあった場合は、組戻手数料648円が必要です。</p>
							    </div>
							    <div class="mt10">
								<a href="#" class="btn btn-success btn-block btn-lg">上記に同意し、情報を登録・更新する</a>
							    </div>
							    </div>
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