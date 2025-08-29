$(document).ready(function () {
  videoPageSliderInit();
  fullPageSliderInit();
  //abroadSliderInit();
  defaultSliderInit();
  filterSliderInit();
  mobileSearchActivate();
  mobileMenuActivate();
  mobileMenuDropDown();
  footerMobileShow();
  tabsInit();
  selectInit();
  defaultFormCheckboxChangeInit();
  filterCatalogInit();
  filterCheckboxChangeInit();
  imagePopupInit();
  catalogPageMobileInit();
  detailProductSliderInit();
  detailProductVolumeInit();
  phoneBlockHideInit();
  lookBookSliderInit();
  lookBookRedesignedSliderInit();
  seminarsFilterInit();
  personalTabsInit();
  personalEditButtonsInit();
  personalDownloadsTabsInit();
  searchPageInit();
  sertificatesSliserInit();
  popupInit();
  getOrderInit();
  videoPopupInit();
  seminarName();
  newsMobileSlider();
});

// Загрузка по скроллу -->
var loadScroll_abroad = true;
$(document).ready(function () {
  $(document).on({
    'scroll touchstart mouseenter click': function () {
      loadOnScroll_abroad();
    }
  });
});

function loadOnScroll_abroad() {
  if (loadScroll_abroad == true) {
    SliderInit_abroad();
    loadScroll_abroad = false;
  }
}

function SliderInit_abroad() {
  abroadSliderInit()
}
// <-- Загрузка по скроллу 

function abroadSliderInit() {
  $('body').find('[data-abroad-slider]').each(function () {
    let id = '#' + $(this).attr('id');
    let navigationWrapper = '[data-filter="' + $(this).attr('id') + '"]';
    /*
    var lazy = false;
    if ($(this).data('lazy')) {
      var lazy = true;
    }
    */
    var abroadSlider = new Swiper(id, {
      //lazy: lazy,
      slidesPerView: 4,
      spaceBetween: 40,
      navigation: {
        nextEl: id + ' .swiper-button-next',
        prevEl: id + ' .swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        560: {
          slidesPerView: 2,
          spaceBetween: 20
        },
        800: {
          slidesPerView: 3,
          spaceBetween: 30
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 40
        }
      }
    });
  });
}



function videoPageSliderInit() {
  var defaultDuration, duration;
  console.log('videoPageSliderInit');
  $('body').find('[data-video-page-slider]').each(function () {
    let id = '#' + $(this).attr('id');
    let $sliderContainer = $(this);
    $(this).find('video').each(function () {
      var duration = parseInt($(this).get(0).duration) * 1000;
      $(this).closest('.swiper-slide').attr('data-swiper-autoplay', duration);
    });
    $(this).find('iframe').each(function () {
      var duration = $(this).data('duration');
      $(this).closest('.swiper-slide').attr('data-swiper-autoplay', duration);
    });
    setTimeout(function () {
      var topPageSlider = new Swiper(id, {
        pagination: {
          el: id + ' .swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: id + ' .swiper-button-next',
          prevEl: id + ' .swiper-button-prev',
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false
        },
        on: {
          init: function (swiper) {
            if ($sliderContainer.find('.swiper-slide').eq(swiper.activeIndex).find('iframe').length > 0) {
              var $video = $sliderContainer.find('.swiper-slide').eq(swiper.activeIndex).find('iframe');
              var src = $video.attr('src');
              $video.attr('src', src + '&autoplay=1');
            }
            if ($sliderContainer.find('.swiper-slide').eq(swiper.activeIndex).find('video').length > 0) {
              var $video = $sliderContainer.find('.swiper-slide').eq(swiper.activeIndex).find('video').get(0);
              $video.pause();
              $video.currentTime = 0;
              $video.play();
            }
          },
          slideChangeTransitionStart: function (swiper) {
            if ($sliderContainer.find('.swiper-slide').eq(swiper.activeIndex).find('iframe').length > 0) {
              var $video = $sliderContainer.find('.swiper-slide').eq(swiper.activeIndex).find('iframe');
              var src = $video.attr('src');
              $video.attr('src', src + '&autoplay=1');
            }
            if ($sliderContainer.find('.swiper-slide').eq(swiper.activeIndex).find('video').length > 0) {
              var $video = $sliderContainer.find('.swiper-slide').eq(swiper.activeIndex).find('video').get(0);
              $sliderContainer.find('.swiper-slide').attr('data-swiper-autoplay', $video.duration * 1000);
              $video.pause();
              $video.currentTime = 0;
              $video.play();
            }
          }
        }
      });
    });
  }, 500);
}
function fullPageSliderInit() {
  $('body').find('[data-full-page-slider]').each(function () {
    let id = '#' + $(this).attr('id');
    var fullPageSlider = new Swiper(id, {
      pagination: {
        el: id + ' .swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: id + ' .swiper-button-next',
        prevEl: id + ' .swiper-button-prev',
      },
    });
  });
}



