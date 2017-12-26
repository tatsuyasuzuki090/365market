<?php
define("STRETCH_COUNT", 1000);

//CSRF トークン作成
function get_csrf_token() {
  $TOKEN_LENGTH = 16;//16*2=32バイト
  $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
  return bin2hex($bytes);
}

//関数設置場所
//以下cron
//project_1hour.php


//パスワードをソルト＋ストレッチング 
function strechedPassword($salt, $password){
    $hash_pass = "";
    for ($i = 0; $i < STRETCH_COUNT; $i++){
        $hash_pass  = hash("sha256", ($hash_pass . $salt . $password));
     }
     return $hash_pass;	
}
//ソルトを作成
function get_salt() {
  $TOKEN_LENGTH = 4;//4*2=8byte
  $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
  return bin2hex($bytes);
}
//URL の一時パスワードを作成
function get_url_password() {
  $TOKEN_LENGTH = 16;//16*2=32byte
  $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
  return hash("sha256", $bytes);
}

//案件カテゴリ
function categry_project ( $categry_project ) {
//関数設置場所
//news_detail.php
//news.php
  if ( $categry_project == 1 ) { echo ("販売"); }
  if ( $categry_project == 2 ) { echo ("セミナー"); }
  if ( $categry_project == 3 ) { echo ("レシピ"); }
  if ( $categry_project == 4 ) { echo ("モニター"); }
}

//ニュースカテゴリ
function categry ( $category ) {
//関数設置場所
//news_detail.php
//news.php
  if ( $category == 1 ) { echo ("<span class=\"label label-primary\">お知らせ</span>"); }
  if ( $category == 2 ) { echo ("<span class=\"label label-success\">募　　集</span>"); }
  if ( $category == 3 ) { echo ("<span class=\"label label-info\">　P　R　</span>"); }
  if ( $category == 4 ) { echo ("<span class=\"label label-warning\">レポート</span>"); }
  if ( $category == 100 ) { echo ("<span class=\"label label-danger\">カテ100</span>"); }
  if ( $category == 101 ) { echo ("<span class=\"label label-danger\">カテ101</span>"); }
}

//案件ステータス
function co_status ( $co_status ) {
//関数設置場所
//co_progress_list.php
//以下admin
//project_list.php
  if ( $co_status == 0 ) { echo ("<span class=\"label label-success\">掲載中</span>"); }
  if ( $co_status == 1 ) { echo ("<span class=\"label label-warning\">停止中</span>"); }
  if ( $co_status == 2 ) { echo ("<span class=\"label color-graybg\">終　了</span>"); }
  if ( $co_status == 3 ) { echo ("<span class=\"label label-info\">募集前</span>"); }
//案件ステータス
//0:掲載中
//1:停止中
//2:終了
//3:募集前未公開
  //if ( $co_status == 0 ) { echo ("<button type=\"button\" class=\"btn btn-success btn-sm\">掲載中</button>"); }
  //if ( $co_status == 1 ) { echo ("<button type=\"button\" class=\"btn btn-warning btn-sm\">停止中</button>"); }
  //if ( $co_status == 2 ) { echo ("<button type=\"button\" class=\"btn bg-gray btn-sm txt-white\">終　了</button>"); }
  //if ( $co_status == 3 ) { echo ("<button type=\"button\" class=\"btn btn-default btn-sm\">未公開</button>"); }
}

//記事ステータス
function post_status ( $post_status ) {
//関数設置場所
//
//以下admin
//post_list.php
  if ( $post_status == 0 ) { echo ("<span class=\"label label-success\">公　開</span>"); }
  if ( $post_status == 1 ) { echo ("<span class=\"label label-warning\">未公開</span>"); }
  if ( $post_status == 2 ) { echo ("<span class=\"label color-graybg\">予　約</span>"); }
//案件ステータス
//0:公開
//1:未公開
//2:予約
}
//イベントステータス
function event_status ( $event_status ) {
//関数設置場所
//
//以下admin
//event_list.php
  if ( $event_status == 0 ) { echo ("<span class=\"label label-success\">公　開</span>"); }
  if ( $event_status == 1 ) { echo ("<span class=\"label label-warning\">未公開</span>"); }
//案件ステータス
//0:公開
//1:未公開
}
//応募ステータス
function apply_status ( $apply_status ) {
//関数設置場所
//co_progress_status.php
//fm_progress_apply.php
//fm_progress_ing.php
  if ( $apply_status == 0 ) { echo ("<span class=\"label label-success\">新規応募</span>"); }
  if ( $apply_status == 1 ) { echo ("<span class=\"label label-warning\">決　　定</span>"); }
  if ( $apply_status == 2 ) { echo ("<span class=\"label label-warning\">キャンセル</span>"); }
  if ( $apply_status == 3 ) { echo ("<span class=\"label label-warning\">辞　　退</span>"); }
  if ( $apply_status == 4 ) { echo ("<span class=\"label label-warning\">現場入り</span>"); }
  if ( $apply_status == 5 ) { echo ("<span class=\"label label-warning\">仕事完了</span>"); }
  if ( $apply_status == 6 ) { echo ("<span class=\"label label-warning\">完了承認</span>"); }
  if ( $apply_status == 7 ) { echo ("<span class=\"label label-warning\">決済待ち</span>"); }
  if ( $apply_status == 8 ) { echo ("<span class=\"label label-warning\">決済完了</span>"); }
  if ( $apply_status == 9 ) { echo ("<span class=\"label label-warning\">入金完了</span>"); }
  if ( $apply_status == 10 ) { echo ("<span class=\"label label-warning\">支払完了</span>"); }
  if ( $apply_status == 100 ) { echo ("<span class=\"label label-warning\">下書き中</span>"); }
//案件ステータス（apply_status）
//0:新規応募
//1:決定
//2:キャンセル
//3:辞退
//4:現場入り完了
//5:仕事完了
//6:完了承認
//7:決済待ち
//8:決済完了
//9:入金完了
//10:支払い完了
//100:下書き中
}


