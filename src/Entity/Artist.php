<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\ArtistCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;
use Entity\Collection\AlbumCollection;

class Artist
{
    private int $id;
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function findById(int $id): Artist
    {
        $request = MyPdo::getInstance()->prepare(
            <<<SQL
                SELECT id, name
                FROM artist
                WHERE id = ?;
            SQL
        );

        $request->execute([$id]);

        if ($request->rowCount() == 0) {
            throw new EntityNotFoundException('Artiste introuvable');
        } else {
            $request->setFetchMode(PDO::FETCH_CLASS, Artist::class);
            return $request->fetch();
        }
    }

    public function getAlbums(): array
    {
        return AlbumCollection::class->findByArtistId($this->id);
    }
}
