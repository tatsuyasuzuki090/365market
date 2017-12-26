<?php
session_start();
include_once './dbconnect.php';

if( isset($_SESSION['user']) != "") {
$query = "SELECT * FROM user INNER JOIN prof ON user.no = prof.no WHERE user.no = ".$_SESSION['user']."";	
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

// データベースの切断
$result->close();
}

//記事リスト表示
$post_list_query = "SELECT post.id AS post_id,post_category.id AS post_category_id,post.*,post_category.* FROM post INNER JOIN post_category ON post.category = post_category.id WHERE post.post_status = 0 ORDER BY post.datetime DESC";

//案件リスト表示
$project_list_query = "SELECT project.id AS project_id,project_category.id AS project_category_id,project.*,project_category.* FROM project INNER JOIN project_category ON project.category = project_category.id WHERE project.status = 0 ORDER BY project.datetime DESC";	


// カレンダー表示
// カレンダーの年月をタイムスタンプを使って指定
if (isset($_GET["date"]) && $_GET["date"] != "") {
	$date_timestamp = $_GET["date"];
} else {
	$date_timestamp = time();
}
$month = date("m", $date_timestamp);
$year = date("Y", $date_timestamp);

$first_date =  mktime(0, 0, 0, $month, 1, $year);
$last_date = mktime(0, 0, 0, $month + 1, 0, $year);

// 最初の日と最後の日の｢日にち」の部分だけ数字で取り出す。
$first_day = date("j", $first_date);
$last_day = date("j", $last_date);

