<?php
/**
 * 管理画面
 */

class CPageManage {
    /** 管理ページから新規追加へ*/
    public static function toNews() {
        CUtil::$me->clickByLinkText("ニュース の管理");
    }

    public static function newEntry() {
        CUtil::$me->clickByLinkText("新規追加");
    }

    /** データを入力する*/
    public static function entryData($title, $date, $body, $category) {
        $log = "[$date]$title\n";

        try {
            // テキストに切り替える
            CUtil::$me->clickById("content-html");
            $log.="-ChangeText";

            // タイトル
            CUtil::$me->setTextById("title", $title);
            $log.="-SetTitle";

            // 日付
            CUtil::$me->clickByClass("edit-timestamp");
            $dt = explode("/", $date);
            CUtil::$me->setTextById("aa", $dt[0]);
            CUtil::$me->selectByLabel("mm", ($dt[1]-0)."月");
            CUtil::$me->setTextById("jj", $dt[2]-0);
            CUtil::$me->setTextById("hh", "12");
            CUtil::$me->setTextById("mn", "00");
            CUtil::$me->clickByLinkText("OK");
            $log.="-SetDate";

            // 本文
            $remcrlf = preg_replace("/&#13;/", "", $body);
            CUtil::$me->setTextById("content", $remcrlf);
            $log.="-SetBody";

            // カテゴリーを設定
            $cateids = CCategoryMap::getCategoryID($category);
            foreach($cateids as $cateid) {
                if ($cateid) {
                    CUtil::$me->clickById($cateid);
                }
            }
            $log.="-SetCategory";

            // タグを設定
            $tags = CCategoryMap::getCategoryTags($category);
            if ($tags && (count($tags) > 0)) {
                $ent = join(",", $tags);
                CUtil::$me->setTextById("new-tag-post_tag", $ent);
                CUtil::$me->clickByClass("tagadd");
            }
            $log.="-SetTag";

            // トップにスクロール
            CUtil::scroll(0);
            $log.="-Scroll";

            while(true) {
                try {
                    // 決定
                    CUtil::$me->clickById("save-post");
                    break;
                } catch (Exception $e) {
                    sleep(1);
                }
            }
            $log.="-Save";
        } catch (Exception $e) {
            echo $log;
            file_put_contents("./error.txt", $log."\n", FILE_APPEND);
            echo "[公開]と[カテゴリー]欄を開いておいてください。\n";
            echo "http://www2.tama-nt.org/wordpress/wp-admin/post-new.php\n";
        }
    }
}

 ?>
