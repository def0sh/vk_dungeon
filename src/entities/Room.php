<?php

require_once 'Chest.php';
require_once 'Monster.php';

// Класс комнаты в подземелье
class Room
{
    public bool $chestBool;
    public bool $monsterBool;
    public ?Monster $monster;
    public ?Chest $chest;
    public string $number;
    public bool $exitRoom;
    public bool $visited;

    public function __construct($number, bool $monsterBool = false, bool $chestBool = false, $exitRoom = false)
    {
        $this->chestBool = $chestBool;
        $this->monsterBool = $monsterBool;
        $this->number = $number;
        $this->visited = false;
        $this->exitRoom = $exitRoom;

        // Если в комнате есть монстр, то создаем его объект
        if ($this->monsterBool) {
            $this->monster = new Monster();
        }

        // Если в комнате есть сундук, то создаем его объект
        if ($this->chestBool) {
            $this->chest = new Chest();
        }
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    // Информация. Является ли комната посещённой
    public function isVisited(): bool
    {
        return $this->visited;
    }

    // Отметить, что комната посещена
    public function setVisited(bool $visited): void
    {
        $this->visited = $visited;
    }

    // Получение силы монстра если он есть в комнате
    public function getMonsterStrength(): ?int
    {
        if ($this->hasMonster()) {
            return $this->monster->getStrength();
        }
        return null; // Если в комнате нет монстра
    }

    public function getChestPoints(): ?int
    {
        if ($this->hasChest()) {
            return $this->chest->ChestPoints();
        }
        return null;
    }

    public function getMonster(): ?Monster
    {
        if ($this->hasMonster()) {
            return $this->monster;
        }
        return null;
    }

    public function hasMonster(): bool
    {
        return $this->monsterBool;

    }
    public function hasChest(): bool
    {
        return $this->chestBool;

    }
    // Информация. Является ли комната выходом из лабиринта
    public function isExit(): bool
    {
        return $this->exitRoom;
    }
}
