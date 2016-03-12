<?php
/** ユーティリティクラス*/

class CUtil {
    /** 指定のURLのHTMLを取得して、XMLオブジェクトとして返す
     * @param string $url 取得するURL
     * @return SimpleMLElement 変換したオブジェクト / 失敗した時はfalseを返す
    */
    public static function getURL($url, $output=false) {
        $html = "";
        try {
            // URLからHTMLの取得
            $html = file_get_contents($url);

            // UTF8に変換
            $html = mb_convert_encoding($html, "UTF-8", "SJIS-win");
            $html = str_replace("charset=shift_jis", "charset=utf-8", $html);
            if ($output) {
                file_put_contents("./temp/temp.html", $html);
            }

            // エスケープを処理
            // 一度、エンティティーをデコードしておく
            $htmldec = html_entity_decode($html);
            // エンコードし直す
            $html = mb_ereg_replace("&", "&amp;", $htmldec);
            if ($output) {
                file_put_contents("./temp/temp_enc.html", $html);
            }

            // XMLに変換
            $domDocument = new domDocument();
            $domDocument->loadHTML($html);
            $xmlstr = $domDocument->saveXML();
            if ($output) {
                file_put_contents("./temp/temp.xml", $xmlstr);
            }

            // XMLに読み込み
            $xml = simplexml_load_string($xmlstr);
            return $xml;
        } catch (Exception $e) {
            echo "loadHTML Error: $url\n";
            file_put_contents("./temp/loadHTMLerror.html", $html);
            echo $e."\n";
        }
        return false;
    }
}

 ?>
