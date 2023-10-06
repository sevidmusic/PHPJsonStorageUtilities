<?php

namespace Darling\PHPJsonStorageUtilities\tests\classes\collections;

use \Darling\PHPJsonStorageUtilities\classes\collections\ContainerCollection;
use \Darling\PHPJsonStorageUtilities\classes\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\tests\PHPJsonStorageUtilitiesTest;
use \Darling\PHPJsonStorageUtilities\tests\interfaces\collections\ContainerCollectionTestTrait;
use \Darling\PHPTextTypes\classes\strings\ClassString;
use \Darling\PHPTextTypes\classes\strings\Name;
use \Darling\PHPTextTypes\classes\strings\Text;

final class ContainerCollectionTest extends PHPJsonStorageUtilitiesTest
{

    /**
     * The ContainerCollectionTestTrait defines common tests for
     * implementations of the
     * Darling\PHPJsonStorageUtilities\interfaces\collections\ContainerCollection
     * interface.
     *
     * @see ContainerCollectionTestTrait
     *
     */
    use ContainerCollectionTestTrait;

    public function setUp(): void
    {
        $this->setExpectedCollection(
            [
                new Container(
                    new ClassString(Name::class),
                ),
                new Container(
                    new ClassString(Text::class),
                ),
                new Container(
                    new ClassString(ClassString::class),
                ),
                new Container(
                    new ClassString(ContainerCollection::class),
                ),
                new Container(
                    new ClassString(Container::class),
                ),
            ]
        );
        $this->setContainerCollectionTestInstance(
            new ContainerCollection(
                ...$this->expectedCollection(),
            )
        );
    }

}

