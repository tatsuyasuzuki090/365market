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

//お気に入り機能
$favorite_query = "SELECT * FROM project INNER JOIN favorite_project ON project.project_no = favorite_project.project_no  WHERE favorite_project.fm_no = ".$_SESSION['user']."";
$favorite_result = $mysqli->query($favorite_query);

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
			  	       <li><a href="user_fm_favorite.php" class="active"><i class="fa fa-heart" aria-hidden="true"></i> <span class="sp-none">お気に入りの案件</span></a></li>
			  	       <li><a href="user_fm_progress_apply.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span class="sp-none">案件の進捗状況管理</span></a></li>
			  	       <li><a href="user_fm_team.php"><i class="fa fa-users" aria-hidden="true"></i> <span class="sp-none">マイチーム</span></a></li>
			  	       <li><a href="user_pay_list.php"><i class="fa fa-jpy" aria-hidden="true"></i> <span class="sp-none">報酬管理</span></a></li>
			  	       <li><a href="user_config_prof.php"><i class="fa fa-cog" aria-hidden="true"></i> <span class="sp-none">各種設定</span></a></li>
			  	      </ul>
			  	  </div>
			  </div>
		    </section>
		    <section id="user_config" class="clearfix">
			    <div class="container">
				    <h2 id="top"><i class="fa fa-heart" aria-hidden="true"></i> お気に入りの案件</h2>
				    <?php
				    while( $favorite_row = $favorite_result->fetch_assoc()){
						$favorite_project_no = $favorite_row['project_no'];
						$favorite_project_title = $favorite_row['title'];
						$favorite_project_description = $favorite_row['description'];
						$favorite_project_main_img_path = $favorite_row['main_img_path'];
						$favorite_project_no = $favorite_row['project_no'];
						
						//文字制限
						$favorite_project_title = mb_strimwidth($favorite_project_title,0,30,'…');
						$favorite_project_description = mb_strimwidth($favorite_project_description,0,40,'…'); ?>
				    
				    <div class="col-xs-12 col-sm-4 col-md-3 mb10">
		  			  <div class="box000 alpha mall-05">
		  			    <a href="project_detail.php?project_no=<?php echo $favorite_project_no; ?>">
			  			    <p class="alpha mb10"><img src="<?php echo $url; ?>/upload/re_<?php echo $favorite_project_main_img_path; ?>" class="img-responsive" /></p>
		  				    <p class="fcolorgray"><?php echo $favorite_project_title; ?></p>
		  				    <p class="fcolorgray"><?php echo $favorite_project_description; ?></p>
		  				    <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 販売スタッフ</p>
		  				</a>
		  			  </div>
				    </div>
				    <?php
				    }
				    ?>

			    </div>
			    
			    <div class="container">
				    <hr />
				    <h2 id="top"><i class="fa fa-check" aria-hidden="true"></i> すでに見た案件</h2>

				    
<?php
if(isset($_COOKIE['history_url'])){
	$history_url = unserialize($_COOKIE['history_url']); //クッキーに保存されたURLを配列にする
}
if(isset($_COOKIE['data_project_title'])){
	$data_project_title = unserialize($_COOKIE['data_project_title']); //クッキーに保存されたURLを配列にする
}
if(isset($_COOKIE['data_project_img'])){
	$data_project_img = unserialize($_COOKIE['data_project_img']); //クッキーに保存されたURLを配列にする
}
//if(isset($_COOKIE['data_project_description'])){
	//$data_project_description = unserialize($_COOKIE['data_project_description']); //クッキーに保存されたURLを配列にする
//}
if(isset($_COOKIE['data_project_no'])){
	$data_project_no = unserialize($_COOKIE['data_project_no']); //クッキーに保存されたテキストを配列にする
	$i = 0;
	echo '<div class="row">';
	foreach($data_project_no as $key=>$val){
		//文字数制限
		$data_project_title[$i] = mb_strimwidth($data_project_title[$i],0,30,'…');
		//$data_project_description[$i] = mb_strimwidth($data_project_description[$i],0,60,'…');

		echo '<div class="col-xs-6 col-sm-3 col-md-2 mb10"><div class="box000 alpha mall-05"><a href="'.$history_url[$i].'"><p class="mb10"><img src="'.$url.'/upload/re_'.$data_project_img[$i].'" class="img-responsive" /></p><p class="fcolorgray">'.$data_project_title[$i].'</p><p class="fcolorgray"></p><p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 販売スタッフ</p></a></div></div>',"\n"; //テキストを表示および同じ順番に保存されてい	るURLを表示
	$i++;
	
	}

	}else{
	echo '<p>過去に見たページはありません。</p>';
	}
	
?>
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