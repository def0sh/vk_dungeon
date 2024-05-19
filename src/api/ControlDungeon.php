<?php

require_once __DIR__ . "/../backend/Dungeon.php";

// Основной класс управления игры
class DungeonAPI
{
    public int $points;
    public array $shortestWay;
    public array $roomGraph;
    public Dungeon $newGame;
    public int $startRoom;
    public string $pathToJson = __DIR__ . '/../data/dungeon_scheme.json';

    public function loadDungeon(): void
    {
        $jsonString = file_get_contents($this->pathToJson);
        $jsonData = json_decode($jsonString,true);
        $this->roomGraph = convertGraphToRoomObjects($jsonData);
    }

    // Поместить игрока в стартовую комнату
    public function setCharToStartRoom(int $start): void
    {
        $this->startRoom = $start;
        $this->newGame = new Dungeon($this->startRoom, $this->roomGraph);
    }

    // Сохранить очки игрока
    public function savePoints($points): void {
        $this->points = $points;
    }

    // Начать движение
    public function moveCharacter(): void {

        list($this->shortestWay, $this->points) =
            $this->newGame->startDungeon($this->roomGraph, $this->startRoom, );
    }

    // Показать кратчайший путь до выхода
    public function printShortestWay(): string{
        echo "Кратчайший путь до комнаты с выходом: ";
        return  implode('-',  $this->shortestWay[0]);
    }
}
