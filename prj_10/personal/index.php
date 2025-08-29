<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
$APPLICATION->SetPageProperty("title","Личный кабинет");
$APPLICATION->SetPageProperty("description","Личный кабинет");
?>
<?
global $USER;

if(!$USER->IsAuthorized()){
    LocalRedirect('/');
}
?>
    <div class="ml-page-menu">
        <? $APPLICATION->IncludeComponent("bitrix:menu","personal", [
            "ROOT_MENU_TYPE" => "personal",
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "top",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "Y",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "86400",
            "MENU_CACHE_USE_GROUPS" => "N",
            "MENU_CACHE_GET_VARS" => ""
        ]); ?>
    </div>
<?

$userID = $USER->GetID(); //Ищем id тек. пользователя.
$user = CUser::GetByID($userID)->Fetch();
if($user) {
    $photoID = $user['PERSONAL_PHOTO']; //Получаем ID Фотографии по ID пользователя.
    $photoPath = CFile::GetPath($photoID); //Получаем путь к файлу.

    if(!empty($photoID)){
        $originalPhotoFileName = CFile::GetFileArray($photoID)['ORIGINAL_NAME'];

    }
    $full_name = $user['NAME'] . ' ' . $user['LAST_NAME'];
    $user_login = $user['LOGIN'];
}


?>
<div class="user">
    <div class="user__photo">
        <img src="<?=$photoPath;?>" alt="<?=$full_name;?>">
    </div>
    <div class="user__caption">
        <p class="user__name">
          <?=$full_name;?>
        </p>
        <ul class="user__props">
            <li class="user__prop user__prop-nickname">
                <span class="user__prop-label">
                    Ник
                </span>
                <span class="user__prop-value">
                    <?=$user_login;?>
                </span>
                <a class="user__prop-edit" href="#modal-edit-nickname" data-modal>
                    Изменить
                </a>
            </li>
            <li class="user__prop user__prop_avatar">
                <span class="user__prop-label">
                    Аватар
                </span>
                <span class="user__prop-value">
                    <? if(!empty($photoID)): ?>
                        <?=$originalPhotoFileName;?>
                    <? endif; ?>
                </span>
                <a class="user__prop-edit" href="#modal-edit-avatar" data-modal>
                    Изменить
                </a>
            </li>
        </ul>
        <a class="user__logout" href="/personal/?logout=yes&amp;sessid=<?=bitrix_sessid()?>">
            Выйти из профиля
        </a>
    </div>
    <a class="nick_changed_succeful" href="#modal-edit-nickname-success" data-modal style="display:none;">
    </a>

    <a class="avatar_changed_succeful" href="#modal-edit-avatar-success" data-modal style="display:none;">
    </a>
</div>
<script>
    $(document).on('click', '#modal-edit-nickname button.ml-form__submit', function(event){
        event.preventDefault();
        if($('#modal-edit-nickname input[name="nickname"]').val() && $('#modal-edit-nickname input[name="nickname"]').val() != '') {
            $.ajax({
                url: '/include/ajax/profile/change_login.php',
                method: 'POST',
                data: {'USER_ID': <?=$userID;?>, 'LOGIN': $('#modal-edit-nickname input[name="nickname"]').val()},
                dataType: 'json',
                success: function (data) {
                    if(data.status){
                        $('a.nick_changed_succeful').click();
                        setTimeout(function(){
                            location.reload();
                        }, 2000);

                    } else {
                        alert(data.error_text);
                    }

                }
            });
        } else {
            alert('Введите ник!');
        }
    });

    $(document).on('click', '#modal-edit-avatar button.ml-form__submit', function(event){
        event.preventDefault();
        if($('#modal-edit-avatar input[name="avatar"]')[0] && $('#modal-edit-avatar input[name="avatar"]')[0].files[0]){
            var formData = new FormData();
            formData.append('file', $('#modal-edit-avatar input[name="avatar"]')[0].files[0]);
            formData.append('USER_ID', <?=$userID;?>);
            $.ajax({
                url: '/include/ajax/profile/change_avatar.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType:false,
                success: function (data) {
                    if(data.status){
                        $('a.avatar_changed_succeful').click();
                        setTimeout(function(){
                            location.reload();
                        }, 2000);

                    } else {
                        alert(data.error_text);
                    }

                }
            });
        } else {
            alert('Не загружен файл с компьютера');
        }
    });

    //$(document).on('submit', '#form-edit-avatar', function(event){
        //event.preventDefault();
        //return false;
    //});
</script>

<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>