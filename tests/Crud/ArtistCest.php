<?php

namespace Crud;

use Entity\Artist;
use Entity\Exception\EntityNotFoundException;
use Tests\CrudTester;

class ArtistCest
{
    public function findById(CrudTester $I)
    {
        $artist = (new \Entity\Artist())->findById(4);
        $I->assertSame(4, $artist->getId());
        $I->assertSame('Slipknot', $artist->getName());
    }

    public function findByIdThrowsExceptionIfArtistDoesNotExist(CrudTester $I)
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            (new \Entity\Artist())->findById(PHP_INT_MAX);
        });
    }
}
