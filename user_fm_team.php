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
	
	//チームの一覧表示
	$query_team = "SELECT * FROM team WHERE reader_no = ".$_SESSION['user']."";	
	$result_team = $mysqli->query($query_team);
	
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
			  	       <li><a href="user_fm_team.php" class="active"><i class="fa fa-users" aria-hidden="true"></i> <span class="sp-none">マイチーム</span></a></li>
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
							    <li><a href="user_fm_team.php" class="active">マイチーム一覧<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_team_member-add.php">メンバー<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_team_info.php">チーム情報<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_message_list.php">チーム内メッセージ<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_message_list.php">クライアントメッセージ<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">マイチーム一覧</h2>
						    <p class="caution"></p>
						    <?php
							while( $row_team = $result_team->fetch_assoc()) {
							$team_no = $row_team['team_no'];
							$team_name = $row_team['team_name'];
							$team_reader_no = $row_team['reader_no'];
							$team_img = $row_team['team_img'];
							$team_description = $row_team['team_description']; ?>
						    <table class="user_team_table">
			  					<tr>
			  						<th><a href="#"><?php echo $team_name; ?></a> <span class="label label-warning">12</span><a href="fm_team_info.php?team_no=<?php echo $team_no; ?>"><span class="pull-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></th>
			  						<td>
				  						<img src="upload/<?php echo $team_img; ?>" class="" style="max-width:50px" >
				  					<?php
									//チームのメンバー表示
									$query_team_member = "SELECT * FROM team INNER JOIN team_member ON team.team_no = team_member.team_no INNER JOIN user ON team_member.fm_no = user.no WHERE reader_no = ".$_SESSION['user']." AND team.team_no = '$team_no'";	
									$result_team_member = $mysqli->query($query_team_member);
									//row_cntの数を調べる
									$row_cnt = mysqli_num_rows($result_team_member);
									if($row_cnt == 0){ echo "<a href=\"user_fm_team_member-add.php?team_no=$team_no\">メンバーを追加する</a> "; }
									while( $row_team_member = $result_team_member->fetch_assoc()) {
										$team_member_reader_no = $row_team_member['reader_no'];
										$team_member_img_path = $row_team_member['img_sub_prof_path'];
										$team_member_no = $row_team_member['no']; ?>
										<a href="fm_prof_view.php?no=<?php echo $team_member_no; ?>"><img src="upload/<?php echo $team_member_img_path; ?>" class="" style="max-width:50px" ></a>
									<?php
									} ?>
									<a href="user_fm_team_member-add.php?team_no=<?php echo $team_no; ?>"><span class="pull-right"><i class="fa fa-user-plus" aria-hidden="true"></i></span></a>
									</td>
			  					</tr>
			  				</table>
			  				<?php
			  				} ?>
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