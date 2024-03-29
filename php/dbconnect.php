<?php

//DBに接続
$host = "localhost"; //MySQLがインストールされてるコンピュータ
$dbname = "food_db"; //使用するDB
$charset = "utf8mb4"; //文字コード
$user = 'root'; //MySQLにログインするユーザー名
$password='';//ユーザーのパスワード
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //SQLでエラーが表示された場合、画面にエラーが出力される
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //DBから取得したデータを連想配列の形式で取得する
    PDO::ATTR_EMULATE_PREPARES   => false, //SQLインジェクション対策
];

//DBへの接続設定
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
// $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock";  // phpからdb接続テスト用
try {
    //DBへ接続
    $dbh = new PDO($dsn, $user, $password, $options);
} catch (\PDOException $e) {
    var_dump($e->getMessage());
    exit;
}