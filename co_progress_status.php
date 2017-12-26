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
$query_project_list = "SELECT project.project_no AS p_project_no, project_apply.project_no AS pa_project_no, project.*, project_apply.* FROM project INNER JOIN project_apply ON project.project_no = project_apply.project_no WHERE project.no = ".$_SESSION['user']." GROUP BY project_apply.project_no";	
$result_project_list = $mysqli->query($query_project_list);

if(isset($_GET['project_no'])){
	$project_no = $_GET['project_no'];
	$query_project_apply_list = "SELECT project.project_no AS p_project_no, project_apply.project_no AS pa_project_no, project.*, project_apply.* FROM project INNER JOIN project_apply ON project.project_no = project_apply.project_no WHERE project.project_no = '$project_no' AND project_apply.apply_status BETWEEN 0 AND 10 ";	
	$result_project_apply_list = $mysqli->query($query_project_apply_list);
	
} else {}

//ステータスの変更
if(isset($_GET['project_no_status']) AND isset($_GET['apply_status']) AND isset($_GET['fm_no']) ) {
	$apply_status = $_GET['apply_status'];
	$project_no_status = $_GET['project_no_status'];
	$project_fm_no = $_GET['fm_no'];
	//案件ステータス（apply_status）
	//0:新規応募
	//1:決定
	//2:キャンセル
	//3:辞退
	//4:現場入り完了
	//5:仕事完了
	//6:完了承認
	//7:決済待ち
	//8:決済完了
	//9:入金完了
	//10:支払い完了	
	switch ($apply_status) {
	case '0':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  break;
	case '1':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス1。\n$url","ステータス1。\n$url",'0');
	  break;
	case '2':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス2。\n$url","ステータス2。\n$url",'0');
	  break;
	case '3':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス3。\n$url","ステータス3。\n$url",'0');
	  break;
	case '4':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス4。\n$url","ステータス4。\n$url",'0');
	  break;
	case '5':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス5。\n$url","ステータス5。\n$url",'0');
	  break;
	case '6':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス6。\n$url","ステータス6。\n$url",'0');
	  break;
	case '7':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス7。\n$url","ステータス7。\n$url",'0');
	  break;
	case '8':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス8。\n$url","ステータス8。\n$url",'0');
	  break;
	case '9':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス9。\n$url","ステータス9。\n$url",'0');
	  break;
	case '10':
	  $query_project_apply_status_update = "UPDATE project_apply SET apply_status = '$apply_status' WHERE project_no = '$project_no_status' AND fm_no = '$project_fm_no'";
	  $result_project_apply_status_update = $mysqli->query($query_project_apply_status_update);
	  //メール送信　最後の数字flag 0：両方送信　1：片方送信
	  mail_send('suzuki@vacavo.co.jp','suzuki@vacavo.co.jp','test@365market.jp','【ステータス変更】365market','【ステータス変更】365market',"ステータス10。\n$url","ステータス10。\n$url",'0');
	  break;
	  }
	  header("Location: co_progress_status.php?project_no=$project_no_status");
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
							    <li><a href="co_progress_list.php">案件一覧<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							    <li><a href="co_progress_status.php" class="active">応募状況<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						    </ul>
					    </div>
				    </div>
				    <div class="col-xs-12 col-sm-9">
					    <div class="pall-10">
						    <h2 id="top">応募状況</h2>
						    <div class="col-sm-12 mb20">
							    <div class="dropdown">
									  <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    応募状況を見たい案件を選択してください。
									    <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										<?php
										while( $row_project_list = $result_project_list->fetch_assoc()) {
											$project_title = $row_project_list['title'];
											$project_no = $row_project_list['p_project_no']; ?>
									    <li><a href="co_progress_status.php?project_no=<?php echo $project_no; ?>"><?php echo $project_title; ?><?php echo $project_no; ?></a></li>
									    <?php
									    } ?>
									  </ul>
									</div>
							    </div>
							    <?php
								if(isset($_GET['project_no'])){
								$result_project_apply_list = $mysqli->query($query_project_apply_list);
								$row_project_list = $result_project_apply_list->fetch_assoc();
								$project_title = $row_project_list['title'];
								?>
							    <div class="col-sm-12 mb05 color-green3">
								    <p class="text-center"><?php echo $project_title; ?></p>
							    </div>
							    <?php
								} else {}
								?>
							    <p class="caution"></p>
							    <form method="post">
								    <table class="user_apply_table">
									    <tr class="sp-none480">
					  						<td>修正</td>
					  						<td>　　　</td>
					  						<th>案件名</th>
					  						<td>状態</td>
					  						<td class="bnone">操作</td>
					  					</tr>
					  					<?php
										if(isset($_GET['project_no'])){
											$result_project_apply_list = $mysqli->query($query_project_apply_list);
											while( $row_project_apply_list = $result_project_apply_list->fetch_assoc()) {
												$apply_name = $row_project_apply_list['apply_name'];
												$apply_status = $row_project_apply_list['apply_status'];
												$apply_title = $row_project_apply_list['title'];
												$project_no = $row_project_apply_list['project_no'];
												$project_fm_no = $row_project_apply_list['fm_no']; ?>
												<tr>
													<td><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
													<td><img src="upload/<?php echo $img_sub_prof_path; ?>" alt="" class="img-responsive img-circle" width="40px"></td>
													<th><?php echo $apply_name; ?><br /><?php echo $apply_title; ?></th>
													<td><?php apply_status($apply_status) ?></td>
													<td class="bnone">
														<div class="dropdown">
														  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														    操作
														    <span class="caret"></span>
														  </button>
														  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
														    <li><a href="co_progress_status.php?apply_status=0&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">新規応募</a></li>
														    <li><a href="co_progress_status.php?apply_status=1&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">決定</a></li>
														    <li><a href="co_progress_status.php?apply_status=2&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">キャンセル</a></li>
														    <li><a href="co_progress_status.php?apply_status=3&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">辞退</a></li>
														    <li><a href="co_progress_status.php?apply_status=4&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">現場入り完了</a></li>
														    <li><a href="co_progress_status.php?apply_status=5&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">仕事完了</a></li>
														    <li><a href="co_progress_status.php?apply_status=6&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">完了承認</a></li>
														    <li><a href="co_progress_status.php?apply_status=7&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">決済待ち</a></li>
														    <li><a href="co_progress_status.php?apply_status=8&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">決済完了</a></li>
														    <li><a href="co_progress_status.php?apply_status=9&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">入金完了</a></li>
														    <li><a href="co_progress_status.php?apply_status=10&project_no_status=<?php echo $project_no; ?>&fm_no=<?php echo $project_fm_no; ?>">支払い完了</a></li>
														  </ul>
														</div>
													</td>
												</tr>
											<?php
											} ?>
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