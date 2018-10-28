<?php
require_once('b.php');
echo '<pre>';

// 1
$makefoo = true;
bar();
if ($makefoo) {
	function foo()
	{
		echo "Я не существую до тех пор, пока выполнение программы меня не достигнет.\n";
	}
}
if ($makefoo) foo();
function bar()
{
	echo "Я существую сразу с начала старта программы.\n";
}

// 2
function foo1()
{
	function bar1()
	{
		echo "Я не существую пока не будет вызвана foo().\n";
	}
}
foo1();
bar1();


// 3
function foo2()
{
	function bar2()
	{
		echo "bar2().\n";
	}
	echo "foo2().\n";
}
foo2();
bar2();
Test\foo2();

// 4
function recursion(int $a)
{
	if ($a < 20) {
		echo "$a\n";
		recursion($a + 1);
	}
}
recursion(7);

// 5
function add_some_extra(&$string)
{
    $string .= 'и кое-что еще.';
}
$str = 'Это строка, ';
add_some_extra($str);
echo $str;    // выведет 'Это строка, и кое-что еще.'


// 6, array
function makecoffee($type = "капучино")
{
    return "Готовим чашку $type.\n";
}
echo makecoffee();
echo makecoffee(null);
echo makecoffee("эспрессо");

// 7
function makeyogurt($type = "ацидофил", $flavour)
{
    return "Готовим чашку из бактерий $type со вкусом $flavour.\n";
} 
echo makeyogurt("малины");   // Не будет работать так, как мы могли бы ожидать

//  массив в список аргументов
function add($a, $b) {
    return $a + $b;
}

echo add(...[1, 2])."\n";

$a = [1, 2];
echo add(...$a);

// типизация возвращаемых значений
function sum($a, $b): float {
    return $a + $b;
}

// Работа с функциями посредством переменных
function foo() {
    echo "В foo()<br />\n";
}

function bar($arg = '')
{
    echo "В bar(); аргумент был '$arg'.<br />\n";
}

// Функция-обертка для echo
function echoit($string)
{
    echo $string;
}

$func = 'foo';
$func();        // Вызывает функцию foo()

$func = 'bar';
$func('test');  // Вызывает функцию bar()

$func = 'echoit';
$func('test');  // Вызывает функцию echoit()

// Callable
class Foo
{
    static function bar()
    {
        echo "bar\n";
    }
    function baz()
    {
        echo "baz\n";
    }
}

$func = array("Foo", "bar");
$func(); // выведет "bar"
$func = array(new Foo, "baz");
$func(); // выведет "baz"
$func = "Foo::bar";
$func(); // выведет "bar" в PHP 7.0.0 и выше; в предыдущих версиях это приведет к фатальной ошибке

// Анонимные - замыкания
echo preg_replace_callback('~-([a-z])~', function ($match) {
    return strtoupper($match[1]);
}, 'hello-world');
// выведет helloWorld

$greet = function($name)
{
    printf("Привет, %s\r\n", $name);
};

$greet('Мир');
$greet('PHP');






echo '</pre>';
