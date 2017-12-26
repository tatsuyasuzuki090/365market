

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
//プロジェクト詳細取り出し
if(isset($_GET['edit'])){$edit = $_GET['edit'];}
$project_no = $_GET['project_no'];
$query_project_detail = "SELECT co.title AS co_title,project.title AS project_title,co.*,project.*,user.* FROM project INNER JOIN co ON project.no = co.no JOIN user ON co.no = user.no WHERE project.project_no = '$project_no'";

$result_project_detail = $mysqli->query($query_project_detail);
$row_project_detail = $result_project_detail->fetch_assoc();
$client_name = $row_project_detail['company_name'];
$client_img = $row_project_detail['img_sub_prof_path'];

$client_no = $row_project_detail['no'];
$project_no = $row_project_detail['project_no'];
$project_title = $row_project_detail['project_title'];
$project_description = $row_project_detail['description'];
$project_address = $row_project_detail['project_address'];
$project_main_img_path = $row_project_detail['main_img_path'];
	if($project_main_img_path == "project_no_img.png"){
	} else {
		$project_img = "<img src=\" $url/upload/$project_main_img_path\" class=\"img-responsive center-block\" />";
	}
$project_status = $row_project_detail['status'];
$project_days = $row_project_detail['project_datetime'];
$project_days = date("Y年m月d日",strtotime($project_days));
$weekday = array( "日", "月", "火", "水", "木", "金", "土" );
$project_datetime = $row_project_detail['datetime'];
$project_datetime = date("Y年m月d日",strtotime($project_datetime));
$project_description = mb_substr($project_description, 0, 150, 'utf-8'); //全角文字で先頭から50文字取得
    if(mb_strlen($project_description, 'utf-8') > '149') { //18文字より多い場合は「...」を追加
    $project_description .= '…';
    }

//この企業のプロジェクト一覧
$query_project_company = "SELECT co.title AS co_title,project.title AS project_title,co.*,project.*,user.* FROM project INNER JOIN co ON project.no = co.no JOIN user ON co.no = user.no WHERE project.no = '$client_no' ORDER BY project.datetime";
$result_project_company = $mysqli->query($query_project_company);

// データベースの切断
if( isset($_SESSION['user']) != "") {
	//お気に入り機能
	$favorite_query = "SELECT * FROM favorite_project WHERE project_no = '$project_no' AND fm_no = ".$_SESSION['user']."";	
	$favorite_result = $mysqli->query($favorite_query);
	$favorite_row = $favorite_result->fetch_assoc();
	//削除
	if(isset($_POST['yes'])) {
		$favorite_del_query = "DELETE FROM favorite_project WHERE project_no = '$project_no' AND fm_no = ".$_SESSION['user']."";
		$favorite_del_result = $mysqli->query($favorite_del_query);
		header("Location:project_detail.php?project_no=$project_no");
	}
	//IN
	if(isset($_POST['favorite_in'])) {
		echo($project_no);echo($_SESSION['user']);
		$favorite_in_query = "INSERT INTO favorite_project (project_no, fm_no) VALUES ('$project_no', ".$_SESSION['user'].")";
		$favorite_in_result = $mysqli->query($favorite_in_query);
		header("Location:project_detail.php?project_no=$project_no");
	}
}

//閲覧履歴クッキー
$data_project_no = array("$project_no"); //ここに保存したいテキスト（配列にしとく）
$data_url = array($_SERVER["REQUEST_URI"]); //現在のURL（配列にしとく）
$data_project_title = array("$project_title");
$data_project_img = array("$project_main_img_path");
$data_project_description = array("$project_description");

$max = '6'; //保存する数


//テキストの保存
 if(isset($_COOKIE['data_project_no'])){ //現在クッキーに保存されているものがあれば
  $status = unserialize($_COOKIE['data_project_no']); //まずアンシリアライズ（？）で配列に
  foreach($status as $key=>$name2){ 
   if(!in_array($name2,$data_project_no)){  // data_itemにnameがなければ
    array_push($data_project_no,$name2);// data_itemに突っ込む
   }
   if( count($data_project_no) == $max ){ //保存する数で終了
    break;
   }
  }
 }
