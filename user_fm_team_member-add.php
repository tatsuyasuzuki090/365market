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
	
	$datetime_now = date("Y-m-d H:i:s");
	
	$query_team = "SELECT * FROM team WHERE reader_no = ".$_SESSION['user']."";	
	$result_team = $mysqli->query($query_team);
	
	if(isset($_POST['team_member_add'])){
		$team_member_add = $_POST['team_member_add'];
		//$query_news = "SELECT * FROM user WHERE name LIKE '%$team_member_add%'";
		$query_team_member_add = "SELECT * FROM user WHERE name = '$team_member_add'";	
		$result_team_member_add = $mysqli->query($query_team_member_add);
		$row_team_member_add = $result_team_member_add->fetch_assoc();
		$team_member_add_name = $row_team_member_add['name'];
		$team_member_add_no = $row_team_member_add['no'];
		
		$team_no = $_GET['team_no'];
		//重複検索
		$query_search = "SELECT * FROM team_member WHERE team_no = '$team_no' AND fm_no = '$team_member_add_no'";	
		$result_search = $mysqli->query($query_search);
		$row_search = $result_search->fetch_assoc();

		if(isset($row_search)){ ?>
		<div class="alert alert-danger" role="alert">すでに登録されています。</div>
		<?php
		} else {
			$query_team_member_addset = "INSERT INTO team_member (team_no, fm_no) VALUES ('$team_no', '$team_member_add_no')";
			//$result_team_member_addset = $mysqli->query($query_team_member_addset);
			if($mysqli->query($query_team_member_addset)) {
				$news_title = "{$name}さんからメンバーに追加されました";
				
				$news_text = "<p><a href=\"prof.php?no={$no}\" target=\"blank\">{$name}さん</a>からメンバーに追加されました。<br/>詳細は<a href=\"user_fm_team.php\">マイページ</a>よりご確認ください。</p>";
				$query_addset_news = "INSERT INTO news (no, user_no, news_title, news_text, category, datetime) VALUES (1,'$team_member_add_no', '$news_title', '$news_text', 100, '$datetime_now')";
				$result_addset_news = $mysqli->query($query_addset_news);
			?>
			<div class="alert alertfadeOut alert-success" role="alert">登録しました</div>
			<?php } else { ?>
			<div class="alert alert-danger" role="alert">入力されたFMは存在しません。</div>
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
							    <li><a href="user_fm_team.php">マイチーム一覧<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_team_member-add.php" class="active">メンバー<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_team_info.php">チーム情報<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_message_list.php">チーム内メッセージ<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_message_list.php">クライアントメッセージ<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    
				    <div class="col-xs-12 col-sm-9">
					    <?php
						if(isset($result_team)) { ?>
					    <div class="col-sm-12 mb10">
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								ユーザーを追加するチームを選択してください
								  <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								<?php
								while( $row_team = $result_team->fetch_assoc()) {
									$team_no = $row_team['team_no'];
									$team_name = $row_team['team_name'];
									
									$team_description = $row_team['team_description']; ?>
									<li><a href="user_fm_team_member-add.php?team_no=<?php echo $team_no; ?>"><?php echo $team_name; ?></a></li>
								<?php
								} ?>
								</ul>
							</div>
					    </div>
					    <?php
					    } ?>
					    <div class="pall-10">
						<?php
						//チームのメンバー表示
						if(isset($_GET['team_no'])) { $team_no = $_GET['team_no']; 
						$query_team_member = "SELECT * FROM team INNER JOIN team_member ON team.team_no = team_member.team_no INNER JOIN user ON team_member.fm_no = user.no WHERE reader_no = ".$_SESSION['user']." AND team.team_no = '$team_no'";	
						$result_team_member = $mysqli->query($query_team_member);
						$row_team_member = $result_team_member->fetch_assoc();
						$team_member_team_name = $row_team_member['team_name'];
						}
						if(!empty($_GET['team_no'])){ ?>
						    <h2 id="top"><?php echo "（{$team_member_team_name}）"; ?>のメンバー一覧</h2>
						    <p class="caution"></p>
						    <form class="form-inline" method="post">
								  <div class="form-group">
								    <label class="sr-only" for="team_member">ユーザー名</label>
								    <input type="text" class="form-control" placeholder="FM名" id="user_auto" name="team_member_add" size="20">
								  </div>
								  <button type="submit" class="btn btn-primary">追加する</button>
						   </form>
						    <table class="user_team_table table-mt20mb20">
			  					<tr>
			  						<th>チーム名</th>
			  						<td>
				  						<?php
										//チームのメンバー表示
										if(isset($_GET['team_no'])) { $team_no = $_GET['team_no']; } 
										$query_team_member = "SELECT * FROM team INNER JOIN team_member ON team.team_no = team_member.team_no INNER JOIN user ON team_member.fm_no = user.no WHERE reader_no = ".$_SESSION['user']." AND team.team_no = '$team_no'";	
										$result_team_member = $mysqli->query($query_team_member);
										while( $row_team_member = $result_team_member->fetch_assoc()) {
											$team_member_reader_no = $row_team_member['reader_no'];
											$team_member_img_path = $row_team_member['img_sub_prof_path'];
											$team_member_no = $row_team_member['no'];
											$team_member_name = $row_team_member['name'];
											$team_member_team_name = $row_team_member['team_name']; ?>
										<a href="#"><img src="upload/<?php echo $team_member_img_path; ?>" class="" style="max-width:50px"></a> 
										<?php
										} ?>
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