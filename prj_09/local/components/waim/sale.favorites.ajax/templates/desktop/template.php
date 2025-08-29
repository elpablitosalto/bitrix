<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
?>

<!-- begin .icon-control-->
<a class="icon-control icon-control_type_mini" href="<?=$arParams["PATH_TO_FAVORITES"]?>">
		<span class="icon-control__illustration">
			<svg
                    class="icon-control__icon"
                    width="33"
                    height="32"
                    viewBox="0 0 33 32"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
            >
				<g clip-path="url(#clip0_901_2021)">
					<path
                            d="M22.4998 4C20.1798 4 17.9532 5.08 16.4998 6.78C15.0465 5.08 12.8198 4 10.4998 4C6.3865 4 3.1665 7.22 3.1665 11.3333C3.1665 16.3667 7.69984 20.48 14.5665 26.7133L16.4998 28.4667L18.4332 26.7133C25.2998 20.48 29.8332 16.3667 29.8332 11.3333C29.8332 7.22 26.6132 4 22.4998 4ZM16.6398 24.74L16.4998 24.8667L16.3598 24.74C10.0198 18.9867 5.83317 15.1867 5.83317 11.3333C5.83317 8.67333 7.83984 6.66667 10.4998 6.66667C12.5532 6.66667 14.5532 7.99333 15.2532 9.81333H17.7398C18.4465 7.99333 20.4465 6.66667 22.4998 6.66667C25.1598 6.66667 27.1665 8.67333 27.1665 11.3333C27.1665 15.1867 22.9798 18.9867 16.6398 24.74Z"
                    />
				</g>
				<defs>
					<clipPath id="clip0_901_2021">
						<rect
                                width="32"
                                height="32"
                                fill="white"
                                transform="translate(0.5)"
                        />
					</clipPath>
				</defs>
			</svg>
			<span class="icon-control__badge js-favorite-count"><?=intval(count($arResult))?></span>
		</span>
    <span class="icon-control__label">Избранное</span>
</a>
<!-- end .icon-control-->