<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["ID"] = intval(($arParams["ID"] ?? 0));
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arResult["SECTIONS"] = array();
$arResult["SECTIONS_ID"] = array();
$arResult["ELEMENT_LINKS"] = array();

if($this->StartResultCache())
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
		$arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			"ACTIVE"=>"Y",
		);
		if(is_array($arParams["FILTER"])){
			$arFilter = array_merge($arFilter,$arParams["FILTER"]);
		}

		$sectionsID = [];
		$dbSections = Bitrix\Iblock\SectionTable::getList([
			'select' => [
				'INNER_ID' => 'INNER_SECTION.ID',
			],
			'filter' => $arFilter,
			'runtime' => [
				'INNER_SECTION' => [
					'data_type' => Bitrix\Iblock\SectionTable::class,
					'reference' => [
						'<this.LEFT_MARGIN' => 'ref.LEFT_MARGIN',
						'>this.RIGHT_MARGIN' => 'ref.RIGHT_MARGIN',
						'this.IBLOCK_ID' => 'ref.IBLOCK_ID',
					],
					'join_type' => 'LEFT'
				]
			]
		]);
		while($arSection = $dbSections->Fetch())
		{
			$sectionsID[] = $arSection["INNER_ID"];
		}

		//пользовательские свойства
		if(count($sectionsID) > 0){
			$query = new \Bitrix\Main\Entity\Query(\Bitrix\Iblock\Model\Section::compileEntityByIblock($arParams["IBLOCK_ID"]));
			$query
				->setOrder
				(
					array("LEFT_MARGIN" => "ASC", "SORT" => "ASC"),
				)
				->setFilter(
					array(
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ID" => $sectionsID,
					)
				)
				->setSelect(
					array( "ID", "DEPTH_LEVEL", "NAME", "CODE", "UF_LINK", "UF_COLUMN", "UF_HIDE_NAME" )
				)
				->setLimit(count($arResult["SECTIONS"]));
			$dbSections = $query->exec();
			while ( $arSection = $dbSections ->fetch() ) {
				$arResult["SECTIONS"][$arSection["ID"]] = $arSection;
			}
		}

		$this->EndResultCache();
	}
}

$aMenuLinksNew = array();
$menuIndex = 0;
$previousDepthLevel = 1;
foreach($arResult["SECTIONS"] as $arSection)
{
	if ($menuIndex > 0)
		$aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;
	$previousDepthLevel = $arSection["DEPTH_LEVEL"];

	$aMenuLinksNew[$menuIndex++] = array(
		htmlspecialcharsbx($arSection["NAME"]),
		$arSection["UF_LINK"],
		$arResult["ELEMENT_LINKS"][$arSection["ID"]],
		array(
			"FROM_IBLOCK" => true,
			"IS_PARENT" => false,
			"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
			"UF_COLUMN" => $arSection["UF_COLUMN"],
			"UF_HIDE_NAME" => $arSection["UF_HIDE_NAME"],
			"CODE" => $arSection["CODE"]
		),
	);
}

return $aMenuLinksNew;
?>