//資格ステータス
function license_status ( $license_status ) {
//関数設置場所
//
  if ( $license_status == 1 ) { echo ("管理栄養士"); }
  if ( $license_status == 2 ) { echo ("調理師"); }
  if ( $license_status == 3 ) { echo ("野菜ソムリエ"); }
  if ( $license_status == 4 ) { echo ("メンタルフードマイスター"); }
  if ( $license_status == 5 ) { echo ("フードスタイリスト"); }
}
//対応スキルステータス
function skill_status ( $skill_status ) {
//関数設置場所
//
  if ( $skill_status == 1 ) { echo ("モニター"); }
  if ( $skill_status == 2 ) { echo ("レシピ開発"); }
  if ( $skill_status == 3 ) { echo ("販売"); }
  if ( $skill_status == 4 ) { echo ("試食提供"); }
  if ( $skill_status == 5 ) { echo ("商品開発"); }
  if ( $skill_status == 6 ) { echo ("栄養計算"); }
  if ( $skill_status == 7 ) { echo ("社食作り"); }
  if ( $skill_status == 8 ) { echo ("セミナー"); }
  if ( $skill_status == 9 ) { echo ("料理教室"); }
  if ( $skill_status == 10 ) { echo ("食育イベント企画"); }
  if ( $skill_status == 11 ) { echo ("執筆"); }
  if ( $skill_status == 12 ) { echo ("ブログ紹介"); }
  if ( $skill_status == 13 ) { echo ("ウェブ制作"); }
  if ( $skill_status == 14 ) { echo ("ロゴ作成"); }
  if ( $skill_status == 15 ) { echo ("イベントスタッフ"); }
  if ( $skill_status == 16 ) { echo ("料理人派遣"); }
  if ( $skill_status == 17 ) { echo ("インストラクター"); }
  if ( $skill_status == 18 ) { echo ("農家紹介"); }
  if ( $skill_status == 19 ) { echo ("飲食店コンサルティング"); }
  if ( $skill_status == 20 ) { echo ("野菜装飾"); }
  if ( $skill_status == 21 ) { echo ("イベント司会"); }
  if ( $skill_status == 22 ) { echo ("撮影"); }
  if ( $skill_status == 23 ) { echo ("動画制作"); }
  if ( $skill_status == 24 ) { echo ("食材調達"); }
  if ( $skill_status == 25 ) { echo ("ワークショップ"); }
}
//エリアステータス
function area_status ( $area_status ) {
//関数設置場所
//
  if ( $area_status == 1 ) { echo ("北海道"); }
  if ( $area_status == 2 ) { echo ("青森県"); }
  if ( $area_status == 3 ) { echo ("岩手県"); }
  if ( $area_status == 4 ) { echo ("宮城県"); }
  if ( $area_status == 5 ) { echo ("秋田県"); }
  if ( $area_status == 6 ) { echo ("山形県"); }
  if ( $area_status == 7 ) { echo ("福島県"); }
  if ( $area_status == 8 ) { echo ("茨城県"); }
  if ( $area_status == 9 ) { echo ("栃木県"); }
  if ( $area_status == 10 ) { echo ("群馬県"); }
  if ( $area_status == 11 ) { echo ("埼玉県"); }
  if ( $area_status == 12 ) { echo ("千葉県"); }
  if ( $area_status == 13 ) { echo ("東京都"); }
  if ( $area_status == 14 ) { echo ("神奈川県"); }
  if ( $area_status == 15 ) { echo ("新潟県"); }
  if ( $area_status == 16 ) { echo ("富山県"); }
  if ( $area_status == 17 ) { echo ("石川県"); }
  if ( $area_status == 18 ) { echo ("福井県"); }
  if ( $area_status == 19 ) { echo ("山梨県"); }
  if ( $area_status == 20 ) { echo ("長野県"); }
  if ( $area_status == 21 ) { echo ("岐阜県"); }
  if ( $area_status == 22 ) { echo ("静岡県"); }
  if ( $area_status == 23 ) { echo ("愛知県"); }
  if ( $area_status == 24 ) { echo ("三重県"); }
  if ( $area_status == 25 ) { echo ("滋賀県"); }
  if ( $area_status == 26 ) { echo ("京都府"); }
  if ( $area_status == 27 ) { echo ("大阪府"); }
  if ( $area_status == 28 ) { echo ("兵庫県"); }
  if ( $area_status == 29 ) { echo ("奈良県"); }
  if ( $area_status == 30 ) { echo ("和歌山県"); }
  if ( $area_status == 31 ) { echo ("鳥取県"); }
  if ( $area_status == 32 ) { echo ("島根県"); }
  if ( $area_status == 33 ) { echo ("岡山県"); }
  if ( $area_status == 34 ) { echo ("徳島県"); }
  if ( $area_status == 35 ) { echo ("広島県"); }
  if ( $area_status == 36 ) { echo ("山口県"); }
  if ( $area_status == 37 ) { echo ("香川県"); }
  if ( $area_status == 38 ) { echo ("愛媛県"); }
  if ( $area_status == 39 ) { echo ("高知県"); }
  if ( $area_status == 40 ) { echo ("福岡県"); }
  if ( $area_status == 41 ) { echo ("佐賀県"); }
  if ( $area_status == 42 ) { echo ("長崎県"); }
  if ( $area_status == 43 ) { echo ("熊本県"); }
  if ( $area_status == 44 ) { echo ("大分県"); }
  if ( $area_status == 45 ) { echo ("宮崎県"); }
  if ( $area_status == 46 ) { echo ("鹿児島県"); }
  if ( $area_status == 47 ) { echo ("沖縄県"); }
}


