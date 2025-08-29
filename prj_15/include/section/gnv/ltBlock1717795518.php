<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<style>
    #ltBlock1719568824 hr.separator {
        border-color: #000;
    }

    #ltBlock1719568824 .f-text {
        color: #000;
    }

</style>
<style>
    #ltBlock1717795518 .tsr-header {
        color: #000000 !important;
    }

    #ltBlock1717795518
    .lt-tsr-block.flex-column {
        z-index: 5;
        overflow: hidden;
        margin: 0px 10px 30px;
        padding-top: 180px;
        transition: all 0.3s;
    }

    #ltBlock1717795518
        /* высота контейнера с изображением по высоте изображения */
    .lt-tsr-block.flex-column .image-wrapper {
        height: 100%;
    }

    #ltBlock1717795518
        /* задаем размер и позиционирование изображения */
    .image-wrapper div.image {
        background-size: cover;
        background-position: top center;
    }

    #ltBlock1717795518
    .image-card {
        position: absolute;
        width: 379px;
        height: 348px;
        z-index: -1;
        left: 0;
        top: 0;
    }

    #ltBlock1717795518
        /* задаем тень и внутренние отступы для плиток */
    .lt-tsr-block {

        padding: 30px 35px;
        border-radius: 15px;
    }

    #ltBlock1717795518
        /* задаем анимацию при наведении и тень */
    .lt-tsr-block.flex-column:hover {
        transform: translateY(-3px);

    }

    #ltBlock1717795518
        /* позиционируем контент внутри плитки */
    .lt-tsr-content {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    #ltBlock1717795518
    .description {
        display: flex;
        flex-direction: column;
        height: 100%;
        font-family: 'gothampro';
        font-style: normal;
        font-weight: 700;
        font-size: 18px;
        line-height: 180%;
        /* or 36px */

        text-align: center;
        text-transform: uppercase;

        color: #332120;
    }

    @media (max-width: 800px) {
        #ltBlock1717795518
        .description {
            font-size: 14px;
            text-align: center;
        }    </style>
<style>
    #ltBlock1717795518 .lt-tsr-block {
        color: #332120;
        padding-left: 5px;
        padding-right: 5px;
        padding-top: 10px;
        padding-bottom: 10px;
        border: 0px solid #999999;
        -webkit-flex: 1 0 200px;
        -ms-flex: 1 0 200px;
        -moz-flex: 1 0 200px;
        flex: 1 0 200px;
        margin: 10px;
    }

    #ltBlock1717795518
    .lt-tsr-block .image-wrapper {
        height: 200px;
    }    </style>
<style>
    #ltBlock1717795518 .lt-block-wrapper {
        padding-top: 0px;
        padding-bottom: 45px
    }
</style>

<div id="ltBlock1717795518" data-block-id="1717825127"
     data-has-css="true" class="lt-block lt-view tsr05 lt-tsr"
     data-code="b-a1131"
>


    <div class="lazyload lt-block-wrapper block-cover " id="blockCover1717825127"
         style="position: relative; "
         data-bg="//fs-thb02.getcourse.ru/fileservice/file/thumbnail/h/ae3269c39314cfa43effe991f07d2a66.png/s/s2000x/a/561799/sc/251">
        <div class="cover-filter"></div>
        <div class="cover-wrapper flex-container height-fixed" data-main-class="cover-wrapper">
            <div class="container">
                <div class="row">
                    <div class="modal-block-content block-box col-md-12 text-left" style="">

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
                                                 data-hash="457735e016e7a4c80fb4bc2122cee4d3.png"
                                                 data-image-editable="true" data-param="data/0/image"
                                                 data-bg="//fs-thb03.getcourse.ru/fileservice/file/thumbnail/h/457735e016e7a4c80fb4bc2122cee4d3.png/s/500x/a/561799/sc/183">
                                            </div>
                                        </div>
                                    </div>


                                    <div data-editable="true" data-param="data/0/description"
                                         class="  f-description lt-tsr-text-part description">
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => SITE_DIR . "include/content/gnv/" . basename(__FILE__, '.php') . "_text_1.php",
                                            )
                                        );?>
                                    </div>
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
                                                 data-hash="457735e016e7a4c80fb4bc2122cee4d3.png"
                                                 data-image-editable="true" data-param="data/1/image"
                                                 data-bg="//fs-thb03.getcourse.ru/fileservice/file/thumbnail/h/457735e016e7a4c80fb4bc2122cee4d3.png/s/500x/a/561799/sc/183">
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
                                                 data-hash="457735e016e7a4c80fb4bc2122cee4d3.png"
                                                 data-image-editable="true" data-param="data/2/image"
                                                 data-bg="//fs-thb03.getcourse.ru/fileservice/file/thumbnail/h/457735e016e7a4c80fb4bc2122cee4d3.png/s/500x/a/561799/sc/183">
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


                    </div>
                </div>
            </div>

        </div>
    </div>

    <style media="screen">
        #blockCover1717825127 {
            min-height: 100vh;
            background-attachment: scroll
        }

        @media (max-width: 768px) {
            #blockCover1717825127 {
                background-attachment: scroll;
            }
        }

        .cover-blockCover1717825127 .cover-wrapper {
            height: 100vh;
        }


        #blockCover1717825127 .cover-filter {
            background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -ms-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
        }

    </style>


</div>

