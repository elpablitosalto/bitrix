<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>


<style>
    #ltBlock1719568824 .lt-tsr-block.flex-column {
        z-index: 5;
        overflow: hidden;
        margin: 30px 10px 30px;
        width: 379px;
        height: 400px;
        flex-basis: calc(100% / 3 - 20px);
        transition: all 0.3s;
    }

    #ltBlock1719568824
        /* высота контейнера с изображением по высоте изображения */
    .lt-tsr-block.flex-column .image-wrapper {
        height: 100%;
    }

    #ltBlock1719568824
        /* задаем размер и позиционирование изображения */
    .image-wrapper div.image {
        background-size: cover;
        background-position: top center;
    }

    #ltBlock1719568824
        /* Задаём размеры блоку карточки изображения и выводим на задний план */
    .image-card {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        transition: all 0.3s;
        padding-bottom: 0;
        z-index: -1;
    }

    #ltBlock1719568824
        /* задаем тень и внутренние отступы для плиток */
    .lt-tsr-block {
        padding: 30px 35px;
        border-radius: 15px;
    }

    #ltBlock1719568824
        /* задаем анимацию при наведении и тень */
    .lt-tsr-block.flex-column:hover {
        transform: translateY(-3px);

    }

    #ltBlock1719568824
        /* позиционируем контент внутри плитки */
    .lt-tsr-block .lt-tsr-content {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    #ltBlock1719568824
    .lt-tsr-block:nth-child(1) .lt-tsr-content {
        justify-content: flex-start;
    }

    #ltBlock1719568824
    .lt-tsr-block:nth-child(2) .lt-tsr-content {
        justify-content: flex-end;
    }

    #ltBlock1719568824
    .lt-tsr-block:nth-child(3) .lt-tsr-content {
        justify-content: flex-start;
    }

    #ltBlock1719568824
    .description {
        position: relative;
        z-index: 1;
        font-family: 'gothampro';
        font-style: normal;
        font-weight: 700;
        font-size: 18px;
        line-height: 180%;
        /* or 36px */
        text-align: left;
        text-transform: uppercase;
        color: #FFF !important;
    }

    @media (max-width: 972px) {
        #ltBlock1719568824
        .description {
            font-size: 16px;
        }
    }

    @media (max-width: 821px) {
        #ltBlock1719568824
        .lt-tsr-block.flex-column {
            flex-basis: calc(100% / 2 - 20px);
        }
    }

    @media (max-width: 800px) {
        #ltBlock1719568824
        .description {
            font-size: 14px;
        }
    }    </style>
<style>
    #ltBlock1719568824 .lt-tsr-block {;
        -webkit-flex: 1 0 200px;
        -ms-flex: 1 0 200px;
        -moz-flex: 1 0 200px;
        flex: 1 0 200px;
        margin: 10px;
    }

    #ltBlock1719568824
    .lt-tsr-block .image-wrapper {
        height: 200px;
    }    </style>

<style>
    #ltBlock1719568824 .lt-block-wrapper {
        padding-top: 15px;
        padding-bottom: 0px;
        color: #000
    }


</style>


<div id="ltBlock1719568824" data-block-id="1719568855"
     data-has-css="true" class="lt-block lt-view tsr05 lt-tsr"
     data-code="b-88447"
>


    <div class="lazyload lt-block-wrapper block-cover " id="blockCover1719568855"
         style="position: relative; "
         data-bg="<?=SITE_TEMPLATE_PATH?>/images/432.png">
        <div class="cover-filter"></div>
        <div class="cover-wrapper flex-container height-fixed" data-main-class="cover-wrapper">
            <div class="container">
                <div class="row">
                    <div class="modal-block-content block-box col-md-12 text-left" style="color: #000">

                        <h2 class="tsr-header">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/gnv/" . basename(__FILE__, '.php') . "_title.php",
                                )
                            );?>
                        </h2>


                        <div class="flex-row  ">
                            <div class="lt-tsr-block flex-column"
                            >

                                <div class="lt-tsr-content">


                                    <div class="image-card">
                                        <div class="image-wrapper">
                                            <div class="image lazyload"
                                                 data-hash="07a9997b45d3d845b81dd8dcae005efa.png"
                                                 data-image-editable="true" data-param="data/0/image"
                                                 data-bg="<?=SITE_TEMPLATE_PATH?>/images/298.png">
                                            </div>
                                        </div>
                                    </div>


                                    <h2 data-editable="true" data-param="data/0/description"
                                         class="  f-description lt-tsr-text-part description">
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => SITE_DIR . "include/content/gnv/" . basename(__FILE__, '.php') . "_text_1.php",
                                            )
                                        );?>
                                    </h2>
                                    <div class="common-setting-link in-block-setting-link"
                                         data-param="data/0"
                                         data-title="Элемент 0" data-setting-editable="true"></div>

                                </div>

                            </div>
                            <div class="lt-tsr-block flex-column"
                            >

                                <div class="lt-tsr-content">


                                    <div class="image-card">
                                        <div class="image-wrapper">
                                            <div class="image lazyload"
                                                 data-hash="289890fc7390c4e6e05be5ba8a2e3dfd.png"
                                                 data-image-editable="true" data-param="data/1/image"
                                                 data-bg="<?=SITE_TEMPLATE_PATH?>/images/300.png">
                                            </div>
                                        </div>
                                    </div>


                                    <div data-editable="true" data-param="data/1/description"
                                         class="  f-description lt-tsr-text-part description">
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => SITE_DIR . "include/content/gnv/" . basename(__FILE__, '.php') . "_text_2.php",
                                            )
                                        );?>
                                    </div>
                                    <div class="common-setting-link in-block-setting-link"
                                         data-param="data/1"
                                         data-title="Элемент 1" data-setting-editable="true"></div>

                                </div>

                            </div>
                            <div class="lt-tsr-block flex-column"
                            >

                                <div class="lt-tsr-content">


                                    <div class="image-card">
                                        <div class="image-wrapper">
                                            <div class="image lazyload"
                                                 data-hash="9cef7033470f9427187b0c821f02c7f8.png"
                                                 data-image-editable="true" data-param="data/2/image"
                                                 data-bg="<?=SITE_TEMPLATE_PATH?>/images/59.png">
                                            </div>
                                        </div>
                                    </div>


                                    <div data-editable="true" data-param="data/2/description"
                                         class="  f-description lt-tsr-text-part description">
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => SITE_DIR . "include/content/gnv/" . basename(__FILE__, '.php') . "_text_3.php",
                                            )
                                        );?>
                                    </div>
                                    <div class="common-setting-link in-block-setting-link"
                                         data-param="data/2"
                                         data-title="Элемент 2" data-setting-editable="true"></div>

                                </div>

                            </div>
                        </div>


                        <style>
                            #ltBlock1719568824 .lt-tsr-text-part {
                                color: #000
                            }

                        </style>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style media="screen">
        #blockCover1719568855 {
            min-height: 100vh;
            background-attachment: scroll
        }

        @media (max-width: 768px) {
            #blockCover1719568855 {
                background-attachment: scroll;
            }
        }

        .cover-blockCover1719568855 .cover-wrapper {
            height: 100vh;
        }


        #blockCover1719568855 .cover-filter {
            background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -ms-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
        }

    </style>


</div>

