<?php
phpinfo();
exit;
$a = 1; $b = 2; $c = 3;

// if, else, elseif/else if
if ($a < b) {
	echo 'Это: ';
	echo '1';
} else if ($a < $c) {
	echo 'Это: ';
	echo '2';
} else {
	echo 'Это: ';
	echo '3';
}
?>
<br><br>
<!-- Альтернативный вариант 1 -->
<?php if ($a < $b): ?>
	Это: 1
<?php elseif ($a < $c): ?>
	Это: 2
<?php else: ?>
	Это: 3
<?php endif; ?>
<br><br>
<!-- Альтернативный вариант 2 -->
<?php
if ($a < $b):
	echo 'Это: ';
	echo '1';
elseif ($a < $c):
	echo 'Это: ';
	echo '2';
else:
	echo 'Это: ';
	echo '3';
endif;
?>
<br><br>
<?php
// WHILE
$i = 1;
while ($i <= 10) {
	echo $i++;
}
$i = 1;
while ($i <= 10):
	echo $i;
	$i++;
endwhile;

// DO-WHILE
$i = 0;
do {
	echo $i;
} while ($i > 0);

// FOR http://php.net/manual/ru/control-structures.for.php
for ($i = 1; $i <= 10; $i++) {
	echo $i;
}

// FOREACH
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4);
foreach ($arr as $k => $v) {
	echo $k.' => '.$v.'<br>';
}
foreach ($arr as $v) {
	echo $v.'<br>';
}

$arr = array(1, 2, 3, 4);
foreach ($arr as &$value) {
	$value = $value * 2;
}
// массив $arr сейчас таков: array(2, 4, 6, 8)
unset($value); // разорвать ссылку на последний элемент, чтобы случайно не изменить последний элемент массива через $value

// list
$array = [
	[1, 2],
	[3, 4],
];
foreach ($array as list($a, $b)) {
	echo "$a, $b<br>".PHP_EOL;
}

// break
$arr = array('один', 'два', 'три', 'четыре', 'стоп', 'пять');
foreach ($arr as $val) {
	if ($val == 'стоп') {
		break;    // эквивалентно 'break 1;'
	}
	echo "$val<br />\n";
}

// continue
foreach ($arr as $key => $value) {
	if (!($key % 2)) { // пропуск четных чисел
		continue;
	}
	do_something_odd($value);
}

// switch http://php.net/manual/ru/control-structures.switch.php
if ($i == 0) {
	echo "i равно 0";
} elseif ($i == 1) {
	echo "i равно 1";
} elseif ($i == 2) {
	echo "i равно 2";
}

switch ($i) {
	case 0:
		echo "i равно 0";
		break;
	case 1:
		echo "i равно 1";
		break;
	case 2:
		echo "i равно 2";
		break;
}

// require/require_once (E_COMPILE_ERROR), include/include_once (E_WARNING)
// echo ini_get('include_path');

// return http://php.net/manual/ru/function.return.php

// GOTO - забыли
