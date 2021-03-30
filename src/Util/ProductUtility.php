<?php

namespace Invertus\dpdBaltics\Util;

use Invertus\dpdBaltics\Config\Config;

class ProductUtility
{
    public static function hasAvailability($productReference) {
        if ($productReference === Config::PRODUCT_TYPE_SATURDAY_DELIVERY ||
            $productReference === Config::PRODUCT_TYPE_SATURDAY_DELIVERY_COD ||
            $productReference === Config::PRODUCT_TYPE_SAME_DAY_DELIVERY ||
            $productReference === Config::PRODUCT_TYPE_SAME_DAY_DELIVERY_LITHUANIA ||
            $productReference === Config::PRODUCT_TYPE_SAME_DAY_DELIVERY_LITHUANIA_COD) {
            return true;
        }

        return false;
    }

    public static function validateSameDayDelivery($countryIso, $city)
    {
        $city = strtolower($city);
        if (!in_array($countryIso, Config::getSameDeliveryDayCountries(), true)) {
            return false;

        }
        if (in_array($city, Config::getSameDeliveryDayCities($countryIso), true)) {
            return true;
        }

        return false;
    }
}