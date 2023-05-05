<?php
declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;

if(isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
    $artistId = $_GET['artistId'];

    $requete = MyPDO::getInstance()->prepare(<<<SQL
        SELECT name
        FROM artist
        WHERE id = {$artistId};
    SQL);

    $requete->execute();

    $webpage = new WebPage();
    if ($requete->rowCount() == 0) {
        http_response_code(404);
        exit();
    }
    else {
        $nom = $webpage->escapeString($requete->fetch()['name']);
        $webpage->setTitle("Album de " . $nom);

        $reqAlbums = MyPDO::getInstance()->prepare(
            <<<SQL
            
            SELECT year, name
            FROM album
            WHERE artistID = {$artistId}
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