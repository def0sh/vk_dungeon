<?php

require_once __DIR__ . "/../entities/Room.php";
require_once __DIR__ . "/../entities/Character.php";
require_once __DIR__ . "/fight.php";

// Поиск кратчайшего пути в подземелье. Алгоритм BFS.
class Dungeon
{
    public int $startRoom;
    public array $roomGraph;
    public Character $character;

    public function __construct(int $startRoom, $roomGraph)
    {
        $this->startRoom = $startRoom;
        $this->roomGraph = $roomGraph;
        $this->character = new Character();
    }

    public function startDungeon(array $graph, int $startRoom): array
    {
        return $this->bfsDungeon($graph, $startRoom);
    }

    // ToDo. Для поэтапных шагов по лабиринту можно добавить механизм сессий.
    function bfsDungeon(array $graph, int $root)
    {
        $queue = new SplQueue();
        $queue->enqueue([$root, [$root]]);
        echo "Начинаем путь с комнаты $root... \n";
        while (!$queue->isEmpty()) {
            list($vertex, $path) = $queue->dequeue();
            foreach ($graph[$vertex] as $neighbour) {
                if (!$neighbour->isVisited()) {
                    // Если в комнате есть сундук, то забираем очки
                    if ($neighbour->hasChest()) {
                        echo "Найден сундук. Берем награду... \n";
                        $this->character->increasePoints($neighbour->getChestPoints());
                    }
                    // Если в комнате есть монстр, то сражаемся. После этого забираем его силу.
                    if ($neighbour->hasMonster()) {
                        echo "Идет сражение с монстром... \n";
                        $monster = $neighbour->getMonster();
                        $rewardPoints = makeFight($this->character, $monster);
                        $this->character->increasePoints($rewardPoints);
                    }
                    // Если комната является выходом - завершаем игру
                    if ($neighbour->getNumber() == 10) {
                        echo "Выход найден! ";
                        $path[] = $neighbour->getNumber();
                        $shortestPath[] = $path;
                        return [$shortestPath, $this->character->getPoints()];
                    }
                    $neighbour->setVisited(true);
                    $queue->enqueue([$neighbour->getNumber(), array_merge($path, [$neighbour->getNumber()])]);
                }
            }

        }
    }
}

// Функция получает граф в виде словаря и преобразует его в граф объектов из комнат.
function convertGraphToRoomObjects(array $graph): array
{
    // Пример добавления сундуков и монстров к случайным комнатам
    $rooms = [];
    $randomRooms = array_rand($graph, 4);
    $monsterRooms = array_slice($randomRooms, 0, 2);
    $chestRooms = array_slice($randomRooms, 2);

    // Создаем объекты комнат для всех уникальных номеров в графе
    foreach ($graph as $roomNumber => $connections) {
        if (!isset($rooms[$roomNumber])) {
            $rooms[$roomNumber] = new Room($roomNumber);
        }
        // Заменяем номера комнат на объекты комнат в связях между комнатами
        foreach ($connections as $index => $neighbourNumber) {
            if (!isset($rooms[$neighbourNumber])) {
                if (in_array($neighbourNumber, $monsterRooms)) {
                    $rooms[$neighbourNumber] = new Room($neighbourNumber, true, false);
                } elseif (in_array($neighbourNumber, $chestRooms)) {
                    $rooms[$neighbourNumber] = new Room($neighbourNumber, false, true);
                } else {
                    $rooms[$neighbourNumber] = new Room($neighbourNumber);
                }
            }
            $connections[$index] = $rooms[$neighbourNumber];
        }
        $graph[$roomNumber] = $connections;
    }
    return $graph;
}