// 全ての日の曜日を得る。
for($day = $first_day; $day <= $last_day; $day++) {
	$day_timestamp = mktime(0, 0, 0, $month, $day, $year);
	$week[$day] = date("w", $day_timestamp);
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

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">
    
    <title>タイトル</title>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



    
  </head>
  <body>
  <!-- プログレスバー -->
  <div class="progressbar"></div>
 
  <!--上部へ戻る-->
  <p id="page-top"><a href="#wrap">PAGE<br />TOP</a></p>
	  
	<!--マイページメニュー-->
	<?php 
	include('mypage_menu.php');?>
	<!--マイページメニュー-->
  
  
	<div class="wrapper">
		<!--ヘッダー-->
		<?php 
		include('header.php');?>
		<!--ヘッダー-->
		<div id="main-content" class="">
		    <section id="topimg" class="text-center">
		  	  <div class="clearfix">
		  		  <div class="col-md-6">
		  			  <!-- Swiper -->
		  			  <div class="swiper-container">
		  			    <div class="swiper-wrapper">
		  			      <div class="swiper-slide alpha"><a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a></div>
		  			      <div class="swiper-slide alpha"><a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a></div>
		  			      <div class="swiper-slide alpha"><a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a></div>
		  			      <div class="swiper-slide alpha"><a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a></div>
		  			      <div class="swiper-slide alpha"><a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a></div>
		  			      <div class="swiper-slide alpha"><a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a></div>
		  			    </div>
		  			    <!-- Add Pagination -->
		  			    <div class="swiper-pagination"></div>
		  			    <!-- Add Arrows -->
		  			    <div class="swiper-button-next"></div>
		  			    <div class="swiper-button-prev"></div>
		  			  </div>
		  		  </div>
		  		  <div class="col-md-6">
		  			  <div class="col-xs-6">
		  				  <div class="panel_top alpha">
		  				  <a href="post_detail.php" title="イベントをさがす"><img src="image/banner_post.png" alt="" class="img-responsive"></a>
		  				  <!--<p class="panel_category"><span>やさヲタ</span></p>-->
		  				  </div>
		  			  </div>
		  			  <div class="col-xs-6">
		  				  <div class="panel_top alpha">
		  				  <a href="post_detail.php" title="イベントをさがす"><img src="image/banner_project.png" alt="" class="img-responsive"></a>
		  				  </div>
		  			  </div>
		  		  </div>
		  		  <div class="col-md-6">
		  			  <div class="col-xs-6">
		  				  <div class="panel_top alpha">
		  				  <a href="post_detail.php" title="イベントをさがす"><img src="image/banner_event.png" alt="" class="img-responsive"></a>
		  				  </div>
		  			  </div>
		  			  <div class="col-xs-6">
		  				  <div class="panel_top alpha">
		  				  <a href="post_detail.php" title="イベントをさがす"><img src="image/banner_fm.png" alt="" class="img-responsive"></a>
		  				  </div>
		  			  </div>
		  		  </div>
		  	  </div>
		    </section>
		    <section id="new_post">
			    <div class="container">
				    <div class="col-xs-12 col-sm-9">
					    <div class="col-xs-12">
			  			  <h1>新着の記事</h1>
			  			  <?php
			  			  $post_list_result = $mysqli->query($post_list_query);
			  			  
			  			  $count = 1;
			  			  while(($post_list_row = $post_list_result->fetch_assoc())&&($count <= 5)){
			  			  	$post_no = $post_list_row['post_id'];
			  			  	$post_title = $post_list_row['title'];
			  			  	
			  			  	$post_title = mb_substr($post_title, 0, 18, 'utf-8'); //全角文字で先頭から50文字取得
				  		      if(mb_strlen($post_title, 'utf-8') > '17') { //18文字より多い場合は「...」を追加
				  		      $post_title .= '…';
				  		      }
		  		      
		  		      
			  			  	$post_category_name = $post_list_row['name'];
			  			  	$post_category_id = $post_list_row['category'];
			  			  	$post_thumbnail = $post_list_row['thumbnail'];
			  			  	$post_datetime = $post_list_row['datetime'];
			  			  	$post_datetime = date_a($post_datetime);
			  			  	$post_datetime2 = $post_list_row['datetime'];
			  			  	
			  			  	$post_post_status = $post_list_row['post_status'];
			  			  	//post_status
			  			  	//0:公開
			  			  	//1:下書き
			  			  	//2:投稿予約
			  			  	if(($count == 1 )OR($count == 3 )){echo ("<div class=\"row\">");}
			  			  	
			  			  	if(($count <= 2 )){
			  			  ?>
			  			  <div class="col-xs-6 col-sm-6 mb20">
			  				  <div class="mall-05 alpha">
			  				  <a href="<?php echo $url; ?>/post_detail.php?post_no=<?php echo $post_no; ?>" title="<?php echo $post_title; ?>"><img src="<?php echo $url; ?>/upload/<?php echo $post_thumbnail; ?>" alt="<?php echo $post_title; ?>" class="img-responsive">
			  				  <?php
			  				  if($post_datetime2 >= date('Y-m-d H:i:s', strtotime('-7 day', time()))){ ?>
			  				  <span class="new" data-reactid=".2b02jlazx1c.0.0.2">NEW</span>
			  				  <?php
			  				  } ?>
			  				  </a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="<?php echo $post_category_name; ?>"><?php echo $post_category_name; ?></a></span>
			  				  <h2><?php echo $post_title; ?></h2>
			  				  <p>今回の野菜オタクノートは、ピリリッと辛みの今回の野菜オタクノートは、ピリリッと辛みのあるショウガ.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo $post_datetime; ?></span></p>
			  				  </div>
			  			  </div>
			  			  <?php
			  			  if(($count == 2 )){echo ("</div>");} ?>
				  			  <?php
				  			  } else { ?>
				  			  <div class="col-xs-6 col-sm-4 mb20">
				  				  <div class="mall-05 alpha">
				  				  <a href="<?php echo $url; ?>/post_detail.php?post_no=<?php echo $post_no; ?>" title="<?php echo $post_title; ?>"><img src="<?php echo $url; ?>/upload/<?php echo $post_thumbnail; ?>" alt="" class="img-responsive">
				  				  <?php
				  				  if($post_datetime2 >= date('Y-m-d H:i:s', strtotime('-7 day', time()))){ ?>
				  				  <span class="new" data-reactid="">NEW</span>
				  				  <?php
				  				  } ?>
				  				  </a>
				  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="<?php echo $post_category_name; ?>"><?php echo $post_category_name; ?></a></span>
				  				  <h2><?php echo $post_title; ?></h2>
				  				  <p>毎週月曜の昼12時に更新している人気コンテンツ「野菜オタクNOTE」 .....</p>
				  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo $post_datetime; ?><?php echo $count; ?></span></p>
				  				  </div>
				  			  </div>
				  			  <?php
				  			  if(($count == 5 )){echo ("</div>");} 
				  			  }
			  			  $count++;
			  			  }
			  			  ?>

					    </div>
					    <div class="col-xs-12 mb30">
						    <a href="post.php" title="イベントをさがす"><img src="image/banner_post_link.png" alt="" class="img-responsive"></a>
					    </div>
					    
					    <div class="col-xs-12">
						    <h1>新着のお仕事</h1>
						    <?php
			  			  $project_list_result = $mysqli->query($project_list_query);
			  			  $count = 1;
			  			  while(($project_list_row = $project_list_result->fetch_assoc())&&($count <= 5)){
			  			  	$project_no = $project_list_row['project_no'];
			  			  	$project_title = $project_list_row['title'];
			  			  	
			  			  	$project_title = mb_substr($project_title, 0, 18, 'utf-8'); //全角文字で先頭から50文字取得
				  		      if(mb_strlen($project_title, 'utf-8') > '17') { //18文字より多い場合は「...」を追加
				  		      $project_title .= '…';
				  		      }
		  		      
		  		      
			  			  	$project_category_name = $project_list_row['name'];
			  			  	$project_category_id = $project_list_row['project_category_id'];
			  			  	$project_thumbnail = $project_list_row['main_img_path'];
			  			  	$project_datetime = $project_list_row['datetime'];
			  			  	$project_datetime = date_a($project_datetime);
			  			  	$project_datetime2 = $project_list_row['datetime'];
			  			  	
			  			  	$project_status = $project_list_row['status'];
			  			  	//project_status
			  			  	//0:公開
			  			  	//1:下書き
			  			  	//2:投稿予約
			  			  	if(($count == 1 )OR($count == 3 )){echo ("<div class=\"row\">");}
			  			  	
			  			  	if(($count <= 2 )){
			  			  ?>
			  			  <div class="col-xs-6 col-sm-6 mb20">
				  			  
			  				  <div class="mall-05 alpha">
				  				  
			  				  <a href="<?php echo $url; ?>/project_detail.php?project_no=<?php echo $project_no; ?>" title="<?php echo $project_title; ?>">
			  				  <div class="img_height_index_l">
			  				  <img src="<?php echo $url; ?>/upload/re_<?php echo $project_thumbnail; ?>" alt="<?php echo $project_title; ?>" class="img-responsive">
			  				  </div>
			  				  <?php
			  				  if($project_datetime2 >= date('Y-m-d H:i:s', strtotime('-7 day', time()))){ ?>
			  				  <span class="new" data-reactid=".2b02jlazx1c.0.0.2">NEW</span>
			  				  <?php
			  				  } ?>
			  				  </a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="<?php echo $project_category_name; ?>"><?php echo $project_category_name; ?></a></span>
			  				  <h2><?php echo $project_title; ?></h2>
			  				  <p>今回の野菜オタクノートは、ピリリッと辛みの今回の野菜オタクノートは、ピリリッと辛みのあるショウガ.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo $project_datetime; ?><?php echo $count; ?></span></p>
			  				  </div>
				  			  
			  			  </div>
			  			  <?php
			  			  if(($count == 2 )){echo ("</div>");} ?>
				  			  <?php
				  			  } else { ?>
				  			  <div class="col-xs-6 col-sm-4 mb20">
				  				  <div class="mall-05 alpha">
				  				  <a href="<?php echo $url; ?>/project_detail.php?project_no=<?php echo $project_no; ?>" title="<?php echo $project_title; ?>">
				  				  <div class="img_height_index_s">
				  				  <img src="<?php echo $url; ?>/upload/re_<?php echo $project_thumbnail; ?>" alt="" class="img-responsive">
				  				  </div>
				  				  <?php
				  				  if($project_datetime2 >= date('Y-m-d H:i:s', strtotime('-7 day', time()))){ ?>
				  				  <span class="new" data-reactid="">NEW</span>
				  				  <?php
				  				  } ?>
				  				  </a>
				  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="<?php echo $project_category_name; ?>"><?php echo $project_category_name; ?></a></span>
				  				  <h2><?php echo $project_title; ?></h2>
				  				  <p>毎週月曜の昼12時に更新している人気コンテンツ「野菜オタクNOTE」 .....</p>
				  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo $project_datetime; ?><?php echo $count; ?></span></p>
				  				  </div>
				  			  </div>
				  			  <?php
				  			  if(($count == 5 )){echo ("</div>");} 
				  			  }
			  			  $count++;
			  			  }
			  			  ?>

					    </div>
					    <div class="col-xs-12 mb30">
						    <a href="project.php" title="イベントをさがす"><img src="image/banner_project_link.png" alt="" class="img-responsive"></a>
					    </div>
					    <div class="col-xs-12">
						    <h1>アクセスランキング</h1>
						    <div class="col-xs-6 col-sm-3">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
			  				  <span class="category-label_s"><a class="item_s" href="/category/item" data-id="home" data-label="ITEM">野菜マルシェ</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-3">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
			  				  <span class="category-label_s"><a class="item_s" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-3">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
			  				  <span class="category-label_s"><a class="item_s" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-3">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
			  				  <span class="category-label_s"><a class="item_s" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
					    </div>
					    <div class="col-xs-6">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="image/bannar_1.png" alt="" class="img-responsive"></a>
			  				  </div>
					    </div>
					    <div class="col-xs-6">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="image/bannar_1.png" alt="" class="img-responsive"></a>
			  				  </div>
					    </div>
					    
					    
				    </div>
				    
				    <div class="col-xs-12 col-sm-3">
					    <div id="event_cal">
						    <h1>イベント</h1>
							<table border="1"> 
							 <tr> 
							  <th class="pink_l" colspan="2"><a href="index.php?date= 
							<?php print(strtotime("-1 month", $first_date)); ?>" class="monthnext"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>前月</a></th> 
							  <th class="pink" colspan="3"><?php print(/* date("Y", $date_timestamp) . "年" . */ date("n", $date_timestamp)  . "月"); ?></th> 
							  <th class="pink_r" colspan="2"><a href="index.php?date= 
							<?php print(strtotime("+1 month", $first_date)); ?>"class="monthnext">次月<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></th> 
							 </tr> 
							 <tr>
								<th class="pink_u">日</th>  
								<th class="gray">月</th> 
								<th class="gray">火</th> 
								<th class="gray">水</th> 
								<th class="gray">木</th> 
								<th class="gray">金</th> 
								<th class="blue">土</th>
							  
							 </tr> 
							 <tr> 
							  <?php 
							  // カレンダーの最初の空白部分 
							  for ($i = 0; $i < $week[$first_day]; $i++) { 
							   print("<td class=\"gray_u\"></td>\n"); 
							  } 
							  $filename = "samplefile.txt"; 
							  $schedule_list = file($filename); 
							  for ($day = $first_day; $day <= $last_day; $day++) { 
							   if ($week[$day] == 0) { 
							    print("</tr>\n<tr>\n"); 
							   } 
							   // スケジュールが存在するかどうかチェックする  
							   $exist_schedule = false;  
							   foreach ($schedule_list as $lineno => $line) { 
							    list($schedule_date, $title, $body, $schedule_id, $tag) = explode("|", $line); 
							    if ($schedule_date == $year . $month . sprintf("%02d", $day)) { 
							     $exist_schedule = true; 
							     break; 
							    } 
							   } 
							   /* // スケジュールが存在したらリンクをつける 
							   if ($exist_schedule) { 
							    print("<td><a href=\"schedule_list.php?year=" .$year .  
							"&month=". $month . "&day=$day\">$day</a></td>\n"); 
							   } else { 
							    print("<td>$day</td>\n"); 
							   } 
							  }  */
							  // スケジュールが存在したらリンクをつける
							  if ($exist_schedule) {
							  	if (($year == date("Y")) && ($month == date("n")) && ($day == date("j"))) {
							  		//現在の日付の場合
							  		//print("<td class =\"today\"><a href=\"schedule_list.php?year=" .$year . "&month=". $month . "&day=$day\">$day</a><br/>");
							  		print("<td class =\"today\">$day<br/>");
							  	} else {
							  		//現在の日付ではない場合
							  		//print("<td><a href=\"schedule_list.php?year=" .$year . "&month=". $month . "&day=$day\">$day</a><br/>");
							  		print("<td>$day<br/><a href=\"event.php?day=$day\">○</a>");
							  	}
							  	//カレンダー内に詳細表示
							  	foreach ($schedule_list as $lineno => $line) {
							  		list($schedule_date, $title, $event_title, $schedule_id, $tag) = explode("|", $line);
							  		if ($schedule_date == date("Ymd", mktime(0, 0, 0, $month, $day, $year))) {
							  			//print("<a href=\"event.php?day=$day#event_day\">○</a>");
							  			//print("<div class=\"\"><a data-toggle=\"tooltip\" data-placement=\"top\" title=\"$body\" href=\"event_detail.php?event_id=$schedule_id\"><span class=\"label $tag\">$title</span></a></div>");
							  			//print("<div class=\"\"><a data-toggle=\"tooltip\" data-placement=\"top\" title=\"$body\" href=\"event_detail.php?event_id=$schedule_id\"><span class=\"label $tag\">$title</span></a></div>");
							  		}
							  	}
							  	print("</td>");
							  } else {
							  	print("<td>$day</td>\n");
							  }
							  }
							  // カレンダーの最後の空白部分 
							  for ($i = $week[$last_day] + 1; $i < 7; $i++) { 
							   print ("<td class=\"gray_u\"></td>\n"); 
							  } 
							  ?> 
							 </tr> 
							</table>
							<h1>本日のイベント</h1>
							<div class="col-xs-6 col-sm-12 alpha">
								<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
								<h2>店舗名店舗名</h2>
								<p>イベント名イベント名</p>
								<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
							</div>
							<div class="col-xs-6 col-sm-12 alpha">
								<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
								<h2>店舗名店舗名</h2>
								<p>イベント名イベント名</p>
								<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
							</div>
							<div class="col-xs-6 col-sm-12 alpha">
								<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
								<h2>店舗名店舗名</h2>
								<p>イベント名イベント名</p>
								<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
							</div>
							<div class="col-xs-6 col-sm-12 alpha">
								<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
								<h2>店舗名店舗名</h2>
								<p>イベント名イベント名</p>
								<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
							</div>
							<div class="col-xs-6 col-sm-12 alpha">
								<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
								<h2>店舗名店舗名</h2>
								<p>イベント名イベント名</p>
								<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
							</div>
							<div class="col-xs-6 col-sm-12 alpha">
								<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
								<h2>店舗名店舗名</h2>
								<p>イベント名イベント名</p>
								<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
							</div>
					    </div>
					    
				    </div>
			    </div>
		    </section>
		    <section id="history">
			    <div class="container-fluid">
				    <h1>閲覧履歴</h1>
				    
		
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
		
				    
				    
				    
					echo '<div class="col-xs-6 col-sm-3  col-md-2 alpha">
						<div class="pall-10">
						<a href="'.$history_url[$i].'" title="イベントをさがす"><img src="'.$url.'/upload/re_'.$data_project_img[$i].'" alt="'.$data_project_title[$i].'" class="img-responsive"></a>
						<h2>'.$data_project_title[$i].'</h2>
						<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
						</div>
					</div>',"\n";
$i++;
	
	}

	}else{
	echo '<p>過去に見たページはありません。</p>';
	}
	
