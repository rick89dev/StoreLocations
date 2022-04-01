<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Api\Data;

interface RulesInterface
{
    const ID_STORE         = 'id_store';
    const NAME             = 'name';
    const STREET           = 'street';
    const CITY             = 'city';
    const STATE            = 'state';
    const ZIP_CODE         = 'zipcode';
    const CREATED_AT       = 'created_at';
    const UPDATED_AT       = 'updated_at';

    /**
     * @return string
     */
    public function getIdStore();

    /**
     * @param int $id
     * @return RulesInterface
     */
    public function setIdStore($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return RulesInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @param string $street
     * @return $this
     */
    public function setStreet($street);

    /**
     * @return float
     */
    public function getCity();

    /**
     * @param float $city
     * @return $this
     */
    public function setCity($city);

    /**
     * @return float
     */
    public function getState();

    /**
     * @param $state
     * @return $this
     */
    public function setState($state);

    /**
     * @return float
     */
    public function getZipcode();

    /**
     * @param float $zipCode
     * @return $this
     */
    public function setZipcode($zipCode);

    /**
     * @return float
     */
    public function getCreatedAt();

    /**
     * @param float $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * @return float
     */
    public function getUpdatedAt();

    /**
     * @param float $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}
