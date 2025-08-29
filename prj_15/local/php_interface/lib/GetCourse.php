<?
use Bitrix\Main\Loader;

class GetCourse
{
    protected $accountName;
    protected $secretKey;
    protected $exportId;
    protected $url;

    public function __construct($accountName, $secretKey)
    {
        Loader::includeModule('iblock');
        $this->accountName = $accountName;
        $this->secretKey = $secretKey;
        $this->url = 'https://' . $accountName . '.getcourse.ru/pl/api/account/';
    }

    protected function getUrl()
    {
        return $this->url . implode('/', func_get_args());
    }

    public function prepareDeals($params = [])
    {
        return $this->sendRequest(
            $this->getUrl('deals'),
            $params
        );
    }

    public function getDeals($exportId)
    {
        return $this->sendRequest(
            $this->getUrl('exports', $exportId)
        );
    }

    protected function sendRequest($url, $params = [])
    {
        $params['key'] = $this->secretKey;
        $curl = curl_init($url . '?' . http_build_query($params));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $body = curl_exec ($curl);

        $result = new \StdClass();
        $result->status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result->body = $body;
        curl_close ($curl);

        return $this->processResult($result);
    }

    protected function processResult($result) {
        switch ($result->status_code) {
            case 400:
                throw new FormatError();
                break;
            case 401:
                throw new TokenError();
                break;
            default:
                if($result->status_code >= 500) {
                    throw new ServerError($result->status_code);
                }
                else {
                    return json_decode($result->body, true);
                }
        }
    }
}
