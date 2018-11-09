<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 31.10.2018
 * Time: 19:07
 */

session_start();

/*if (isset($_SESSION['i'])) {
    $_SESSION['i']++;
}else{
    $_SESSION['i'] = 0;
}
echo $_SESSION['i'];*/

isset($_SESSION['i']) ? $_SESSION['i']++ : $_SESSION['i'] = 0;

echo $_SESSION['i'];
