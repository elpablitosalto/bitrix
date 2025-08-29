$(function() {
    var isExternalLink = function (link) {
        return link.hostname && link.hostname !== location.hostname;
    };

    var showDataLayer = function () {
        // console.log(window.dataLayer);
    };

    // Фиксируем клики по ссылкам в виде номера телефона
    var phoneHandler = function() {
        (window.dataLayer = window.dataLayer || []).push({
            'event': 'GAEvent',
            'eCategory': 'phoneButton',
            'eAction': 'click',
            'eLabel': '',
        });

        showDataLayer();
    };

    $('body').on('click', 'a[href^="tel:"]', phoneHandler);
    $('.nb-header').on('click', 'a[href^="tel:"]', phoneHandler);

    // Фиксируем клики по ссылкам в виде e-mail
    $('body').on('click', 'a[href^="mailto:"]', function() {
        (window.dataLayer = window.dataLayer || []).push({
            'event': 'GAEvent',
            'eCategory': 'externalLink_email',
            'eAction': 'click',
            'eLabel': $(this).attr('href'),
        });

        showDataLayer();
    });

    // Все внешние ссылки открываем в новой вкладке
    var extLink = $('body a[href^="http"]').filter(function() {
        return isExternalLink(this);
    });

    extLink.each(function(){
        $(this).attr('target', '_blank');
    });

    // Фиксируем клики по внешним ссылкам
    $('body').on('click', 'a[href^="http"]', function() {
        if (isExternalLink(this)) {
            (dataLayer = window.dataLayer || []).push({
                'event': 'GAEvent',
                'eCategory': 'externalLink',
                'eAction': 'click',
                'eLabel': $(this).attr('href'),
            });

            showDataLayer();
        }
    });

    if ($('[data-entity="page404"]').length > 0) {
        (window.dataLayer = window.dataLayer || []).push({
            'event': 'GAEvent',
            'eCategory': '404Error',
            'eAction': location.href,
            'eLabel': document.referrer||'no-referrer',
        });

        showDataLayer();
    }

    var arStartForms = [];
    $('body').on('change', 'form[data-form-name]', function() {
        var formName = $.trim($(this).data('form-name'));
        if (formName.length > 0) {
            formName += ' (' + $.trim(document.title) + ')';

            if ($.inArray(formName, arStartForms) === -1) {

                (window.dataLayer = window.dataLayer || []).push({
                    'event': 'GAEvent',
                    'eCategory': 'form',
                    'eAction': 'formstart',
                    'eLabel': formName,
                });

                arStartForms.push(formName);
                showDataLayer();
            }
        }
    });

    $('body').on('submitSuccess', 'form[data-form-name]', function() {
        var formName = $.trim($(this).data('form-name'));
        if (formName.length > 0) {
            formName += ' (' + $.trim(document.title) + ')';

            (window.dataLayer = window.dataLayer || []).push({
                'event': 'GAEvent',
                'eCategory': 'form',
                'eAction': 'send',
                'eLabel': formName,
            });

            showDataLayer();
        }
    });

    $('body').on('modalShow', '.nb-modal', function() {
        var $form = $(this).find('form[data-form-name]');
        if ($form.length > 0) {
            var formName = $.trim($form.data('form-name'));
            if (formName.length > 0) {
                formName += ' (' + $.trim(document.title) + ')';

                (window.dataLayer = window.dataLayer || []).push({
                        'event': 'GAEvent',
                        'eCategory': 'form',
                        'eAction': 'open',
                        'eLabel': formName,
                    }
                );

                showDataLayer();
            }
        }
    });
});