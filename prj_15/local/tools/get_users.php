<?
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_CHECK', true);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$fileImport = $_SERVER['DOCUMENT_ROOT'] . '/upload/users.csv';

if (!$USER->IsAdmin())
    die('Недостаточно прав для запуска скрипта');

if (!file_exists($fileImport))
    die('Файл импорта отсутствует');

$file = fopen($fileImport, 'r');
$startRow = 1;
$currentRow = 0;
$arSpecializations = [];

function getSpeciality()
{
    $arSpeciality = [];
    $rsEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME" => "UF_SPECIALITY"));
    while($arEnum = $rsEnum->GetNext()) {
        $arSpeciality[trim(toUpper($arEnum['VALUE']))] = [
            'ID' => $arEnum['ID'],
            'NAME' => $arEnum['VALUE']
        ];
    }

    return $arSpeciality;
}

function getSpecialization()
{
    $arSpecialization = [];
    $rsEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME" => "UF_SPECIALIZATION"));
    while($arEnum = $rsEnum->GetNext()) {
        $arSpecialization[trim(toUpper($arEnum['VALUE']))] = [
            'ID' => $arEnum['ID'],
            'NAME' => $arEnum['VALUE']
        ];
    }

    return $arSpecialization;
}

$arSpeciality = getSpeciality();
$arSpecialization = getSpecialization();

$specialityId = 1;
$specializationId = 62;

$obEnum = new CUserFieldEnum;
$obUser = new CUser;

while (($line = fgetcsv($file, 1024, ';')) !== FALSE) {
    $currentRow++;
    if ($startRow >= $currentRow)
        continue;

    $email = trim(toLower($line[0]));
    $password = md5($email);
    $arUserFields = [
        'NAME' => trim($line[2]),
        'SECOND_NAME' => trim($line[3]),
        'LAST_NAME' => trim($line[4]),
        'EMAIL' => $email,
        'LOGIN' => $email,
        'PASSWORD' => $password,
        'CONFIRM_PASSWORD' => $password,
        'PERSONAL_PHONE' => trim($line[1])
    ];

    $specialityName = trim($line[6]);
    if (mb_strlen($specialityName) > 0) {
        if (isset($arSpeciality[toUpper($specialityName)])) {
            $arUserFields['UF_SPECIALITY'] = $arSpeciality[toUpper($specialityName)]['ID'];
        } else {
            $obEnum->SetEnumValues(
                $specialityId,
                array(
                    'n0' => array(
                        'VALUE' => $specialityName,
                        'USER_FIELD_ID' => $specialityId,
                        'DEF' => 'N',
                        'SORT' => 500
                    )
                )
            );

            $arSpeciality = getSpeciality();
            $arUserFields['UF_SPECIALITY'] = $arSpeciality[toUpper($specialityName)]['ID'];
        }
    }

    $arCurrentSpecialization = array_filter([
        $line[7],
        $line[8],
        $line[9],
        $line[10]
    ]);

    if (count($arCurrentSpecialization) > 0) {
        foreach ($arCurrentSpecialization as $specializationName) {
            $specializationName = trim($specializationName);

            if (isset($arSpecialization[toUpper($specializationName)])) {
                $arUserFields['UF_SPECIALIZATION'][] = $arSpecialization[toUpper($specializationName)]['ID'];
            } else {
                $obEnum->SetEnumValues(
                    $specializationId,
                    array(
                        'n0' => array(
                            'VALUE' => $specializationName,
                            'USER_FIELD_ID' => $specializationId,
                            'DEF' => 'N',
                            'SORT' => 500
                        )
                    )
                );

                $arSpecialization = getSpecialization();
                $arUserFields['UF_SPECIALIZATION'][] = $arSpecialization[toUpper($specializationName)]['ID'];
            }
        }
    }

    if (!$obUser->Add($arUserFields)) {
        ?><pre><?print_r($arUserFields);?></pre><?php
        ShowError($obUser->LAST_ERROR);
        echo '<hr>';
    }
}
fclose($file);

?>