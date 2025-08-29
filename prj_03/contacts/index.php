<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты ООО ГК «ФИРСТ»");
$APPLICATION->SetTitle("Контакты");

?>
    <div class="wrapper_inner">
        <div class="row">
            <div class="col-md-6" itemscope itemtype="http://schema.org/Organization">
                <?php
                // Берём все значения инфоблока с ID Магазинов
                $mas = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 4, "ACTIVE" => "Y"));

                while ($oElement = $mas->GetNextElement()) {
                    $aElement['PROPERTIES'] = $oElement->GetProperties(); // Берём значения элемента инфоблока

                    //echo "<pre>";var_dump($oElement);echo "</pre>";
                    ?>
                    <div class="my-3 address-element">
                        <h2 class="h4" itemprop="name">
                            <?= $oElement->fields['NAME']; ?>
                        </h2>
                        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <?php
                            if (!empty($aElement['PROPERTIES']['ADDRESS']['VALUE'])) {
                                ?>
                                <div class="row tm-address my-1">
                                    <div class="col-md-3">
                                        <?= $aElement['PROPERTIES']['ADDRESS']['NAME']; ?>
                                    </div>
                                    <div class="col-md-9">
                                        <?php
                                        if (!empty($aElement['PROPERTIES']['INDEX']['VALUE'])) {
                                            ?>
                                            <span itemprop="postalCode"><?= $aElement['PROPERTIES']['INDEX']['VALUE'] ?></span>,
                                            <?php
                                        } ?>
                                        <?php
                                        if (!empty($aElement['PROPERTIES']['REGION']['VALUE'])) {
                                            ?>
                                            <span itemprop="addressRegion"><?= $aElement['PROPERTIES']['REGION']['VALUE'] ?></span>,
                                            <?php
                                        } ?>
                                        <?php
                                        if (!empty($aElement['PROPERTIES']['GOROD']['VALUE'])) {
                                            ?>
                                            <span itemprop="addressLocality"><?= $aElement['PROPERTIES']['GOROD']['VALUE'] ?></span>,
                                            <?php
                                        } ?>

                                        <span itemprop="streetAddress"><?= $aElement['PROPERTIES']['ADDRESS']['VALUE'] ?></span>

                                        <?php
                                        if (!empty($aElement['PROPERTIES']['PLACE']['VALUE'])) {
                                            ?>
                                            , <span><?= $aElement['PROPERTIES']['PLACE']['VALUE'] ?></span>
                                            <?php
                                        } ?>

                                    </div>
                                </div>
                                <?php
                            }
                            if (!empty($aElement['PROPERTIES']['PHONE']['VALUE'])) {
                                ?>
                                <div class="row tm-phone my-1">
                                    <div class="col-md-3"><?= $aElement['PROPERTIES']['PHONE']['NAME']; ?></div>
                                    <div class="col-md-9 tm-phone-value">
                                        <a class="tm-phone-link"
                                           href="tel:<?= $aElement['PROPERTIES']['PHONE']['VALUE']['0']; ?>">
                                            <span itemprop="telephone"><?= $aElement['PROPERTIES']['PHONE']['VALUE']['0']; ?></span>
                                        </a>
                                        <?php
                                        if (!empty($aElement['PROPERTIES']['DOB']['VALUE'])) {
                                            ?>
                                            <span><?= $aElement['PROPERTIES']['DOB']['NAME']; ?><?= $aElement['PROPERTIES']['DOB']['VALUE']; ?></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            if (!empty($aElement['PROPERTIES']['EMAIL']['VALUE'])) {
                                ?>
                                <div class="row tm-email my-1">
                                    <div class="col-md-3"><?= $aElement['PROPERTIES']['EMAIL']['NAME']; ?></div>
                                    <div class="col-md-9">
                                        <span itemprop="email">
                                            <?= $aElement['PROPERTIES']['EMAIL']['VALUE']; ?>
                                        </span>
                                    </div>
                                </div>
                                <?php
                            }
                            if (!empty($aElement['PROPERTIES']['SCHEDULE']['VALUE'])) {
                                ?>
                                <div class="row tm-email my-1">
                                    <div class="col-md-3"><?= $aElement['PROPERTIES']['SCHEDULE']['NAME']; ?></div>
                                    <div class="col-md-9">
                                        <time>
                                            <?= $aElement['PROPERTIES']['SCHEDULE']['~VALUE']["TEXT"]; ?>
                                        </time>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <?php

                    // Координаты хранятся в переменной MAP (подставьте вашу переменную) через запятую, разделим их
                    $arMap = explode(',', $aElement['PROPERTIES']['MAP']['VALUE']);
                    //Подготовка карты
                    $arResult['POSITION']['yandex_scale'] = "5"; // Подбираем размер карты, чтобы поместились все маркеры
                    // В yandex_lat и yandex_lon заносим координаты центральной точки карты
                    $arResult['POSITION']['yandex_lat'] = $arMap[0]; // В нашем случае координаты первого элемента инфоблока
                    $arResult['POSITION']['yandex_lon'] = $arMap[1];
                    //Собираем маркеры
                    $arResult['POSITION']['PLACEMARKS'][] = array(
                        'LON' => $arMap[1], // LON и LAT - координаты маркера
                        'LAT' => $arMap[0],
                        'TEXT' => $oElement->fields['NAME'],
                        'TITLE' => $oElement->fields['NAME']
                    );
                }
                ?>
            </div>
            
            <div class="col-md-6">
                <span><b>г. Ростов-на-Дону</b></span>
				<?/*		<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7bb382244256dcb8c0d310c55804f47f68a1b8b136ad72c9591e3ee96dec2682&amp;width=100%25&amp;height=350&amp;lang=ru_RU&amp;scroll=true"></script> */?>
				<?/*<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A927a44b114fc1ee0ea2244823f6025e1aa438e5db4120dd35e6d69f0471505c4&amp;source=constructor" width="100%" height="350" frameborder="0"></iframe>*/?>
				<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A0f8010262899b48255ae88162a6ab9d8247f1877254bea605d99ceca42786aa3&amp;source=constructor" width="536" height="350" frameborder="0"></iframe>
                <br>
				<span><b>г. Новочеркасск</b></span>
                <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A67451051c06446d1f4b3ef29a3ecd5ec2ec9605897696e0c018e891779740ab0&amp;source=constructor" width="536" height="350" frameborder="0"></iframe>
                <br>
                <span><b>г. Москва</b></span>
				<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A7bb382244256dcb8c0d310c55804f47f68a1b8b136ad72c9591e3ee96dec2682&amp;source=constructor" width="100%" height="350" frameborder="0"></iframe>
				<?/*	<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A927a44b114fc1ee0ea2244823f6025e1aa438e5db4120dd35e6d69f0471505c4&amp;width=100%25&amp;height=350&amp;lang=ru_RU&amp;scroll=true"></script>*/?>
            </div>
        </div>
    </div>
    <div class="wrapper_inner contacts_txt">
        <p>Для удобства вы можете скачать перечень основных реквизитов компании.</p>
        <a target="_blank" href="/upload/karta_patnera_first.pdf">Скачать карту партнёра ООО ГК «ФИРСТ»</a>
    </div>

    <div class="wrapper_inner contacts_txt">
        <? $APPLICATION->IncludeFile(SITE_DIR . "include/contacts_text.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("CONTACTS_TEXT"))); ?>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>