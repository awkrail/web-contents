<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>年号の変換 </title>
</head>
<body>
<h2>藤原連鎖</h2>
BUMP OF CHICKENっぽいことを言ってくれるマルコフ連鎖です。
<form action="hujihara_chain.php" method="post">
    <input type="submit" value="生成する">
</from>
<?php

class FujiharaChain {
  public $dictionary;
  public $json;
  public $arr;

  // コンストラクタ
  public function __construct() {
    $this->dictionary = file_get_contents("./hujihara.json");
    $this->json = mb_convert_encoding($this->dictionary, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $this->arr = json_decode($this->json, true);
    $this->sentences = array();
  }

  // 生成部分
  public function generate($limit) {
      $keys = array_keys($this->arr);
      $start = array_rand($keys, $num=1);

      $end_cnt = 0;
      $cnt = 0;
      #$word_list = explode(" ", $keys[$start]);
      # $word_list = explode(" ", "人間 という");
      $word_list = explode(" ", $keys[$start]);

      while($limit !== $end_cnt) {
        // 検索する文字列を計算
        $stract_words = array_slice($word_list, $cnt, $cnt+2);
        $temp_word = implode(" ", $stract_words);
        
        if(!array_search($temp_word, $keys)) {
          $temp_word = array_rand($keys, 1);
        }

        // 次の語句を選択する
        $word_idx = array_rand($this->arr[$temp_word], 1);
        $word = $this->arr[$temp_word][$word_idx];
        array_push($word_list, $word);

        // "\n"が文字列に含まれるか?
        if(strlen($word) === 1) {
          $end_cnt = $end_cnt + 1;
        }

        if(is_null($word)) {
          $end_cnt = $end_cnt + 1;
        }

        $cnt = $cnt + 1;
      }

      array_push($this->sentences, implode($word_list));
  }

  public function print_sentences() {
    echo "<br />";
    for($g = 0; $g <= 10; $g++) {
      echo "<br />";
      echo $this->sentences[$g];
    }
  }

  public function debug_print() {
    $keys = array_keys($this->arr);
    echo "Hello";
    echo "<pre>";
    var_dump($keys);
    echo "</pre>";
  }
}

$fujihara = new FujiharaChain();

for($gi=0; $gi<10; $gi++) {
  $fujihara->generate(10);
}

$fujihara->print_sentences();

?>
</body>
</html>