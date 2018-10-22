<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title> </title>
</head>
<body>
<?php
 $var = array(
   0 => "Bump",
   1 => "Of",
   2 => "Chicken"
 );

 $num_counts = count($var);
 for($i=1; $i<=3; $i++){
  $idx = rand(0, $num_counts-1);
  echo $var[$idx] . " ";
 }
?>
</body>
</html>