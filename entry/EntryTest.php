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

    public function _testValid() {
        // CUtilを設定
        CUtil::$me = new CUtil($this);

        // ページ開始
        $this->url(WP_ADMIN_URL);

        // 調査
        CUtil::waitById("user_login");

    }

    /** ニュース登録*/
    public function testNewsEntry()
    {
        // CUtilを設定
        CUtil::$me = new CUtil($this);

        // ページ開始
        $this->url(WP_ADMIN_URL);

        // ログイン
        CLogin::login(WP_ID, WP_PASS);

        // 新規登録
        CPageManage::toNews();

        // ファイルの読み込み
        $datas = json_decode(file_get_contents("./results/result-photo.json"));

        // 記事の追加
        for ($i=START ; $i<=END ; $i++) {
            echo "$i - ";
            CPageManage::newEntry();
            CPageManage::entryData(
                $datas[$i]->title,
                $datas[$i]->date,
                $datas[$i]->body,
                $datas[$i]->category);
            echo "done, ";
        }
    }

    /** 固定ページ登録(未完成)*/
    /*
    public function testBacknumberEntry()
    {
        // CUtilを設定
        CUtil::$me = new CUtil($this);

        // ページ開始
        $this->url(WP_ADMIN_URL);

        // ログイン
        CLogin::login(WP_ID, WP_PASS);

        // 新規登録
        CPageManage::toKotei();

        // ファイルの読み込み
        $datas = json_decode(file_get_contents("./results/result-photo.json"));

        // 記事の追加
        for ($i=START ; $i<=END ; $i++) {
            echo "$i - ";
            CPageManage::newEntry();
            CPageManage::entryKoteiData(
                $datas[$i]->title,
                $datas[$i]->date,
                $datas[$i]->body,
                ["バックナンバー"]);
            echo "done, ";
        }
    }*/

    public function _testTitle() {
        // CUtilを設定
        CUtil::$me = new CUtil($this);

        // ページ開始
        $this->url(WP_ADMIN_URL);

        // ログイン
        CLogin::login(WP_ID, WP_PASS);

        // 新規登録
        CPageManage::toNews();

        // 記事の追加
        CPageManage::newEntry();
        CPageManage::entryData("title", "2016/1/1", "body", ["活動報告","部会活動","プロジェクト全般"]);

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
