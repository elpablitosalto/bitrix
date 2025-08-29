<?
namespace Hair;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Hair\Geo;
use \Bitrix\Main\Loader;
Loader::includeModule("iblock");

class Personal {
    private $post,
            $files,
            $el,
            $arProps,
            $geo,
            $arGeoData,
            $user,
            $userObj;

    private $arTranslitParams = array("replace_space"=>"-","replace_other"=>"-");

    public function __construct($post,$files,$user) {
        $this->post = $post;
        $this->files = $files;
        $this->el = new \CIBlockElement;
        $this->geo = new Geo(false);//получаем экземпляр класса Geo. false - без получения информации о текущем метоположении
        $this->user = $user;
        $this->userObj = new \CUser;
    }

    private function deletePhotos() {
        $photosToDelete = explode('|',$this->post['PHOTOS_TO_DELETE']);
        $rsProperty = $this->el->GetProperty(SALONS, $this->post['ID'], false, false, array('CODE' => 'PHOTOS'));
        while($arProperty = $rsProperty->Fetch()) {
            if(in_array($arProperty['VALUE'],$photosToDelete)):                
                $this->el->SetPropertyValues(
                    $this->post['ID'],
                    SALONS,
                    array(
                        $arProperty['PROPERTY_VALUE_ID'] => array(
                            "VALUE" => array("del" => "Y")
                        )
                    ),
                    'PHOTOS' 
                );
                break;
            endif;
        }
    }

    private function addPhotos($tech = false) {

        $code = 'PHOTOS';

        if($tech)
        {
            $code = 'UF_PHOTOS';
        }

        if(isset($this->files['PHOTOS']) || !empty($this->post['PHOTOS_TO_DELETE']))
        {
            if(!empty($this->post['UF_PHOTOS_exists']))
            {
                foreach($this->post['UF_PHOTOS_exists'] as $photoID)
                {
                    $value = \CFile::MakeFileArray($photoID);
                    $this->arProps[$code][$photoID] = $value;
                }
            }
        }

        if(isset($this->files['PHOTOS']))
        {
            foreach($this->files['PHOTOS']['name'] as $k => $photo):
                $this->arProps[$code]['n'+$k]['name'] = $photo;
                $this->arProps[$code]['n'+$k]['type'] = $this->files['PHOTOS']['type'][$k];
                $this->arProps[$code]['n'+$k]['tmp_name'] = $this->files['PHOTOS']['tmp_name'][$k];
                $this->arProps[$code]['n'+$k]['error'] = $this->files['PHOTOS']['error'][$k];
                $this->arProps[$code]['n'+$k]['size'] = $this->files['PHOTOS']['size'][$k];
            endforeach;
        }

        if(!empty($this->post['PHOTOS_TO_DELETE']))
        {
            $this->post['PHOTOS_TO_DELETE'] = explode('|', $this->post['PHOTOS_TO_DELETE']);
            foreach($this->post['PHOTOS_TO_DELETE'] as $photoID)
            {
                $this->arProps[$code][$photoID] = ['VALUE' => ['del' => 'Y']];
            }
        }
    }

    private function getGeoData() {
        $geoData = json_decode($this->post['GEO_DATA']);//получаем данные из dadata о точке

        if($geoData->region == 'Москва')
            $arGeoData['regionName'] = 'Московская область';
        else
            $arGeoData['regionName'] = $geoData->region.' '.$geoData->region_type_full;
        
        $arGeoData['cityName'] = $geoData->city;
        $arGeoData['cityCode'] = $geoData->region_iso_code;
        $arGeoData['pointCoords'] = $geoData->geo_lat.','.$geoData->geo_lon;

        $arGeoData['cityGeoData'] = $this->geo->getCoordsByValue($arGeoData['regionName'].', '.$arGeoData['cityName']);//получаем геоданные города через ymaps api
        $arGeoData['cityCoords'] = str_replace(' ',',',$arGeoData['cityGeoData']->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos); 
        return $arGeoData;
    }

