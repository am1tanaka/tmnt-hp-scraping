<?php
/**
 * 多摩ニュータウン学会のHPの記事をダウンロード開始するコード
 * @copyright (C)2016 YuTanaka@AmuseOne
 * @license MIT
 */

require('utils.php');
require('lists.php');

/** 一覧リスト
 * latestがある場合は、?dt=で指定の年月まで遡りながら一覧を処理
 * ない場合は、表示される一覧を処理
*/
$lists = array(
    // ニュース / 月別(?dt=)に取得して、一覧を処理
    array(
        "category"=>["ニュース"],
        "url"=>"http://www.tama-nt.org/htm/news/article/index.asp",
        "datefrom"=>"2006/1",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
        "subcategory"=>"/html/body/div/div/div/h6",
    ),
    // フォトギャラリー / 月別(?dt=)に取得して、一覧を処理
    array(
        "category"=>["フォトギャラリー"],
        "url"=>"http://www.tama-nt.org/htm/photo/img/index.asp",
        "datefrom"=>"2004/4",
        "descpos"=>"desc",  // カテゴリーを詳細から
        "desc"=>"/html/body/div/div/div/h6",
        "subcategory"=>"/html/body/div/div/div/h6",
    ),
    // 活動報告 / カテゴリを以下に列挙して、tag指定。表示された一覧を処理
    array(
        "category"=>["活動報告", "定期総会"],
        "tag"=>"定期総会",
        "url"=>"http://www.tama-nt.org/htm/generalmeeting/repo/index.asp",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    array(
        "category"=>["活動報告", "研究大会"],
        "tag"=>"研究大会",
        "url"=>"http://www.tama-nt.org/htm/research/repo/index.asp",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    array(
        "category"=>["活動報告", "研究会報告"],
        "tag"=>"研究会報告",
        "url"=>"http://www.tama-nt.org/htm/study/repo/index.asp",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    array(
        "category"=>["活動報告", "部会活動", "プロジェクト全般"],
        "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=1",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    array(
        "category"=>["活動報告", "部会活動", "プロジェクト１"],
        "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=2",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    array(
        "category"=>["活動報告", "部会活動", "プロジェクト２"],
        "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=3",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    array(
        "category"=>["活動報告", "部会活動", "プロジェクト３"],
        "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=4",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    array(
        "category"=>["活動報告", "多摩ＮＴウオッチング"],
        "tag"=>"多摩ＮＴウオッチング",
        "url"=>"http://www.tama-nt.org/htm/watching/repo/index.asp",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    )
);

/** 処理開始*/
$clLists = new CLists();
$result = [];

/** 処理開始*/
foreach($lists as $list) {
    $result = array_merge($result, $clLists->proc($list));
}

/** 作成したオブジェクトをJSON形式にして保存する*/
file_put_contents("./result.json", json_encode($result));
$read = json_decode(file_get_contents("./result.json"));
file_put_contents("./result.txt", print_r($read, true));
?>
