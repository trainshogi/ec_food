<?php

function scraping_ingredients($url){
    /*楽天レシピのurlをもらったら食材を返す*/

    require_once("./phpQuery-onefile.php");
    $opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));
    $context = stream_context_create($opts);
    $html = file_get_contents($url, FALSE, $context);
    $doc = phpQuery::newDocument($html);
    
    // 取得した食材を正規表現によりリスト化
    $tmp_ingredients = preg_split("/\n|。|、|( |　)+/", $doc[".materialBox"][".name"]->text());
    // 整形
    $ingredients = array();
    foreach($tmp_ingredients as $ing){
        if ($ing != ""){
            // TODO: 特殊な記号がある場合(☆等)削除
            $ingredients[] = $ing;
        }
    }
    echo var_dump($ingredients);

    // TODO: 量の取得

    return $ingredients;

}

// scraping_ingredients('https://recipe.rakuten.co.jp/recipe/1770021321/');

function get_items($keyword){
    // ベースとなるリクエストURL
    $baseurl = 'https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706';
    // リクエストのパラメータ作成
    $params = array();
    $params['applicationId'] = '1083631531973280170'; // アプリID
    $params['keyword'] = urlencode_rfc3986($keyword); // 任意のキーワード。※文字コードは UTF-8
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
                        'smallImageUrls' => isset($item->Item->smallImageUrls[0]->imageUrl) ? (string)$item->Item->smallImageUrls[0]->imageUrl : '',
                        'mediumImageUrls' => isset($item->Item->mediumImageUrls[0]->imageUrl) ? (string)$item->Item->mediumImageUrls[0]->imageUrl : '',
                        'itemPrice' => (string)$item->Item->itemPrice,
                        'shopName' => (string)$item->Item->shopName,
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

// RFC3986 形式で URL エンコードする関数
function urlencode_rfc3986($str) {
    return str_replace('%7E', '~', rawurlencode($str));
}
