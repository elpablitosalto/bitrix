<?
// Загрузка скриптов через JS по событию скролла страницы -->
?>
<script async>
    var loadScripts = true;
    $(document).ready(function() {
        $(document).on({
            'scroll touchstart mouseenter click': function() {
                loadJsOnScroll();
            }
        });
    });

    function loadJsOnScroll() {
        if (loadScripts == true) {
            //$.getScript("https://use.fontawesome.com/330b84a353.js");
            loadScripts = false;
        }
    }
</script>
<?
// <-- Загрузка скриптов через JS по событию скролла страницы
?>