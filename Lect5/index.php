<?php

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
$lastPage = 49;
$prevPage = $page !== 0 ? $page - 1 : 1;
$forwardPage = $page !== $lastPage ? $page + 1 : $lastPage;

?>

<!DOCTYPE html>
<html>
<head>
	<title>20 на странице</title>
</head>
<body>
<div>
    <p>текущая страница <?= $page; ?></p>
	<?php
	$fp = fopen('users.csv', 'rb');

	$i = 0;
	$j = 0;

	if ($fp) {
		while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
			$i++;
			if ($i / 20 > $page) {
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
<div>
    <a href="/index.php?page=1">На первую страницу</a>
    <a href="/index.php?page=<?= $prevPage; ?>">Назад</a>

	<form action="/index.php" method="get">
		<input type="text" name="page" value="<?= $page; ?>">
    </form>

    <a href="/index.php?page=<?= $forwardPage; ?>">Вперед</a>
    <a href="/index.php?page=<?= $lastPage; ?>">На последнюю страницу</a>
</div>
</body>
</html>