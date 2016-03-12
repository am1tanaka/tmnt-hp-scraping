<?php
class CDatas {
    /** 一覧リスト
     * latestがある場合は、?dt=で指定の年月まで遡りながら一覧を処理
     * ない場合は、表示される一覧を処理
    */
    public static $lists = array(
        // 9:
        array(
            "category"=>["活動報告", "多摩ＮＴウオッチング"],
            "tag"=>"多摩ＮＴウオッチング",
            "url"=>"http://www.tama-nt.org/htm/watching/repo/index.asp",
            "desc"=>"/html/body/div/div/div/div/ul/li/a",
        )
    );

    /** 取得完了リスト*/
    public static $ALL = array(
    // 0:ニュース / 月別(?dt=)に取得して、一覧を処理
    array(
        "category"=>["ニュース"],
        "url"=>"http://www.tama-nt.org/htm/news/article/index.asp",
        "datefrom"=>"2006/1",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
        "subcategory"=>"/html/body/div/div/div/h6",
    ),
    // 1:フォトギャラリー / 月別(?dt=)に取得して、一覧を処理
    array(
        "category"=>["フォトギャラリー"],
        "url"=>"http://www.tama-nt.org/htm/photo/img/index.asp",
        "datefrom"=>"2004/4",
        "desc"=>"/html/body/div/div/div/p/a",
        "subcategory"=>"/html/body/div/div/div/h6",
    ),
    // 2:活動報告 / カテゴリを以下に列挙して、tag指定。表示された一覧を処理
    array(
        "category"=>["活動報告", "定期総会"],
        "tag"=>"定期総会",
        "url"=>"http://www.tama-nt.org/htm/generalmeeting/repo/index.asp",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    // 3:
    array(
        "category"=>["活動報告", "研究大会"],
        "tag"=>"研究大会",
        "url"=>"http://www.tama-nt.org/htm/research/repo/index.asp",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    // 4:
    array(
        "category"=>["活動報告", "研究会報告"],
        "tag"=>"研究会報告",
        "url"=>"http://www.tama-nt.org/htm/study/repo/index.asp",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    // 5:
    array(
        "category"=>["活動報告", "部会活動", "プロジェクト全般"],
        "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=1",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    // 6:
    array(
        "category"=>["活動報告", "部会活動", "プロジェクト１"],
        "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=2",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    // 7:
    array(
        "category"=>["活動報告", "部会活動", "プロジェクト２"],
        "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=3",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    // 8:
    array(
        "category"=>["活動報告", "部会活動", "プロジェクト３"],
        "url"=>"http://www.tama-nt.org/htm/section/article/index.asp?c=4",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    ),
    // 9:
    array(
        "category"=>["活動報告", "多摩ＮＴウオッチング"],
        "tag"=>"多摩ＮＴウオッチング",
        "url"=>"http://www.tama-nt.org/htm/watching/repo/index.asp",
        "desc"=>"/html/body/div/div/div/div/ul/li/a",
    )
);

}
 ?>
