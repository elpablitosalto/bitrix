<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

?>

<?if(is_array($arResult["SECTION"]["UF_REFRESH_IMAGES"]) && !empty($arResult["SECTION"]["UF_REFRESH_IMAGES"])){
    $randKey = array_rand($arResult["SECTION"]["UF_REFRESH_IMAGES"]);
    ?>
<div class="dp-home-top__col-img">
    <div class="dp-home-top__img">
        <img src="<?=CFile::GetPath($arResult["SECTION"]["UF_REFRESH_IMAGES"][$randKey])?>"
                                       alt="<?=$arResult["NAME"]?>">
    </div>
</div>
<?}?>