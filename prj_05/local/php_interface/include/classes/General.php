<?

namespace Hair;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Hair\HL;
use Hair\Geo;
use \Bitrix\Main\Loader;

Loader::includeModule("iblock");

class General
{
    const YOUTUBE_APIKEY = 'AIzaSyBcT04XVuM_MfZmS5XNQOLZNFqqePYo62k';

    public static function getProductPropertycon($code)
    {
        switch ($code) {
            case 'PRODUCT_TYPE':
                return MOCKUP . '/images/descriptionIcons/shampoo_1.svg';
                break;
            case 'PRODUCT_PROPS':
                return MOCKUP . '/images/descriptionIcons/tick-inside-circle_1.svg';
                break;
            case 'PRODUCT_UNIQUE':
                return MOCKUP . '/images/descriptionIcons/vegan-1.svg';
                break;
            case 'PRODUCT_COMPOSITION':
                return MOCKUP . '/images/descriptionIcons/flask_1.svg';
                break;
            case 'PRODUCT_FEATURE':
                return MOCKUP . '/images/descriptionIcons/favourites-filled-star-symbol_1.svg';
                break;
        }
    }

    public static function formatPhone($phone)
    {
        return '+' . preg_replace("/[^0-9]/", '', $phone);
    }

    public static function getGeoPhone()
    {
        $phone = self::GetStaticInfo('main_phone');

        if (!empty($_COOKIE['GEO_POSITION'])):
            $arCity = unserialize($_COOKIE['GEO_POSITION']);
            $city = $arCity->cityName;
            $region = $arCity->regionName;
        else:
            $city = 'Ростов-на-Дону';
            $region = 'Ростовская область';
        endif;

        $regionsVoc = [];
        $obj = \CIBlockSection::GetList(false, ['IBLOCK_ID' => SALONS, 'DEPTH_LEVEL' => 2], false, ['ID', 'NAME']);
        while ($res = $obj->GetNext())
            $regionsVoc[$res['NAME']] = $res['ID'];

        $arFilter = [
            "ACTIVE"              => "Y",
            "UF_REGION"           => $regionsVoc[$city],
            "GROUPS_ID"           => DISTRIBUTOR
        ];

        $rsUsers = \CUser::GetList(($by = "name"), ($order = "asc"), $arFilter); // выбираем пользователей по городу
        if ($rsUsers->SelectedRowsCount() > 0) {
            $arUser = $rsUsers->GetNext();

            if (!empty($arUser['WORK_PHONE']))
                $phone = $arUser['WORK_PHONE'];
            else
                $phone = $arUser['PERSONAL_PHONE'];
        } else {
            $arFilter = [
                "ACTIVE"              => "Y",
                "UF_REGION"           => $regionsVoc[$region],
                "GROUPS_ID"           => DISTRIBUTOR
            ];
            $rsUsers = \CUser::GetList(($by = "name"), ($order = "asc"), $arFilter); // выбираем пользователей по региону
            if ($rsUsers->SelectedRowsCount() > 0) {
                $arUser = $rsUsers->GetNext();
                if (!empty($arUser['WORK_PHONE']))
                    $phone = $arUser['WORK_PHONE'];
                else
                    $phone = $arUser['PERSONAL_PHONE'];
            }
        }

        return $phone;
    }

    public static function getCities()
    {
        $arFilter = array('IBLOCK_ID' => SALONS, 'DEPTH_LEVEL' => 2);
        $db_list = \CIBlockSection::GetList(['sort' => 'desc'], $arFilter, true, ['nPageSize' => 10]);
        $cities = [];
        while ($ar_result = $db_list->GetNext()) {
            $cities[] = $ar_result['NAME'];
        }

        return $cities;
    }

    public static function isBot()
    {

        if (!isset($_SERVER["HTTP_USER_AGENT"])) {

            $_SERVER["HTTP_USER_AGENT"] = "";
        }

        $bots = array(
            "Google",
            "Yandex",
            "Baiduspider",
            "Lycos",
            "Genieo",
            "Slurp",
            "WebAlta",
            "facebook",
            "Mail.Ru",
            "ia_archiver",
            "Teoma",
            "Yahoo",
            "Ask",
            "Rambler",
            "crawler4j",
            "MJ12",
            "Seznam",
            "Bot",
            "cURL",
            "DuckDuckGo",
            "AOL",
            "Lighthouse"
        );

        foreach ($bots as $bot) {

            if (stripos($_SERVER["HTTP_USER_AGENT"], $bot) !== false) {

                $botname = $bot; // Если это бот - его идентификатор

                return true;
            }
        }

        return false;
    }

    public static function GetStaticInfo($code)
    {
        $obj = \CIBlockElement::GetList(false, ['IBLOCK_ID' => STATIC_IBLOCK, 'CODE' => $code], false, false, ['ID', 'NAME', 'PROPERTY_VALUE']);
        if ($res = $obj->GetNext()) {
            return $res['PROPERTY_VALUE_VALUE'];
        }

        return false;
    }

    public static function ParseShortYouTubeLink($url)
    {
        if (strpos($url, 'youtu.be/') !== false):
            $arr = explode('youtu.be/', $url);
            return 'https://www.youtube.com/embed/' . $arr[1];
        else:
            return $url;
        endif;
    }

    public static function GetYouTubeVideoDuration($url)
    {
        $arr = explode('/embed/', $url);
        $vId = $arr[1];
        $data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=" . $vId . "&key=" . self::YOUTUBE_APIKEY);
        if (false === $data) return false;

        $obj = json_decode($data);
        $ytbTime = $obj->items[0]->contentDetails->duration;
        $interval = new \DateInterval($ytbTime);
        $duration = $interval->h * 3600 + $interval->i * 60 + $interval->s;

        return $duration * 1000;
    }

    public static function getSocialCode($str)
    {
        $strArr = parse_url($str);
        $socName = explode('.', $strArr['host']);
        $code = ($socName[0] == 'www') ? $socName[1] : $socName[0];

        return $code;
    }

