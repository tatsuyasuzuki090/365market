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
if(isset($_GET['post_no'])){
	$post_no = $_GET['post_no'];
	$post_query = "SELECT post.id AS post_id,post_category.id AS post_category_id,post.*,post_category.* FROM post INNER JOIN post_category ON post.category = post_category.id WHERE post.id = '$post_no'";	
	$post_result = $mysqli->query($post_query);
	$post_row = $post_result->fetch_assoc();
	$post_id = $post_row['post_id'];
	$post_title = $post_row['title'];
	
	
	$post_content = $post_row['content'];
	$post_category_name = $post_row['name'];
	$post_category_id = $post_row['category'];
	$post_thumbnaile = $post_row['thumbnail'];
	$post_title = $post_row['title'];

//記事カテゴリーリスト表示
	$post_category_query = "SELECT post.id AS post_id,post_category.id AS post_category_id,post.*,post_category.* FROM post INNER JOIN post_category ON post.category = post_category.id WHERE post.category = '$post_category_id' ORDER BY RAND() LIMIT 6";
	$post_category_result = $mysqli->query($post_category_query);
	$post_category_row = $post_category_result->fetch_assoc();
	$post_category_name = $post_category_row['name'];


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
		  <section id="post_detail" class="">
			  <div class="title_bg">
				  <div class="container">
					  <div class="post_detail_title cf">
						  <div class="col-md-3">
							  <h2 class="category-slug">Otaku</h2>
							  <h1 class="category-name"><?php echo $post_category_name;?></h1>
						  </div>
						  <div class="col-md-9">
							  <div class="lineleft-border">
								  <h3 class="category-des">野菜オタクが本気で検証!野菜のあれこれ</h3>
							  </div>
						  </div>
					  </div>
				  </div>
			  </div>
			  <div class="container">
				<div id="pan">
				    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
				      <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
				          <a itemprop="url" href=""><span itemprop="title">TOP</span></a> 》
				      </li>
				      <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
				          <a itemprop="url" href="post_category.php?post_category=<?php echo $post_category_id;?>"><span itemprop="title"><?php echo $post_category_name;?></span></a> 》
				      </li>
				      <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
				          <span itemprop="title"><?php echo $post_title;?></span>
				      </li>
		          </ol>
				</div>
				<div class="col-md-10" id="post_des">
					<div class="article_category" id="articleCategory">
<!-- 					    <canvas id="categoryCanvas" class="category-canvas" width="110" height="30"></canvas> -->
					    <p class="category-name">スペシャル</p>
					    <p class="category-slug">Special</p>
					</div>
					<div id="post_contents">
						<h1><?php echo $post_title;?></h1>
							<?php echo $post_content ;?>
						
						<div class="box17 fm-prof">
							<div class="row">
							<h3>フードメッセンジャー：藤田 久美子<span class="fs80">（フジタ クミコ）</span></h3>
							
							<div class="col-sm-3 col-xs-12">
								<p class="fm-prof_img"><img src="upload/mori04.jpg.pagespeed.ce.Hn6xj9GYdJ.jpg" alt="" class="img-responsive img-circle center-block"></p>
								
							</div>
							<div class="col-sm-9 col-xs-12">
								<div class="category-item"><p>野菜ソムリエ</p></div><div class="category-item"><p>野菜ソムリエ</p></div><div class="category-item"><p>野菜ソムリエ</p></div><div class="category-item"><p>野菜ソムリエ</p></div>
								<p class="fm-prof_text">1966年、「食を魅せる・食を語る」をテーマに家業の広告の世界に身を置き、より深く食の世界に関わりたいと、フードスタイリスト・野菜ソムリエ・メンタルフードマイスターの資格を取得。現在は、フードスタイリング・料理教室・ケータリング・食材卸売等の業務も手がける。</p>
								<p class="fm-prof_text"><button type="button" class="btn btn-success btn-block" onclick="location.href='prof.php'">プロフィールページはこちら</button></p>
							</div>
    
							</div>
</div>

					</div>
					
				</div>
				<div id="post_contents_side">
				<div class="col-md-2">
					<h2 class="post_pop"><i class="fa fa-paperclip" aria-hidden="true"></i> 人気の記事</h2>
					<div class="col-sm-6 col-md-12">
						
						<div class="alpha">
							<a href="#">
							    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
							    <p class="fcolorgray">記事記事記事記事</p>
							    <p class="text-right fcolorgray fs80 cate"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-md-12">
						<div class="alpha">
							<a href="#">
							    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
							    <p class="fcolorgray">記事記事記事記事</p>
							    <p class="text-right fcolorgray fs80 cate"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-md-12">
						<div class="alpha">
							<a href="#">
							    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
							    <p class="fcolorgray">記事記事記事記事</p>
							    <p class="text-right fcolorgray fs80 cate"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-md-12">
						<div class="alpha">
							<a href="#">
							    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
							    <p class="fcolorgray">記事記事記事記事</p>
							    <p class="text-right fcolorgray fs80 cate"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-md-12">
						<div class="alpha">
							<a href="#">
							    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
							    <p class="fcolorgray">記事記事記事記事</p>
							    <p class="text-right fcolorgray fs80 cate"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
							</a>
						</div>
					</div>
					<div class="col-sm-6 col-md-12">
						<div class="alpha">
							<a href="#">
							    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
							    <p class="fcolorgray">記事記事記事記事</p>
							    <p class="text-right fcolorgray fs80 cate"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
							</a>
						</div>
					</div>
					
				</div>
				</div>
			  </div>
			  <div class="container-fluid bglocor_gray mt20">
					  <div id ="other_post" class="cf">
						  <h2><i class="fa fa-check" aria-hidden="true"></i> その他注目の記事</h2>
						  
						  
						  <?php
			  			  $post_category_result = $mysqli->query($post_category_query);
			  			  $count = 1;
			  			  while($post_category_row = $post_category_result->fetch_assoc()){
			  			    $post_no = $post_category_row['post_id'];
			  			    $post_title = $post_category_row['title'];
			  			    
			  			    $post_title = mb_substr($post_title, 0, 18, 'utf-8'); //全角文字で先頭から50文字取得
			  			      if(mb_strlen($post_title, 'utf-8') > '17') { //18文字より多い場合は「...」を追加
			  			      $post_title .= '…';
			  			      }
			  			  
			  			  
			  			    $post_category_name = $post_category_row['name'];
			  			    $post_category_id = $post_category_row['category'];
			  			    $post_thumbnail = $post_category_row['thumbnail'];
			  			    $post_datetime = $post_category_row['datetime'];
			  			    $post_datetime = date_a($post_datetime);
			  			    $post_datetime2 = $post_category_row['datetime'];
			  			    
			  			    $post_post_status = $post_category_row['post_status'];
			  			    //post_status
			  			    //0:公開
			  			    //1:下書き
			  			    //2:投稿予約
			  			    
			  			  ?>
		  			  
			  			  <div class="col-md-2 col-sm-4 col-xs-6">
			  				  <div class="box000 mall-05 alpha">
			  				  <a href="<?php echo $url; ?>/post_detail.php?post_no=<?php echo $post_no; ?>" title="イベントをさがす">
				  				  <p><img src="<?php echo $url; ?>/upload/<?php echo $post_thumbnail; ?>" alt="<?php echo $post_title; ?>" class="img-responsive center-block"></p>
			  				  </a>
			  				  <p><?php echo $count; ?><?php echo $post_title; ?></p>
			  				  <p>今回の野菜オタクノートは、ピリリッと辛みのある ショウガ.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo $post_datetime; ?></span></p>
			  				  </div>
			  			  </div>

			  			  <?php
			  			  $count++;
			  			  }
			  			  ?>
			  			  

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