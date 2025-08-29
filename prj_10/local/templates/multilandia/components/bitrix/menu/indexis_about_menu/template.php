<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

    <div class="ml-sidebar-block">
        <?
            foreach($arResult as $arItem):
        ?>
        <div class="ml-sidebar-menu">
            <p class="ml-sidebar-menu__title"><?=$arItem['TEXT'];?></p>
            <ul class="ml-sidebar-menu__list">
                <?
                foreach($arItem['CHILDREN'] as $child):
                ?>
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="<?=$child['LINK'];?>"><?=$child['TEXT'];?></a></li>
                <?endforeach;?>
                <!--
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="/about/concurse-rules/">Правила конкурсов</a></li>
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="/about/contacts/">Контакты</a></li>
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="/about/cookies/">Cookies</a></li>
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="/about/policy/">Политика конфиденциальности</a></li>
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="/about/channel-connecting/">Как подключить канал</a></li>
                -->
            </ul>
        </div>
            <?endforeach;?>
        <!--
        <div class="ml-sidebar-menu">
            <a class="ml-sidebar-menu__title" href="#">Партнерам</a>
            <ul class="ml-sidebar-menu__list">
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="/partners/program/">Программа</a></li>
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="/partners/technical-info/">Техническая информация</a></li>
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="/partners/program-distribution/">Рассылка программы</a></li>
                <li class="ml-sidebar-menu__item"><a class="ml-sidebar-menu__link" href="/partners/promo-documents/">Промо-материалы</a></li>
            </ul>
        </div>
        -->
    </div>


<!--
<ul id="vertical-multilevel-menu">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul class="root-item">
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>
-->
