<?php
// 姓名数组
$a[] = "Ava";
$a[] = "Brielle";
$a[] = "Caroline";
$a[] = "Diana";
$a[] = "Elise";
$a[] = "Fiona";
$a[] = "Grace";
$a[] = "Hannah";
$a[] = "Ileana";
$a[] = "Jane";
$a[] = "Kathryn";
$a[] = "Laura";
$a[] = "Millie";
$a[] = "Nancy";
$a[] = "Opal";
$a[] = "Petty";
$a[] = "Queenie";
$a[] = "Rose";
$a[] = "Shirley";
$a[] = "Tiffany";
$a[] = "Ursula";
$a[] = "Victoria";
$a[] = "Wendy";
$a[] = "Xenia";
$a[] = "Yvette";
$a[] = "Zoe";
$a[] = "Angell";
$a[] = "Adele";
$a[] = "Beatty";
$a[] = "Carlton";
$a[] = "Elisabeth";
$a[] = "Violet";

// 从 URL 获取 q 参数
$q = $_REQUEST["q"];

$hint = "";

// 查看数组中所有 hint，$q 是否与 "" 相同
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// 输出 "no suggestion"，如果未找到 hint 或输出正确的值
echo $hint === "" ? "no suggestion" : $hint;
?>