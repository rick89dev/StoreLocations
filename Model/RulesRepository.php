<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Bounteous\StoreLocations\Api\Data\RulesInterface;
use Bounteous\StoreLocations\Api\RulesRepositoryInterface;
use Bounteous\StoreLocations\Model\ResourceModel\Rules\CollectionFactory;

class RulesRepository implements RulesRepositoryInterface
{
    protected $resource;
    protected $_rulesFactory;
    protected $loadedRules = null;
    /**
     * @var CollectionFactory
     */
    protected $rulesCollectionFactory;

    public function __construct(
        \Bounteous\StoreLocations\Model\ResourceModel\Rules $resource,
        RulesFactory $rulesFactory,
        CollectionFactory $rulesCollectionFactory
    )
    {
        $this->resource = $resource;
        $this->_rulesFactory = $rulesFactory;
        $this->rulesCollectionFactory = $rulesCollectionFactory->create();
    }

    /**
     * @param string $id
     * @return array
     */
    public function cloneRule($id): array
    {
        $newRule = $this->_rulesFactory->create()->load($id);
        $newRule->unsetData("id_store");
        $newRule->save();
        return $newRule->getId();
    }

    /**
     * @param RulesInterface $rules
     * @param bool $saveOptions
     * @return RulesInterface
     * @throws CouldNotSaveException
     */
    public function save(RulesInterface $rules, $saveOptions = false): RulesInterface
    {
        try {
            $this->resource->save($rules);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $rules;
    }

    /**
     * @param string $id
     * @return mixed|RulesInterface
     * @throws NoSuchEntityException
     */
    public function get($id)
    {
        $rules = $this->_rulesFactory->create();

        if (!empty($id) ) {
            if (isset($this->loadedRules[$id])) {
                return $this->loadedRules[$id];
            }

            $this->resource->load($rules, $id);

            if (!$rules->getId()) {
                throw new NoSuchEntityException(__('Rules with id "%1" does not exist.', $id));
            }
        }

        return $rules;
    }

    /**
     * @throws CouldNotDeleteException
     */
    public function delete($rules)
    {
        try {
            $this->resource->delete($rules);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
    }

    /**
     * @param false $forceReload
     * @return array|RulesInterface[]
     */
    public function getAll($forceReload = false): array
    {
        if (empty($this->loadedRules) || $forceReload)
        {
            $rules = $this->rulesCollectionFactory->load();
            $loadedRules = [];
            foreach ($rules as $rule) {
                $loadedRules[$rule->getId()] = $rule;
            }
            $this->loadedRules = $loadedRules;
        }
        return $this->loadedRules;
    }
}
