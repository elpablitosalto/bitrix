<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$APPLICATION->IncludeFile(
    SITE_DIR . 'include/personal/user_title.php',
    array(),
    array('SHOW_BORDER' => false)
);