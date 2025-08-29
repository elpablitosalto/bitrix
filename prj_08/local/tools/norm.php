<? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?
function splitSum($sum, $count, $minPrice, $maxPrice)
{
    $prices = array();

    if ($sum > ($count * $maxPrice) || $sum < $count || $sum < ($count * $minPrice))
        throw new \Exception('Wrong sum for split');

    $j = 0;
    for ($i = $count - 1; $i > 0; $i--) {
        $diff = $sum - $i * $maxPrice;

        if ($diff > 0)
            $prices[$j] = rand($minPrice, $maxPrice);
        else {
            if (($sum - ($i * $minPrice)) > $maxPrice) $max = $maxPrice;
            elseif (($sum - ($i * $minPrice)) <= 0) $max = $sum;
            else $max = $sum - ($i * $minPrice);

            $prices[$j] = rand($minPrice, $max);
        }

        if ($i > 1)
            $sum -= $prices[$j];

        $j++;
    }
    $prices[$j] = $sum - $prices[$j - 1];

    return $prices;
}

$ar = splitSum(882, 20, 15, 300);
//vardump( $ar );
foreach ($ar as $key => $val) {
    echo round(($val / 60), 2);
    echo '<br />';
}
?>
<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>