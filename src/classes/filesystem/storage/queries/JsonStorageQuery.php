<?php

namespace Darling\PHPJsonStorageUtilities\classes\filesystem\storage\queries;

use \Darling\PHPJsonStorageUtilities\classes\collections\ContainerCollection as ContainerCollectionDefault;
use \Darling\PHPJsonStorageUtilities\classes\collections\OwnerCollection as OwnerCollectionDefault;
use \Darling\PHPJsonStorageUtilities\classes\collections\IdCollection as IdCollectionDefault;
use \Darling\PHPJsonStorageUtilities\classes\collections\JsonStorageDirectoryPathCollection as JsonStorageDirectoryPathCollectionDefault;
use \Darling\PHPJsonStorageUtilities\classes\collections\NameCollection as NameCollectionDefault;
use \Darling\PHPJsonStorageUtilities\interfaces\collections\ContainerCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\collections\OwnerCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\collections\IdCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\collections\JsonStorageDirectoryPathCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\collections\NameCollection;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonFilePath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\paths\JsonStorageDirectoryPath;
use \Darling\PHPJsonStorageUtilities\interfaces\filesystem\storage\queries\JsonStorageQuery as JsonStorageQueryInterface;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Container;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Location;
use \Darling\PHPJsonStorageUtilities\interfaces\named\identifiers\Owner;
use \Darling\PHPTextTypes\interfaces\strings\Id;
use \Darling\PHPTextTypes\interfaces\strings\Name;

class JsonStorageQuery implements JsonStorageQueryInterface
{

    /**
     * Instantiate a new JsonStorageQuery instance.
     *
     * @param JsonStorageDirectoryPathCollection|null $jsonStorageDirectoryPaths
     * @param array<int, JsonFilePath>|null $jsonFilePaths
     * @param array<int, Location>|null $locations
     * @param ContainerCollection|null $containers
     * @param OwnerCollection|null $owners
     * @param NameCollection|null $names
     * @param IdCollection $ids|null
     *
     */
    public function __construct(
        private JsonStorageDirectoryPathCollection|null $jsonStorageDirectoryPaths = null,
        private array|null $jsonFilePaths = null,
        private array|null $locations = null,
        private ContainerCollection|null $containers = null,
        private OwnerCollection|null $owners = null,
        private NameCollection|null $names = null,
        private IdCollection|null $ids = null,
    ) { }

    public function jsonStorageDirectoryPaths(): JsonStorageDirectoryPathCollection
    {
        return $this->jsonStorageDirectoryPaths ?? new JsonStorageDirectoryPathCollectionDefault();
    }

    public function jsonFilePaths(): array
    {
        return $this->jsonFilePaths ?? [];
    }

    public function locations(): array
    {
        return $this->locations ?? [];
    }

    public function containers(): ContainerCollection
    {
        return $this->containers ?? new ContainerCollectionDefault();
    }

    public function owners(): OwnerCollection
    {
        return $this->owners ?? new OwnerCollectionDefault();
    }

    public function names(): NameCollection
    {
        return $this->names ?? new NameCollectionDefault();
    }

    public function ids(): IdCollection
    {
        return $this->ids ?? new IdCollectionDefault();
    }

}

