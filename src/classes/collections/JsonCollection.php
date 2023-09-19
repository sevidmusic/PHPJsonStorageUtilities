<?php

namespace Darling\PHPJsonStorageUtilities\classes\collections;

use \Darling\PHPJsonStorageUtilities\interfaces\collections\JsonCollection as JsonCollectionInterface;
use \Darling\PHPJsonUtilities\interfaces\encoded\data\Json;

final class JsonCollection implements JsonCollectionInterface
{

    /**
     * @var array<int, Json> $json
     */
    private array $json = [];

    public function __construct(Json ...$json) {
        foreach($json as $jsonInstance) {
            $this->json[] = $jsonInstance;
        }
    }

    public function collection(): array
    {
        return $this->json;
    }

}

