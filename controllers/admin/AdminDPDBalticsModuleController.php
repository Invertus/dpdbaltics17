<?php

require_once dirname(__DIR__).'/../vendor/autoload.php';

class AdminDPDBalticsModuleController extends ModuleAdminController
{
    public function postProcess()
    {
        Tools::redirectAdmin($this->context->link->getAdminLink(DPDBaltics::ADMIN_SETTINGS_CONTROLLER));
        return parent::postProcess(); // TODO: Change the autogenerated stub
    }
}
