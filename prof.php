<?php
session_start();
include_once './dbconnect.php';
//未ログイン時はログインページへ

	
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
	$kana_f = $row['kana_f'];
	
/*
	if(empty($kana_f)){
		header("Location: prof.php?no=$no#first_fm_Modal");
		exit;
	}
*/
	
	// データベースの切断
	$result->close();
}

$fm_prof_view = $_GET['no'];
$query_prof = "SELECT * FROM user INNER JOIN prof ON user.no = prof.no JOIN fm ON prof.no = fm.no WHERE user.no = '$fm_prof_view'";	
$result_prof = $mysqli->query($query_prof);
$row_prof = $result_prof->fetch_assoc();
$name_prof = $row_prof['name'];
$kana_f_prof = $row_prof['kana_f'];
$kana_l_prof = $row_prof['kana_l'];
$mode_prof = $row_prof['mode'];
$email_prof = $row_prof['email'];
$no_prof = $row_prof['no'];
$img_path_prof = $row_prof['img_path'];
$img_sub_prof_path_prof = $row_prof['img_sub_prof_path'];

$title_prof = $row_prof['title'];
$license_prof = $row_prof['license'];
$area_prof = $row_prof['area'];
$skill_prof = $row_prof['skill'];
$copy_prof = $row_prof['copy'];
$fan_prof = $row_prof['fan'];
$facebook_url_prof = $row_prof['facebook_url'];
$twitter_url_prof = $row_prof['twitter_url'];
$instagram_url = $row_prof['instagram_url'];
$link1_prof = $row_prof['link1'];
$link2_prof = $row_prof['link2'];
$other_prof = $row_prof['other'];

//資格の配列をチェック
	$separator_license = ' ';
	$license_prof = (explode($separator_license, $license_prof));
	foreach($license_prof as $license_value){
		for($i = 1; $i <= 4; $i++){
		if($license_value == "$i"){ $license_value_c["$i"] = "$i"; }
		}
	}
//スキルの配列をチェック
	$separator_skill = ' ';
	$skill_prof = (explode($separator_skill, $skill_prof));
	foreach($skill_prof as $skill_value){
		for($i = 1; $i <= 25; $i++){
		if($skill_value == "$i"){ $skill_value_c["$i"] = "$i"; }
		}
	}
//エリアの配列をチェック
	$separator_area = ' ';
	$area_prof = (explode($separator_area, $area_prof));
	foreach($area_prof as $area_value){
		for($i = 1; $i <= 45; $i++){
		if($area_value == "$i"){ $area_value_c["$i"] = "$i"; }
		}
	}

