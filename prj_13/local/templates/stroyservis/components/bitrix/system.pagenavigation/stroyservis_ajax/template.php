<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");

//$MESS_NEXT = GetMessage("nav_next");
$MESS_NEXT = "Дальше";
//$MESS_NEXT = GetMessage("nav_prev");
$MESS_PREV = "Назад";
//vardump($arParams);
//echo 'BASE_LINK = '.$arParams["BASE_LINK"].'<br />';
//vardump($arResult);
//vardump($_GET);

if ($arResult["NavPageCount"] > 1) {
?>
    <div class="pagination">
        <?
        if ($arResult["bDescPageNumbering"] === true) {
            $bFirst = true;
            if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) :
                if ($arResult["bSavePage"]) { ?>

                    <a class="blog-page-previous" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= $MESS_PREV ?></a>
                    <?
                } else {
                    if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)) {
                    ?>
                        <a class="blog-page-previous" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $MESS_PREV ?></a>
                    <?
                    } else {
                    ?>
                        <a class="blog-page-previous" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= $MESS_PREV ?></a>
                <?
                    }
                }
                ?>
                <span class="blog-vert-separator">|</span>
                <?

                if ($arResult["nStartPage"] < $arResult["NavPageCount"]) :
                    $bFirst = false;
                    if ($arResult["bSavePage"]) : ?>
                        <a class="blog-page-first" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>">1</a>
                    <?
                    else :
                    ?>
                        <a class="blog-page-first" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">1</a>
                    <?
                    endif;
                    ?>
                    <span class="blog-vert-separator">|</span>
                    <?
                    if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)) :
                    ?>
                        <span class="blog-page-dots">...</span>
                        <span class="blog-vert-separator">|</span>
                    <?
                    endif;
                endif;
            endif;
            do {
                $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;

                if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) :
                    ?>
                    <span class="<?= ($bFirst ? "blog-page-first " : "") ?>blog-page-current"><?= $NavRecordGroupPrint ?></span>
                <?
                elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false) :
                ?>
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="<?= ($bFirst ? "blog-page-first" : "") ?>"><?= $NavRecordGroupPrint ?></a>
                <?
                else :
                ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>" <? ?> class="<?= ($bFirst ? "blog-page-first" : "") ?>"><?= $NavRecordGroupPrint ?></a>
                <?
                endif;
                ?>
                <span class="blog-vert-separator">|</span>
                <?

                $arResult["nStartPage"]--;
                $bFirst = false;
            } while ($arResult["nStartPage"] >= $arResult["nEndPage"]);

            if ($arResult["NavPageNomer"] > 1) :
                if ($arResult["nEndPage"] > 1) :
                    if ($arResult["nEndPage"] > 2) : ?>
                        <span class="blog-page-dots">...</span>
                        <span class="blog-vert-separator">|</span>
                    <?
                    endif;
                    ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= $arResult["NavPageCount"] ?></a>
                    <span class="blog-vert-separator">|</span>
                <?
                endif;
                ?>
                <a class="blog-page-next" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= $MESS_NEXT ?></a>
                <?
            endif;
        } else {
            $bFirst = true;

            if ($arResult["NavPageNomer"] > 1) {
                if ($arResult["bSavePage"]) {
                ?>
                    <a class="pagination__button" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= $MESS_PREV ?></a>
                    <?/*?><button class="pagination__button"><?= $MESS_PREV ?></button><?*/ ?>
                    <?
                } else {
                    if ($arResult["NavPageNomer"] > 2) {
                    ?>
                        <a class="pagination__button" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= $MESS_PREV ?></a>
                    <? } else { ?>
                        <a class="pagination__button" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $MESS_PREV ?></a>
                <?
                    }
                }
            }
            if (TRUE) {
                ?>
                <ul class="pagination__list">
                    <?/*?><span class="blog-vert-separator">|</span><?*/ ?>
                    <? if ($arResult["nStartPage"] > 1) {
                        $bFirst = false;
                        if ($arResult["bSavePage"]) { ?>
                            <li>
                                <a class="pagination__item" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1">1</a>
                            </li>

                        <? } else { ?>
                            <li>
                                <a class="pagination__item" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">1</a>
                            </li>
                        <? } ?>
                        <?/*?>
                        <span class="blog-vert-separator">|</span>
                        <?*/ ?>
                        <? if ($arResult["nStartPage"] > 2) { ?>
                            <li><a class="pagination__item" onclick="return false;">...</a></li>
                            <?/*?>
                            <span class="blog-page-dots">...</span>
                            <span class="blog-vert-separator">|</span>
                            <?*/ ?>
                        <?
                        }
                    }
                }

                do {
                    $number = $arResult["nStartPage"];
                    /*
                    //if( $arResult["nStartPage"] == ( $arResult["nEndPage"] - 1 ) )
                    if ($arResult["NavPageNomer"] >= $arResult["NavPageCount"]) {
                        $number = "";
                    }
                    */

                    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) :
                        ?>
                        <li><a class="pagination__item pagination__item_select" onclick="return false;"><?= $number ?></a></li>
                        <?/*?>
                        <span class="<?= ($bFirst ? "blog-page-first " : "") ?>blog-page-current"><?= $arResult["nStartPage"] ?></span>
                        <?*/ ?>
                    <?
                    elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false) :
                    ?>
                        <li>
                            <a class="pagination__item" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="<?= ($bFirst ? "blog-page-first" : "") ?>"><?= $number ?></a>
                        </li>
                    <?
                    else :
                    ?>
                        <li>
                            <a class="pagination__item" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $number ?>" <? ?> class="<?= ($bFirst ? "blog-page-first" : "") ?>"><?= $number ?></a>
                        </li>
                    <?
                    endif;
                    ?>
                    <?/*?> <span class="blog-vert-separator">|</span> <?*/ ?>
                    <?
                    $arResult["nStartPage"]++;
                    $bFirst = false;
                } while ($arResult["nStartPage"] <= $arResult["nEndPage"]);

                if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
                    if ($arResult["nEndPage"] < $arResult["NavPageCount"]) {
                        if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)) { ?>
                            <li><a class="pagination__item" onclick="return false;">...</a></li>
                            <?/*?>
                            <span class="blog-page-dots">...</span>
                            <span class="blog-vert-separator">|</span>
                            <?*/ ?>
                        <? } ?>
                        <li>
                            <?
                            $str = $arResult["NavPageCount"];
                            //$str = "";
                            ?>
                            <a class="pagination__item" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><?= $str ?></a>
                        </li>
                        <?/*?>
                        <span class="blog-vert-separator">|</span>
                        <?*/ ?>
                    <?
                    }
                    ?>
                <?
                }
                ?>
                </ul>
                <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
                    <a class="pagination__button" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
                        <?= $MESS_NEXT ?>
                    </a>
                <? } ?>
            <? }

        /*
            if ($arResult["bShowAll"]) {
                if ($arResult["NavShowAll"]) {
                ?>
                    <a class="blog-page-pagen" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=0"><?= GetMessage("nav_paged") ?></a>
                <? } else { ?>
                    <a class="blog-page-all" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=1"><?= GetMessage("nav_all") ?></a>
            <?
                }
            }
            */
            ?>
    </div>
<?
}
?>