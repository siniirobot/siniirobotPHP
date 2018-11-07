<?php

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$page = isset($_GET['page']) ? intval($_GET['page']) : 0;

$lastPage = 50;
$prevPage = $page !== 0 ? $page - 1 : 1;
$forwardPage = $page !== $lastPage ? $page + 1 : $lastPage;

?>

<!DOCTYPE html>
<html>
<style>
    div{
        margin: auto;
        padding-top: 30px;
    }
</style>
<head>
	<title>20 на странице</title>
</head>
<body>
<div style="width: 400px;">
	<?php
	$fp = fopen('users.csv', 'rb');

	$i = 0;
	$j = 0;

	if ($fp) {
		while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
			$i++;
			if ($i / 20 > $page - 1) {
				echo $i . '-' . $data[0] . ' ' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</br>';
				$j++;
				if ($j == 20) {
					$j = 0;
					break;
				}
			}
		}
	} else {
		echo 'Проблемы с открытием файла';
	} ?>

</div>
<div style="width: 650px;">
    <form style="display: inline">
        <input type="button" value="Перейти к первой странице" onclick="location.href='index.php?page=1'">
    </form>
    <form style="display: inline">
        <input type="button" value="&#8592;" onclick="location.href='index.php?page=<?= $prevPage; ?>'">
    </form>
    <form style="display: inline" action="index.php" method="get">
        <input type="text" name="page" value="<?= $page; ?>">
    </form>
    <form style="display: inline">
        <input type="button" value="&#8594;" onclick="location.href='index.php?page=<?= $forwardPage; ?>'">
    </form>
    <form style="display: inline">
        <input type="button" value="Перейти к последней странице" onclick="location.href='index.php?page=<?=$lastPage?>'">
    </form>

</div>
</body>
</html>