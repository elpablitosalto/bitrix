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

//vardump($arParams);
//vardump($arResult);
?>

<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
    <div id="<?= $idNav ?>">
        <a style="display: block;" class="materials-item__colors-all js_more_items" href="#" data-id-nav="<?= $idNav ?>" data-nav-num="<?= $arResult["NavNum"] ?>" data-page-nomer="<?= $arResult["NavPageNomer"] ?>" data-max-page="<?= $arResult["NavPageCount"] ?>">
            Cмотреть больше
        </a>
    </div>
<? } ?>


<?/*?>
<script type="text/javascript">
    $(document).ready(function() {
        initClickShowMore('<?= $idNav ?>');
    });

    function initClickShowMore(idNav) {
        $('.js_more_items_' + idNav).on('click', function(e) {
            //alert(idNav);
            e.preventDefault();

            var btn = $('#' + idNav);
            var content = $('.js_nav_result_<?= $arResult["NavNum"] ?>');
            var nav = {
                this_page: <?= $arResult["NavPageNomer"] ?>,
                max_page: <?= $arResult["NavPageCount"] ?>
            };

            if (!btn.hasClass('loading') && content.length > 0) {
                btn.addClass('loading');
                if (nav.this_page < nav.max_page) {
                    nav.this_page++;
                    var url = window.location.pathname + window.location.search;
                    //alert(url);
                    $.ajax({
                        dataType: 'html',
                        url: url,
                        data: {
                            'PAGEN_<?= $arResult["NavNum"] ?>': nav.this_page,
                            'AJAX_LOAD': 'Y'
                        },
                        success: function(r) {
                            alert('.js_nav_result_<?= $arResult["NavNum"] ?>');
                            var append = $(r).find('.js_nav_result_<?= $arResult["NavNum"] ?>').html();
                            alert(append);
                            $('.js_nav_result_<?= $arResult["NavNum"] ?>').append(append);
                            $('.js_nav_string_<?= $arResult["NavNum"] ?>').html($(r).find('.js_nav_string_<?= $arResult["NavNum"] ?>').html());
                            btn.removeClass('loading');
                            initClickShowMore(idNav);
                        }
                    });
                }
            }
        });
    }
</script>
<?*/ ?>