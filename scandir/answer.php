<?php
# Обязательный аргумент --path принимает строку, которая является директорией, с неё начнется сканирование включая её саму.
# Запуск из консоли, пример:
# php answer.php --path "C:\Program Files (x86)\Common Files"
require_once('Cloner.php');

$args = getopt(
    '',
    [
        'path:'
    ]
);
$cloner = new Cloner($args['path'] ?? null);
$cloner->start();