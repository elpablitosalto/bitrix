<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?
$value = $_POST['value'];
$arResult = array('RESULT' => 'NO');
//$arResult['_POST'] = $_POST;

if (strlen($value) > 0) {
    $data = [
        'query' => $value
    ];
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Token 7bd62e47d7def3bff659a47e360617da5e74e904'
            ],
            'content' => json_encode($data)
        ]
    ];
    $builder = stream_context_create($options);
    //$document = file_get_contents('http://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party', false, $builder);
    $document = file_get_contents('http://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/party', false, $builder);
    $output = json_decode($document, true);
    //vardump($output);
    //$arResult['OUTPUT'] = $output;

    if (!empty($output['suggestions'])) {
        foreach ($output['suggestions'] as $key => $val) {
            if (strlen($val['value']) > 0 && strlen($val['data']['inn']) > 0) {
                $val['value'] = str_replace( '"', '&quot;', $val['value'] );
                $arResult['SUGGESTIONS'][] = array(
                    'value' => $val['value'],
                    'inn' => $val['data']['inn'],
                );
            }
        }
    }

    if (!empty($arResult['SUGGESTIONS'])) {
        $arResult['RESULT'] = 'SUCCESS';
    }
}
echo json_encode($arResult);
?>
<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>