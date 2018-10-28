<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>年号の変換 </title>
</head>
<body>
<?php
$waist = $_POST["waist"];
$height = $_POST["height"];
if(($waist / $height) >= 0.5) {
  echo "隠れ肥満です";
} else {
  echo "隠れ肥満ではありません";
}
?>
</body>
</html>