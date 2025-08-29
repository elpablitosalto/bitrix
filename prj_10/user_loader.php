<?php
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_CHECK', true);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$user = new CUser;

$file = fopen($_SERVER['DOCUMENT_ROOT'] . '/upload/user.csv', 'r');
$temp_table = fopen($_SERVER['DOCUMENT_ROOT'] . '/upload/user_temp.csv','w');
$lineNumber = 0;
while (($line = fgetcsv($file, null, ';')) !== FALSE) {
    if ($lineNumber > 100) {
        fputcsv($temp_table, $line, ';');
    } else {
        $socialNetworkId = preg_replace( '/[^0-9]/', '', $line[1]);
        
        if (substr($line[1], 0, 2) == 'vk') {
            $login = 'VKuser' . $socialNetworkId;
        } else if (substr($line[1], 0, 8) == 'facebook') {
            $login = 'FB_' . $socialNetworkId;
        }

        $arFields = Array(
            "NAME"              => trim($line[3]),
            "LAST_NAME"         => trim($line[4]),
            "LOGIN"             => $login,
            "LID"               => "s1",
            "ACTIVE"            => "Y",
            "GROUP_ID"          => array(3,4),
            "EXTERNAL_AUTH_ID"    => "socservices",
            "XML_ID" => $socialNetworkId,
            "UF_EXTERNAL_ID" => preg_replace( '/[^0-9]/', '', $line[0])
        );

        if (mb_strlen($arFields['NAME']) == 0 && toLower($line[2]) != 'none')
            $arFields['NAME'] = $line[2];

        if (toLower($line[8]) != 'none')
            $arFields['PERSONAL_BIRTHDAY'] = date('d.m.Y', strtotime($line[8]));

        $ID = $user->Add($arFields);
        if (intval($ID) > 0)
            echo "Пользователь успешно добавлен.<br>";
        else {
            echo $user->LAST_ERROR;

            if (mb_strpos($user->LAST_ERROR, 'уже существует') === false) {
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/upload/user_log.txt', print_r([$user->LAST_ERROR, $line, $arFields], true), FILE_APPEND);
            }
        }
    }

    $lineNumber++;
}
fclose($file);
fclose($temp_table);
rename($_SERVER['DOCUMENT_ROOT'] . '/upload/user_temp.csv',$_SERVER['DOCUMENT_ROOT'] . '/upload/user.csv');
?>
<script>
    setTimeout(function() {
        location.reload();
    }, 3000);
</script>