    public static function getSocials()
    {
        $hl = new HL();
        $socials = $hl->getList(SOCIALS);

        return $socials;
    }

    public static function getSocialIcon($code)
    {
        $icon = '';
        switch ($code) {
            case 'Facebook':
                $icon = '
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 12C24 5.37188 18.6281 0 12 0C5.37188 0 0 5.37188 0 12C0 18.6281 5.37188 24 12 24C12.0703 24 12.1406 24 12.2109 23.9953V14.6578H9.63281V11.6531H12.2109V9.44062C12.2109 6.87656 13.7766 5.47969 16.0641 5.47969C17.1609 5.47969 18.1031 5.55938 18.375 5.59688V8.27813H16.8C15.5578 8.27813 15.3141 8.86875 15.3141 9.73594V11.6484H18.2906L17.9016 14.6531H15.3141V23.5359C20.3297 22.0969 24 17.4797 24 12Z" fill="#3333CC"/>
                    </svg>
                ';
                break;
            case 'VKontakte':
                $icon = '
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 0C5.37281 0 0 5.37256 0 12C0 18.6274 5.37281 24 12 24C18.6272 24 24 18.6274 24 12C24 5.37256 18.6272 0 12 0ZM18.087 13.2978C18.6463 13.8441 19.2381 14.3583 19.7402 14.961C19.9626 15.2277 20.1723 15.5034 20.3319 15.8135C20.5597 16.2557 20.354 16.7406 19.9582 16.7669L17.4997 16.7664C16.8648 16.8189 16.3595 16.5628 15.9335 16.1287C15.5935 15.7828 15.278 15.4133 14.9505 15.0556C14.8167 14.9087 14.6757 14.7705 14.5078 14.6617C14.1726 14.4437 13.8815 14.5105 13.6895 14.8606C13.4938 15.2169 13.4491 15.6117 13.4304 16.0082C13.4037 16.5879 13.2288 16.7394 12.6472 16.7666C11.4044 16.8248 10.2251 16.6362 9.12908 16.0097C8.16221 15.457 7.41385 14.677 6.76174 13.7938C5.49189 12.0722 4.51937 10.1826 3.64554 8.23881C3.44888 7.80104 3.59276 7.56681 4.0757 7.55773C4.87808 7.54226 5.68045 7.54423 6.48282 7.55699C6.80937 7.56215 7.02543 7.74899 7.1509 8.05713C7.58449 9.12393 8.11605 10.1389 8.78216 11.0803C8.95967 11.3309 9.14087 11.5809 9.39892 11.7579C9.68372 11.9534 9.90077 11.8888 10.0351 11.5708C10.121 11.3688 10.1581 11.1527 10.1767 10.9361C10.2406 10.1944 10.2482 9.45293 10.1377 8.71415C10.069 8.25183 9.80894 7.95327 9.34809 7.86586C9.11337 7.82142 9.14774 7.73451 9.26191 7.60045C9.46005 7.36868 9.64567 7.22529 10.0167 7.22529L12.7943 7.2248C13.232 7.31073 13.3303 7.50715 13.3897 7.94811L13.3921 11.0348C13.387 11.2055 13.4778 11.7113 13.7842 11.823C14.0297 11.904 14.1918 11.7071 14.3386 11.5517C15.0047 10.8448 15.4793 10.0105 15.9043 9.14701C16.0919 8.7662 16.2537 8.37213 16.4108 7.97733C16.5277 7.6854 16.7094 7.54177 17.0389 7.54668L19.7136 7.54987C19.7924 7.54987 19.8725 7.55061 19.9506 7.56411C20.4014 7.64121 20.5248 7.83517 20.3854 8.27491C20.1659 8.96581 19.7394 9.54132 19.3225 10.1183C18.8757 10.736 18.3991 11.3322 17.9567 11.9526C17.5501 12.5198 17.5822 12.8053 18.087 13.2978Z" fill="#3333CC"/>
                    </svg>                
                ';
                break;
            case 'Odnoklassniki':
                $icon = '
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="24px" height="24px" viewBox="0 0 97.75 97.75" style="enable-background:new 0 0 97.75 97.75;" xml:space="preserve"
	>
<g>
	<g>
		<path d="M48.921,40.507c4.667-0.017,8.384-3.766,8.367-8.443c-0.017-4.679-3.742-8.402-8.411-8.406
			c-4.708-0.005-8.468,3.787-8.432,8.508C40.48,36.826,44.239,40.524,48.921,40.507z" fill="#3333CC"/>
		<path d="M48.875,0C21.882,0,0,21.883,0,48.875S21.882,97.75,48.875,97.75S97.75,75.867,97.75,48.875S75.868,0,48.875,0z
			 M48.945,14.863c9.52,0.026,17.161,7.813,17.112,17.438c-0.048,9.403-7.814,17.024-17.318,16.992
			c-9.407-0.032-17.122-7.831-17.066-17.253C31.726,22.515,39.445,14.837,48.945,14.863z M68.227,56.057
			c-2.105,2.161-4.639,3.725-7.453,4.816c-2.66,1.031-5.575,1.55-8.461,1.896c0.437,0.474,0.642,0.707,0.914,0.979
			c3.916,3.937,7.851,7.854,11.754,11.802c1.33,1.346,1.607,3.014,0.875,4.577c-0.799,1.71-2.592,2.834-4.351,2.713
			c-1.114-0.077-1.983-0.63-2.754-1.407c-2.956-2.974-5.968-5.895-8.862-8.925c-0.845-0.882-1.249-0.714-1.994,0.052
			c-2.973,3.062-5.995,6.075-9.034,9.072c-1.365,1.346-2.989,1.59-4.573,0.82c-1.683-0.814-2.753-2.533-2.671-4.262
			c0.058-1.166,0.632-2.06,1.434-2.858c3.877-3.869,7.742-7.75,11.608-11.628c0.257-0.257,0.495-0.53,0.868-0.93
			c-5.273-0.551-10.028-1.849-14.099-5.032c-0.506-0.396-1.027-0.778-1.487-1.222c-1.783-1.711-1.962-3.672-0.553-5.69
			c1.207-1.728,3.231-2.19,5.336-1.197c0.408,0.191,0.796,0.433,1.168,0.689c7.586,5.213,18.008,5.356,25.624,0.233
			c0.754-0.576,1.561-1.05,2.496-1.289c1.816-0.468,3.512,0.201,4.486,1.791C69.613,52.874,69.6,54.646,68.227,56.057z" fill="#3333CC"/>
	</g>
</g>
</svg>
                ';
                break;
            case 'GoogleOAuth':
                $icon = '
                    <svg enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" fill="none" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m12 24c6.624 0 12-5.376 12-12s-5.376-12-12-12-12 5.376-12 12 5.376 12 12 12zm4.283-12.857h1.718v-1.717h1.718v1.718h1.703v1.718h-1.703v1.718h-1.718v-1.718h-1.718zm-3.687-3.581-1.626 1.578c-2.08-2.033-6.127-.552-6.127 2.855 0 4.621 6.559 4.937 7.128 1.2h-3.392v-2.061h5.657c.642 3.356-1.525 6.866-5.657 6.866v.001c-3.329 0-6.001-2.686-6.001-6.001.001-5.338 6.333-7.861 10.018-4.438z" fill="#3333CC"/></svg>
                ';
                break;
            case 'YandexOAuth':
                $icon = '
                    <svg version="1.1" id="Yandex_Logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
	 y="0px" viewBox="0 0 1080 1080" style="enable-background:new 0 0 1080 1080;" xml:space="preserve" width="24px" height="24px">
<circle class="st0" cx="540" cy="540" r="538.9" />
<path id="Glyph" class="st1" d="M735,878.3H616.7V293.2H564c-96.6,0-147.2,48.3-147.2,120.4c0,81.8,34.9,119.7,107.1,168l59.5,40.1
	l-171,256.5H285.2l153.9-229c-88.5-63.2-138.3-124.9-138.3-229c0-130.1,90.7-218.6,262.4-218.6h171v676.5H735z" />
</svg>
                ';
                break;
        }

        return $icon;
    }

