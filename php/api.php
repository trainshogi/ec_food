<?php


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

    echo '料理名:'.$cook_name."\n";

    $info = array();
    foreach ($ingredients as $ing){
        echo $ing.'をAPIから検索'."\n";
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
exit();