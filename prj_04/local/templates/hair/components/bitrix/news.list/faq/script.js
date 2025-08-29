(function scrollSpy() {
    var scrollspySelector = '.js-scroll-spy-container',
        scrollspyItemSelector = '.js-scroll-spy-item',
        scrollspyLinkSelector = '.js-scroll-spy-link',
        scrollspies = document.querySelectorAll(scrollspySelector),
        anchoredScroll = false;

    function init(el) {
        var links = el.querySelectorAll(scrollspyLinkSelector),
            activeClass = el.dataset.scrollspyActiveClass || 'active';

        links.forEach(function (link) {
            link.addEventListener('click', function () {
                anchoredScroll = true;
                links.forEach(function (link) {
                    link.classList.remove(activeClass);
                });
                link.classList.add(activeClass)
            });
        });
    }

    function update(el) {
        var links = el.querySelectorAll(scrollspyLinkSelector),
            strict = typeof el.dataset.scrollspyStrict !== 'undefined',
            activeClass = el.dataset.scrollspyActiveClass || 'active',
            activeIndex = -1;

        if(!links.length) return;
        if (typeof el.dataset.scrollspyActveIndex === 'undefined') {
            el.dataset.scrollspyActveIndex = activeIndex;
        }

        links.forEach(function (link, i) {
            var id = link.attributes.href.value,
                target = document.querySelector(id);

            if (target) {
                var boundRect = target.getBoundingClientRect();

                if (boundRect.top > -boundRect.height+window.outerHeight/2 && activeIndex === -1) {
                    if (i !== 0 || !strict || boundRect.top < window.outerHeight/2) {
                        activeIndex = Math.max(0, i);
                    }
                }
            }
        });

        if (activeIndex === -1 && !strict) {
            activeIndex = links.length - 1;
        }

        if (el.dataset.scrollspyActiveIndex != activeIndex && !anchoredScroll) {
            links.forEach(function (link, i) {
                link.classList.remove(activeClass);
            });
            links[activeIndex].classList.add(activeClass);
        }

        anchoredScroll = false;
    }

    if (scrollspies.length) {
        scrollspies.forEach(function (scrollspy) {
            init(scrollspy);
            update(scrollspy)
        });

        window.addEventListener('scroll', function (e) {
            scrollspies.forEach(function (scrollspy) {
                update(scrollspy)
            });
        });

        window.addEventListener('resize', function () {
            scrollspies.forEach(function (scrollspy) {
                update(scrollspy)
            });
        });
    }
})();

(function faq() {
    var containerSelector = '.faq-item',
        accSelector = '.faq-accordeon',
        containerOpenClass = 'faq-item_state_open',
        accOpenClass = 'faq-accordeon_state_open',
        triggerSelector = '.js-faq-trigger',
        accTriggerSelector = '.js-faq-acc-trigger',
        triggers = document.querySelectorAll(triggerSelector),
        accTriggers = document.querySelectorAll(accTriggerSelector);

    if (triggers.length) {
        triggers.forEach(function (trigger, i) {
            trigger.addEventListener('click', function (e) {
                e.preventDefault();
                var container = trigger.closest(containerSelector);
                if (container) {
                    container.classList.toggle(containerOpenClass);
                }
                return false;
            });

            if (i === 0) {
                var container = trigger.closest(containerSelector);
                if (container) {
                    container.classList.add(containerOpenClass);
                }
            }
        });
    }

    if (accTriggers.length) {
        accTriggers.forEach(function (accTrigger) {
            accTrigger.addEventListener('click', function (e) {
                e.preventDefault();
                var container = accTrigger.closest(accSelector);
                if (container) {
                    container.classList.toggle(accOpenClass);
                }
                return false;
            });
        });
    }

})();