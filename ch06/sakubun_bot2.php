<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>作文bot</title>
</head>
<body>
<?php
$mysqli = new mysqli($host,$user,$pass,$dbname);
if ($mysqli->connect_error) { //接続エラーになった場合
    echo $mysqli->connect_error; //エラーの内容を表示
    exit();//終了
} else {
    echo "You are connected to the DB successfully.<br>"; //正しく接続できたことを確認
    $mysqli->set_charset("utf8"); //文字コードを設定
}
$sql = "select word from words"; //実行するSQLを文字列として記述
$result = $mysqli->query($sql); //SQL文の実行
// このsqlが配列かなんかで入ってるんじゃないかと期待
if ($result) { //SQL実行のエラーチェック
    echo "データの登録に成功しました<br>";
} else {
    echo "データの登録に登録に失敗しました<br>";
    echo "SQL文：$sql <br>";
    echo "エラー番号：$mysqli->errno <br>";
    echo "エラーメッセージ：$mysql->error <br>";
    exit();
}
// DB接続を閉じる
$mysqli->close();

// $resultから3つランダムに取り出すように書いてレンダリングすれば終わり
?>
</body>
</html>