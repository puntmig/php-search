<?php

/*
 * This file is part of the Apisearch PHP Client.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author PuntMig Technologies
 */

declare(strict_types=1);

namespace Apisearch\Repository;

use Apisearch\Model\Item;
use Apisearch\Model\ItemUUID;
use Apisearch\Query\Query;
use Apisearch\Result\Result;
use LogicException;

/**
 * Class InMemoryRepository.
 */
class InMemoryRepository extends Repository
{
    /**
     * @var array
     *
     * Items
     */
    private $items = [];

    /**
     * Search across the index types.
     *
     * @param Query $query
     *
     * @return Result
     */
    public function query(Query $query): Result
    {
        $this->normalizeItemsArray();
        $resultingItems = [];

        if (!empty($query->getFilters())) {
            foreach ($query->getFilters() as $filter) {
                if ($filter->getField() !== '_id') {
                    throw new LogicException('Queries by field different than UUID not allowed in InMemoryRepository. Only for testing purposes.');
                }

                $itemUUIDs = $filter->getValues();
                foreach ($itemUUIDs as $itemUUID) {
                    $resultingItems[$itemUUID] = $this->items[$this->getToken()][$itemUUID] ?? null;
                }
            }
        } else {
            $resultingItems = $this->items[$this->getToken()];
        }

        $resultingItems = array_values(
            array_slice(
                array_filter($resultingItems),
                $query->getFrom(),
                $query->getSize()
            )
        );

        $result = new Result($query, count($this->items[$this->getToken()]), count($resultingItems));
        foreach ($resultingItems as $resultingItem) {
            $result->addItem($resultingItem);
        }

        return $result;
    }

    /**
     * Reset the index.
     *
     * @var null|string
     */
    public function reset(? string $language)
    {
        $this->items[$this->getToken()] = [];
    }

    /**
     * Flush items.
     *
     * @param Item[]     $itemsToUpdate
     * @param ItemUUID[] $itemsToDelete
     */
    protected function flushItems(
        array $itemsToUpdate,
        array $itemsToDelete
    ) {
        $this->normalizeItemsArray();
        foreach ($itemsToUpdate as $itemToUpdate) {
            $this->items[$this->getToken()][$itemToUpdate->getUUID()->composeUUID()] = $itemToUpdate;
        }

        foreach ($itemsToDelete as $itemToDelete) {
            unset($this->items[$this->getToken()][$itemToDelete->composeUUID()]);
        }
    }

    /**
     * Normalize items array.
     */
    private function normalizeItemsArray()
    {
        if (!array_key_exists($this->getToken(), $this->items)) {
            $this->items[$this->getToken()] = [];
        }
    }
}