?>	    
    
    
    
    
    
    
			    </div>
		    </section>
		    <section id="news">
			    <div class="container-fluid">
				    <div class="col-xs-12 col-sm-6">
					    <div class="pall-10">
					    <h2>NEWS</h2>
					    <dl>
						    <dt><span class="label label-danger">お知らせ</span> 2017年12月25日</dt>
						    <dd>ニュースニュースニュースニュースニュースニュースニュースニュースニュース<a href="post_detail.php" title="イベントをさがす">ニュース</a></dd>
						    <dt><span class="label label-warning">募　　集</span> 2017年12月25日</dt>
						    <dd>ニュースニュースニュースニュースニュースニュースニュースニュースニュースニュース</dd>
						    <dt><span class="label label-danger">お知らせ</span> 2017年12月25日</dt>
						    <dd>ニュースニュースニュースニュースニュースニュースニュースニュースニュースニュース</dd>
					    </dl>
				    </div>
				    </div>
				    <div class="col-xs-12 col-sm-6">
					    <div class="pall-10">
					    <h2>EVENT</h2>
					    <dl>
						    <dt><span class="label label-success">P　　R</span> 2017年12月25日</dt>
						    <dd>ニュースニュースニュースニュースニュースニュースニュースニュースニュースニュース</dd>
						    <dt><span class="label label-primary">レポート</span> 2017年12月25日</dt>
						    <dd>ニュースニュースニュースニュースニュースニュースニュースニュースニュースニュース</dd>
						    <dt><span class="label label-success">P　　R</span> 2017年12月25日</dt>
						    <dd>ニュースニュースニュースニュースニュースニュースニュースニュースニュースニュース</dd>
					    </dl>
					    </div>
				    </div>
			    </div>
		    </section>
		    
