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
	//★★★★65行目に同じ処理----気になる★★★★
	$query_team = "SELECT * FROM team WHERE reader_no = ".$_SESSION['user']."";	
	$result_team = $mysqli->query($query_team);
	
	//チーム修正・追加
	if(isset($_POST['check'])){
		if(empty($_POST['team_name'])){
			$team_name_error = "<div class=\"alert_none alert-warning\">チーム名を入力してください</div>";
		}
		//if(empty($_POST['team_img'])){
		//	$team_img_error =  "画像を登録してください";
		//}
		if(empty($_POST['team_description'])){
			$team_description_error =  "<div class=\"alert_none alert-warning\">チーム紹介文を入力してください</div>";
		} else {
			if(isset($_POST['modify']) && !empty($_POST['team_name']) && !empty($_POST['team_description'])){
				$team_name = $_POST['team_name'];
				$team_description = $_POST['team_description'];
				$team_no = $_POST['team_no'];
				$team_img = $_POST['team_img'];
				$up_img = $team_img;
				if($_FILES['img']['size'] === 0) {
					} else {
					$up_img = resizeImage($_FILES["img"],(int)$_POST["width"],'','400','400');
				}
				$query_team_in = "UPDATE team SET team_name = '$team_name',team_description = '$team_description',team_img = '$up_img',datetime = '$datetime_now' WHERE team_no = '$team_no'";
			} else {
				$query_team_in = 0;
			}
			if(isset($_POST['add'])){
				$team_name = $_POST['team_name'];
				$team_description = $_POST['team_description'];
				$team_no = $_POST['team_no'];
				$team_img = $_POST['team_img'];
				
				$up_img = $team_img;

				if($_FILES['img']['size'] === 0) {
					} else {
					$up_img = resizeImage($_FILES["img"],(int)$_POST["width"],'','400','400');
				}
				

				$query_team_in = "INSERT INTO team (team_no, reader_no, team_name, team_description, team_img, datetime) VALUES ('$team_no', ".$_SESSION['user'].", '$team_name', '$team_description', '$up_img', '$datetime_now')";
			}
			if($mysqli->query($query_team_in)) {  ?>
			<div class="alert alertfadeOut alert-success" role="alert">登録しました</div>
			<?php
			}
		
		//リロード対策部分未設置
		//header("Location: fm_team_info.php?team_no=$team_no");

		//★★★★気になる★★★★
		$query_team = "SELECT * FROM team WHERE reader_no = ".$_SESSION['user']."";	
		$result_team = $mysqli->query($query_team);
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
							    <li><a href="user_fm_team_member-add.php">メンバー<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_team_info.php" class="active">チーム情報<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
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
									$team_id = $row_team['id'];
									$team_name = $row_team['team_name'];
									$team_description = $row_team['team_description']; ?>
									<li><a href="user_fm_team_info.php?team_no=<?php echo $team_no; ?>"><?php echo $team_name; ?></a></li>
								<?php
								} ?>
							</ul>
						</div>
				    </div>
				    <?php
				    } ?>
				    <?php
				    if(isset($_GET['team_no'])) {
						$team_no = $_GET['team_no'];
						$query_team_detail = "SELECT * FROM team WHERE team_no = '$team_no'";
						$result_team_detail = $mysqli->query($query_team_detail);
						$row_team_detail = $result_team_detail->fetch_assoc();
						$reader_no = $row_team_detail['reader_no'];
						$team_name = $row_team_detail['team_name'];
						$team_description = $row_team_detail['team_description'];
						$team_img = $row_team_detail['team_img'];
						$datetime = $row_team_detail['datetime'];
						$new_add = "<p class=\"text-right\"><button type=\"submit\" class=\"btn btn-warning\" onclick=\"location.href='user_fm_team_info.php'\">新しいチームを作成する</button></p>";
					} ?>
					<?php
					if(!empty($_GET['team_no'])){ ?>
					 <div class="pall-10">
					     <h2 id="top"><?php echo "（{$team_name}）"; ?>のチーム情報</h2>
					     <p class="caution"></p>
					     <?php if(isset($_GET['team_no'])) { echo $new_add; } ?>
					  <form class="form" method="post" enctype="multipart/form-data">
					    <div class="form-group">
					  	<label for=" introduction" class="control-label">チーム名</label>
					      <label class="sr-only" for="team_name"><?php if(isset($_GET['team_no'])) { echo $team_name; } ?></label>
					      <input type="text" class="form-control" placeholder="チーム名" id="team_name" name="team_name" value="<?php if(isset($_GET['team_no'])) { echo $team_name; } ?>">
					      <?php if(isset($team_name_error)) { echo $team_name_error; }?>
					    </div>
					    <div class="form-group">
					  	<label for=" introduction" class="control-label">チームアイコン</label>
					      <img src="upload/re_<?php echo $team_img; ?>" alt="" class="img-responsive"><br />
					  	<input type="file" name="img" value="" /><br>
					  	<input type="hidden" name="width" value="1200"/>
					      <?php //if(isset($team_img_error)) { echo $team_img_error; }?>
					    </div>
					    <div class="form-group">
					  	<label for="team_description" class="control-label">チーム紹介文</label>
					    <textarea name="team_description" id="team_description" cols="45" rows="8" placeholder="チームの紹介文を書いてください" class="form-control"><?php if(isset($_GET['team_no'])) { echo $team_description; } ?></textarea>
					           <?php if(isset($team_description_error)) { echo $team_description_error; }?>
					           <!-- 注意書きは以下 -->
					           <p class="help-block">※1200文字以内で書いてください</p>
					       </div>
					  	<button type="submit" class="btn btn-primary btn-lg btn-block" name="<?php if(isset($_GET['team_no'])) { echo "modify"; } else { echo "add"; } ?>" id="<?php if(isset($_GET['team_no'])) { echo "modify"; } else { echo "add"; }?>"> <?php if(isset($_GET['team_no'])) { echo"修正する"; } else { echo"作成する"; } ?></button>
					  	<input type="hidden" value="<?php if(isset($_GET['team_no'])) { echo $team_no; } else {echo ($team_id+1000); } ?>" name="team_no" id="team_no">
					  	<input type="hidden" value="<?php if(isset($_GET['team_no'])) { echo $team_img; } ?>" name="team_img" id="team_img">
					  	<input type="hidden" value="check" name="check" id="check">
					  </form>
					 </div>
					 <?php
					 } ?>
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