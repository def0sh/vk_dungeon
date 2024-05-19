<?php

//Класс монстра
class Monster
{

    public int $strength;

    // Сила монстра в зависимости от его типа
    private array $strengthType = [
        'easy' => 15,
        'medium' => 20,
        'hard' => 25
    ];

    // Сила монстра задается случайным образом
    public function __construct() {
        $randomType = array_rand($this->strengthType);
        $this->strength = $this->strengthType[$randomType];

    }

    // Узнать кол-во силы монстра
    public function getStrength(): int
    {
        return $this->strength;

    }

    // Уменьшить силу монстра
    public function decreaseStrength($amount): void
    {
        $this->strength -= $amount;

    }
}
