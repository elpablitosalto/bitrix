<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

global $USER, $APPLICATION;

$userName = trim($USER->GetFirstName());

if (mb_strlen($userName) == 0)
	$userName = $USER->GetLogin();

$APPLICATION->SetTitle("Добрый день, " . $userName);