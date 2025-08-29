$(function() {
    $('.header__social a[href*="wa.me"], .contacts__button-messenger[href*="wa.me"], .article__contact-list a[href*="web.whatsapp.com"]').on('click', function() {
        ym(16721107,'reachGoal','whatsapp');

        gtag('event', 'click_whatsapp', {
            'event_category': 'messenger',
            'event_label': 'whatsapp'
        });
    });

    $('.header__social a[href*="t.me"], .contacts__button-messenger[href*="t.me"], .article__contact-list a[href*="telegram.me"]').on('click', function() {
        ym(16721107,'reachGoal','telegram');

        gtag('event', 'click_telegram', {
            'event_category': 'messenger',
            'event_label': 'telegram'
        });
    });

    $('.footer-main__social-item a[href*="vk.com"]').on('click', function() {
        ym(16721107,'reachGoal','vk');

        gtag('event', 'click_vk', {
            'event_category': 'smm',
            'event_label': 'vk'
        });
    });

    $('.footer-main__social-item a[href*="t.me"]').on('click', function() {
        ym(16721107,'reachGoal','channel-tg');

        gtag('event', 'channel_tg', {
            'event_category': 'smm',
            'event_label': 'tg'
        });
    });

    $('.footer-main__social-item a[href*="youtube.com"]').on('click', function() {
        ym(16721107,'reachGoal','channel-youtube');

        gtag('event', 'channel_youtube', {
            'event_category': 'smm',
            'event_label': 'youtube'
        });
    });

    $('.footer-main__social-item a[href*="rutube.ru"]').on('click', function() {
        ym(16721107,'reachGoal','channel-rutube');

        gtag('event', 'channel_rutube', {
            'event_category': 'smm',
            'event_label': 'rutube'
        });
    });

    $('.card-main__reviews-button').on('click', function() {
        ym(16721107,'reachGoal','feedback');

        gtag('event', 'otpravit', {
            'event_category': 'forma',
            'event_label': 'feedback'
        });
    });

    $('.card-main__questions-button').on('click', function() {
        ym(16721107,'reachGoal','questions-and-answers');

        gtag('event', 'otpravit', {
            'event_category': 'forma',
            'event_label': 'questions_and_answers'
        });
    });

    $('.marketplace__item a[href*="ozon.ru"], .footer-main__markets-item a[href*="ozon.ru"], .card-title__marketplace-item a[href*="ozon.ru"]').on('click', function() {
        ym(16721107,'reachGoal','ozonclick');

        gtag('event', 'click_ozon', {
            'event_category': 'marketplace',
            'event_label': 'ozon'
        });
    });

    $('.marketplace__item a[href*="wildberries.ru"], .footer-main__markets-item a[href*="wildberries.ru"], .card-title__marketplace-item a[href*="wildberries.ru"]').on('click', function() {
        ym(16721107,'reachGoal','wbclick');

        gtag('event', 'click_wb', {
            'event_category': 'marketplace',
            'event_label': 'wb'
        });
    });

    $('.marketplace__item a[href*="market.yandex.ru"], .footer-main__markets-item a[href*="market.yandex.ru"], .card-title__marketplace-item a[href*="market.yandex.ru"]').on('click', function() {
        ym(16721107,'reachGoal','ymclick');

        gtag('event', 'click_ym', {
            'event_category': 'marketplace',
            'event_label': 'ym'
        });
    });

    $('.marketplace__item a[href*="megamarket.ru"], .footer-main__markets-item a[href*="megamarket.ru"], .card-title__marketplace-item a[href*="megamarket.ru"]').on('click', function() {
        ym(16721107,'reachGoal','smmclick');

        gtag('event', 'click_mm', {
            'event_category': 'marketplace',
            'event_label': 'mm'
        });
    });

    $('.marketplace__item a[href*="leroymerlin.ru"], .footer-main__markets-item a[href*="leroymerlin.ru"], .card-title__marketplace-item a[href*="leroymerlin.ru"]').on('click', function() {
        ym(16721107,'reachGoal','lmclick');

        gtag('event', 'click_lm', {
            'event_category': 'marketplace',
            'event_label': 'lm'
        });
    });

    $('.card-title__buy, .js_add_to_basket').on('click', function() {
        ym(16721107,'reachGoal','buy');

        gtag('event', 'otpravit', {
            'event_category': 'forma',
            'event_label': 'buy'
        });
    });

    $('.js_request_wholesale_price').on('click', function() {
        ym(16721107,'reachGoal','OPTPRICE');

        gtag('event', 'otpravit', {
            'event_category': 'forma',
            'event_label': 'optovaya_pokupka'
        });
    });

    $('.js_product_on_order').on('click', function() {
        ym(16721107,'reachGoal','to-order');

        gtag('event', 'otpravit', {
            'event_category': 'forma',
            'event_label': 'pod_zakaz'
        });
    });

    $('.card-title__fast-order').on('click', function() {
        ym(16721107,'reachGoal','buy1click');

        gtag('event', 'otpravit', {
            'event_category': 'forma',
            'event_label': 'order1click'
        });
    });

    $('.basket__button-fast-order').on('click', function() {
        ym(16721107,'reachGoal','quick-order-cart');

        gtag('event', 'otpravit', {
            'event_category': 'forma',
            'event_label': 'quick-order-cart'
        });
    });
});