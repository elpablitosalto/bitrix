<?
// Константы -->
define('UPLOAD_DIR_PATH', '/upload/temp/');
define('CONTEST_REG_MAX_FILE_SIZE', (10 * 1024 * 1024));
define('URL_PRIVACY_POLICY', '/privacy-policy/'); // Ссылка на политику конфиденциальности
define('LOGIN_MAX_LENGTH', 30); // Ограничение кол-ва символов никнейма при редактировании в ЛК
// <-- Константы

// Модальные окна -->
{
    $GLOBALS["arSiteConfig"]["arModalsParams"] = array(
        "modal_contest_registration_id" => "modal-contest-registration",
        "modal_registration_id" => "modal-registration",
        "modal_contest_auth_id" => "modal-contest-auth",
        "modal_auth_id" => "modal-auth",
        "modal_upload_work_success_id" => "modal-upload-work-success",
        "contest_works_slides_modal_id" => "modal-work",
        // id блока cо слайдшоу работ участников конкурса
        "contest_works_winner_slides_modal_id" => "modal-work-winner", // id блока cо слайдшоу работ участников конкурса
    );
}
// <-- Модальные окна

// Конкурсы -->
{
    $GLOBALS["arSiteConfig"]["arContestParams"] = array(
        "ANCHOR_TO_CONTEST_RULES" => "contest_conditions",
    );
}
// <-- Конкурсы

// Коды инфоблоков -->
$GLOBALS["arSiteConfig"]["arIblockCodes"] = array(
    "PARTICIPANTS_WORKS" => "participants",
    "CONTESTS" => "contests",
    "MOVIES_FAVORITES" => "movies_favorites",
);
// <-- Коды инфоблоков

// Пути к файлам -->
$GLOBALS["arSiteConfig"]["arPaths"] = array(
    "FAVORITES_ADD_REMOVE_AJAX" => "/include/ajax/movie/favorites.php",
);
// <-- Пути к файлам
?>