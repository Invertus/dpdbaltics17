<?php

namespace Invertus\dpdBaltics\Infrastructure\Bootstrap\Install;

class ConfigurationInstaller implements InstallerInterface
{
    public function init(): void
    {
        //NOTE only covering these order states because other will be created via OrderStateInstaller and their value will be set there.
        $this->setForAllEnvironments(
            OrderStatusConfig::KLARNA_PAYMENT_ORDER_STATE_CAPTURED, (int) \Configuration::get('PS_OS_PAYMENT')
        );

        $this->setForAllEnvironments(
            OrderStatusConfig::KLARNA_PAYMENT_ORDER_STATE_CANCELLED, (int) \Configuration::get('PS_OS_CANCELED')
        );

        $this->setForAllEnvironments(
            OrderStatusConfig::KLARNA_PAYMENT_ORDER_STATE_REFUNDED, (int) \Configuration::get('PS_OS_REFUND')
        );

        //When installing Klarna payment module, environment is automatically set to production
        \Configuration::updateValue(Config::KLARNA_PAYMENT_IS_PRODUCTION_ENVIRONMENT, 1);

        $this->setForAllEnvironments(Config::KLARNA_PAYMENT_DEBUG_MODE, 0);
    }

    private function setForAllEnvironments(array $idByEnvironment, int $value): void
    {
        \Configuration::updateValue($idByEnvironment['production'], $value);
        \Configuration::updateValue($idByEnvironment['sandbox'], $value);
    }
}