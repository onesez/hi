<?php
// 测试程序，请忽略
// PHP随机匹配键值
$a = [
	'清秀气质' => '青年音',
	'木讷' => '呆萌音',
	'低沉磁性' => '青叔音',
	'慵懒' => '青受音',
];
$one = array_rand($a, 3);
$two = array_rand($a, 3);

var_dump($one[0]);
var_dump($a[$two[0]]);

var_dump($one[1]);
var_dump($a[$two[1]]);

var_dump($one[2]);
var_dump($a[$two[2]]);