<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main;
use Hair\General;

Main\Loader::includeModule("iblock");
$request = Main\Context::getCurrent()->getRequest();
if (!empty($request->get("productId")) && !empty($request->get("propertyCode")) && !empty($request->get("propertyValue"))) {
    $rsProduct = \CIBlockElement::GetList(
        ["ID" => "ASC"],
        [
            'ID' => intval($request->get("productId")),
            'IBLOCK_ID' => INFINITY_CATALOG_IB_ID
        ]
    );
    if ($product = $rsProduct->GetNextElement()) {
        $arResult = $product->GetFields();
        $arResult["PROPERTIES"] = $product->GetProperties();
        $arResult["VARIANTS"] = false;
        if (!empty($arResult["PROPERTIES"][$request->get("propertyCode")]["VALUE"])) {
            $arResult["VARIANTS"] = General::infinityGetProductVariants($arResult["ID"], $request->get("propertyCode"));
        }
        if (!empty($arResult["VARIANTS"]) && !empty($arResult["VARIANTS"]["PROPERTY_VALUES"])) {
            $currentProduct = [];
            foreach ($arResult["VARIANTS"]["PRODUCT_VARIANTS"] as $productVariant) {
                $productProperty = $productVariant["PROPERTY_" . $request->get("propertyCode") . "_VALUE"];
                if ($productProperty == $request->get("propertyValue")) {
                    $currentProduct = $productVariant;
                    break;
                }
            }
            if (empty($currentProduct)) {
                exit(403);
            }
            // Маркетплейсы
            $marketplaces = CIBlockElement::GetList(
                array(),
                array(
                    "IBLOCK_ID" => MARKETPLACES,
                    "ACTIVE" => "Y",
                ),
                false,
                array()
            );
            $marketplaceArray = [];
            $arResult['MARKETPLACE_LINKS'] = [];
            while ($marketplace = $marketplaces->GetNextElement()) {
                $marketplaceFields = $marketplace->GetFields();
                $marketplaceProperties = $marketplace->GetProperties();
                $arResult['MARKETPLACE_LINKS'][$marketplaceFields["CODE"]] = array(
                    "ID" => $marketplaceFields["ID"],
                    "NAME" => $marketplaceFields["NAME"],
                    "CODE" => $marketplaceFields["CODE"],
                    "LOGO" => CFile::ResizeImageGet($marketplaceFields["DETAIL_PICTURE"], array('width' => 126, 'height' => 70), BX_RESIZE_IMAGE_PROPORTIONAL, true),
                    "URL" => $marketplaceProperties["URL"]["VALUE"],
                    "URL_MATCH" => $marketplaceProperties["URL_MATCH"]["VALUE"],
                );
            }
            //
            $popupHtml = "";
            ob_start();
?>
            <div class="links">
                <div class="links__list">
                    <? if (!empty($currentProduct["PROPERTY_LINK_VALUE"]) && !empty($arResult['MARKETPLACE_LINKS']["wildberries"])) : ?>
                        <? $link = $arResult['MARKETPLACE_LINKS']["wildberries"]; ?>
                        <a class="links__item" href="<?= $currentProduct["PROPERTY_LINK_VALUE"] ?>" target="_blank" id="marketplace-button-<?= $link['CODE'] ?>">
                            <img class="links__img" src="<?= $link['LOGO']["src"] ?>" alt="<?= (!empty($link['NAME']) ? 'Купить на ' . $link['NAME'] : '') ?>">
                        </a>
                    <? endif; ?>
                    <? if (!empty($currentProduct["PROPERTY_MARKETPLACE_OZON_VALUE"]) && !empty($arResult['MARKETPLACE_LINKS']["ozon"])) : ?>
                        <? $link = $arResult['MARKETPLACE_LINKS']["ozon"]; ?>
                        <a class="links__item" href="<?= $currentProduct["PROPERTY_MARKETPLACE_OZON_VALUE"] ?>" target="_blank" id="marketplace-button-<?= $link['CODE'] ?>">
                            <img class="links__img" src="<?= $link['LOGO']["src"] ?>" alt="<?= (!empty($link['NAME']) ? 'Купить на ' . $link['NAME'] : '') ?>">
                        </a>
                    <? endif; ?>
                    <? if (!empty($currentProduct["PROPERTY_MARKETPLACE_GOLDAPPLE_VALUE"]) && !empty($arResult['MARKETPLACE_LINKS']["gold-apple"])) : ?>
                        <? $link = $arResult['MARKETPLACE_LINKS']["gold-apple"]; ?>
                        <a class="links__item" href="<?= $currentProduct["PROPERTY_MARKETPLACE_GOLDAPPLE_VALUE"] ?>" target="_blank" id="marketplace-button-<?= $link['CODE'] ?>">
                            <img class="links__img" src="<?= $link['LOGO']["src"] ?>" alt="<?= (!empty($link['NAME']) ? 'Купить на ' . $link['NAME'] : '') ?>">
                        </a>
                    <? endif; ?>
                    <? if (!empty($currentProduct["PROPERTY_MARKETPLACE_RIVE_GAUCHE_VALUE"]) && !empty($arResult['MARKETPLACE_LINKS']["rive-gauche"])) : ?>
                        <? $link = $arResult['MARKETPLACE_LINKS']["rive-gauche"]; ?>
                        <a class="links__item" href="<?= $currentProduct["PROPERTY_MARKETPLACE_RIVE_GAUCHE_VALUE"] ?>" target="_blank" id="marketplace-button-<?= $link['CODE'] ?>">
                            <img class="links__img" src="<?= $link['LOGO']["src"] ?>" alt="<?= (!empty($link['NAME']) ? 'Купить на ' . $link['NAME'] : '') ?>">
                        </a>
                    <? endif; ?>
                    <a class="links__item" href="/distributors/">
                        <?
                        $src = '';
                        if (!empty($currentProduct['PROPERTY_DISTRIBUTORS_IMAGE_VALUE'])) {
                            $distributorsImage = CFile::ResizeImageGet($currentProduct['PROPERTY_DISTRIBUTORS_IMAGE_VALUE'], array('width' => 212, 'height' => 100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                            $src = $distributorsImage['src'];
                        } else {
                            $src = '/upload/images/default_buy_from_a_distributor.jpg';
                        }
                        ?>
                        <? if (!empty($src)) : ?>
                            <?  ?>
                            <img class="links__img" src="<?= $src ?>" alt="Купить у дистрибьютора">
                        <? else : ?>
                            Купить у дистрибьютора
                        <? endif; ?>
                    </a>
                </div>
            </div>
            <?
            $popupHtml = ob_get_contents();
            ob_end_clean();
            //
            $colorHtml = "";
            if (!empty($currentProduct["COLOR"])) {
                ob_start();
            ?>
                <select class="choices-select__select js-select">
                    <option class="choices-select__option">
                        <?= $currentProduct["COLOR"]["UF_NAME"] ?>
                    </option>
                </select>
<?
                $colorHtml = ob_get_contents();
                ob_end_clean();
            }
            //
            echo Main\Web\Json::encode([
                "popupLinksHtml" => $popupHtml,
                "colorSelectHtml" => $colorHtml,
            ]);
        }
    }
}
exit(200);
