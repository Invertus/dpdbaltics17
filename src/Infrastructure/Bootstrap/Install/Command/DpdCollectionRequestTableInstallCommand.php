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

class DpdCollectionRequestTableInstallCommand implements InstallCommandInterface
{
    public function getName()
    {
        return 'dpd_address_template_shop';
    }

    public function getCommand()
    {
        return '
             CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . pSQL('dpd_address_template_shop') . '` (
                  `id_dpd_collection_request` INT(11) UNSIGNED AUTO_INCREMENT,
                  `shipment_date` DATETIME NOT NULL,
                  `pickup_address_full_name` VARCHAR(35) NOT NULL DEFAULT "",
                  `pickup_address_mobile_phone` VARCHAR(255) NOT NULL,
                  `pickup_address_mobile_phone_code` VARCHAR(255) NOT NULL,
                  `pickup_address_id_ws_country` INT(11) UNSIGNED NOT NULL,
                  `pickup_address_email` VARCHAR(255) NOT NULL,
                  `pickup_address_zip_code` VARCHAR(255) NOT NULL,
                  `pickup_address_city` VARCHAR(255) NOT NULL,
                  `pickup_address_address` VARCHAR(255) NOT NULL,
                  `receiver_address_full_name` VARCHAR(255) NOT NULL DEFAULT "",
                  `receiver_address_mobile_phone` VARCHAR(255) NOT NULL,
                  `receiver_address_mobile_phone_code` VARCHAR(11) NOT NULL,
                  `receiver_address_id_ws_country` INT(11) UNSIGNED NOT NULL,
                  `receiver_address_email` VARCHAR(255) NOT NULL,
                  `receiver_address_zip_code` VARCHAR(255) NOT NULL,
                  `receiver_address_city` VARCHAR(255) NOT NULL,
                  `receiver_address_address` VARCHAR(255) NOT NULL,
                  `info1` VARCHAR(255) NOT NULL,
                  `info2` VARCHAR(255) NOT NULL,
                  `id_shop` INT(11) UNSIGNED NOT NULL,
                  `date_add` DATETIME,
                  `date_upd` DATETIME,
                  PRIMARY KEY (`id_dpd_collection_request`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;
        ';
    }
}
