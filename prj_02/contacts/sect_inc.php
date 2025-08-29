	<div class="page-head">
    	<div class="container">
            <div class="section__content">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(),
                    false
                ); ?>
	        	<h1 class="page-title"><?$APPLICATION->ShowTitle(false)?></h1>
                <? $APPLICATION->IncludeComponent("bitrix:menu", "tabs", array(
                        "ROOT_MENU_TYPE" => "left",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                ); ?>
               	<picture class="contacts-head__pattern">
               		<img class="lazyload" src="<?=SITE_TEMPLATE_PATH?>/images/loader.svg"
                    	data-src="<?=SITE_TEMPLATE_PATH?>/images/main-first-birds.png" loading="lazy"
                        alt="Дорога к дому" title="Дорога к дому"/>
                </picture>
    		</div>
    	</div>
	</div>
