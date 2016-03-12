<?php

require('./src/utils.php');
require('./src/lists.php');
require('./src/datas.php');

class StackTest extends PHPUnit_Framework_TestCase
{
    public function _testUTF8() {
        CUtil::getURL("http://tama-nt.org/htm/news/article/comment.asp?n=109");
    }


    var $errorURL2 = [
        // 0
        array(
            "category"=>["ニュース"],
            "url"=>"http://www.tama-nt.org/htm/news/article/index.asp",
            "datefrom"=>"2007/4",
            "desc"=>"/html/body/div/div/div/div/ul/li/a",
            "subcategory"=>"/html/body/div/div/div/h6",
        )
    ];
    var $errorURL = [
        // 0
        array(
            "category"=>["ニュース"],
            "url"=>"http://www.tama-nt.org/htm/news/article/index.asp?dt=2007/5",
            "desc"=>"/html/body/div/div/div/div/ul/li/a",
            "subcategory"=>"/html/body/div/div/div/h6",
        ),
        // 1
        array(
            "category"=>["活動報告", "部会活動", "プロジェクト全般"],
            "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=1",
            "desc"=>"/html/body/div/div/div/div/ul/li/a",
        ),
        // 2
        array(
            "category"=>["活動報告", "部会活動", "プロジェクト１"],
            "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=2",
            "desc"=>"/html/body/div/div/div/div/ul/li/a",
        ),
        // 3
        array(
            "category"=>["活動報告", "部会活動", "プロジェクト２"],
            "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=3",
            "desc"=>"/html/body/div/div/div/div/ul/li/a",
        ),
        // 4
        array(
            "category"=>["活動報告", "部会活動", "プロジェクト３"],
            "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=4",
            "desc"=>"/html/body/div/div/div/div/ul/li/a",
        )
    ];

    /** 全体実行*/
    public function testAll() {
        $this->procList(CDatas::$ALL);
    }

    /** HTMLのエラーチェック*/
    public function _testHTML() {
        $html = file_get_contents("./temp/err.html");
        // 一度、エンティティーをデコードしておく
        $htmldec = html_entity_decode($html);
        // エンコードし直す
        $html = mb_ereg_replace("&", "&amp;", $htmldec);
        echo $html."\n";
        $domDocument = new domDocument();
        $domDocument->loadHTML($html);
        $xmlstr = $domDocument->saveXML();

        // XMLに読み込み
        $xml = simplexml_load_string($xmlstr);
        echo "\n done \n";

    }

    /** 詳細ページのエラーチェック*/
    public function _testDesc() {
        $urls = [
            "http://www.tama-nt.org/htm/watching/repo/comment.asp?n=13"
        ];

        foreach($urls as $url) {
            $res = CDesc::getDescPage($url, $this->errorURL2[0], true);
        }
    }

    /** エラーリストの確認*/
    public function _testErrorList() {
        $this->procList($this->errorURL2);
    }

    function procList($lists) {
        /** 処理開始*/
        $clLists = new CLists();
        $result = [];

        /** 処理開始*/
        foreach($lists as $list) {
            $result = array_merge($result, $clLists->proc($list, true));
        }

        /** 作成したオブジェクトをJSON形式にして保存する*/
        file_put_contents("./result.json", json_encode($result));
        $read = json_decode(file_get_contents("./result.json"));
        file_put_contents("./result.txt", print_r($read, true));
    }

    // エラー文字のチェック
    public function _testErrorWords() {
        $start = 0;
        $y = 2007;
        $m = 5;
        /** 処理開始*/
        $clLists = new CLists();
        $result = [];

        /** 処理開始*/
        for ($i=$start ; $i<count(CDatas::$lists) ; $i++) {
            echo "[$i]\n";
            $result = array_merge($result, $clLists->proc(CDatas::$lists[$i], true, $y, $m));
        }

        /** 作成したオブジェクトをJSON形式にして保存する*/
        file_put_contents("./result.json", json_encode($result));

        $read = json_decode(file_get_contents("./result.json"));
        print_r($read);
    }

    /** 個別テスト*/
    public function _testOne() {
        $idx = 1;

        /** 処理開始*/
        $clLists = new CLists();
        $result = [];

        /** 処理開始*/
        $result = array_merge($result, $clLists->proc(CDatas::$lists[$idx]));
        echo "count=".count($result)."\n";

        /** 作成したオブジェクトをJSON形式にして保存する*/
        file_put_contents("./temp/result_one.json", json_encode($result));

        // テキストにして出力
        $read = json_decode(file_get_contents("./temp/result_one.json"));
        file_put_contents("./temp/result_one.txt", print_r($read, true));
    }

    // JSONの保存テスト
    public function _testSaveJson()
    {
        $read = json_decode(file_get_contents("./result.json"));
        file_put_contents("./result.txt", print_r($read, true));
    }
}
?>