//メール配信
function mail_send ($send, $send_user, $admin, $subject_title, $subject_title_user, $message_descrip, $message_user_descrip, $flag) {
//関数設置場所
//login.php
//final_report.php
//project_apply_complete.php
//co_progress_status.php

//add_comp.php
//user_config_mail.php
//以下admin
//fm.php
//fm_new.php
//以下cron
//post_reservation.php

//user_identity.php

   //取得したメールアドレス宛にメールを送信 */
   mb_language("japanese");
   mb_internal_encoding("utf-8");
   //メール送信 PEAR Mail
   require_once("Mail.php");
   require_once("Mail/mime.php");
   $params = array(
      "host" => "mail.recoro.net",
      "sendmail_args" => "f",
      "port" => 25,               // 送信ポート
      //"debug" => true,            // デバッグモード
      "auth" => true,             // SMTP認証を使用する
      "username" => "test",       // SMTPのユーザー名
      "password" => "cZRF2vw72"   // SMTPのパスワード
   ); 
   $mailObject = Mail::factory("smtp", $params);
   $to = $send;
   $to_user = $send_user;
   $admin_mail = $admin;
   $subject = $subject_title;
   $subject_user = $subject_title_user;
   $message = $message_descrip;
   $message_user = $message_user_descrip;
	 $headers = array(
	   "To" => $to,//メールヘッダー情報
	   "Reply-To" => $admin_mail,
	   "Return-Path" => $admin_mail,
	   "From" => $admin_mail,
	   "Subject" => mb_encode_mimeheader("$subject")
	 );
	 $message = mb_convert_encoding($message, "ISO-2022-JP", "auto");
	 $mailObject -> send($to, $headers, $message);
	 if($flag == 0){
		 $headers_user = array(
		   "To" => $to_user,//メールヘッダー情報
		   "Reply-To" => $admin_mail,
		   "Return-Path" => $admin_mail,
		   "From" => $admin_mail,
		   "Subject" => mb_encode_mimeheader("$subject_user")
		 );
		 $message_user = mb_convert_encoding($message_user, "ISO-2022-JP", "auto");
		 $mailObject -> send($to, $headers_user, $message_user);
	 }
   if(!$mailObject) {  //メール送信に失敗したら
     array_push($error,"メールが送信できませんでした。"); //エラー配列に値を代入   
    }
}

//htmlspecialchars変換
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

