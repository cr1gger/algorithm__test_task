<?php
# основное изображение
$imageSource = 'img-test.jpg';
$imgInstance = imagecreatefromjpeg($imageSource);
$imgSizes=getimagesize($imageSource);

# уменьшаем его до 16х16
$smallImage = imagecreatetruecolor(16,16);
imagecopyresized($smallImage, $imgInstance , 0, 0 , 0, 0, 16, 16, $imgSizes[0], $imgSizes[1]);
imagedestroy($imgInstance);

# перебираем цвета маленького изображения
$allColors = [];
for($i=0;$i<16;$i++){
    for($j=0;$j<16;$j++){
        $colorIndex = dechex(imagecolorat($smallImage,$j,$i));
        if (!isset($allColors[$colorIndex])) $allColors[$colorIndex] = 0;
        $allColors[$colorIndex]++;
    }
}

# выводим тот цвет который встречался чаще всего
imagedestroy($smallImage);
echo "#" . array_search(max($allColors), $allColors);
