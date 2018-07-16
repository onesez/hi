<?php
header('Content-Type: application/json;charset=utf-8');
// 男否则女
if ($_GET['sex'] === '1') {
	$arrs = [
		'少年音' => '/m/images/shaonian.png',
		'什么音' => '/m/images/men.png',
	];
} else {
	$arrs = [
		'少年音' => '/m/images/shaonian.png',
		'什么音' => '/m/images/men.png',
	];
}

$key = array_rand($arrs, 1);
$val = $arrs[$key];

$tonic_ratio = rand(50, 60); //主音色50%以上
$apple_stable_version = rand(1, 100);
$android_stable_version = rand(1, 100);

$data = [
	"error_code" => 0,
	"error_reason" => "",
	"error_url" => "",
	"now_at" => 1531542829,
	"tonic" => $key,
	"tonic_ratio" => $tonic_ratio,
	"avatar_url" => $val,
	"apple_stable_version" => $apple_stable_version,
	"android_stable_version" => $android_stable_version,
];

exit(json_encode($data));