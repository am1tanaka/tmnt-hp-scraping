<?php
/**
 * ツール
 */

class CUtil {
    public static $me;

    var $sele;
    function __construct($ins) {
        $this->sele = $ins;
    }

    public static function setTextById($id, $in) {
        CUtil::waitById($id);
        $elem = CUtil::$me->sele->byId($id);
        $elem->value("");
        $elem->clear();
        $elem->value($in);
    }

    /**
     * 選択肢をラベルから選ぶ
     */
    public static function selectByLabel($sel, $label) {
        $elem = PHPUnit_Extensions_Selenium2TestCase_Element_Select::fromElement(CUtil::$me->sele->byName($sel));
        $elem->selectOptionByLabel($label);
    }

    /** 指定の要素が表示されるのを待つ*/
    public function waitByUsing($st, $val) {
        for ($i=0 ; $i<10 ; $i++) {
            if (count($this->usingElement($st, $val)) > 0) break;
            sleep(1);
        }
    }

    /** 指定のストラテジーと値の要素を返す。*/
    public function usingElement($st, $value) {
        return $this->sele->elements($this->sele->using($st)->value($value));
    }

    public static function waitById($id) {
        CUtil::$me->waitByUsing("id", $id);
    }

    public static function clickById($id) {
        // チェック
        CUtil::waitById($id);
        CUtil::$me->sele->byId($id)->click();
    }

    public static function clickByClass($class) {
        CUtil::$me->waitByUsing("class name", $class);
        CUtil::$me->sele->byClassName($class)->click();
    }

    public static function clickByLinkText($text) {
        CUtil::$me->waitByUsing("link text", $text);
        CUtil::$me->sele->byLinkText($text)->click();
    }

    public static function cssSelector($val) {
        return CUtil::$me->sele->elements(CUtil::$me->sele->using("css selector")->value($val));
    }

    /** 指定の座標にスクロール*/
    public static function scroll($top) {
        CUtil::$me->sele->execute(
            [
                'script' => "scroll($top, 0);",
                'args'=>[]
            ]
        );
    }

}
 ?>
