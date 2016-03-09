<?php
/** 詳細ページから必要なデータを取得して返す*/

class CDesc {
    public static function getDescPage($url) {
        $pagexml = CUtil::getURL($url);

        print_r($pagexml);
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
