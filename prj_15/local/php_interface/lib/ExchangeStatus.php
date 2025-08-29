<?
use Bitrix\Main\Loader;

class ExchangeStatus
{
    protected $iblockId;
    protected $statusId;
    protected $type;
    protected $el;

    public function __construct($type)
    {
        Loader::includeModule('iblock');
        $this->iblockId = Indexis::getIblockId('statuses', 'service');
        $this->type = $type;
        $this->el = new CIBlockElement;
    }

    public function get()
    {
        $res = CIBlockElement::GetList(['SORT' => 'ASC'], [
            'IBLOCK_ID' => $this->iblockId,
            'ACTIVE_DATE' => 'Y',
            'ACTIVE' => 'Y',
            '=CODE' => $this->type,
        ], false, ['nPageSize' => 1], [
            'ID', 'PREVIEW_TEXT'
        ]);

        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $this->statusId = $arFields['ID'];

            $result = unserialize($arFields['~PREVIEW_TEXT']);
            if (!is_array($result))
                $result = [];

            return $result;
        } else {
            $this->statusId = $this->create();
        }

        return [];
    }

    protected function create()
    {
        return $this->el->Add([
            'IBLOCK_ID' => $this->iblockId,
            'NAME' => 'Загрузка заказов через API',
            'CODE' => $this->type
        ]);
    }

    public function set($fields = [])
    {
        $value = (is_array($fields) && count($fields) > 0) ? serialize($fields) : '';
        return $this->el->Update($this->statusId, [
            'PREVIEW_TEXT' => $value
        ]);
    }

    public function clear()
    {
        return $this->set();
    }
}