<!--
		    <section id="new_article">
		  	  <div class="container-fluid">
		  		  <div class="container">
		  			  <div class="col-xs-12 col-sm-8">
		  				  <div class="mall-05 alpha">
		  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
		  				  <h2>白菜の糖度実験！真ん中部分が甘いってホント？！</h2>
		  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるため。そしてある仮説をたて、ヤサオタはここを深堀をしてゆく。</p>
		  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
		  				  </div>
		  			  </div>
		  			  <div class="col-xs-12 col-sm-4">
		  				  <div class="mall-05 bglocor_gray cf heightcc">
		  					  <div class="mall-10 cf">
		  						  <div class="col-xs-6 col-sm-12 alpha">
		  							  <a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
		  							  <h2>白菜の糖度実験！真ん中部分が甘いってホント？！</h2>
		  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるため。そしてある仮説をたて、ヤサオタはここを深堀をしてゆく。</p>
		  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
		  						  </div>
		  					  </div>
		  					  <div class="mall-10 cf">
		  						  <div class="col-xs-6 col-sm-12 alpha">
		  							  <a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
		  						  </div>
		  					  </div>
		  				  </div>
		  			  </div>
		  		  </div>
		  	  </div>
		    </section>
-->
		    
		    
		    
		    
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
	  
	<!-- jQueryより先に記載 -->
	<!-- Swiper JS -->
	<script src="js/swiper.min.js"></script>
  	<!-- Initialize Swiper -->
	<script>
	var mySwiper = new Swiper ('.swiper-container', {
	  loop: true,
	  slidesPerView: 1,
	  spaceBetween: 0,
	  centeredSlides : true,
	  paginationClickable : true,
	  autoplay: 4000,
	  pagination: '.swiper-pagination',
	  nextButton: '.swiper-button-next',
	  prevButton: '.swiper-button-prev',
	  breakpoints: {
	    767: {
	      slidesPerView: 1,
	      spaceBetween: 0
	    }
	  }
	})
	</script>
	
	<!--jquery-->
	<?php 
	include('jquery.php');?>
    <!--jquery--> 	

  </body>
</html>