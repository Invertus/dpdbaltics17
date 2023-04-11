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

class DpdCourierRequestTableInstallCommand implements InstallCommandInterface
{
    public function getName()
    {
        return 'dpd_address_template_shop';
    }

    public function getCommand()
    {
        return '
             CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . pSQL('dpd_address_template_shop') . '` (
                  `id_dpd_courier_request` INT(11) UNSIGNED AUTO_INCREMENT,
                  `shipment_date` DATETIME NOT NULL,
                  `sender_name` VARCHAR(255) NOT NULL,
                  `sender_phone_code` VARCHAR(255) NOT NULL,
                  `sender_phone` VARCHAR(255) NOT NULL,
                  `sender_id_ws_country` INT(11) NOT NULL,
                  `country` VARCHAR(255) NOT NULL,
                  `sender_postal_code` VARCHAR(255) NOT NULL,
                  `sender_city` VARCHAR(255) NOT NULL,
                  `sender_address` VARCHAR(255) NOT NULL,
                  `sender_additional_information` VARCHAR(255) NOT NULL,
                  `order_nr` VARCHAR(255) NOT NULL DEFAULT "",
                  `pick_up_time` VARCHAR(255) NOT NULL,
                  `sender_work_until` VARCHAR(255) NOT NULL,
                  `weight` FLOAT(11) UNSIGNED NOT NULL,
                  `parcels_count` INT(11) NOT NULL,
                  `pallets_count` INT(11) NOT NULL,
                  `comment_for_courier` VARCHAR(255) NOT NULL,
                  `id_shop` INT(11) UNSIGNED NOT NULL,
                  `date_add` DATETIME,
                  `date_upd` DATETIME,
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;
        ';
    }
}
