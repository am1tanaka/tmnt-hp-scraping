<?php
/**
 * 写真の名前を以降先に合わせて修正する
 * http://www2.tama-nt.org/wordpress/wp-content/uploads/2016/03/koho03_5.jpg
 * php ./entry/photoconv.php
 */

define('PHOTO_PATH','http://www2.tama-nt.org/wordpress/wp-content/uploads/2016/03/');

/**
 * イメージ
 * @param string $needle 検索する文字列
 * @param string $str 処理対象の本文
 * @param int $start 検索開始場所
 * @return array path=取り出した指定されているパスとファイル名
 *               name=ファイル名
 *               forward=切り出す直前までの文字列。クオートは削除
 *               back=取り出した後に続く文字列。クオートは削除
 *               next=次に検索を開始する先頭からの文字数
 */
function getFilePath($needle, $str, $start) {
    $ret = [];
    $posst = mb_stripos($str, $needle, $start);
    if ($posst === false) {
        return false;
    }
    $posend = mb_stripos($str, " ", $posst);
    if ($posend === false) {
        $posend = mb_stripos($str, ">", $posst);
    }
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

/**
 * イメージのみを処理する
 */
function getImageFile($needle, $str, $start) {
    for( ; $start < mb_strlen($str) ; )
    {
        $ret = getFilePath($needle, $str, $start);
        if ($ret === false) {
            return false;
        }
        $info = pathinfo($ret['path']);
        // 画像の拡張子か
        if (array_key_exists("extension", $info) && (preg_match("/jpg|bmp|gif|png/i", $info['extension']) === 1)) {
            return $ret;
        }
        // 次へ
        $start = $ret['next'];
    }
}

// ファイル読み込み
$datas = json_decode(file_get_contents("./result.json"));
mb_language('ja');

// 結果
for($i=0 ; $i<count($datas) ; $i++) {
    $start = 0;
    $body =  preg_replace("/&#13;/", "", $datas[$i]->body);

    // a要素を書き換える
    for($start=0; $start<mb_strlen($body); ) {
        $ret = getImageFile("href=", $body, $start);
        if ($ret === false) {
            break;
        }
        $body = $ret['forward']."'".PHOTO_PATH.$ret['name']."'";
        $start = mb_strlen($body);
        $body .= $ret['back'];
    }

    // img要素を書き換える
    for($start=0; $start<mb_strlen($body); ) {
        $ret = getImageFile("src=", $body, $start);
        if ($ret === false) {
            break;
        }
        $body = $ret['forward']."'".PHOTO_PATH.$ret['name']."'";
        $start = mb_strlen($body);
        $body .= $ret['back'];
    }

    $datas[$i]->body = $body;
}

// JSON化して保存
file_put_contents("./result-photo.json", json_encode($datas));
// 確認のため、読めるようにする
$read = json_decode(file_get_contents("./result-photo.json"));
file_put_contents("./result-photo.txt", print_r($read, true));

 ?>
