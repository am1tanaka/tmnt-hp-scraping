<?php
/**
 * カテゴリーのチェックをする
 */

$datas = json_decode(file_get_contents("./result.json"));
$cates = [];

foreach($datas as $data) {
    $cateid = "";
    foreach($data->category as $cate) {
        $cateid .= $cate."_";
    }
    if (!array_key_exists($cateid, $cates)) {
        $cates[$cateid]['count'] = 1;
    }
    else {
        $cates[$cateid]['count']++;
    }
    $cates[$cateid]['array'] = $data->category;
}

$csv = "";
foreach($cates as $k => $v) {
    $csv .= $k.",".$v['count'].",\n";
}
echo $csv;

file_put_contents("./category_list.csv", $csv);

?>