    public static function returnIcon($type, $size = [27, 30])
    {
        switch ($type) {
            case 'pdf':
                $out = '
                    <svg width="' . $size[0] . '" height="' . $size[1] . '" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1.10714C0 0.495684 0.495685 0 1.10714 0H19.0909L21.8182 2.94643L24 5.08929V28.8929C24 29.5043 23.5043 30 22.8929 30H1.10714C0.495685 30 0 29.5043 0 28.8929V1.10714Z" fill="#CA0000"/>
                        <g opacity="0.2" filter="url(#filter0_d)">
                        <path d="M19.0909 0L21.8181 2.94643L23.9999 5.08929C23.9999 5.08929 19.5 5.625 19.0909 5.08929C18.6817 4.55357 19.0909 0 19.0909 0Z" fill="white"/>
                        </g>
                        <path d="M9.69238 16.3465C9.69238 17.0673 9.52804 17.6454 9.19936 18.0807C8.87356 18.5132 8.43243 18.7294 7.87598 18.7294C7.40313 18.7294 7.02111 18.5651 6.72991 18.2364V20.4421H5.48005V13.9635H6.63909L6.68234 14.422C6.98507 14.0587 7.38007 13.877 7.86733 13.877C8.44396 13.877 8.8923 14.0904 9.21233 14.5171C9.53237 14.9438 9.69238 15.532 9.69238 16.2816V16.3465ZM8.44252 16.2557C8.44252 15.8203 8.36468 15.4844 8.20898 15.248C8.05618 15.0116 7.83273 14.8934 7.53864 14.8934C7.14653 14.8934 6.87695 15.0433 6.72991 15.3431V17.259C6.88272 17.5675 7.15518 17.7218 7.54729 17.7218C8.14411 17.7218 8.44252 17.2331 8.44252 16.2557ZM10.2762 16.2686C10.2762 15.5392 10.4391 14.9582 10.7649 14.5258C11.0936 14.0933 11.5419 13.877 12.1099 13.877C12.5655 13.877 12.9417 14.0471 13.2387 14.3874V12.0001H14.4929V18.6429H13.3641L13.3036 18.1456C12.9922 18.5348 12.5914 18.7294 12.1013 18.7294C11.5506 18.7294 11.108 18.5132 10.7736 18.0807C10.442 17.6454 10.2762 17.0413 10.2762 16.2686ZM11.5261 16.3595C11.5261 16.7977 11.6025 17.1336 11.7553 17.3671C11.9081 17.6007 12.1301 17.7174 12.4213 17.7174C12.8077 17.7174 13.0801 17.5545 13.2387 17.2287V15.3821C13.083 15.0563 12.8134 14.8934 12.43 14.8934C11.8274 14.8934 11.5261 15.3821 11.5261 16.3595ZM15.8033 18.6429V14.8804H15.107V13.9635H15.8033V13.5657C15.8033 13.0409 15.9532 12.6344 16.2531 12.3461C16.5558 12.0549 16.9782 11.9093 17.5202 11.9093C17.6932 11.9093 17.9051 11.9381 18.156 11.9958L18.143 12.9645C18.0392 12.9386 17.9123 12.9256 17.7624 12.9256C17.2925 12.9256 17.0575 13.1462 17.0575 13.5873V13.9635H17.9873V14.8804H17.0575V18.6429H15.8033Z" fill="white"/>
                        <defs>
                        <filter id="filter0_d" x="16.6948" y="0" width="9.51944" height="9.75595" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="2.21429"/>
                        <feGaussianBlur stdDeviation="1.10714"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                        </filter>
                        </defs>
                    </svg>
                ';
                break;
            case 'видео':
                $out = '
                    <svg width="27" height="30" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1.09091C0 0.488417 0.488417 0 1.09091 0H19.0909L21.8182 2.94643L24 5.08929V28.9091C24 29.5116 23.5116 30 22.9091 30H1.09091C0.488417 30 0 29.5116 0 28.9091V1.09091Z" fill="#EA2626"/>
                        <g opacity="0.2" filter="url(#filter0_d)">
                        <path d="M19.091 0L21.8182 2.94643L24 5.08929C24 5.08929 19.5002 5.625 19.091 5.08929C18.6819 4.55357 19.091 0 19.091 0Z" fill="white"/>
                        </g>
                        <path d="M10.2344 17.5312C9.9304 17.9006 9.50994 18.0852 8.97301 18.0852C8.47869 18.0852 8.10085 17.9432 7.83949 17.6591C7.58097 17.375 7.44886 16.9588 7.44318 16.4105V13.3892H8.67472V16.3679C8.67472 16.848 8.89347 17.0881 9.33097 17.0881C9.74858 17.0881 10.0355 16.9432 10.1918 16.6534V13.3892H11.4276V18H10.2685L10.2344 17.5312ZM14.9474 14.544C14.7798 14.5213 14.6321 14.5099 14.5043 14.5099C14.0384 14.5099 13.733 14.6676 13.5881 14.983V18H12.3565V13.3892H13.5199L13.554 13.9389C13.8011 13.5156 14.1435 13.304 14.581 13.304C14.7173 13.304 14.8452 13.3224 14.9645 13.3594L14.9474 14.544ZM16.8438 18H15.608V11.4545H16.8438V18Z" fill="white"/>
                        <defs>
                        <filter id="filter0_d" x="16.7274" y="0" width="9.4545" height="9.69102" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="2.18182"/>
                        <feGaussianBlur stdDeviation="1.09091"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                        </filter>
                        </defs>
                    </svg>                
                ';
                break;
            case 'png':
                $out = '
                    <svg width="27" height="30" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1.09091C0 0.488417 0.488417 0 1.09091 0H19.0909L21.8182 2.94643L24 5.08929V28.9091C24 29.5116 23.5116 30 22.9091 30H1.09091C0.488417 30 0 29.5116 0 28.9091V1.09091Z" fill="#EF7708"/>
                        <g opacity="0.2" filter="url(#filter0_d)">
                        <path d="M19.0909 0L21.8181 2.94643L23.9999 5.08929C23.9999 5.08929 19.5 5.625 19.0909 5.08929C18.6817 4.55357 19.0909 0 19.0909 0Z" fill="white"/>
                        </g>
                        <path d="M8.62358 15.7372C8.62358 16.4474 8.46165 17.017 8.13778 17.446C7.81676 17.8722 7.3821 18.0852 6.83381 18.0852C6.3679 18.0852 5.99148 17.9233 5.70455 17.5994V19.7727H4.47301V13.3892H5.61506L5.65767 13.8409C5.95597 13.483 6.34517 13.304 6.82528 13.304C7.39347 13.304 7.83523 13.5142 8.15057 13.9347C8.46591 14.3551 8.62358 14.9347 8.62358 15.6733V15.7372ZM7.39205 15.6477C7.39205 15.2187 7.31534 14.8878 7.16193 14.6548C7.01136 14.4219 6.79119 14.3054 6.50142 14.3054C6.11506 14.3054 5.84943 14.4531 5.70455 14.7486V16.6364C5.85511 16.9403 6.12358 17.0923 6.50994 17.0923C7.09801 17.0923 7.39205 16.6108 7.39205 15.6477ZM10.5241 13.3892L10.5625 13.9219C10.892 13.5099 11.3338 13.304 11.8878 13.304C12.3764 13.304 12.7401 13.4474 12.9787 13.7344C13.2173 14.0213 13.3395 14.4503 13.3452 15.0213V18H12.1136V15.0511C12.1136 14.7898 12.0568 14.6009 11.9432 14.4844C11.8295 14.3651 11.6406 14.3054 11.3764 14.3054C11.0298 14.3054 10.7699 14.4531 10.5966 14.7486V18H9.36506V13.3892H10.5241ZM14.1037 15.6605C14.1037 14.9531 14.2713 14.3835 14.6065 13.9517C14.9446 13.5199 15.3991 13.304 15.9702 13.304C16.4759 13.304 16.8693 13.4773 17.1506 13.8239L17.2017 13.3892H18.3182V17.8466C18.3182 18.25 18.2259 18.6009 18.0412 18.8991C17.8594 19.1974 17.6023 19.4247 17.2699 19.581C16.9375 19.7372 16.5483 19.8153 16.1023 19.8153C15.7642 19.8153 15.4347 19.7472 15.1136 19.6108C14.7926 19.4773 14.5497 19.304 14.3849 19.0909L14.9304 18.3409C15.2372 18.6847 15.6094 18.8565 16.0469 18.8565C16.3736 18.8565 16.6278 18.7685 16.8097 18.5923C16.9915 18.419 17.0824 18.1719 17.0824 17.8509V17.6037C16.7983 17.9247 16.4247 18.0852 15.9616 18.0852C15.4077 18.0852 14.9588 17.8693 14.6151 17.4375C14.2741 17.0028 14.1037 16.4276 14.1037 15.7116V15.6605ZM15.3352 15.75C15.3352 16.1676 15.419 16.4957 15.5866 16.7344C15.7543 16.9702 15.9844 17.0881 16.277 17.0881C16.652 17.0881 16.9205 16.9474 17.0824 16.6662V14.7273C16.9176 14.446 16.652 14.3054 16.2855 14.3054C15.9901 14.3054 15.7571 14.4261 15.5866 14.6676C15.419 14.9091 15.3352 15.2699 15.3352 15.75Z" fill="white"/>
                        <defs>
                        <filter id="filter0_d" x="16.7272" y="0" width="9.4545" height="9.69102" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="2.18182"/>
                        <feGaussianBlur stdDeviation="1.09091"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                        </filter>
                        </defs>
                    </svg>                              
                ';
                break;
            case 'doc':
                $out = '
                    <svg width="27" height="30" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1.10714C0 0.495684 0.495685 0 1.10714 0H19.0909L21.8182 2.94643L24 5.08929V28.8929C24 29.5043 23.5043 30 22.8929 30H1.10714C0.495685 30 0 29.5043 0 28.8929V1.10714Z" fill="#3333CC"/>
                        <g opacity="0.2" filter="url(#filter0_d)">
                        <path d="M19.0909 0L21.8181 2.94643L23.9999 5.08929C23.9999 5.08929 19.5 5.625 19.0909 5.08929C18.6817 4.55357 19.0909 0 19.0909 0Z" fill="white"/>
                        </g>
                        <path d="M5.28544 16.6257C5.28544 15.8963 5.44834 15.3153 5.77414 14.8828C6.10282 14.4503 6.55115 14.2341 7.11914 14.2341C7.57468 14.2341 7.95094 14.4042 8.24791 14.7444V12.3571H9.50209V19H8.37333L8.31278 18.5027C8.0014 18.8919 7.60063 19.0865 7.11049 19.0865C6.5598 19.0865 6.11723 18.8703 5.78278 18.4378C5.45122 18.0024 5.28544 17.3984 5.28544 16.6257ZM6.5353 16.7165C6.5353 17.1548 6.6117 17.4907 6.76451 17.7242C6.91732 17.9577 7.13932 18.0745 7.43052 18.0745C7.81687 18.0745 8.08933 17.9116 8.24791 17.5858V15.7391C8.09222 15.4133 7.82264 15.2504 7.43917 15.2504C6.83659 15.2504 6.5353 15.7391 6.5353 16.7165ZM10.2762 16.617C10.2762 16.1529 10.3656 15.7391 10.5444 15.3758C10.7231 15.0126 10.9797 14.7314 11.3142 14.5325C11.6515 14.3336 12.0422 14.2341 12.4862 14.2341C13.1176 14.2341 13.6323 14.4273 14.0301 14.8136C14.4309 15.2 14.6543 15.7247 14.7005 16.3878L14.7091 16.7079C14.7091 17.4258 14.5087 18.0024 14.108 18.4378C13.7072 18.8703 13.1695 19.0865 12.4948 19.0865C11.8202 19.0865 11.281 18.8703 10.8774 18.4378C10.4766 18.0053 10.2762 17.4171 10.2762 16.6733V16.617ZM11.5261 16.7079C11.5261 17.1519 11.6097 17.4921 11.7769 17.7285C11.9442 17.9621 12.1835 18.0788 12.4948 18.0788C12.7976 18.0788 13.034 17.9635 13.2041 17.7328C13.3742 17.4993 13.4593 17.1274 13.4593 16.617C13.4593 16.1817 13.3742 15.8444 13.2041 15.6051C13.034 15.3657 12.7947 15.2461 12.4862 15.2461C12.1806 15.2461 11.9442 15.3657 11.7769 15.6051C11.6097 15.8415 11.5261 16.2091 11.5261 16.7079ZM17.4251 18.0788C17.6557 18.0788 17.8431 18.0154 17.9873 17.8885C18.1315 17.7617 18.2064 17.593 18.2122 17.3825H19.3842C19.3813 17.6997 19.2948 17.9909 19.1247 18.2561C18.9546 18.5185 18.7211 18.7232 18.4241 18.8703C18.13 19.0144 17.8042 19.0865 17.4467 19.0865C16.7778 19.0865 16.2502 18.8746 15.8638 18.4508C15.4775 18.024 15.2843 17.4359 15.2843 16.6862V16.6041C15.2843 15.8833 15.4761 15.3081 15.8595 14.8785C16.243 14.4489 16.7692 14.2341 17.4381 14.2341C18.0233 14.2341 18.4919 14.4013 18.8436 14.7358C19.1982 15.0673 19.3784 15.5099 19.3842 16.0635H18.2122C18.2064 15.8213 18.1315 15.6252 17.9873 15.4753C17.8431 15.3225 17.6529 15.2461 17.4164 15.2461C17.1252 15.2461 16.9047 15.3528 16.7547 15.5661C16.6077 15.7766 16.5342 16.1197 16.5342 16.5954V16.7252C16.5342 17.2067 16.6077 17.5526 16.7547 17.7631C16.9018 17.9736 17.1252 18.0788 17.4251 18.0788Z" fill="white"/>
                        <defs>
                        <filter id="filter0_d" x="16.6948" y="0" width="9.51944" height="9.75595" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="2.21429"/>
                        <feGaussianBlur stdDeviation="1.10714"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                        </filter>
                        </defs>
                    </svg>                                      
                ';
                break;
            case 'jpg':
                $out = '
                    <svg width="27" height="30" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1.10714C0 0.495684 0.495685 0 1.10714 0H19.0909L21.8182 2.94643L24 5.08929V28.8929C24 29.5043 23.5043 30 22.8929 30H1.10714C0.495685 30 0 29.5043 0 28.8929V1.10714Z" fill="#EFAE08"/>
                        <g opacity="0.2" filter="url(#filter0_d)">
                        <path d="M19.0909 0L21.8181 2.94643L23.9999 5.08929C23.9999 5.08929 19.5 5.625 19.0909 5.08929C18.6817 4.55357 19.0909 0 19.0909 0Z" fill="white"/>
                        </g>
                        <path d="M7.80343 14.3206V19.2552C7.80343 19.7713 7.66648 20.172 7.39258 20.4574C7.11868 20.7458 6.72368 20.8899 6.20759 20.8899C5.99135 20.8899 5.7852 20.8654 5.58915 20.8164V19.826C5.73907 19.852 5.87026 19.865 5.9827 19.865C6.3604 19.865 6.54925 19.6646 6.54925 19.2638V14.3206H7.80343ZM6.44978 13.1097C6.44978 12.9222 6.51177 12.768 6.63574 12.6469C6.7626 12.5258 6.93415 12.4653 7.15039 12.4653C7.36663 12.4653 7.53674 12.5258 7.66071 12.6469C7.78757 12.768 7.851 12.9222 7.851 13.1097C7.851 13.2999 7.78613 13.4556 7.65639 13.5767C7.52953 13.6978 7.36086 13.7584 7.15039 13.7584C6.93992 13.7584 6.76981 13.6978 6.64007 13.5767C6.51321 13.4556 6.44978 13.2999 6.44978 13.1097ZM12.9932 16.7035C12.9932 17.4243 12.8288 18.0024 12.5001 18.4378C12.1743 18.8703 11.7332 19.0865 11.1768 19.0865C10.7039 19.0865 10.3219 18.9222 10.0307 18.5935V20.7991H8.78083V14.3206H9.93987L9.98312 14.779C10.2859 14.4157 10.6809 14.2341 11.1681 14.2341C11.7447 14.2341 12.1931 14.4475 12.5131 14.8742C12.8331 15.3009 12.9932 15.889 12.9932 16.6387V16.7035ZM11.7433 16.6127C11.7433 16.1774 11.6655 15.8415 11.5098 15.6051C11.357 15.3686 11.1335 15.2504 10.8394 15.2504C10.4473 15.2504 10.1777 15.4003 10.0307 15.7002V17.6161C10.1835 17.9246 10.456 18.0788 10.8481 18.0788C11.4449 18.0788 11.7433 17.5901 11.7433 16.6127ZM13.59 16.6257C13.59 15.9078 13.7601 15.3297 14.1003 14.8915C14.4434 14.4532 14.9047 14.2341 15.4842 14.2341C15.9974 14.2341 16.3968 14.41 16.6822 14.7617L16.7341 14.3206H17.8672V18.8443C17.8672 19.2537 17.7735 19.6098 17.5861 19.9125C17.4016 20.2153 17.1406 20.4459 16.8033 20.6045C16.466 20.7631 16.071 20.8424 15.6183 20.8424C15.2752 20.8424 14.9408 20.7732 14.615 20.6348C14.2892 20.4993 14.0426 20.3234 13.8754 20.1071L14.429 19.346C14.7404 19.6948 15.1181 19.8693 15.5621 19.8693C15.8936 19.8693 16.1517 19.7799 16.3362 19.6011C16.5207 19.4253 16.613 19.1744 16.613 18.8486V18.5978C16.3247 18.9236 15.9455 19.0865 15.4756 19.0865C14.9134 19.0865 14.4578 18.8674 14.109 18.4291C13.763 17.988 13.59 17.4042 13.59 16.6776V16.6257ZM14.8398 16.7165C14.8398 17.1403 14.9249 17.4734 15.095 17.7155C15.2651 17.9548 15.4987 18.0745 15.7956 18.0745C16.1762 18.0745 16.4487 17.9318 16.613 17.6463V15.6786C16.4458 15.3931 16.1762 15.2504 15.8043 15.2504C15.5044 15.2504 15.268 15.373 15.095 15.618C14.9249 15.8631 14.8398 16.2293 14.8398 16.7165Z" fill="white"/>
                        <defs>
                        <filter id="filter0_d" x="16.6948" y="0" width="9.51944" height="9.75595" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="2.21429"/>
                        <feGaussianBlur stdDeviation="1.10714"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                        </filter>
                        </defs>
                    </svg>                                           
                ';
                break;
            case 'zip':
                $out = '
                    <svg width="27" height="30" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1.07143C0 0.479694 0.479695 0 1.07143 0H19L21.8182 2.94643L24 5V28.9286C24 29.5203 23.5203 30 22.9286 30H1.07143C0.479695 30 0 29.5203 0 28.9286V1.07143Z" fill="#19690C"/>
                        <g opacity="0.2" filter="url(#filter0_d)">
                        <path d="M19 0L21.909 2.94643L24 5C24 5 19.591 5.625 19.1818 5.08929C18.7727 4.55357 19 0 19 0Z" fill="white"/>
                        </g>
                        <path d="M7.85407 16.6677H10.0681V17.6428H6.30971V16.9062L8.44001 14.0937H6.37249V13.1144H10.0011V13.83L7.85407 16.6677ZM12.1021 17.6428H10.8884V13.1144H12.1021V17.6428ZM10.8172 11.9425C10.8172 11.7611 10.8772 11.6119 10.9972 11.4947C11.12 11.3775 11.286 11.3189 11.4953 11.3189C11.7017 11.3189 11.8664 11.3775 11.9891 11.4947C12.1119 11.6119 12.1733 11.7611 12.1733 11.9425C12.1733 12.1266 12.1105 12.2773 11.9849 12.3945C11.8622 12.5117 11.6989 12.5703 11.4953 12.5703C11.2916 12.5703 11.127 12.5117 11.0014 12.3945C10.8786 12.2773 10.8172 12.1266 10.8172 11.9425ZM17.1789 15.4204C17.1789 16.118 17.0198 16.6774 16.7017 17.0987C16.3864 17.5173 15.9595 17.7265 15.421 17.7265C14.9634 17.7265 14.5937 17.5675 14.3119 17.2494V19.3839H13.1024V13.1144H14.2241L14.2659 13.558C14.5589 13.2064 14.9411 13.0307 15.4127 13.0307C15.9707 13.0307 16.4046 13.2371 16.7143 13.6501C17.024 14.063 17.1789 14.6322 17.1789 15.3577V15.4204ZM15.9693 15.3326C15.9693 14.9112 15.894 14.5862 15.7433 14.3574C15.5954 14.1286 15.3792 14.0142 15.0946 14.0142C14.7151 14.0142 14.4542 14.1593 14.3119 14.4495V16.3035C14.4598 16.6021 14.7235 16.7514 15.103 16.7514C15.6805 16.7514 15.9693 16.2784 15.9693 15.3326Z" fill="white"/>
                        <defs>
                        <filter id="filter0_d" x="16.7942" y="0" width="9.3487" height="9.59196" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                        <feOffset dy="2.14286"/>
                        <feGaussianBlur stdDeviation="1.07143"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                        </filter>
                        </defs>
                    </svg>                                            
                ';
                break;
        }

        return $out;
    }

