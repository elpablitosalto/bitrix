<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>

<style>
    .popup__title {
        font-size: 20px;
        font-family: "Montserrat", sans-serif;
        font-weight: 600;
        text-transform: uppercase;
        margin: 13px 0 28px;
    }
    .links__list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px 10px;
    }
    .links__item {
        font-size: 14px;
        line-height: 1.3;
        font-weight: 300;
        color: #3333CC;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 126px;
        height: 70px;
        box-shadow: 0 0 8px 0 rgba(0,0,0,0.25);
        transition: box-shadow .3s;
    }
    .links__item:hover {
        box-shadow: 0px 2px 8px rgba(51, 51, 204, 0.5);
    }
    .links__img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .popup-buy_width_big {
        width: fit-content;
        max-width: 710px;
        padding: 30px 20px;
    }
    @media (max-width: 585px) {
        .popup__title {
            font-size: 14px;
            margin: 0 0 20px;
        }
        .links__list {
            justify-content: center;
        }
    }
</style>
<section class="content">
    <div class="container _inside-page">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","hair.crumbs",Array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1"
            )
        );?>
        <div class="product-detail">
            <div class="product-detail__photos">
                <div class="swiper-button-next product-detail__photos-next"></div>
                <div class="swiper-button-prev product-detail__photos-prev"></div>
                <div class="swiper-container product-detail__photos--slider">
                    <div class="swiper-wrapper">
                        <a data-image-gallery-popup-product="" href="/upload/iblock/c43/c43df9426c3a8e9bafed10570e5393ba.jpg" class="swiper-slide product-detail__photos--slide swiper-slide-active" role="group" aria-label="1 / 4" style="width: 443px; margin-right: 10px;"><img src="/upload/resize_cache/iblock/c43/9999_313_1/c43df9426c3a8e9bafed10570e5393ba.jpg" alt="" title=""></a>
                    </div>
                </div>
                <div class="product-detail__photos--pagination"></div>
                <div class="swiper-container product-detail__photos--slider-thumbs">
                    <div class="swiper-wrapper" id="swiper-wrapper-932d4c94fec23f103" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                        <div class="swiper-slide product-detail__photos--slide swiper-slide-visible swiper-slide-active swiper-slide-thumb-active" role="group" aria-label="1 / 4" style="width: 127.667px; margin-right: 20px;">
                            <img src="/upload/resize_cache/iblock/c43/9999_113_1/c43df9426c3a8e9bafed10570e5393ba.jpg" alt="" title="">
                        </div>
                        <div class="swiper-slide swiper-slide-visible swiper-slide-next" role="group" aria-label="2 / 4" style="width: 127.667px; margin-right: 20px;">
                            <img src="/upload/resize_cache/iblock/ede/9999_113_1/edec9516dd4235ed442c32a7b2056872.jpg" alt="" title="">
                        </div>
                        <div class="swiper-slide swiper-slide-visible" role="group" aria-label="3 / 4" style="width: 127.667px; margin-right: 20px;">
                            <img src="/upload/resize_cache/iblock/13e/9999_113_1/13e8f8dc332776f5546b6d714d316c3e.jpg" alt="" title="">
                        </div>
                        <div class="swiper-slide" role="group" aria-label="4 / 4" style="width: 127.667px; margin-right: 20px;">
                            <img src="/upload/resize_cache/iblock/c20/9999_113_1/c20bcc46941dfe8374596418ebf72c14.jpg" alt="" title="">
                        </div>
                    </div>
                </div>
                <div class="product-detail__photos--desktop-links">
                    <a href="/find-salon/map/">Найди рядом</a>
                    <?if(!empty($arResult['PROPERTIES']['INSTRUCTION']['VALUE'])):?>
                        <?foreach($arResult['PROPERTIES']['INSTRUCTION']['VALUE'] as $item):?>
                            <?
                                $arItem = CIBlockElement::GetList(false,['IBLOCK_ID' => MATERIALS,'ID' => $item],false,false,['ID','NAME','PROPERTY_FILE'])->GetNext();
                            ?>
                            <a target="_blank" href="<?=CFile::GetPath($arItem['PROPERTY_FILE_VALUE'])?>">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.3125 4.53125H1.6875C0.912094 4.53125 0.28125 5.16209 0.28125 5.9375V11.5625C0.28125 12.3379 0.912094 12.9688 1.6875 12.9688H14.3125C15.0879 12.9688 15.7188 12.3379 15.7188 11.5625V5.9375C15.7188 5.16209 15.0879 4.53125 14.3125 4.53125ZM3.99191 9.47931C3.87206 9.47931 3.66731 9.48016 3.47566 9.48112V10.5623C3.47566 10.8212 3.26578 11.031 3.00691 11.031C2.74803 11.031 2.53816 10.8212 2.53816 10.5623L2.53125 7.0015C2.53084 6.87694 2.58006 6.75731 2.668 6.66906C2.75594 6.58081 2.87544 6.53125 3 6.53125H3.99191C4.81553 6.53125 5.48562 7.1925 5.48562 8.00528C5.48562 8.81806 4.81553 9.47931 3.99191 9.47931ZM8.01591 10.918C7.73672 10.9229 7.03838 10.9255 7.00878 10.9257C7.00819 10.9257 7.00759 10.9257 7.007 10.9257C6.88331 10.9257 6.76459 10.8768 6.67678 10.7896C6.58853 10.702 6.53872 10.5829 6.53825 10.4586C6.53822 10.4461 6.53125 7.00091 6.53125 7.00091C6.53103 6.87644 6.58028 6.75697 6.66822 6.66888C6.75616 6.58078 6.87553 6.53125 7 6.53125H7.97906C9.09444 6.53125 9.84381 7.41425 9.84381 8.72847C9.84381 9.97866 9.07506 10.8995 8.01591 10.918ZM12.8194 8.22969C13.0782 8.22969 13.2881 8.43956 13.2881 8.69844C13.2881 8.95731 13.0782 9.16719 12.8194 9.16719H11.9688V10.5C11.9688 10.7589 11.7589 10.9688 11.5 10.9688C11.2411 10.9688 11.0312 10.7589 11.0312 10.5V6.96381C11.0312 6.70494 11.2411 6.49506 11.5 6.49506H12.9332C13.1921 6.49506 13.402 6.70494 13.402 6.96381C13.402 7.22269 13.1921 7.43256 12.9332 7.43256H11.9688V8.22969H12.8194Z" fill="#282323"/>
                                    <path d="M7.97907 7.46875H7.4696C7.47032 7.89187 7.47289 9.57856 7.4742 9.98572C7.66926 9.98447 7.87813 9.98275 7.99954 9.98063C8.62594 9.96969 8.90634 9.34384 8.90634 8.72847C8.90631 8.43294 8.83947 7.46875 7.97907 7.46875Z" fill="#282323"/>
                                    <path d="M3.99184 7.46875H3.47009C3.47066 7.67734 3.47119 7.89925 3.47119 8.00528C3.47119 8.12919 3.47206 8.34409 3.47306 8.54366C3.66544 8.54269 3.87094 8.54181 3.99187 8.54181C4.29337 8.54181 4.54809 8.29613 4.54809 8.00528C4.54809 7.71444 4.29334 7.46875 3.99184 7.46875Z" fill="#282323"/>
                                    <path d="M13.8267 3.59375C13.7181 3.29594 13.5493 3.02069 13.3259 2.785L11.3788 0.731219C10.9383 0.266531 10.3183 0 9.67797 0H3.4375C2.66209 0 2.03125 0.630844 2.03125 1.40625V3.59375H13.8267Z" fill="#282323"/>
                                    <path d="M2.03125 13.9062V14.5938C2.03125 15.3692 2.66209 16 3.4375 16H12.5625C13.3379 16 13.9688 15.3692 13.9688 14.5938V13.9062H2.03125Z" fill="#282323"/>
                                </svg>
                                <span><?=$arItem['NAME']?></span>
                            </a>
                        <?endforeach;?>
                    <?endif;?>
                    <?if(!empty($arResult['PROPERTIES']['PROMOTIONAL_MATERIALS']['VALUE'])):?>
                        <?foreach($arResult['PROPERTIES']['PROMOTIONAL_MATERIALS']['VALUE'] as $item):?>
                            <?
                                $arItem = CIBlockElement::GetList(false,['IBLOCK_ID' => MATERIALS,'ID' => $item],false,false,['ID','NAME','PROPERTY_FILE'])->GetNext();
                            ?>
                            <a target="_blank" href="<?=CFile::GetPath($arItem['PROPERTY_FILE_VALUE'])?>">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                        <path d="M7.99996 10.6666C7.8633 10.6666 7.73263 10.6106 7.63863 10.512L4.13863 6.84531C3.8353 6.52798 4.06063 5.99998 4.49996 5.99998H6.3333V2.16665C6.3333 1.70731 6.7073 1.33331 7.16663 1.33331H8.8333C9.29263 1.33331 9.66663 1.70731 9.66663 2.16665V5.99998H11.5C11.9393 5.99998 12.1646 6.52798 11.8613 6.84531L8.3613 10.512C8.2673 10.6106 8.13663 10.6666 7.99996 10.6666Z" fill="#282323"/>
                                        <path d="M14.8333 14.6667H1.16667C0.523333 14.6667 0 14.1433 0 13.5V13.1667C0 12.5233 0.523333 12 1.16667 12H14.8333C15.4767 12 16 12.5233 16 13.1667V13.5C16 14.1433 15.4767 14.6667 14.8333 14.6667Z" fill="#282323"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span><?=$arItem['NAME']?></span>
                            </a>
                        <?endforeach;?>
                    <?endif;?>
                </div>
            </div>
            <div class="product-detail__title-block">
                <h1 class="product-detail__title-block--title">ОКИСЛЯЮЩАЯ ЭМУЛЬСИЯ 3%</h1>
                <p class="product-detail__title-block--subtitle">Crème Emulsion 3%</p>
            </div>
            <div class="product-detail__description">
                <form id="SKUChoose">
                    <input type="hidden" name="product" value="967">
                    <div class="product-detail__volume">
                        <p>Объём: </p>
                        <div class="product-detail__volume-item _active">
                            <input id="volume-Zd3rTHi8" type="radio" name="volume" value="Zd3rTHi8" checked="">
                            <label for="volume-Zd3rTHi8">100  мл</label>
                        </div>
                        <div class="product-detail__volume-item ">
                            <input id="volume-1000-ml" type="radio" name="volume" value="1000-ml">
                            <label for="volume-1000-ml">1000 мл</label>
                        </div>
                    </div>
                </form>
                <div class="product-detail__options">
                    <div class="w-50">
                        <div class="product-detail__options-item">
                            <div class="product-detail__options-item--icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.998 21.085C19.999 21.0567 20 21.0284 20 21C20 20.5752 19.8623 20.166 19.6133 19.8271C19.8652 19.4302 20 18.9721 20 18.5C20 17.1216 18.8789 16 17.5 16C17.0527 16 16.6201 16.1196 16.2393 16.3433C15.582 15.5034 14.5752 15 13.5 15C12.5605 15 11.6709 15.3818 11.0117 16.0576C9.42284 15.7065 8 16.9541 8 18.5C8 19.7075 8.86034 20.7178 10.001 20.9497C10 20.9668 10 20.9834 10 21C10 22.0239 10.7735 22.8706 11.7666 22.9863C12.1172 23.6045 12.7754 24 13.5 24C14.2236 24 14.8838 23.5991 15.2324 22.9844C15.4101 23.0044 15.584 23.0068 15.7656 22.9829C16.1143 23.5986 16.7744 24 17.5 24C17.8877 24 18.2637 23.8853 18.584 23.6753C18.8427 23.8823 19.164 24 19.5 24C20.3271 24 21 23.3272 21 22.5C21 21.8476 20.5811 21.291 19.998 21.085Z" style="fill: url(#shampoo-icon-linear-1)"></path>
                                    <path d="M9.13772 21.9014C9.09769 21.7749 9.0098 21.6694 8.89163 21.6079C7.72463 21.0015 7.00003 19.8105 7.00003 18.5C7.00003 16.5703 8.57034 15 10.5166 15C10.6251 15 10.7315 14.9644 10.8174 14.8989C11.334 14.5093 11.9346 14.2417 12.6016 14.104C12.8331 14.0557 13.0001 13.8516 13.0001 13.6143V7.5C13.0001 6.10913 12.1782 4.91508 11.0001 4.35108V0.500016C11 0.223641 10.7764 0 10.5 0H5.49998C5.22361 0 4.99997 0.223641 4.99997 0.500016V4.35108C3.82186 4.91508 3 6.10913 3 7.5V22C3 23.103 3.89747 24 5.00002 24H9.56447C9.76758 24 9.95119 23.877 10.0274 23.6885C10.1045 23.5 10.0596 23.2842 9.91308 23.1421C9.55078 22.7881 9.28224 22.3589 9.13772 21.9014Z" style="fill: url(#shampoo--icon-linear-2)"></path>
                                    <defs>
                                        <linearGradient id="shampoo-icon-linear-1" x1="14.5" y1="15" x2="14.5" y2="24" gradientUnits="userSpaceOnUse" color="#3333FF">
                                        <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                        <stop offset="1" stop-color="#FF00E5"></stop>
                                        <stop offset="1" stop-color="#C3007A"></stop>
                                        </linearGradient>
                                        <linearGradient id="shampoo--icon-linear-2" x1="8.00004" y1="0" x2="8.00004" y2="24" gradientUnits="userSpaceOnUse" color="#3333FF">
                                        <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                        <stop offset="1" stop-color="#FF00E5"></stop>
                                        <stop offset="1" stop-color="#C3007A"></stop>
                                        </linearGradient>
                                    </defs>
                                </svg>
                                </div>
                                <div class="product-detail__options-item--text">
                                    <p>Тип</p>
                                    <span>Окисляющая эмульсия</span>
                                </div>
                            </div>
                            <div class="product-detail__options-item">
                                <div class="product-detail__options-item--icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#vegan-icon-clip-1)">
                                        <path d="M22.9555 8.37282L16.3464 7.74787C15.9298 7.71 15.5698 7.44487 15.3995 7.04717L13.0323 1.30899C12.6535 0.362092 11.3087 0.362092 10.93 1.30899L8.58167 7.04717C8.43017 7.44487 8.05141 7.71 7.63478 7.74787L1.02545 8.37282C0.0406781 8.46751 -0.357018 9.69848 0.38156 10.3613L5.36223 14.736C5.68417 15.02 5.81674 15.4367 5.72205 15.8533L4.22595 21.989C3.9987 22.955 5.04028 23.7502 5.91143 23.2391L11.4224 20.0005C11.7822 19.7922 12.2177 19.7922 12.5776 20.0005L18.0887 23.2391C18.9598 23.7502 20.0014 22.9739 19.774 21.989L18.2968 15.8533C18.2021 15.4367 18.3347 15.02 18.6566 14.736L23.6373 10.3613C24.3569 9.69848 23.9403 8.46751 22.9555 8.37282Z" style="fill: url(#favorites-icon-linear-1)"></path>
                                        </g>
                                        <defs>
                                            <linearGradient id="favorites-icon-linear-1" x1="11.9999" y1="0.598816" x2="11.9999" y2="23.401" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                <stop offset="1" stop-color="#FF00E5"></stop>
                                                <stop offset="1" stop-color="#C3007A"></stop>
                                            </linearGradient>
                                            <clipPath id="vegan-icon-clip-1">
                                                <rect width="23.9998" height="24" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="product-detail__options-item--text">
                                    <p>Особенность</p>
                                    <span>Разработаны специально под ассортимент красителей и осветляющих средств Concept, учитывают их формулу и консистенцию, позволяя на 100% правильно выполнить процесс окрашивания или осветления</span>
                                </div>
                            </div>
                            <div class="product-detail__options-item">
                                <div class="product-detail__options-item--icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.08 9.72L5.4 11.4L10.8 16.8L22.8 4.8L21.12 3.12L10.8 13.44L7.08 9.72ZM21.6 12C21.6 17.28 17.28 21.6 12 21.6C6.72 21.6 2.4 17.28 2.4 12C2.4 6.72 6.72 2.4 12 2.4C12.96 2.4 13.8 2.52 14.64 2.76L16.56 0.84C15.12 0.36 13.56 0 12 0C5.4 0 0 5.4 0 12C0 18.6 5.4 24 12 24C18.6 24 24 18.6 24 12H21.6Z" style="fill: url(#tick-icon-linear-1)"></path>
                                        <defs>
                                            <linearGradient id="tick-icon-linear-1" x1="12" y1="0" x2="12" y2="24" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                <stop offset="1" stop-color="#FF00E5"></stop>
                                                <stop offset="1" stop-color="#C3007A"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="product-detail__options-item--text">
                                    <p>Свойства</p>
                                    <span>Без отдушки</span>
                                </div>
                            </div>
                        </div>
                    <div class="w-50">
                        <div class="product-detail__options-item">
                            <div class="product-detail__options-item--icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                        <path d="M13.4454 4.33376C14.2438 4.33376 14.891 3.68653 14.891 2.88813C14.891 2.08973 14.2438 1.4425 13.4454 1.4425C12.647 1.4425 11.9998 2.08973 11.9998 2.88813C11.9998 3.68653 12.647 4.33376 13.4454 4.33376Z" style="fill: url(#flask-icon-linear-1)"></path>
                                        <path d="M16.3371 2.31336C16.9759 2.31336 17.4938 1.7955 17.4938 1.15668C17.4938 0.517863 16.9759 0 16.3371 0C15.6983 0 15.1804 0.517863 15.1804 1.15668C15.1804 1.7955 15.6983 2.31336 16.3371 2.31336Z" style="fill: url(#flask-icon-linear-2)"></path>
                                        <path d="M21.195 19.7343L15.1804 10.1172V7.22905H16.9154V5.20508H7.08404V7.22905H8.81906V10.1172L2.80441 19.7343C2.5839 20.1431 2.45776 20.6105 2.45776 21.1083C2.45776 22.7051 3.75221 24 5.34946 24H18.6504C20.2472 24 21.5421 22.7056 21.5421 21.1083C21.5421 20.6105 21.416 20.1431 21.195 19.7343ZM7.40877 16.1891L10.843 10.6977V7.2286H13.1564V10.6977L16.5906 16.1891H7.40877Z" style="fill: url(#flask-icon-linear-3)"></path>
                                    </g>
                                    <defs>
                                        <linearGradient id="flask-icon-linear-1" x1="13.4454" y1="1.4425" x2="13.4454" y2="4.33376" gradientUnits="userSpaceOnUse" color="#3333FF">
                                            <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                            <stop offset="1" stop-color="#FF00E5"></stop>
                                            <stop offset="1" stop-color="#C3007A"></stop>
                                        </linearGradient>
                                        <linearGradient id="flask-icon-linear-2" x1="16.3371" y1="0" x2="16.3371" y2="2.31336" gradientUnits="userSpaceOnUse" color="#3333FF">
                                            <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                            <stop offset="1" stop-color="#FF00E5"></stop>
                                            <stop offset="1" stop-color="#C3007A"></stop>
                                        </linearGradient>
                                        <linearGradient id="flask-icon-linear-3" x1="11.9999" y1="5.20508" x2="11.9999" y2="24" gradientUnits="userSpaceOnUse" color="#3333FF">
                                            <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                            <stop offset="1" stop-color="#FF00E5"></stop>
                                            <stop offset="1" stop-color="#C3007A"></stop>
                                        </linearGradient>
                                        <clipPath id="clip0">
                                            <rect width="24" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="product-detail__options-item--text">
                                <p>Состав</p>
                                <span>Касторовое масло, комплекс полимеров&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="read-more-block">
                    <a href="#whereBuy" id="buy-button-product" data-popup class="button _xsmall" onclick="ym(26710119,'reachGoal','buy_button'); return true;">Купить</a>
                    <a href="/distributors/" id="buy-button-product-dist" class="button _xsmall" style="display: none; max-width: 320px;">Купить у дистрибьютора</a>
                    <a href="/find-salon/map/" class="show-mobile" style="margin-top: 14px;">Найди рядом</a>
                </div>
             </div>
        </div>
    </div>

<div id="whereBuy" class="popup popup-buy popup-buy_width_big mfp-hide">
    <div class="popup_content">
        <h3 class="popup__title">Выберите магазин</h3>
        <div class="links">
            <div class="links__list">
                <a class="links__item" href="">
                    <img class="links__img" src="../../images/dev/ozon.svg" alt="">
                </a>
                <a class="links__item" href="">
                    <img class="links__img" src="../../images/dev/wildberries.svg" alt="">
                </a>
                <a class="links__item" href="">
                    <img class="links__img" src="../../images/dev/ozon.svg" alt="">
                </a>
                <a class="links__item" href="">
                    <img class="links__img" src="../../images/dev/goldapple.png" alt="">
                </a>
                <a class="links__item" href="/distributors/">Купить у дистрибьютора</a>
                <a class="links__item" href="">
                    <img class="links__img" src="../../images/dev/ozon.svg" alt="">
                </a>
                <?/*php if($arResult['PROPERTIES']['COMMON_LINK']['VALUE']):?>
                <a class="button" id="buy-link" target="_blank" href="<?=$arResult['PROPERTIES']['COMMON_LINK']['VALUE']?>" onclick="ym(26710119,'reachGoal','button_eshop'); return true;">Купить в E-SHOP</a>
                <?else:?>
                <a class="button" id="buy-link" target="_blank" href="#" onclick="ym(26710119,'reachGoal','button_eshop'); return true;">Купить в E-SHOP</a>
                <? endif */?>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>