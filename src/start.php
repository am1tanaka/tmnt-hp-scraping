<?php
/**
 * 多摩ニュータウン学会のHPの記事をダウンロード開始するコード
 * @copyright (C)2016 YuTanaka@AmuseOne
 * @license MIT
 */

require('utils.php');
require('lists.php');
require('datas.php');

/** 処理開始*/
$clLists = new CLists();
$result = [];

/** 処理開始*/
foreach(CDatas::$lists as $list) {
    $result = array_merge($result, $clLists->proc($list));
}

/** 作成したオブジェクトをJSON形式にして保存する*/
file_put_contents("./result.json", json_encode($result));
$read = json_decode(file_get_contents("./result.json"));
file_put_contents("./result.txt", print_r($read, true));
?>