function defaultSliderInit() {
  $('body').find('[data-default-slider]').each(function () {
    let id = '#' + $(this).attr('id');
    let navigationWrapper = '[data-filter="' + $(this).attr('id') + '"]';
    var defaultSlider = new Swiper(id, {
      slidesPerView: 4,
      spaceBetween: 20,
      navigation: {
        nextEl: navigationWrapper + ' .swiper-button-next',
        prevEl: navigationWrapper + ' .swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: "auto",
          spaceBetween: 20
        },
        992: {
          slidesPerView: 4,
          spaceBetween: 40
        }
      }
    });
  });
}
function newsMobileSlider() {
  $('body').find('[data-mobile_news-slider]').each(function () {
    var swiper = new Swiper(".newsMobileSwiper", {
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        576: {
          slidesPerView: 2,
          spaceBetween: 40
        }
      }
    });
  });
}
function filterSliderInit() {
  $('body').find('.filter .filter__button').click(function () {
    $(this).addClass('_active').siblings().removeClass('_active');
    if ($(this).parent().data('filter')) {
      var filter = $(this).parent().data('filter');
      var type = $(this).data('filter-type');

      $('#' + filter).find('[data-filter-type]').each(function () {
        if (type == 'all') {
          $(this).removeClass('_inactive');
        } else {
          if ($(this).data('filter-type') != type)
            $(this).addClass('_inactive');
          else
            $(this).removeClass('_inactive');
        }

      });

      defaultSliderInit();
    }
  });
}

function mobileSearchActivate() {
  $('body').find('.search-block__mobile-activate').click(function () {
    $(this).toggleClass('_active');
    $(this).parent().find('.search-block').toggleClass('_active');
  });
}

function mobileMenuActivate() {
  $('body').find('.mobile-menu .mobile-menu__button').click(function () {
    $('body').toggleClass('_fixed');
    $(this).toggleClass('_active');
    $(this).parent().find('.mobile-menu__wrapper').toggleClass('_active');
  });
}

function mobileMenuDropDown() {
  $('body').find('.mobile-menu .main-menu__item').click(function (e) {
    if ($(this).find('.dd-menu').length && !$(this).hasClass('_active')) {
      e.preventDefault();
      $(this).toggleClass('_active');
    }
  });
}
function seminarName() {
  $('body').find(`[href="#learning"]`).click(function (e) {
    var seminarName = $(this).attr("seminar-name");
    var seminarType = $(this).attr("seminar-type");
    var text = $('#seminar-name').text();
    $('#seminar-name').text(text + " " + seminarType + ' "' + seminarName + '"');
  });
}

function footerMobileShow() {
  $('body').find('.top-footer__menu-mobile-title').click(function (e) {
    e.preventDefault();
    $(this).fadeOut(0);
    $(this).parent().find('.top-footer__menu-list').slideDown(300);
  });
}

function tabsInit() {
  $('body').find('.tabs .tabs-buttons-wrapper__button').click(function (e) {
    $(this).addClass('_active').siblings().removeClass('_active');
    let tabNum = $(this).data('tab') - 1;
    $(this).parents('.tabs').find('.tabs-item').eq(tabNum).addClass('_active').siblings().removeClass('_active');
    $('body').find('.tabs .all-items').css('display', 'none');
    $('body').find('.tabs .current-select-item').css('display', 'block');
  });
}
function selectInit() {
  //$('body').find('select').selectize();
}

function defaultFormCheckboxChangeInit() {
  $('body').on('change', '.form-wrapper__item-checkbox input[type="checkbox"]', function () {
    $(this).parents('.form-wrapper__item-checkbox').toggleClass('_active');
  });
}


function filterCatalogInit() {
  $('body').on('click', '.catalog-filter__item', function () {
    $(this).toggleClass('_active');
  });

  if (window.innerWidth < 992) {
    $('.catalog-filter__item').each(function () {
      $(this).addClass('_active');
    });
  }

  $(document).mouseup(function (e) { // событие клика по веб-документу
    var div = $(".catalog-filter__item"); // тут указываем ID элемента
    if (!div.is(e.target) // если клик был не по нашему блоку
      && div.has(e.target).length === 0) { // и не по его дочерним элементам
      div.removeClass('_active'); // скрываем его
    }
  });

}

function filterCheckboxChangeInit() {
  $('body').on('change', '.catalog-filter__item--checkbox input[type="checkbox"]', function () {
    $(this).parents('.catalog-filter__item--checkbox').toggleClass('_active');
  });
}

function imagePopupInit() {
  $('[data-image-popup]').magnificPopup({
    type: 'image',
    removalDelay: 300,
    mainClass: 'mfp-fade'
  });
}

