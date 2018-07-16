<?php
header('Content-Type: application/json;charset=utf-8');
$propertys = [
	'攻', '守',
];

// 男否则女
if ($_GET['sex'] === '1') {
	$mates = [
		'少女音',
		'御姐音',
		'少萝音',
		'少御音',
		'萝莉音',
	];
} else {
	$mates = [
		'少女音',
		'御姐音',
		'少萝音',
		'少御音',
		'萝莉音',
	];
}

$mate = $mates[array_rand($mates, 1)];
$property = $propertys[array_rand($propertys, 1)];

$data = [
	"error_code" => 0,
	"error_reason" => "",
	"error_url" => "",
	"now_at" => 1531542984,
	"property" => $property,
	"mate" => $mate,
	"apple_stable_version" => 28,
	"android_stable_version" => 17,
];

exit(json_encode($data));