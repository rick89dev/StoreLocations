<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Ui\DataProvider\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Registry;

class Rules extends AbstractModifier
{
    protected $_registry;

    /**
     * store constructor.
     *
     * @param Registry $registry
     */
    public function __construct(
        Registry $registry
    )
    {
        $this->_registry = $registry->registry('rules');
    }

    public function modifyMeta(array $meta): array
    {
        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data): array
    {
        return $data;
    }

}
