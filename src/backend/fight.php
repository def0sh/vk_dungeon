<?php

// Функция сражения персонажа с монстром
function makeFight(Character $character, Monster $monster)
{
    // Генерируем случайное число
    $randomNumber = rand(0, 25);
    // Награда за победу - это сила монстра.
    $reward = $monster->getStrength();

    // Если сила монстра меньше случайного числа, персонаж побеждает
    if ($monster->getStrength() < $randomNumber) {
        $character->increasePoints($monster->getStrength());
    } // Если сила монстра больше или равна случайному числу, начинаем бой
    else {
        while ($monster->getStrength() > 0) {
            // Случайное число для атаки персонажа
            $attackNumber = rand(0, 30);
            // Если атака персонажа сильнее, уменьшаем силу монстра и завершаем бой
            if ($attackNumber < $monster->getStrength()) {
                $monster->decreaseStrength(5);
            } else {
                return $reward;
            }
        }
    }
}
