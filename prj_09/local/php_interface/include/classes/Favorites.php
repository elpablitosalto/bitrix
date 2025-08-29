<?php
namespace Mirvendinga;

use Bitrix\Main\Application;
use \Bitrix\Main\Web\Json;

class Favorites {
    private const COOKIE_NAME = "FAVORITES";
    private const COOKIE_PERIOD = 3600 * 24 * 30;
    private $favoriteItems = [];

    public function __construct() {
        $request = Application::getInstance()->getContext()->getRequest();
        $cookie = $request->getCookie(self::COOKIE_NAME);
        if(!empty($cookie)){
            $arItems = Json::decode($cookie);
            if(!empty($arItems) && is_array($arItems)){
                $this->favoriteItems = $arItems;
            }
        }
    }

    public function getFavoritesList() : array
    {
        $arFavorites = $this->favoriteItems;
        return $arFavorites;
    }

    public function save(array $arItems) : bool
    {
        $response = Application::getInstance()->getContext()->getResponse();
        $cookie = new \Bitrix\Main\Web\Cookie(self::COOKIE_NAME, Json::encode($arItems), time() + self::COOKIE_PERIOD);
        $cookie->setPath("/");
        $response->addCookie($cookie);
        return true;
    }

    public function isFavorite(int $productId) : bool
    {
        $arFavorites = $this->favoriteItems;
        return in_array($productId, $arFavorites);
    }
}