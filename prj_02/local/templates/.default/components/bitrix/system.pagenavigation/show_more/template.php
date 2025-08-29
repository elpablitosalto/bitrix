<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$arResult["NavQueryString"] = str_replace(["AJAX_LOAD=Y"], [""], $arResult["NavQueryString"]);

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");

$idNav = 'nav_' . $arResult["NavNum"] . '_' . md5(mt_rand());

$nPageWindow = 3; //количество отображаемых страниц
if ($arResult["NavPageNomer"] > floor($nPageWindow / 2) + 1 && $arResult["NavPageCount"] > $nPageWindow)
    $nStartPage = $arResult["NavPageNomer"] - floor($nPageWindow / 2);
else
    $nStartPage = 1;

if ($arResult["NavPageNomer"] <= $arResult["NavPageCount"] - floor($nPageWindow / 2) && $nStartPage + $nPageWindow - 1 <= $arResult["NavPageCount"])
    $nEndPage = $nStartPage + $nPageWindow - 1;
else {
    $nEndPage = $arResult["NavPageCount"];
    if ($nEndPage - $nPageWindow + 1 >= 1)
        $nStartPage = $nEndPage - $nPageWindow + 1;
}
$arResult["nStartPage"] = $arResult["nStartPage"] = $nStartPage;
$arResult["nEndPage"] = $arResult["nEndPage"] = $nEndPage;

?>

<section class="pagination-block" id="<?= $idNav ?>">


    <?
    if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
        ?>
        <a href="#" class="btn btn-transparent pagination-btn-more btn-more more-items">Показать еще</a>
    <? } ?>


        <ul class="pagination">
            <?
            $bFirst = true;
            $startPage = $arResult["nStartPage"];

            if ($arResult["NavPageNomer"] > 1):
                if($arResult["bSavePage"]):
                    ?>
                    <li class="prev"><a
                                class="pagenav-list__link<? if ($arResult["NavPageNomer"] <= 1) { ?> disabled<?
                                } ?>"
                                href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
                            <u>предыдущая</u>
                        </a></li>
                <?
                else:
                    if ($arResult["NavPageNomer"] > 2):
                        ?>
                        <li class="prev"><a
                                    class="pagenav-list__link<? if ($arResult["NavPageNomer"] <= 1) { ?> disabled<?
                                    } ?>"
                                    href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
                                <u>предыдущая</u>
                            </a></li>
                    <?
                    else:
                        ?>
                        <li class="prev"><a
                                    class="pagenav-list__link<? if ($arResult["NavPageNomer"] <= 1) { ?> disabled<?
                                    } ?>"
                                    href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
                                <u>предыдущая</u>
                            </a></li>
                    <?
                    endif;

                endif;

                if ($startPage > 1):
                    $bFirst = false;
                    if($arResult["bSavePage"]):
                        ?>
                        <li class="pagenav-list__item"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"
                                                          class="pagenav-list__link">1</a>
                        </li>
                    <?
                    else:
                        ?>
                        <li class="pagenav-list__item"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"
                                                          class="pagenav-list__link">1</a>
                        </li>
                    <?
                    endif;
                    if ($startPage > 2):
                        ?>
                        <li class="pagenav-list__item pagenav-list__item_sep"><span>...</span></li>
                    <?
                    endif;
                endif;
            else:
                ?>
                <li class="prev"><a
                            class="pagenav-list__link disabled"
                            href="#">
                        <u>предыдущая</u>
                    </a></li>
            <?
            endif;

            do
            {
                if ($startPage == $arResult["NavPageNomer"]):
                    ?>
                    <li class="pagenav-list__item"><a
                                class="pagenav-list__link pagenav-list__link_active"><?=$startPage?></a>
                    </li>
                <?
                elseif($startPage == 1 && $arResult["bSavePage"] == false):
                    ?>
                    <li class="pagenav-list__item"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"
                                                      class="pagenav-list__link"><?=$startPage?></a>
                    </li>
                <?
                else:
                    ?>
                    <li class="pagenav-list__item"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$startPage?>"
                                                      class="pagenav-list__link"><?=$startPage?></a>
                    </li>
                <?
                endif;
                $startPage++;
                $bFirst = false;
            } while($startPage <= $arResult["nEndPage"]);

            if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
                if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
                    if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
                        ?>
                        <li class="pagenav-list__item pagenav-list__item_sep"><span>...</span></li>
                    <?
                    endif;
                    ?>
                    <li class="pagenav-list__item"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"
                                                      class="pagenav-list__link"><?=$arResult["NavPageCount"]?></a>
                    </li>
                <?
                endif;
                ?>
                <li class="next"><a
                            class="pagenav-list__link<? if ($arResult["NavPageNomer"] > $arResult["NavPageCount"]) { ?> disabled<?
                            } ?>"
                            href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
                        <u>следующая</u>
                    </a></li>
            <?
            else:
                ?>
                <li class="next"><a
                            class="pagenav-list__link disabled"
                            href="">
                        <u>следующая</u>
                    </a></li>
            <? endif;
            ?>
        </ul>

    <script type="text/javascript">
        (function (idNav) {
            var btn = $('#' + idNav),
                content = $('.nav_result_<?=$arResult["NavNum"]?>'),
                nav = {
                    this_page: <?=$arResult["NavPageNomer"]?>,
                    max_page: <?=$arResult["NavPageCount"]?>
                };
            var load = function () {
                if (!btn.hasClass('loading') && content.length > 0) {
                    if (nav.this_page < nav.max_page) {
                        //PAGE_LOADING.Show();
                        nav.this_page++;
                        var url = window.location.pathname + window.location.search;
                        //alert(url);
                        $.ajax({
                            dataType: 'html',
                            url: url,
                            data: {'PAGEN_<?=$arResult["NavNum"]?>': nav.this_page, 'AJAX_LOAD': 'Y'},
                            success: function (r) {
                                btn.remove();
                                content.append(r);
                                LoadImagesLazy();
                                //PAGE_LOADING.Hide();
                            }
                        });
                    }
                }
            };
            btn.show().find('.more-items').click(function (e) {
                e.preventDefault();
                load();
            });
            $()
        })('<?=$idNav?>');
    </script>

</section>




