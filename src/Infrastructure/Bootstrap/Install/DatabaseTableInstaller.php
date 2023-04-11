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

namespace Invertus\dpdBaltics\Infrastructure\Bootstrap\Install;

use KlarnaPayment\Module\Infrastructure\Bootstrap\Exception\CouldNotInstallModule;
use KlarnaPayment\Module\Infrastructure\Bootstrap\Install\Command\InstallCommandInterface;
use KlarnaPayment\Module\Infrastructure\Bootstrap\Install\Command\KlarnaPaymentLogsTableInstallCommand;
use KlarnaPayment\Module\Infrastructure\Bootstrap\Install\Command\DpdReceiverAddressTableInstallCommand;

class DatabaseTableInstaller implements InstallerInterface
{
    private $klarnaPaymentLogsTableInstallCommand;

    private $klarnaPaymentOrdersTableInstallCommand;

    public function __construct(
        KlarnaPaymentLogsTableInstallCommand $klarnaPaymentLogsTableInstallCommand,
        DpdReceiverAddressTableInstallCommand $klarnaPaymentOrdersTableInstallCommand
    ) {
        $this->klarnaPaymentLogsTableInstallCommand = $klarnaPaymentLogsTableInstallCommand;
        $this->klarnaPaymentOrdersTableInstallCommand = $klarnaPaymentOrdersTableInstallCommand;
    }

    /**
     * @return void
     *
     * @throws CouldNotInstallModule
     */
    public function init(): void
    {
        $commands = $this->getCommands();

        foreach ($commands as $command) {
            if (false == \Db::getInstance()->execute($command->getCommand())) {
                throw CouldNotInstallModule::failedToInstallDatabaseTable($command->getName());
            }
        }
    }

    /**
     * @return InstallCommandInterface[]
     */
    private function getCommands(): array
    {
        return [
            $this->klarnaPaymentLogsTableInstallCommand,
            $this->klarnaPaymentOrdersTableInstallCommand,
        ];
    }
}