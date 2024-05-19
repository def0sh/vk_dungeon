# Тестовое задание VK. Лабиринт.

## Описание задачи:
Дано подземелье, состоящее из комнат, соединённых между собой дверьми. Подземелье имеет следующие характеристики:

Все комнаты квадратной формы.
Каждая комната может быть или тупиковой (то есть иметь всего одну дверь, через которую пользователь может войти и выйти), или содержать ещё хотя бы одну дверь, ведущую в другую комнату.
Подземелье проходимо (всегда есть маршрут к выходу).
Протяжённость подземелья произвольная.
#### Существует персонаж, у которого есть изменяемое количество очков:

1. Счёт не может стать отрицательным.
2. Персонаж может перемещаться сквозь дверь в любую прилегающую комнату и обязательно взаимодействует с её содержимым, если оно есть.

#### Комнаты бывают следующих типов:

1. Комната, где стоит сундук с сокровищем. Добавляет к счёту игрока случайное количество очков. Сундук может иметь 3 степени редкости, от которых зависят диапазоны очков, которые он даёт.
2. Комната с монстром. При победе над монстром игрок получает количество очков, равных силе монстра. Бой происходит путём генерации случайного числа и его сравнения с величиной силы монстра. Если число больше силы, монстр побеждён и игрок получает очки. Если меньше или равно, сила монстра уменьшается и раунд повторяется до тех пор, пока монстр не будет побеждён. Монстры могут быть разных типов. Тип влияет на диапазон стартовой силы монстра и величину, на которую уменьшается сила в случае неудачного раунда.
3. Пустая комната.
4. Посещённая комната, в которой игрок уже взаимодействовал с объектом. Считается пустой.
### Задача:
Используя ООП, напиши на PHP код API, который обрабатывает игровой сценарий:

1. Загружает извне информацию о подземелье в некотором формате.
2. Помещает игрока в стартовую комнату.
3. Обрабатывает перемещения игрока (вводятся извне), до тех пор пока игрок не достигнет выхода.
4. Сохраняет итоговые очки игрока после выхода.
5. В конце игры выводит на экран кратчайший путь прохождения лабиринта.
#### Пояснения:
- Генерировать подземелье не надо.
- Считаем, что одновременно активно 1 подземелье и его проходит 1 пользователь.

## Подход к решению:
- Представим подземелье в виде неориентированного графа.
- Для поиска кратчайшего пути до комнаты с выходом будем использовать алгоритм BFS (Breadth-first search).
- Основные классы: Character, Room, Chest, Monster, Dungeon, DungeonAPI.
- Управление осуществляется через класс DungeonAPI.
### Пример вывода консоли после игры:
```Начинаем путь с комнаты 3... 
Идет сражение с монстром... 
Идет сражение с монстром... 
Найден сундук. Берем награду... 
Найден сундук. Берем награду... 
Выход найден! Кратчайший путь до комнаты с выходом: 3->2->5->10

Process finished with exit code 0
