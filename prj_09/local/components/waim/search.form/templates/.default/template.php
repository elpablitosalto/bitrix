<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
?>
<!-- begin .search-form-->
<form class="search-form <?=$arParams["CLASS"]?>" method="GET" action="<?=$arResult['FORM_ACTION']?>">
		<div class="search-form__field">
				<input
                    type="text"
                    class="search-form__input js-search-with-results"
                    name="q"
                    placeholder="<?=$arResult['PLACEHOLDER']?>"
                    value="<?=$arResult['SEARCH_QUERY']?>"
				/>
				<div class="search-form__clear-control">
						<button type="button" class="search-form__clear js-search-clear">
								Очистить
						</button>
				</div>
				<div class="search-form__control">
                    <button type="submit" class="search-form__submit">
                        <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                                class="search-form__icon"
                        >
                                <path
                                        d="M18.031 16.617L22.314 20.899L20.899 22.314L16.617 18.031C15.0237 19.3082 13.042 20.0029 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20.0029 13.042 19.3082 15.0237 18.031 16.617ZM16.025 15.875C17.2941 14.5699 18.0029 12.8204 18 11C18 7.132 14.867 4 11 4C7.132 4 4 7.132 4 11C4 14.867 7.132 18 11 18C12.8204 18.0029 14.5699 17.2941 15.875 16.025L16.025 15.875Z"
                                ></path>
                        </svg>
                    </button>
				</div>
		</div>
		<div class="search-form__results">
				<!-- begin .search-results-->
				<!--<div class="search-results">
						<div class="search-results__message">Совпадений не найдено</div>
						<div class="search-results__matches">
								<ul class="search-results__list">
										<li class="search-results__item">
												<a href="#" class="search-results__link">
														<span class="highlight">Вендинг</span>
														овые автоматы
												</a>
										</li>
										<li class="search-results__item">
												<a href="#" class="search-results__link">
														Все о
														<span class="highlight">вендинг</span>
														е
												</a>
										</li>
										<li class="search-results__item">
												<a href="#" class="search-results__link">
														Запчасти для
														<span class="highlight">вендинг</span>
														ового автомата
												</a>
										</li>
								</ul>
						</div>
				</div>-->
				<!-- end .search-results-->
		</div>
</form>
<!-- end .search-form-->