<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Block\Adminhtml;

use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\LocalizedException;

class Rules extends Container
{

    const GRID_BLOCK = 'Bounteous\StoreLocations\Block\Adminhtml\Rules\Grid';

    /**
     * @var string
     */
    protected $_template = 'rules/rules.phtml';

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid
     *
     * @return void
     * @throws LocalizedException
     */
    protected function _prepareLayout()
    {
        $this->buttonList->add(
            'add',
            [
                'id' => 'add_new_rule',
                'label' => __('Add Stores'),
                'onclick' => "window.location='" . $this->_getCreateUrl() . "'",
                'class' => 'add primary add-template'
            ]
        );
        $this->toolbar->pushButtons($this, $this->buttonList);
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock(self::GRID_BLOCK, 'bounteous.rules.grid')
        );
    }

    /**
     * @return string
     */
    protected function _getCreateUrl(): string
    {
        return $this->getUrl(
            'stores/*/new'
        );
    }

    /**
     * @return string
     */
    protected function _getCreateImportUrl(): string
    {
        return $this->getUrl(
            'stores/*/import'
        );
    }

    /**
     * Render grid
     *
     * @return string
     */
    public function getGridHtml(): string
    {
        return $this->getChildHtml('grid');
    }
}

