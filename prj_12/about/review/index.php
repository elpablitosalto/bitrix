<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Отзывы о стоматологической клинике «Белый кролик» в Москве. Посмотрите, что говорят пациенты о наших медицинских услугах в Москве.");
$APPLICATION->SetTitle("Отзывы");?>

<?
$APPLICATION->IncludeComponent(
    "indexis:page.constructor",
    "",
    array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "SECTION_ID" => "60"
    )
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>