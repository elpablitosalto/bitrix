function homeMapInit() {
    $(".distributors__map-balloon-img").click(
        ({currentTarget: target}) => {
            const container = $(target).closest('.distributors__map-balloon')
            const modalContent = container.find(".map-info")
            if (window.innerWidth < 768) {
                const target = $(".distributors__map-mob-modal")
                target.html('').append(modalContent.clone()).removeClass('display-none')
                $(".map-info__close").click(() => $('.distributors__map-mob-modal').addClass('display-none'))
            }
            else {
                if (container.hasClass('map-balloon-open')) {
                    container.removeClass('map-balloon-open')
                } else {
                    $('.distributors__map-balloon').removeClass('map-balloon-open')
                    container.addClass('map-balloon-open')
                    const leftOffset = Number(Math.round(modalContent.offset().left))
                    const offset = Number(modalContent.css('left').replace('px', ''))
                    const modalOffset = Number(modalContent.outerWidth() + leftOffset)
                    const balloons = $(".distributors__map-balloons")
                    const balloonsOffset = Number(balloons.outerWidth() + balloons.offset().left)
                    if (modalOffset > balloonsOffset) {
                        modalContent.css({left: `${offset - (modalOffset - balloonsOffset)}px`})
                    }
                    if (leftOffset < 0) {
                        modalContent.css({left: `${offset + Math.abs(leftOffset)}px`})
                    }
                }
            }

        }
    )
    $(".map-info__close").click(() => $('.distributors__map-balloon').removeClass('map-balloon-open'))
}
homeMapInit();
