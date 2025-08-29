<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
use Hair\General;
Loader::includeModule("iblock");

$fileObj = CIBlockElement::GetList(false,['IBLOCK_ID' => MATERIALS,'ID' => $_POST['FILE_ID']])->GetNextElement();

$arFields = $fileObj->GetFields();
$arProps = $fileObj->GetProperties();

$prodArr = CIBlockElement::GetByID($arProps['PRODUCT']['VALUE'][0])->GetNext();

$iconType = $arProps['MATERIAL_FORMAT']['VALUE'];

$arResult['STATUS'] = 'Y';
if(empty($arFields['PREVIEW_PICTURE'])):
    $icon = General::returnIcon($iconType,[32,41]);
    $arResult['MODIFICATOR'] = 'downloads-popup__no-image';
    $arResult['CONTENT'] = '
        <div class="popup_header">  
            <div class="popup_header__icon">          
                '.$icon.'  
            </div>
            <div class="popup_header__title">
                <h3>'.$prodArr['NAME'].'</h3>
                <p>'.$prodArr['PREVIEW_TEXT'].'</p>
            </div>
        </div>
        <div class="popup_content">
            <div class="downloads-description">
                '.$prodArr['DETAIL_TEXT'].'             
                <a class="button _small" download href="'.CFile::GetPath($arProps['FILE']['VALUE']).'">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.37496 16.25H15.625C15.8625 16.2501 16.0911 16.3403 16.2647 16.5025C16.4383 16.6646 16.5438 16.8866 16.56 17.1236C16.5762 17.3606 16.5018 17.5949 16.3519 17.7791C16.202 17.9634 15.9878 18.0839 15.7525 18.1162L15.625 18.125H4.37496C4.13743 18.1249 3.90878 18.0347 3.73522 17.8725C3.56166 17.7104 3.45612 17.4884 3.43993 17.2514C3.42374 17.0144 3.4981 16.7801 3.648 16.5959C3.7979 16.4116 4.01215 16.2911 4.24746 16.2587L4.37496 16.25H15.625H4.37496ZM9.87246 1.25875L9.99996 1.25C10.2265 1.25001 10.4454 1.33205 10.6161 1.48096C10.7869 1.62986 10.8979 1.83556 10.9287 2.06L10.9375 2.1875V11.7975L13.7562 8.98C13.9152 8.82109 14.1259 8.72458 14.3501 8.70806C14.5743 8.69154 14.7969 8.75611 14.9775 8.89L15.0825 8.98C15.2414 9.13897 15.3379 9.34974 15.3544 9.5739C15.3709 9.79807 15.3063 10.0207 15.1725 10.2013L15.0825 10.3062L10.6625 14.725C10.5037 14.8838 10.2933 14.9803 10.0694 14.9971C9.84551 15.0138 9.62305 14.9496 9.44246 14.8162L9.33746 14.725L4.91746 10.3062C4.74972 10.139 4.65152 9.91439 4.64262 9.67766C4.63372 9.44093 4.71477 9.2096 4.86947 9.0302C5.02418 8.85079 5.24107 8.7366 5.47653 8.7106C5.712 8.68459 5.94858 8.74868 6.13871 8.89L6.24371 8.98L9.06246 11.8V2.1875C9.06247 1.96095 9.14451 1.74207 9.29342 1.57134C9.44232 1.4006 9.64802 1.28956 9.87246 1.25875L9.99996 1.25L9.87246 1.25875Z" fill="#F7FAF7"/>
                    </svg>                                                      
                    <span>Скачать</span>
                </a>
            </div>
        </div>
    ';
else:
    $icon = General::returnIcon($iconType);
    $img = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>196, 'height'=>240), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult['CONTENT'] = '
        <div class="popup_header _with-icon">
            <h3>'.$prodArr['NAME'].'</h3>
            <p>'.$prodArr['PREVIEW_TEXT'].'</p>
        </div>
        <div class="popup_content">
            <div class="downloads-item">
                <div class="downloads-item__icon">
                    '.$icon.'                                                
                </div>  
                <div class="downloads-item__image">
                    <img src="'.$img['src'].'" alt="'.$img['ALT'].'" title="'.$img['TITLE'].'">
                </div>
                <p class="downloads-item__title">'.$arFields['NAME'].'</p>
                <p class="downloads-item__subtitle">'.$arFields['PREVIEW_TEXT'].'</p>
            </div>
            <div class="downloads-description">
                '.$arFields['DETAIL_TEXT'].'
                <a class="button _small" download href="'.CFile::GetPath($arProps['FILE']['VALUE']).'">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.37496 16.25H15.625C15.8625 16.2501 16.0911 16.3403 16.2647 16.5025C16.4383 16.6646 16.5438 16.8866 16.56 17.1236C16.5762 17.3606 16.5018 17.5949 16.3519 17.7791C16.202 17.9634 15.9878 18.0839 15.7525 18.1162L15.625 18.125H4.37496C4.13743 18.1249 3.90878 18.0347 3.73522 17.8725C3.56166 17.7104 3.45612 17.4884 3.43993 17.2514C3.42374 17.0144 3.4981 16.7801 3.648 16.5959C3.7979 16.4116 4.01215 16.2911 4.24746 16.2587L4.37496 16.25H15.625H4.37496ZM9.87246 1.25875L9.99996 1.25C10.2265 1.25001 10.4454 1.33205 10.6161 1.48096C10.7869 1.62986 10.8979 1.83556 10.9287 2.06L10.9375 2.1875V11.7975L13.7562 8.98C13.9152 8.82109 14.1259 8.72458 14.3501 8.70806C14.5743 8.69154 14.7969 8.75611 14.9775 8.89L15.0825 8.98C15.2414 9.13897 15.3379 9.34974 15.3544 9.5739C15.3709 9.79807 15.3063 10.0207 15.1725 10.2013L15.0825 10.3062L10.6625 14.725C10.5037 14.8838 10.2933 14.9803 10.0694 14.9971C9.84551 15.0138 9.62305 14.9496 9.44246 14.8162L9.33746 14.725L4.91746 10.3062C4.74972 10.139 4.65152 9.91439 4.64262 9.67766C4.63372 9.44093 4.71477 9.2096 4.86947 9.0302C5.02418 8.85079 5.24107 8.7366 5.47653 8.7106C5.712 8.68459 5.94858 8.74868 6.13871 8.89L6.24371 8.98L9.06246 11.8V2.1875C9.06247 1.96095 9.14451 1.74207 9.29342 1.57134C9.44232 1.4006 9.64802 1.28956 9.87246 1.25875L9.99996 1.25L9.87246 1.25875Z" fill="#F7FAF7"/>
                    </svg>                                                      
                    <span>Скачать</span>
                </a>
            </div>
        </div>
    ';
endif;

echo json_encode($arResult);