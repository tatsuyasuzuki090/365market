<?php

if( isset($_SESSION['user']) != "") {
//アクティビティ情報情報10件取得
$query_activity = "SELECT * FROM news WHERE  (user_no = ".$_SESSION['user']." OR user_no = 0 ) AND category >= 100 ORDER BY datetime DESC LIMIT 10";	
$result_activity = $mysqli->query($query_activity);
//ニュース情報情報10件取得
$query_news = "SELECT * FROM news WHERE category < 100 ORDER BY datetime DESC LIMIT 10";	
$result_news = $mysqli->query($query_news);

//全お知らせ件数
$query_news_count = "SELECT COUNT(*) as news_cnt FROM news WHERE category < 100";
$result_news_count = $mysqli->query($query_news_count);
$row_news_count = $result_news_count->fetch_assoc();
$news_cnt = $row_news_count['news_cnt'];
//既読済みお知らせ件数
$query_news_read_count = "SELECT COUNT(*) as news_read_cnt FROM news_read WHERE user_no = ".$_SESSION['user']." AND category < 100";
$result_news_read_count = $mysqli->query($query_news_read_count);
$row_news_read_count = $result_news_read_count->fetch_assoc();
$news_read_cnt = $row_news_read_count['news_read_cnt'];
//未読件数
$noread = $news_cnt - $news_read_cnt;

//全アクティビティ件数
$query_activity_count = "SELECT COUNT(*) as news_cnt FROM news WHERE ( user_no = ".$_SESSION['user']." OR user_no = 0 ) AND category >= 100";
$result_activity_count = $mysqli->query($query_activity_count);
$row_activity_count = $result_activity_count->fetch_assoc();
$activity_cnt = $row_activity_count['news_cnt'];
//既読済みアクティビティ件数
$query_activity_read_count = "SELECT COUNT(*) as news_read_cnt FROM news_read WHERE user_no = ".$_SESSION['user']." AND category >= 100";
$result_activity_read_count = $mysqli->query($query_activity_read_count);
$row_activity_read_count = $result_activity_read_count->fetch_assoc();
$activity_read_cnt = $row_activity_read_count['news_read_cnt'];
//未読件数
$activity_noread = $activity_cnt - $activity_read_cnt;

//メッセージ情報情報6件取得
$query_message = "SELECT * FROM message WHERE receive_no = ".$_SESSION['user']." ORDER BY datetime DESC LIMIT 6";	
$result_message = $mysqli->query($query_message);
//全メッセージ件数
$query_message_count = "SELECT COUNT(*) as message_cnt FROM message WHERE receive_no = ".$_SESSION['user']."";
$result_message_count = $mysqli->query($query_message_count);
$row_message_count = $result_message_count->fetch_assoc();
$message_cnt = $row_message_count['message_cnt'];
//既読済みメッセージ件数
$query_message_read_count = "SELECT COUNT(*) as message_read_cnt FROM message_read WHERE user_no = ".$_SESSION['user']."";
$result_message_read_count = $mysqli->query($query_message_read_count);
$row_message_read_count = $result_message_read_count->fetch_assoc();
$message_read_cnt = $row_message_read_count['message_read_cnt'];
//未読件数
$noread_message = $message_cnt - $message_read_cnt; 
} ?>


  <?php
  if( isset($_SESSION['user']) ) { ?>
  <!-- 横スライドマイメニュー -->
  <!-- サイドオープン時メインコンテンツを覆う -->
  <div class="overlay" id="js__overlay"></div>
  <?php
  if( $mode == 1 ) { ?>
  <!-- サイドメニュー -->
  <nav class="side-menu" id="side_mymenu">
	  <div class="mytop">
		  <h2><a href="prof.php"><?php echo $name; ?><span class="fs80">さん</span></a></h2>
		  <p><a href="user_config_prof.php">マイページへ　<i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
	  </div>
	<ul class="mymenu sc-none">
      <li><a href="user_activity.php"><i class="fa fa-bell" aria-hidden="true"></i> アクティビティ<?php if($activity_noread != 0) { ?><span class="badge"><?php echo $activity_noread; ?></span><?php } ?></a></li>
      <li><a href="user_news.php"><i class="fa fa-file-text" aria-hidden="true"></i> ニュース情報<?php if($noread != 0) { ?><span class="badge"><?php echo $noread; ?></span><?php } ?></a></li>
      <li><a href="user_fm_message_list.php"><i class="fa fa-envelope" aria-hidden="true"></i> メッセージのお知らせ<span class="badge"><?php echo $noread_message; ?></span></a></li>
    </ul>
    <ul class="mymenu">
      <li><a href="user_fm_message_list.php"><i class="fa fa-commenting-o" aria-hidden="true"></i> メッセージ</a></li>
      <li><a href="user_fm_favorite.php"><i class="fa fa-heart" aria-hidden="true"></i> お気に入りの案件</a></li>
      <li><a href="user_fm_progress_apply.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> 案件の進捗状況管理</a></li>
    </ul>
    <ul class="mymenu">
      <li><a href="user_fm_team.php"><i class="fa fa-users" aria-hidden="true"></i> マイチーム</a></li>
      <li><a href="user_pay_list.php"><i class="fa fa-jpy" aria-hidden="true"></i> 報酬管理</a></li>
    </ul>
    <ul class="mymenu">
      <li><a href="logout.php?logout"><i class="fa fa-sign-out" aria-hidden="true"></i> ログアウト</a></li>
    </ul>
    <ul class="mymenu">
      <li><a href="user_config_prof.php"><i class="fa fa-cog" aria-hidden="true"></i> 各種設定</a></li>
    </ul>
    <ul class="mymenu">
      <li><a href="user_identity.php"><i class="fa fa-id-card-o" aria-hidden="true"></i> 各種認証申請</a></li>
    </ul>
  </nav>
  <!-- 開閉用ボタン -->
  <div class="side-menu-btn" id="js__sideMenuBtn"><img src="upload/<?php echo $img_sub_prof_path; ?>" alt="" class="img-responsive img-circle"></div>
  <!-- 横スライドマイメニュー -->
  <?php
  } ?>
  <?php
  if( $mode == 2 ) { ?>
  <!-- サイドメニュー -->
  <nav class="side-menu" id="side_mymenu">
	  <div class="mytop">
		  <h2><a href="prof.php"><?php echo $name; ?><span class="fs80">さん</span></a></h2>
		  <p><a href="user_config_prof.php">1マイページへ　<i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>
	  </div>
	<ul class="mymenu sc-none">
      <li><a href="user_activity.php"><i class="fa fa-bell" aria-hidden="true"></i> アクティビティ<?php if($activity_noread != 0) { ?><span class="badge"><?php echo $activity_noread; ?></span><?php } ?></a></li>
      <li><a href="user_news.php"><i class="fa fa-file-text" aria-hidden="true"></i> ニュース情報<?php if($noread != 0) { ?><span class="badge"><?php echo $noread; ?></span><?php } ?></a></li>
      <li><a href="user_fm_message_list.php"><i class="fa fa-envelope" aria-hidden="true"></i> メッセージのお知らせ<span class="badge"><?php echo $noread_message; ?></span></a></li>
    </ul>
    <ul class="mymenu">
      <li><a href="user_fm_message_list.php"><i class="fa fa-commenting-o" aria-hidden="true"></i> メッセージ</a></li>
      <li><a href="co_favorite.php"><i class="fa fa-heart" aria-hidden="true"></i> お気に入りのFM</a></li>
      <li><a href="co_progress_new.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> 案件管理</a></li>
    </ul>
    <ul class="mymenu">
      <li><a href="user_pay_list.php"><i class="fa fa-jpy" aria-hidden="true"></i> 支払い管理</a></li>
    </ul>
    <ul class="mymenu">
      <li><a href="logout.php?logout"><i class="fa fa-sign-out" aria-hidden="true"></i> ログアウト</a></li>
    </ul>
    <ul class="mymenu">
      <li><a href="user_config_prof.php"><i class="fa fa-cog" aria-hidden="true"></i> 各種設定</a></li>
    </ul>
  </nav>
  <!-- 開閉用ボタン -->
  <div class="side-menu-btn" id="js__sideMenuBtn"><img src="upload/<?php echo $img_sub_prof_path; ?>" alt="" class="img-responsive img-circle"></div>
  <!-- 横スライドマイメニュー -->
  <?php
  } ?>
  
  
  
  <?php
  } ?>