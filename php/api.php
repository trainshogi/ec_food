<?php


function get_ingredients($cook_name){

    $result = array(
        "ingredients" => array('りんご', '肉', '魚'),
        "cook_name" => $cook_name,
        "info" => array(
            'りんご' => array(
                array(
                    'name' => 'スーパーセール10%OFF 朝どれ 秋映 訳あり 葉とらず 味極み りんご 減農薬 長野県産 5キロ',
                    'url' => 'https://item.rakuten.co.jp/kizunasann/ringo_bara_wake_5k/',
                    'img' => 'https://thumbnail.image.rakuten.co.jp/@0_mall/kizunasann/cabinet/ringo/ringo-w5k.jpg?_ex=128x128',
                ),
                array(
                    'name' => '【9月下旬発送 先行予約】りんご 訳あり 10kg 送料無料 サンつがる サンふじ 山形県産 産地直送りんご お徳用 ジャムにもOKなりんご りんごジュースにもOK！ 家庭用りんご 日時指定不可 送料無料(四国 九州 沖縄を除く) 健康 夏りんご 食べ物 果物',
                    'url' => 'https://item.rakuten.co.jp/ryokucyaen/rg-109/',
                    'img' => 'https://thumbnail.image.rakuten.co.jp/@0_mall/ryokucyaen/cabinet/ringo/2019-02-ns-rg109s.jpg?_ex=128x128',
                ),
            ),
            '肉' => array(
                array(
                    'name' => '半額 焼肉 送料無料 メガ盛り 計1.4kg 情熱の 焼肉 お試し セット【B】（やわらかハラミ テッチャン 牛カルビなど）焼肉セット バーベキュー BBQ 牛肉 肉（北海道・沖縄配送は別途送料追加）【A群☆送料無料セット】',
                    'url' => 'https://item.rakuten.co.jp/jonetsu/60002set/',
                    'img' => 'https://thumbnail.image.rakuten.co.jp/@0_mall/jonetsu/cabinet/syouhinimg/1703otameshib_s01.jpg?_ex=128x128',
                ),
                array(
                    'name' => '【あす楽対応】ヒライの6点食べ比べ焼肉　600g（3〜4人前）（冷凍）【送料無料※一部地域+500円】',
                    'url' => 'https://item.rakuten.co.jp/auc-oniku-hirai/tabekurabe-1/',
                    'img' => 'https://thumbnail.image.rakuten.co.jp/@0_mall/auc-oniku-hirai/cabinet/sozai/yakiniku/03170487/imgrc0069696070.jpg?_ex=128x128',
                ),
                array(
                    'name' => '◆4日からエントリーで最大P20倍◆9,960円→4,980円 佐賀県産 黒毛和牛 敬老の日 ギフト サーロインステーキ 約400g（200g×2枚）セール 国産 和牛 特選 サーロイン ロース ステーキ お歳暮 お中元 お祝い 内祝い 誕生日 母の日 父の日 お肉 食べ物',
                    'url' => 'https://item.rakuten.co.jp/nikunotomoru/100032/',
                    'img' => 'https://thumbnail.image.rakuten.co.jp/@0_mall/nikunotomoru/cabinet/100032/100032_main1.jpg?_ex=128x128',
                ),
            ),
            '魚' => array(
                array(
                    'name' => '本格魚惣菜詰合せ≪煮魚・焼魚・西京焼 合計10食入≫[ 敬老の日 御中元 暑中御見舞 内祝 御祝 誕生日祝い 魚 惣菜 焼き魚 煮魚 おかず 冷凍食品 真空パック 湯煎 詰め合わせ サバ イワシ ]',
                    'url' => 'https://item.rakuten.co.jp/sakanayuya/10000051/',
                    'img' => 'https://thumbnail.image.rakuten.co.jp/@0_mall/sakanayuya/cabinet/variety/honkakusouzai/imgrc0079288775.jpg?_ex=128x128',
                ),
            ),
        ),
    );

    // 連想配列($array)をJSONに変換(エンコード)する
    $json = json_encode($result, JSON_UNESCAPED_UNICODE);

    return $json;
}