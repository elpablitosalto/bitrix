<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


if (!$arResult["NavShowAlways"])
{
	if (0 == $arResult["NavRecordCount"] || (1 == $arResult["NavPageCount"] && false == $arResult["NavShowAll"]))
		return;
}
if ('' != $arResult["NavTitle"])
	$arResult["NavTitle"] .= ' ';

$strSelectPath = $arResult['sUrlPathParams'].($arResult["bSavePage"] ? '&PAGEN_'.$arResult["NavNum"].'='.(true !== $arResult["bDescPageNumbering"] ? 1 : '').'&' : '').'SHOWALL_'.$arResult["NavNum"].'=0&SIZEN_'.$arResult["NavNum"].'=';

?>
		<div class="ml-pagenav">
			<div class="container"><?
if ($arResult["NavShowAll"])
{
?>
				<span class="bx_pg_text"><? echo GetMessage('nav_all_descr'); ?></span>
				<ul>
					<li class="ml-pagenav-list__item"><a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>SHOWALL_<?=$arResult["NavNum"]?>=0&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>"><? echo GetMessage('nav_show_pages'); ?></a></li>
				</ul>
<?
}
else
{
?>
				<ul class="ml-pagenav-list">
<?
	if (true === $arResult["bDescPageNumbering"])
	{
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			?>
            <li class="ml-pagenav-list__item ml-pagenav-list__item_prev">
                <a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_prev_title'); ?>">
                    <svg class="icon icon-arrowLeft ml-pagenav-list__icon">
                        <use xlink:href="#arrowLeft"></use>
                    </svg>
                </a>
            </li><?
		}

		$NavRecordGroup = $arResult["NavPageCount"];
		while ($NavRecordGroup >= 1)
		{
			$NavRecordGroupPrint = $arResult["NavPageCount"] - $NavRecordGroup + 1;
			$strTitle = GetMessage(
				'nav_page_num_title',
				array('#NUM#' => $NavRecordGroupPrint)
			);
			if ($NavRecordGroup == $arResult["NavPageNomer"])
			{
                ?><li class="bx_active ml-pagenav-list__item" title="<? echo GetMessage('nav_page_current_title'); ?>"><span class="ml-pagenav-list__link ml-pagenav-list__link_active"><? echo $NavRecordGroupPrint; ?></span></li><?
			}
			elseif ($NavRecordGroup == $arResult["NavPageCount"] && $arResult["bSavePage"] == false)
			{
				?><li class="ml-pagenav-list__item"><a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a></li><?
			}
			else
			{
				?><li class="ml-pagenav-list__item"><a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a></li><?
			}

			if (1 == ($arResult["NavPageCount"] - $NavRecordGroup) && 2 < ($arResult["NavPageCount"] - $arResult["nStartPage"]))
			{
				$middlePage = floor(($arResult["nStartPage"] + $NavRecordGroup)/2);
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $NavRecordGroupPrint)
				);
				?><li class="ml-pagenav-list__item ml-pagenav-list__item_sep"><span>...</span></li><?
				$NavRecordGroup = $arResult["nStartPage"];
			}
			elseif ($NavRecordGroup == $arResult["nEndPage"] && 3 < $arResult["nEndPage"])
			{
				$middlePage = ceil(($arResult["nEndPage"] + 2)/2);
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $NavRecordGroupPrint)
				);
				?><li class="ml-pagenav-list__item ml-pagenav-list__item_sep"><span>...</span></li><?
				$NavRecordGroup = 2;
			}
			else
			{
				$NavRecordGroup--;
			}
		}
		?><?
		if ($arResult["NavPageNomer"] > 1)
		{
			?>
            <li class="ml-pagenav-list__item ml-pagenav-list__item_next">
                <a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_next_title'); ?>">
                    <svg class="icon icon-arrowRight ml-pagenav-list__icon">
                        <use xlink:href="#arrowRight"></use>
                    </svg>
                </a>
            </li>
            <?
		}
	}
	else
	{
?>
        <?
		if (1 < $arResult["NavPageNomer"])
		{
			?>
            <li class="ml-pagenav-list__item ml-pagenav-list__item_prev">
                <a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_prev_title'); ?>">
                    <svg class="icon icon-arrowLeft ml-pagenav-list__icon">
                        <use xlink:href="#arrowLeft"></use>
                    </svg>
                </a>
            </li><?
		}
		$NavRecordGroup = 1;
		while($NavRecordGroup <= $arResult["NavPageCount"])
		{
			$strTitle = GetMessage(
				'nav_page_num_title',
				array('#NUM#' => $NavRecordGroup)
			);
			if ($NavRecordGroup == $arResult["NavPageNomer"])
			{
                ?><li class="bx_active ml-pagenav-list__item" title="<? echo GetMessage('nav_page_current_title'); ?>"><span class="ml-pagenav-list__link ml-pagenav-list__link_active"><? echo $NavRecordGroup; ?></span></li><?
			}
			elseif ($NavRecordGroup == 1 && $arResult["bSavePage"] == false)
			{
				?><li class="ml-pagenav-list__item"><a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroup?></a></li><?
			}
			else
			{
				?><li class="ml-pagenav-list__item"><a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroup?></a></li><?
			}


			if ($NavRecordGroup == 2 && $arResult["nStartPage"] > 3 && $arResult["nStartPage"] - $NavRecordGroup > 1)
			{
				$middlePage = ceil(($arResult["nStartPage"] + $NavRecordGroup)/2);
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $middlePage)
				);
				?><li class="ml-pagenav-list__item ml-pagenav-list__item_sep"><span>...</span></li><?
				$NavRecordGroup = $arResult["nStartPage"]+2;
			}
			elseif ($NavRecordGroup == $arResult["nEndPage"] && $arResult["nEndPage"] < ($arResult["NavPageCount"] - 2))
			{
				$middlePage = floor(($arResult["NavPageCount"] + $arResult["nEndPage"] - 1)/2);
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $middlePage)
				);
				?><li class="ml-pagenav-list__item ml-pagenav-list__item_sep"><span>...</span></li><?
				$NavRecordGroup = $arResult["NavPageCount"];
			}
			else
			{
				$NavRecordGroup++;
			}
		}
			?>
        <?
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			?>
            <li class="ml-pagenav-list__item ml-pagenav-list__item_next">
                <a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_next_title'); ?>">
                    <svg class="icon icon-arrowRight ml-pagenav-list__icon">
                        <use xlink:href="#arrowRight"></use>
                    </svg>
                </a>
            </li>
            <?
		}

		if ($arResult["bShowAll"])
		{
			?><li class="ml-pagenav-list__item"><a class="ml-pagenav-list__link" href="<?=$arResult['sUrlPathParams']; ?>SHOWALL_<?=$arResult["NavNum"]?>=1&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageSize"]?>"><? echo GetMessage('nav_all'); ?></a></li><?
		}
	}
?>
				</ul><?
}
?>
			</div>
		</div>