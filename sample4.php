<?php
//入出力ファイル名
$input = "input.jpg";
$output = "output.jpg";

//圧縮率 ※JPEGの場合は1(高)〜100(低)まで指定可
$quality = 100;

//変換後画像の幅高さ
$resize_x = 1280;
$resize_y = 780;

//元画像の幅高さを取得
list($size_x, $size_y) = getimagesize($input);

//横幅の拡大(または縮小)率をもとめる
$ratio_x = $resize_x / $size_x;

//横幅の拡大(または縮小)率に合わせた場合の高さをもとめる
$tmp_resize_y = $size_y * $ratio_x;

//横幅の拡大(または縮小)率に合わせた高さから上下カットする高さをもとめる
$tmp_cutsize_y = ($tmp_resize_y - $resize_y) / 2;

//リサイズ
$cmd = sprintf(
    "convert -resize %dx%d! -quality %d %s %s"
    ,$resize_x
    ,$tmp_resize_y
    ,$quality
    ,$input_file
    ,$output_file
);
exec($cmd);

//縦で余分な分をカット(上)
$cmd = sprintf(
    "convert -crop %dx%d+%d+%d %s %s"
    ,$resize_x
    ,$tmp_resize_y - $tmp_cutsize_y
    ,0
    ,$tmp_cutsize_y
    ,$output_file
    ,$output_file
);
exec($cmd);

//縦で余分な分をカット(下)
$cmd = sprintf(
    "convert -crop %dx%d+%d-%d %s %s"
    ,$resize_x
    ,$resize_y
    ,0
    ,$tmp_cutsize_y
    ,$output_file
    ,$output_file
);
exec($cmd);
?>