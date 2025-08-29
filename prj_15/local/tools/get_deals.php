<?
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_CHECK', true);

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php'))
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/ext_www/vrachbudushego.ru';

require_once ($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

// Обмен идет в два этапа:
// 1. Запускаем задачу на сбор данных и получаем от сервиса специальный ключ
// 2. Когда сбор будет завершен, то по этому ключу получаем заказы

$accountName = 'vrach111';
$secretKey = 'NulmnBnpLCr3na0X9kuQmY5lacersoGCubFDJy1StAvAgJKCROoIURXglsdilvyPSKe1P2BZCpoe8HYhlXldwA7vInfInxpERCJzXZFZAo2gW6OikhtI4QPaZrSyiIpJ';

$gc = new GetCourse($accountName, $secretKey);
$es = new ExchangeStatus('get_deals');
$arLastExchange = $es->get();

if (
    is_array($arLastExchange)
    && isset($arLastExchange['success'])
    && $arLastExchange['success']
    && isset($arLastExchange['info']['export_id'])
) {
    // Если ранее уже сохранили ключ, то получаем заказы по нему
    $arAnswer = $gc->getDeals($arLastExchange['info']['export_id']);

    if (
        isset($arAnswer['success'])
        && $arAnswer['success']
        && isset($arAnswer['info']['items'])
        && is_array($arAnswer['info']['items'])
    ) {

        $arDeals = [];
        $arExchangeDealIds = [];
        $arExistDealIds = [];
        foreach ($arAnswer['info']['items'] as $arItem) {

            list(
                $gcDealId,
                $number,
                $gcUserId,
                $userName,
                $userEmail,
                $userPhone,
                $createdAt,
                $payedAt,
                $title
            ) = $arItem;

            $arExchangeDealIds[] = $gcDealId;

            $arDeals[] = [
                'gc_deal_id' => $gcDealId,
                'number' => $number,
                'gc_user_id' => $gcUserId,
                'user_name' => $userName,
                'user_email' => $userEmail,
                'user_phone' => $userPhone,
                'created_at' => $createdAt,
                'payed_at' => $payedAt,
                'title' => $title
            ];
        }

        if (count($arExchangeDealIds) > 0) {
            $deal = new Deal();
            $res = $deal->getList(
                ['ID' => 'DESC'],
                ['PROPERTY_ORDER_ID' => $arExchangeDealIds, 'ACTIVE' => 'Y', 'DATE_ACTIVE' => 'Y'],
                false,
                false,
                ['ID', 'PROPERTY_ORDER_ID']
            );

            while($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arExistDealIds[] = $arFields['PROPERTY_ORDER_ID_VALUE'];
            }

            foreach ($arDeals as $arDeal) {
                if (in_array($arDeal['gc_deal_id'], $arExistDealIds))
                    continue;

                $userId = $deal->createUserIfNotExist($arDeal['gc_user_id'], $arDeal['user_email'], $arDeal['user_name']);
                $dateActiveFrom = date('d.m.Y H:i:s', strtotime((!empty($arDeal['payed_at']) ? $arDeal['payed_at'] : $arDeal['created_at'])));

                var_dump($deal->add($arDeal['gc_deal_id'], $arDeal['title'], $userId, $dateActiveFrom));
            }
        }

        $es->clear();
    } else {
        ?><h3>Пока еще не удалось получить заказы:</h3><pre><?print_r($arAnswer)?></pre><?php
    }

    var_dump(1);
} else {
    // Иначе формируем задачу на сбор данных
    $arAnswer = $gc->prepareDeals([
        'status' => 'payed',
        'created_at[from]' => date('Y-m-d', strtotime('-1 week'))
    ]);

    $es->set($arAnswer);
    var_dump(2);
}

/*
$title = 'Мотовилин - Вебинар №2 Лечебная мотивация пациентов. Что с ней не так и как её повысить';
foreach (['courses', 'webinars'] as $entityCode) {
    $res = CIBlockElement::GetList(['SORT' => 'DESC', 'ID' => 'DESC'], [
        'IBLOCK_ID' => Indexis::getIblockId($entityCode, 'content'),
        'ACTIVE_DATE' => 'Y',
        'ACTIVE' => 'Y',
        '=PROPERTY_GC_NAME' => $title,
    ], false, ['nPageSize' => 1], [
        'ID',
        'IBLOCK_CODE',
        'IBLOCK_ID',
    ]);

    if ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();

        $arResult = [111];

        vardump($arProps['GC_NAME']);

        if (is_array($arProps['GC_NAME']['~VALUE'])) {
            foreach ($arProps['GC_NAME']['~VALUE'] as $index => $name) {
                if (toLower(trim($name)) == toLower($title)) {
                    $arResult = [
                        'ID' => $arFields['ID'],
                        'IBLOCK_CODE' => $arFields['IBLOCK_CODE'],
                        'PERIOD' => (isset($arProps['GC_PERIOD']['VALUE_XML_ID'][$index]) ? '+' . str_replace('_', ' ', $arProps['GC_PERIOD']['VALUE_XML_ID'][$index]) : '+6 months')
                    ];
                }
            }
        }

        return $arResult;
    }
}
*/
?>