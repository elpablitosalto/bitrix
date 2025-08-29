<?php

use Bitrix\Main;
use Bitrix\Main\Loader;

\CModule::AddAutoloadClasses(
    "",
    [
        '\NoboringFinance\General' => "/local/php_interface/classes/General.php",
        '\NoboringFinance\Agents' => "/local/php_interface/classes/Agents.php",
    ]
);

Loader::registerAutoLoadClasses(null, [
    // 'lib\UserType\CUserTypeStorybook' => APP_CLASS_FOLDER . 'UserType/CUserTypeStorybook.php'
    'lib\UserType\StorybookUserType' => APP_CLASS_FOLDER . 'UserType/StorybookUserType.php'
]);
