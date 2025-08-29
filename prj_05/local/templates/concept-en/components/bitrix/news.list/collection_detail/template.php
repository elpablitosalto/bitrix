<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="page__detail-group">
        <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <span id="<?=$arItem['ID'];?>"></span>
            <div class="page__detail" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="page__detail-card">
                    <div class="page__container">
                        <!-- begin .detail-card-->
                        <div class="detail-card">
                            <div class="detail-card__header">
                                <div class="detail-card__title">
                                    <!-- begin .title-->
                                    <h2 class="title title_size_h6 title_font_secondary">
                                        <?= $arItem['NAME'] ?>
                                    </h2>
                                    <!-- end .title-->
                                </div>
                                <?/*?>
                                <div class="detail-card__title">
                                    <!-- begin .title-->
                                    <h2 class="title title_size_h6 title_font_secondary">
                                        <?= $arItem['PREVIEW_TEXT'] ?>
                                    </h2>
                                    <!-- end .title-->
                                </div>
                                <div class="detail-card__note">
                                    <?= $arItem['NAME'] ?>
                                </div>
                                <?*/ ?>
                            </div>
                            <div class="detail-card__showcase">
                                <div class="detail-card__illustration">
                                    <picture class="detail-card__picture">
                                        <img src="<?= $arItem['DETAIL_PICTURE_SLIDER']['SRC']; ?>" alt="<?= $arItem['DETAIL_PICTURE_SLIDER']["ALT"] ?>" title="<?= $arItem['DETAIL_PICTURE_SLIDER']["TITLE"] ?>" class="detail-card__image" />
                                    </picture>
                                </div>
                            </div>
                            <div class="detail-card__main">
                                <? if (!empty($arItem['SKU']['PROPS']['VOLUME'])) { ?>
                                    <div class="detail-card__filters">
                                        <div class="detail-card__radio-group">
                                            <!-- begin .radio-group-->
                                            <div class="radio-group">
                                                <div class="radio-group__label"><?= GetMessage('NEWS_LIST_COLLECTION_DETAIL_VOLUME') ?>:
                                                </div>
                                                <ul class="radio-group__list">
                                                    <?
                                                    $i = 0;
                                                    ?>
                                                    <? foreach ($arItem['SKU']['PROPS']['VOLUME'] as $k => $prop) { ?>

                                                        <?
                                                        $activeClass = 'radio-group__label_state_active';
                                                        if ($i == 0) {
                                                            $activeClass = 'radio-group__label_state_active';
                                                        }
                                                        ?>
                                                        <li class="radio-group__item">
                                                            <label class="radio-group__label <?=$activeClass;?>">
                                                                <span class="radio-group__panel"><?= $prop ?> <?= GetMessage('NEWS_LIST_COLLECTION_DETAIL_ML') ?></span>
                                                            </label>
                                                        </li>                                                        
                                                        <?
                                                        $i++;
                                                        ?>
                                                    <? } ?>
                                                </ul>
                                            </div>
                                            <!-- end .radio-group-->
                                        </div>
                                    </div>
                                <? } ?>
                                <? if (!empty($arItem['DISPLAY_PROPERTIES']['PALLETTE']['FILE_VALUE'])) { ?>
                                    <div class="detail-card__links">
                                        <div class="detail-card__link-item">
                                            <a class="detail-card__link" href="<?= $arItem['DISPLAY_PROPERTIES']['PALLETTE']['FILE_VALUE']['SRC']; ?>" target="_blank">
                                                <?= GetMessage('NEWS_LIST_COLLECTION_DETAIL_DOWNLOAD_PALETTE') ?>
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                                <? if (!empty($arItem['EXT_PROPS'])) { ?>
                                    <div class="detail-card__icon-props">
                                        <!-- begin .icon-props-->
                                        <div class="icon-props">
                                            <ul class="icon-props__list">
                                                <? foreach ($arItem['EXT_PROPS'] as $key => $extProp) { ?>
                                                    <li class="icon-props__item">
                                                        <div class="icon-props__panel">
                                                            <?= $extProp['SVG']; ?>
                                                            <div class="icon-props__main">
                                                                <div class="icon-props__title">
                                                                    <?= $extProp['TITLE']; ?>
                                                                </div>
                                                                <div class="icon-props__text">
                                                                    <? foreach ($extProp['VALUE'] as $val) { ?>
                                                                        <p><?= $val; ?></p>
                                                                    <? } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <? } ?>
                                            </ul>
                                        </div>
                                        <!-- end .icon-props-->
                                    </div>
                                <? } ?>
                            </div>
                            <? if (!empty($arItem['MATERIALS']['FILES'])) { ?>
                                <div class="detail-card__footer">
                                    <div class="detail-card__icon-links">
                                        <? foreach ($arItem['MATERIALS']['FILES'] as $key => $mItem) { ?>
                                            <div class="detail-card__icon-link">
                                                <!-- begin .icon-link-->
                                                <a class="icon-link icon-link_gap_l icon-link_text-size_s" target="_blank" href="<?= $mItem['FILE_SRC']; ?>">
                                                    <span class="icon-link__icon-wrapper"><svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.3125 4.53125H1.6875C0.912094 4.53125 0.28125 5.16209 0.28125 5.9375V11.5625C0.28125 12.3379 0.912094 12.9688 1.6875 12.9688H14.3125C15.0879 12.9688 15.7188 12.3379 15.7188 11.5625V5.9375C15.7188 5.16209 15.0879 4.53125 14.3125 4.53125ZM3.99191 9.47931C3.87206 9.47931 3.66731 9.48016 3.47566 9.48112V10.5623C3.47566 10.8212 3.26578 11.031 3.00691 11.031C2.74803 11.031 2.53816 10.8212 2.53816 10.5623L2.53125 7.0015C2.53084 6.87694 2.58006 6.75731 2.668 6.66906C2.75594 6.58081 2.87544 6.53125 3 6.53125H3.99191C4.81553 6.53125 5.48562 7.1925 5.48562 8.00528C5.48562 8.81806 4.81553 9.47931 3.99191 9.47931ZM8.01591 10.918C7.73672 10.9229 7.03838 10.9255 7.00878 10.9257C7.00819 10.9257 7.00759 10.9257 7.007 10.9257C6.88331 10.9257 6.76459 10.8768 6.67678 10.7896C6.58853 10.702 6.53872 10.5829 6.53825 10.4586C6.53822 10.4461 6.53125 7.00091 6.53125 7.00091C6.53103 6.87644 6.58028 6.75697 6.66822 6.66888C6.75616 6.58078 6.87553 6.53125 7 6.53125H7.97906C9.09444 6.53125 9.84381 7.41425 9.84381 8.72847C9.84381 9.97866 9.07506 10.8995 8.01591 10.918ZM12.8194 8.22969C13.0782 8.22969 13.2881 8.43956 13.2881 8.69844C13.2881 8.95731 13.0782 9.16719 12.8194 9.16719H11.9688V10.5C11.9688 10.7589 11.7589 10.9688 11.5 10.9688C11.2411 10.9688 11.0312 10.7589 11.0312 10.5V6.96381C11.0312 6.70494 11.2411 6.49506 11.5 6.49506H12.9332C13.1921 6.49506 13.402 6.70494 13.402 6.96381C13.402 7.22269 13.1921 7.43256 12.9332 7.43256H11.9688V8.22969H12.8194Z" />
                                                            <path d="M7.97919 7.46875H7.46973C7.47045 7.89187 7.47301 9.57856 7.47432 9.98572C7.66938 9.98447 7.87825 9.98275 7.99966 9.98063C8.62606 9.96969 8.90647 9.34384 8.90647 8.72847C8.90643 8.43294 8.83959 7.46875 7.97919 7.46875Z" />
                                                            <path d="M3.99196 7.46875H3.47021C3.47078 7.67734 3.47131 7.89925 3.47131 8.00528C3.47131 8.12919 3.47218 8.34409 3.47318 8.54366C3.66556 8.54269 3.87106 8.54181 3.992 8.54181C4.2935 8.54181 4.54822 8.29613 4.54822 8.00528C4.54822 7.71444 4.29347 7.46875 3.99196 7.46875Z" />
                                                            <path d="M13.8267 3.59375C13.7181 3.29594 13.5493 3.02069 13.3259 2.785L11.3788 0.731219C10.9383 0.266531 10.3183 0 9.67797 0H3.4375C2.66209 0 2.03125 0.630844 2.03125 1.40625V3.59375H13.8267Z" />
                                                            <path d="M2.03125 13.9062V14.5938C2.03125 15.3692 2.66209 16 3.4375 16H12.5625C13.3379 16 13.9688 15.3692 13.9688 14.5938V13.9062H2.03125Z" />
                                                        </svg></span><span class="icon-link__text"><?= $mItem['NAME']; ?></span></a>
                                                <!-- end .icon-link-->
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                        <!-- end .detail-card-->
                    </div>
                </div>
                <? if (!empty($arItem['PRODUCT_OPTIONS']['ITEMS'])) { ?>
                    <div class="page__section">
                        <!-- begin .section-->
                        <div class="section">
                            <div class="section__main">
                                <div class="section__header">
                                    <div class="section__header-container page__container">
                                        <div class="section__title">
                                            <!-- begin .title-->
                                            <h2 class="title title_size_h2-s title_font_secondary title_align_center title_weight_bold title_case_normal">
                                                <?= $arItem['NAME'] ?> <?= GetMessage('NEWS_LIST_COLLECTION_DETAIL_PRODUCT_OPTIONS'); ?>
                                            </h2>
                                            <!-- end .title-->
                                        </div>
                                    </div>
                                </div>
                                <div class="section__content">
                                    <div class="page__container">
                                        <div class="section__entry-carousel">
                                            <!-- begin .entry-carousel-->
                                            <div class="entry-carousel">
                                                <div class="entry-carousel__container swiper js-entry-carousel">
                                                    <div class="entry-carousel__wrapper swiper-wrapper">
                                                        <? foreach ($arItem['PRODUCT_OPTIONS']['ITEMS'] as $arProductOptionsItem) { ?>
                                                            <div class="entry-carousel__slide swiper-slide">
                                                                <!-- begin .entry-snippet-->
                                                                <div class="entry-snippet entry-carousel__snippet">
                                                                    <a class="entry-snippet__illustration js-modal" href="<?= $arProductOptionsItem['PICTURE_SOURCE']['SRC']; ?>">
                                                                        <picture class="entry-snippet__picture">
                                                                            <img src="<?= $arProductOptionsItem['PICTURE']['SRC']; ?>" alt="<?= $arProductOptionsItem['PICTURE']["ALT"] ?>" title="<?= $arProductOptionsItem['PICTURE']["TITLE"] ?>" class="entry-snippet__image" />
                                                                        </picture>
                                                                    </a>
                                                                    <div class="entry-snippet__content">
                                                                        <div class="entry-snippet__title">
                                                                            <?= $arProductOptionsItem['NAME']; ?>
                                                                        </div>
                                                                        <?/*?>
                                                                        <div class="entry-snippet__title">
                                                                            <?= $arProductOptionsItem['PREVIEW_TEXT']; ?>
                                                                        </div>
                                                                        <div class="entry-snippet__text">
                                                                            <?= $arProductOptionsItem['NAME']; ?>
                                                                        </div>
                                                                        <?*/ ?>
                                                                    </div>
                                                                </div>
                                                                <!-- end .entry-snippet-->
                                                            </div>
                                                        <? } ?>
                                                    </div>
                                                    <button class="entry-carousel__arrow entry-carousel__arrow_position_left js-entry-carousel-prev" type="button">
                                                        <svg class="entry-carousel__icon" width="9" height="18" viewbox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.66964 17.6224C8.77436 17.503 8.85744 17.3611 8.91413 17.2049C8.97082 17.0488 9 16.8813 9 16.7123C9 16.5432 8.97082 16.3758 8.91413 16.2196C8.85744 16.0634 8.77436 15.9216 8.66964 15.8022L2.71655 8.99966L8.66964 2.19715C8.88079 1.95577 8.99941 1.62841 8.99941 1.28706C8.99941 0.945709 8.88079 0.61834 8.66964 0.37697C8.45849 0.135599 8.17211 -4.01056e-08 7.87349 -5.45712e-08C7.57488 -6.90369e-08 7.2885 0.135599 7.07735 0.37697L0.330364 8.08957C0.225643 8.20898 0.142559 8.35083 0.0858702 8.507C0.0291809 8.66317 3.61661e-07 8.83058 3.54992e-07 8.99966C3.48323e-07 9.16874 0.0291809 9.33616 0.0858701 9.49233C0.142559 9.6485 0.225643 9.79034 0.330364 9.90975L7.07735 17.6224C7.1818 17.7421 7.3059 17.837 7.44251 17.9018C7.57913 17.9666 7.72558 18 7.87349 18C8.0214 18 8.16786 17.9666 8.30448 17.9018C8.44109 17.837 8.56518 17.7421 8.66964 17.6224Z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                    <button class="entry-carousel__arrow entry-carousel__arrow_position_right js-entry-carousel-next" type="button">
                                                        <svg class="entry-carousel__icon" width="9" height="18" viewbox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.330363 17.6224C0.225642 17.503 0.142558 17.3611 0.0858685 17.2049C0.0291793 17.0488 -4.4122e-08 16.8813 -5.07909e-08 16.7123C-5.74597e-08 16.5432 0.0291793 16.3758 0.0858684 16.2196C0.142558 16.0634 0.225642 15.9216 0.330363 15.8022L6.28345 8.99966L0.330362 2.19715C0.119212 1.95577 0.000588102 1.62841 0.000588091 1.28706C0.00058808 0.945709 0.119211 0.61834 0.330362 0.37697C0.541513 0.135599 0.827895 -4.01055e-08 1.12651 -5.45711e-08C1.42512 -6.90367e-08 1.7115 0.135599 1.92265 0.37697L8.66964 8.08957C8.77436 8.20898 8.85744 8.35083 8.91413 8.507C8.97082 8.66317 9 8.83058 9 8.99966C9 9.16874 8.97082 9.33616 8.91413 9.49233C8.85744 9.6485 8.77436 9.79034 8.66964 9.90975L1.92265 17.6224C1.8182 17.7421 1.6941 17.837 1.55749 17.9018C1.42087 17.9666 1.27442 18 1.12651 18C0.978597 18 0.832139 17.9666 0.695524 17.9018C0.558908 17.837 0.434819 17.7421 0.330363 17.6224Z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- end .entry-carousel-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end .section-->
                    </div>
                <? } ?>
                <? if (!empty($arItem['DETAIL_TEXT'])) { ?>
                    <div class="page__description">
                        <div class="page__container">
                            <!-- begin .description-->
                            <div class="description description_state_closed">
                                <div class="description__content">
                                    <?= $arItem['DETAIL_TEXT']; ?>
                                </div>
                                <div class="description__controls">
                                    <div class="description__control">
                                        <!-- begin .button-->
                                        <button class="button button_width_full button_size_l button_text_size-m button_text_tall button_style_outline-dark js-toggle" type="button" data-toggle-scope=".description" data-toggle-class="description_state_closed">
                                            <span class="button__holder"><?= GetMessage('NEWS_LIST_COLLECTION_DETAIL_READ_MORE') ?></span>
                                        </button>
                                        <!-- end .button-->
                                    </div>
                                </div>
                            </div>
                            <!-- end .description-->
                        </div>
                    </div>
                <? } ?>
            </div>
        <? } ?>
    </div>
<? } ?>