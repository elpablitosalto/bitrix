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


<section id="<?= $idNav ?>">

    <?
    if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
        ?>
        <button class="rs__button__default rs__button__default rs__button__default--clear load-more rs__button--bg rs__button__default--full btn-more more-items"
                type="button">Показать еще
        </button>
    <? } ?>


    <nav class="pagination">
        <?
        $bFirst = true;
        $startPage = $arResult["nStartPage"];

        if ($arResult["NavPageNomer"] > 1):
            if ($arResult["bSavePage"]):
                ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                   class="rs__button__default rs__button__default--clear pagination__prev"
                   rel="prev"<? if ($arResult["NavPageNomer"] <= 1) { ?> disabled="disabled"<? } ?>>предыдущая</a>
                    <ul class="pagination__numbers">
            <?
            else:
                if ($arResult["NavPageNomer"] > 2):
                    ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                       class="rs__button__default rs__button__default--clear pagination__prev"
                       rel="prev"<? if ($arResult["NavPageNomer"] <= 1) { ?> disabled="disabled"<? } ?>>предыдущая</a>
                        <ul class="pagination__numbers">
                <?
                else:
                    ?>
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                       class="rs__button__default rs__button__default--clear pagination__prev" rel="prev"
                       disabled="disabled">предыдущая</a>
                            <ul class="pagination__numbers">
                <?
                endif;

            endif;

            if ($startPage > 1):
                $bFirst = false;
                if ($arResult["bSavePage"]):
                    ?>
                    <li class="rs__button__default rs__button__default--clear pagination__number"><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"
                        >1</a>
                    </li>
                <?
                else:
                    ?>
                    <li class="rs__button__default rs__button__default--clear pagination__number"><a
                                href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                        >1</a>
                    </li>
                <?
                endif;
                if ($startPage > 2):
                    ?>
                    <li class="rs__button__default rs__button__default--clear pagination__more">
                        <a href="#" itemprop="url">...</a>
                    </li>
                <?
                endif;
            endif;
        else:
            ?>
            <a href="#" class="rs__button__default rs__button__default--clear pagination__prev" rel="prev"
               disabled="disabled">предыдущая</a>
            <ul class="pagination__numbers">
        <?
        endif;

        do {
            if ($startPage == $arResult["NavPageNomer"]):
                ?>
                <li class="rs__button__default rs__button__default--clear pagination__number"><a
                    ><?= $startPage ?></a>
                </li>
            <?
            elseif ($startPage == 1 && $arResult["bSavePage"] == false):
                ?>
                <li class="rs__button__default rs__button__default--clear pagination__number"><a
                            href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                    ><?= $startPage ?></a>
                </li>
            <?
            else:
                ?>
                <li class="rs__button__default rs__button__default--clear pagination__number"><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $startPage ?>"
                    ><?= $startPage ?></a>
                </li>
            <?
            endif;
            $startPage++;
            $bFirst = false;
        } while ($startPage <= $arResult["nEndPage"]);

        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
            if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
                if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
                    ?>
                    <li class="rs__button__default rs__button__default--clear pagination__more">
                        <a href="#" itemprop="url">...</a>
                    </li>
                <?
                endif;
                ?>
                <li class="rs__button__default rs__button__default--clear pagination__number"><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"
                    ><?= $arResult["NavPageCount"] ?></a>
                </li>
            <?
            endif;
            ?>
            </ul>
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>" <? if ($arResult["NavPageNomer"] > $arResult["NavPageCount"]) { ?> disabled="disabled" <?
            } ?> class="rs__button__default rs__button__default--clear pagination__next" rel="next">следующая</a>
        <?
        else:
            ?>
            </ul>
            <a href="#" disabled="disabled" class="rs__button__default rs__button__default--clear pagination__next"
               rel="next">следующая</a>
        <? endif;
        ?>
    </nav>

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
                                //content.append(r);
                                $('.nav_result_<?=$arResult["NavNum"]?>').append($(r).find('.nav_result_<?=$arResult["NavNum"]?>').html());
                                $('.nav_string_<?=$arResult["NavNum"]?>').html($(r).find('.nav_string_<?=$arResult["NavNum"]?>').html());
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




