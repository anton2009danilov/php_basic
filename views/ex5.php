<?


function space_replace($str) {
    return str_replace(' ', '_', $str);
}

$str = 'a b c d';

echo space_replace($str) . '<br>';
