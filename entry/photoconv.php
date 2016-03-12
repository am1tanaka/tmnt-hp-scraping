<?php
/**
 * 写真の名前を以降先に合わせて修正する
 * http://www2.tama-nt.org/wordpress/wp-content/uploads/2016/03/koho03_5.jpg
 */

define('PHOTO_PATH','http://www2.tama-nt.org/wordpress/wp-content/uploads/2016/03/');

function getImageFile($needle, $str, $start) {
    $ret = [];
    $posst = mb_stripos($str, $needle, $start);
    $posend = mb_stripos($str, " ", $posst);
    $path = mb_substr($str, $posst+mb_strlen($needle), $posend-$posst-mb_strlen($needle));
    $path = preg_replace("/'|\"/", "", $path);

    $ret =
    [
        'path'=>$path,
        'name'=>basename($path),
        'forward'=>mb_substr($str, 0, $posst+mb_strlen($needle)),
        'back'=>mb_substr($str, $posend),
        'next'=>$posend
    ];
    return $ret;
}

// ファイル読み込み
$datas = json_decode(file_get_contents("./result.json"));
mb_language('ja');

$data = $datas[0];
$start = 0;
//foreach($datas as $data) {
    $path = getImageFile("href=", $data->body, $start);
    echo $path['path']."|\n";
    echo $path['name']."|\n";
    $start = $path['next'];
    echo $start."\n";
    echo $path['forward']."|\n";
    echo $path['back']."|\n";

    /*
    $fname = basename($data->body);
    $data->body = preg_replace('/src="images\/.+"/i', 'src="'.PHOTO_PATH.$fname.'"', $data->body);
    */
//}
//echo $data->body;

// JSON化して保存
file_put_contents("./result-photo.json", json_encode($datas));
// 確認のため、読めるようにする
$read = json_decode(file_get_contents("./result-photo.json"));
file_put_contents("./result-photo.txt", print_r($read, true));

 ?>