function videoPopupInit() {
  $('[data-youtube]').magnificPopup({
    removalDelay: 300,
    type: 'iframe',
    mainClass: 'mfp-fade',
    preloader: false,
    fixedContentPos: false,
    iframe: {
      markup: '<div class="mfp-iframe-scaler">' +
        '<div class="mfp-close"></div>' +
        '<iframe class="mfp-iframe" frameborder="0"  allow="autoplay" allowfullscreen></iframe>' +
        '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close butto
      patterns: {
        youtube: {
          index: 'youtu.be/',
          id: function (url) {
            var m = url.split('be/');
            if (!m || !m[1]) return null;
            return m[1];
          },
          src: 'https://www.youtube.com/embed/%id%?autoplay=1'
        },
      }
    }
  });
}

function catalogPageMobileInit() {
  if ($('.mobile-catalog-tabs') && window.innerWidth < 992) {
    $('.sections').addClass('_active');

    $('body').find('.mobile-catalog-tabs .mobile-catalog-tabs__button').click(function (e) {
      $(this).addClass('_active').siblings().removeClass('_active');
      $('body').find('[data-mobile-tab=' + $(this).data('mobile-tab') + ']').addClass('_active').siblings().removeClass('_active');
    });

    $('.mobile-filter-button').click(function (e) {
      $('.catalog-filter-form-container').toggleClass('_active');
      $('.mobile-catalog-tabs').toggleClass('_filter-active');
    });

    $(document).mouseup(function (e) { // событие клика по веб-документу
      var div = $(".catalog-filter-form-container"); // тут указываем ID элемента
      var parent = $(".mobile-catalog-tabs"); // тут указываем ID элемента
      if (!div.is(e.target) // если клик был не по нашему блоку
        && div.has(e.target).length === 0) { // и не по его дочерним элементам
        div.removeClass('_active'); // скрываем его
        parent.removeClass('_filter-active'); // скрываем его
      }
    });

  }
}

function detailProductSliderInit() {
  var galleryThumbs = new Swiper('.product-detail__photos--slider-thumbs', {
    spaceBetween: 20,
    slidesPerView: 3,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
  });
  var galleryTop = new Swiper('.product-detail__photos--slider', {
    spaceBetween: 10,
    navigation: {
      nextEl: '.product-detail__photos-next',
      prevEl: '.product-detail__photos-prev',
    },
    thumbs: {
      swiper: galleryThumbs
    },
    pagination: {
      el: '.product-detail__photos--pagination',
      clickable: true
    }
  });
}

function detailProductVolumeInit() {
  $('.product-detail__volume-item input').change(function (e) {
    $(this).closest('.product-detail__volume-item').toggleClass('_active').siblings().removeClass('_active');
  });
}

function phoneBlockHideInit() {
  $('body').on('click', '.phone-block p', function (e) {
    $(this).closest('.phone-block').addClass('_showed');
  });
}
function lookBookSliderInit() {
  var lookBookSlider = new Swiper('#lookBookDetail', {
    slidesPerView: 'auto',
    initialSlide: 3,
    slideToClickedSlide: true,
    loop: true,
    breakpoints: {
      320: {
        allowTouchMove: true
      },
      992: {
        allowTouchMove: false,
        centeredSlides: true
      }
    }
  });
}
function lookBookRedesignedSliderInit() {
  var lookBookRedesignedSlider = new Swiper('#lookBookDetailRedesign', {
    slidesPerView: 'auto',
    slidesPerGroup: 1,
    slideToClickedSlide: true,
    loop: false,
    allowTouchMove: true,
    spaceBetween: 20,
    breakpoints: {
      992: {
        slidesPerView: 3,
        allowTouchMove: false
      }
    }
  });
}

function seminarsFilterInit() {
  $('.mobile-filter-button').click(function (e) {
    $('.seminars-list__filter').toggleClass('_active');
    $('.seminars-list').toggleClass('_filter-active');
  });

  $(document).mouseup(function (e) { // событие клика по веб-документу
    var div = $(".seminars-list__filter"); // тут указываем ID элемента
    var parent = $(".seminars-list"); // тут указываем ID элемента
    if (!div.is(e.target) // если клик был не по нашему блоку
      && div.has(e.target).length === 0) { // и не по его дочерним элементам
      div.removeClass('_active'); // скрываем его
      parent.removeClass('_filter-active'); // скрываем его
    }
  });
}

