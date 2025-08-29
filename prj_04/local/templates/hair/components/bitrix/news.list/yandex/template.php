<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); use \Bitrix\Main\Localization\Loc; $this->setFrameMode(true);?>
<?='<?xml version="1.0" encoding="UTF-8"?>'?>
<rss xmlns:yandex="http://news.yandex.ru" xmlns:media="http://search.yahoo.com/mrss/" xmlns:turbo="http://turbo.yandex.ru" version="2.0">
	<channel>
		<title>hair.ru</title>
		<link>https://hair.ru/</link>
		<description>Профессиональная косметика для волос от компании CONCEPT</description>
		<language>ru</language>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<item turbo="true">
				<link>https://hair.ru<?=$arItem['DETAIL_PAGE_URL']?></link>
				<turbo:content>
					<![CDATA[
						<header>
							<h1><?=$arItem["NAME"]?></h1>
							<menu>
								<a href="http://hair.ru/">Главная</a>
								<a href="http://hair.ru/press-center/">Пресс-центр</a>
								<a href="http://hair.ru/press-center/blog/">Блог</a>
							</menu>
						</header>
						<?
							$yandexText = $arItem["DETAIL_TEXT"];
							$yandexText = preg_replace('/(<img.+?>)/iu','<figure>$1</figure>', $yandexText );
							$yandexText = preg_replace("/<table.*?<\/table>/si",'',$yandexText);
							$yandexText = preg_replace("/<h2.*?<\/h2>/si",'',$yandexText);
							$yandexText = preg_replace("/ class=\".*?\"/si",'',$yandexText);
							$yandexText = preg_replace("/ href=\".*?\"/si",'',$yandexText);
							$yandexText = preg_replace("/<style.*?<\/style>/si",'',$yandexText);
							echo $yandexText;
						?>
					]]>
				</turbo:content>
			</item>
		<?endforeach?>
	</channel>
</rss>