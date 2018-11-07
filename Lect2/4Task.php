<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.10.2018
 * Time: 21:20
 */

error_reporting(E_ALL);

echo "<link rel='stylesheet' type='text/css' href='4TaskCSS.css'>";

if (0 && 0){
    $a0b0 ='true';
}else{
    $a0b0 ='false';
}
if (1 && 0){
    $a1b0 ='true';
}else{
    $a1b0 ='false';
}

if (0 && 1){
    $a0b1 ='true';
}else{
    $a0b1 ='false';
}

if (1 && 1){
    $a1b1 ='true';
}else{
    $a1b1 ='false';
}
$tableAnd = <<<LOGIC1
    <table class="table">
        <thead>
            <tr>
                <th>a</th>
                <th>b</th>
                <th>a &#8743; b</th>
                <th> = </th>
            </tr>
        </thead>
        <body>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>a && b</td>
                <td>$a0b0</td>
            </tr>
            <tr>
                <td>1</td>
                <td>0</td>
                <td>a && b</td>
                <td>$a1b0</td>
            </tr><tr>
                <td>0</td>
                <td>1</td>
                <td>a && b</td>
                <td>$a0b1</td>
            </tr><tr>
                <td>1</td>
                <td>1</td>
                <td>a && b</td>
                <td>$a1b1</td>
            </tr>
        </body>
    </table>
LOGIC1;

if (0 || 0){
    $a0b0 ='true';
}else{
    $a0b0 ='false';
}

if (1 || 0){
    $a1b0 ='true';
}else{
    $a1b0 ='false';
}

if (0 || 1){
    $a0b1 ='true';
}else{
    $a0b1 ='false';
}

if (1 || 1){
    $a1b1 ='true';
}else{
    $a1b1 ='false';
}

$tableOr = <<<LOGIC2
    <table class="table">
        <thead>
            <tr>
                <th>a</th>
                <th>b</th>
                <th>a &#8744; b</th>
                <th> = </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>a || b</td>
                <td>$a0b0</td>
            </tr>
            <tr>
                <td>1</td>
                <td>0</td>
                <td>a || b</td>
                <td>$a1b0</td>
            </tr><tr>
                <td>0</td>
                <td>1</td>
                <td>a || b</td>
                <td>$a0b1</td>
            </tr><tr>
                <td>1</td>
                <td>1</td>
                <td>a || b</td>
                <td>$a1b1</td>
            </tr>
        </tbody>
    </table>
LOGIC2;

if (0 xor 0){
    $a0b0 ='true';
}else{
    $a0b0 ='false';
}

if (1 xor 0){
    $a1b0 ='true';
}else{
    $a1b0 ='false';
}

if (0 xor 1){
    $a0b1 ='true';
}else{
    $a0b1 ='false';
}

if (1 xor 1){
    $a1b1 ='true';
}else{
    $a1b1 ='false';
}

$tableXor = <<<LOGIC3
    <table class="table">
        <thead>
            <tr>
                <th>a</th>
                <th>b</th>
                <th>a &#8853; b</th>
                <th> = </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>a xor b</td>
                <td>$a0b0</td>
            </tr>
            <tr>
                <td>1</td>
                <td>0</td>
                <td>a xor b</td>
                <td>$a1b0</td>
            </tr><tr>
                <td>0</td>
                <td>1</td>
                <td>a xor b</td>
                <td>$a0b1</td>
            </tr><tr>
                <td>1</td>
                <td>1</td>
                <td>a xor b</td>
                <td>$a1b1</td>
            </tr>
        </tbody>
    </table>
LOGIC3;

echo $tableAnd.PHP_EOL;
echo $tableOr.PHP_EOL;
echo $tableXor.PHP_EOL;

