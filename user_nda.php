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
	$img_sub_prof_path = $row['img_sub_prof_path'];
	
	$zip = $row['zip'];
	$address = $row['address'];
	$address1 = $row['address1'];
	$address2 = $row['address2'];
	$address3 = $row['address3'];
	$tel = $row['tel'];
	$fax = $row['fax'];
	
	if(isset($_POST['upload'])) {

	}

$query_matter = "SELECT * FROM matter WHERE id = 1";	
$result_matter = $mysqli->query($query_matter);
$row_matter = $result_matter->fetch_assoc();
$matter_content = $row_matter['content'];	
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
			  <div class="container-fuild">
			  	  <div class="col-xs-12">
			  	      <ul class="cf">
			  	       <li><a href="user_fm_message.php"><i class="fa fa-commenting-o" aria-hidden="true"></i> <span class="sp-none">メッセージ</span></a></li>
			  	       <li><a href="user_fm_favorite.php"><i class="fa fa-heart" aria-hidden="true"></i> <span class="sp-none">お気に入りの案件</span></a></li>
			  	       <li><a href="user_fm_progress_apply.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span class="sp-none">案件の進捗状況管理</span></a></li>
			  	       <li><a href="user_fm_team.php"><i class="fa fa-users" aria-hidden="true"></i> <span class="sp-none">マイチーム</span></a></li>
			  	       <li><a href="user_pay_list.php"><i class="fa fa-jpy" aria-hidden="true"></i> <span class="sp-none">報酬管理</span></a></li>
			  	       <li><a href="user_config_prof.php"><i class="fa fa-cog" aria-hidden="true"></i> <span class="sp-none">各種設定</span></a></li>
			  	       <li><a href="user_identity.php" class="active"><i class="fa fa-id-card-o" aria-hidden="true"></i> <span class="sp-none">各種認証申請</a></li>
			  	      </ul>
			  	  </div>
			  </div>
		    </section>
		    <section id="user_config" class="clearfix">
			    <div class="container">
				    <div class="col-xs-12 col-sm-3 mb30">
					    <div class="pall-10">
						    <ul>
							    <li><a href="user_identity.php">本人確認書類提出<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_nda.php" class="active">機密保持・契約事項確認<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">機密保持・契約事項確認</h2>
						    <p class="caution">「機密保持確認」とは、会員登録時に同意頂いている365Market利用規約「第20条 取引における機密保持」について、住所・氏名を表示して、改めて署名頂き、機密保全に努めていることを確認して頂くためのサービスです。</p><p class="caution">機密保持確認を行うと、プロフィールに以下の認定マークが表示されます。機密保持確認は任意ですが、機密保持確認有無によって、会員の皆様の責任等に変わりはありません。詳しくは利用規約をご確認ください。</p><p class="caution">機密保持確認を行うと、あなたがFMの場合、<span class="fontstyleb fcolorblack">信頼性が向上し、より提案が選ばれやすくなります。提案できる仕事の数も大きく増加します。結果、報酬が得やすくなります。</span>あなたがクライアントの場合も、<span class="fontstyleb fcolorblack">信頼性の向上により、FMが安心して積極的に提案がされる</span>ようになり、双方にとって大きなメリットがあります。</p>

						    <h2 id="top">機密保持確認</h2>
						    <p class="caution"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><span class="fontstyleb fcolorblack">機密保持確認には、本人確認資料の提出が事前に必要です。</span></p>
						     <p class="caution">大変お手数をお掛け致しますが、機密保持確認をするためには、先に <a href="user_identity.php">本人確認資料提出</a>を行って、本人確認済ユーザーになっている必要があります。</p>
						    
						    <form method="post" enctype="multipart/form-data">
						    <table class="user_config_table">
							    <tr>
			  						<td>規約反映</a>
			  						</td>
			  					</tr>
			  					<tr>
			  						<td><textarea class="form-control" rows="40" name="privacy" id="privacy" placeholder=""><?php if(isset($_POST['privacy'])) {echo $_POST['privacy']; } else {echo $matter_content;}?></textarea>
			  						<br /><br />
			  						<label class="checkbox-inline"><input type="checkbox" value="2" name="check[]" <?php if(isset($area_value_c[1])){ echo "checked";} ?>>登録住所が番地・部屋番号まで証明書類と一致している</label>
			  						</td>
			  					</tr>
			  				</table>
			  				<button type="submit" class="btn btn-success btn-lg" name="upload">同意する <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
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