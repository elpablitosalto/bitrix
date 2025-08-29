<?php

namespace Waim\Components;

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Security\Random;
use CBitrixComponent;

class FeedbackFormComponent  extends CBitrixComponent implements Controllerable, Errorable
{
    // Коллекция ошибок
    protected ErrorCollection $errorCollection;
    public $webFormId = '';
    private $recaptchaAnswer = [];
    private $recaptchaSiteKey = '';
    private $recaptchaSecretKey = '';
    private $recaptchaScore = '';
    private $useRecaptcha = false;
    private static $jsVarAdded = false;

    /**
     * Подготовка параметров компонента
     *
     * @param array $arParams Параметры компонента
     * @return array Отредактированные параметры компонента
     */
    public function onPrepareComponentParams($arParams): array
    {
        // Инициализация коллекции ошибок
        $this->errorCollection = new ErrorCollection();

        // Получаем параметры из массива $arParams с установкой значений по умолчанию
        $this->webFormId = $arParams['FORM_ID'] ?? '';
        $this->recaptchaSiteKey = $arParams['RECAPTCHA_SITE_KEY'] ?? '';
        $this->recaptchaSecretKey = $arParams['RECAPTCHA_SECRET_KEY'] ?? '';
        $this->recaptchaScore = $arParams['RECAPTCHA_SCORE'] ?? 0.1;

        // Проверяем, нужно ли использовать reCAPTCHA
        $this->useRecaptcha = $this->shouldUseRecaptcha($arParams);

        // Если reCAPTCHA используется, загружаем необходимые ресурсы
        if ($this->useRecaptcha) {
            $this->loadRecaptchaAssets();
        }

        return $arParams;
    }

    /**
     * Проверяет, нужно ли использовать reCAPTCHA
     *
     * @param array $arParams Массив параметров
     * @return bool
     */
    private function shouldUseRecaptcha(array $arParams): bool
    {
        return !empty($arParams['RECAPTCHA_SECRET_KEY']) && !empty($arParams['RECAPTCHA_SECRET_KEY']) && $this->isRecaptchaEnabled($arParams);
    }

    /**
     * Проверяет параметр USE_RECAPTCHA на наличие значения "Y"
     * @param array $arParams Массив параметров
     * @return bool
     */
    private function isRecaptchaEnabled(array $arParams): bool
    {
        return !empty($arParams['USE_RECAPTCHA']) && $arParams['USE_RECAPTCHA'] === 'Y';
    }

