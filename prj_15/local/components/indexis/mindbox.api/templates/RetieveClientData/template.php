<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Context,
    \Bitrix\Main\Web\HttpClient;


$httpClient = new HttpClient(
    ["waitResponse" => true]
);
$httpClient->setHeader('Content-Type', 'application/json; charset=utf-8', true);
$httpClient->setHeader('Accept', 'application/json', true);
$httpClient->setHeader('Authorization', 'Mindbox secretKey="UuvIL3KjrIlhBYopvI7knFJsVluL8JYZ"', true);

$query = \Bitrix\Main\Web\Json::encode($arParams["DATA"]);

//todo хранить статус в базе
$isConfirmed = \Bitrix\Main\Web\Json::decode($httpClient->post(
    "https://api.mindbox.ru/v3/operations/sync?endpointId=geropharm.Website&operation=API.RetrieveClientData",
    $query
));

$showBLock = true;
if(isset($isConfirmed["customer"]["subscriptions"]) && is_array($isConfirmed["customer"]["subscriptions"])){
    foreach($isConfirmed["customer"]["subscriptions"] as $subscription){
        if(!isset($subscription["topic"]) && $subscription["pointOfContact"] == "Email"){
            if($subscription["isSubscribed"])
                $showBLock = false;
        }
    }
}

if($showBLock == true){
    ?>
    <div class="dp-page__notes" onclick="sendRequestMail()">
        <div class="dp-confirm-email">
            <a class="dp-confirm-email__link" href="#">
                <div class="dp-confirm-email__icon"></div>
                <div class="dp-confirm-email__caption">
                    <p class="font-weight_medium">Подтвердите свой е-mail</p>
                    <p>Чтобы не пропускать новые материалы</p>
                </div>
            </a>
        </div>
    </div>

    <script>
        function sendRequestMail(){
            var request = BX.ajax.runComponentAction('indexis:profile', "confirmEmail", {
                mode: 'class',
                cache: false,
            });

            request.then(function (response) {
                if(response.status != "success"){
                    alert("Ошибка отправки подтверждения");
                } else {
                    alert("Ссылка для подтверждения отправлена на ваш Email");
                }
            }, function (response) {

            });
        }
    </script>
    <?php
}
?>