    public static function csvToArray($file)
    {
        $rows = array();
        $headers = array();
        if (file_exists($file) && is_readable($file)) {
            $handle = fopen($file, 'r');
            while (!feof($handle)) {
                $row = fgetcsv($handle, 10240, ',', '"');
                if (empty($headers))
                    $headers = $row;
                else if (is_array($row)) {
                    array_splice($row, count($headers));
                    $rows[] = array_combine($headers, $row);
                }
            }
            fclose($handle);
        } else {
            throw new Exception($file . ' doesn`t exist or is not readable.');
        }
        return $rows;
    }

    /**
     * Поиск вариантов товара Infinity по его ID и заполненному полю с вариантами (коду этого поля).
     * @param int $productId
     * @param string $propertyCode
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function infinityGetProductVariantsEn(int $productId, string $propertyCode): array
    {
        $arResult = [
            "PRODUCT_VARIANTS" => [],
            "PROPERTY_VALUES" => [],
            "PROPERTY_NAME" => "",
            "PROPERTY_CODE" => ""
        ];
        if (Loader::includeModule("iblock") && Loader::includeModule("highloadblock")) {
            // Ищем нужное поле
            $rsPropInfo = \Bitrix\Iblock\PropertyTable::getList([
                "filter" => [
                    "IBLOCK_ID" => INFINITY_CATALOG_EN_IB_ID,
                    "CODE" => trim($propertyCode)
                ]
            ]);

            if ($arPropInfo = $rsPropInfo->fetch()) {
                $arResult["PROPERTY_CODE"] = $arPropInfo["CODE"];
                $arResult["PROPERTY_NAME"] = $arPropInfo["NAME"];
                $arProcessedProperties = [];
                // Забираем все значения свойства товара
                $arProductPropValues = \Bitrix\Iblock\ElementPropertyTable::getList([
                    "filter" => [
                        "IBLOCK_ELEMENT_ID" => $productId,
                        "IBLOCK_PROPERTY_ID" => $arPropInfo["ID"]
                    ]
                ])->fetchAll();
                if (!empty($arProductPropValues)) {
                    // Ищем связанные товары с такими же значениями свойств
                    $rsLinkedProducts = \CIBlockElement::GetList(
                        ["SORT" => "ASC"],
                        [
                            'IBLOCK_ID' => INFINITY_CATALOG_EN_VARS_IB_ID,
                            'PROPERTY_PARENT_PRODUCT' => $productId,
                            '=PROPERTY_' . $propertyCode => array_column($arProductPropValues, "VALUE")
                        ],
                        false,
                        false,
                        [
                            'ID',
                            'NAME',
                            "PROPERTY_COLOR",
                            "PROPERTY_LINK",
                            "PROPERTY_MARKETPLACE_OZON",
                            "PROPERTY_MARKETPLACE_GOLDAPPLE",
                            "PROPERTY_DISTRIBUTORS_IMAGE",
                            'PROPERTY_' . $propertyCode
                        ]
                    );
                    while ($arLinkedProduct = $rsLinkedProducts->GetNext(false, false)) {
                        $arProcessedProperties[] = $arLinkedProduct["PROPERTY_" . $propertyCode . "_VALUE"];
                        // Выясняем цвет
                        $arLinkedProduct["COLOR"] = [];
                        if (!empty($arLinkedProduct["PROPERTY_COLOR_VALUE"])) {
                            $colorEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity(COLOR_HL_ID);
                            $colorEntityDataClass = $colorEntity->getDataClass();
                            $rsHighloadColor = $colorEntityDataClass::getList([
                                'filter' => [
                                    '=UF_XML_ID' => $arLinkedProduct["PROPERTY_COLOR_VALUE"]
                                ]
                            ]);
                            if ($arColor = $rsHighloadColor->fetch()) {
                                $arLinkedProduct["COLOR"] = $arColor;
                            }
                        }
                        //
                        $arResult["PRODUCT_VARIANTS"][] = $arLinkedProduct;
                    }
                }
                // Свойства детально
                if (!empty($arProcessedProperties)) {
                    $propUserTypeSettigs = unserialize($arPropInfo["USER_TYPE_SETTINGS"]);
                    $rsHighloadData = \Bitrix\Highloadblock\HighloadBlockTable::getList([
                        'filter' => [
                            '=TABLE_NAME' => $propUserTypeSettigs["TABLE_NAME"]
                        ]
                    ]);
                    if ($arHighloadData = $rsHighloadData->fetch()) {
                        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHighloadData);
                        $entityDataClass = $entity->getDataClass();
                        $rsHighloadProps = $entityDataClass::getList([
                            'filter' => [
                                '=UF_XML_ID' => $arProcessedProperties
                            ],
                            "order" => ["UF_SORT" => "ASC"]
                        ]);
                        while ($arProperty = $rsHighloadProps->fetch()) {
                            $arResult["PROPERTY_VALUES"][] = $arProperty;
                        }
                    }
                }
            }
        }
        return $arResult;
    }

    /**
     * Поиск вариантов товара Infinity по его ID и заполненному полю с вариантами (коду этого поля).
     * @param int $productId
     * @param string $propertyCode
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function infinityGetProductVariants(int $productId, string $propertyCode): array
    {
        $arResult = [
            "PRODUCT_VARIANTS" => [],
            "PROPERTY_VALUES" => [],
            "PROPERTY_NAME" => "",
            "PROPERTY_CODE" => ""
        ];
        if (Loader::includeModule("iblock") && Loader::includeModule("highloadblock")) {
            // Ищем нужное поле
            $rsPropInfo = \Bitrix\Iblock\PropertyTable::getList([
                "filter" => [
                    "IBLOCK_ID" => INFINITY_CATALOG_IB_ID,
                    "CODE" => trim($propertyCode)
                ]
            ]);
            if ($arPropInfo = $rsPropInfo->fetch()) {
                $arResult["PROPERTY_CODE"] = $arPropInfo["CODE"];
                $arResult["PROPERTY_NAME"] = $arPropInfo["NAME"];
                $arProcessedProperties = [];
                // Забираем все значения свойства товара
                $arProductPropValues = \Bitrix\Iblock\ElementPropertyTable::getList([
                    "filter" => [
                        "IBLOCK_ELEMENT_ID" => $productId,
                        "IBLOCK_PROPERTY_ID" => $arPropInfo["ID"]
                    ]
                ])->fetchAll();
                if (!empty($arProductPropValues)) {
                    // Ищем связанные товары с такими же значениями свойств
                    $rsLinkedProducts = \CIBlockElement::GetList(
                        ["SORT" => "ASC"],
                        [
                            'IBLOCK_ID' => INFINITY_CATALOG_VARIANTS_IB_ID,
                            'PROPERTY_PARENT_PRODUCT' => $productId,
                            '=PROPERTY_' . $propertyCode => array_column($arProductPropValues, "VALUE")
                        ],
                        false,
                        false,
                        [
                            'ID',
                            'NAME',
                            "PROPERTY_COLOR",
                            "PROPERTY_LINK",
                            "PROPERTY_MARKETPLACE_OZON",
                            "PROPERTY_MARKETPLACE_GOLDAPPLE",
                            "PROPERTY_DISTRIBUTORS_IMAGE",
                            'PROPERTY_' . $propertyCode
                        ]
                    );
                    while ($arLinkedProduct = $rsLinkedProducts->GetNext(false, false)) {
                        $arProcessedProperties[] = $arLinkedProduct["PROPERTY_" . $propertyCode . "_VALUE"];
                        // Выясняем цвет
                        $arLinkedProduct["COLOR"] = [];
                        if (!empty($arLinkedProduct["PROPERTY_COLOR_VALUE"])) {
                            $colorEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity(COLOR_HL_ID);
                            $colorEntityDataClass = $colorEntity->getDataClass();
                            $rsHighloadColor = $colorEntityDataClass::getList([
                                'filter' => [
                                    '=UF_XML_ID' => $arLinkedProduct["PROPERTY_COLOR_VALUE"]
                                ]
                            ]);
                            if ($arColor = $rsHighloadColor->fetch()) {
                                $arLinkedProduct["COLOR"] = $arColor;
                            }
                        }
                        //
                        $arResult["PRODUCT_VARIANTS"][] = $arLinkedProduct;
                    }
                }
                // Свойства детально
                if (!empty($arProcessedProperties)) {
                    $propUserTypeSettigs = unserialize($arPropInfo["USER_TYPE_SETTINGS"]);
                    $rsHighloadData = \Bitrix\Highloadblock\HighloadBlockTable::getList([
                        'filter' => [
                            '=TABLE_NAME' => $propUserTypeSettigs["TABLE_NAME"]
                        ]
                    ]);
                    if ($arHighloadData = $rsHighloadData->fetch()) {
                        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHighloadData);
                        $entityDataClass = $entity->getDataClass();
                        $rsHighloadProps = $entityDataClass::getList([
                            'filter' => [
                                '=UF_XML_ID' => $arProcessedProperties
                            ],
                            "order" => ["UF_SORT" => "ASC"]
                        ]);
                        while ($arProperty = $rsHighloadProps->fetch()) {
                            $arResult["PROPERTY_VALUES"][] = $arProperty;
                        }
                    }
                }
            }
        }
        return $arResult;
    }

    public static function insMenuItemCollaborations($arParams)
    {
        $arResult = array();

        $aMenuLinksExt = $arParams['aMenuLinksExt'];

        $countLevelOne = 0;
        foreach ($aMenuLinksExt as $key => $val) {
            if ($val[3]['DEPTH_LEVEL'] == 1) {
                $countLevelOne++;
            }
        }
        $insItem = array(
            0 => "Collaborations",
            1 => "/partnership/",
            2 => array(
                0 => "/partnership/"
            ),
            3 => array(
                "FROM_IBLOCK" => 0,
                "IS_PARENT" => 0,
                "DEPTH_LEVEL" => 1,
            )

        );
        //echo 'countLevelOne = ' . $countLevelOne . '<br />';
        if ($countLevelOne < 7) {
            $aMenuLinksExt[] = $insItem;
        } else {
            //$aMenuLinksExt = array_merge(array_slice($aMenuLinksExt, 0, 6), $insItem, array_slice($aMenuLinksExt, 6));
            $prevLevel = 0;
            $indexLevelOne = 0;
            $aMenuLinksExtTmp = array();
            foreach ($aMenuLinksExt as $key => $val) {
                if ($indexLevelOne == 6 && $prevLevel >= $val[3]['DEPTH_LEVEL']) {
                    $aMenuLinksExtTmp[] = $insItem;
                }
                if ($val[3]['DEPTH_LEVEL'] == 1) {
                    $indexLevelOne++;
                }
                $prevLevel = $val[3]['DEPTH_LEVEL'];
                $aMenuLinksExtTmp[] = $val;
            }
            $aMenuLinksExt = $aMenuLinksExtTmp;
        }

        $arResult['aMenuLinksExt'] = $aMenuLinksExt;

        return $arResult;
    }
}
