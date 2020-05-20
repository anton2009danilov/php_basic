<?

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
    return $arg2 ? ($arg1 / $arg2): 'Ошибка: деление на ноль';
};

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