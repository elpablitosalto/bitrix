<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$item = $arParams['ITEM'];
//$arImages = $item['DISPLAY_PROPERTIES']['NO_3_IMAGES']['VALUE'];
$arImages = $item['DISPLAY_PROPERTIES']['NO_3_IMAGES']['FILE_VALUE'];
if( intval( $arImages["ID"] ) > 0 )
{
    $arImages = array( $arImages ); 
}
//vardump($arImages);
//echo "count = " . count($arImages) . "<br/>";
if (!empty($arImages)) {
?>
    <div class="rs__news--detail-slider">
        <div class="js--news--detail-slider rs__news--slide-block swiper-container">
            <div class="swiper-wrapper rs__news--slide-box">
                <?
                foreach ($arImages as $key => $val) {
                    ?>
                    <div class="swiper-slide">
                        <div class="rs__news--slide-item">
                            <picture>
                                <img src="<?= $val["SRC"]; ?>">
                            </picture>
                        </div>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
        <div class="is-hidden-tablet swiper-pagination"></div>
        <div class="js--news--detail-thumbs rs__news--thumb-block swiper-container-thumbs">
            <div class="swiper-wrapper rs__news--thumb-box">
                <?
                foreach ($arImages as $key => $val) {
                    ?>
                    <div class="swiper-slide rs__news--thumb-item">
                        <picture>
                            <img src="<?= $val["SRC"]; ?>">
                        </picture>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
<?
}
?>