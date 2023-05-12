<?php
/**
 * NOTICE OF LICENSE
 *
 * @author    INVERTUS, UAB www.invertus.eu <support@invertus.eu>
 * @copyright Copyright (c) permanent, INVERTUS, UAB
 * @license   Addons PrestaShop license limitation
 * @see       /LICENSE
 *
 *  International Registered Trademark & Property of INVERTUS, UAB
 */

namespace Invertus\dpdBaltics\Service;

use Address;
use Configuration;
use Country;
use Invertus\dpdBaltics\Config\Config;
use Language;
use Shop;
use State;
use Tools;
use Validate;

class GoogleApiService
{

    public function getFormattedGoogleMapsUrl()
    {
        $default_country = new Country((int)Tools::getCountry());
        $url = 'http';
        if ((Configuration::get('PS_SSL_ENABLED')) && Configuration::get('PS_SSL_ENABLED_EVERYWHERE')) {
            $url .='s';
        }
        $url .= '://maps.google.com/maps/api/js?';
        $url .= 'region='.Tools::substr($default_country->iso_code, 0, 2);
        if (Configuration::get(Config::GOOGLE_API_KEY)) {
            $url .= '&key='.Configuration::get(Config::GOOGLE_API_KEY);
        }
        return $url;
    }
}
