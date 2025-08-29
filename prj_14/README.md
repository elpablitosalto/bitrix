# vate-tire.ru

## Описание
Это основной репозиторий сайта [vate-tire.ru](https://vate-tire.ru). Здесь вы найдете информацию о структуре проекта, методологии разработки, подключении подмодулей и настройках компонентов сайта.

## Особенности проекта

### Методология разработки
Для работы с репозиторием используется методология **Git Flow**, что позволяет организовать и поддерживать стабильность разработки. Подробное руководство по работе с Git Flow можно найти [по этой ссылке](https://docs.google.com/document/d/10Yyspb9IQbbNTgErwiTpuJEx34zY8MJYKmnd96WaDJo/edit?usp=sharing).

### Подключение подмодуля верстки
Верстка подключена через подмодуль, что упрощает ее обновление и синхронизацию. Полное руководство по работе с подмодулем доступно [здесь](https://docs.google.com/document/d/1L-UaS5eWjRQslDE1zG-MCPMoTIVMg2AHXCHy26_Tgt0/edit?usp=sharing).

Репозиторий подмодуля с версткой расположен по адресу:
[https://gitlab.com/StXrom/vate-tire-mockup](https://gitlab.com/StXrom/vate-tire-mockup)

## Константы
На сайте используются следующие ключевые константы для настройки reCAPTCHA:
- `RECAPTCHA_SITE_KEY` — публичный ключ reCAPTCHA
- `RECAPTCHA_SECRET_KEY` — приватный ключ reCAPTCHA
- `RECAPTCHA_SCORE` — уровень оценки для фильтрации запросов

Константы задаются в файле:
`./local/php_interface/include/constants.php`

## Формы обратной связи
Для обработки форм на сайте используется кастомный компонент `waim:feedback.form`, который находится по пути:
`./local/components/waim/feedback.form`

Компонент поддерживает работу только в **AJAX-режиме** и включает проверку reCAPTCHA. Чтобы активировать reCAPTCHA, при вызове компонента нужно задать следующие параметры:
- `USE_RECAPTCHA => 'Y'`
- `RECAPTCHA_SITE_KEY => '...'`
- `RECAPTCHA_SECRET_KEY => '...'`

Если `RECAPTCHA_SITE_KEY` или `RECAPTCHA_SECRET_KEY` не указаны, проверка reCAPTCHA будет отключена.
