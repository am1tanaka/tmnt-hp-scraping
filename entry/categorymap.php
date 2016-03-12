<?php
/**
 * カテゴリーの登録マップ
 * http://www2.tama-nt.org/wordpress/wp-content/uploads/2016/03/koho03_5.jpg
 */

class CCategoryMap {
    public static $MAP = [
        // ニュース_研究会_,51,
        [
            "from"=>["ニュース","研究会"],
            "to"=>["ニュース","研究会"],
            "tag"=>[]
        ],
        // ニュース_総会_,21,
        [
            "from"=>["ニュース","総会"],
            "to"=>["ニュース","総会"],
            "tag"=>[]
        ],
        // ニュース_学会誌_,8,
        [
            "from"=>["ニュース","学会誌"],
            "to"=>["ニュース","学会誌"],
            "tag"=>[]
        ],
        // ニュース_各種イベント情報_,23,
        [
            "from"=>["ニュース","各種イベント情報"],
            "to"=>["ニュース","活動報告"],
            "tag"=>["各種イベント情報"]
        ],
        // ニュース_シンポジウム_,6,
        [
            "from"=>["ニュース", "シンポジウム"],
            "to"=>["ニュース", "研究会"],
            "tag"=>["シンポジウム"]
        ],
        // ニュース_懇親会_,0,
        [
            "from"=>["ニュース","懇親会"],
            "to"=>["ニュース","活動報告"],
            "tag"=>[]
        ],
        // ニュース_更新情報_,2,
        [
            "from"=>["ニュース","更新情報"],
            "to"=>["ニュース","事務局から"],
            "tag"=>[]
        ],
        // ニュース_研究大会_,0,
        [
            "from"=>["ニュース","研究大会"],
            "to"=>["ニュース","研究会"],
            "tag"=>[]
        ],
        // フォトギャラリー_ニュータウンで見かける野鳥_,13,
        [
            "from"=>["フォトギャラリー","ニュータウンで見かける野鳥"],
            "to"=>["フォトギャラリー","ニュータウンで見かける野鳥"],
            "tag"=>[]
        ],
        // フォトギャラリー_ニュータウンの景色_,19,
        [
            "from"=>["フォトギャラリー","ニュータウンの景色"],
            "to"=>["フォトギャラリー","ニュータウンの景色"],
            "tag"=>[]
        ],
        // フォトギャラリー_各種イベントから_,3,
        [
            "from"=>["フォトギャラリー","各種イベントから"],
            "to"=>["フォトギャラリー","各種イベントから"],
            "tag"=>[]
        ],
        // フォトギャラリー_第１回市民シンポジウム_,1,
        [
            "from"=>["フォトギャラリー","第１回市民シンポジウム"],
            "to"=>["フォトギャラリー","各種イベントから"],
            "tag"=>["第１回市民シンポジウム"]
        ],
        // フォトギャラリー_第１７回ウオッチング　　　　　　　よこやまの道_,7,
        [
            "from"=>["フォトギャラリー","第１７回ウオッチング　　　　　　　よこやまの道"],
            "to"=>["フォトギャラリー","各種イベントから"],
            "tag"=>["第１７回ウオッチング-よこやまの道"]
        ],
        // フォトギャラリー_第１６回ウオッチング　　　　　　　稲城市中央図書館_,7,
        [
            "from"=>["フォトギャラリー","第１６回ウオッチング　　　　　　　稲城市中央図書館"],
            "to"=>["フォトギャラリー","各種イベントから"],
            "tag"=>["第１６回ウオッチング-稲城市中央図書館"]
        ],
        // フォトギャラリー_第１４回ウオッチング　　　　　　　京王資料館_,5,
        [
            "from"=>["フォトギャラリー","第１４回ウオッチング　　　　　　　京王資料館"],
            "to"=>["フォトギャラリー","各種イベントから"],
            "tag"=>["第１４回ウオッチング-京王資料館"]
        ],
        // 活動報告_定期総会_,37,
        [
            "from"=>["活動報告","定期総会"],
            "to"=>["ニュース","総会"],
            "tag"=>["定期総会"]
        ],
        // 活動報告_研究大会_,12,
        [
            "from"=>["活動報告","研究大会"],
            "to"=>["ニュース","研究会"],
            "tag"=>["研究大会"]
        ],
        // 活動報告_研究会報告_,13,
        [
            "from"=>["活動報告","研究会報告"],
            "to"=>["ニュース","研究会"],
            "tag"=>[]
        ],
        // 活動報告_部会活動_プロジェクト全般_,2,
        [
            "from"=>["活動報告","部会活動","プロジェクト全般"],
            "to"=>["ニュース","活動報告"],
            "tag"=>["部会活動","プロジェクト全般"]
        ],
        // 活動報告_部会活動_プロジェクト１_,2,
        [
            "from"=>["活動報告","部会活動","プロジェクト１"],
            "to"=>["ニュース","活動報告"],
            "tag"=>["部会活動","プロジェクト１"]
        ],
        // 活動報告_部会活動_プロジェクト２_,1,
        [
            "from"=>["活動報告","部会活動","プロジェクト２"],
            "to"=>["ニュース","活動報告"],
            "tag"=>["部会活動","プロジェクト２"]
        ],
        // 活動報告_部会活動_プロジェクト３_,1,
        [
            "from"=>["活動報告","部会活動","プロジェクト３"],
            "to"=>["ニュース","活動報告"],
            "tag"=>["部会活動","プロジェクト３"]
        ],
        // 活動報告_多摩ＮＴウオッチング_,20,
        [
            "from"=>["活動報告","多摩ＮＴウオッチング"],
            "to"=>["ニュース","活動報告"],
            "tag"=>["多摩ＮＴウオッチング"]
        ],
    ];
}

 ?>