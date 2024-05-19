<?php

// Класс сундука
class Chest
{
    public int $points;

    // Кол-во награды в зависимости от редкости сундука
    private array $rewardPoints = [
        'common' => 5,
        'unusual' => 10,
        'rare' => 15
    ];

    // Тип сундука задается случайным образом
    public function __construct()
    {
        $randomType = array_rand($this->rewardPoints);
        $this->points = $this->rewardPoints[$randomType];

    }

    public function ChestPoints(): int
    {

        return $this->points;
    }
}
