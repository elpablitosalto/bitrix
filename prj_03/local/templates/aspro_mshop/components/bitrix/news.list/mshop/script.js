$(document).ready(function () {
    $(".img").each(function () {
        $(this).hover(function () {
            var hover = $(this).find("img").attr("data-hover");
            $(this).find("img").attr("src", hover);
        }, function () {
            var src = $(this).find("img").attr("data-src");
            $(this).find("img").attr("src", src);
        });
    });
});