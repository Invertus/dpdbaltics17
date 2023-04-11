<?php

namespace Invertus\dpdBaltics\Infrastructure\Bootstrap\Install;

class Installer
{
    private $configurationInstaller;
    private $databaseTableInstaller;
    private $hookInstaller;

    public function __construct(
        ConfigurationInstaller $configurationInstaller,
        DatabaseTableInstaller $databaseTableInstaller,
        HookInstaller $hookInstaller,
        OrderStateInstaller $orderStateInstaller
    ) {
        $this->configurationInstaller = $configurationInstaller;
        $this->databaseTableInstaller = $databaseTableInstaller;
        $this->hookInstaller = $hookInstaller;
        $this->orderStateInstaller = $orderStateInstaller;
    }

    /**
     * @return void
     *
     * @throws CouldNotInstallModule
     * @throws KlarnaPaymentException
     */
    public function init(): void
    {
        try {
            $this->configurationInstaller->init();
            $this->databaseTableInstaller->init();
            $this->hookInstaller->init();
            $this->orderStateInstaller->init();
        } catch (CouldNotInstallModule $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw CouldNotInstallModule::unknownError($exception);
        }
    }
}