//URL保存　テキスト保存とやってることは一緒
 if(isset($_COOKIE['history_url'])){
  $status = unserialize($_COOKIE['history_url']);
  foreach($status as $key=>$name2){
   if(!in_array($name2,$data_url)){
    array_push($data_url,$name2);
   }
   if( count($data_url) == $max ){
    break;
   }
  }
 }
 //タイトル
 if(isset($_COOKIE['data_project_title'])){
  $status = unserialize($_COOKIE['data_project_title']);
  foreach($status as $key=>$name2){
   if(!in_array($name2,$data_project_title)){
    array_push($data_project_title,$name2);
   }
   if( count($data_project_title) == $max ){
    break;
   }
  }
 }
 //イメージ
 if(isset($_COOKIE['data_project_img'])){
  $status = unserialize($_COOKIE['data_project_img']);
  foreach($status as $key=>$name2){
	  //重複チェック!in_arrayは不要
    array_push($data_project_img,$name2);
   if( count($data_project_img) == $max ){
    break;
   }
  }
 }
 //本文
 if(isset($_COOKIE['data_project_description'])){
  $status = unserialize($_COOKIE['data_project_description']);
  foreach($status as $key=>$name2){
   if(!in_array($name2,$data_project_description)){
    array_push($data_project_description,$name2);
   }
   if( count($data_project_description) == $max ){
    break;
   }
  }
 } 
