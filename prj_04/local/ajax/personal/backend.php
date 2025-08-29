<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Hair\Personal;

/*d($_POST);
die();*/
global $USER;
$personal = new Personal($_POST,$_FILES,$USER);
switch($_POST['TYPE']){
   case 'salon':
      $result = $personal->salonInfoAction();
      break;
   case 'tech':
      $result = $personal->techInfoAction();
      break;
   case 'distributor':
      $result = $personal->distributorhInfoAction();
      break;
   case 'registration':
      $result = $personal->register();
      break;
   case 'auth':
      $result = $personal->auth();
      break;
   default:
      $result = $personal->editPersonalData();
      break;   
}


echo json_encode($result);
?>