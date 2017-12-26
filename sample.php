<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>カンマ区切りの文字列を分割して配列にしたい</title>
</head>
<body>
<?php
$data = 'terurou taro jiro';
$separator = ' ';

echo '<p>対象の文字列： ' . $data . '</p>';
echo '<p>区切り文字： ' . $separator . '</p>';

echo '<p>分割した結果：';
print_r(explode($separator, $data));
echo '</p>';
?>
</body>
</html>