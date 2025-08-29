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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

if (0 < $arResult["SECTIONS_COUNT"])
{
    ?>
    <div class="section__header section__header_type_inline section__header_gap_l">
      <div class="section__title">
        <!-- begin .title-->
        <h2 class="title title_size_h2">Газета — блог компании <br> «Нескучные финансы»
        </h2>
        <!-- end .title-->
      </div>
      <div class="section__meta">
        <div class="section__subtitle">Пишем о финансах, грамотном <br> управлении и системном подходе
        </div>
      </div>
    </div>
    <div class="section__content">
      <div class="section__tags section__tags_spacing_top-m">
        <!-- begin .tag-list-->
        <div class="tag-list tag-list_size_s section__tag-list">
          <div class="tag-list__container">
            <button class="tag-list__mobile-trigger js-toggle" type="button" data-toggle-scope=".tag-list" data-toggle-class="tag-list_state_open">Открыть список
            </button>
            <div class="tag-list__tags">
              <a href='/gazeta' class="tag-list__tag <?php echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/gazeta/' ? 'tag-list__tag_state_active' : '' ?>">Все статьи</a>
              <?php
                foreach ($arResult['SECTIONS'] as $arSection) {
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

                    // Determine the URL for the section
                    $url = $arSection['CODE'] === 'top' ? '/gazeta/best-top/' : $arSection['SECTION_PAGE_URL'];

                    // Get the current URL of the page
                    $currentUrl = $_SERVER['REQUEST_URI'];

                    // Check if the section URL is contained in the current URL
                    $isActive = strpos($currentUrl, $url) !== false;

                    // Determine the class to add
                    $activeClass = $isActive ? ' tag-list__tag_state_active' : '';
                    ?>
                    <a href="<?= htmlspecialchars($url) ?>" class="tag-list__tag<?= $activeClass ?>"><?= htmlspecialchars_decode($arSection['NAME']) ?></a>
                <?php
                }
                ?>


            </div>
            <button class="tag-list__close js-toggle" type="button" data-toggle-scope=".tag-list" data-toggle-class="tag-list_state_open">
              <div class="tag-list__icon">Закрыть список
              </div>
            </button>
          </div>
        </div>
        <!-- end .tag-list-->
      </div>
    <?
}