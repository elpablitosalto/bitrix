<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
$arPropertieValue = $item['DISPLAY_PROPERTIES']['DEV_508']['VALUE'];
$arComponentResult = $arParams['arComponentResult'];

//vardump($item);
// Адреса -->
$IBLOCK_CODE = $GLOBALS["arSiteConfig"]["arIblocksCodes"]["ADDRESSES"];
$this->arResult["arAddresses"] = array();
if (strlen($IBLOCK_CODE) > 0) {
    $arSelect = false;
    $arFilter = array(
        "IBLOCK_CODE" => $IBLOCK_CODE,
    );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arFields["PROPERTIES"] = $ob->GetProperties();

        //vardump( $arFields["PROPERTIES"]["COORDINATES"] );

        // Координаты -->
        $coordinates = $arFields["PROPERTIES"]["COORDINATES"]["VALUE"];
        $ar_coordinates = explode(",", $coordinates);
        $longitude = $ar_coordinates[0];
        $latitude = $ar_coordinates[1];
        // <--

        $arComponentResult["arAddresses"][$arFields["ID"]] = array(
            "NAME" => $arFields["NAME"],
            "ADDRESS" => $arFields["PROPERTIES"]["ADDRESS"]["VALUE"],
            "METRO" => $arFields["PROPERTIES"]["METRO"]["VALUE"],
            "FREE_PARKING" => $arFields["PROPERTIES"]["FREE_PARKING"]["VALUE"],
            "WORKING_TIME_PART_1" => $arFields["PROPERTIES"]["WORKING_TIME"]["VALUE"],
            "WORKING_TIME_PART_2" => $arFields["PROPERTIES"]["WORKING_TIME"]["DESCRIPTION"],
            "COORDINATES" => $arFields["PROPERTIES"]["COORDINATES"]["VALUE"],
            "LONGITUDE" => $longitude,
            "LATITUDE" => $latitude,
            "COORDINATES_STR" => $arFields["PROPERTIES"]["COORDINATES_STR"]["VALUE"],
            "HOW_TO_GET_CAR" => $arFields["PROPERTIES"]["HOW_TO_GET_CAR"]["VALUE"]["TEXT"],
            "HOW_TO_GET_PUB_TRT" => $arFields["PROPERTIES"]["HOW_TO_GET_PUB_TRT"]["VALUE"]["TEXT"],
        );
    }
}
// <-- Адреса    


