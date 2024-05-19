<?php

require_once __DIR__ . '/src/api/ControlDungeon.php';

$game = new DungeonAPI();
$game->loadDungeon();
$game->setCharToStartRoom(3);
$game->moveCharacter();
print_r($game->printShortestWay());
