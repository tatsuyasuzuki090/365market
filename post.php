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
		    <section id="post" class="text-center container">
		  		  <div class="col-md-9">
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
		  			  <?php
		  			  $post_list_result = $mysqli->query($post_list_query);
		  			  $count = 1;
		  			  while($post_list_row = $post_list_result->fetch_assoc()){
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
		  			    if($count%2!=0){echo ("<div class=\"col-xs-12 col-sm-12\">");}
		  			    
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
			  			  if($count%2==0){echo ("</div>");} ?>
			  			  <?php
			  			  $count++;
			  			  }
			  			  ?>





<div id="wrap" class="cf">
    <div class="box">test</div>
    <div class="box">test</div>


</div>
 
<div id="loadimg"></div>


	
	
	
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


	<!--ページ最下部でローディング--> 
	<script type="text/javascript">
	$(function() {
	    // オプションのproximityでbottom.jsを発生する位置を指定する
	    $(window).bottom({proximity: 0.05});
	    $(window).bind('bottom', function() {
	        var obj = $(this);
	        // 「loading」がfalseの時に実行
	        if (!obj.data('loading')) {
	            // 「loading」をtrueにする
	            obj.data('loading', true);
	            // ローディング画像を表示
	            $('#loadimg').html('<img src="image/loading-36.gif" />');
	            // 追加したい処理を記述
	            setTimeout(function() {
	                // ローディング画像を削除
	                $('#loadimg').html('');
	                // 追加するHTMLを指定
	                $('#wrap').append('<div class="box">test</div><div class="box">test</div><div class="box">test</div>');
	                // 処理が完了したら「loading」をfalseにする
	                obj.data('loading', false);
	            }, 1500);
	            
	            
	        }
	        
	    });
	    
	    // リロードしたときにページの先頭を表示する
	    $('html,body').animate({ scrollTop: 0 }, '1');
	});
	</script>
	
	
  </body>
</html>