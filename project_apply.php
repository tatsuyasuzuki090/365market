<?php
session_start();
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
include_once './dbconnect.php';

//直訪はトップページへ
if(!isset($_POST['project_no'])) {
	header("Location: index.php");
}

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
$project_no = $_POST['project_no'];
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




//申し込み重複チェック
$query_double_booking = "SELECT * FROM project_apply WHERE project_no = '$project_no' AND fm_no = '$no'";	
$result_double_booking = $mysqli->query($query_double_booking);
$row_double_booking = $result_double_booking->fetch_assoc();
$apply_description = $row_double_booking['apply_description'];
$apply_money = $row_double_booking['apply_money'];
$apply_other = $row_double_booking['apply_other'];
$apply_datetime = $row_double_booking['datetime'];
$apply_status = $row_double_booking['apply_status'];
 
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

		  				<div class="company_name cf">
		  				  <p class="com_img"><a href="#"><img src="upload/<?php echo $client_img; ?>" alt="" class="img-responsive img-circle"></a></p>
		  				  <h2 class="com_name"><?php echo $client_name; ?></h2>
		  				  <p class="text-right fs80 fcolorgray"><?php echo $project_datetime; ?>更新</p>
		  			  </div>
		  		  </div>
		  	  </div>
		    </section>
		    




		    <section id="project_detal_description">
			    <div class="container">
				    <div class="col-xs-12">
					    <div class="yamenu-sp">
 
							<div class="yamenu">
							<p>応募入力</p>
							</div>
							 
							<div class="yamenu">
							<p><span>内容確認</span></p>
							</div>
							 
							<div class="yamenu">
							<p><span>送信完了</span></p>
							</div>
						 
						</div>
				    </div>
			    </div>
			    
		  	  <div class="container-fluid">
		  		  <div class="container cf">
		  			  <div class="col-xs-12 col-sm-8">
		  			  <?php
		  			  if(isset($row_double_booking) AND $apply_status != 100){ ?>
		  			  <h2><?php echo $project_title; ?></h2>
		  			  <div class="jumbotron">
		  			        <div class="row">
		  			    	    <div class="col-sm-12" style="padding: 3px;">
		  			    	      <p>すでに応募込み済みです</p>
		  			    	    </div>
		  			    	</div>
		  			  </div>			  			  
		  			  <?php
					  } elseif(!isset($row_double_booking) OR (isset($row_double_booking) AND $apply_status == 100)){ ?>
					  <form method="post" action="project_apply_confirm.php">
		  				  <div class="description_left">
		  					  <div class="description_part">
			  					  		    
		  						  <h2>提案名義</h2>
		  						  <div class="pall-0202020">
			  						  <select class="form-control input-sm" id="apply_name">
									      <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
									    </select>
		  						  </div>
		  					  </div>
		  					  <div class="description_part">
		  						  <h2>提案</h2>
		  							<textarea class="form-control  input-sm" rows="20" id="apply_description" name="apply_description" placeholder="ご提案をどうぞ" value="<?php if(isset($apply_description)) { echo $apply_description; } ?>">
<?php if(isset($apply_description)) { echo $apply_description; } else { ?>
冒頭に、はじめましてなどの挨拶をしましょう。			
								
■経歴								
具体的な経歴、職歴などをできる限り詳しく記入しましょう。	
								
								
■実績・得意							
過去の実績を、できる限り詳しく、数多く記入しましょう。		
								
								
■自己PRポイント						
その他クライアントに伝えたいことを記入しましょう
<?php
}
?>	
									    </textarea>
									    <p class="comment">※ 提案内容に連絡先としてメールアドレスやURLを記述することは禁止です。</p>
									    <p class="comment">※ プロジェクト方式では見積りのみ提案できます。デザイン等をこの時点で行うことは禁止です。</p>
		  					  </div>
		  					  <div class="description_part">
		  						  <h2>希望報酬</h2>
		  							<input type="text" class="form-control input-sm" id="apply_money" name="apply_money" value="<?php if(isset($apply_money)) { echo $apply_money; } ?>" placeholder="希望報酬" size="30">
		  							
		  					  </div>
		  					  <div class="description_part">
		  						  <h2>その他</h2>
		  							<textarea class="form-control  input-sm" rows="3" id="apply_other" name="apply_other" value="<?php if(isset($apply_other)) { echo $apply_other; } ?>" placeholder="その他ありましたらこちらにご入力ください"><?php if(isset($apply_other)) { echo $apply_other; } ?></textarea>
		  							
		  					  </div>
		  					  
						    </div>
						    
						 
						   
						<?php
						} ?> 
						    
		  			  </div>
		  			  <div class="col-xs-12 col-sm-4">
		  				  <div class="description_right">
		  					  <div class="apply_add">
		  						<p>ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
		  					  </div>
		  					  <div class="apply">
		  					  </div>
		  					  <div class="apply">
		  					  </div>
		  				  </div>
		  			  </div>
		  		  </div>
		  	  </div>
		    </section>
		</div>
	
	  
		  
		<!--フッター-->
		<?php 
		include('footer.php');?>
	    <!--フッター--> 
	    
	  <div id="submit_footer" class="">
		  <div class="container">
			  <div class="col-xs-12">
				  <div class="pall-12">
					  <p class="text-center">
						  <button type="submit" class="btn btn-success form-group" name="apply_reserve" id="apply_reserve">下書き保存する</button>
						  			<input type="hidden" name="project_no" id="project_no" value="<?php echo $project_no; ?>">
									<input type="hidden" name="project_title" id="project_title" value="<?php echo $project_title; ?>">
									<input type="hidden" name="client_no" id="client_no" value="<?php echo $client_no; ?>">
									<input type="hidden" name="apply_status" id="apply_status" value="<?php echo $apply_status; ?>">
						  <button type="button" class="btn btn-default form-group" onclick="history.back()">戻　　る</button> 
						  <button type="submit" class="btn btn-success form-group" name="apply_submit" id="apply_submit">入力を確認する</button>
						 			<input type="hidden" name="project_no" id="project_no" value="<?php echo $project_no; ?>">
									<input type="hidden" name="project_title" id="project_title" value="<?php echo $project_title; ?>">
									<input type="hidden" name="client_no" id="client_no" value="<?php echo $client_no; ?>">
									<input type="hidden" name="apply_status" id="apply_status" value="<?php echo $apply_status; ?>">
					  </p>
					  
				  </div>
			  </div>
		  </div>
	  </div>
	  </form>
	  
	</div>
	
	<!--jquery-->
	<?php 
	include('jquery.php');?>
    <!--jquery--> 	
    
    
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