    public function distributorhInfoAction() {
        $this->arProps['WORK_COMPANY'] = $this->post['LEGAL_NAME'];
        $this->arProps['WORK_WWW'] = $this->post['SITE'];
        $this->arProps['UF_BRAND_NAME'] = $this->post['BRAND_NAME'];
        $this->arProps['UF_ADDRESS'] = $this->post['ADDRESS'];
        $this->arProps['UF_REGION'] = [];

        if(!empty($this->post['ADDRESS']))
        {
            foreach($this->post['ADDRESS'] as $key=>$value)
            {
                if($value)
                {
                    if(!empty($this->post['GEO_DATA'][$key]))
                    {
                        $geo = json_decode($this->post['GEO_DATA'][$key], true);
                        $dbSection = \CIBlockSection::GetList(false, [
                            'IBLOCK_ID' => SALONS, 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1,
                            'NAME' => '%'.$geo['region'].'%'
                        ]);
                        if($arSection = $dbSection->Fetch())
                        {
                            $this->arProps['UF_REGION'][] = $arSection['CODE'];
                        }
                        else
                        {
                            $this->arProps['UF_REGION'][] = '0';
                        }
                    }
                    else if(!empty($this->post['REGION'][$key]))
                    {
                        $this->arProps['UF_REGION'][] = $this->post['REGION'][$key];
                    }
                    else
                    {
                        $this->arProps['UF_REGION'][] = '0';
                    }
                }
            }
        }



        if(isset($this->files['SALON_LOGO'])) {
            $this->arProps["PERSONAL_PHOTO"] = $this->files['SALON_LOGO'];
            $this->arProps["UF_LOGO"] = $this->files['SALON_LOGO'];
        }
        
        $this->addPhotos(true);

        $uid = $this->userObj->Update($this->user->getID(), $this->arProps);
        if($uid > 0):
            $arResult['STATUS'] = 'Y';
            $arResult['TYPE'] = 'success';
            $arResult['MESSAGE'] = 'Данные успешно изменены!';
        else:
            $arResult['STATUS'] = 'N';
            $arResult['TYPE'] = 'error';
            $arResult['MESSAGE'] = $this->user->LAST_ERROR;
        endif;

        return $arResult;
    }

    public function techInfoAction() {
            
        if($this->post['POSITION'])
            $this->arProps['WORK_POSITION'] = $this->post['POSITION'];
        
        $nameArr = explode(' ',$this->post['NAME']);
        $this->arProps['LAST_NAME'] = $nameArr[0];
        $this->arProps['NAME'] = $nameArr[1];
        $this->arProps['SECOND_NAME'] = $nameArr[2];

        if($this->post['NOTES'])
            $this->arProps['PERSONAL_NOTES'] = $this->post['NOTES'];

        if(isset($this->files['USER_PICTURE']))
            $this->arProps["PERSONAL_PHOTO"] = $this->files['USER_PICTURE'];
        
        $this->addPhotos(true); 
        
        $uid = $this->userObj->Update($this->user->getID(), $this->arProps);
        if($uid > 0):
            $arResult['STATUS'] = 'Y';
            $arResult['TYPE'] = 'success';
            $arResult['MESSAGE'] = 'Данные успешно изменены!';
        else:
            $arResult['STATUS'] = 'N';
            $arResult['TYPE'] = 'error';
            $arResult['MESSAGE'] = $this->user->LAST_ERROR;
        endif;

        return $arResult;
    }

