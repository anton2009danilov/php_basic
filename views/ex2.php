<?php
$n = 0;

do {
    if($n & 1){
        echo $n . ' - нечётное число<br>';
    } else {
        echo $n . ' - чётное число<br>';
    }
    $n++;
} while ($n <= 10);

?>