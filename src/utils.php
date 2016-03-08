<?php
/** ユーティリティクラス*/

class CUtil {

    /** 指定のURLのHTMLを取得して、XMLオブジェクトとして返す
     * @param string $url 取得するURL
     * @return SimpleMLElement 変換したオブジェクト
    */
    public function getURL($url) {
        // URLからHTMLの取得
        $html = file_get_contents($url);

        // 日本語をUTF8に変換
        //$html = mb_convert_encoding($html, "UTF-8", "SJIS");
        file_put_contents("temp.html", $html);

        // XMLに変換
        $domDocument = new domDocument();
        $domDocument->loadHTML($html);
        $xmlstr = $domDocument->saveXML();

        file_put_contents("temp.xml", $xmlstr);

        // XMLに読み込み
        $xml = simplexml_load_string($xmlstr);

        return $xml;
    }
}

 ?>
