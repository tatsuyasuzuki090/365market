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
	
	if(isset($_POST['upload'])) {
		$text_show = $_POST['text_show'];
		$check = $_POST['check'];
		$text_show = $_POST['text_show'];
		
		if(!isset($check)){ $error['check'] = "<div class=\"alert alert-warning\" role=\"alert\">チェック項目を確認の上、問題なければチェックしてください。</div>"; }
		if(!isset($text_show)){ $error['text_show'] = "<div class=\"alert alert-warning\" role=\"alert\">本人確認資料の種類を選択してください。</div>"; }
		
		
		
		
		$file_name = upload_file();
		
		
		//echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";
		//print_r($file_name);
		
		//配列の数をカウント
		//print count($file_name);
		
		//echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";echo "<br/>";

		//配列の前後を結合
		$space_separated = ($url . "/uploadfile/". implode("\n".$url . "/uploadfile/", $file_name));
		$check_separated = (implode("\n", $check));


		//メール送信　最後の数字flag 0：両方送信　1：片方送信
		mail_send('suzuki@vacavo.co.jp','','test@365market.jp','【書類】申請があります','',"$check_separated\n\n\n$text_show\n\n\n$space_separated\n\n\n$url/fm_prof_view.php?no={$no}$mail_footer","",'1');
	}
	
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
							    <li><a href="user_identity.php" class="active">本人確認書類提出<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_nda.php">機密保持・契約事項確認<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">本人確認書類提出</h2>
						    <p class="caution"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>「本人確認書類提出」とは、クライアント・FM双方の信頼性の向上と、トラブルを防止することを目的に、365Marketが、ユーザーの本人確認を行う手続きです。本人確認書類提出は任意です。</p><p class="caution">本人確認を行うと、あなたがFMの場合、信頼性が向上し、より提案が選ばれやすくなります。提案できる仕事の数も大きく増加します。結果、報酬が得やすくなります。あなたがクライアントの場合も、信頼性の向上により、FMが安心して積極的に提案がされるようになり、双方にとって大きなメリットがあります。</p>
						    <h2 id="top">本人確認書類の種類</h2>
						    <p class="caution">本人確認には、<span class="fontstyleb fcolorblack">下記のいずれか1点のコピー</span>を添付してください。</p>
						    <table class="user_config_table">
				  				<tr>
			  						<th>運転免許証</th>
			  						<td>表面をお送りください。住所変更などをされている場合は、<span class="fontstyleb fcolorblack">必ず裏面も</span>お送りください。</td>
			  					</tr>
			  					<tr>
			  						<th>各種健康保険</th>
			  						<td>表面をお送りください。365Marketへのご登録住所が裏面に記載されている場合は、<span class="fontstyleb fcolorblack">必ず裏面も</span>お送りください。</td>
			  					</tr>
			  					<tr>
			  						<th>パスポート</th>
			  						<td>氏名・住所・生年月日が確認できるページをお送りください。<span class="fontstyleb fcolorblack">別々の場合は両方のページをお送りください。</span></td>
			  					</tr>
			  					<tr>
			  						<th>外国人登録証明書</th>
			  						<td>住所等変更のため裏面に訂正事項がある場合は、<span class="fontstyleb fcolorblack">必ず裏面も</span>お送りください。</td>
			  					</tr>
			  					<tr>
			  						<th>住民基本台帳カード</th>
			  						<td>住所等変更のため裏面に訂正事項がある場合は、<span class="fontstyleb fcolorblack">必ず裏面も</span>お送りください。</td>
			  					</tr>
			  					<tr>
			  						<th>住所の記載のない証明書<br /><span class="fs80">（学生証や年金証書・在留カード等）</span></th>
			  						<td>公共料金のご利用明細書にて住所の確認を致しますので、あわせてお送りください。</td>
			  					</tr>
						    </table>
						    <h2 id="top">書類の提出</h2>
						    <p class="caution">登録氏名・住所・生年月日と<span class="fontstyleb fcolorblack">本人確認資料の登録氏名・住所・生年月日が一致しないと本人確認を承認できません。なお、本人確認には3〜5営業日が必要です。余裕を持った、資料提出をお願いします。</span>提出できるファイル形式は、JPG/GIF/PNG/BMPのみとなりますので、写真撮影もしくはスキャン等にてご送信ください。</p>
						    
						    <form method="post" enctype="multipart/form-data">
						    <table class="user_config_table">
							    <tr>
			  						<th>氏名</th>
			  						<td><?php echo $name;?><a href="user_config_address.php"> 編集する</a>
			  						</td>
			  					</tr>
				  				<tr>
			  						<th>住所</th>
			  						<td><?php echo $address;?><?php echo $address1;?><?php echo $address2;?><?php echo $address3;?><a href="user_config_address.php"> 編集する</a>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>添付ファイル</th>


			  						<td class="cf">
										<select name="text_show" id="text_show" class="form-group">
											<option value="">本人確認書類の種類を選択してください</option>
											<option value="運転免許証" name="text_show" >運転免許証</option>
											<option value="各種健康保険" name="text_show" >各種健康保険</option>
											<option value="パスポート" name="text_show" >パスポート</option>
											<option value="外国人登録証明書" name="text_show" >外国人登録証明書</option>
											<option value="住民基本台帳カード" name="text_show" >住民基本台帳カード</option>
											<option value="住所の記載のない証明書" name="text_show" >住所の記載のない証明書</option>
										</select>
										<?php if(isset($error)) { echo $error['text_show']; } ?>
										<ul id="filelist cf">
										  <li class="form-group identity"><input type="file" name="uploadfile[]" class="fileinput" multiple /></li>
										</ul>
										<?php if(isset($error)) { echo $error['uploadfile']; } ?>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>登録書類確認</th>
			  						<td><label class="checkbox-inline"><input type="checkbox" value="1チェック済み" name="check[]" <?php if(isset($area_value_c[1])){ echo "checked";} ?>>登録氏名が漢字・かな・ローマ字表記も含め証明書類と一致している</label>
			  						<label class="checkbox-inline"><input type="checkbox" value="2チェック済み" name="check[]" <?php if(isset($area_value_c[1])){ echo "checked";} ?>>登録住所が番地・部屋番号まで証明書類と一致している</label>
			  						<br />
			  						<?php if(isset($error['check'])) { echo $error['check']; } ?>
			  						<br />
			  						<a href="user_config_address.php">　※一致していない場合はこちらからプロフィールを編集してください。</a>
			  						</td>
			  					</tr>
			  				</table>
			  				<button type="submit" class="btn btn-success btn-lg" name="upload">申請する <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
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