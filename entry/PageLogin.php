<?php
/**
 * ログイン処理
 */

class CLogin {
    public static function login($id, $pass) {
        CUtil::setTextById("user_login", $id);
        CUtil::setTextById("user_pass", $pass);
        CUtil::clickById("wp-submit");
    }
}

 ?>
