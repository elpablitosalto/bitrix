<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<div class="internal_sections_list internal_sections_list_no_offset">
    <!--<div class="title opened">
        <div class="inner_block"><?/*= GetMessage("CATALOG_TITLE"); */?>
            <span class="hider opened"></span>
        </div>
    </div>-->
    <ul class="sections_list_wrapp">
        <?php
        //echo "<pre>";var_dump($arResult["SECTIONS_TREE"]);echo "</pre>";
        ?>
        <? foreach ($arResult["SECTIONS_TREE"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $bDepth3 = false;

            if ($bParent = count($arItem["SECTIONS"])) {
                foreach ($arItem["SECTIONS"] as $i) {
                    if ($i["SECTIONS"] && is_array($i["SECTIONS"])) {
                        $bDepth3 = true;
                        break;
                    }
                }
            }
            ?>
            <li class="item js-height-parent <?= ($arItem["SELECTED"] ? "cur" : "") ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                data-id="<?= $arItem['ID'] ?>">
                <a href="<?= $arItem["SECTION_PAGE_URL"] ?>"
                   class="<?= ($bParent ? 'parent' : '') ?> js-height-trigger <?= ($arItem["SELECTED"] ? "cur" : "") ?>">
					<svg class="trigger__arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
						<path d="M2 5L8 11L14 5" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>  
				   <span><?= $arItem["NAME"] ?></span></a>
                <? if ($bParent): ?>
                    <div class="child_container js-height-main <?= ($arItem["SELECTED"] ? "cur" : "content-hidden") ?> ">
                        <div class="child_wrapp <?= ($bDepth3 ? "bDepth3 clearfix" : "") ?>">
                            <ul class="child">
                                <? foreach ($arItem["SECTIONS"] as $arSection): ?>

                                    <? if (!empty($arSection["SECTIONS"])): ?>
                                        <li class="bDepth3 js-height-parent">
										
											<a class="menu_title js-height-trigger <?= ($arSection["SELECTED"] ? "cur" : "") ?>"
                                               href="<?= $arSection["SECTION_PAGE_URL"] ?>">  
											   <svg class="trigger__arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
													<path d="M2 5L8 11L14 5" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>  
												<span><?= $arSection["NAME"] ?></span>
											</a>
											<div class="js-height-main  <?= ($arSection["SELECTED"] ? "cur" : "content-hidden") ?>">
												
													<? foreach ($arSection["SECTIONS"] as $arSubItem): ?>
														<?php
														//echo "<pre>";var_dump(count($arSubItem));echo "</pre>";
														?>
														<ul>
															<li class="js-height-parent">
																<a class="menu_item js-height-trigger <?= ($arSubItem["SELECTED"] ? "cur" : "") ?>"
																data-id="<?= $arSubItem['ID'] ?>"
																href="<?= $arSubItem["SECTION_PAGE_URL"] ?>">
																	<? if (!empty($arSubItem["SECTIONS"])): ?>
																		<svg class="trigger__arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
																			<path d="M5 2L11 8L5 14" stroke="#383838" stroke-linecap="round" stroke-linejoin="round"/>
																		</svg>
																	
																	<? else :?>
																		<div class="trigger__dot">
																			<div class="trigger__inner">
																			</div>
																		</div>
																	<? endif; ?>
																		<span><?= $arSubItem["NAME"] ?></span>
																</a>


																	<? if (!empty($arSubItem["SECTIONS"])): ?>
																		<ul class="child4-wrapper js-height-main  <?= ($arSubItem["SELECTED"] ? "cur" : "content-hidden") ?>">
																			<? foreach ($arSubItem["SECTIONS"] as $arSubSection4): ?>
																				<?php
																				//echo "<pre>";var_dump($arSubSection4["NAME"]);echo "</pre>";
																				?>
																				<li class="child4-item">
																					<div class="trigger__dot">
																						<div class="trigger__inner">
																						</div>
																					</div>
																					<a class="menu_item menu_item4 pl-4 <?= ($arSubSection4["SELECTED"] ? "cur" : "") ?>"
																					data-id="<?= $arSubSection4['ID'] ?>"
																					href="<?= $arSubSection4["SECTION_PAGE_URL"] ?>"><?= $arSubSection4["NAME"] ?></a>
																				</li>
																			<? endforeach; ?>
																			</ul>
																	<? endif; ?>
															</li>
														</ul>
													<? endforeach; ?>
													
                                            
											</div>
                                        </li>
                                    <? else: ?>
                                        <li class="menu_item <?= ($arSection["SELECTED"] ? "cur" : "") ?>"
                                            data-id="<?= $arSection['ID'] ?>"><a class="menu__link" href="<?= $arSection["SECTION_PAGE_URL"] ?>"> 
											<div class="trigger__dot">
												<div class="trigger__inner">
												</div>
											</div>
											<span><?= $arSection["NAME"] ?></span></a>
                                        </li>
                                    <? endif; ?>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <? endif; ?>
            </li>
        <? endforeach; ?>
    </ul>
    <? $arSite = CSite::GetByID(SITE_ID)->Fetch(); ?>
</div>
<script>
	$(".js-height-main:not(.cur)").css("height", "0px");

    $(".internal_sections_list").ready(function () {
        $(".internal_sections_list .title .inner_block").click(function () {
            $(this).find('.hider').toggleClass("opened");
            $(this).closest(".internal_sections_list").find(".title").toggleClass('opened');
            $(this).closest(".internal_sections_list").find(".sections_list_wrapp").slideToggle(200);
            $.cookie.json = true;
            $.cookie("MSHOP_internal_sections_list_HIDE", $(this).find('.hider').hasClass("opened"), {
                path: '/',
                domain: '',
                expires: 360
            });
        });

        if ($.cookie("MSHOP_internal_sections_list_HIDE") == 'false') {
            $(".internal_sections_list .title").removeClass("opened");
            $(".internal_sections_list .title .hider").removeClass("opened");
            $(".internal_sections_list .sections_list_wrapp").hide();
        }

        // $('.left_block .internal_sections_list li.item > a.parent').click(function (e) {
        //     e.preventDefault();
        //     $(this).parent().find('.child_container').slideToggle();
        // });
    });
</script>