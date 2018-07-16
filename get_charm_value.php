<?php
header('Content-Type: application/json;charset=utf-8');

/**
 * 随机浮点数
 *
 * @author Wending <postmaster@g000.cn>
 * @param  最小数 $min [description]
 * @param  最大数 $max [description]
 * @return number       浮点数
 */
function randomFloat($min = 0, $max = 1) {
	return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}

$data = [
	"error_code" => 0,
	"error_reason" => "",
	"error_url" => "",
	"now_at" => 1531543006,
	"heartbeat_value" => sprintf("%.2f", randomFloat(5, 10)),
	"flirt_value" => sprintf("%.2f", randomFloat(5, 10)),
	"fall_down_value" => sprintf("%.2f", randomFloat(5, 10)),
	"grade" => 0,
	"apple_stable_version" => 28,
	"android_stable_version" => 17,
];

exit(json_encode($data));