<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Album;
use PDO;

class AlbumCollection
{
    public function findByArtistId(int $artistId): array
    {
        $request = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id, name, year, artistId, genreId, coverId
            FROM album
            WHERE artistId = ?
            
            SQL
        );

        $request->execute([$artistId]);

        return $request->fetchAll(PDO::FETCH_CLASS, Album::class);
    }
}
