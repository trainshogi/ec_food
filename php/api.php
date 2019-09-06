<?php


function get_ingredients($cook_name){
    require_once("./function.php");
    $ingredients = extract_ingredients($cook_name);
    // $ingredients = array('りんご', '肉', '魚');
    $info = array();
    foreach ($ingredients as $ing){
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
exit();