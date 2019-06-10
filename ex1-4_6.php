<?php

//Задание 1

$a = rand(-10,10);
$b = rand(-10,10);
echo 'a = ' . $a . '<br>';
echo 'b = ' . $b . '<br>';

if ($a >= 0 && $b >= 0) {
    echo abs($a - $b);
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
    case 0: echo 0 . ' ';
    case 1: echo 1 . ' ';
    case 2: echo 2 . ' ';
    case 3: echo 3 . ' ';
    case 4: echo 4 . ' ';
    case 5: echo 5 . ' ';
    case 6: echo 6 . ' ';
    case 7: echo 7 . ' ';
    case 8: echo 8 . ' ';
    case 9: echo 9 . ' ';
    case 10: echo 10 . ' ';
    case 11: echo 11 . ' ';
    case 12: echo 12 . ' ';
    case 13: echo 13 . ' ';
    case 14: echo 14 . ' ';
    case 15: echo 15 . ' ';
}

echo '<br><br>';

//Задание 3

function add(int $arg1, int $arg2) {
    return $arg1 + $arg2;
};

function dim(int $arg1, int $arg2) {
    return $arg1 - $arg2;
};

function mult(int $arg1, int $arg2) {
    return $arg1 * $arg2;
};

function div(int $arg1, int $arg2) {
    if ($arg2 != 0) {
        return $arg1 / $arg2;
    }

    return 'Ошибка: деление на ноль';
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

    if ($pow == 1) {
        return $vol;
    }

    if ($pow == 2) {
        return $vol * $vol;
    }

    return $vol * (exponent($vol, $pow - 1));
}

echo exponent(2, 5) . '<br>';
echo exponent(2, 3) . '<br><br>';

// $arr = [
//     'x' => 1,
//     'y' => 2
// ];
// extract($arr);
// echo $x;
// echo $y;