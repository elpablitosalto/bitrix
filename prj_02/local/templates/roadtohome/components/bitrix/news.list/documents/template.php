<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\Grid\Declension;

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
?>
<? if (!empty($arResult["ITEMS"])) { ?>
	<section>
		<div class="container">
			<div class="site-accordeon">
				<? foreach ($arResult["ITEMS"] as $key => $item) {

					$file_values = $item['DISPLAY_PROPERTIES']["FILE"]['FILE_VALUE'];
					if( intval( $file_values['ID'] ) > 0 )
					{
						$file_values = array( $file_values );
					}

					$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
					<div class="site-accordeon__item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
						<div class="site-accordeon__item-head">
							<h4 class="site-accordeon__item-title"><?= $item['NAME'] ?></h4>
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light site-accordeon__item-icon">
								<use xlink:href="#drop-light"></use>
							</svg>
						</div>
						<div class="site-accordeon__item-body">
							<div class="items-list documents-list">
								<?
								/*
								if (isset($item['DISPLAY_PROPERTIES']["FILE"]['FILE_VALUE']['ID'])) { // только 1 файл
									$file_values[0] = $item['DISPLAY_PROPERTIES']["FILE"]['FILE_VALUE'];
								} else {
									$file_values = $item['DISPLAY_PROPERTIES']["FILE"]['FILE_VALUE'];
								}
								*/
								//vardump($file_values);
								foreach ($file_values as $file_value) {
									$ext_pos = mb_strrpos($file_value["FILE_NAME"], '.');
									$ext = mb_strtoupper(mb_substr($file_value["FILE_NAME"], $ext_pos + 1));
									if (!empty($file_value["DESCRIPTION"])) {
										$title = $file_value["DESCRIPTION"];
									} else {
										$title = mb_substr($file_value["FILE_NAME"], 0, $ext_pos);
									}
									$sizeMB = IntVal($file_value["FILE_SIZE"] / 1024 / 1024);
									if ($sizeMB < 1) {
										$fileSize = (string)IntVal($file_value["FILE_SIZE"] / 1024) . ' kB';
									} else {
										$fileSize = (string)$sizeMB . ' mB';
									}
								?>
									<div class="list-item document-item">
										<? if ($ext == 'PDF') { ?>
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-pdf document-item__icon">
												<use xlink:href="#pdf"></use>
											</svg>
										<? } elseif ($ext == 'DOC' || $ext == 'DOCX') { ?>
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-word document-item__icon">
												<use xlink:href="#word"></use>
											</svg>
										<? } elseif ($ext == 'XLS' || $ext == 'XLSX') { ?>
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-exel document-item__icon">
												<use xlink:href="#exel"></use>
											</svg>
										<? } ?>
										<div class="text-size-lg document-item__title"><?= $title ?></div>
										<div class="document-item__info"><?= $ext; ?>, <?= $fileSize ?></div>
										<a href="<?= $file_value["SRC"] ?>" class="btn btn-transparent document-item__link" download="<?= $file_value["FILE_NAME"] ?>">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-download">
												<use xlink:href="#download"></use>
											</svg>
										</a>
									</div>
								<? } ?>

							</div>
						</div>
					</div>
				<? } ?>
			</div>
		</div>
	</section>
<? } ?>
</div>