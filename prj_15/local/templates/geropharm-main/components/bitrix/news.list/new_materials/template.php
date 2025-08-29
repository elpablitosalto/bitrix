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

$sliderClass = 'dp-new-blog-slider';
switch ($arParams["CURRENT_BLOCK"]) {
	case "upcoming_webinars":
		$sliderClass = 'dp-home-events-slider';
		break;
	case "webinars":
		$sliderClass = 'dp-blog-slider';
		break;
	case "articles":
		$sliderClass = 'dp-blog-slider';
		break;
	case "master-class":
		$sliderClass = 'dp-courses-slider';
		break;
	case "courses":
		$sliderClass = 'dp-courses-slider';
		break;
}
?>

<div class="dp-slider <?=$sliderClass;?>">
        <div class="dp-slider__list">

            <? switch ($arParams["CURRENT_BLOCK"]) {
                case "upcoming_webinars":
                    require($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/upcoming_webinars.php");
                    break;
                case "webinars":
                    require($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/webinars.php");
                    break;
                case "articles":
                    require($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/articles.php");
                    break;
                case "master-class":
                    require($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/master-class.php");
                    break;
                case "courses":
                    require($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/course.php");
                    break;
            } ?>

        </div>
    </div>



