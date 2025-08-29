<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<?
// Вывод заголовка для десктопа -->
if (strlen($item["H_FST_PART_D"]) > 0) {
?>
    <h2 class="nb-section__title desktop">
        <?
        echo $item["H_FST_PART_D"];
        if (strlen($item["H_SEC_PART_D"]) > 0) {
        ?> <span class="font-weight_normal">
                <?= $item["H_SEC_PART_D"]; ?>
            </span>
        <?
        }
        ?>
    </h2>
<?
}
// <-- Вывод заголовка для десктопа

// Вывод заголовка для мобильного -->
if (strlen($item["H_FST_PART_M"]) > 0) {
?>
    <p class="nb-section__title mobile">
        <?
        echo $item["H_FST_PART_M"];
        if (strlen($item["H_SEC_PART_M"]) > 0) {
        ?> <span class="font-weight_normal">
                <?= $item["H_SEC_PART_M"]; ?>
            </span>
        <?
        }
        ?>
    </p>
<?
}
// <-- Вывод заголовка для мобильного
?>