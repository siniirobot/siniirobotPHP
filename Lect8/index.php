<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 6:23
 */

require_once  __DIR__ . '/authoload.php';

use Classes\Bicycle;
use Classes\Car;
use Classes\User;

/*require_once __DIR__ . '/Classes.php/Vehicle.php';
require_once  __DIR__ . '/Classes.php/Bicycle.php';
require_once __DIR__ .'/Classes.php/Car.php';
require_once __DIR__ .'/Classes.php/User.php';*/

$bicycle = new Classes\Bicycle('GT','green',20);
$bicycle->setDistance(100);
echo $bicycle->getTravelTime().'</br>';
echo $bicycle->getCountOfBurnedCalories().'</br>';

$user = new User('Piter',18);
$car = new Car('BMV','Black',100,500,$user);
$car->setDistance(1000);
echo $car->getTravelTime().'</br>';
echo $car ->getFuelConsumption().'</br>';