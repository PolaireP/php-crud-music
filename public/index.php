<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;
use Entity\Collection\ArtistCollection;
use Html\AppWebpage;

$webpage = new AppWebpage('Artistes');



$stmt = (new Entity\Collection\ArtistCollection())->findAll();

/*
while (($ligne = $stmt->fetch()) !== false) {
    $webpage ->appendContent('<p><a href="/artist.php?artistId='. $webpage->escapeString("{$ligne['id']}\n"). '">'. $webpage->escapeString("{$ligne['name']}\n"));
}
*/

$index = 0;
$webpage->appendContent("<ol class='list'>\n");
while ($index < sizeof($stmt)) {
    $webpage -> appendContent('<li><a href="/artist.php?artistId='.  $webpage->escapeString(strval($stmt[$index]->getId())). '">'. $webpage->escapeString($stmt[$index]->getName()). "</a></li>". "\n");
    $index++;
}
$webpage->appendContent("</ol>\n");


echo $webpage ->toHTML();
