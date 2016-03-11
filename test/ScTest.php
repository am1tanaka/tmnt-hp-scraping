<?php

require('./src/utils.php');
require('./src/lists.php');

class StackTest extends PHPUnit_Framework_TestCase
{
    var $lists = [
        array(
            "category"=>["活動報告", "研究大会"],
            "tag"=>"研究大会",
            "url"=>"http://www.tama-nt.org/htm/research/repo/index.asp",
            "desc"=>"/html/body/div/div/div/div/ul/li/a",
        ),
    ];

    public function testSaveJson()
    {
        /** 処理開始*/
        $clLists = new CLists();
        $result = [];

        /** 処理開始*/
        foreach($this->lists as $list) {
            $result = array_merge($result, $clLists->proc($list));
        }

        /** 作成したオブジェクトをJSON形式にして保存する*/
        file_put_contents("./result.json", json_encode($result));

        $read = json_decode(file_get_contents("./result.json"));
        print_r($read);
    }
}
?>
