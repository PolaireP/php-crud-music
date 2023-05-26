<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Cover
{
    private int $id;
    private string $jpeg;/**
 * @return int
 */
    public function getId(): int
    {
        return $this->id;
    }/**
 * @return string
 */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): Cover
    {
        $request = MyPdo::getInstance()->prepare(
            <<<SQL
                SELECT id, jpeg
                FROM cover
                WHERE id = ?;
            SQL
        );
        $request->execute([$id]);
        $request->setFetchMode(PDO::FETCH_CLASS, Cover::class);
        $reqFetch = $request->fetch();
        if ($reqFetch != false) {
            return $reqFetch;
        } else {
            throw new EntityNotFoundException('Cover introuvable');
        }
    }

}
