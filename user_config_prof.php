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
	$kana_f = $row['kana_f'];
	$kana_l = $row['kana_l'];
	$mode = $row['mode'];
	$email = $row['email'];
	$no = $row['no'];
	$id = $row['id'];
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
	$area = $row['area'];
	$skill = $row['skill'];
	$copy = $row['copy'];
	$fan = $row['fan'];
	$facebook_url = $row['facebook_url'];
	$twitter_url = $row['twitter_url'];
	$instagram_url = $row['instagram_url'];
	$link1 = $row['link1'];
	$link2 = $row['link2'];
	
	$other = $row['other'];
	
	//資格の配列をチェック
	$separator_license = ' ';
	$license = (explode($separator_license, $license));
	foreach($license as $license_value){
		if(strpos($license_value,'1') !== false){ $license_value_c[1] = 1; }
		if(strpos($license_value,'2') !== false){ $license_value_c[2] = 2; }
		if(strpos($license_value,'3') !== false){ $license_value_c[3] = 3; }
		if(strpos($license_value,'4') !== false){ $license_value_c[4] = 4; }
	}
	//エリアの配列をチェック
	$separator_area = ' ';
	$area = (explode($separator_area, $area));
	foreach($area as $area_value){
		for($i = 1; $i <= 45; $i++){
		if($area_value == "$i"){ $area_value_c["$i"] = "$i"; }
		}
	}
	
	//スキルの配列をチェック
	$separator_skill = ' ';
	$skill = (explode($separator_skill, $skill));
	foreach($skill as $skill_value){
		for($i = 1; $i <= 25; $i++){
		if($skill_value == "$i"){ $skill_value_c["$i"] = "$i"; }
		}

	}
	
	if(isset($_POST['prof'])) {
		$kana_f = $_POST['kana_f']; $kana_l = $_POST['kana_l'];
		$title = $_POST['title'];
		$copy = $_POST['copy'];
		$other = $_POST['other'];
		
		if(empty($kana_f) OR empty($kana_l) OR empty($title) OR empty($copy) OR empty($area) ){
			if(empty($kana_f)){$error['kana_f'] = "<div class=\"alert alert-warning\" role=\"alert\">名字のふりがなを入力してください。</div>";}
			if(empty($kana_l)){$error['kana_l'] = "<div class=\"alert alert-warning\" role=\"alert\">名前のふりがなを入力してください。</div>";}
			if(empty($title)){$error['title'] = "<div class=\"alert alert-warning\" role=\"alert\">メインコピーを入力してください。</div>";}
			if(empty($copy)){$error['copy'] = "<div class=\"alert alert-warning\" role=\"alert\">サブコピーを入力してください。</div>";}
			if(empty($area)){$error['area'] = "<div class=\"alert alert-warning\" role=\"alert\">対応エリアをチェックしてください。</div>";}
		

		} else { 
			
		//チェックボックスを配列、統合で格納
		$license = $_POST['license'];
		$license = join(" ", $license);
		
		$area = $_POST['area'];
		$area = join(" ", $area);
		
		$skill = $_POST['skill'];
		$skill = join(" ", $skill);

		$facebook_url = $_POST['facebook_url'];
		$twitter_url = $_POST['twitter_url'];
		$instagram_url = $_POST['instagram_url'];
		$link1 = $_POST['link1'];
		$link2 = $_POST['link2'];
		
		$up_img = $img_sub_prof_path;
		
		
		if($_FILES['img']['size'] === 0) {
		
		} else {
			$up_img = resizeImage($_FILES["img"],(int)$_POST["width"],'','400','400');
		}

	
		$query_prof = "UPDATE fm SET license = '$license', copy = '$copy', fan = '$fan', title = '$title', area = '$area', skill = '$skill', facebook_url = '$facebook_url', twitter_url = '$twitter_url', instagram_url = '$instagram_url', link1 = '$link1', link2 = '$link2', other = '$other' WHERE no = ".$_SESSION['user']."";
		$result_prof = $mysqli->query($query_prof);
	
		$query_prof2 = "UPDATE user SET kana_f = '$kana_f', kana_l = '$kana_l', img_sub_prof_path = '$up_img' WHERE no = ".$_SESSION['user']."";
		$result_prof2 = $mysqli->query($query_prof2);
		
		
		if($mysqli->query($query_prof2)) {  ?>
			<div class="alert alertfadeOut alert-success" role="alert">登録しました</div>
			<?php
			}

		}
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
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropper/1.0.0/cropper.min.css" rel="stylesheet" type="text/css" media="all"/>

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
				  		  <h1><?php echo $name; ?><span class="fs80">（<?php echo "$kana_f"." "."$kana_l"; ?>）</span></h1>
				  		  <p>自分のプロフィールURL：<br class="sc-none" /><a href="prof.php?no=<?php echo $no; ?>">https://365market/prof.php?=21</a></p>
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
							    <li><a href="user_config_prof.php#top" class="active">プロフィール編集<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_notice.php#top">通知設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_mail.php#top">メール設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_pass.php#top">パスワード設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_config_address.php#top">住所・連絡先設定<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">プロフィール編集（ID:<?php echo $no; ?>）</h2>
						    <p class="caution"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>登録名の変更は直接お問い合わせください。</p>
						    <form method="post" enctype="multipart/form-data">
						    <table class="user_config_table">
							    <tr>
			  						<th>プロフィール画像</th>
			  						<div>
			  						<td class="form-inline"><img src="upload/<?php if(isset($img_sub_prof_path)){ echo $img_sub_prof_path;} ?>" alt="" class="img-responsive"><br />
			  						<p class="caution"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>400px×400px以上の正方形を推奨</p>
			  						<input type="file" name="img" value="" /><br>
									<input type="hidden" name="width" value="400"/><br>
									<a href="#user_config_prof_Modal" data-toggle="modal" data-target="#user_config_prof_Modal">トリミング</a>
			  						</td>
			  						</div>
			  					</tr>
				  				<tr>
			  						<th>名前</th>
			  						<div>
			  						<td class="form-inline"><?php echo $name; ?></td>
			  						</div>
			  					</tr>
			  					<tr>
			  						<th>ふりがな</th>
			  						<div>
			  						<td class="form-inline"><input type="text" id="kana_f" class="form-control form-group" name="kana_f" placeholder="せい" required autofocus value="<?php if(isset($kana_f)){ echo $kana_f;} ?>"> <input type="text" id="kana_l" class="form-control form-group" name="kana_l" placeholder="めい" required autofocus value="<?php if(isset($kana_l)){ echo $kana_l;} ?>">
			  						<?php if(isset($error['kana_f'])) { echo $error['kana_f']; } ?>
			  						<?php if(isset($error['kana_l'])) { echo $error['kana_l']; } ?>
			  						</td>
			  						</div>
			  					</tr>
			  					<tr>
			  						<th>メインコピー</th>
			  						<td><input class="form-control" type="text" id="title" placeholder="メインコピー" name="title" value="<?php echo $title; ?>">
			  						<?php if(isset($error['title'])) { echo $error['title']; } ?></td>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>資格</th>
			  						<td>
										<label class="checkbox-inline"><input type="checkbox" value="1" name="license[]" <?php if(isset($license_value_c[1])){ echo "checked";} ?>>管理栄養士</label>
										<label class="checkbox-inline"><input type="checkbox" value="2" name="license[]" <?php if(isset($license_value_c[2])){ echo "checked";} ?>>調理師</label>
										<label class="checkbox-inline"><input type="checkbox" value="3" name="license[]" <?php if(isset($license_value_c[3])){ echo "checked";} ?>>野菜ソムリエ</label>
										<label class="checkbox-inline"><input type="checkbox" value="4" name="license[]" <?php if(isset($license_value_c[4])){ echo "checked";} ?>>あああ</label>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>サブコピー</th>
			  						<td><textarea class="form-control input-sm" rows="10" id="copy" placeholder="" name="copy" value="<?php if(isset($copy)){ echo $copy;} ?>"><?php if(isset($copy)){ echo $copy;} ?></textarea>
			  						<?php if(isset($error['copy'])) { echo $error['copy']; } ?></td>
			  					</tr>
			  					<tr>
			  						<th>対応エリア</th>
			  						<td>
										<label class="checkbox-inline"><input type="checkbox" value="1" name="area[]" <?php if(isset($area_value_c[1])){ echo "checked";} ?>>北海道</label>
										<label class="checkbox-inline"><input type="checkbox" value="2" name="area[]" <?php if(isset($area_value_c[2])){ echo "checked";} ?>>青森県</label>
										<label class="checkbox-inline"><input type="checkbox" value="3" name="area[]" <?php if(isset($area_value_c[3])){ echo "checked";} ?>>岩手県</label>
										<label class="checkbox-inline"><input type="checkbox" value="4" name="area[]" <?php if(isset($area_value_c[4])){ echo "checked";} ?>>宮城県</label>
										<label class="checkbox-inline"><input type="checkbox" value="5" name="area[]" <?php if(isset($area_value_c[5])){ echo "checked";} ?>>秋田県</label>
										<label class="checkbox-inline"><input type="checkbox" value="6" name="area[]" <?php if(isset($area_value_c[6])){ echo "checked";} ?>>山形県</label>
										<label class="checkbox-inline"><input type="checkbox" value="7" name="area[]" <?php if(isset($area_value_c[7])){ echo "checked";} ?>>福島県</label>
										<label class="checkbox-inline"><input type="checkbox" value="8" name="area[]" <?php if(isset($area_value_c[8])){ echo "checked";} ?>>茨城県</label>
										<label class="checkbox-inline"><input type="checkbox" value="9" name="area[]" <?php if(isset($area_value_c[9])){ echo "checked";} ?>>栃木県</label>
										<label class="checkbox-inline"><input type="checkbox" value="10" name="area[]" <?php if(isset($area_value_c[10])){ echo "checked";} ?>>群馬県</label>
										<label class="checkbox-inline"><input type="checkbox" value="11" name="area[]" <?php if(isset($area_value_c[11])){ echo "checked";} ?>>埼玉県</label>
										<label class="checkbox-inline"><input type="checkbox" value="12" name="area[]" <?php if(isset($area_value_c[12])){ echo "checked";} ?>>千葉県</label>
										<label class="checkbox-inline"><input type="checkbox" value="13" name="area[]" <?php if(isset($area_value_c[13])){ echo "checked";} ?>>東京都</label>
										<label class="checkbox-inline"><input type="checkbox" value="14" name="area[]" <?php if(isset($area_value_c[14])){ echo "checked";} ?>>神奈川県</label>
										<label class="checkbox-inline"><input type="checkbox" value="15" name="area[]" <?php if(isset($area_value_c[15])){ echo "checked";} ?>>新潟県</label>
										<label class="checkbox-inline"><input type="checkbox" value="16" name="area[]" <?php if(isset($area_value_c[16])){ echo "checked";} ?>>富山県</label>
										<label class="checkbox-inline"><input type="checkbox" value="17" name="area[]" <?php if(isset($area_value_c[17])){ echo "checked";} ?>>石川県</label>
										<label class="checkbox-inline"><input type="checkbox" value="18" name="area[]" <?php if(isset($area_value_c[18])){ echo "checked";} ?>>福井県</label>
										<label class="checkbox-inline"><input type="checkbox" value="19" name="area[]" <?php if(isset($area_value_c[19])){ echo "checked";} ?>>山梨県</label>
										<label class="checkbox-inline"><input type="checkbox" value="20" name="area[]" <?php if(isset($area_value_c[20])){ echo "checked";} ?>>長野県</label>
										<label class="checkbox-inline"><input type="checkbox" value="21" name="area[]" <?php if(isset($area_value_c[21])){ echo "checked";} ?>>岐阜県</label>
										<label class="checkbox-inline"><input type="checkbox" value="22" name="area[]" <?php if(isset($area_value_c[22])){ echo "checked";} ?>>静岡県</label>
										<label class="checkbox-inline"><input type="checkbox" value="23" name="area[]" <?php if(isset($area_value_c[23])){ echo "checked";} ?>>愛知県</label>
										<label class="checkbox-inline"><input type="checkbox" value="24" name="area[]" <?php if(isset($area_value_c[24])){ echo "checked";} ?>>三重県</label>
										<label class="checkbox-inline"><input type="checkbox" value="25" name="area[]" <?php if(isset($area_value_c[25])){ echo "checked";} ?>>滋賀県</label>
										<label class="checkbox-inline"><input type="checkbox" value="26" name="area[]" <?php if(isset($area_value_c[26])){ echo "checked";} ?>>京都府</label>
										<label class="checkbox-inline"><input type="checkbox" value="27" name="area[]" <?php if(isset($area_value_c[27])){ echo "checked";} ?>>大阪府</label>
										<label class="checkbox-inline"><input type="checkbox" value="28" name="area[]" <?php if(isset($area_value_c[28])){ echo "checked";} ?>>兵庫県</label>
										<label class="checkbox-inline"><input type="checkbox" value="29" name="area[]" <?php if(isset($area_value_c[29])){ echo "checked";} ?>>奈良県</label>
										<label class="checkbox-inline"><input type="checkbox" value="30" name="area[]" <?php if(isset($area_value_c[30])){ echo "checked";} ?>>和歌山県</label>
										<label class="checkbox-inline"><input type="checkbox" value="31" name="area[]" <?php if(isset($area_value_c[31])){ echo "checked";} ?>>鳥取県</label>
										<label class="checkbox-inline"><input type="checkbox" value="32" name="area[]" <?php if(isset($area_value_c[32])){ echo "checked";} ?>>島根県</label>
										<label class="checkbox-inline"><input type="checkbox" value="33" name="area[]" <?php if(isset($area_value_c[33])){ echo "checked";} ?>>岡山県</label>
										<label class="checkbox-inline"><input type="checkbox" value="34" name="area[]" <?php if(isset($area_value_c[34])){ echo "checked";} ?>>徳島県</label>
										<label class="checkbox-inline"><input type="checkbox" value="35" name="area[]" <?php if(isset($area_value_c[35])){ echo "checked";} ?>>香川県</label>
										<label class="checkbox-inline"><input type="checkbox" value="36" name="area[]" <?php if(isset($area_value_c[36])){ echo "checked";} ?>>愛媛県</label>
										<label class="checkbox-inline"><input type="checkbox" value="37" name="area[]" <?php if(isset($area_value_c[37])){ echo "checked";} ?>>高知県</label>
										<label class="checkbox-inline"><input type="checkbox" value="38" name="area[]" <?php if(isset($area_value_c[38])){ echo "checked";} ?>>福岡県</label>
										<label class="checkbox-inline"><input type="checkbox" value="39" name="area[]" <?php if(isset($area_value_c[39])){ echo "checked";} ?>>佐賀県</label>
										<label class="checkbox-inline"><input type="checkbox" value="40" name="area[]" <?php if(isset($area_value_c[40])){ echo "checked";} ?>>長崎県</label>
										<label class="checkbox-inline"><input type="checkbox" value="41" name="area[]" <?php if(isset($area_value_c[41])){ echo "checked";} ?>>熊本県</label>
										<label class="checkbox-inline"><input type="checkbox" value="42" name="area[]" <?php if(isset($area_value_c[42])){ echo "checked";} ?>>大分県</label>
										<label class="checkbox-inline"><input type="checkbox" value="43" name="area[]" <?php if(isset($area_value_c[43])){ echo "checked";} ?>>宮崎県</label>
										<label class="checkbox-inline"><input type="checkbox" value="44" name="area[]" <?php if(isset($area_value_c[44])){ echo "checked";} ?>>鹿児島県</label>
										<label class="checkbox-inline"><input type="checkbox" value="45" name="area[]" <?php if(isset($area_value_c[45])){ echo "checked";} ?>>沖縄県</label>
										<?php if(isset($error['area'])) { echo $error['area']; } ?>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>対応スキル</th>
			  						<td>
										<label class="checkbox-inline"><input type="checkbox" value="1" name="skill[]" <?php if(isset($skill_value_c[1])){ echo "checked";} ?>>モニター</label>
										<label class="checkbox-inline"><input type="checkbox" value="2" name="skill[]" <?php if(isset($skill_value_c[2])){ echo "checked";} ?>>レシピ開発</label>
										<label class="checkbox-inline"><input type="checkbox" value="3" name="skill[]" <?php if(isset($skill_value_c[3])){ echo "checked";} ?>>販売</label>
										<label class="checkbox-inline"><input type="checkbox" value="4" name="skill[]" <?php if(isset($skill_value_c[4])){ echo "checked";} ?>>試食提供</label>
										<label class="checkbox-inline"><input type="checkbox" value="5" name="skill[]" <?php if(isset($skill_value_c[5])){ echo "checked";} ?>>商品開発</label>
										<label class="checkbox-inline"><input type="checkbox" value="6" name="skill[]" <?php if(isset($skill_value_c[6])){ echo "checked";} ?>>栄養計算</label>
										<label class="checkbox-inline"><input type="checkbox" value="7" name="skill[]" <?php if(isset($skill_value_c[7])){ echo "checked";} ?>>社食作り</label>
										<label class="checkbox-inline"><input type="checkbox" value="8" name="skill[]" <?php if(isset($skill_value_c[8])){ echo "checked";} ?>>セミナー</label>
										<label class="checkbox-inline"><input type="checkbox" value="9" name="skill[]" <?php if(isset($skill_value_c[9])){ echo "checked";} ?>>料理教室</label>
										<label class="checkbox-inline"><input type="checkbox" value="10" name="skill[]" <?php if(isset($skill_value_c[10])){ echo "checked";} ?>>食育イベント企画</label>
										<label class="checkbox-inline"><input type="checkbox" value="11" name="skill[]" <?php if(isset($skill_value_c[11])){ echo "checked";} ?>>執筆</label>
										<label class="checkbox-inline"><input type="checkbox" value="12" name="skill[]" <?php if(isset($skill_value_c[12])){ echo "checked";} ?>>ブログ紹介</label>
										<label class="checkbox-inline"><input type="checkbox" value="13" name="skill[]" <?php if(isset($skill_value_c[13])){ echo "checked";} ?>>ウェブ制作</label>
										<label class="checkbox-inline"><input type="checkbox" value="14" name="skill[]" <?php if(isset($skill_value_c[14])){ echo "checked";} ?>>ロゴ作成</label>
										<label class="checkbox-inline"><input type="checkbox" value="15" name="skill[]" <?php if(isset($skill_value_c[15])){ echo "checked";} ?>>イベントスタッフ</label>
										<label class="checkbox-inline"><input type="checkbox" value="16" name="skill[]" <?php if(isset($skill_value_c[16])){ echo "checked";} ?>>料理人派遣</label>
										<label class="checkbox-inline"><input type="checkbox" value="17" name="skill[]" <?php if(isset($skill_value_c[17])){ echo "checked";} ?>>インストラクター</label>
										<label class="checkbox-inline"><input type="checkbox" value="18" name="skill[]" <?php if(isset($skill_value_c[18])){ echo "checked";} ?>>農家紹介</label>
										<label class="checkbox-inline"><input type="checkbox" value="19" name="skill[]" <?php if(isset($skill_value_c[19])){ echo "checked";} ?>>飲食店コンサルティング</label>
										<label class="checkbox-inline"><input type="checkbox" value="20" name="skill[]" <?php if(isset($skill_value_c[20])){ echo "checked";} ?>>野菜装飾</label>
										<label class="checkbox-inline"><input type="checkbox" value="21" name="skill[]" <?php if(isset($skill_value_c[21])){ echo "checked";} ?>>イベント司会</label>
										<label class="checkbox-inline"><input type="checkbox" value="22" name="skill[]" <?php if(isset($skill_value_c[22])){ echo "checked";} ?>>撮影</label>
										<label class="checkbox-inline"><input type="checkbox" value="23" name="skill[]" <?php if(isset($skill_value_c[23])){ echo "checked";} ?>>動画制作</label>
										<label class="checkbox-inline"><input type="checkbox" value="24" name="skill[]" <?php if(isset($skill_value_c[24])){ echo "checked";} ?>>食材調達</label>
										<label class="checkbox-inline"><input type="checkbox" value="25" name="skill[]" <?php if(isset($skill_value_c[25])){ echo "checked";} ?>>ワークショップ</label>
			  						</td>
			  					</tr>
			  					<tr>
			  						<th>facebook</th>
			  						<td><input type="text" class="form-control input-sm" rows="10" id="facebook_url" placeholder="facebook" name="facebook_url" value="<?php if(isset($facebook_url)){ echo $facebook_url;} ?>"></td>
			  					</tr>
			  					<tr>
			  						<th>twitter</th>
			  						<td><input type="text" class="form-control input-sm" rows="10" id="twitter_url" placeholder="twitter" name="twitter_url" value="<?php if(isset($twitter_url)){ echo $twitter_url;} ?>"></td>
			  					</tr>
			  					<tr>
			  						<th>instagram</th>
			  						<td><input type="text" class="form-control input-sm" rows="10" id="instagram_url" placeholder="instagram" name="instagram_url" value="<?php if(isset($instagram_url)){ echo $instagram_url;} ?>"></td>
			  					</tr>
			  					<tr>
			  						<th>ウェブサイト</th>
			  						<td><input type="text" class="form-control input-sm" rows="10" id="link1" placeholder="link1" name="link1" value="<?php if(isset($link1)){ echo $link1;} ?>"></td>
			  					</tr>
			  					<tr>
			  						<th>ウェブサイト</th>
			  						<td><input type="text" class="form-control input-sm" rows="10" id="link2" placeholder="link2" name="link2" value="<?php if(isset($link2)){ echo $link2;} ?>"></td>
			  					</tr>

			  				</table>
			  				<h2 id="top">本文</h2>
			  				<table class="user_config_table">
							    <tr>
								    <td><textarea class="mytextarea" name="other"><?php echo $other; ?></textarea></td>
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
	<!--モーダル-->
	<?php 
	include('modal.php');?>
	<!--モーダル-->        
    	
  </body>
</html>