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


namespace Invertus\dpdBaltics\Util;

use DateInterval;
use DateTime;
use DateTimeZone;
use Invertus\dpdBaltics\Config\Config;

class TimeZoneUtility
{
    public static function getBalticTimeZone($format = 'H:i')
    {
        $today = self::getBalticTimeZoneAsDateTime();

        return $today->format($format);
    }

    public static function getCourierDefaultPickUpTime()
    {
        $currentTime = self::getBalticTimeZone();
        switch ($currentTime) {
            case $currentTime <= Config::COURIER_SAME_DAY_TIME_LIMITATION:
                /** @var DateTime $deliveryTimeFrom */
                $deliveryTimeFrom = self::getBalticTimeZoneAsDateTime();
                $deliveryTimeFrom->modify('+' . Config::COURIER_SAME_DAY_TIME_ADDITIONAL_MINUTES .' minutes');

                return $deliveryTimeFrom->format('Y-m-d H:i:s');
            default:
                /** @var DateTime $deliveryTimeFrom */
                $deliveryTimeFrom = self::getBalticTimeZoneAsDateTime();
                $deliveryTimeFrom->modify('+1 day');

                return $deliveryTimeFrom->format('Y-m-d 08:00:00');
        }
    }

    public static function getCourierDefaultWorkUntil()
    {
        $currentTime = self::getBalticTimeZone();
        switch ($currentTime) {
            case $currentTime < Config::COURIER_SAME_DAY_TIME_LIMITATION:
                /** @var DateTime $deliveryTimeFrom */
                $deliveryTimeFrom = self::getBalticTimeZoneAsDateTime();
                $deliveryTimeFrom->modify('+' . Config::COURIER_SAME_DAY_TIME_ADDITIONAL_MINUTES .' minutes');

                return $deliveryTimeFrom->format('Y-m-d 17:00:00');
            default:
                /** @var DateTime $deliveryTimeFrom */
                $deliveryTimeFrom = self::getBalticTimeZoneAsDateTime();
                $deliveryTimeFrom->modify('+1 day');

                return $deliveryTimeFrom->format('Y-m-d 17:00:00');
        }
    }

    public static function getBalticTimeZoneAsDateTime()
    {
        $tz = 'Europe/Vilnius';
        $tz_obj = new DateTimeZone($tz);

        return new DateTime("now", $tz_obj);
    }
}
