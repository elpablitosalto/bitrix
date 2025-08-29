<section class="care">
    <h2><span>Мы заботимся</span> о том, чтобы у&nbsp;вас было все необходимое
    </h2>
    <div class="care__registration">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/reg_partner.php"
            )
        ); ?>
        <?/*?>
        <a class="underline-link" href="/registration/partner/">Зарегистрируйтесь,</a> чтобы открыть все возможности сайта
        <?*/ ?>
    </div>
    <div class="care__wrapper">
        <div class="care__block">
            <h3>Поддержка и документация</h3>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main/bottom_docs.php"
                )
            ); ?>
        </div>
        <div class="care__block care__base">
            <div class="care__base-content">
                <h3>База знаний</h3>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/main/bottom_base.php"
                    )
                ); ?>
            </div>
            <div class="care__base-image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/care/base.jpg" alt="">
            </div>
        </div>
    </div>
</section>