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


//プロジェクト一覧取り出し
$query_news_list = "SELECT * FROM project WHERE no = ".$_SESSION['user']." ORDER BY datetime DESC";	
$result_news_list = $mysqli->query($query_news_list);

//ステータスの変更
if(isset($_GET['project_no'])) {
	$project_status = $_GET['project_status'];
	$project_no = $_GET['project_no'];
	
	switch ($project_status) {
	case '0':
	  $query_project_status_update = "UPDATE project SET status = '$project_status' WHERE project_no = '$project_no'";
	  $result_project_status_update = $mysqli->query($query_project_status_update);
	  break;
	case '1':
	  $query_project_status_update = "UPDATE project SET status = '$project_status' WHERE project_no = '$project_no'";
	  $result_project_status_update = $mysqli->query($query_project_status_update);
	  break;
	case '2':
	  $query_project_status_update = "UPDATE project SET status = '$project_status' WHERE project_no = '$project_no'";
	  $result_project_status_update = $mysqli->query($query_project_status_update);
	  break;
	  }
	  header("Location: co_progress_list.php");
}

//ソート
if(isset($_GET['project_status'])) {
	$project_status = $_GET['project_status'];
	switch ($project_status) {
	case '0':
	  $query_news_list = "SELECT * FROM project WHERE no = ".$_SESSION['user']." AND status = '$project_status' ORDER BY datetime DESC";
	  $result_news_list = $mysqli->query($query_news_list);
	  break;
	case '1':
	  $query_news_list = "SELECT * FROM project WHERE no = ".$_SESSION['user']." AND status = '$project_status' ORDER BY datetime DESC";
	  $result_news_list = $mysqli->query($query_news_list);
	  break;
	case '2':
	  $query_news_list = "SELECT * FROM project WHERE no = ".$_SESSION['user']." AND status = '$project_status' ORDER BY datetime DESC";
	  $result_news_list = $mysqli->query($query_news_list);
	  break;
	  }
	  

}
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
			  	       <li><a href="co_favorite.php"><i class="fa fa-heart" aria-hidden="true"></i> <span class="sp-none">お気に入りの案件</span></a></li>
			  	       <li><a href="co_progress_new.php" class="active"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span class="sp-none">案件管理</span></a></li>
			  	       <li><a href="user_fm_team.php"><i class="fa fa-users" aria-hidden="true"></i> <span class="sp-none">マイチーム</span></a></li>
			  	       <li><a href="user_pay_list.php"><i class="fa fa-jpy" aria-hidden="true"></i> <span class="sp-none">報酬管理</span></a></li>
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
							    <li><a href="co_progress_new.php">案件新規作成<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="co_progress_list.php" class="active">案件一覧<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="co_progress_status.php">応募状況<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">案件一覧</h2>
						    <p class="caution"></p>
						    <form method="post">
						    <table class="user_apply_table">
							    <tr class="sp-none480">
			  						<th>案件名</th>
			  						<td>状態</td>
			  						<td>操作</td>
			  					</tr>
			  					<?php
								while( $row_news_list = $result_news_list->fetch_assoc()) {
									$project_no = $row_news_list['project_no'];
									$project_title = $row_news_list['title'];
									$project_description = $row_news_list['description'];
									$project_status = $row_news_list['status'];
									$project_datetime = $row_news_list['datetime'];
									$project_description = mb_substr($project_description, 0, 50, 'utf-8'); //全角文字で先頭から50文字取得
									    if(mb_strlen($project_description, 'utf-8') > '49') { //18文字より多い場合は「...」を追加
								        $project_description .= '…';
								} ?>
			  					<tr>
			  						<th><a href="<?php echo $url; ?>/project_detail.php?project_no=<?php echo $project_no; ?>"><span class="color-green"><?php echo $project_title; ?></span></a><a href="<?php echo $url; ?>/co_progress_edit.php?project_no=<?php echo $project_no; ?>"><span class="color-green"><?php echo $project_title; ?></span></a><br /><?php echo $project_description; ?></th>
			  						<td><?php co_status($project_status); ?></td>
			  						<td>
				  						<div class="dropdown">
										  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										    操作
										    <span class="caret"></span>
										  </button>
										  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											
										    <li><a href="co_progress_list.php?project_status=0&project_no=<?php echo $project_no; ?>">募集中にする</a></li>
										    <li><a href="co_progress_list.php?project_status=1&project_no=<?php echo $project_no; ?>">停止中にする</a></li>
										    <li><a href="co_progress_list.php?project_status=2&project_no=<?php echo $project_no; ?>">終了する</a></li>
										  </ul>
										</div>
			  						</td>
			  					</tr>
			  					<?php
			  					} ?>

			  				</table>
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