if( isset($_SESSION['user']) != "") {
	//お気に入り機能
	$favorite_query = "SELECT * FROM favorite_fm WHERE fm_no = '$fm_prof_view' AND co_no = ".$_SESSION['user']."";	
	$favorite_result = $mysqli->query($favorite_query);
	$favorite_row = $favorite_result->fetch_assoc();
	//削除
	if(isset($_POST['yes'])) {
		$favorite_del_query = "DELETE FROM favorite_fm WHERE fm_no = '$fm_prof_view' AND co_no = ".$_SESSION['user']."";
		$favorite_del_result = $mysqli->query($favorite_del_query);
		 header("Location:http://recoro.net/sample/prof.php?no={$fm_prof_view}");
	}
	//IN
	if(isset($_POST['favorite_in'])) {
		$favorite_in_query = "INSERT INTO favorite_fm (co_no, fm_no) VALUES (".$_SESSION['user'].", '$fm_prof_view')";
		$favorite_in_result = $mysqli->query($favorite_in_query);
		 header("Location:http://recoro.net/sample/prof.php?no={$fm_prof_view}");
	}

}
	$favorite_count_query = "SELECT COUNT(*) AS favorite_count FROM favorite_fm WHERE fm_no = '$fm_prof_view'";	
	$favorite_count_result = $mysqli->query($favorite_count_query);
	$favorite_count_row = $favorite_count_result->fetch_assoc();
	$favorite_count = $favorite_count_row['favorite_count'];	
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
		    <section id="prof-page" class="clearfix row1200">
		  	  <div class="col-xs-12 col-sm-3">
			  	  <div class="prof_img pall-20">
			  		  <img src="upload/<?php echo $img_sub_prof_path_prof; ?>" alt="" class="img-responsive img-circle center-block">
			  	  </div>
			  	  <?php 
			        if( isset($_SESSION['user']) != "") {
				        if(isset($favorite_row)){ ?>
					    <h2 class="text-center heart"><a href="#fm_del_Modal" data-toggle="modal" data-target="#fm_del_Modal" class="heart_on"><i class="fa fa-heart" aria-hidden="true"></i></a></h2>
					    <p class="color-gray text-center heart">お気に入り登録数：<?php echo $favorite_count; ?>人</p>
					    <?php
					    } else { ?>
				        <form action="" method="post" name="favorite_in_form" class="inline-block"><input type="hidden" name="favorite_in" value="favorite_in" />
					    <h2 class="text-center heart"><a href="javascript:document.favorite_in_form.submit()" class="heart_off"><i class="fa fa-heart" aria-hidden="true"></i></a></h2>
					    <p class="color-gray text-center heart">お気に入り登録数：<?php echo $favorite_count; ?>人</p>
						</p>
						</form>
				        <?php
					    } ?>
			        <?php
			        } else { ?>
			        <h2 class="text-center heart"><a href="#regist_equir_Modal" data-toggle="modal" data-target="#regist_equir_Modal" class="heart_off"><i class="fa fa-heart" aria-hidden="true"></i></a></h2>
			        <p class="color-gray text-center heart">お気に入り登録数：<?php echo $favorite_count; ?>人</p>
			  	  <?php
			  	  } ?>
		  	  </div>
		  	  <div class="col-xs-12 col-sm-9">
		  		  <div class="pall-20">
			  		  <h1><?php echo $name_prof; ?><span class="fs80">（<?php echo $kana_f_prof; ?><?php echo $kana_l_prof; ?>）<?php echo $no_prof; ?></span></h1>
			  		  <h2><?php echo $title_prof; ?></h2>
			  		  <?php
			  		  for($i = 1; $i <= 4; $i++){
				  		  if(isset($license_value_c[$i])){ ?>
				  		  <div class="category-item"><p><?php license_status($license_value_c[$i]);?></p></div>
				  		  <?php
				  		  } ?>
			  		  <?php
			  		  } ?>
			  		  <p class="lh150"><?php echo $copy_prof; ?></p>
			  		  <hr />
			  		  <?php
			  		  for($i = 1; $i <= 25; $i++){
				  		  if(isset($skill_value_c[$i])){ ?>
				  		  <div class="category-item"><p><?php skill_status($skill_value_c[$i]);?></p></div>
				  		  <?php
				  		  } ?>
			  		  <?php
			  		  } ?>
			  		  <p class="text-right endp"><?php if(!empty($facebook_url_prof)){ ?><a href="<?php echo $facebook_url_prof; ?>" target="blank"><i class="fa fa-facebook-square fa-3x fa-gray" aria-hidden="true"></i></a>　<?php } ?><?php if(!empty($twitter_url_prof)){ ?><a href="<?php echo $twitter_url_prof; ?>" target="blank"><i class="fa fa-twitter-square fa-3x fa-gray" aria-hidden="true"></i></a>　<?php } ?><?php if(!empty($instagram_url)){ ?><a href="<?php echo $instagram_url; ?>" target="blank"><i class="fa fa-instagram fa-3x fa-gray" aria-hidden="true"></i></a>　<?php } ?><?php if(!empty($link1_prof)){ ?><a href="<?php echo $link1_prof; ?>" target="blank"><i class="fa fa-globe fa-3x fa-gray" aria-hidden="true"></i></a>　<?php } ?><?php if(!empty($link2_prof)){ ?><a href="<?php echo $link2_prof; ?>" target="blank"><i class="fa fa-globe fa-3x fa-gray" aria-hidden="true"></i></a>　<?php } ?></p>
		  		  </div>
		  	  </div>
		    </section>
		    <section id="description" class="clearfix">
		  	  <div class="clearfix row1200">
			  	  <div class="col70">
			  		  <section id="des_contets" class="mt20">
			  			  <?php echo $other_prof; ?>
			  		  </section>
			  	  </div>
			  	  <div class="col30">
			  		  <div id="des_side">
				  		  <h2 class="skill"><i class="fa fa-map-marker" aria-hidden="true"></i> 対応エリア</h2>
				  		  <div class="area_div">
				  		  <?php
				  		  for($i = 1; $i <= 25; $i++){
					  		  if(isset($area_value_c[$i])){ ?>
					  		  <div class="category-item"><p class="area"><?php area_status($area_value_c[$i]);?></p></div>
					  		  <?php
					  		  } ?>
				  		  <?php
				  		  } ?>
				  		  </div>
			  			  <h2 class="skill"><i class="fa fa-cog" aria-hidden="true"></i> スキル</h2>
			  			  <div class="circle center-block mt30">
			  				  <h1>70</h1>
			  			  </div>
			  			  <hr />
			  			  <p class="text-center">販　売：<i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i></p>
			  			  <p class="text-center">トーク：<i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star-o fa-2x" aria-hidden="true"></i></p>
			  			  <p class="text-center">分　析：<i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star fa-2x" aria-hidden="true"></i> <i class="fa fa-star-o fa-2x" aria-hidden="true"></i> <i class="fa fa-star-o fa-2x" aria-hidden="true"></i> <i class="fa fa-star-o fa-2x" aria-hidden="true"></i></p>
			  			  <hr />
			  			  
			  			  <h2><i class="fa fa-cog" aria-hidden="true"></i> 参加した案件</h2>
			  				  <div class="box01 alpha">
			  					  <a href="#">
			  					  <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
			  					  <p class="fcolorgray">店頭での野菜販売マルシェ</p>
			  					  <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 販売店</p>
			  					  </a>
			  				  </div>
			  				  <div class="box01 alpha">
			  					  <a href="#">
			  					  <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
			  					  <p class="fcolorgray">店頭での野菜販売マルシェ</p>
			  					  <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 販売店</p>
			  					  </a>
			  				  </div>
			  				  <div class="box01 alpha">
			  					  <a href="#">
			  					  <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
			  					  <p class="fcolorgray">店頭での野菜販売マルシェ</p>
			  					  <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 販売店</p>
			  					  </a>
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


	<!--モーダル-->
	<?php 
	include('modal.php');?>
	<!--モーダル-->    
    	
  </body>
</html>