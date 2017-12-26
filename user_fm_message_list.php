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


$query_message_main = "SELECT * FROM message INNER JOIN user ON message.transmit_no = user.no INNER JOIN co ON user.no = co.no WHERE receive_no = ".$_SESSION['user']." GROUP BY message.transmit_no  ORDER BY datetime ASC";	
$result_message_main = $mysqli->query($query_message_main);

if(isset($_GET['transmit_no'])){
	$transmit_no = $_GET['transmit_no'];
	$query_message_main_transmit = "SELECT * FROM message INNER JOIN user ON message.transmit_no = user.no INNER JOIN co ON user.no = co.no  WHERE  ((message.receive_no = ".$_SESSION['user']." AND message.transmit_no = '$transmit_no') OR (message.receive_no = '$transmit_no' AND message.transmit_no = ".$_SESSION['user'].")) ORDER BY datetime ASC";	
	$result_message_main_transmit = $mysqli->query($query_message_main_transmit);
	}
}

if(isset($_POST['message'])) {
	if(isset($_POST['message'])) { $message = $_POST['message']; }	
		$datetime_now = date("Y-m-d H:i:s");
		$query_message_in = "INSERT INTO message (receive_mode, receive_no, transmit_mode, transmit_no, message_text, team_no, datetime) VALUES (2, '$transmit_no', 1, '$no', '$message', 1, '$datetime_now')";
		$result_message_in = $mysqli->query($query_message_in);
		header("Location:fm_message.php?transmit_no={$transmit_no} ");
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
			  	       <li><a href="user_fm_message_list.php" class="active"><i class="fa fa-commenting-o" aria-hidden="true"></i> <span class="sp-none">メッセージ</span></a></li>
			  	       <li><a href="user_fm_favorite.php"><i class="fa fa-heart" aria-hidden="true"></i> <span class="sp-none">お気に入りの案件</span></a></li>
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
				    <div class="col-xs-12 col-sm-3 mb30">
					    <div class="pall-10">
						    <ul>
							    <li><a href="user_fm_message_list.php" class="active">メッセージ<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_message.php">チーム内メッセージ<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="user_fm_message.php">クライアントメッセージ<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">メッセージ一覧</h2>
						    <p class="caution"></p>
						    <form class="form-inline" method="post">
								  <div class="form-group">
								    <label class="sr-only" for="team_member">ユーザー名</label>
								    <input type="text" class="form-control ui-autocomplete-input" placeholder="FM名" id="user_auto" name="team_member_add" size="20" autocomplete="off">
								  </div>
								  <button type="submit" class="btn btn-primary">検索する</button>
						   </form>
						   <?php
							while( $row_message_main = $result_message_main->fetch_assoc()) {
								$message_transmit_no = $row_message_main['transmit_no'];
								$message_project_no = $row_message_main['project_no'];
								$message_message_text = $row_message_main["message_text"];
								$message_datetime = $row_message_main['datetime'];
								$message_receive_name = $row_message_main['name'];
								$message_img_sub_prof_path = $row_message_main['img_sub_prof_path'];
								$message_receive_company_name = $row_message_main['company_name'];
								$message_receive_title = $row_message_main['title'];
								$message_receive_mode = $row_message_main['receive_mode'];
								$message_transmit_mode = $row_message_main['transmit_mode'];
							?>

						    <table class="user_team_table table-mt20mb20">
			  					<tr>
			  						<th><a href="user_fm_message.php?transmit_no=<?php echo $message_transmit_no; ?>"><?php echo $message_receive_company_name; ?></a></th>
			  						<td class="cf">
				  						<div class="row">
					  						<div class="col-xs-1">
												<a href="user_fm_message.php?transmit_no=<?php echo $message_transmit_no; ?>"><img src="upload/<?php echo $message_img_sub_prof_path; ?>" class="img-circle center-block" style="max-width:50px"></a>
											</div>
											<div class="col-xs-11 cf">
												<p><?php echo $message_message_text; ?></p>
												<p><span class="fs80 pull-right mt10">2017.12.20 12:02</span></p>
											</div>
										</div>
									</td>
			  					</tr>
			  				</table>
			  				<?php
			}
			?>



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