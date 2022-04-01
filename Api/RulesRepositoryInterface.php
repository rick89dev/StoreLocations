<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Api;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Bounteous\StoreLocations\Api\Data\RulesInterface;

/**
 * @api
 */
interface RulesRepositoryInterface
{
    /**
     * Save store
     *
     * @param RulesInterface $rules
     * @param bool $saveOptions
     * @return RulesInterface
     * @throws InputException
     * @throws StateException
     * @throws CouldNotSaveException
     */
    public function save(RulesInterface $rules, bool $saveOptions = false): RulesInterface;

    /**
     * Get info about store by id
     *
     * @param string $id
     * @return RulesInterface
     * @throws NoSuchEntityException
     */
    public function get($id);

    /**
     * Delete store
     *
     * @param RulesInterface $rules
     * @return bool Will returned True if deleted
     * @throws StateException
     */
    public function delete($rules);

    /**
     * @param bool $forceReload
     * @return RulesInterface[]
     */
    public function getAll($forceReload = false);

    /**
     * @param string $id
     * @return array
     */
    public function cloneRule($id);
}

