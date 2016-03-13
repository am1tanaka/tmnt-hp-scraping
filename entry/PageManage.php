<?php
/**
 * 管理画面
 */

class CPageManage {
    /** 管理ページから新規追加へ*/
    public static function toNewEntry() {
        CUtil::$me->clickByLinkText("ニュース の管理");
        CUtil::$me->clickByLinkText("新規追加");
    }

    /** データを入力する*/
    public static function entryData($title, $body, $category) {
        // テキストに切り替える
        CUtil::$me->clickById("content-html");

        // タイトル
        CUtil::$me->setTextById("title-prompt-text", $title);

        // 本文
        CUtil::$me->setTextById("content", $body);

        // カテゴリーを設定
        $cateid = CCategoryMap::getCategoryID($category);
        if ($cateid) {
            CUtil::$me->clickById($cateid);
        }

        // タグを設定
        $tags = CCategoryMap::getCategoryTags($category);
        if ($tags && (count($tags) > 0)) {
            $ent = join(",", $tags);
            CUtil::$me->setTextById("new-tag-post_tag", $ent);
            CUtil::$me->clickByClass("tagadd");
        }

        // 決定
        CUtil::$me->clickById("save-post");
    }
}

 ?>
