<?php

function get_doc($url){
    require_once("./phpQuery-onefile.php");
    $opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));
    $context = stream_context_create($opts);
    $html = file_get_contents($url, FALSE, $context);
    $doc = phpQuery::newDocument($html);
    return $doc;
}

function scraping_ingredients($url){
    /*楽天レシピのurlをもらったら食材を返す*/
    $doc = get_doc($url);

    // レシピ名の取得
    $title = preg_split("/レシピ・作り方/", $doc["title"]->text())[0];
    
    // 取得した食材を正規表現によりリスト化
    $tmp_ingredients = preg_split("/\n|。|、|・|( |　)+/", $doc[".materialBox"][".name"]->text());
    
    // 整形
    // TODO: 量の取得
    $ingredients = array();
    foreach($tmp_ingredients as $ing){
        // 日本語のみの抽出
        mb_regex_encoding("UTF-8");
        $ing = preg_replace("/[^ぁ-んァ-ンー一-龠\r]+/u",'' ,$ing);
        
        if ($ing != ""){
            $ingredients[] = mb_convert_encoding($ing, "UTF-8");
        }
    }

    return array($ingredients, $title);

}


function get_shopid($shop_code){
    require 'dbconnect.php';
    $stmt = $dbh->prepare('SELECT shop_id FROM shops WHERE shop_code = ?');
    $stmt->execute([$shop_code]);  // ?を変数に置き換えてSQLを実行

    $result = $stmt->fetchAll();
    $result_array = array_map('reset', $result);
    // print_r($result_array);
    if (empty($result_array)){
        return array(0);
    }
    return $result_array;
}


function get_items($keyword){
    // ベースとなるリクエストURL
    $baseurl = 'https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706';
    // リクエストのパラメータ作成
    $params = array();
    $params['applicationId'] = '1083631531973280170'; // アプリID
    $params['keyword'] = urlencode_rfc3986($keyword); // 任意のキーワード。※文字コードは UTF-8
    $params['hits'] = 10;
    // $params['sort'] = urlencode_rfc3986('+itemPrice'); // ソートの方法。※文字コードは UTF-8
    // NOTE: 必要があればジャンルで絞る
    // $params['genreId'] = '100227';

    $canonical_string='';

    foreach($params as $k => $v) {
        $canonical_string .= '&' . $k . '=' . $v;
    }
    // 先頭の'&'を除去
    $canonical_string = substr($canonical_string, 1);

    // リクエストURL を作成
    $url = $baseurl . '?' . $canonical_string;

    // XMLをオブジェクトに代入
    $rakuten_json=json_decode(@file_get_contents($url, true));

    $items = array();
    foreach($rakuten_json->Items as $item) {

        $items[] = array(
                        'itemName' => (string)$item->Item->itemName,
                        'itemUrl' => (string)$item->Item->itemUrl,
                        'itemCode' => (string)$item->Item->itemCode,
                        'smallImageUrls' => isset($item->Item->smallImageUrls[0]->imageUrl) ? (string)$item->Item->smallImageUrls[0]->imageUrl : '',
                        'mediumImageUrls' => isset($item->Item->mediumImageUrls[0]->imageUrl) ? (string)$item->Item->mediumImageUrls[0]->imageUrl : '',
                        'itemPrice' => (string)$item->Item->itemPrice,
                        'shopName' => (string)$item->Item->shopName,
                        'shopUrl' => (string)$item->Item->shopUrl,
                        'shopCode' => (string)$item->Item->shopCode,
                        'shopId' =>  (integer)get_shopid((string)$item->Item->shopCode)[0],
                        'reviewCount' => (float)$item->Item->reviewCount,
                        'reviewAverage' => (float)$item->Item->reviewAverage,
                        'pointRate' => (float)$item->Item->pointRate,
                        'genreId' => (string)$item->Item->genreId,
                        'tagIds' => $item->Item->tagIds,
                        'startTime' => $item->Item->startTime,
                        'endTime' => $item->Item->endTime,
                        );
    }
    return $items;
}

function extract_ingredients($dish_name) {
    require_once('dbconnect.php');
    $stmt = $dbh->prepare('SELECT
                          ingredient_name
                          FROM
                          ingredients
                          JOIN
                          ingredients_to_dishes
                          ON
                          ingredients.ingredient_id = ingredients_to_dishes.ingredient_id
                          JOIN
                          dishes
                          ON
                          ingredients_to_dishes.dish_id = dishes.dish_id
                          WHERE
                          dishes.dish_name = ?');
    $stmt->execute([$dish_name]);//?を変数に置き換えてSQLを実行

    $result = $stmt->fetchAll();
    $result_array = array_map('reset', $result);
    // print_r($result_array);
    return $result_array;
}


// RFC3986 形式で URL エンコードする関数
function urlencode_rfc3986($str) {
    return str_replace('%7E', '~', rawurlencode($str));
}