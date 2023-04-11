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

namespace Invertus\dpdBaltics\Infrastructure\Exception;

//NOTE class to define most used exception codes for our development.
class ExceptionCode
{
    //Configuration related codes should start with 2***
    const CONFIGURATION_UNSUPPORTED_CURRENCY = 2003;
    const CONFIGURATION_MERCHANT_IS_NOT_LOGGED_IN = 2004;

    //Infrastructure related code should start with 6***
    const INFRASTRUCTURE_FAILED_TO_INSTALL_DATABASE_TABLE = 6001;
    const INFRASTRUCTURE_FAILED_TO_UNINSTALL_DATABASE_TABLE = 6003;
    const INFRASTRUCTURE_FAILED_TO_INSTALL_MODULE_TAB = 6005;
    const INFRASTRUCTURE_FAILED_TO_UNINSTALL_MODULE_TAB = 6006;
    const INFRASTRUCTURE_FAILED_TO_INSTALL_ORDER_STATE = 6007;

    //Any other unhandled codes should start with 9***
    const UNKNOWN_ERROR = 9001;
}
