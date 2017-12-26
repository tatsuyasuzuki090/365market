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

if(isset($_GET['event_id'])){
//イベントリスト表示
$event_id = $_GET['event_id'];
$event_list_query = "SELECT event.id AS event_id,event_category.id AS event_category_id,event.*,event_category.* FROM event INNER JOIN event_category ON event.category_no = event_category.id WHERE event.id = '$event_id' ";	
$event_list_result = $mysqli->query($event_list_query);
$event_list_row = $event_list_result->fetch_assoc();
$event_title = $event_list_row['title'];
$event_address = $event_list_row['address'];
$event_tel = $event_list_row['tel'];
$event_url = $event_list_row['url'];
$event_description = $event_list_row['description'];
$event_date = $event_list_row['event_date'];
$event_category_name = $event_list_row['name'];
}
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

//イベント一覧表示
$event_list_query = "SELECT event.id AS event_id,event_category.id AS event_category_id,event.*,event_category.* FROM event INNER JOIN event_category ON event.category_no = event_category.id ORDER BY event_date";	
$event_list_result = $mysqli->query($event_list_query);

//イベント一覧（今日）表示
$start = date('Y-m-d 00:00:00');
$end = date('Y-m-d 23:59:59');
$event_list_between_query = "SELECT event.id AS event_id,event_category.id AS event_category_id,event.*,event_category.* FROM event INNER JOIN event_category ON event.category_no = event_category.id WHERE event_date BETWEEN '$start' AND '$end' ORDER BY event_date";	
$event_list_between_result = $mysqli->query($event_list_between_query);

//日ごとの案件表示
if(isset($_GET['day'])){
	$day = $_GET['day'];
	$year = date('Y');
	$month = date('m');
	$start = "$year-$month-$day 00:00:00";
	$end = "$year-$month-$day 23:59:59";
	$event_list_between_query = "SELECT event.id AS event_id,event_category.id AS event_category_id,event.*,event_category.* FROM event INNER JOIN event_category ON event.category_no = event_category.id WHERE event_date BETWEEN '$start' AND '$end' ORDER BY event_date";	
	$event_list_between_result = $mysqli->query($event_list_between_query);
}

