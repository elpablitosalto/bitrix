$(document).ready(function () {
    console.log("custom template script is ready");
    // избранное
    function updateNumbeOfFavorites(quantity){
        let favoriteCounter = $('.js-favorite-count');
        if(favoriteCounter){
            favoriteCounter.html(quantity);
        }
    }

    function initFavoriteHandlers(){
        $(document.body).off("click", ".js-toggle-favorite");
        $(document.body).on("click", ".js-toggle-favorite", function () {
            let wrapper = $(this);
            let productId  = parseInt($(this).parents('[data-product-id]').data('product-id'));
            if(productId) {
                window.BX.ajax.runComponentAction("waim:sale.favorites.ajax", "toggleFavorite", {
                    mode: 'class',
                    data: {
                        productId: productId
                    }
                }).then(function (result) {
                    console.log('result', result);
                    if (typeof result.data !== 'undefined') {
                        if (typeof result.status !== 'undefined') {
                            if (result.status === 'success') {
                                let evt = new CustomEvent('favorite_add', {detail: {}});
                                document.dispatchEvent(evt);
                                wrapper.find('.button__holder').toggleClass('is-favorite');
                            }
                        } else {
                            console.log('Произошла ошибка добавления товара в корзину')
                        }
                        var quantity = result.data.quantity || 0;
                        updateNumbeOfFavorites(quantity);
                    }
                }).catch(function () {
                    console.log('Произошла ошибка добавления товара в корзину')
                    // Ошибки
                });
            }
        });
    }

    initFavoriteHandlers();
    BX.addCustomEvent('onAjaxSuccess', function(){
        initFavoriteHandlers();
    });
	window.addEventListener('popstate', function () {
        setTimeout(function () {
            initFavoriteHandlers();
        }, 100);
    });
});