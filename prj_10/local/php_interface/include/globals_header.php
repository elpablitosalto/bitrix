<?
// Определение id модального окна для регистрации на конкурс -->
{
    if ($USER->IsAuthorized()) {
        $GLOBALS["arSiteConfig"]["arModalsParams"]["contest_cur_modal_id"] = $GLOBALS["arSiteConfig"]["arModalsParams"]["modal_contest_registration_id"];
    } else {
        $GLOBALS["arSiteConfig"]["arModalsParams"]["contest_cur_modal_id"] = $GLOBALS["arSiteConfig"]["arModalsParams"]["modal_contest_auth_id"];
    }
}
// <--

?>