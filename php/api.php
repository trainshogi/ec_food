<?php

function get_shopids($shop_code){
    require_once('dbconnect.php');
    $stmt = $dbh->prepare('SELECT
                          shop_id
                          FROM
                          shops
                          WHERE
                          shop_code = ?');
    $stmt->execute([$shop_code]);//?を変数に置き換えてSQLを実行

    $result = $stmt->fetchAll();
    $result_array = array_map('reset', $result);
    print_r($result_array);
    return $result_array;
}

function get_ingredients($query){
    require_once("./function.php");

    // もしURLならAPIを直接叩いて食材を取得
    $urls = array('https://recipe.rakuten.co.jp/recipe',);
    
    // 初期化
    $ingredients = null;
    $cook_name = null;

    foreach ($urls as $u){
        if (strpos($query,$u) !== false){
            $tmp = scraping_ingredients($query);
            $ingredients = $tmp[0];
            $cook_name = $tmp[1];
        }
    }
    if ($ingredients == null){
        $ingredients = extract_ingredients($query);
        $cook_name = $query;
    }

    // echo '料理名:'.$cook_name."\n";

    $info = array();
    foreach ($ingredients as $ing){
        // echo $ing.'をAPIから検索'."\n";
        $info[$ing] = get_items($ing);
    }

    $result = array(
        "ingredients" => $ingredients,
        "cook_name" => $cook_name,
        "info" => $info,
    );

    // 連想配列($array)をJSONに変換(エンコード)する
    $json = json_encode($result, JSON_UNESCAPED_UNICODE);

    return $json;
}

echo get_ingredients($_POST['cook_name']);
// echo get_ingredients('https://recipe.rakuten.co.jp/recipe/1460015382/');
// echo get_ingredients('肉じゃが');
// echo get_shopids("ショップ１");
exit();