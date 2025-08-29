<?php

Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'BitrixTools'               => '/local/php_interface/lib/BitrixTools.php',
    'TemplateTools'             => '/local/php_interface/lib/TemplateTools.php',
    'CMShopCustom'              => '/local/php_interface/lib/CMShopCustom.php',
    'First\Catalog'             => '/local/php_interface/lib/Catalog.php',
    'First\Seo'                 => '/local/php_interface/lib/Seo.php',
    'First\Events'              => '/local/php_interface/lib/Events.php',
    'First\General'             => '/local/php_interface/lib/General.php',
    'First\Agents'             => '/local/php_interface/lib/Agents.php',
    'Disweb\FormValidatorPhone' => '/local/php_interface/validators/form_validator_phone.php',
    'Disweb\FormValidatorEmail' => '/local/php_interface/validators/form_validator_email.php',
    'Disweb\FormValidatorInn'   => '/local/php_interface/validators/form_validator_inn.php',
]);
