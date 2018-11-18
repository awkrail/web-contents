<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ジャニーズ・データベース</title>
</head>
<body>
<?php
//入力データの受取
$word = $_POST["word"];
//本当はここで入力データのチェックをするべきだが省略
//入力データの表示
echo "あなたが入力したデータは以下のとおりです．<br>";
echo "名前：$word <br>";
echo "<hr>";
//DB接続用パラメータ
$host = 'localhost'; //データベースが動作するホスト
$user = '****'; //ユーザ名(各自のものに変更)
$pass = '****'; //パスワード(各自のものに変更)
$dbname = '*****';//データベース名(各自のものに変更)
// mysqliクラスのオブジェクトを作成
$mysqli = new mysqli($host,$user,$pass,$dbname);
if ($mysqli->connect_error) { //接続エラーになった場合
    echo $mysqli->connect_error; //エラーの内容を表示
    exit();//終了
} else {
    echo "You are connected to the DB successfully.<br>"; //正しく接続できたことを確認
    $mysqli->set_charset("utf8"); //文字コードを設定
}
$sql = "insert into words (word) values ('$word')"; //実行するSQLを文字列として記述
$result = $mysqli->query($sql); //SQL文の実行
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
?>
</body>
</html>