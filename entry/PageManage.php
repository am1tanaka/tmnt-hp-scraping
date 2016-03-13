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
    public static function entryData($title, $body, $category, $tag) {
        // テキストに切り替える
        CUtil::$me->clickById("content-html");

        // タイトル
        CUtil::$me->setTextById("title-prompt-text", $title);

        // 本文
        CUtil::$me->setTextById("content", $body);

        // カテゴリーを設定

        // タグを設定

        // 決定

    }
}

 ?>
