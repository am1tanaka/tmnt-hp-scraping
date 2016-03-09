<?php
require_once('utils.php');
require_once("desc.php");

/** 一覧を制御するクラス
 */
class CLists {
    /**
     * 指定のURLが一覧ページ。
     * 必要に応じて、カテゴリーの取得や、詳細処理の呼び出しを行う。
     * 取り出したページの情報を連想配列に入れて返す
     */
    function procList($url, $list) {
        // ページを取得
        $xmllist = CUtil::getURL($url);

        // 詳細をリストアップ
        $desclists = $xmllist->xpath($list['desc']);
        foreach($desclists as $desclist) {
            if (mb_strpos($desclist[0], "詳細ページ")) {
                echo $url."\n";
                // 詳細へのリンクを取得
                $href = $desclist->attributes()[0];
                $descurl = pathinfo($list['url'], PATHINFO_DIRNAME)."/".$href[0];
                // 詳細の処理
                CDesc::getDescPage($descurl);
            }
        }
    }

    /** リストを受け取って、一覧の呼び出し処理を行う
    */
    public function proc($list, $outputdata) {
        $y = 2016;
        $m = 3;

        // 時間で回すか？
        if (array_key_exists("datefrom", $list)) {
            // 時間まで遡る
            do {
                $dt = "$y/$m";

                // 処理
                $outputdata[] = $this->procList($list['url']."?dt=$dt", $list);

                // 更新
                $m--;
                if ($m <= 0) {
                    $y--;
                    $m = 12;
                }
            } while ($dt !== $list['datefrom']);
        }
        else {
            $outputdata[] = $this->procList($list['url'], $list);
        }
    }
}
?>
