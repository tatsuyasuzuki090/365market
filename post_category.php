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

//記事カテゴリーリスト表示
if(isset($_GET['post_category'])){
	$post_category = $_GET['post_category'];
	$post_category_query = "SELECT post.id AS post_id,post_category.id AS post_category_id,post.*,post_category.* FROM post INNER JOIN post_category ON post.category = post_category.id WHERE post.category = '$post_category'";
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
								  <h3 class="category-des"></h3>
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
				          <a itemprop="url" href=""><span itemprop="title"><?php echo $post_category_name;?></span></a> 》
				      </li>
				      <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
				          <span itemprop="title"><?php //echo $post_title;?></span>
				      </li>
		          </ol>
				</div>
				<div class="col-md-9" id="post" id="">
					
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
		  			  
			  			  <div class="col-xs-6 col-sm-6">
			  				  <div class="mall-05 alpha">
			  				  <a href="<?php echo $url; ?>/post_detail.php?post_no=<?php echo $post_no; ?>" title="イベントをさがす"><img src="<?php echo $url; ?>/upload/<?php echo $post_thumbnail; ?>" alt="<?php echo $post_title; ?>" class="img-responsive center-block"></a>
			  				  <?php
			  				  if($post_datetime2 >= date('Y-m-d H:i:s', strtotime('-7 day', time()))){ ?>
			  				  <span class="new" data-reactid="">NEW</span>
			  				  <?php
			  				  } ?>
			  				  
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="<?php echo $post_category_name; ?>"><?php echo $post_category_name; ?></a></span>
			  				  <h2><?php echo $count; ?><?php echo $post_title; ?></h2>
			  				  <p>今回の野菜オタクノートは、ピリリッと辛みのある ショウガ.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo $post_datetime; ?></span></p>
			  				  </div>
			  			  </div>

			  			  <?php
			  			  $count++;
			  			  }
			  			  ?>


					
				</div>
				<div class="col-md-3">
			  		  <div id="post_index" class="cf">
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
			  			  <h1>RANKING</h1>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす" class="ranka"><img src="https://www.365market.jp/wp-content/uploads/2016/11/%E3%82%AB%E3%83%AA%E3%83%95%E3%83%AD%E3%83%BC%E3%83%AC%EF%BC%93-1024x768.jpg" alt="" class="img-responsive "><span class="rank" data-reactid=".2b02jlazx1c.0.0.2">1</span></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす" class="ranka"><img src="https://www.365market.jp/wp-content/uploads/2016/11/%E5%91%B3%E5%8D%81%E5%85%AB%E7%95%AA%E3%83%8D%E3%82%AE%EF%BC%93-1024x768.jpg" alt="" class="img-responsive"><span class="rank" data-reactid=".2b02jlazx1c.0.0.2">2</span></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす" class="ranka"><img src="https://www.365market.jp/wp-content/uploads/2016/11/DSCN9501-1024x768.jpg.pagespeed.ce.HnqMn_DHqj.jpg" alt="" class="img-responsive"><span class="rank" data-reactid=".2b02jlazx1c.0.0.2">3</span></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす" class="ranka"><img src="https://www.365market.jp/wp-content/uploads/2016/09/%E5%B0%8F%E6%9D%BE%E8%8F%9C%EF%BC%92-1-1024x768.jpg" alt="" class="img-responsive"><span class="rank" data-reactid=".2b02jlazx1c.0.0.2">4</span></a>
			  				  <span class="category-label"><a class="item" href="/category/item" data-id="home" data-label="ITEM">CATE</a></span>
			  				  <h2>白菜の糖度実験！真ん中部分が...</h2>
			  				  <p>なぜ真ん中から使うのか？？真ん中が、白菜の芯の成長点であるた.....</p>
			  				  <p class="text-right"><span class="fs80"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 2017.11.26</span></p>
			  				  </div>
			  			  </div>
			  			  <div class="col-xs-6 col-sm-12">
			  				  <div class="mall-05 alpha">
			  				  <a href="post_detail.php" title="イベントをさがす" class="ranka"><img src="https://www.365market.jp/wp-content/uploads/2016/10/%E3%83%88%E3%83%9E%E3%83%88%EF%BC%92-1024x768.jpg" alt="" class="img-responsive"><span class="rank" data-reactid=".2b02jlazx1c.0.0.2">5</span></a>
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
				  			  <li><a href="#"><i class="fa fa-book" aria-hidden="true"></i> 野菜辞典</a></li>
				  			  <li><a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> 野菜オタク</a></li>
				  			  <li><a href="#"><i class="fa fa-camera" aria-hidden="true"></i> 野菜健康生活</a></li>
				  			  <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i> レポート</a></li>
				  			  <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i> 見学</a></li>
				  			  <li><a href="#"><i class="fa fa-flask" aria-hidden="true"></i> 実験・検証</a></li>
				  			  <li><a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> お知らせ</a></li>
				  			  <li><a href="#"><i class="fa fa-volume-up" aria-hidden="true"></i> PR</a></li>
			  			  </ul>
			  			  </div>

			  		  </div>
		  		  </div>
			  </div>
			  <div class="container-fluid bglocor_gray mt20">
				  <div class="container">
					  <div id ="other_post" class="cf">
						  <h2><i class="fa fa-check" aria-hidden="true"></i> その他注目の記事</h2>
						  <div class="col-md-3 col-sm-4 col-xs-6">
							  <div class="box01 alpha">
								<a href="#">
								    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
								    <p class="fcolorgray">記事記事記事記事</p>
								    <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
								</a>
							</div>
						  </div>
						  <div class="col-md-3 col-sm-4 col-xs-6">
							  <div class="box01 alpha">
								<a href="#">
								    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
								    <p class="fcolorgray">記事記事記事記事</p>
								    <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
								</a>
							</div>
						  </div>
						  <div class="col-md-3 col-sm-4 col-xs-6">
							  <div class="box01 alpha">
								<a href="#">
								    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
								    <p class="fcolorgray">記事記事記事記事</p>
								    <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
								</a>
							</div>
						  </div>
						  <div class="col-md-3 col-sm-4 col-xs-6">
							  <div class="box01 alpha">
								<a href="#">
								    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
								    <p class="fcolorgray">記事記事記事記事</p>
								    <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
								</a>
							</div>
						  </div>
						  <div class="col-md-3 col-sm-4 col-xs-6">
							  <div class="box01 alpha">
								<a href="#">
								    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
								    <p class="fcolorgray">記事記事記事記事</p>
								    <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
								</a>
							</div>
						  </div>
						  <div class="col-md-3 col-sm-4 col-xs-6">
							  <div class="box01 alpha">
								<a href="#">
								    <p><img src="upload/project_img.png" alt="" class="img-responsive"></p>
								    <p class="fcolorgray">記事記事記事記事</p>
								    <p class="text-right fcolorgray"><i class="fa fa-tags" aria-hidden="true"></i> 野菜オタク</p>
								</a>
							</div>
						  </div>
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