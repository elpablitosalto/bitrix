<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($_GET['login'] == 'yes' || $USER->IsAuthorized())
    LocalRedirect("/personal/");
CJSCore::Init();
?>
<section class="content">
    <div class="container _inside-page">
        <div class="breadcrumbs">
            <ul class="breadcrumbs-list">
                <li class="breadcrumbs-list__item"><a href="#">Главная</a></li>
                <li class="breadcrumbs-list__item">Вход</li>
            </ul>
        </div>
        <div class="register">
            <div class="form-wrapper auth-wrapper width-radio">
                <h1 class="form-title">ИНФОРМАЦИЯ ДЛЯ ВХОДА НА САЙТ</h1>
                <form id="registration-data" data-registration-form action="/local/ajax/personal/backend.php" autocomplete="off">
                    <input type="hidden" name="TYPE" value="registration">
                    <div class="step">         
                        <div class="form-wrapper__item">
                            <label>Заполните ваши личные данные</label>
                            <div class="radio-group">
                                <div class="radio-group__item _me">
                                    <p>Я </p>
                                </div>
                                <div class="radio-group__item _active">
                                    <input id="group-1" type="radio" data-form="1" checked name="GROUP" value="<?=MASTER?>">
                                    <label for="group-1">мастер</label>
                                </div>
                                <div class="radio-group__item">
                                    <input id="group-2" type="radio" data-form="2" name="GROUP" value="<?=TECH?>">
                                    <label for="group-2">технолог</label>
                                </div>
                                <div class="radio-group__item">
                                    <input id="group-3" type="radio" data-form="3" name="GROUP" value="<?=DISTRIBUTOR?>">
                                    <label for="group-3">дистрибьютор/проф.розница</label>
                                </div>
                            </div>
                        </div> 
                        <div class="personal-form-inputs _active" data-form="<?=MASTER?>">            
                            <div class="form-wrapper__item">
                                <label class="personal-name">Название салона или ФИО частного мастера*</label>
                                <input type="text" name="NAME" value="" required/>
                                <span class="error"></span>
                            </div>                                
                            <div class="form-wrapper__item _password">
                                <label>Пароль*</label>
                                <input type="password" name="PASS" value="" required/>
                                <button class="show-hide">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.92969 3.64685C8.62448 3.61384 8.31436 3.59492 8 3.59021C6.62633 3.59631 5.20236 3.93044 3.85449 4.57069C2.85372 5.06565 1.87885 5.76441 1.03223 6.62635C0.616427 7.06635 0.0857467 7.70344 0 8.38317C0.0101333 8.972 0.64204 9.69877 1.03223 10.14C1.82613 10.9681 2.77561 11.6469 3.85449 12.1957C3.89116 12.2135 3.92796 12.2311 3.96484 12.2484L2.96388 13.9964L4.32395 14.8003L11.6762 1.99981L10.367 1.19971L8.92969 3.64685ZM12.0342 4.51991L11.0351 6.25133C11.4947 6.84843 11.7676 7.58475 11.7676 8.38317C11.7676 10.3733 10.0806 11.9867 7.99901 11.9867C7.90903 11.9867 7.82181 11.977 7.73339 11.9711L7.07225 13.1156C7.37716 13.1483 7.68545 13.172 7.99999 13.1761C9.37496 13.17 10.7981 12.832 12.1445 12.1957C13.1453 11.7007 14.1211 11.002 14.9678 10.14C15.3836 9.70004 15.9142 9.06293 16 8.38317C15.9899 7.79436 15.3579 7.06759 14.9678 6.62633C14.1739 5.79825 13.2234 5.11949 12.1445 4.57067C12.1081 4.55301 12.0708 4.53713 12.0342 4.51991ZM7.99903 4.77968C8.09031 4.77968 8.18087 4.78333 8.27051 4.78944L7.49609 6.13025C6.40924 6.3506 5.59375 7.27532 5.59375 8.38221C5.59375 8.66027 5.64496 8.92647 5.73925 9.17321C5.73936 9.17349 5.73915 9.17392 5.73925 9.1742L4.96288 10.5189C4.5022 9.92128 4.23045 9.18253 4.23045 8.38316C4.23047 6.39309 5.91744 4.77967 7.99903 4.77968ZM10.2519 7.60681L8.50684 10.6303C9.58785 10.4058 10.3975 9.48525 10.3975 8.38221C10.3975 8.10923 10.343 7.84969 10.2519 7.60681Z" fill="#959595"/>
                                    </svg>
                                </button>
                                <span class="error"></span>
                            </div>                                        
                            <div class="form-wrapper__item">
                                <label>Регион/город работы*</label>
                                <input type="text" data-forimcity-init name="CITY" value="<?=$arUser['PERSONAL_CITY']?>" required/>
                                <input type="hidden" name="GEO_DATA" />
                                <span class="error"></span>
                            </div>    
                            <div class="form-wrapper__item">
                                <label>E-mail*</label>
                                <input type="email" name="EMAIL" value="" required autocomplete="off" placeholder="pochta@mail.ru"/>
                                <span class="error">E-mail введен не корректно</span>
                            </div>                                        
                            <div class="form-wrapper__item">
                                <label>Телефон*</label>
                                <input type="phone" name="PHONE" value="" required placeholder="+7 (_ _ _) _ _ _-_ _-_ _"/>
                                <span class="error"></span>
                            </div>  
                            <div class="form-wrapper__item form-wrapper__item-checkbox">
                                <input id="NEED_FEEDBACK" type="checkbox" value="Y" name="NEED_FEEDBACK">
                                <label for="NEED_FEEDBACK">Прошу связаться со мной торгового представителя</label>
                                <span class="error"></span>
                            </div>                                      
                        </div>                                        
                        <div class="personal-form-inputs" data-form="<?=TECH?>">            
                            <div class="form-wrapper__item">
                                <label class="personal-name">ФИО*</label>
                                <input type="text" name="NAME" value="" required/>
                                <span class="error"></span>
                            </div>                                
                            <div class="form-wrapper__item _password">
                                <label>Пароль*</label>
                                <input type="password" name="PASS" value="" required/>
                                <button class="show-hide">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.92969 3.64685C8.62448 3.61384 8.31436 3.59492 8 3.59021C6.62633 3.59631 5.20236 3.93044 3.85449 4.57069C2.85372 5.06565 1.87885 5.76441 1.03223 6.62635C0.616427 7.06635 0.0857467 7.70344 0 8.38317C0.0101333 8.972 0.64204 9.69877 1.03223 10.14C1.82613 10.9681 2.77561 11.6469 3.85449 12.1957C3.89116 12.2135 3.92796 12.2311 3.96484 12.2484L2.96388 13.9964L4.32395 14.8003L11.6762 1.99981L10.367 1.19971L8.92969 3.64685ZM12.0342 4.51991L11.0351 6.25133C11.4947 6.84843 11.7676 7.58475 11.7676 8.38317C11.7676 10.3733 10.0806 11.9867 7.99901 11.9867C7.90903 11.9867 7.82181 11.977 7.73339 11.9711L7.07225 13.1156C7.37716 13.1483 7.68545 13.172 7.99999 13.1761C9.37496 13.17 10.7981 12.832 12.1445 12.1957C13.1453 11.7007 14.1211 11.002 14.9678 10.14C15.3836 9.70004 15.9142 9.06293 16 8.38317C15.9899 7.79436 15.3579 7.06759 14.9678 6.62633C14.1739 5.79825 13.2234 5.11949 12.1445 4.57067C12.1081 4.55301 12.0708 4.53713 12.0342 4.51991ZM7.99903 4.77968C8.09031 4.77968 8.18087 4.78333 8.27051 4.78944L7.49609 6.13025C6.40924 6.3506 5.59375 7.27532 5.59375 8.38221C5.59375 8.66027 5.64496 8.92647 5.73925 9.17321C5.73936 9.17349 5.73915 9.17392 5.73925 9.1742L4.96288 10.5189C4.5022 9.92128 4.23045 9.18253 4.23045 8.38316C4.23047 6.39309 5.91744 4.77967 7.99903 4.77968ZM10.2519 7.60681L8.50684 10.6303C9.58785 10.4058 10.3975 9.48525 10.3975 8.38221C10.3975 8.10923 10.343 7.84969 10.2519 7.60681Z" fill="#959595"/>
                                    </svg>
                                </button>
                                <span class="error"></span>
                            </div>                                         
                            <div class="form-wrapper__item">
                                <label>Регион/город обслуживания*</label>
                                <input type="text" data-forimcity-init name="CITY" value="<?=$arUser['PERSONAL_CITY']?>" required/>
                                <input type="hidden" name="GEO_DATA" />
                                <span class="error"></span>
                            </div>   
                            <div class="form-wrapper__item">
                                <label>E-mail*</label>
                                <input type="email" name="EMAIL" value="" required placeholder="pochta@mail.ru"/>
                                <span class="error">E-mail введен не корректно</span>
                            </div>                                        
                            <div class="form-wrapper__item">
                                <label>Телефон*</label>
                                <input type="phone" name="PHONE" value="" required placeholder="+7 (_ _ _) _ _ _-_ _-_ _"/>
                                <span class="error"></span>
                            </div>                                         
                        </div>                                        
                        <div class="personal-form-inputs" data-form="<?=DISTRIBUTOR?>">            
                            <div class="form-wrapper__item">
                                <label class="personal-name">ФИО контактного лица*</label>
                                <input type="text" name="NAME" value="" required/>
                                <span class="error"></span>
                            </div>                                
                            <div class="form-wrapper__item">
                                <label class="personal-name">Должность контактного лица*</label>
                                <input type="text" name="POSITION" value="" required/>
                                <span class="error"></span>
                            </div>                                          
                            <div class="form-wrapper__item">
                                <label>Регион/город обслуживания*</label>
                                <input type="text" data-forimcity-init name="CITY" value="<?=$arUser['PERSONAL_CITY']?>" required/>
                                <input type="hidden" name="GEO_DATA" />
                                <span class="error"></span>
                            </div>                           
                            <div class="form-wrapper__item _password">
                                <label>Пароль*</label>
                                <input type="password" name="PASS" value="" required/>
                                <button class="show-hide">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.92969 3.64685C8.62448 3.61384 8.31436 3.59492 8 3.59021C6.62633 3.59631 5.20236 3.93044 3.85449 4.57069C2.85372 5.06565 1.87885 5.76441 1.03223 6.62635C0.616427 7.06635 0.0857467 7.70344 0 8.38317C0.0101333 8.972 0.64204 9.69877 1.03223 10.14C1.82613 10.9681 2.77561 11.6469 3.85449 12.1957C3.89116 12.2135 3.92796 12.2311 3.96484 12.2484L2.96388 13.9964L4.32395 14.8003L11.6762 1.99981L10.367 1.19971L8.92969 3.64685ZM12.0342 4.51991L11.0351 6.25133C11.4947 6.84843 11.7676 7.58475 11.7676 8.38317C11.7676 10.3733 10.0806 11.9867 7.99901 11.9867C7.90903 11.9867 7.82181 11.977 7.73339 11.9711L7.07225 13.1156C7.37716 13.1483 7.68545 13.172 7.99999 13.1761C9.37496 13.17 10.7981 12.832 12.1445 12.1957C13.1453 11.7007 14.1211 11.002 14.9678 10.14C15.3836 9.70004 15.9142 9.06293 16 8.38317C15.9899 7.79436 15.3579 7.06759 14.9678 6.62633C14.1739 5.79825 13.2234 5.11949 12.1445 4.57067C12.1081 4.55301 12.0708 4.53713 12.0342 4.51991ZM7.99903 4.77968C8.09031 4.77968 8.18087 4.78333 8.27051 4.78944L7.49609 6.13025C6.40924 6.3506 5.59375 7.27532 5.59375 8.38221C5.59375 8.66027 5.64496 8.92647 5.73925 9.17321C5.73936 9.17349 5.73915 9.17392 5.73925 9.1742L4.96288 10.5189C4.5022 9.92128 4.23045 9.18253 4.23045 8.38316C4.23047 6.39309 5.91744 4.77967 7.99903 4.77968ZM10.2519 7.60681L8.50684 10.6303C9.58785 10.4058 10.3975 9.48525 10.3975 8.38221C10.3975 8.10923 10.343 7.84969 10.2519 7.60681Z" fill="#959595"/>
                                    </svg>
                                </button>
                                <span class="error"></span>
                            </div>     
                            <div class="form-wrapper__item">
                                <label>E-mail*</label>
                                <input type="email" name="EMAIL" value="" required placeholder="pochta@mail.ru"/>
                                <span class="error">E-mail введен не корректно</span>
                            </div>                                        
                            <div class="form-wrapper__item">
                                <label>Телефон*</label>
                                <input type="phone" name="PHONE" value="" required placeholder="+7 (_ _ _) _ _ _-_ _-_ _"/>
                                <span class="error"></span>
                            </div>                                         
                        </div>                                        
                    </div>
                    <div class="step">
                        <div class="form-wrapper__item">
                            <button class="button _auto">Зарегистрироваться</button> <!-- для показа/скрытия блоков рулить классом _hidden и смотреть за data-атрибутами -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>