//ファイルへの書き込み
$fp = fopen("samplefile.txt", "w");
while($event_list_row = $event_list_result->fetch_assoc()){
	$event_id = $event_list_row['event_id'];
	$event_title = $event_list_row['title'];
	$event_address = $event_list_row['address'];
	$event_tel = $event_list_row['tel'];
	$event_url = $event_list_row['url'];
	$event_description = $event_list_row['description'];
	$event_date = $event_list_row['event_date'];
	$event_category_id = $event_list_row['event_category_id']; 
	$event_category_name = $event_list_row['name']; 
	$event_date = date("Ymd",strtotime($event_date));
	if($event_category_id == 1){ $tag = 'label-primary';}
	if($event_category_id == 2){ $tag = 'label-success';}
	if($event_category_id == 3){ $tag = 'label-warning';}
	if($event_category_id == 4){ $tag = 'label-danger';}
	if($event_category_id == 5){ $tag = 'label-info';}
	fwrite($fp, "$event_date|$event_category_name|$event_title|$event_id|$tag"."\r\n");
}
fclose($fp);

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

    <!--イベント詳細モーダル-->
	<!--googlemap　APIkey-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqvkV-DIi9XU_Gxjpatnv6-nN5E9VUltI" type="text/javascript"></script>
	<!--map表示-->
	<script type="text/javascript">
		//COMTOPIA流Google MAP表示方法
		var geocoder = new google.maps.Geocoder();//Geocode APIを使います。
		var address = "<?php echo $event_address; ?>";
		geocoder.geocode({'address': address,'language':'ja'},function(results, status){
			if (status == google.maps.GeocoderStatus.OK){
				var latlng=results[0].geometry.location;//緯度と経度を取得
				var mapOpt = {
	          		center: latlng,//取得した緯度経度を地図の真ん中に設定
	          		zoom: 16,//地図倍率1～20
	          		mapTypeId: google.maps.MapTypeId.ROADMAP//普通の道路マップ
	        	};
				var map = new google.maps.Map(document.getElementById('google_map'),mapOpt);
				var marker = new google.maps.Marker({//住所のポイントにマーカーを立てる
					position: map.getCenter(),
					map: map
				});
			}else{
	        	alert("Geocode was not successful for the following reason: " + status);
	        }
		});
	</script> 
	<!--modal-->
	<?php 
	include('modal.php');?>
    <!--modal--> 
    
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
		<div id="main-content" class="">
		    <section id="topimg" class="text-center">
		  	  <div class="clearfix">
		  		  <div class="col-md-12">
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
		  	  </div>
		    </section>
		    <section id="event_main">
			    <div class="container">
				    
				    <div class="col-xs-12 col-sm-8">
					    <div id="event_cal">
						    <h1>イベントカレンダー</h1>
							<table border="1"> 
							 <tr> 
							  <th class="pink_l" colspan="2"><a href="event.php?date= 
							<?php print(strtotime("-1 month", $first_date)); ?>" class="monthnext"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>前月</a></th> 
							  <th class="pink" colspan="3"><?php print(/* date("Y", $date_timestamp) . "年" . */ date("n", $date_timestamp)  . "月"); ?></th> 
							  <th class="pink_r" colspan="2"><a href="event.php?date= 
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
							  		print("<td class =\"today event_main\"><a href=\"event.php\">$day</a><br/><div class=\"\"><span class=\"label $tag\">●</span></div>");
							  	} else {
							  		//現在の日付ではない場合
							  		//print("<td><a href=\"schedule_list.php?year=" .$year . "&month=". $month . "&day=$day\">$day</a><br/>");
						  		print("<td><a href=\"event.php?day=$day#event_day\">$day</a><br/><div class=\"\"><span class=\"label $tag\">●</span></div>");
							  	}
							  	//カレンダー内に詳細表示
							  	foreach ($schedule_list as $lineno => $line) {
							  		list($schedule_date, $title, $event_title, $schedule_id, $tag) = explode("|", $line);
							  		if ($schedule_date == date("Ymd", mktime(0, 0, 0, $month, $day, $year))) {
							  			//print("<a href=\"schedule_edit.php?lineno=$lineno&mode=edit\"><img src=\"$title\"></a>");
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
							<div class="col-xs-12">
								<div class="col-xs-6">
									<div class="pall-10">
									<button type="button" class="btn btn-default btn-block">本日のイベント</button>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="pall-10">
									<button type="button" class="btn btn-default btn-block">明日のイベント</button>
									</div>
								</div>
							</div>
							<div class="col-xs-12">
								<?php
								if(isset($_GET['day'])){ ?>
								<h1 class="mt20"><?php echo($_GET['day']); ?>日のイベント</h1>
								<?php
								} else { ?>
								<h1 class="mt20">今日のイベント</h1>
								<?php
								} ?>
								
								
								<?php
								$event_list_between_result = $mysqli->query($event_list_between_query);
								while($event_list_between_row = $event_list_between_result->fetch_assoc()){
									$event_id = $event_list_between_row['event_id'];
									$event_title = $event_list_between_row['title'];
									$event_address = $event_list_between_row['address'];
									$event_tel = $event_list_between_row['tel'];
									$event_url = $event_list_between_row['url'];
									$event_description = $event_list_between_row['description'];
									$event_date = $event_list_between_row['event_date'];
									$event_category_name = $event_list_between_row['name']; ?>
									<div class="col-xs-6 col-sm-4 alpha">
									<a id="" href="" title="イベントをさがす" onclick="location.href='#event_detail_Modal'" data-toggle="modal" data-name="<?php echo $event_id; ?>" data-target="#event_detail_Modal"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
									<h2><?php echo $event_title; ?></h2>
									<p>イベント名イベント名</p>
									<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo date_b($event_date); ?></span></p>
									</div>
									<?php
									}?>

							</div>
					    </div>
					    <div class="col-xs-12">
						    <div id="event_map">
							    <h1 class="mt20">地図から探す</h1>

					    	</div>
					    </div>
					    <div class="col-xs-12">
						    <h1 class="mt20">カテゴリーから探す</h1>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフード</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">マイスター</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">フード</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div>
						    <div class="category-item"><a href="project_detail.php" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div>
					    </div>
					    
				    </div>
				    <div class="col-xs-12 col-sm-4">
					    <div id="event" class="cf">
				  		  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"><span class="new_post_index" data-reactid=".2b02jlazx1c.0.0.2">NEW</span></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"><span class="new_post_index" data-reactid=".2b02jlazx1c.0.0.2">NEW</span></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-12">
			  			  <h1>直近のイベント</h1>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class="img-responsive"></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  </div>
			  			  <div class="col-xs-12">
			  			  <h1>CATEGORY</h1>
			  			  <ul>
				  			  <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> カテゴリ</a></li>
				  			  <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> カテゴリ</a></li>
				  			  <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> カテゴリ</a></li>
				  			  <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> カテゴリ</a></li>
				  			  <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> カテゴリ</a></li>
				  			  <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> カテゴリ</a></li>
				  			  <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> カテゴリ</a></li>
				  			  <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> カテゴリ</a></li>
			  			  </ul>
			  			  </div>

			  		  </div>
				    </div>
			    </div>
		    </section>
		    <section id="history">
			    <div class="container-fluid">
				    <h1>閲覧履歴</h1>
					<div class="col-xs-6 col-sm-2 alpha">
						<div class="pall-10">
						<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
						<h2>●●●●●</h2>
						<p id="vw">●●●●●●●●●●</p>
						<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
						</div>
					</div>
					<div class="col-xs-6 col-sm-2 alpha">
						<div class="pall-10">
						<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
						<h2>●●●●●</h2>
						<p id="vw">●●●●●●●●●●</p>
						<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
						</div>
					</div>
					<div class="col-xs-6 col-sm-2 alpha">
						<div class="pall-10">
						<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
						<h2>●●●●●</h2>
						<p id="vw">●●●●●●●●●●</p>
						<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
						</div>
					</div>
					<div class="col-xs-6 col-sm-2 alpha">
						<div class="pall-10">
						<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
						<h2>●●●●●</h2>
						<p id="vw">●●●●●●●●●●</p>
						<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
						</div>
					</div>
					<div class="col-xs-6 col-sm-2 alpha">
						<div class="pall-10">
						<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
						<h2>●●●●●</h2>
						<p id="vw">●●●●●●●●●●</p>
						<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
						</div>
					</div>
					<div class="col-xs-6 col-sm-2 alpha">
						<div class="pall-10">
						<a href="post_detail.php" title="イベントをさがす"><img src="upload/project_img.png" alt="" class="img-responsive"></a>
						<h2>●●●●●</h2>
						<p id="vw">●●●●●●●●●●</p>
						<p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
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
	  slidesPerView: 4,
	  spaceBetween: 10,
	  centeredSlides : true,
	  paginationClickable : true,
	  autoplay: 4000,
	  pagination: '.swiper-pagination',
	  nextButton: '.swiper-button-next',
	  prevButton: '.swiper-button-prev',
	  breakpoints: {
	    767: {
	      slidesPerView: 2,
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