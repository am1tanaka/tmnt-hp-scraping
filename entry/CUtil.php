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

    public static function waitById($id) {
        while(true) {
            if (CUtil::$me->sele->using("id", $id)) break;
            sleep(1);
        }
    }

    public static function clickById($id) {
        // チェック
        CUtil::waitById($id);
        CUtil::$me->sele->byId($id)->click();
    }

    public static function clickByClass($class) {
        CUtil::$me->sele->byClassName($class)->click();
    }

    public static function clickByLinkText($text) {
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
