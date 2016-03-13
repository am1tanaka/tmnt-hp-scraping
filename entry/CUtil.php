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
        $elem->value($in);
    }

    public static function clickById($id) {
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

}
 ?>