//Y年m月d日変換
function date_a($datetime) {
//関数設置場所
//news.php
//news_detail.php
//index.php
//以下admin
//post_list.php
  return date("Y年m月d日",strtotime($datetime));
}
//m月d日変換
function date_b($datetime) {
//関数設置場所
//post_list.php
  return date("m月d日H:i",strtotime($datetime));
}


//画像アップロード
//co_progress_edit.php
//co_progress_new.php
//削除済み


//画像アップロード
//user_config_prof.php
//user_fm_team_info.php
//co_progress_new.php
//co_progress_edit.php
function resizeImage($image,$new_width,$dir = ".",$re_width,$re_height) {
	list($width,$height,$type) = getimagesize($image["tmp_name"]);
	$new_height = round($height*$new_width/$width);
	$emp_img = imagecreatetruecolor($new_width,$new_height);
	switch($type){
		case IMAGETYPE_JPEG:
			$new_image = imagecreatefromjpeg($image["tmp_name"]);
			break;
		case IMAGETYPE_GIF:
			$new_image = imagecreatefromgif($image["tmp_name"]);
			break;
		case IMAGETYPE_PNG:
			imagealphablending($emp_img, false);
			imagesavealpha($emp_img, true);
			$new_image = imagecreatefrompng($image["tmp_name"]);
			break;
	}
	imagecopyresampled($emp_img,$new_image,0,0,0,0,$new_width,$new_height,$width,$height);
	$date = date("YmdHis");
	switch($type){
		case IMAGETYPE_JPEG:
			imagejpeg($emp_img,$dir."./upload/".$date.".jpg");
			$up_img = ($date.".jpg");
			break;
		case IMAGETYPE_GIF:
			$bgcolor = imagecolorallocatealpha($new_image,0,0,0,127);
			imagefill($emp_img, 0, 0, $bgcolor);
			imagecolortransparent($emp_img,$bgcolor);
			imagegif($emp_img,$dir."./upload/".$date.".gif");
			$up_img = ($date.".gif");
			break;
		case IMAGETYPE_PNG:
			imagepng($emp_img,$dir."./upload/".$date.".png");
			$up_img = ($date.".png");
			break;
	
	}
	imagedestroy($emp_img);
	imagedestroy($new_image);
	
	//$re_width$re_heightでリサイズ・トリミング1
	//re_○○.拡張子
	$baceImagePath = "./upload/".$up_img;
	//サムネイル画像保存先のパス（ファイル名）
	$saveImagePath = "./upload/re_".$up_img ;
	//インスタンスを生成
	$image = new Imagick($baceImagePath);
	//サムネイルを生成
	$image->cropThumbnailImage($re_width, $re_height);
	//サムネイルを保存
	$image->writeImage($saveImagePath);

	return $up_img;
}

//ファイル複数アップロード
//user_identity.php
function upload_file(){
	  $count = count($_FILES['uploadfile']['name']);
	  //print($count . '<br>');
	  for ($i=0; $i<$count; $i++) {
	    //print($_FILES['uploadfile']['name'][$i] . '<br>');
	    //print($_FILES['uploadfile']['tmp_name'][$i] . '<br>');
	    if (is_uploaded_file($_FILES["uploadfile"]["tmp_name"][$i])) {
		     $tmppath = $_FILES["uploadfile"]["tmp_name"][$i];
		     $path_parts = pathinfo($_FILES["uploadfile"]["name"][$i]);
			 $extension = $path_parts['extension'];
			 $file_name_hash = hash_file("sha1", $tmppath);
		    //$_FILES["uploadfile"]["name"][$i] = sha1(uniqid(mt_rand(),true));
		    //echo"<br/>";
		    //echo"$extension";
		    //echo"<br/>";
		    //echo"$file_name_hash";
		    //echo"<br/>";
		    //echo (($_FILES["uploadfile"]["name"][$i]));
		    //echo"<br/>";
		    $file_name[$i] = $file_name_hash . "." .$extension;

	      if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"][$i], "uploadfile/" . $file_name[$i])) {
	        chmod("uploadfile/" . $file_name[$i], 0644);
	        //echo"<br/>";
	        //echo($file_name[$i]);
	        //echo"<br/>";
	        //echo $_FILES["uploadfile"]["name"][$i] . "をアップロードしました。<br>";
	      } else {
	        //echo "ファイルをアップロードできません。<br>";
	      }
	    } else {
	      //echo "ファイルが選択されていません。<br>";
	    }
	  }
	  //print_r($file_name);

	
	return $file_name;
	
}
	
function project_select() {	
//プロジェクト一覧取り出し
$query_project_list = "SELECT * FROM project WHERE status = 0 ORDER BY datetime DESC";	
$result_project_list = $mysqli->query($query_project_list);
//案件ステータス
//0:掲載中
//1:停止中
//2:終了
//3:新規作成時
}
?>