//クッキーセット
 setcookie( 'data_project_no' , serialize($data_project_no) , time() + 31536000, '/' );
 setcookie( 'history_url' , serialize($data_url) , time() + 31536000, '/' );
 setcookie( 'data_project_title' , serialize($data_project_title) , time() + 31536000, '/' );
 setcookie( 'data_project_img' , serialize($data_project_img) , time() + 31536000, '/' );
 setcookie( 'data_project_description' , serialize($data_project_description) , time() + 31536000, '/' );	
 
 
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
    
	<!--googlemap　APIkey-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqvkV-DIi9XU_Gxjpatnv6-nN5E9VUltI" type="text/javascript"></script>
	<!--map表示-->
	<script type="text/javascript">
		//COMTOPIA流Google MAP表示方法
		var geocoder = new google.maps.Geocoder();//Geocode APIを使います。
		var address = "<?php echo $project_address; ?>";
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
		    <section id="project_detal_top">
		  	  <div class="container-fluid">
		  		  <div class="container cf">
		  			  <div class="category-item"><p>大阪府</p></div><div class="category-item"><p>野菜ソムリエ</p></div><div class="category-item"><p>その他</p></div>
		  			  <h1><?php echo $project_title; ?></h1>
		  				<div class="text-right cf">
		  					<ul>		  
		  						<li>
		  							<div class="fb-like fb_iframe_widget" data-href="https://www.wantedly.com/projects/89337" data-layout="button_count" data-send="false" data-show-faces="false" data-width="100" style="margin-right: " fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=234170156611754&amp;container_width=0&amp;href=https%3A%2F%2Fwww.wantedly.com%2Fprojects%2F89337&amp;layout=button_count&amp;locale=ja_JP&amp;sdk=joey&amp;send=false&amp;show_faces=false&amp;width=100"><span style="vertical-align: bottom; width: 95px; height: 20px;"><iframe name="f10dca83c529ae8" width="100px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="https://www.facebook.com/v2.10/plugins/like.php?app_id=234170156611754&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FlY4eZXm_YWu.js%3Fversion%3D42%23cb%3Df12f45509128ab%26domain%3Dwww.wantedly.com%26origin%3Dhttps%253A%252F%252Fwww.wantedly.com%252Ff247198cef14e2c%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2Fwww.wantedly.com%2Fprojects%2F89337&amp;layout=button_count&amp;locale=ja_JP&amp;sdk=joey&amp;send=false&amp;show_faces=false&amp;width=100" style="border: none; visibility: visible; width: 95px; height: 20px;" class=""></iframe></span>
		  							</div>
		  						</li>
		  						<li>
		  							<div class="twitter" id="twitter-share-trigger" data-callback="{&quot;url&quot;:&quot;https://www.wantedly.com/sns_callback/share_on_twitter&quot;,&quot;options&quot;:{&quot;type&quot;:&quot;POST&quot;,&quot;data&quot;:&quot;project_id=89337&quot;,&quot;dataType&quot;:&quot;html&quot;}}"><iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" class="twitter-share-button twitter-share-button-rendered twitter-tweet-button" title="Twitter Tweet Button" src="https://platform.twitter.com/widgets/tweet_button.5069e7f3e4e64c1f4fb5d33d0b653ff6.ja.html#dnt=false&amp;hashtags=wantedly&amp;id=twitter-widget-0&amp;lang=ja&amp;original_referer=https%3A%2F%2Fwww.wantedly.com%2Fprojects%2F89337&amp;related=wantedly%3AWantedly%20%E5%85%AC%E5%BC%8F%E3%82%A2%E3%82%AB%E3%82%A6%E3%83%B3%E3%83%88&amp;size=m&amp;text=%E4%B8%96%E7%95%8C%E6%9C%80%E5%85%88%E7%AB%AF%E3%81%AE%E8%87%AA%E7%84%B6%E8%A8%80%E8%AA%9E%E5%87%A6%E7%90%86%E6%8A%80%E8%A1%93%E3%81%AE%E9%96%8B%E7%99%BA%E3%82%92%E3%81%97%E3%81%9F%E3%81%84Python%E3%83%8F%E3%83%83%E3%82%AB%E3%83%BC%E5%A4%A7%E5%8B%9F%E9%9B%86%EF%BC%81%20by%20%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BEStudio%20Ousia&amp;time=1511927899588&amp;type=share&amp;url=https%3A%2F%2Fwww.wantedly.com%2Fprojects%2F89337" style="position: static; visibility: visible; width: 75px; height: 20px;" data-url="https://www.wantedly.com/projects/89337"></iframe>
		  							</div>
		  						</li>
		  					</ul>
		  				</div>
		  				<!--<p><img src="upload/project_sample_img.png" alt="" class="img-responsive"></p>-->
		  				<?php
		  				if(strpos($project_img,'project_noimage.png') !== false) {
		  				} else { ?>
			  				<p><?php echo $project_img; ?></p>
			  			<?php
			  			} ?>
		  				<div class="company_name cf">
		  				  <p class="com_img"><a href="#"><img src="upload/<?php echo $client_img; ?>" alt="" class="img-responsive img-circle"></a></p>
		  				  <h2 class="com_name"><?php echo $client_name; ?></h2>
		  				  <p class="text-right fs80 fcolorgray"><?php echo $project_datetime; ?>更新</p>
		  			  </div>
		  		  </div>
		  	  </div>
		    </section>
		    <section id="project_detal_description">
		  	  <div class="container-fluid">
		  		  <div class="container cf">
		  			  <div class="col-xs-12 col-sm-8">
		  				  <div class="description_left">
		  					  <div class="description_part">
		  						  <h2>こんなことをやります</h2>
		  						  <div class="pall-0202020">
			  						  <p><?php echo $project_description; ?></p>
		  						  </div>
		  					  </div>
		  					  <div class="description_part">
		  						  <h2>開催情報</h2>
		  							<table class="description_part_table">
		  								<tr>
		  									<th>開催日時</th>
		  									<td><?php echo $project_days; ?>（<?php echo $weekday[date("w")]; ?>）</td>
		  								</tr>
		  								<tr>
		  									<th>開催場所</th>
		  									<td><?php echo $project_address; ?></td>
		  								</tr>
		  								<tr>
		  									<th>連絡先</th>
		  									<td>00-0000-0000</td>
		  								</tr>
		  								<tr>
		  									<th>URL</th>
		  									<td><a href="https://www.yahoo.co.jp">https://www.yahoo.co.jp</a></td>
		  								</tr>
		  							</table>
		  					  </div>
		  					  <div class="description_part">
		  						  <h2>報酬・待遇</h2>
		  							<table class="description_part_table">
		  								<tr>
		  									<th>報酬</th>
		  									<td>10,000円／日</td>
		  								</tr>
		  								<tr>
		  									<th>勤務時間</th>
		  									<td>10:00〜最大13:00</td>
		  								</tr>
		  								<tr>
		  									<th>その他</th>
		  									<td>交通費別途上限3,000円</td>
		  								</tr>
		  							</table>
		  					  </div>
		  				  </div>
		  			  </div>
		  			  <div class="col-xs-12 col-sm-4">
		  				  <div class="description_right">
		  					  <div class="apply_add">
			  					<?php
								if (isset($_SESSION['user']) AND ($_SESSION['user'] != $client_no)){ ?>
								<form method="post" action="project_apply.php">
									<?php
									if(isset($edit)){ ?>
			  						<p><button type="submit" class="btn btn-success btn-lg btn-block" name="project_no" value="<?php echo $project_no; ?>">下書きを表示する</button></p>
			  						<?php
									} else { ?>
									<p><button type="submit" class="btn btn-success btn-lg btn-block" name="project_no" value="<?php echo $project_no; ?>">この案件に応募する</button></p>
									<?php
									} ?>
								</form>
								<?php
								} elseif (isset($_SESSION['user']) AND ($_SESSION['user'] = $client_no)) {
								} else { ?>
									<button type="submit" class="btn btn-success btn-lg btn-block" onclick="location.href='#regist_equir_Modal'" data-toggle="modal" data-target="#regist_equir_Modal">この案件に応募する</button>	
								<?php
								} ?>
		  						<?php
								if( isset($_SESSION['user']) != "") {
									if(isset($favorite_row)){ ?>
									<p><button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#fm_del_Modal">お気に入りから削除する</button></p>
									<?php
									} else { ?>
			  						<form action="" method="post" name="favorite_in_form" class="inline-block"><input type="hidden" name="favorite_in" value="favorite_in" />
			  						<p><button type="submit" class="btn btn-default btn-lg btn-block">お気に入りへ</button></p>
			  						</form>
			  						<?php
									}?>
								<?php
								} else { ?>
		  						<p><button type="submit" class="btn btn-default btn-lg btn-block" onclick="location.href='#regist_equir_Modal'" data-toggle="modal" data-target="#regist_equir_Modal">お気に入りに追加する</button></p>
								<?php
								} ?>

		  					  </div>
		  					  <div class="apply">
		  						<h3><i class="fa fa-map-marker" aria-hidden="true"></i> 地図</h3>
		  						<p class="text-center"><?php echo $project_address; ?></p>
		  						<div id="google_map" style="width:100%;height:400px"></div>
		  					  </div>
		  					  <div class="apply">
		  						<h3><i class="fa fa-file" aria-hidden="true"></i> この企業の他の案件</h3>
			  						<?php
				  					$count = 1;
			  						while(( $row_project_company = $result_project_company->fetch_assoc())&&($count <= 5)) {
										$project_company_project_no = $row_project_company['project_no'];
										$project_company_main_img_path = $row_project_company['main_img_path'];
										$project_company_project_title = $row_project_company['project_title']; ?>
		  							<div class="box000 alpha">
		  							  <a href="project_detail.php?project_no=<?php echo $project_company_project_no; ?>">
		  							  <p><img src="upload/<?php echo $project_company_main_img_path; ?>" alt="" class="img-responsive"></p>
		  							  <p class="fcolorgray"><?php echo $project_company_project_title; ?></p>
		  							  <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 販売店</p></a>
		  							</div>
		  							<?php
			  						$count++;
		  							} ?>
		  					  </div>
		  				  </div>
		  			  </div>
		  		  </div>
		  	  </div>
		    </section>
		    <section id ="project_list_new">
		  	  <div class="container-fluid">
		  		  <h2><i class="fa fa-check" aria-hidden="true"></i> この企業の新着の案件</h2>
		  		  <?php
			  		$count = 1;
		  		  	$result_project_company = $mysqli->query($query_project_company);
					while(( $row_project_company = $result_project_company->fetch_assoc())&&($count <= 6)){
					$client_name = $row_project_company['company_name'];
					$client_img = $row_project_company['img_sub_prof_path'];
					
					$client_no = $row_project_company['no'];
					$project_no = $row_project_company['project_no'];
					$project_title = $row_project_company['project_title'];
					$project_description = $row_project_company['description'];
					$project_address = $row_project_company['project_address'];
					$project_main_img_path = $row_project_company['main_img_path'];
						if($project_main_img_path == "project_no_img.png"){
						} else {
							$project_img = "<img src=\" $url/upload/re_$project_main_img_path\" class=\"img-responsive center-block\" />";
						}
					$project_status = $row_project_company['status'];
					$project_days = $row_project_company['project_datetime'];
					$project_days = date("Y年m月d日",strtotime($project_days));
					$weekday = array( "日", "月", "火", "水", "木", "金", "土" );
					$project_datetime = $row_project_company['datetime'];
					$project_datetime = date("Y年m月d日",strtotime($project_datetime));
					$project_title = mb_substr($project_title, 0, 15, 'utf-8'); //全角文字で先頭から50文字取得
					    if(mb_strlen($project_title, 'utf-8') > '14') { //18文字より多い場合は「...」を追加
					    $project_title .= '…';
					    }
					    
					$project_description = mb_substr($project_description, 0, 30, 'utf-8'); //全角文字で先頭から50文字取得
					    if(mb_strlen($project_description, 'utf-8') > '29') { //18文字より多い場合は「...」を追加
					    $project_description .= '…';
					    }
					    ?>
		  		  <div class="col-xs-6 col-sm-6 col-md-2 mb10">
		  			  <div class="box000 alpha mall-05">
		  			    <a href="#">
		  				    <p class="mb10"><?php echo $project_img; ?></p>
		  				    <p class="fcolorgray"><?php echo $project_title; ?></p>
		  				    <p class="fcolorgray"><?php echo $project_description; ?></p>
		  				    <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 販売スタッフ</p>
		  				</a>
		  			  </div>
		  		  </div>
		  		  <?php
		  		  $count++;
		  		  }
		  		  ?>

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
    
	<!--modal-->
	<?php 
	include('modal.php');?>
    <!--modal--> 	
        
	<!-- 応募ボタン枠の固定化 -->
	<!-- project_detail.phpのみ記載 -->
	<!-- テンプレ化すると上部へ戻るボタンのjsに不具合あり -->
	<script>
	var apply_add    = $('.apply_add'),
	offset = apply_add.offset();
	
	$(window).scroll(function () {
	  if($(window).scrollTop() > offset.top - -785) {
	    apply_add.addClass('fixed');
	  } else {
	    apply_add.removeClass('fixed');
	  }
	});
	</script>
	

	
	    	
  </body>
</html>