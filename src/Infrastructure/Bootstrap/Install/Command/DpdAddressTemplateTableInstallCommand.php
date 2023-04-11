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

namespace Invertus\dpdBaltics\Infrastructure\Bootstrap\Install\Command;

class DpdAddressTemplateTableInstallCommand implements InstallCommandInterface
{
    public function getName()
    {
        return \DPDAddressTemplate::$definition['table'];
    }

    public function getCommand()
    {
        return '
             CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . pSQL(\DPDAddressTemplate::$definition['table']) . '` (
                  `id_dpd_address_template` INT(11) UNSIGNED AUTO_INCREMENT,
                  `name` VARCHAR(255) NOT NULL,
                  `type` VARCHAR(255) NOT NULL,
                  `full_name` VARCHAR(255) NOT NULL DEFAULT "",
                  `mobile_phone` VARCHAR(255) NOT NULL,
                  `mobile_phone_code` VARCHAR(255) NOT NULL,
                  `dpd_country_id` INT(11) NOT NULL DEFAULT 0,
                  `email` VARCHAR(255) NOT NULL DEFAULT "",
                  `zip_code` VARCHAR(255) NOT NULL DEFAULT "",
                  `dpd_city_name` VARCHAR(255) NOT NULL DEFAULT "",
                  `address` VARCHAR(255) NOT NULL,
                  `date_add` DATETIME NOT NULL,
                  `date_upd` DATETIME NOT NULL,
                  PRIMARY KEY (`id_dpd_address_template`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;
        ';
    }
}
