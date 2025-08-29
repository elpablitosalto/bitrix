<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

    <div class="col-6 col-md-8">
        <div class="row">
            <?
            foreach($arResult as $arItem):
            ?>
            <div class="col-md-6 ml-col-menu">
                <div class="ml-footer-menu ml-footer-menu_dropdown">
                    <p class="ml-footer-menu__title"><?=$arItem['TEXT'];?></p>
                    <ul class="ml-footer-menu__list">
                         <?
                            foreach($arItem['CHILDREN'] as $child):
                            ?>
                        <li class="ml-footer-menu__item"><a class="ml-footer-menu__link" href="<?=$child['LINK'];?>"><?=$child['TEXT'];?></a></li>
                            <?endforeach;?>
                    </ul>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>
<?
endif;
?>