//if (is_array($arPropertieValue) && count($arPropertieValue) > 0) {
{
?>
    <section class="nb-section nb-affiliated-section" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
        <div class="container" id="<?= $arParams['EDIT_AREA_ID'] ?>">
            <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
                <div class="nb-section__header is-tablet">
                    <?
                    // Вывод заголовка для десктопа -->
                    if (strlen($item["H_FST_PART_D"]) > 0) {
                    ?>
                        <div class="nb-section__title desktop">
                            <?
                            echo $item["H_FST_PART_D"];
                            if (strlen($item["H_SEC_PART_D"]) > 0) {
                            ?> <span class="font-weight_normal">
                                    <?= $item["H_SEC_PART_D"]; ?>
                                    <?
                                    if (strlen($item["H_THD_PART_D"]) > 0) {
                                    ?>
                                        <span class="nb-affiliated--phone"><?= $item["H_THD_PART_D"]; ?></span>
                                    <?
                                    }
                                    ?>
                                </span>
                            <?
                            }
                            ?>
                        </div>
                    <?
                    }
                    // <-- Вывод заголовка для десктопа

                    // Вывод заголовка для мобильного -->
                    if (strlen($item["H_FST_PART_M"]) > 0) {
                    ?>
                        <div class="nb-section__title mobile">
                            <?
                            echo $item["H_FST_PART_M"];
                            if (strlen($item["H_SEC_PART_M"]) > 0) {
                            ?> <span class="font-weight_normal">
                                    <?= $item["H_SEC_PART_M"]; ?>
                                    <?
                                    if (strlen($item["H_THD_PART_M"]) > 0) {
                                    ?>
                                        <span class="nb-affiliated--phone"><?= $item["H_THD_PART_M"]; ?></span>
                                    <?
                                    }
                                    ?>
                                </span>
                            <?
                            }
                            ?>
                        </div>
                    <?
                    }
                    // <-- Вывод заголовка для мобильного
                    ?>
                </div>
            <? endif; ?>
            <div class="nb-section__body">
                <div class="nb-affiliated--list row">
                    <?
                    //vardump($_COOKIE);
                    $cookieAddressId = 0;
                    foreach ($arPropertieValue as $arItem) {
                        $arItemValues = $arItem['SUB_VALUES'];
                        $address_id = $arItemValues["DEV_508_ADDRESS"]["VALUE"];
                        if ($_COOKIE['chosenAddressId'] == $address_id) {
                            $cookieAddressId = $_COOKIE['chosenAddressId'];
                        }
                    }
                    //echo 'cookieAddressId = '.$cookieAddressId.'<br />';

                    $i = 0;
                    foreach ($arPropertieValue as $arItem) {
                        $i++;
                        $arItemValues = $arItem['SUB_VALUES'];

                        $address_id = $arItemValues["DEV_508_ADDRESS"]["VALUE"];
                        //$address_code = $arItemValues["DEV_508_ADDRESS"]["CODE"];
                        //vardump($item['DISPLAY_PROPERTIES']['DEV_508_ADDRESS']['VALUE']);
                        //vardump($arItemValues["DEV_508_ADDRESS"]);
                        if (intval($address_id) <= 0)
                            continue;

                        // Название -->
                        $name = $arComponentResult["arAddresses"][$address_id]["NAME"];
                        // <--   

                        $address = $arComponentResult["arAddresses"][$address_id]["ADDRESS"];
                        $coordinates_str = $arComponentResult["arAddresses"][$address_id]["COORDINATES_STR"];
                        $metro = $arComponentResult["arAddresses"][$address_id]["METRO"];
                        $free_parking = $arComponentResult["arAddresses"][$address_id]["FREE_PARKING"];
                        $ar_working_time_part_1 = $arComponentResult["arAddresses"][$address_id]["WORKING_TIME_PART_1"];
                        $ar_working_time_part_2 = $arComponentResult["arAddresses"][$address_id]["WORKING_TIME_PART_2"];
                        $how_to_get_car = $arComponentResult["arAddresses"][$address_id]["HOW_TO_GET_CAR"];
                        $how_to_get_pub_trt = $arComponentResult["arAddresses"][$address_id]["HOW_TO_GET_PUB_TRT"];
                        $longitude = $arComponentResult["arAddresses"][$address_id]["LONGITUDE"];
                        $latitude = $arComponentResult["arAddresses"][$address_id]["LATITUDE"];

                        $is_active = "";
                        if (intval($cookieAddressId) > 0) {
                            if ($cookieAddressId == $address_id) {
                                $is_active = "is-active";
                            }
                        }
						else if (count($arPropertieValue) == 1) {
							$_COOKIE['chosenAddressId'] = $address_id;
							$cookieAddressId = $address_id;
							$is_active = "is-active";
						}
                        /*else if ($i == 1) {
                            $is_active = "is-active";
                        }
                        */
                    ?>
                        <div class="nb-affiliated--item col-md-4">
                            <div class="nb-affiliated <?=$is_active; ?>" data-id="<?= $i; ?>" data-title="<?= $name; ?>: <?= $address; ?>" data-address-id="<?= $address_id; ?>">
                                <div class="nb-affiliated--title"><?= $name; ?></div>
                                <div class="nb-affiliated--content">
                                    <div class="nb-affiliated--adress">
                                        <div class="nb-affiliated--icon"></div>
                                        <div class="nb-affiliated--text">
                                            <a target="_blank" rel="nofollow" href="https://yandex.ru/maps/?rtext=~<?=urlencode($coordinates)?>"><?= $address; ?></a>
                                        </div>
                                    </div>
                                    <div class="nb-affiliated--gps" data-longitude="<?= $longitude; ?>" data-latitude="<?= $latitude; ?>">
                                        <div class="nb-affiliated--icon"></div>
                                        <div class="nb-affiliated--text">
                                            <a target="_blank" rel="nofollow" href="https://yandex.ru/maps/?rtext=~<?=urlencode($coordinates)?>"><?= $coordinates_str; ?></a>
                                        </div>
                                    </div>
                                    <div class="nb-affiliated--metro">
                                        <div class="nb-affiliated--icon"></div>
                                        <div class="nb-affiliated--text"><?= (is_array($metro) ? implode(', ', $metro) : $metro); ?></div>
                                    </div>
                                    <? if (strlen($free_parking) > 0) { ?>
                                        <div class="nb-affiliated--parking">
                                            <div class="nb-affiliated--icon"></div>
                                            <div class="nb-affiliated--text">Бесплатная парковка</div>
                                        </div>
                                    <? } ?>
                                    <? if (!empty($ar_working_time_part_1)) { ?>
                                        <div class="nb-affiliated--time">
                                            <div class="nb-affiliated--icon"></div>
                                            <div class="nb-affiliated--text">Время работы:
                                                <? foreach ($ar_working_time_part_1 as $key => $val) { ?>
                                                    <span><? echo $ar_working_time_part_1[$key]; ?>: <? echo $ar_working_time_part_2[$key]; ?></span>
                                                <? } ?>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                                <div class="nb-btn nb-btn_light nb-btn_shadow nb-affiliated--button" data-address-id="<?= $address_id; ?>">
                                    <span class="is-desktop nb-affiliated--button-text">БОЛЬШЕ ИНФОРМАЦИИ</span>
                                    <span class="is-mobile nb-affiliated--button-accordion">КАК ДОБРАТЬСЯ / ФОТО / ВРАЧИ / ОТЗЫВЫ</span>
                                </div>
                            </div>
                            <div class="nb-affiliated--map-content">
                                <? if (strlen($how_to_get_car) > 0) { ?>
                                    <div class="nb-affiliated--map-car">
                                        <div class="nb-affiliated--map-info">
                                            <div class="nb-affiliated--map-title">На машине</div>
                                            <div class="nb-affiliated--map-text">
                                                <? echo $how_to_get_car; ?>
                                            </div>
                                        </div>
                                        <div class="nb-affiliated--map-box">
                                            <div class="nb-affiliated--map"></div>
                                            <div class="nb-affiliated--map-button">
                                                <a href="https://yandex.ru/maps/?rtext=~<?= $longitude ?>,<?= $latitude ?>&rtt=auto" target="_blank">
                                                    построить маршрут В НАВИГАТОРЕ
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
                                <? if (strlen($how_to_get_pub_trt) > 0) { ?>
                                    <div class="nb-affiliated--map-transport">
                                        <div class="nb-affiliated--map-info">
                                            <div class="nb-affiliated--map-title">На общественном транспорте</div>
                                            <div class="nb-affiliated--map-text"><? echo $how_to_get_pub_trt; ?></div>
                                            <div class="nb-affiliated--map-text"></div>
                                        </div>
                                        <div class="nb-affiliated--map-box">
                                            <div class="nb-affiliated--map"></div>
                                            <div class="nb-affiliated--map-button">
                                                <a href="https://yandex.ru/maps/?rtext=~<?= $longitude ?>,<?= $latitude ?>&rtt=mt" target="_blank">
                                                    ПОКАЗАТЬ НА ЯНДЕКС-КАРТе
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
    </section>
    <section class="nb-section nb-map--section">
        <div class="container">

            <?
            $title = 'КЛИНИКИ «БЕЛЫЙ КРОЛИК» В МОСКВЕ';
            //vardump($arComponentResult["arAddresses"]);
            //vardump($arPropertieValue);
            foreach ($arPropertieValue as $arItem) {
                $arItemValues = $arItem['SUB_VALUES'];

                $address_id = $arItemValues["DEV_508_ADDRESS"]["~VALUE"];
                //echo 'address_id = '.$address_id.'<br />';
                if (intval($address_id) <= 0)
                    continue;

                $name = $arComponentResult["arAddresses"][$address_id]["NAME"];
                $address = $arComponentResult["arAddresses"][$address_id]["ADDRESS"];
                $coordinates_str = $arComponentResult["arAddresses"][$address_id]["COORDINATES_STR"];

                if (intval($cookieAddressId) > 0) {
                    if ($cookieAddressId == $address_id) {
                        //$is_active = "is-active";
                        $title = $name . ": " . $address;
                    }
                }
                //echo 'title = '.$title.'<br />';
            }
            ?>
            <div class="nb-section__header">
                <?/*<h3 class="nb-map--title"><?= $name; ?>: <?= $address; ?></h3>*/ ?>
                <div class="nb-map--title" style="font-weight:500;"><?= $title; ?></d>
            </div>

        </div>
        <div class="nb-map--box">
            <div class="nb-map--container">
                <div class="nb-map" id="map"></div>
            </div>
        </div>
        <div class="container">
            <?
            foreach ($arPropertieValue as $arItem) {
                $arItemValues = $arItem['SUB_VALUES'];

                $address_id = $arItemValues["DEV_508_ADDRESS"]["VALUE"];
                if (intval($address_id) <= 0)
                    continue;

                $how_to_get_car = $arComponentResult["arAddresses"][$address_id]["HOW_TO_GET_CAR"];
                $how_to_get_pub_trt = $arComponentResult["arAddresses"][$address_id]["HOW_TO_GET_PUB_TRT"];
                //echo "!!!";
            ?>
                <div class="nb-map--info-box row">
                    <? if (strlen($how_to_get_car) > 0) { ?>
                        <div class="nb-map--info-item nb-map--info-car col-md-6">
                            <div class="nb-map--info-title">На машине</div>
                            <div class="nb-map--info-text">
                                <p><?= $how_to_get_car; ?></p>
                            </div>
                        </div>
                    <? } ?>
                    <? if (strlen($how_to_get_pub_trt) > 0) { ?>
                        <div class="nb-map--info-item nb-map--info-transport col-md-6">
                            <div class="nb-map--info-title">На общественном транспорте</div>
                            <div class="nb-map--info-text">
                                <p><? echo $how_to_get_pub_trt; ?></p>
                            </div>
                        </div>
                    <? } ?>
                </div>
            <?
                break;
            }
            ?>

        </div>
    </section>
<?
}
?>