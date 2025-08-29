<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<div id="rec599284289" class="r t-rec t-rec_pt_0 t-rec_pb_30" style="padding-top:0px;padding-bottom:30px;background-color:#efebea; " data-animationappear="off" data-record-type="896" data-bg-color="#efebea" data-preloader-timeout="34"><!-- t896 -->
    <!-- @classes t-descr t-btn t-descr_xxs t-descr_sm t-title t-title_xxs t-text t-text_md t-heading t-heading_lg t-name t-uptitle t-uptitle_sm t-uptitle_xs t-name_md t-btn_md -->
    <div class="t896"><!-- grid container start -->
        <div class="_js-feed t-feed t-feed_row" data-feed-grid-type="row" data-feed-recid="599284289" data-feed-uid="560628793411">
            <div class="t-feed__container t-container">
                <div class="_js-feed-parts-select-container t-col t-col_7 t-prefix_4"></div>
            </div><!-- preloader els --><!-- preloader els end -->
            <ul role="list" class="_js-feed-container t-feed__container t-container" data-feed-show-slice="1" data-slider-totalslides="3">
                <? if (true) { ?>
                    <?
                    //$GLOBALS['articlesFilter']['!PREVIEW_PICTURE'] = false;
                    if(!isset($GLOBALS['articlesFilter']["PROPERTY_THEME"])){
                        $GLOBALS['articlesFilter']["PROPERTY_THEME"] =  'kod_zhizni';
                    }
                    ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "kodjizni_articles",
                        array(
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_TYPE" => "content",
                            "IBLOCK_ID" => indexis::getIblockId("articles", "content"),
                            "NEWS_COUNT" => "3",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "articlesFilter",
                            "FIELD_CODE" => array("PREVIEW_PICTURE", "ACTIVE_FROM", "PREVIEW_TEXT"),
                            "PROPERTY_CODE" => array("LIVE_START", "SPECIALITY", "DATE_END", "DATE_START", "COUNT_MODULES"),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d F Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "Y",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "360000",
                            "CACHE_FILTER" => "Y",
                            "CACHE_GROUPS" => "Y",
                            "DISPLAY_TOP_PAGER" => "Y",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "Y",
                            "PAGER_TEMPLATE" => "",
                            "PAGER_DESC_NUMBERING" => "Y",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "Y",
                            "PAGER_BASE_LINK_ENABLE" => "Y",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => "",
                            "PAGER_BASE_LINK" => "",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => ""
                        )
                    ); ?>
                <? } else { ?>
                    <li class="_js-feed-post t-feed__post t-item t-width t-col t-col_7 t-prefix_4" data-post-uid="nud1d2p7y1" style="cursor: pointer;">
                        <div class="t-feed__post__line-separator"></div>
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kodjizni/" . basename(__FILE__, '.php') . "_block_1.php",
                            )
                        ); ?>
                    </li>
                    <li class="_js-feed-post t-feed__post t-item t-width t-col t-col_7 t-prefix_4" data-post-uid="eog78f3pp1" style="cursor: pointer;">
                        <div class="t-feed__post__line-separator"></div>
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kodjizni/" . basename(__FILE__, '.php') . "_block_2.php",
                            )
                        ); ?>
                    </li>
                    <li class="_js-feed-post t-feed__post t-item t-width t-col t-col_7 t-prefix_4" data-post-uid="72n5ku7hm1" style="cursor: pointer;">
                        <div class="t-feed__post__line-separator"></div>
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kodjizni/" . basename(__FILE__, '.php') . "_block_3.php",
                            )
                        ); ?>
                    </li>
                <? } ?>
            </ul>
        </div><!-- grid container end -->
    </div>
    <style>
        /* Feed part switch buttons styles */
        #rec599284289 .t-feed__parts-switch-btn {
            font-weight: 400;
            border: 1px solid #000000;
            border-radius: 40px;
        }

        #rec599284289 .t-feed__parts-switch-btn span,
        #rec599284289 .t-feed__parts-switch-btn a {
            color: #000000;
            padding: 6px 18px 6px;
            border-radius: 40px;
        }

        #rec599284289 .t-feed__parts-switch-btn.t-active {
            background-color: #000000;
        }

        #rec599284289 .t-feed__parts-switch-btn.t-active span,
        #rec599284289 .t-feed__parts-switch-btn.t-active a {
            color: #ffffff !important;
        }
    </style>
    <style type="text/css">
        #rec599284289 .t-feed__post-popup__cover-wrapper .t-slds__bullet_active .t-slds__bullet_body,
        #rec599284289 .t-feed__post-popup__cover-wrapper .t-slds__bullet:hover .t-slds__bullet_body {
            background-color: #222 !important;
        }
    </style><!-- news setup start -->
    <script>
        t_onReady(function() {
            var typography_optsObj = {
                title: "color:#373844;font-size:24px;font-weight:400;font-family:'Gotham';",
                descr: "",
                subtitle: ""
            };
            var separator_optsObj = {
                height: '',
                color: '',
                opacity: '',
                hideSeparator: false
            };
            var popup_optsObj = {
                popupBgColor: '#ffffff',
                overlayBgColorRgba: 'rgba(255,255,255,1)',
                closeText: '',
                iconColor: '#373844',
                popupStat: '',
                titleColor: '',
                textColor: '',
                subtitleColor: '',
                datePos: 'aftertext',
                partsPos: 'aftertext',
                imagePos: 'aftertitle',
                inTwoColumns: false,
                zoom: false,
                styleRelevants: '',
                methodRelevants: 'random',
                titleRelevants: '',
                showRelevants: '',
                shareStyle: '',
                shareBg: '',
                isShare: false,
                shareServices: '',
                shareFBToken: '',
                showDate: true,
                bgSize: 'cover'
            };
            var arrowtop_optsObj = {
                isShow: false,
                style: '',
                color: '',
                bottom: '',
                left: '',
                right: ''
            };
            var parts_optsObj = {
                partsBgColor: '',
                partsBorderSize: '1px',
                partsBorderColor: '#000000',
                align: 'center'
            };
            var gallery_optsObj = {
                control: '',
                arrowSize: '',
                arrowBorderSize: '',
                arrowColor: '',
                arrowColorHover: '',
                arrowBg: '',
                arrowBgHover: '',
                arrowBgOpacity: '',
                arrowBgOpacityHover: '',
                showBorder: '',
                dotsWidth: '',
                dotsBg: '',
                dotsActiveBg: '',
                dotsBorderSize: ''
            };
            var btnAllPosts_optsObj = {
                text: '',
                link: '',
                target: ''
            };
            var colWithBg_optsObj = {
                paddingSize: '',
                background: '',
                borderRadius: '',
                shadowSize: '',
                shadowOpacity: '',
                shadowSizeHover: '',
                shadowOpacityHover: '',
                shadowShiftyHover: ''
            };
            var options = {
                feeduid: '560628793411-531454235381',
                previewmode: 'yes',
                align: '',
                amountOfPosts: '',
                reverse: 'desc',
                blocksInRow: '',
                blocksClass: '',
                blocksWidth: '',
                colClass: '7',
                prefixClass: '4',
                vindent: '',
                dateFormat: '4',
                timeFormat: '',
                imageRatio: '75',
                hasOriginalAspectRatio: false,
                imageHeight: '',
                imageWidth: '',
                dateFilter: 'all',
                showPartAll: true,
                showImage: true,
                showShortDescr: true,
                showParts: true,
                showDate: true,
                hideFeedParts: false,
                parts_opts: parts_optsObj,
                btnsAlign: false,
                colWithBg: colWithBg_optsObj,
                separator: separator_optsObj,
                btnAllPosts: btnAllPosts_optsObj,
                popup_opts: popup_optsObj,
                arrowtop_opts: arrowtop_optsObj,
                gallery: gallery_optsObj,
                typo: typography_optsObj,
                amountOfSymbols: '',
                bbtnStyle: 'color:#ffffff;background-color:#000000;border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px;',
                btnStyle: '',
                btnTextColor: '',
                btnType: '',
                btnSize: '',
                btnText: '',
                btnReadMore: '',
                isHorizOnMob: false,
                itemsAnim: '',
                datePosPs: 'afterdescr',
                partsPosPs: 'afterdescr',
                imagePosPs: 'beforetitle',
                datePos: 'beforetitle',
                partsPos: 'beforetitle',
                imagePos: 'beforetitle'
            };
            t_onFuncLoad('t_feed_init', function() {
                t_feed_init('599284289', options);
            });
        });
    </script><!-- news setup end -->
</div>