    public function searchCity($geoData) {
        
            //Найдем регион. Если нет - добавим новый
            $arFilter = [
                'IBLOCK_ID' => SALONS,
                'NAME' => $geoData['regionName'],
                'DEPTH_LEVEL' => 1
            ];
            $sObj = \CIBlockSection::GetList(false,$arFilter,false,['ID']);
            if($res = $sObj->GetNext()):
                $regionSection = $res['ID'];
            else:
                $bs = new \CIBlockSection;
                $arFields = Array(
                    "IBLOCK_ID" => SALONS,
                    "CODE" => \Cutil::translit($geoData['regionName'],"ru",$this->arTranslitParams),
                    "IBLOCK_SECTION_ID" => false,
                    "NAME" => $geoData['regionName']
                );
                $regionSection = $bs->Add($arFields);
                if($regionSection <= 0)
                    echo 'Ошибка: '.$bs->LAST_ERROR;
            endif;

            //Найдем город. Если нет - добавим новый
            $arFilter = [
                'IBLOCK_ID' => SALONS,
                'NAME' => $geoData['cityName'],
                'DEPTH_LEVEL' => 2
            ];
            $sObj = \CIBlockSection::GetList(false,$arFilter,false,['ID']);
            $citySection = '';
            if($res = $sObj->GetNext()):
                $citySection = $res['ID'];
            else:
                $bs = new \CIBlockSection;
                $arFields = Array(
                    "IBLOCK_ID" => SALONS,
                    "IBLOCK_SECTION_ID" => $regionSection,
                    "NAME" => $geoData['cityName'],
                    "CODE" => $geoData['cityCode'],
                    "UF_COORDS" => $geoData['cityCoords']
                );
                
                $citySection = $bs->Add($arFields);
                if($citySection <= 0)
                    echo 'Ошибка: '.$bs->LAST_ERROR;
            endif;

            return $citySection;
    }

    public function salonInfoAction() {
        if(isset($this->post['ID']) && $this->post['ID'] > 0) {
            if(!empty($this->post['PHOTOS_TO_DELETE']))
                $this->deletePhotos();
        }             
        $this->addPhotos(); 
        if(isset($this->post['GEO_DATA']) && !empty($this->post['GEO_DATA'])) {
            $geoData = $this->getGeoData();    
            
            $citySection = $this->searchCity($geoData);

            $this->arProps['ADDRESS'] = $this->post['ADDRESS'];
            $this->arProps['COORDS'] = $geoData['pointCoords'];
        }

        if(isset($this->files['SALON_LOGO']))
            $this->arProps["LOGO"] = $this->files['SALON_LOGO'];

        if(isset($morePhotos))
            $this->addPhotos();

        if(!isset($this->post['SHOW_ON_MAP']))
            $this->arProps["SHOW_ON_MAP"] = 38;//отображаем на карте, если не проставлена галка в ЛК

        $this->arProps['SALON_USER'] = $this->user->GetID();
        $this->arProps['SALON_TYPE'] = 36;//по-умолчанию ставим тип Салон
        if(isset($this->post['PHONE']))
            $this->arProps['PHONE'] = $this->post['PHONE'];

        $arLoadProductArray = Array(  
            'MODIFIED_BY' => $this->user->GetID(),  
            'IBLOCK_ID' => SALONS,
            'CODE' => \Cutil::translit($this->post['NAME'],"ru",$this->arTranslitParams),
            'PROPERTY_VALUES' => $this->arProps,  
            'NAME' => $this->post['NAME'],  
            'ACTIVE' => 'Y',   
        );
        if(!empty($citySection))
            $arLoadProductArray['IBLOCK_SECTION_ID'] = $citySection;
        
        $arResult = [];
               
        if(isset($this->post['ID']) && $this->post['ID'] > 0):
            unset($arLoadProductArray['PROPERTY_VALUES']);
            $this->el->SetPropertyValuesEx($this->post['ID'],SALONS,$this->arProps);
            if($id = $this->el->Update($this->post['ID'],$arLoadProductArray)):
                $arResult['STATUS'] = 'Y';
                $arResult['TYPE'] = 'success';
                $arResult['MESSAGE'] = 'Данные успешно изменены!';
            else:
                $arResult['STATUS'] = 'N';
                $arResult['TYPE'] = 'error';
                $arResult['MESSAGE'] = $this->el->LAST_ERROR;
            endif;
        else:
            if($id = $this->el->Add($arLoadProductArray)):
                $arEventFields = array(
                    "UID" => $this->user->GetID(),
                    "USER_NAME" => $this->user->GetFullName(),
                    "SALON_NAME" => $this->post['NAME'],
                    "SALON_ID" => $id,
                    "SALONS_IB" => SALONS
                );
                \CEvent::Send('SALON_CREATE', 's1', $arEventFields);

                $arResult['STATUS'] = 'Y';
                $arResult['TYPE'] = 'success';
                $arResult['MESSAGE'] = 'Данные успешно изменены!';
            else:
                $arResult['STATUS'] = 'N';
                $arResult['TYPE'] = 'error';
                $arResult['MESSAGE'] = $this->el->LAST_ERROR;
            endif;
        endif;

        return $arResult;
    }

