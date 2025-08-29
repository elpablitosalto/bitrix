<div class="page__attention-panel">
    <div class="page__container">
        <!-- begin .attention-panel-->
        <div class="attention-panel">
            <div class="attention-panel__holder">
                <div class="attention-panel__text">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "/include/main/ask_text.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ),
                        false,
                        array('HIDE_ICONS' => 'N')
                    );
                    ?>
                </div>
                <div class="attention-panel__controls">
                    <div class="attention-panel__control">
                        <!-- begin .button-->
                         <a class="button button_width_full js-modal" href="#askForm"><span class="button__holder">Ask a question</span></a>
                        <!-- end .button-->
                    </div>
                </div>
            </div>
        </div>
        <!-- end .attention-panel-->
    </div>
</div>