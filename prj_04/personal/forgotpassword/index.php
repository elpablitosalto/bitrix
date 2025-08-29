<?php
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
?>
<section class="content">
    <div class="container _inside-page">
        <div class="breadcrumbs">
            <ul class="breadcrumbs-list">
                <li class="breadcrumbs-list__item"><a href="#">Главная</a></li>
                <li class="breadcrumbs-list__item">Вход</li>
            </ul>
        </div>
        <div class="auth">
            <?$APPLICATION->IncludeComponent( "bitrix:system.auth.forgotpasswd",
                ".default",
                Array()
            );?>
        </div>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
