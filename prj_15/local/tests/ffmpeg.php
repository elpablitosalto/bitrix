<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>
<?
$file_name = $_SERVER["DOCUMENT_ROOT"].'/upload/iblock/74d/ffe9sbdejkcp5iuhg1o34b20po7a0djt.mp4';
    $cut_from = 1;
    $duration = 10;

    $command = "/usr/bin/ffmpeg -i " . $file_name . " -vcodec copy -ss " . $cut_from . " -t " . $duration . ' ' . $_SERVER["DOCUMENT_ROOT"].'/upload/iblock/74d/ffe9sbdejkcp5iuhg1o34b20po7a0djt_short.mp4';
    $res = system($command);
echo 'command = '.$command.'<br />';
echo 'res = '.$res.'<br />';
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>