<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

/*
if($arParams["SHOW_CHAIN"] != "N" && !empty($arResult["TAGS_CHAIN"])):
?>
<noindex>
	<div class="search-tags-chain" <?=$arParams["WIDTH"]?>><?
		foreach ($arResult["TAGS_CHAIN"] as $tags):
			?><a href="<?=$tags["TAG_PATH"]?>" rel="nofollow"><?=$tags["TAG_NAME"]?></a> <?
			?>[<a href="<?=$tags["TAG_WITHOUT"]?>" class="search-tags-link" rel="nofollow">x</a>]  <?
		endforeach;?>
	</div>
</noindex>
<?
endif;
*/

if (is_array($arResult["SEARCH"]) && !empty($arResult["SEARCH"])) {
	if ($arParams["TYPE_PAGE"] == "section") {
?>
		<noindex>
			<div class="news-tags">
				<ul class="tags-list">
					<?
					$i = 0;
					foreach ($arResult["SEARCH"] as $key => $res) {
						$select = "btn-transparent";
						$url = $res["URL"];
						if (urldecode($_GET["artags"][$key]) == urldecode($res["NAME"])) {
							$select = "";
							$url = $res["URL_UNSET"];
						}
					?>
						<li>
							<a href="<?= $url ?>" class="btn <?= $select ?> tag" rel="nofollow">
								#<?= $res["NAME"] ?>
							</a>
						</li>
					<?
						$i++;
					}																																							?>
				</ul>
			</div>
		</noindex>
	<?
	} elseif ($arParams["TYPE_PAGE"] == "detail") {
		//vardump($arResult["SEARCH"]);
	?>
		<div class="news-detail-tags">
			<ul class="tags-list">
				<? foreach ($arResult["SEARCH"] as $key => $res) {
					$bShow = false;
					if (is_array($arParams["TAGS_THIS_ELEMENT"])) {
						if (in_array($res["NAME"], $arParams["TAGS_THIS_ELEMENT"])) {
							$bShow = true;
						}
					}
					if ($bShow) {
				?>
						<li><a href="<?= $res["URL"] ?>" class="btn btn-transparent tag">#<?= $res["NAME"] ?></a></li>
				<?
					}
				} ?>
			</ul>
		</div>
<?
	}
}
?>