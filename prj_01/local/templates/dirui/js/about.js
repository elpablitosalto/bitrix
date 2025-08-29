function initCatalogHoverCategory() {
    $(".catalog-block .catalog-link-category__item").hover(
        ({currentTarget:target}) => {
            const id = target.dataset.catalogLinkId
            $('.catalog-link-category__img').removeClass("catalog-link-category--active")
            $(`.catalog-link-category__img[data-catalog-link-id="${id}"]`).addClass('catalog-link-category--active')
        },
        () => {}
    )
}
initCatalogHoverCategory();
