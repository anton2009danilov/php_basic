<?php

//Задание 1

$a = rand(-10,10);
$b = rand(-10,10);
echo 'a = ' . $a . '<br>';
echo 'b = ' . $b . '<br>';

if ($a >= 0 && $b >= 0) {
    echo $a - $b;
} else if ($a < 0 && $b < 0) {
    echo $a * $b;
} else {
    echo $a + $b;
}

echo '<br><br>';

//Задание 2

$a = rand(0, 15);
echo 'a = ' . $a . '<br>';


switch($a) {
    case 0: echo $a++ . ' ';
    case 1: echo $a++ . ' ';
    case 2: echo $a++. ' ';
    case 3: echo $a++. ' ';
    case 4: echo $a++. ' ';
    case 5: echo $a++. ' ';
    case 6: echo $a++ . ' ';
    case 7: echo $a++ . ' ';
    case 8: echo $a++ . ' ';
    case 9: echo $a++ . ' ';
    case 10: echo $a++ . ' ';
    case 11: echo $a++ . ' ';
    case 12: echo $a++ . ' ';
    case 13: echo $a++ . ' ';
    case 14: echo $a++ . ' ';
    case 15: echo $a . ' ';
}

echo '<br><br>';

//Задание 3

function add($arg1, $arg2) {
    return $arg1 + $arg2;
};

function dim($arg1, $arg2) {
    return $arg1 - $arg2;
};

function mult($arg1, $arg2) {
    return $arg1 * $arg2;
};

function div($arg1, $arg2) {
    // if ($arg2 != 0) {
    //     return $arg1 / $arg2;
    // }

    // return 'Ошибка: деление на ноль';

    return $arg2 ? ($arg1 / $arg2): 'Ошибка: деление на ноль';
};

echo 'a + b = ' . add($a,$b) . '<br>';
echo 'a - b = ' . dim($a,$b) . '<br>';
echo 'a * b = ' . mult($a,$b) . '<br>';
echo 'a / b = ' . div($a,$b) . '<br>';
echo 'a / 0 = ' . div($a,0) . '<br>';

echo '<br><br>';

//Задание 4

function mathOperation(int $arg1, int $arg2, string $operation) {
    switch ($operation) {
        case 'add':    
            return add($arg1, $arg2);
        case 'dim':    
            return dim($arg1, $arg2);
        case 'mult':
            return mult($arg1, $arg2);
        case 'div':    
            return div($arg1, $arg2);
        default:
            return "Ошибка: задана несуществующая операция";
    }
}
echo 'a + b = ' . mathOperation($a, $b, 'add') . '<br>';
echo 'a - b = ' . mathOperation($a, $b, 'dim') . '<br>';
echo 'a * b = ' . mathOperation($a, $b, 'mult') . '<br>';
echo 'a / b = ' . mathOperation($a, $b, 'div') . '<br>';
echo 'a / 0 = ' . mathOperation($a, 0, 'div') . '<br>';

echo '<br><br>';

//Задание 6

function exponent($vol, $pow) {
    if ($pow == 0) {
        return 1;
    }

    return $vol * (exponent($vol, $pow - 1));
}

echo exponent(3, 3) . '<br>';
echo exponent(2, 3) . '<br><br>';

// $arr = [
//     'x' => 1,
//     'y' => 2
// ];
// extract($arr);
// echo $x;
// echo $y;