    /**
     * Загружает необходимые ресурсы для reCAPTCHA (например, JS, CSS)
     *
     * @return void
     */
    private function loadRecaptchaAssets(): void
    {
        // Метод для подключения необходимых ресурсов (например, js, css)
        Asset::getInstance()->addJs('https://www.google.com/recaptcha/api.js?render=' . $this->recaptchaSiteKey);
        Asset::getInstance()->addJs($this->getPath() . '/recaptcha.js');
        if (!self::$jsVarAdded) {
            Asset::getInstance()->addString("
                <script>
                    window.recaptchaSiteKey = '" . $this->recaptchaSiteKey . "';
                </script>
            ");
            self::$jsVarAdded = true;
        }
    }

    /**
     * Выполнение компонента
     *
     * @throws \Exception
     */
    public function executeComponent(): void
    {
        // Подключаем модуль только один раз
        $this->includeFormModule();

        // Проверяем, передан ли параметр FORM_ID
        $this->checkFormId();

        // Получаем форму по ID
        $this->arResult['FORM'] = $this->getFormById($this->arParams['FORM_ID']);
        $this->checkFormResult();

        // Генерация уникального идентификатора формы
        $this->arResult['FORM_ID'] = $this->generateFormId();

        // Получаем мета-данные и группы формы
        $fields = $this->getFormGroups($this->arParams['FORM_ID']);
        $this->arResult['FORM_META'] = $this->buildFormMeta($fields);
        $this->arResult['GROUPS'] = $this->buildArGroups($fields);

        // Подключаем шаблон компонента
        $this->includeComponentTemplate();
    }

    /**
     * Подключает модуль формы, если еще не подключен
     */
    private function includeFormModule(): void
    {
        if (!\CModule::IncludeModule('form')) {
            throw new \Exception('Не удалось подключить модуль формы.');
        }
    }

    /**
     * Проверяет, что передан параметр FORM_ID
     *
     * @throws \Exception
     */
    private function checkFormId(): void
    {
        if (empty($this->arParams['FORM_ID'])) {
            throw new \Exception('Не передан FORM_ID');
        }
    }

    /**
     * Проверяет, что форма была успешно найдена
     *
     * @throws \Exception
     */
    private function checkFormResult(): void
    {
        if (empty($this->arResult['FORM'])) {
            throw new \Exception('Не удалось найти форму с ID: ' . $this->arParams['FORM_ID']);
        }
    }

    /**
     * Генерирует уникальный идентификатор для формы
     *
     * @return string
     */
    private function generateFormId(): string
    {
        return 'WEB_FORM_' . $this->arParams['FORM_ID'] . '_' . \Bitrix\Main\Security\Random::getString(5);
    }

    /**
     * Строит HTML meta-информацию для формы
     *
     * @return string HTML-разметка для скрытых полей формы
     */
    public function buildFormMeta(): string
    {
        // Инициализируем строку для HTML
        $metaHtml = '';

        // Добавляем обязательные скрытые поля
        $metaHtml .= $this->buildHiddenField('sessid', bitrix_sessid());
        $metaHtml .= $this->buildHiddenField('webFormId', htmlspecialchars($this->webFormId));

        // Если включена reCAPTCHA, добавляем скрытое поле для ответа
        if ($this->useRecaptcha) {
            $metaHtml .= $this->buildHiddenField('recaptcha_response', '');
        }

        return $metaHtml;
    }

    /**
     * Создаёт скрытое поле формы
     *
     * @param string $name Имя поля
     * @param string $value Значение поля
     * @return string HTML-разметка для скрытого поля
     */
    private function buildHiddenField(string $name, string $value): string
    {
        return sprintf('<input type="hidden" name="%s" value="%s" />', htmlspecialchars($name), htmlspecialchars($value));
    }

    /**
     * Строит массив полей формы
     *
     * @param array $list Массив данных о группах формы
     * @return array Структура полей группы
     */
    public function buildArGroups(array $list = []): array
    {
        $result = [];

        foreach ($list as $key => $item) {
            // Проверка наличия поля ANSWERS
            if (empty($item['ANSWERS']) || !is_array($item['ANSWERS'])) {
                continue;  // Пропускаем, если ответы отсутствуют или имеют некорректный формат
            }

            $answers = $item['ANSWERS'];

            // Инициализируем основную информацию о группе
            $result[$key] = [
                'ID' => $item['ID'] ?? '',
                'TITLE' => $item['TITLE'] ?? '',
                'SORT' => $item['C_SORT'] ?? 0,
                'ACTIVE' => $item['ACTIVE'] ?? 'N',
                'COMMENTS' => $item['COMMENTS'] ?? '',
                'REQUIRED' => $item['REQUIRED'] ?? 'N',
                'ITEMS' => [],
            ];

            // Обрабатываем ответы в группе
            foreach ($answers as $answer) {
                $name = 'form_' . ($answer['FIELD_TYPE'] ?? 'text') . '_' . ($answer['ID'] ?? '');
                $type = $this->determineFieldType($key, $answer);

                // Добавляем ответ в массив ITEMS
                $result[$key]['ITEMS'][$name] = [
                    'ID' => $answer['ID'] ?? '',
                    'NAME' => $name,
                    'TITLE' => $answer['TITLE'] ?? '',
                    'SORT' => $answer['C_SORT'] ?? 0,
                    'TYPE' => $type,
                    'VALUE' => $answer['VALUE'] ?? '',
                    'ACTIVE' => $answer['ACTIVE'] ?? 'N',
                    'MESSAGE' => $answer['MESSAGE'] ?? '',
                    'QUESTION_ID' => $answer['QUESTION_ID'] ?? '',
                ];
            }
        }

        return $result;
    }

    // TODO дорабоать под все возможные типы
    /**
     * Определяет тип поля на основе ключа группы
     *
     * @param string $key Ключ группы (например, 'PHONE', 'TEL')
     * @param array $answer Массив данных об ответе
     * @return string Тип поля
     */
    private function determineFieldType(string $key, array $answer): string
    {
        // Если группа типа 'PHONE' или 'TEL', то устанавливаем тип 'tel'
        if (in_array($key, ['PHONE', 'TEL'], true)) {
            return 'tel';
        }

        // По умолчанию тип поля - 'text'
        return $answer['FIELD_TYPE'] ?? 'text';
    }

    /**
     * Получение ошибки по коду
     *
     * @param string $code
     * @return Error|null
     */
    public function getErrorByCode($code): ?Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    /**
     * Получение всех ошибок
     *
     * @return array
     */
    public function getErrors(): array
    {
        $errors = [];

        foreach ($this->errorCollection as $error) {
            $errors[] = $error;
        }

        return $errors;
    }

    /**
     * Конфигурация действий для AJAX-запросов
     *
     * @return array
     */
    public function configureActions(): array
    {
        return [
            'send' => [
                'prefilters' => [
                    // new ActionFilter\Authentication(), // Проверка авторизации пользователя
                ]
            ]
        ];
    }

    /**
     * Получает форму по ID
     *
     * @param int $formId ID формы
     *
     * @return array Данные формы
     * @throws \Exception Если форма с указанным ID не найдена
     */
    public function getFormById(int $formId): array
    {
        // Проверка на пустой или некорректный ID
        if ($formId <= 0) {
            throw new \InvalidArgumentException('Некорректный ID формы');
        }

        // Получаем форму по ID
        $rsForm = \CForm::GetByID($formId);

        if ($arForm = $rsForm->Fetch()) {
            return $arForm;
        }

        // Если форма не найдена, выбрасываем исключение
        throw new \Exception('Форма с ID ' . $formId . ' не найдена');
    }

    /**
     * Получает вопросы формы по ID
     *
     * @param int $formId ID формы
     *
     * @return array Массив вопросов формы
     * @throws \InvalidArgumentException Если форма с таким ID не существует
     */
    public function getFormGroups(int $formId): array
    {
        // Проверка на корректный ID
        if ($formId <= 0) {
            throw new \InvalidArgumentException('Некорректный ID формы');
        }

        $arFields = [];

        // Получаем список полей формы с сортировкой по умолчанию
        $rsFields = \CFormField::GetList($formId, 'ALL', 's_sort', 'asc', ['ACTIVE' => 'Y']);

        // Обрабатываем поля
        while ($arField = $rsFields->Fetch()) {
            // Генерация ключа для поля
            $key = $this->getFieldKey($arField);

            // Заполняем массив полей и добавляем ответы
            $arFields[$key] = $arField;
            $arFields[$key]['ANSWERS'] = $this->getFieldAnswers($arField['ID']);
        }

        return $arFields;
    }

    /**
     * Формирует ключ для поля, используя SID или ID
     *
     * @param array $arField Массив данных поля
     * @return string Ключ для поля
     */
    private function getFieldKey(array $arField): string
    {
        return !empty($arField['SID']) ? $arField['SID'] : 'FIELD_' . $arField['ID'];
    }

    // TODO Добавить поля формы помимо вопросов

    /**
     * Получает ответы для поля
     *
     * @param int $fieldId ID поля
     * @return array Массив ответов для поля
     */
    private function getFieldAnswers(int $fieldId): array
    {
        // Используем метод для получения ответов
        return $this->getFieldAnswer($fieldId);
    }

    /**
     * Получает ответы вопроса
     *
     * @param int $questionId ID вопроса
     *
     * @return array Ответы вопроса
     * @throws \InvalidArgumentException Если ID вопроса некорректен
     */
    public function getFieldAnswer(int $questionId): array
    {
        // Проверка на корректность ID вопроса
        if ($questionId <= 0) {
            throw new \InvalidArgumentException('Некорректный ID вопроса');
        }

        $result = [];

        // Получаем список ответов на вопрос
        $rsAnswers = \CFormAnswer::GetList($questionId);

        // Обрабатываем ответы
        while ($arAnswer = $rsAnswers->Fetch()) {
            $result[] = $arAnswer;
        }

        return $result;
    }

    /**
     * Получает ответ
     *
     * @param int $answer_id
     *
     * @return array
     */
    public function getAnswerById($answer_id): array
    {
        $result = [];

        if (!empty($answer_id)) {
            $rsAnswer = \CFormAnswer::GetByID($answer_id);
            $result = $rsAnswer->Fetch();
        }

        return $result;
    }

    /* AJAX ОБРАБОТЧИКИ */

    /**
     * Сохранение данных формы
     *
     * @return array
     * @throws \Exception В случае ошибки обработки данных формы
     */
    public function sendAction(): array
    {
        \CModule::IncludeModule("form");
        $formFieldErrors = [];

        try {
            $this->checkSession();
            $this->checkRecaptcha();

            $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

            // Проверяем наличие параметра webFormId
            $webFormId = $request->get('webFormId');
            if (!$webFormId) {
                throw new \Exception('Не передан параметр webFormId');
            }

            // Проверка обязательных полей формы
            $formFieldErrors = \CForm::Check($webFormId, $request, false, "Y", 'Y');
            $formFieldErrors = $formFieldErrors ?: [];

            if (count($formFieldErrors)) {
                throw new \Exception('Заполните обязательные поля');
            }

            // Добавление результата в форму
            $result = \CFormResult::Add($webFormId, $request);
            $this->sendFormNotifications($webFormId, $result);

            return ['id' => $result];
        } catch (\Exception $e) {
            // Добавление ошибки в коллекцию и возвращение ответов
            $this->errorCollection[] = new Error($e->getMessage());
            return $this->handleErrors($formFieldErrors);
        }
    }

    /**
     * Проверка сессии
     *
     * @throws \Exception Если сессия невалидна
     */
    private function checkSession(): void
    {
        if (!check_bitrix_sessid()) {
            throw new \Exception('Ошибка сессии. Попробуйте обновить страницу');
        }
    }

    /**
     * Проверка reCAPTCHA
     *
     * @throws \Exception Если проверка reCAPTCHA не пройдена
     */
    private function checkRecaptcha(): void
    {
        if ($this->useRecaptcha && !$this->recaptchaCheck()) {
            throw new \Exception('Не пройдена проверка reCAPTCHA');
        }
    }

    /**
     * Отправка уведомлений после добавления результата формы
     *
     * @param string $webFormId
     * @param int $resultId
     */
    private function sendFormNotifications(string $webFormId, int $resultId): void
    {
        \CFormCRM::onResultAdded($webFormId, $resultId);
        \CFormResult::SetEvent($resultId);
        \CFormResult::Mail($resultId);
    }

    /**
     * Обработка ошибок и возвращение данных
     *
     * @param array $formFieldErrors
     * @return array
     */
    private function handleErrors(array $formFieldErrors): array
    {
        if (count($formFieldErrors)) {
            return ['invalid' => $formFieldErrors];
        }

        return [];
    }

    /**
     * Проверка ответа reCAPTCHA
     *
     * @return bool
     */
    public function recaptchaCheck(): bool
    {
        $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

        // Не проверяем капчу для локальных серверов и авторизованных пользователей
        if ($this->isLocalhost() || $this->isUserAuthorized()) {
            return true;
        }

        if ($request->getRequestMethod() === 'POST' && !empty($request->getPost('recaptcha_response'))) {
            return $this->verifyRecaptcha($request->getPost('recaptcha_response'));
        }

        $this->recaptchaAnswer = \Bitrix\Main\Web\Json::encode([
            'type' => 3,
            'getRequestMethod' => $request->getRequestMethod(),
            'recaptcha_response' => $request->getPost('recaptcha_response')
        ]);

        return false;
    }

    /**
     * Проверка, является ли сервер локальным
     *
     * @return bool
     */
    private function isLocalhost(): bool
    {
        return strstr(\Bitrix\Main\Application::getInstance()->getContext()->getServer()->getServerName(), ".local") !== false;
    }

    /**
     * Проверка, авторизован ли пользователь
     *
     * @return bool
     */
    private function isUserAuthorized(): bool
    {
        return $GLOBALS["USER"]->IsAuthorized();
    }

    /**
     * Верефикация ответа reCAPTCHA
     *
     * @param string $recaptchaResponse Ответ reCAPTCHA
     * @return bool
     */
    private function verifyRecaptcha(string $recaptchaResponse): bool
    {
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptchaSecret = \Bitrix\Main\Config\Option::get("main", "recaptcha_secret_code", $this->recaptchaSecretKey);

        $recaptchaResult = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
        $recaptcha = \Bitrix\Main\Web\Json::decode($recaptchaResult);

        $this->recaptchaAnswer = $recaptcha;
        $this->recaptchaAnswer['type'] = 1;

        return $recaptcha["success"] && $recaptcha["score"] >= $this->recaptchaScore;
    }
}
