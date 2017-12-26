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

//プロジェクト一覧取り出し
$query_project_list = "SELECT * FROM project WHERE status = 0 ORDER BY datetime DESC LIMIT 8";	
$result_project_list = $mysqli->query($query_project_list);
//案件ステータス
//0:掲載中
//1:停止中
//2:終了
//3:新規作成時

//FM一覧取り出し
$query_fm = "SELECT * FROM user INNER JOIN prof ON user.no = prof.no WHERE prof.mode = 1 ";	
$result_fm = $mysqli->query($query_fm);



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
	<link href="css/remodal-default-theme.css" rel="stylesheet">
	<link href="css/remodal.css" rel="stylesheet">
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
		    <section id="project_main-img" class="text-center bglocor_gray">
		  	  <div class="clearfix">
		  		  <div class="col-md-12">
		  			  <!-- Swiper -->
		  			  <div class="swiper-container">
		  			    <div class="swiper-wrapper">
		  			      <div class="swiper-slide alpha"><a href="project_detail.php" title="イベントをさがす"><img src="upload/111-1.jpg" alt="" class=""><p class="fcolorgray mb40">ソルチパーティーの司会進行役のフォードメッセンジャー</p></a></div>
		  			      <div class="swiper-slide alpha"><a href="project_detail.php" title="イベントをさがす"><img src="upload/D111SC03250-2-768x509.jpg.pagespeed.ce.Pp5h3RfDOB.jpg" alt="" class=""><p class="fcolorgray mb40">白タマネギ「真白」PR販売スタッフ募集</p></a></div>
		  			      <div class="swiper-slide alpha"><a href="project_detail.php" title="イベントをさがす"><img src="upload/DSC0053.jpg" alt="" class=""><p class="fcolorgray mb40">案件名案件名案件名案件名案件名案件名案件名</p></a></div>
		  			      <div class="swiper-slide alpha"><a href="project_detail.php" title="イベントをさがす"><img src="upload/CG_13-1024x683.jpg" alt="" class=""><p class="fcolorgray mb40">案件名案件名案件名案件名案件名案件名案件名</p></a></div>
		  			      <div class="swiper-slide alpha"><a href="project_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class=""><p class="fcolorgray mb40">案件名案件名案件名案件名案件名案件名案件名</p></a></div>
		  			      <div class="swiper-slide alpha"><a href="project_detail.php" title="イベントをさがす"><img src="img/img01.jpg" alt="" class=""><p class="fcolorgray mb40">案件名案件名案件名案件名案件名案件名案件名</p></a></div>
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
		    <section id="project_category" class="cf">
		  	  <div class="col-xs-12">
		  		  <h2>求められる分野・資格はさまざま。的確な仕事を発見できます。</h2>
		  		  <div class="swiper-container2">
		  			 <div class="swiper-wrapper">
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">フードスタイリスト</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">野菜ソムリエ</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">フードスタイリスト</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">フードスタイリスト</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">野菜ソムリエ</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">フードスタイリスト</a></div></div>
		  			   <div class="swiper-slide alpha"> <div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div></div>
		  			   <div class="swiper-slide alpha"> <div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">フードスタイリスト</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">野菜ソムリエ</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">メンタルフードマイスター</a></div></div>
		  			   <div class="swiper-slide alpha"><div class="category-item"><a href="#" title="音楽" id="top_category_slider_music">フードスタイリスト</a></div></div>
		  			 </div>
		  		  </div>

					<article class="accordion">
						<h2>詳細検索<i class="fa fa-caret-down" aria-hidden="true"></i></h2>
						<div>
					        <div id="search-area_project">
						        <form id="searchform" method="post">
							        <h3>保有資格</h3>
						            <main>
						                <div class="search text-center">
							                <?php
							                for($license_status = 1; $license_status <=5; $license_status++) { ?>
							            	<div class="category-item"><input type="checkbox" name="check[]" value="<?php echo license_status($license_status); ?>" id="<?php echo license_status($license_status); ?>"><label for="<?php echo license_status($license_status); ?>" class="label"><?php echo license_status($license_status); ?></label></div>
							            	<?php
							            	} ?>
						                </div>
						            </main>
						            <h3>エリア</h3>
						            <main>
						                <div class="search text-center">
							                <?php
							                for($area = 1; $area <=47; $area++) { ?>
							            	<div class="category-item"><input type="checkbox" name="check[]" value="<?php echo area_status($area); ?>" id="<?php echo area_status($area); ?>"><label for="<?php echo area_status($area); ?>" class="label"><?php echo area_status($area); ?></label></div>
							            	<?php
							            	} ?>
						                </div>
						            </main>
						            <h3>スキル</h3>
						            <main>
						                <div class="search text-center">
							                <?php
							                for($skill_status = 1; $skill_status <=25; $skill_status++) { ?>
							            	<div class="category-item"><input type="checkbox" name="check[]" value="<?php echo skill_status($skill_status); ?>" id="<?php echo skill_status($skill_status); ?>"><label for="<?php echo skill_status($skill_status); ?>" class="label"><?php echo skill_status($skill_status); ?></label></div>
							            	<?php
							            	} ?>
						                </div>
						            </main>
					        </div>
						</div>
					</article>
		  	  </div>
		    </section>

		    <div id="loading" ></div>
		    					<div id="res"></div>
					            </form>
		    <section id ="project_list_new" class="bglocor_gray">
		  	  <div class="container">
		  		  <h2><i class="fa fa-check" aria-hidden="true"></i> 新着の案件</h2>
		  		  <?php
		  		  $i = 1;
		  		  while( $row_project_list = $result_project_list->fetch_assoc()) {
		  		  	$project_user_no = $row_project_list['no'];
		  		  	$project_no = $row_project_list['project_no'];
		  		  	$project_title = $row_project_list['title'];
		  		  	$project_description = $row_project_list['description'];
		  		  	$project_main_img_path = $row_project_list['main_img_path'];
		  		  	$project_datetime = $row_project_list['datetime'];
		  		  	$project_datetime = date("Y年m月d日",strtotime($project_datetime));
		  		  	$project_datetime2 = $row_project_list['datetime'];
		  		  	$project_title = mb_substr($project_title, 0, 26, 'utf-8'); //全角文字で先頭から50文字取得
		  		      if(mb_strlen($project_title, 'utf-8') > '25') { //18文字より多い場合は「...」を追加
		  		      $project_title .= '…';
		  		      }
		  		  	$project_description = mb_substr($project_description, 0, 55, 'utf-8'); //全角文字で先頭から50文字取得
		  		      if(mb_strlen($project_description, 'utf-8') > '49') { //18文字より多い場合は「...」を追加
		  		      $project_description .= '…';
		  		      } ?>
		  		  <?php
		  		  if($i == 1 OR $i == 5) { ?>
		  		  <div class="row">
		  		  <?php } ?>
		  		  <div class="col-xs-12 col-sm-4 col-md-3 mb30 alpha height367">
			  		  
			  		  <a href="<?php echo $url; ?>/project_detail.php?project_no=<?php echo $project_no; ?>">
		  			  <div class="mall-05">
		  				    <p class="mb10 img_height"><img src="<?php echo $url; ?>/upload/re_<?php echo $project_main_img_path; ?>" class="img-responsive" /></p>
		  				    <h3 class="title"><?php echo $project_title; ?></h3>
		  				    <p class="title"><?php echo $project_description; ?></p>
		  				    <p class="fcolorgray day"><?php echo $project_datetime; ?></p>
		  			  </div>
		  			  </a>
		  			  <?php
		  			  if($project_datetime2 >= date('Y-m-d H:i:s', strtotime('-7 day', time()))){ ?>
		  			  <span class="new" data-reactid="">NEW</span>
		  			  <?php
		  			  } ?>
		  			  <span class="category-label_project"><a class="project_item cate" href="/category/item" data-id="home" data-label="ITEM">販売</a></span>
		  		  </div>
		  		  <?php
		  		  if($i == 4 OR $i == 8) { ?>
		  		  </div>
		  		  <?php } ?>
		  		  <?php
		  		  $i++;
		  		  } ?>
		  	  </div>
		    </section>
		    <section id ="project_list_new" class="bglocor_w">
		  	  <div class="container">
		  		  <h2><i class="fa fa-check" aria-hidden="true"></i> ●●の案件</h2>
		  		  <?php
		  		  $result_project_list = $mysqli->query($query_project_list);
		  		  $i = 1;
		  		  while( $row_project_list = $result_project_list->fetch_assoc()) {
		  		  	$project_user_no = $row_project_list['no'];
		  		  	$project_no = $row_project_list['project_no'];
		  		  	$project_title = $row_project_list['title'];
		  		  	$project_description = $row_project_list['description'];
		  		  	$project_main_img_path = $row_project_list['main_img_path'];
		  		  	$project_datetime = $row_project_list['datetime'];
		  		  	$project_datetime = date("Y年m月d日",strtotime($project_datetime));
		  		  	$project_title = mb_substr($project_title, 0, 26, 'utf-8'); //全角文字で先頭から50文字取得
		  		      if(mb_strlen($project_title, 'utf-8') > '25') { //18文字より多い場合は「...」を追加
		  		      $project_title .= '…';
		  		      }
		  		  	$project_description = mb_substr($project_description, 0, 55, 'utf-8'); //全角文字で先頭から50文字取得
		  		      if(mb_strlen($project_description, 'utf-8') > '49') { //18文字より多い場合は「...」を追加
		  		      $project_description .= '…';
		  		      } ?>
		  		  <?php
		  		  if($i == 1 OR $i == 5) { ?>
		  		  <div class="row">
		  		  <?php } ?>
		  		  <div class="col-xs-12 col-sm-4 col-md-3 mb30 alpha">
			  		  <a href="<?php echo $url; ?>/project_detail.php?project_no=<?php echo $project_no; ?>">
		  			  <div class="mall-05">
		  				    <p class="mb10"><img src="<?php echo $url; ?>/upload/re_<?php echo $project_main_img_path; ?>" class="img-responsive" /></p>
		  				    <h3 class="title"><?php echo $project_title; ?></h3>
		  				    <p class="title"><?php echo $project_description; ?></p>
		  				    <p class="fcolorgray day"><?php echo $project_datetime; ?></p>
		  			  </div>
		  			  </a>
		  			  <span class="new" data-reactid=".2b02jlazx1c.0.0.2">NEW</span>
		  			  <span class="category-label_project"><a class="project_item cate" href="/category/item" data-id="home" data-label="ITEM">販売</a></span>
		  		  </div>
		  		  <?php
		  		  if($i == 4 OR $i == 8) { ?>
		  		  </div>
		  		  <?php } ?>
		  		  <?php
		  		  $i++;
		  		  } ?>
		  	  </div>
		    </section>
		    <section id ="project_list_fm">
		  		  <h2><i class="fa fa-check" aria-hidden="true"></i> 活躍中のフードメッセンジャー</h2>
		  		  <div class="swiper-container3">
		  			 <div class="swiper-wrapper">
		  			 <?php
		  			 $i = 1;
		  			 while( $row_fm = $result_fm->fetch_assoc()) {
			  			 $fm_no = $row_fm['no'];
			  			 $fm_name = $row_fm['name'];
			  			 $fm_img_sub_prof_path = $row_fm['img_sub_prof_path'];			  			 
		  			 ?>
		  			 <div class="swiper-slide alpha">
		  			  <a href="prof.php?no=<?php echo $fm_no; ?>">
		  			      <p class="mb10"><img src="upload/<?php echo $fm_img_sub_prof_path; ?>" alt="" class="img-circle center-block" width="100px"></p>
		  			      <p class="fcolorgray text-center"><?php echo $fm_name; ?></p>
		  			  </a>
		  			 </div>
		  			 <?php
		  			 $i++;
		  			 } ?>
		  			 </div>
		  		  </div>
		    </section>
		    <section id ="project_list_company">
		  		  <h2><i class="fa fa-check" aria-hidden="true"></i> こんな企業が参加しています。</h2>
		  		  <div class="swiper-container2">
		  			 <div class="swiper-wrapper">
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
		  			  </div>
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
		  			  </div>
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
		  			  </div>
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
		  			  </div>
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
		  			  </div>
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
		  			  </div>
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
		  			  </div>
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
		  			  </div>
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
		  			  </div>
		  			   <div class="swiper-slide alpha">
		  			    <a href="project_detail.php">
		  				    <p class="mb10"><img src="upload/cyberagent.png" alt="" class="img-responsive" width="140px"></p>
		  				</a>
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
	
	<script src="js/swiper.min.js"></script>
  	<!-- Swiper JS トップメイン-->
	<script>
	var mySwiper = new Swiper ('.swiper-container', {
	  loop: true,
	  slidesPerView: 2,
	  spaceBetween: 10,
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
	<!-- Swiper JS カテゴリ部分-->
	<script>
	var mySwiper = new Swiper ('.swiper-container2', {
	  loop: true,
	  slidesPerView: 8,
	  spaceBetween: 0,
	  centeredSlides : true,
	  breakpoints: {
	    767: {
		  width : 1120,
	      slidesPerView: 6,
	      spaceBetween: 0
	    }
	  }
	})
	</script>
	<!-- Swiper JS カテゴリ部分-->
	<script>
	var mySwiper = new Swiper ('.swiper-container3', {
	  loop: true,
	  slidesPerView: 8,
	  spaceBetween: 0,
	  centeredSlides : true,
	  breakpoints: {
	    767: {
		  width : 767,
	      slidesPerView: 6,
	      spaceBetween: 0
	    }
	  }
	})
	</script>
	
	<!--jquery-->
	<?php 
	include('jquery.php');?>
    <!--jquery-->
    
    <!--ajax　プロジェクト検索-project.php-->
    

	<script>
	$(function(){
	    $("#searchform").change(function(){
		    $("#loading").html("<img src='img/gif-load.gif'/>");//ローディング
		    
	        //選択されたチェックボックスの値を配列に保存
	        var checks=[];
	        $("[name='check[]']:checked").each(function(){
	            checks.push(this.value);
	        });
	        $.ajax({
	            type: "POST",
	            url: "search_project.php",
	            data: {
	                "checks":checks
	            },
	            success : function(data, dataType) {
		            //HTMLファイル内の該当箇所にレスポンスデータを追加します。
		            $('#res').html(data);
		            
		            $("#loading").empty();//ローディングけす
		            
		        },

		        //処理がエラーであれば
		        error : function() {
		            alert('通信エラー');
		        }
	        });
	        return false;  //submitイベントハンドラにfalseを返し，action処理をキャンセル
	    });
	});
		
	</script>

    	
  </body>
</html>