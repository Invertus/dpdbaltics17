<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */


namespace Invertus\dpdBaltics\Factory;

use Configuration;
use Country;
use DPDBaltics;
use Invertus\dpdBaltics\Config\ApiConfiguration;
use Invertus\dpdBaltics\Config\Config;
use Invertus\dpdBalticsApi\Api\Configuration\ApiConfigurationInterface;
use Invertus\dpdBalticsApi\ApiConfig\ApiConfig;
use Invertus\dpdBalticsApi\Factory\APIParamsFactoryInterface;

class APIParamsCountryFactory implements APIParamsFactoryInterface
{
    /**
     * @var DPDBaltics
     */
    private $module;
    /** @var Country */
    private $country;

    public function __construct(DPDBaltics $module, Country $country)
    {
        $this->module = $module;
        $this->country = $country;
    }

    public function getUsername()
    {
        return Configuration::get(Config::WEB_SERVICE_USERNAME);
    }

    public function getPassword()
    {
        return str_rot13(Configuration::get(Config::WEB_SERVICE_PASSWORD));
    }

    public function getModuleVersion()
    {
        return $this->module->version;
    }

    public function getPSVersion()
    {
        return _PS_VERSION_;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        if (Configuration::get(Config::SHIPMENT_TEST_MODE)) {
            $apiUrls = ApiConfig::TEST_URLS;
        } else {
            $apiUrls = ApiConfig::LIVE_URLS;
        }

        $wsCountry = $this->country->iso_code;

        if ($wsCountry === Config::POLAND_ISO_CODE) {
            $wsCountry = Config::LITHUANIA_ISO_CODE;
        }

        if (!$wsCountry || !isset($apiUrls[$wsCountry])) {
            $wsCountry = Config::LATVIA_ISO_CODE;
        }

        return $apiUrls[$wsCountry];

    }
}