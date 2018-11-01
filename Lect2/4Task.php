<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.10.2018
 * Time: 21:20
 */

error_reporting(E_ALL);

echo "<link rel='stylesheet' type='text/css' href='4TaskCSS.css'>";

$tableAnd = <<<LOGIC1
    <table class="table">
        <thead>
            <tr>
                <th>a</th>
                <th>b</th>
                <th>a &#8743; b</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>1</td>
                <td>0</td>
                <td>0</td>
            </tr><tr>
                <td>0</td>
                <td>1</td>
                <td>0</td>
            </tr><tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
        </tbody>
    </table>
LOGIC1;

$tableOr = <<<LOGIC2
    <table class="table">
        <thead>
            <tr>
                <th>a</th>
                <th>b</th>
                <th>a &#8744; b</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>1</td>
                <td>0</td>
                <td>1</td>
            </tr><tr>
                <td>0</td>
                <td>1</td>
                <td>1</td>
            </tr><tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
        </tbody>
    </table>
LOGIC2;

$tableXor = <<<LOGIC3
    <table class="table">
        <thead>
            <tr>
                <th>a</th>
                <th>b</th>
                <th>a &#8853; b</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <tr>
                <td>1</td>
                <td>0</td>
                <td>1</td>
            </tr><tr>
                <td>0</td>
                <td>1</td>
                <td>1</td>
            </tr><tr>
                <td>1</td>
                <td>1</td>
                <td>0</td>
            </tr>
        </tbody>
    </table>
LOGIC3;

echo $tableAnd.PHP_EOL;
echo $tableOr.PHP_EOL;
echo $tableXor.PHP_EOL;

