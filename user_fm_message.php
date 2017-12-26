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





if(isset($_GET['transmit_no'])){
	$transmit_no = $_GET['transmit_no'];
	$query_message_main_transmit = "SELECT * FROM message INNER JOIN user ON message.transmit_no = user.no INNER JOIN co ON user.no = co.no  WHERE  ((message.receive_no = ".$_SESSION['user']." AND message.transmit_no = '$transmit_no') OR (message.receive_no = '$transmit_no' AND message.transmit_no = ".$_SESSION['user'].")) ORDER BY datetime ASC";	
	$result_message_main_transmit = $mysqli->query($query_message_main_transmit);
	
	$row_message_main_transmit = $result_message_main_transmit->fetch_assoc();
	$message_receive_company_name = $row_message_main_transmit['company_name'];
	}
}

if(isset($_POST['message'])) {
	if(isset($_POST['message'])) { $message = $_POST['message']; }	
		$datetime_now = date("Y-m-d H:i:s");
		$query_message_in = "INSERT INTO message (receive_mode, receive_no, transmit_mode, transmit_no, message_text, team_no, datetime) VALUES (2, '$transmit_no', 1, '$no', '$message', 1, '$datetime_now')";
		$result_message_in = $mysqli->query($query_message_in);
		header("Location:user_fm_message.php?transmit_no={$transmit_no} ");
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
						    <h2 id="top">メッセージ</h2>
						    <p class="caution"></p>

						    <table class="user_team_table table-mt20mb20">
			  					<tr>
			  						<th><?php echo $message_receive_company_name; ?></th>
			  						<td class="cf">
				  						
				  						<?php
										if(isset($_GET['transmit_no'])){
											$result_message_main_transmit = $mysqli->query($query_message_main_transmit);
											while($row_message_main_transmit = $result_message_main_transmit->fetch_assoc()){
												$message_message_transmit_text = $row_message_main_transmit["message_text"];
												$message_message_transmit_no = $row_message_main_transmit["transmit_no"];
												$message_message_receive_no = $row_message_main_transmit["receive_no"];
												$message_message_datetime = $row_message_main_transmit["datetime"];
												$message_message_datetime = date("Y年m月d日",strtotime($message_message_datetime));
												$message_receive_company_name = $row_message_main_transmit['company_name']; ?>
				  						
				  						
										<div class="row cf">
											
											<?php
											if($message_message_transmit_no == $_SESSION['user']) { ?>
											
											<div class="col-xs-11 pull-right">
											<?php
											}
											if($message_message_receive_no == $_SESSION['user']) { ?>											
											<div class="col-xs-1">
												<a href="fm_prof_view.php?no=9"><img src="upload/20171027163317fm_sub_prof.png" class="img-circle center-block" style="max-width:50px"></a>
											</div>
											<div class="col-xs-11">
											<?php
											} ?>	
												<p><?php echo nl2br($message_message_transmit_text); ?></p>
												<p><span class="fs80 pull-right mt10"><?php echo $message_message_datetime; ?></span></p>
												<hr />
											</div>
											
											
										</div>
												
												<?php
					} ?>
					
					
				<?php	
				} ?>
											
										
										
										
										
										
										
										
										
										
										
<!--
										<div class="row">
											<div class="col-xs-12 cf pull-right">
												<p>コメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメコメ</p>
												<p><span class="fs80 pull-right mt10">2017.12.20 12:02 <span class="label label-warning">既読</span></span></p>
											</div>
										</div>

										<hr />
-->
										
										
									</td>

			  					</tr>
			  				</table>
			  				
			  				

					    </div>
					    <div class="col-xs-12">
						    <form method="post">
							  	<div class="col-xs-12">
									<textarea class="form-control input-sm form-group" rows="10" id="message" placeholder="返信メッセージを入力してください。" name="message" value=""></textarea>
									<button type="submit" class="btn btn-success btn-block" name="message_submit">送信する <span class="glyphicon glyphicon-chevron-right"></span></button>
								</div>
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