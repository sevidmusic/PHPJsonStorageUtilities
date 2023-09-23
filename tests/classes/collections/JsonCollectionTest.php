<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\collections;

use \Darling\PHPJsonStorageUtilities\classes\collections\JsonCollection;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\collections\JsonCollectionTestTrait;
use \Darling\PHPJsonUtilities\classes\encoded\data\Json;
use \Darling\PHPTextTypes\classes\strings\Id;

final class JsonCollectionTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The JsonCollectionTestTrait defines common tests for
     * implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\collections\JsonCollection
     * interface.
     *
     * @see JsonCollectionTestTrait
     *
     */
    use JsonCollectionTestTrait;

    public function setUp(): void
    {
        $this->setExpectedCollection(
            [
                new Json(new Id()),
                new Json($this->randomClassStringOrObjectInstance()),
                new Json($this->randomObjectInstance()),
                new Json($this->randomChars()),
            ]
        );
        $this->setJsonCollectionTestInstance(
            new JsonCollection(
                ...$this->expectedCollection(),
            )
        );
    }
}

