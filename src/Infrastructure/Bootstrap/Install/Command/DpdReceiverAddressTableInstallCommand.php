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

class DpdReceiverAddressTableInstallCommand implements InstallCommandInterface
{
    public function getName()
    {
        return \DPDReceiverAddress::$definition['table'];
    }

    public function getCommand()
    {
        return '
             CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . pSQL(\DPDReceiverAddress::$definition['table']) . '` (
              `id_dpd_receiver_address` INT(11) UNSIGNED AUTO_INCREMENT,
              `id_order` INT(10) UNSIGNED NOT NULL,
              `id_origin_address` INT(10) UNSIGNED NOT NULL,
              PRIMARY KEY (`id_dpd_receiver_address`),
              UNIQUE (`id_order`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;
        ';
    }
}
