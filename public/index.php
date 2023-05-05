<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;

$webpage = new WebPage();



$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, name
    FROM artist
    ORDER BY name
SQL
);

$stmt->execute();

while (($ligne = $stmt->fetch()) !== false) {
    $webpage ->appendContent("<p>". $webpage->escapeString("{$ligne['name']}\n"));
}

echo $webpage ->toHTML();
