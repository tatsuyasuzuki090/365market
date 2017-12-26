<?php
include_once './dbconnect.php';
//FMリスト表示
$fm_list_query = "SELECT * FROM user INNER JOIN prof ON user.no = prof.no JOIN fm ON prof.no = fm.no";	
$fm_list_result = $mysqli->query($fm_list_query);
while($fm_list_row = $fm_list_result->fetch_assoc()){
	$list[] = $fm_list_row['name'];
}
$words = array();
// 現在入力中の文字を取得
$term = (isset($_GET['term']) && is_string($_GET['term'])) ? $_GET['term'] : '';
// 部分一致で検索
foreach($list as $word){
    if(mb_stripos( $word, $term) !== FALSE){
        $words[] = $word;
    }   
}
header("Content-Type: application/json; charset=utf-8");
echo json_encode($words);
