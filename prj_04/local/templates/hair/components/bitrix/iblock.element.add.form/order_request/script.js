$(document).ready(function () {
    $('[data-forimadress-init]').suggestions({
        token: "35feed8928f54feb9655ce38286c870137aa1bce",
        type: "ADDRESS",
        minChars: 3,
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
            console.log(suggestion.data);
        }
    });
});