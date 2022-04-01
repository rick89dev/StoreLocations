<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

namespace Bounteous\StoreLocations\Block;

use Bounteous\StoreLocations\Api\Data\RulesInterface;
use Bounteous\StoreLocations\Api\ExamManagementInterface;
use Bounteous\StoreLocations\Model\ResourceModel\Rules;
use Bounteous\StoreLocations\Model\ResourceModel\Rules\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ResourceModel\Rules
     */
    protected $resource;

    /**
     * @var CollectionFactory
     */
    protected $rulesCollectionFactory;

    /**
     * @param Context $context
     * @param Rules $resource
     * @param CollectionFactory $rulesCollectionFactory
     */
    public function __construct(
        Context $context,
        Rules $resource,
        CollectionFactory $rulesCollectionFactory
    ) {
        parent::__construct($context);
        $this->resource = $resource;
        $this->rulesCollectionFactory = $rulesCollectionFactory;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        $param = $this->rulesCollectionFactory->create()->getData();

        return $param;
    }
}

