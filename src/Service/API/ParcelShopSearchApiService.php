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


namespace Invertus\dpdBaltics\Service\API;

use DPDBaltics;
use Invertus\dpdBaltics\Config\Config;
use Invertus\dpdBaltics\Factory\APIParamsCountryFactory;
use Invertus\dpdBaltics\Infrastructure\Adapter\ModuleFactory;
use Invertus\dpdBalticsApi\Api\DTO\Request\ParcelShopSearchRequest;
use Invertus\dpdBalticsApi\Factory\APIRequest\ParcelShopSearchFactory;
use Psr\Log\LoggerInterface;

class ParcelShopSearchApiService
{
    /**
     * @var ParcelShopSearchFactory
     */
    private $parcelShopSearchFactory;
    /** @var DPDBaltics */
    private $module;
    /** @var LoggerInterface */
    private $logger;

    public function __construct(ParcelShopSearchFactory $parcelShopSearchFactory, ModuleFactory $moduleFactory, LoggerInterface $logger)
    {
        $this->parcelShopSearchFactory = $parcelShopSearchFactory;
        $this->module = $moduleFactory->getModule();
        $this->logger = $logger;
    }

    public function getAllCountryParcels(
        $iso,
        $fetchPudoPoints,
        $retrieveOpeningHours
    ) {
        $requestBody = $this->createParcelSearchRequest(
            $iso,
            $fetchPudoPoints,
            $retrieveOpeningHours,
            null,
            null,
            null
        );

        // NOTE: Poland parcel shop search is handled with LT endpoint
        if ($iso === Config::POLAND_ISO_CODE) {
            $apiParams = new APIParamsCountryFactory($this->module, new \Country(\Country::getByIso($iso)));
            $parcelShopSearchFactory = new ParcelShopSearchFactory($this->logger, $apiParams);
            $parcelShopSearch = $parcelShopSearchFactory->makeParcelShopSearch();
        } else {
            $parcelShopSearch = $this->parcelShopSearchFactory->makeParcelShopSearch();
        }

        $response = $parcelShopSearch->parcelShopSearch($requestBody);

        if ($response->getStatus() === Config::API_SUCCESS_STATUS && is_array($response->getParcelShops())) {
            return $response;
        }

        return $response;
    }

    private function createParcelSearchRequest(
        $iso,
        $fetchPudoPoints,
        $retrieveOpeningHours,
        $city,
        $pCode,
        $address
    ) {
        $shopSearchRequest = new ParcelShopSearchRequest($iso, $fetchPudoPoints, $retrieveOpeningHours);
        $shopSearchRequest->setCity($city);
        $shopSearchRequest->setPCode($pCode);
        $shopSearchRequest->setStreet($address);

        return $shopSearchRequest;
    }
}
