<?
AddEventHandler('main', 'OnEpilog', array('CMainHandlers', 'OnEpilogHandler'));
class CMainHandlers {
  public static function OnEpilogHandler() {
      if (isset($_GET['PAGEN_1']) && (intval($_GET['PAGEN_1'])>0) && (!defined('ERROR_404')) ) {
        //h1
        $GLOBALS['APPLICATION']->SetTitle($GLOBALS['APPLICATION']->GetTitle(false).'. Страница '.intval($_GET['PAGEN_1']));
        //title
        $title = $GLOBALS['APPLICATION']->GetProperty('title');
        $GLOBALS['APPLICATION']->SetPageProperty('title', $title.'. Страница '.intval($_GET['PAGEN_1']));
        //description
        $description = $GLOBALS['APPLICATION']->GetProperty('description');
        $GLOBALS['APPLICATION']->SetPageProperty('description', $description.'. Страница '.intval($_GET['PAGEN_1']));
      }

      if (isset($_GET['PAGEN_2']) && (intval($_GET['PAGEN_2'])>0) && (!defined('ERROR_404')) ) {
        //h1
        $GLOBALS['APPLICATION']->SetTitle($GLOBALS['APPLICATION']->GetTitle(false).'. Страница '.intval($_GET['PAGEN_2']));
        //title
        $title = $GLOBALS['APPLICATION']->GetProperty('title');
        $GLOBALS['APPLICATION']->SetPageProperty('title', $title.'. Страница '.intval($_GET['PAGEN_2']));
        //description
        $description = $GLOBALS['APPLICATION']->GetProperty('description');
        $GLOBALS['APPLICATION']->SetPageProperty('description', $description.'. Страница '.intval($_GET['PAGEN_2']));
      }

      if (isset($_GET['PAGEN_3']) && (intval($_GET['PAGEN_3'])>0) && (!defined('ERROR_404')) ) {
        //h1
        $GLOBALS['APPLICATION']->SetTitle($GLOBALS['APPLICATION']->GetTitle(false).'. Страница '.intval($_GET['PAGEN_3']));
        //title
        $title = $GLOBALS['APPLICATION']->GetProperty('title');
        $GLOBALS['APPLICATION']->SetPageProperty('title', $title.'. Страница '.intval($_GET['PAGEN_3']));
        //description
        $description = $GLOBALS['APPLICATION']->GetProperty('description');
        $GLOBALS['APPLICATION']->SetPageProperty('description', $description.'. Страница '.intval($_GET['PAGEN_3']));
      }

      if (isset($_GET['PAGEN_4']) && (intval($_GET['PAGEN_4'])>0) && (!defined('ERROR_404')) ) {
        //h1
        $GLOBALS['APPLICATION']->SetTitle($GLOBALS['APPLICATION']->GetTitle(false).'. Страница '.intval($_GET['PAGEN_4']));
        //title
        $title = $GLOBALS['APPLICATION']->GetProperty('title');
        $GLOBALS['APPLICATION']->SetPageProperty('title', $title.'. Страница '.intval($_GET['PAGEN_4']));
        //description
        $description = $GLOBALS['APPLICATION']->GetProperty('description');
        $GLOBALS['APPLICATION']->SetPageProperty('description', $description.'. Страница '.intval($_GET['PAGEN_4']));
      }

      if (isset($_GET['PAGEN_25']) && (intval($_GET['PAGEN_25'])>0) && (!defined('ERROR_404')) ) {

        $title = $GLOBALS['APPLICATION']->GetProperty('title');
        $GLOBALS['APPLICATION']->SetPageProperty('title', $title.'. Страница '.intval($_GET['PAGEN_25']));
        //description
        $description = $GLOBALS['APPLICATION']->GetProperty('description');
        $GLOBALS['APPLICATION']->SetPageProperty('description', $description.'. Страница '.intval($_GET['PAGEN_25']));
     }
  }
}