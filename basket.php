<?php
declare(strict_types=1);

const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;
const OPERATION_EDIT = 4;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
    OPERATION_EDIT => OPERATION_EDIT . '. Редактировать товар в списке покупок.',
];

$items = [];

do {
    system('clear');

    do {
        if (count($items)) {
            echo 'Ваш список покупок: ' . PHP_EOL;
            foreach ($items as $item) {
                echo $item['name'] . ' (' . $item['quantity'] . ')' . PHP_EOL;
            }
        } else {
            echo 'Ваш список покупок пуст.' . PHP_EOL;
        }

        echo 'Выберите операцию для выполнения: ' . PHP_EOL;
        echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
        $operationNumber = (int)trim(fgets(STDIN));

        if (!array_key_exists($operationNumber, $operations)) {
            system('clear');
            echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
        }
    } while (!array_key_exists($operationNumber, $operations));

    echo 'Выбрана операция: '  . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {
        case OPERATION_ADD:
            echo "Введите название товара для добавления в список: \n> ";
            $itemName = trim(fgets(STDIN));
            echo "Введите количество товара: \n> ";
            $itemQuantity = (int)trim(fgets(STDIN));
            $items[] = ['name' => $itemName, 'quantity' => $itemQuantity];
            break;

        case OPERATION_DELETE:
            echo 'Текущий список покупок:' . PHP_EOL;
            foreach ($items as $key => $item) {
                echo ($key + 1) . '. ' . $item['name'] . ' (' . $item['quantity'] . ')' . PHP_EOL;
            }
            echo 'Введите номер товара для удаления из списка:' . PHP_EOL . '> ';
            $itemNumber = (int)trim(fgets(STDIN));
            if ($itemNumber >= 1 && $itemNumber <= count($items)) {
                unset($items[$itemNumber - 1]);
                $items = array_values($items);
            } else {
                echo '!!! Неверный номер товара, повторите попытку.' . PHP_EOL;
            }
            break;

        case OPERATION_PRINT:
            echo 'Ваш список покупок: ' . PHP_EOL;
            foreach ($items as $item) {
                echo $item['name'] . ' (' . $item['quantity'] . ')' . PHP_EOL;
            }
            echo 'Всего ' . count($items) . ' позиций. '. PHP_EOL;
            echo 'Нажмите enter для продолжения';
            fgets(STDIN);
            break;

        case OPERATION_EDIT:
            echo 'Текущий список покупок:' . PHP_EOL;
            foreach ($items as $key => $item) {
                echo ($key + 1) . '. ' . $item['name'] . ' (' . $item['quantity'] . ')' . PHP_EOL;
            }
            echo 'Введите номер товара для редактирования:' . PHP_EOL . '> ';
            $itemNumber = (int)trim(fgets(STDIN));
            if ($itemNumber >= 1 && $itemNumber <= count($items)) {
                echo 'Введите новое название товара:' . PHP_EOL . '> ';
                $newItemName = trim(fgets(STDIN));
                echo 'Введите новое количество товара:' . PHP_EOL . '> ';
                $newItemQuantity = (int)trim(fgets(STDIN));
                $items[$itemNumber - 1] = ['name' => $newItemName, 'quantity' => $newItemQuantity];
            } else {
                echo '!!! Неверный номер товара, повторите попытку.' . PHP_EOL;
            }
            break;
    }

    echo "\n ----- \n";
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;
?>
