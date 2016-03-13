<?php

/**
 * Selenium を使ったデータ登録
 */
require("./entry/config.php");
require("./entry/CUtil.php");
require("./entry/PageLogin.php");
require("./entry/PageManage.php");
require("./entry/categorymap.php");

class EntryTest extends PHPUnit_Extensions_Selenium2TestCase {
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl(WP_ADMIN_URL);
    }

    public function testTitle()
    {
        // CUtilを設定
        CUtil::$me = new CUtil($this);

        // ページ開始
        $this->url(WP_ADMIN_URL);

        // ログイン
        CLogin::login(WP_ID, WP_PASS);

        // 新規登録
        CPageManage::toNewEntry();

        // 記事の追加
        CPageManage::entryData("title", "body", ["活動報告","部会活動","プロジェクト全般"]);

        sleep(30);
    }

    /** カテゴリーのマッチングテスト*/
    public function _testCategory() {
        $result = file_get_contents("./result.json");
        $datas = json_decode($result);
        foreach($datas as $data) {
            foreach($data->category as $k => $v) {
                echo $v.",";
            }
            echo "\n";
            echo CCategoryMap::getCategoryID($data->category)."\n";
        }
    }

}


?>
