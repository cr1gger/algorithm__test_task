<?php

$first = [1, 212, 3876, 481, 75, 36, 24, 76, 81, 2734, 6751, 53, 76, 4512, 364, 51826, 374, 61, 93, 26, 4517, 26, 3, 5, 4, 1, 23465, 851, 56253, 76, 41, 783, 26, 9461, 238, 674, 51, 95, 2, 39764];
$second = [7638, 2710, 4157, 82, 36017, 6397562, 93, 47, 519, 37985, 716038, 479176, 345872, 653486, 53, 48, 652, 9, 7, 4369278, 36, 48576, 2934765, 62973, 645, 62, 5364, 9, 7, 562, 9387, 465, 927346, 957, 2364, 9572, 69347, 956];

# находим среднее значение первого массива
$firstMiddle = array_sum($first) / count($first);

# убираем из второго массива числа ниже среднего значения, из первого массива
$validNumber = array_filter($second, function ($item) use ($firstMiddle) {
    if ($item > $firstMiddle) return true;
    else return false;
});

#выводим минимальное )
echo min($validNumber);