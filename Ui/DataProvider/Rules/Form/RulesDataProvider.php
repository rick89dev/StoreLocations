<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Ui\DataProvider\Rules\Form;

use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;
use Bounteous\StoreLocations\Model\ResourceModel\Rules\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

class RulesDataProvider extends AbstractDataProvider
{
    /**
     * @var PoolInterface
     */
    private $pool;

    protected $dataPersistor;
    /**
     * @var StoreManagerInterface
     */
    private $_storeManager;

    /**
     * @param string                                     $name
     * @param string                                     $primaryFieldName
     * @param string                                     $requestFieldName
     * @param CollectionFactory                          $collectionFactory
     * @param DataPersistorInterface                     $persistor
     * @param PoolInterface                              $pool
     * @param StoreManagerInterface $storeManager
     * @param array                                      $meta
     * @param array                                      $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $persistor,
        PoolInterface $pool,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $persistor;
        $this->pool = $pool;
        $this->_storeManager = $storeManager;
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData))
        {
            return $this->loadedData;
        }
        if(!empty($this->collection->getItems()))
        {
            $items = $this->collection->getItems();
            foreach ($items as $rule)
            {
                $rule->load($rule->getId());
                $this->loadedData[$rule->getId()] = $rule->getData();
            }
            $data = $this->dataPersistor->get('store_locations');
            if (!empty($data))
            {
                $rule = $this->collection->getNewEmptyItem();
                $rule->setData($data);
                $this->loadedData[$rule->getId()] = $rule->getData();
                $this->dataPersistor->clear('store_locations');
            }
            return $this->loadedData;
        }
        return [];
    }

    /**
     * {@inheritdoc}
     * @throws LocalizedException
     * @since 101.0.0
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }
        return $meta;
    }
}
