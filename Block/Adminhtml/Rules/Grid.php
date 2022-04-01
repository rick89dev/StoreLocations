<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Block\Adminhtml\Rules;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Module\Manager;
use Bounteous\StoreLocations\Model\RulesFactory;

class Grid extends Extended
{
    /**
     * @var Manager
     */
    protected $moduleManager;

    /**
     * @var RulesFactory
     */
    protected $_rulesFactory;

    /**
     * @param Context $context
     * @param Data $backendHelper
     * @param RulesFactory $rulesFactory
     * @param Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        Data $backendHelper,
        RulesFactory $rulesFactory,
        Manager $moduleManager,
        array $data = []
    )
    {
        $this->_rulesFactory = $rulesFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     * @throws FileSystemException
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id_store');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection(): Grid
    {
        $collection = $this->_rulesFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return Grid
     * @throws LocalizedException
     */
    protected function _prepareColumns(): Grid
    {
        $this->addColumn(
            'id_store',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id_store',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );

        $this->addColumn(
            'name',
            [
                'header' => __('name'),
                'index' => 'name',
            ]
        );

        $this->addColumn(
            'street',
            [
                'header' => __('street'),
                'index' => 'street'
            ]
        );

        $this->addColumn(
            'city',
            [
                'header' => __('city'),
                'index' => 'city'
            ]
        );

        $this->addColumn(
            'state',
            [
                'header' => __('State'),
                'index' => 'state'
            ]
        );

        $this->addColumn(
            'zipcode',
            [
                'header' => __('Zip Code'),
                'index' => 'zipcode'
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header' => __('Created At'),
                'index' => 'created_at'
            ]
        );

        $this->addColumn(
            'updated_at',
            [
                'header' => __('Updated At'),
                'index' => 'updated_at'
            ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getGridUrl(): string
    {
        return $this->getUrl('stores/*/index', ['_current' => true]);
    }

    /**
     * @param $row
     * @return string
     */
    public function getRowUrl($row): string
    {
        return $this->getUrl(
            'stores/*/edit',
            ['id_store' => $row->getId()]
        );
    }

}
