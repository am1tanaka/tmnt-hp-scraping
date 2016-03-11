<?php
/** 詳細ページから必要なデータを取得して返す*/

class CDesc {
    static $XPATH_TABLE = [
        "body"=>"/html/body/div/div/div",
        "title"=>"/html/body/div/div/div/h2",
        "date"=>"/html/body/div/div/div/h5",
        "category"=>"/html/body/div/div/div/h6"
    ];

    /** 読み取る情報*/
    static $STATUS_FLOW = [
        ["tag"=>"/h2/i", "status"=>"title"],
        ["tag"=>"/h5/i", "status"=>"date"],
        ["tag"=>"/.*/",   "status"=>"body"],
        ["tag"=>"/h6/i", "status"=>"category"]
    ];

    /** 共通パス。これ以降をフォルダー名として利用する*/
    const COMMON_PATH = "http://www.tama-nt.org/htm";

    /** 再帰的にXMLエレメントを処理して画像を取り出す*/
    static function downloadImages($param, $url) {
        foreach ($param as $key => $val) {
            // イメージなら処理をする
            if (preg_match("/img/i", $key) >0 ) {
                $src = $val->attributes()['src']->__toString();
                $srcurl = dirname($url)."/$src";

                // 中間フォルダー名を作成
                $savepath = dirname(__FILE__)."/images".substr(dirname($url), strlen(CDesc::COMMON_PATH))."/$src";
                $path = dirname($savepath);
                if (!is_dir($path)) {
                    mkdir($path, 0700, true);
                }

                file_put_contents($savepath, file_get_contents($srcurl));
            }
            // 子供を呼び出す
            CDesc::downloadImages($val->children(), $url);
        }
    }

    /**
     * 指定のURLから詳細ページをダウンロードして、
     * 要素の取り出し、イメージのダウンロードを実施して、
     * 取り出した要素を連想配列で返す
     * @param string $url 詳細ページのURL
     * @param array $list よみ出し時のパラメータ
     * @return array 読み込んだデータを収めた連想配列
     */
    public static function getDescPage($url, $list) {
        $ret = [
            "title"=>"",
            "date"=>"",
            "body"=>"",
            "category"=>$list['category']
        ];
        $stidx = 0;

        // アクセスを出力
        echo "$url \n";

        // エンコードを設定
        mb_language("ja");

        // 詳細ページを取得
        $pagexml = CUtil::getURL($url);
        if ($pagexml === false) {
            $ret = ["error"=>$url];
            return $ret;
        }
        $bodys = $pagexml->xpath(CDesc::$XPATH_TABLE['body']);

        // 要素を解析
        foreach($bodys as $bodydiv) {
            if (preg_match("/mainContents/i", $bodydiv['id']) > 0) {
                foreach($bodydiv as $key => $param) {
                    // 検索
                    if (preg_match(CDesc::$STATUS_FLOW[$stidx]['tag'], $key) > 0) {
                        $status = CDesc::$STATUS_FLOW[$stidx]['status'];
                        // 一致
                        switch ($status) {
                            case "title":
                            case "date":
                                $ret[$status] = $param->__toString();
                                $stidx++;
                                break;
                            case "body":
                                // 次のステータスが出てきたら終了
                                if (preg_match(CDesc::$STATUS_FLOW[$stidx+1]['tag'], $key) > 0)
                                {
                                    // 次へ
                                    $stidx++;
                                    break;
                                }
                                // 記録
                                $ret['body'] .= $param->asXML();

                                // 画像のダウンロード
                                CDesc::downloadImages($param, $url);

                                // 次のパラメータになっていなければそのまま継続
                                break;
                        }
                    }
                }

                // カテゴリーを取り出す
                if (array_key_exists("subcategory", $list)) {
                    $cate = $bodydiv->xpath($list['subcategory']);
                    // 変換ミスなので結果を出力
                    if (count($cate) == 0) {
                        print_r($ret);
                    }
                    $sepas = mb_split("『", $cate[0]->__toString());
                    $ret['category'][] = mb_substr($sepas[1], 0, -1);
                    break;
                }
            }
        }
        return $ret;
    }
}

/*
//echo "category=".$list['category']."\n";

$xml = $util->getURL($list['url']);
file_put_contents("temp.ele", print_r($xml, true));
// 解析してみる
$h2 = $xml->xpath('/body');
print_r($xml->xpath('/html/body/div/div/div/h2'));
print_r($xml->xpath('/html/body/div/div/div/ul/li/a'));
*/

 ?>
