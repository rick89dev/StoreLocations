<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Model;

use Magento\Framework\Model\AbstractModel;
use Bounteous\StoreLocations\Api\Data\RulesInterface;

class Rules extends AbstractModel implements RulesInterface
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Bounteous\StoreLocations\Model\ResourceModel\Rules');
    }

    /**
     * @return array|mixed|string|null
     */
    public function getIdStore()
    {
        return $this->getData(self::ID_STORE);
    }

    /**
     * @param $id
     * @return RulesInterface|Rules
     */
    public function setIdStore($id)
    {
        return $this->setData(self::ID_STORE, $id);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getStreet()
    {
        return $this->getData(self::STREET);
    }

    /**
     * @param $street
     * @return Rules
     */
    public function setStreet($street)
    {
        return $this->setData(self::STREET, $street);
    }

    /**
     * @return array|float|mixed|null
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * @param $city
     * @return Rules
     */
    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * @return array|float|mixed|null
     */
    public function getState()
    {
        return $this->getData(self::STATE);
    }

    /**
     * @param $state
     * @return Rules
     */
    public function setState($state)
    {
        return $this->setData(self::STATE, $state);
    }

    /**
     * @return array|float|mixed|null
     */
    public function getZipcode()
    {
        return $this->getData(self::ZIP_CODE);
    }

    /**
     * @param $zipCode
     * @return Rules
     */
    public function setZipcode($zipCode)
    {
        return $this->setData(self::ZIP_CODE, $zipCode);
    }

    /**
     * @return array|float|mixed|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @param $createdAt
     * @return Rules
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @return array|float|mixed|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @param $updatedAt
     * @return Rules
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
