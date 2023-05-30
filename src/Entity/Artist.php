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
    private ?int $id;
    private string $name;

    /**
 * @return int|null
 */
    public function getId(): ?int
    {
        return $this->id;
    }/**
 * @param int|null $id
 */
    private function setId(?int $id): void
    {
        $this->id = $id;
    }/**
 * @return string
 */
    public function getName(): string
    {
        return $this->name;
    }/**
        * @param string $name
        */
        public function setName(string $name): void
        {
            $this->name = $name;
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

            $request->setFetchMode(PDO::FETCH_CLASS, Artist::class);
            if ($reqFetch = $request->fetch()) {
                return $reqFetch;
            } else {
                throw new EntityNotFoundException('Artiste introuvable');
            }
        }

        /**
* @return $this : Artiste supprimé
         */
        public function delete(): Artist
        {
            $request = MyPdo::getInstance()->prepare(
                <<<SQL
                DELETE FROM artist
                WHERE id = ?;
            SQL
            );
            $request->execute([$this->id]);
            $this->setId(null);

            return $this;
        }

}
