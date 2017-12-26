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
}
// データベースの切断
$result->close();
if(isset($_POST['project'])) {
	$project_title = $_POST['project_title'];
	$project_description = $_POST['project_description'];
	$project_address = $_POST['project_address'];
	$project_datetime = $_POST['project_date'];
	$datetime_now = date("Y-m-d H:i:s");
	$datetime_number = date("YmdHis");
	$project_no = "$no$datetime_number";
	
	$project_url = $_POST['project_url'];
	$project_money = $_POST['project_money'];
	$project_time = $_POST['project_time'];
	$project_other = $_POST['project_other'];
	
	$up_img = $img_sub_prof_path;

		if($_FILES['img']['size'] === 0) {
		
		} else {
			$up_img = resizeImage($_FILES["img"],(int)$_POST["width"],'','1200','900');
		}
	$query_project_in = "INSERT INTO project (no, project_no, title, project_datetime, description, project_address, main_img_path, status, category, datetime) VALUES ('$no', '$project_no', '$project_title', '$project_datetime', '$project_description', '$project_address', '$up_img', 3, 1, '$datetime_now')";
	$result_project_in = $mysqli->query($query_project_in);
	if (!$result_project_in) {
		print('1クエリーが失敗しました。' . $mysqli->error);
		$mysqli->close();
		exit();
	}
	if(isset($result_project_in)) {  ?>
		<div class="alert alert-success alertfadeOut" role="alert">登録しました</div>
		<?php } else { ?>
		<div class="alert alert-danger alertfadeOut" role="alert">エラーが発生しました。</div>
		<?php
		} ?>
<?php
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
							    <li><a href="co_progress_new.php" class="active">案件新規作成<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="co_progress_list.php">案件一覧<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="co_progress_status.php">応募状況<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">案件新規作成</h2>
						    <p class="caution"></p>
						    <h2 id="top">詳細説明</h2>
						    <form method="post" enctype="multipart/form-data">
							<table class="user_config_table">
								<tr>
			  						<th>詳細説明</th>
			  						<td><textarea  rows="10" id="textarea" class="form-control" name="project_description" placeholder="詳細説明" value="" ></textarea></td>
			  					</tr>
							</table>
							<h2 id="top">開催情報</h2>
						    <table class="user_config_table">
							    <tr>
			  						<th>タイトル</th>
			  						<td><input class="form-control" type="text" id="project_title" placeholder="案件名" name="project_title" value="案件名"></td>
			  					</tr>
							    <tr>
			  						<th>メイン画像</th>
			  						<td class="form-inline">
			  						<input type="file" name="img"><br>
									<input type="hidden" name="width" value="1200">
			  						</td>
			  						
			  					</tr>
			  					<tr>
			  						<th>開催場所</th>
			  						<td><input class="form-control" type="text" id="project_address" placeholder="開催場所" name="project_address" value="開催場所"></td>
			  					</tr>
			  					<tr>
			  						<th>開催日</th>
			  						<td><input class="form-control" type="datetime-local" id="project_date" placeholder="開催日" name="project_date" value="開催日"></td>
			  					</tr>
			  					<tr>
			  						<th>URL</th>
			  						<td><input class="form-control" type="text" id="project_url" placeholder="URL" name="project_url" value="URL"></td>
			  					</tr>
			  				</table>
			  				<h2 id="top">報酬・待遇</h2>
			  				<table class="user_config_table">

			  					<tr>
			  						<th>報酬</th>
			  						<td><input class="form-control" type="text" id="project_money" placeholder="報酬" name="project_money" value="報酬"></td>
			  					</tr>
			  					<tr>
			  						<th>勤務時間</th>
			  						<td><input class="form-control" type="text" id="project_time" placeholder="勤務時間" name="project_time" value="勤務時間"></td>
			  					</tr>
			  					<tr>
			  						<th>その他</th>
			  						<td><input class="form-control" type="text" id="project_other" placeholder="その他" name="project_other" value="その他"></td>
			  					</tr>
			  				</table>
			  				<button type="submit" class="btn btn-success btn-lg" name="project">登録する <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
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