    public function register() {
        if(isset($this->post['GEO_DATA']) && !empty($this->post['GEO_DATA'])) {
            $geoData = $this->getGeoData();    
            $citySection = $this->searchCity($geoData);
        }
        $nameArr = explode(' ',$this->post['NAME']);
        $arResult = $this->userObj->Register($this->post['EMAIL'], $nameArr[1], $nameArr[0], $this->post['PASS'], $this->post['PASS'],$this->post['EMAIL'], 's1', "", 0, false, $this->post['PHONE']);
        if($arResult['TYPE'] == 'OK'):
            $this->arProps['GROUP_ID'] = array_merge($this->userObj->GetUserGroup($arResult['ID']), array($this->post['GROUP']));
            $this->arProps['PERSONAL_CITY'] = $geoData['cityName'];
            $this->arProps['UF_REGION'] = $geoData['cityName'];
            if(!empty($citySection))
                $this->arProps['UF_REGION'] = $citySection;
            if(!empty($this->post['POSITION']))
                $this->arProps['WORK_POSITION'] = $this->post['POSITION'];

            $this->arProps['WORK_PHONE'] = $this->post['PHONE'];

            $this->userObj->Update($arResult['ID'], $this->arProps);

            global $USER;
            $USER->Authorize($arResult['ID']);

            if(!empty($this->post['NEED_FEEDBACK'])){
                  $arEventFields = array(
                    "USER_ID" => $arResult['ID'],
                    "NAME" => $this->post['NAME'],
                    "EMAIL" => $this->post['EMAIL'],
                    "LOGIN" => $this->post['EMAIL'],
                    "PHONE_NUMBER" => $this->post['PHONE']
                );
                \CEvent::Send('MASTER_REGISTER_NEED_FEEDBACK', 's1', $arEventFields);
            }
        endif;
        return $arResult;
    }
    
    public function auth() {
        if(!empty($this->post['USER_LOGIN']) && !empty($this->post['USER_PASSWORD']))
        {
            global $USER;

            $arAuthResult = $USER->Login($this->post['USER_LOGIN'], $this->post['USER_PASSWORD']);

            if($arAuthResult === true)
            {
                $arResult['STATUS'] = 'Y';
                $arResult['TYPE'] = 'success';
                $arResult['MESSAGE'] = 'Вы успешно авторизованы';
            }
            else
            {
                $arResult['STATUS'] = 'N';
                $arResult['TYPE'] = 'error';
                $arResult['MESSAGE'] = $arAuthResult['MESSAGE'];
            }
        }
        else
        {
            $arResult['STATUS'] = 'N';
            $arResult['TYPE'] = 'error';
            $arResult['MESSAGE'] = 'Ошибка авторизации. Попробуйте позже или обратитесь к администратору сайта.';
        }

        return $arResult;
    }

    public function editPersonalData() {
        $fields = Array(
            "EMAIL"             => $this->post['EMAIL'],
            "LOGIN"             => $this->post['EMAIL'],
            "PASSWORD"          => $this->post['PASS'],
            "CONFIRM_PASSWORD"  => $this->post['PASS'],
            "PERSONAL_CITY"     => $this->post['CITY'],
            "PERSONAL_PHONE"    => $this->post['PHONE']
        );
        $uid = $this->userObj->Update($this->user->getID(), $fields);
        if($uid > 0):
            $arResult['STATUS'] = 'Y';
            $arResult['TYPE'] = 'success';
            $arResult['MESSAGE'] = 'Данные успешно изменены!';
        else:
            $arResult['STATUS'] = 'N';
            $arResult['TYPE'] = 'error';
            $arResult['MESSAGE'] = $this->user->LAST_ERROR;
        endif;

        return $arResult;
    }

}