function personalTabsInit() {
  if (window.innerWidth < 992) {
    $('.personal-content .personal-content__item, .personal-menu .personal-menu__item').each(function () {
      $(this).removeClass('_active');
    })
    $('body').on('click', '.personal-mobile-navigation[data-level="1"]', function (e) {
      e.preventDefault();
      $('.personal').removeClass('_mobile-visible');
    });
  }

  $('body').on('click', '.personal-menu__item', function (e) {
    let tab = $(this).data('tab');
    //window.location.hash = tab;
    window.history.pushState({}, "tab", '#' + tab);
    $(this).addClass('_active').siblings().removeClass('_active');
    $('.personal-content').find('[data-tab="' + tab + '"]').addClass('_active').siblings().removeClass('_active');

    if (window.innerWidth < 992) {
      $('.personal').addClass('_mobile-visible');
    }
  });
}

function personalEditButtonsInit() {
  $('body').on('click', '[data-edit-button]', function (e) {
    e.preventDefault();
    let $personaContentItem = $('.personal-content__item');
    let openedBlock = $(this).data('edit-button');
    let $parent = $(this).closest('.personal-content__item-row');
    $parent.addClass('_hidden');
    $personaContentItem.find('[data-edit-block="' + openedBlock + '"]').removeClass('_hidden');

    $([document.documentElement, document.body]).animate({
      scrollTop: $personaContentItem.find('[data-edit-block="' + openedBlock + '"]').offset().top - 50
    }, 500);
  });
}

function personalDownloadsTabsInit() {
  if (window.innerWidth < 992) {
    $('body').on('click', '.personal-mobile-navigation[data-level="2"]', function (e) {
      e.preventDefault();
      $(this).attr('data-level', 1);
      $('.slide-toggle-container').removeClass('_mobile-visible');
    });
  }

  $('body').on('click', '.slide-toggle-buttons__item', function (e) {
    let tab = $(this).data('download-tab');
    $(this).addClass('_active').siblings().removeClass('_active');
    $('.slide-toggle-content').find('[data-download-content="' + tab + '"]').addClass('_active').siblings().removeClass('_active');

    if (window.innerWidth < 992) {
      $('.slide-toggle-container').addClass('_mobile-visible');
      $('.slide-toggle-container').closest('.personal-content__item').find('.personal-mobile-navigation').attr('data-level', 2);
    }
  });

  $('body').on('click', '.slide-toggle-content__item-button', function (e) {
    $(this).toggleClass('_active').next().slideToggle(300);
  });
}
function searchPageInit() {
  if (window.innerWidth < 992) {
    var searchProductsSlider = new Swiper('#searchProducts', {
      slidesPerView: 'auto'
    });
  }

  $('.search-tabs button').click(function (e) {
    e.preventDefault();
    var blockID = $(this).data("result-block-button");
    $(this).addClass('_active').siblings().removeClass('_active');
    $('html,body').stop().animate({ scrollTop: $('[data-result-block="' + blockID + '"]').offset().top - 100 }, 1000);
  })
}

function popupInit() {
  $('[data-popup]').magnificPopup({
    type: 'inline',
    midClick: true,
    removalDelay: 300,
    mainClass: 'mfp-fade',
    callbacks: {
      open: function () {
        if (typeof initCaptcha != 'undefined') {
          initCaptcha();
        }
      },
    }
  });
}

function sertificatesSliserInit() {
  var sertificatesSlider = new Swiper('.sertificates', {
    breakpoints: {
      320: {
        slidesPerView: 2,
        spaceBetween: 15
      },
      992: {
        slidesPerView: 'auto',
        spaceBetween: 40
      }
    }
  });
}

function getOrderInit() {
  $('.order-product__cnt input').keyup(function () {
    var val = $(this).val();
    if (val.length > 1 && val[0] == '0')
      $(this).val(val.substr(1));
  });

  $('.order-product__cnt input').blur(function () {
    var val = $(this).val();
    if (val.length == 0)
      $(this).val(0);
  });

  $('.order-product__cnt input').focus(function () {
    var val = $(this).val();
    if (val == 0)
      $(this).val('');
  });

  $('body').on('click', '.plus', function (e) {
    e.preventDefault()
    let $input = $(this).closest('.order-product__cnt').find('input');
    var cnt = parseInt($input.val());

    if (cnt + 1 >= parseInt($input.attr('max'))) {
      $(this).removeClass('_active');
      return false;
    }
    else {
      if (!$(this).hasClass('_active')) $(this).addClass('_active');
      if (cnt + 1 > 0 && !$(this).closest('.order-product__cnt').find('.minus').hasClass('_active')) $(this).closest('.order-product__cnt').find('.minus').addClass('_active');
    }

    $input.val(cnt + 1)
  })

  $('body').on('click', '.minus', function (e) {
    e.preventDefault()
    let $input = $(this).closest('.order-product__cnt').find('input');
    var cnt = parseInt($input.val());

    if (cnt - 1 < 0) return false;

    if (cnt - 1 == 0)
      $(this).removeClass('_active')
    else
      if (!$(this).hasClass('_active')) $(this).addClass('_active');

    $input.val(cnt - 1)
  })
}