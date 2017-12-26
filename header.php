


	  <section id="header">
		  <nav class="head fixheader">
			  <div class="container-fluid">
				  <div class="logo clearfix" id="header-logo">
					  <a href="index.php"><img src="image/365logo.svg" alt="365market"></a>
				  </div>
				  <div class="login-user">
				  	<?php
					  if( isset($_SESSION['user']) ) { ?>
					  <ul class="userul">
						  <li class="prof-img" id="js__sideMenuBtn" ><a href="#"><img src="upload/<?php echo $img_sub_prof_path; ?>" alt="" class="img-responsive img-circle"></a></li>
						  <li class="prof-icon sp-none dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i><span class="caret"></span><span class="badge"><?php echo $noread_message; ?></span></a>
						  <ul class="dropdown-menu">
							  <li>メッセージ</li>
							  <li role="separator" class="divider"></li>
							  <?php if($noread_message != 0) { ?>
							  <?php
							  	while( $row_message = $result_message->fetch_assoc()) {
							  	$message_id = $row_message['id'];
							  	$message_text = $row_message['message_text'];
							  	$transmit_no = $row_message['transmit_no'];
							  	$datetime_message = $row_message['datetime'];
							  	//年月日変換
							  	$datetime_message = date("Y年m月d日G:i",strtotime($datetime_message));
							  	
							  	$query_name = "SELECT * FROM user WHERE no = '$transmit_no'";
							  	$result_name = $mysqli->query($query_name);
							  	$row_name = $result_name->fetch_assoc();
							  	$message_name = $row_name['name'];
							  	
							  	?>
						      <li><a href="user_fm_message.php?transmit_no=<?php echo $transmit_no; ?>"><?php echo $message_name; ?>（<?php echo $transmit_no; ?>）さんからメッセージを受信しました。<span><?php echo $datetime_message; ?></span></a></li>
						      <?php
							  } ?>
							  <?php } else { ?>
							  <li>メッセージはありません</li>
							  <?php } ?>
						      <li role="separator" class="divider"></li>
						      <li class="text-center fs80"><a href="user_fm_message_list.php" class="link">メッセージへ</a></li>
						    </ul>
						  </li>
						  <li class="prof-icon sp-none dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-text fa-fw" aria-hidden="true"></i><?php if($noread != 0) { ?><span class="badge"><?php echo $noread; ?></span><?php } ?><span class="caret"></span></a>
						    <ul class="dropdown-menu">
							  <li>ニュース</li>
							  <li role="separator" class="divider"></li>
							  <?php if($noread != 0) { ?>
							  <?php
								while( $row_news = $result_news->fetch_assoc()) {
								$news_id = $row_news['id'];
								$news_title = $row_news['news_title'];
								$news_text = $row_news['news_text'];
								$category = $row_news['category'];
								$datetime_news = $row_news['datetime'];
								//年月日変換
								$datetime_news = date("Y年m月d日G:i",strtotime($datetime_news));
								?>
						      <li><a href="<?php echo $url; ?>/user_activity_detail.php?id=<?php echo $news_id; ?>"><?php echo $news_title; ?><span><?php echo $datetime_news; ?></span></a></li>
						      <?php
							  } ?>
							  <?php } else { ?>
							  <li>ニュースはありません</li>
							  <?php } ?>
						      <li role="separator" class="divider"></li>
						      <li class="text-center fs80"><a href="user_news.php" class="link">ニュース一覧へ</a></li>
						    </ul>
						  </li>
						  <li class="prof-icon sp-none"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell fa-fw" aria-hidden="true"></i><?php if($activity_noread != 0) { ?><span class="badge"><?php echo $activity_noread; ?></span><?php } ?><span class="caret"></span></a>
						  <ul class="dropdown-menu dropdown">
							  <li>アクティビティ</li>
							  <li role="separator" class="divider"></li>
							  <?php if($activity_noread != 0) { ?>
							  <?php
								while( $row_activity = $result_activity->fetch_assoc()) {
								$activity_id = $row_activity['id'];
								$activity_title = $row_activity['news_title'];
								$activity_text = $row_activity['news_text'];
								$activity_category = $row_activity['category'];
								$activity_datetime_news = $row_activity['datetime'];
								//年月日変換
								$activity_datetime_news = date("Y年m月d日G:i",strtotime($activity_datetime_news));
								?>
						      <li><a href="<?php echo $url; ?>/user_activity_detail.php?id=<?php echo $activity_id; ?>"><?php echo $activity_title; ?><span><?php echo $activity_datetime_news; ?></span></a></li>
						      <?php
							  } ?>
							  <?php } else { ?>
							  <li>アクティビティはありません</li>
							  <?php } ?>

						      <li role="separator" class="divider"></li>
						      <li class="text-center fs80"><a href="user_activity.php" class="link">アクティビティ一覧へ</a></li>
						    </ul>
						  </li>
						  

					  </ul>
					  <?php
					  } else { ?>
					  <p><a href="login.php">ログイン／新規会員登録</a></p>
					  <?php
					  } ?>
				  </div>
			  </div>
			  <div class="menu-global clearfix" id="menu-global">
				  <ul>
					  <li><a href="post.php" title="プロジェクトを始める" id=""><i class="fa fa-clipboard" aria-hidden="true"></i> 記事を読む</a></li>
					  <li class="active"><a href="project.php" title="プロジェクトを探す" id=""><i class="fa fa-search" aria-hidden="true"></i> お仕事をさがす</a></li>
					  <li class="sp-none sc-none"><a href="event.php" title="イベントをさがす" id=""><i class="fa fa-calendar" aria-hidden="true"></i> イベントをさがす</a></li>
				  </ul>
			  </div>
		  </nav>
	  </section>