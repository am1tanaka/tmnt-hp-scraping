<?php
/**
 * 多摩ニュータウン学会のHPの記事をダウンロード開始するコード
 * @copyright (C)2016 YuTanaka@AmuseOne
 * @license MIT
 */

require('utils.php');

/** 一覧リスト
 * latestがある場合は、?dt=で指定の年月まで遡りながら一覧を処理
 * ない場合は、表示される一覧を処理
*/
$lists = array(
    // ニュース / 月別(?dt=)に取得して、一覧を処理
    array(
        "category"=>"news",
        "url"=>"http://www.tama-nt.org/htm/news/article/index.asp",
        "latest"=>"2006/1"
    ),
    // フォトギャラリー / 月別(?dt=)に取得して、一覧を処理
    array(
        "category"=>"photo",
        "url"=>"http://www.tama-nt.org/htm/photo/img/index.asp",
        "latest"=>"2004/4"
    ),
    // 活動報告 / カテゴリを以下に列挙して、tag指定。表示された一覧を処理
    array(
        "category"=>"活動報告",
        "tag"=>"定期総会",
        "url"=>"http://www.tama-nt.org/htm/generalmeeting/repo/index.asp"
    ),
    array(
        "category"=>"活動報告",
        "tag"=>"研究大会",
        "url"=>"http://www.tama-nt.org/htm/research/repo/index.asp"
    ),
    array(
        "category"=>"活動報告",
        "tag"=>"研究会報告",
        "url"=>"http://www.tama-nt.org/htm/study/repo/index.asp"
    ),
    array(
        "category"=>"活動報告",
        "tag"=>"部会活動",
        "url"=>"http://www.tama-nt.org/htm/section/article/index.asp"
    ),
    array(
        "category"=>"活動報告",
        "tag"=>"多摩ＮＴウオッチング",
        "url"=>"http://www.tama-nt.org/htm/watching/repo/index.asp"
    )
);

/** 処理開始*/
$util = new CUtil();

/** 月を遡っていく*/

/** 処理開始*/
foreach($lists as $list) {
    echo "category=".$list['category']."\n";
    $xml = $util->getURL($list['url']);
    file_put_contents("temp.ele", print_r($xml, true));
    // 解析してみる
    $h2 = $xml->xpath('/body');
    print_r($xml->xpath('/html/body/div/div/div/h2'));
    print_r($xml->xpath('/html/body/div/div/div/ul/li/a'));
}


?>
