<?php

// Класс персонажа
class Character {
    public int $points;

    public function __construct($points=0) {
        $this->points = $points;
    }

    // Просмотр текущего кол-ва очков персонажа
    public function getPoints(): int {
        return $this->points;
    }

    // Увеличить кол-во очков после нахождения сундука или победы нам монстром
    public function increasePoints(int|null $amount): void {
        if ($amount !== null) {
            $this->points += $amount;
        }
    }
}
