<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title> </title>
</head>
<body>
<?php
// class prefectureの定義
class Prefecture {
  public $name;
  public $population;
  public $size;
  public $seat;

  public function show_abstract() {
    echo $name . "県の県庁所在地は" . $seat . "市です. 人口密度は" . $population/$size . "(人/平方キロメートル)です";
  }
}

$fukuoka = new Prefecture();
$fukuoka->name = "福岡";
$fukuoka->population = 5108022;
$fukuoka->size = 4986.40;
$fukuoka->seat = "福岡市";
$fukuoka->show_abstract();

$kumamoto = new Prefecture();
$kumamoto->name = "熊本";
$kumamoto->population = 1775337;
$kumamoto->size = 7409.35;
$kumamoto->seat = "熊本市";
$kumamoto->show_abstract();

$saga = new Prefecture();
$saga->name = "佐賀";
$saga->population = 828803;
$saga->size = 2440.68;
$saga->seat = "佐賀市";
$saga->show_abstract();



?>
</body>
</html>