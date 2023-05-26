<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;
use Entity\Artist;
use Entity\Exception\EntityNotFoundException;
use Html\AppWebpage;
use Entity\Cover;

/**
if(isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
    $artistId = $_GET['artistId'];

    $requete = MyPDO::getInstance()->prepare(<<<SQL
        SELECT name
        FROM artist
        WHERE id = ?;
    SQL);

    $requete->execute([$artistId]);

    $webpage = new WebPage();
    if ($requete->rowCount() == 0) {
        http_response_code(404);
        header('Location: index.php', response_code: 302);
        exit();
    } else {
        $nom = $webpage->escapeString($requete->fetch()['name']);
        $webpage->setTitle("Album de " . $nom);

        $reqAlbums = MyPDO::getInstance()->prepare(
            <<<SQL

            SELECT year, name
            FROM album
            WHERE artistId = {$artistId}
            ORDER BY year DESC, name;

        SQL
        );

        $reqAlbums->execute();

        while (($ligne = $reqAlbums->fetch()) !== false) {
            $webpage->appendContent("<p>" . $ligne['year'] . ' ' . $webpage->escapeString($ligne['name']));
        }
    }
    echo $webpage->toHTML();
} else {
    header('Location: index.php', response_code: 302);
    exit();
}
**/

if(isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
    $artistId = intval($_GET['artistId']);

    try {
        $artiste = (new Entity\Artist())->findById($artistId);
    } catch (EntityNotFoundException) {
        http_response_code(404);
        exit();
    }

    $webpage = new AppWebpage('Albums de '. $artiste->getName());

    $albums = $artiste->getAlbums();

    $index = 0;
    $webpage->appendContent('<ol style="list-style-type: none" class="list">');
    while ($index < count($albums)) {
        $actualAlbum = $albums[$index];
        $webpage->appendContent("    <li class='album'> ". "<img src='http://localhost:8080/cover.php?coverId={$actualAlbum->getCoverId()}'>" ."<div><p class='album__year'>". $actualAlbum->getYear(). "</p>". " ". "<p class='album__name' >" . $webpage->escapeString($actualAlbum->getName()). "</p></div></li>\n");
        $index++;
    }
    $webpage->appendContent('</ol>');
    echo $webpage->toHTML();
} else {
    header('Location: index.php', response_code: 302);
    exit();
}
