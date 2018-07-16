<?php
header('Content-Type: application/json;charset=utf-8');
// 主音色
$tonic_ratio = $_GET['tonic_ratio'] ?? 50;

$three = rand(10, 19);
$two = rand(20, 30);
$one = 100 - ($tonic_ratio + $three + $two);
// 男否则女
if ($_GET['sex'] === '1') {
	$a = [
		'清秀气质' => '青年音',
		'木讷' => '呆萌音',
		'低沉磁性' => '青叔音',
		'慵懒' => '青受音',
	];
	$ones = array_rand($a, 3);
	$twos = array_rand($a, 3);
} else {
	$a = [
		'清秀气质' => '青年音',
		'木讷' => '呆萌音',
		'低沉磁性' => '青叔音',
		'慵懒' => '青受音',
	];
	$ones = array_rand($a, 3);
	$twos = array_rand($a, 3);
}

$data = [
	"error_code" => 0,
	"error_reason" => "",
	"error_url" => "",
	"now_at" => 1531543122,
	"consonant1" => [
		$one => $ones[0] . $a[$twos[0]],
	],
	"consonant2" => [
		$two => $ones[1] . $a[$twos[1]],
	],
	"consonant3" => [
		$three => $ones[2] . $a[$twos[2]],
	],
	"apple_stable_version" => 28,
	"android_stable_version" => 17,
];

exit(json_encode($data));