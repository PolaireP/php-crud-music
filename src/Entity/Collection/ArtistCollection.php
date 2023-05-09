<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Artist;
use PDO;

class ArtistCollection
{
    /**
     * Méthode permettant de récupérer tous les artistes de la base de donnée
     * avec leur id et leur nom.
     *
     * @return Artist[] Renvoi d'un tableau d'entité Artist
     */
    public function findAll(): array
    {
        $request = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id, name
            FROM artist
            ORDER BY name
        SQL
        );

        $request->execute();

        return $request->fetchAll(PDO::FETCH_CLASS, Artist::class);
    }
}
