<?php

namespace Invertus\dpdBaltics\Infrastructure\Bootstrap\Install;

use KlarnaPayment\Module\Infrastructure\Adapter\ModuleFactory;
use KlarnaPayment\Module\Infrastructure\Bootstrap\Exception\CouldNotInstallModule;
use KlarnaPayment\Module\Infrastructure\Config\OrderStatusConfig;

class OrderStateInstaller implements InstallerInterface
{
    /** @var \KlarnaPayment */
    private $module;

    public function __construct(
        ModuleFactory $moduleFactory
    ) {
        $this->module = $moduleFactory->getModule();
    }

    /** {@inheritDoc} */
    public function init(): void
    {
        $this->createOrderStateForAllEnvironments(
            OrderStatusConfig::KLARNA_PAYMENT_ORDER_STATE_PENDING,
            'Pending',
            '#4069e1'
        );
    }

    /**
     * @param array{sandbox: string, production: string} $orderStatus
     * @param string $name
     * @param string $color
     *
     * @throws CouldNotInstallModule
     */
    private function createOrderStateForAllEnvironments(array $orderStatus, string $name, string $color): void
    {
        if (
            !$this->statusExists($orderStatus['production']) ||
            !$this->statusExists($orderStatus['sandbox'])
        ) {
            $this->clearOrderState($orderStatus['production']);
            $this->clearOrderState($orderStatus['sandbox']);

            $orderState = $this->createOrderState($name, $color);

            \Configuration::updateValue($orderStatus['production'], (int) $orderState->id);
            \Configuration::updateValue($orderStatus['sandbox'], (int) $orderState->id);
        }
    }

    /**
     * @throws CouldNotInstallModule
     */
    private function createOrderState(string $name, string $color): \OrderState
    {
        $orderState = new \OrderState();

        $orderState->send_email = false;
        $orderState->color = $color;
        $orderState->hidden = false;
        $orderState->delivery = false;
        $orderState->logable = false;
        $orderState->invoice = false;
        $orderState->unremovable = false;
        $orderState->module_name = $this->module->name;

        $languages = \Language::getLanguages(false);
        foreach ($languages as $language) {
            $orderState->name[$language['id_lang']] = $name;
        }

        try {
            $orderState->add();
        } catch (\Exception $exception) {
            throw CouldNotInstallModule::failedToInstallOrderState($name, $exception);
        }

        return $orderState;
    }

    private function statusExists(string $key): bool
    {
        $existingStateId = (int) \Configuration::get($key);
        $orderState = new \OrderState($existingStateId);

        // if state already existed we won't install new one.
        return \Validate::isLoadedObject($orderState);
    }

    private function clearOrderState(string $key): void
    {
        $existingStateId = (int) \Configuration::get($key);
        $orderState = new \OrderState($existingStateId);

        $orderState->delete();
    }
}
