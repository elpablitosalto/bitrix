"use strict";

(function () {
  if (!String.prototype.startsWith) {
    String.prototype.startsWith = function (searchString, position) {
      position = position || 0;
      return this.indexOf(searchString, position) === position;
    };
  }

  console.log('common.js is ready');

  (function accordion() {
    callOnWindowLoad(function () {
      function toggleAccordion(trigger) {
        var item = trigger.closest(itemSelector);

        if (!item) {
          return;
        }

        if (!item.classList.contains(accordionOpenClass)) {
          var list = item.closest(listSelector),
              activeItems = list ? list.querySelectorAll('.' + accordionOpenClass) : [];

          if (activeItems.length) {
            activeItems.forEach(function (el) {
              el.classList.remove(accordionOpenClass);
            });
          }
        }

        item.classList.toggle(accordionOpenClass);
      }

      var listSelector = '.js-accordion-list',
          itemSelector = '.js-accordion',
          triggerSelector = '.js-accordion-trigger',
          accordionOpenClass = 'accordion_state_open';
      document.body.addEventListener('click', function (e) {
        var trigger = e.target.closest(triggerSelector);

        if (trigger) {
          toggleAccordion(trigger);
        }
      });
    }, 0);
  })();

  (function carouselNav() {
    window.addEventListener('load', function () {
      var navSelector = '.js-carousel-nav',
          navs = document.querySelectorAll(navSelector);

      if (navs.length) {
        var prevSelector = '.js-carousel-nav-prev',
            nextSelector = '.js-carousel-nav-next',
            paginationSelector = '.js-carousel-nav-pagination',
            currentSelector = '.js-carousel-nav-current',
            totalSelector = '.js-carousel-nav-total';

        window.addFTSwiperNav = function (nav) {
          var navScope = nav.dataset.navScope,
              navTarget = nav.dataset.navTarget,
              targetScope = null,
              target = null;

          if (navScope) {
            targetScope = nav.closest(navScope);
          }

          if (!targetScope) {
            targetScope = document;
          }

          if (navTarget) {
            target = targetScope.querySelector(navTarget);
          }

          if (!target) {
            target = targetScope;
          }

          if (target === document) {
            return;
          }

          var prevTrigger = nav.querySelector(prevSelector),
              nextTrigger = nav.querySelector(nextSelector),
              pagination = nav.querySelector(paginationSelector),
              current = nav.querySelector(currentSelector),
              total = nav.querySelector(totalSelector);
          target.ftSwiperNav = {
            initialized: false,
            target: target,
            swiper: null,
            nav: nav,
            triggers: {
              prev: prevTrigger,
              next: nextTrigger
            },
            pagination: {
              container: pagination,
              current: current,
              total: total
            },
            selectors: {
              nav: navSelector,
              prev: prevSelector,
              next: nextSelector,
              pagination: paginationSelector,
              current: currentSelector,
              total: totalSelector
            },
            init: function init() {
              if (!this.target.swiper || this.initialized) {
                return;
              }

              var ftNav = this;
              ftNav.swiper = ftNav.target.swiper;
              ftNav.slidePrev = ftNav.slidePrev.bind(ftNav);
              ftNav.slideNext = ftNav.slideNext.bind(ftNav);

              if (ftNav.triggers.prev) {
                ftNav.triggers.prev.addEventListener('click', ftNav.slidePrev);
              }

              if (ftNav.triggers.next) {
                ftNav.triggers.next.addEventListener('click', ftNav.slideNext);
              }

              if (ftNav.triggers.prev || ftNav.triggers.next) {
                ftNav.updateArrows();
                ftNav.swiper.on('transitionStart', function () {
                  ftNav.updateArrows();
                });
              }

              if (ftNav.pagination.container) {
                ftNav.updatePagination();
                ftNav.swiper.on('transitionStart', function () {
                  ftNav.updatePagination();
                });
              }

              ftNav.initialized = true;
            },
            destroy: function destroy() {
              var hard = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
              var ftNav = this;

              if (ftNav.triggers.prev) {
                ftNav.triggers.prev.removeEventListener('click', ftNav.slidePrev);
              }

              if (ftNav.triggers.next) {
                ftNav.triggers.next.removeEventListener('click', ftNav.slideNext);
              }

              ftNav.initialized = false;

              if (hard) {
                delete this;
              }
            },
            slidePrev: function slidePrev() {
              this.swiper.slidePrev();
            },
            slideNext: function slideNext() {
              this.swiper.slideNext();
            },
            updateArrows: function updateArrows() {
              if (this.swiper.isBeginning) {
                this.triggers.prev.disabled = true;
              } else {
                this.triggers.prev.disabled = false;
              }

              if (this.swiper.isEnd) {
                this.triggers.next.disabled = true;
              } else {
                this.triggers.next.disabled = false;
              }
            },
            updatePagination: function updatePagination() {
              if (this.swiper.params.loop) {
                this.pagination.current.innerText = this.swiper.realIndex + 1;
                this.pagination.total.innerText = this.swiper.slides.length - this.swiper.loopedSlides * 2;
              } else {
                this.pagination.current.innerText = this.swiper.snapIndex + 1;
                this.pagination.total.innerText = this.swiper.snapGrid.length;
              }
            }
          };
          target.ftSwiperNav.init();
        };

        navs.forEach(function (nav) {
          window.addFTSwiperNav(nav);
        });
      }
    });
  })();

  (function choicesSelect() {
    function updateLabelOffset(selectElements) {
      selectElements.forEach(function (select) {
        var scope = select.closest('.choices-select') || null,
            label = scope ? scope.querySelector('.choices-select__label') : null;

        if (label) {
          var inner = scope.querySelector('.choices__inner');
          inner.style.paddingLeft = label.offsetWidth + 'px';
        }
      });
    }

    window.addEventListener('load', function () {
      var selector = '.js-select',
          selects = document.querySelectorAll(selector);

      if (selects.length) {
        selects.forEach(function (select) {
          select.choiceInstance = new Choices(select, {
            searchEnabled: false,
            shouldSort: false,
            loadingText: 'Загрузка...',
            noResultsText: 'Результатов не найдено',
            noChoicesText: 'Нет опций для выбора',
            itemSelectText: '',
            placeholder: true,
            placeholderValue: null
          });
        });
      }

      document.body.addEventListener('click', function (e) {
        if (e.target.matches('.fancybox__container .choices__item--choice')) {
          var choices = e.target.closest('.choices'),
              select = choices.querySelector('select'),
              instance = select.choiceInstance;
          instance.setChoiceByValue(e.target.dataset.value);
        }
      });
      updateLabelOffset(selects);
      window.addEventListener('resize', function () {
        updateLabelOffset(selects);
      });
    });
  })();

  (function form() {
    callOnWindowLoad(function () {
      function visualPassword(trigger, hide) {
        if (trigger) {
          var input = trigger.closest('.form-control').querySelector('input');

          if (input) {
            var text = trigger.innerText,
                altText = trigger.dataset.textAlt;
            trigger.classList.toggle('form-control__trigger_state_active');

            if (input.type === 'password' && (typeof hide === 'undefined' || hide === true)) {
              input.type = 'text';
            } else {
              input.type = 'password';
            }

            trigger.innerText = altText;
            trigger.dataset.textAlt = text;
          }
        }
      }

      function updateSubmit(check) {
        var form = check.closest('form');

        if (form) {
          var submits = form.querySelectorAll('[type="submit"], [data-type="submit"]');
          submits.forEach(function (submit) {
            submit.disabled = !check.checked;
          });
        }
      }

      document.body.addEventListener('click', function (e) {
        var trigger = e.target.matches('.js-show-password') ? e.target : null;

        if (trigger) {
          visualPassword(trigger);
        }
      });
      document.body.addEventListener('mouseup', function (e) {
        if (!e.target.matches('.js-show-password') && e.target.closest('.js-show-password') === null) {
          var activeTriggers = document.querySelectorAll('.js-show-password.form__trigger_state_active');

          if (activeTriggers.length) {
            activeTriggers.forEach(function (item) {
              visualPassword(item, true);
            });
          }
        }
      });

      function updateTextareaHeight(textarea) {
        textarea.style.height = '';
        textarea.style.height = textarea.scrollHeight + textarea.offsetHeight - textarea.clientHeight + 'px';
      }

      window.updateFormFields = function () {
        var phoneInputs = document.getElementsByClassName('js-phone-input'),
            emailInputs = document.getElementsByClassName('js-email-input'),
            disablingCheckbox = document.getElementsByClassName('js-disabling-checkbox'),
            expandingTextareaSelector = '.js-expanding-textarea';

        if (phoneInputs.length) {
          [].slice.call(phoneInputs).forEach(function (el) {
            Inputmask('+7(999) 999-99-99').mask(el);
          });
        }

        if (emailInputs.length) {
          [].slice.call(emailInputs).forEach(function (el) {
            Inputmask('email').mask(el);
          });
        }

        if (disablingCheckbox.length) {
          [].slice.call(disablingCheckbox).forEach(function (el) {
            updateSubmit(el);
            el.addEventListener('change', function () {
              updateSubmit(el);
            });
          });
        }

        document.querySelectorAll(expandingTextareaSelector).forEach(function (textarea) {
          updateTextareaHeight(textarea);
        });
        document.body.addEventListener('input', function (e) {
          if (e.target.matches(expandingTextareaSelector)) {
            updateTextareaHeight(e.target);
          }
        });
      };

      window.updateFormFields();
    }, 0);
  })();

  (function setInputValue() {
    callOnWindowLoad(function () {
      function update(trigger) {
        var value = trigger.dataset.inputValue,
            inputSelector = trigger.dataset.inputSelector,
            inputs = inputSelector ? document.querySelectorAll(inputSelector) : [];
        inputs.forEach(function (input) {
          input.value = value;
        });
      }

      var triggerSelector = '.js-set-input-value';
      document.body.addEventListener('click', function (e) {
        var trigger = e.target.closest(triggerSelector);

        if (trigger) {
          update(trigger);
        }
      });
    }, 0);
  })();

  (function header() {
    function update() {
      var bxPanel = document.querySelector('#bx-panel'),
          absoluteMobileHeader = document.querySelector('.page__header_position_mobile-absolute'),
          absoluteHeader = document.querySelector('.page__header_position_absolute');

      if (bxPanel) {
        if (absoluteHeader) {
          absoluteHeader.style.top = bxPanel.offsetHeight + 'px';
        } else if (absoluteMobileHeader) {
          if (window.innerWidth < 1025) {
            absoluteMobileHeader.style.top = bxPanel.offsetHeight + 'px';
          } else {
            absoluteMobileHeader.style.top = '';
          }
        }
      }

      return bxPanel && (absoluteHeader || absoluteMobileHeader);
    }

    callOnWindowLoad(function () {
      var success = update();

      if (success) {
        window.addEventListener('resize', function () {
          update();
        });
        window.addEventListener('scroll', function () {
          update();
        });
      }
    }, 0);
  })();

  (function imageCarousel() {
    function initIfSlideable(swiper, carousel, slideSelector, containerSelector, inactiveClass) {
      if (!carousel || !swiper) {
        return;
      }

      var slides = carousel.querySelectorAll(slideSelector);

      if (slides.length > 1) {
        swiper.init();
      } else if (containerSelector && inactiveClass) {
        console.log(carousel);
        carousel.closest(containerSelector).classList.add(inactiveClass);
      }

      return slides.length > 1;
    }

    function renderOneBullet(swiper, index, className) {
      var slide = swiper.slides[index],
          labelText = slide.dataset['paginationLabel'] || 'Слайд №' + (index + 1);
      return '<button class="' + className + '" type="button">' + labelText + '</button>';
    }

    callOnWindowLoad(function () {
      var carouselSelector = '.js-image-carousel',
          carouselSet = document.querySelectorAll(carouselSelector),
          myCarousel;

      if (carouselSet.length) {
        myCarousel = new Swiper(carouselSelector, {
          init: false,
          speed: 600,
          loop: true,
          slidesPerView: 1,
          slidesPerGroup: 1,
          loopAdditionalSlides: 1,
          autoHeight: true,
          allowTouch: true,
          spaceBetween: 0,
          touchReleaseOnEdges: true,
          pagination: {
            el: '.bullet-pagination',
            type: 'bullets',
            clickable: true,
            bulletEl: 'button',
            modifierClass: 'bullet-pagination_',
            bulletClass: 'bullet-pagination__button',
            bulletActiveClass: 'bullet-pagination__button_state_active',
            renderBullet: function renderBullet(index, className) {
              return renderOneBullet(this, index, className);
            }
          }
        });

        if (!myCarousel.length) {
          myCarousel = [myCarousel];
        }

        var slideSelector = '.swiper-slide';
        var containerSelector = '.image-carousel';
        var inactiveClass = 'image-carousel_state_inactive';
        carouselSet.forEach(function (carousel, i) {
          var slideable = initIfSlideable(myCarousel[i], carousel, slideSelector, containerSelector, inactiveClass);

          if (slideable && carousel.ftSwiperNav) {
            carousel.ftSwiperNav.init();
          }
        });
      }
    }, 0);
  })();

  (function lookbook() {
    callOnWindowLoad(function () {
      var triggerSelector = '.js-lookbook-trigger',
          prevSelector = '.js-lookbook-prev',
          nextSelector = '.js-lookbook-next',
          bookSelector = '.lookbook',
          pageContainerSelector = '.js-lookbook-pages',
          flippableContainerSelector = '.js-lookbook-flippable-pages',
          pageSelector = '.js-lookbook-page',
          motionBookClass = 'lookbook_state_motion',
          reverseMotionBookClass = 'lookbook_state_reverse-motion',
          activePageClass = 'lookbook__page_state_active',
          motionPageClass = 'lookbook__page_state_motion',
          flippedPageClass = 'lookbook__page_state_flipped',
          flippablePageClass = 'lookbook__page_type_flippable',
          firstPageClass = 'lookbook__page_position_first',
          lastPageClass = 'lookbook__page_position_last';
      var zStep = 10,
          state = {
        index: {
          current: -1,
          last: -1
        },
        edge: {
          start: true,
          end: false
        },
        length: -1
      };
      var inDesktopMode = window.innerWidth > 767;

      function updateNav(realIndex) {
        var flippablePages = document.querySelectorAll('.' + flippablePageClass),
            prevTrigger = document.querySelector(prevSelector),
            nextTrigger = document.querySelector(nextSelector),
            length = flippablePages.length,
            edgeStart = realIndex <= -1,
            edgeEnd = realIndex >= length - 1;
        state.length = length;
        state.edge.start = edgeStart;
        state.edge.end = edgeEnd;
        prevTrigger.disabled = edgeStart;
        nextTrigger.disabled = edgeEnd;
      }

      function goToPage(direction, clickedIndex, twoSidedPrint) {
        var book = document.querySelector(bookSelector),
            pages = book.querySelectorAll(pageSelector),
            lastActivePage = book.querySelector('.' + activePageClass);
        var realIndex = direction > 0 ? clickedIndex : clickedIndex - 1 - twoSidedPrint * 2,
            motionIndex = direction > 0 ? clickedIndex : clickedIndex - twoSidedPrint;
        pages.forEach(function (page, i) {
          if (!page.classList.contains(flippablePageClass)) {
            return;
          }

          if (i > realIndex + twoSidedPrint) {
            page.style.zIndex = (pages.length - realIndex - i) * zStep;
            page.classList.remove(flippedPageClass);
          } else {
            page.style.zIndex = '';
            page.classList.add(flippedPageClass);
          }

          if (i === motionIndex || i === motionIndex + twoSidedPrint) {
            page.style.zIndex = pages.length * zStep * 2;
            page.classList.add(motionPageClass);

            if (direction > 0) {
              book.classList.add(motionBookClass);
            } else {
              book.classList.add(reverseMotionBookClass);
            }

            page.addEventListener('transitionend', function () {
              page.classList.remove(motionPageClass);
              book.classList.remove(motionBookClass);
              book.classList.remove(reverseMotionBookClass);
            }, {
              once: true
            });
          }
        });

        if (lastActivePage) {
          lastActivePage.classList.remove(activePageClass);
        }

        if (realIndex >= 0) {
          pages[realIndex].classList.add(activePageClass);
        }

        state.index.last = state.index.current;
        state.index.current = realIndex;
        updateNav(realIndex);
      }

      function goToPageByArrow(direction) {
        var twoSidedPrint = Number(window.innerWidth > 767),
            clickedIndex = state.index.current + direction + Number(twoSidedPrint);
        goToPage(direction, clickedIndex, twoSidedPrint);
      }

      function goToPageByTrigger(clickedTrigger) {
        var book = clickedTrigger.closest(bookSelector),
            clickedPage = clickedTrigger.closest(pageSelector),
            twoSidedPrint = Number(window.innerWidth > 767);
        var clickedIndex = null,
            lastActiveIndex = -1,
            direction = 1;

        if (!book || !clickedPage) {
          return;
        }

        var triggers = book.querySelectorAll(triggerSelector),
            lastActivePage = book.querySelector('.' + activePageClass); // Determening direction

        triggers.forEach(function (trigger, i) {
          var page = trigger.closest(pageSelector);

          if (page === lastActivePage) {
            lastActiveIndex = i;
          }

          if (trigger === clickedTrigger) {
            clickedIndex = i;
          }
        });
        direction = Number(clickedIndex > lastActiveIndex + twoSidedPrint);
        direction = Number(clickedIndex > lastActiveIndex + Number(twoSidedPrint && lastActiveIndex !== 0));
        goToPage(direction, clickedIndex, twoSidedPrint);
      }

      function rebuild(twoSidedPrint) {
        var fragment = document.createDocumentFragment(),
            pageContainer = document.querySelector(pageContainerSelector),
            flippableContainer = document.querySelector(flippableContainerSelector),
            pages = pageContainer ? pageContainer.querySelectorAll(pageSelector) : [];

        if (pageContainer && flippableContainer && pages.length) {
          var pageCount = pages.length,
              lastPage = pages[pageCount - 1],
              firstPage = twoSidedPrint && pageCount > 1 ? pages[0] : null;
          pages.forEach(function (page) {
            page.classList.remove(firstPageClass, flippablePageClass, lastPageClass);
            page.style.zIndex = '';

            if (page === firstPage) {
              page.classList.add(firstPageClass);
              flippableContainer.before(page);
            } else if (page === lastPage) {
              page.classList.add(lastPageClass);
              flippableContainer.after(page);
            } else {
              page.classList.add(flippablePageClass);
              fragment.append(page);
            }
          });
          flippableContainer.appendChild(fragment);
        }

        updateNav(state.index.current);
      }

      function init(twoSidedPrint) {
        rebuild(twoSidedPrint);
        var triggers = document.querySelectorAll(triggerSelector);
        triggers.forEach(function (trigger, i) {
          var page = trigger.closest(pageSelector);

          if (!page.classList.contains(flippablePageClass)) {
            return;
          }

          page.style.zIndex = (triggers.length - i) * zStep;
        });
      }

      if (document.querySelector(pageSelector)) {
        init(inDesktopMode);
        document.body.addEventListener('click', function (e) {
          var trigger = e.target.closest(triggerSelector),
              prevTrigger = e.target.closest(prevSelector),
              nextTrigger = e.target.closest(nextSelector);

          if (trigger) {
            goToPageByTrigger(trigger);
          } else if (prevTrigger) {
            goToPageByArrow(0);
          } else if (nextTrigger) {
            goToPageByArrow(1);
          }
        });
        window.addEventListener('resize', function (e) {
          var isDesktopModeResolution = window.innerWidth > 767;

          if (isDesktopModeResolution !== inDesktopMode) {
            inDesktopMode = isDesktopModeResolution;
            init(inDesktopMode);
          }
        });
      }
    }, 0);
  })();

  (function lookbookSnippet() {
    function getFittingTextSizeMultiplier(el) {
      return el.offsetWidth / el.scrollWidth;
    }

    function fitFontSizeInEm(el, emInPixels) {
      el.style.fontSize = '';
      var fontSizeMultiplier = getFittingTextSizeMultiplier(el);

      if (fontSizeMultiplier < 1) {
        var fontSize = Number(window.getComputedStyle(el).fontSize.replace('px', '')),
            fittedFontSizeInEm = fontSize / emInPixels * fontSizeMultiplier;
        el.style.fontSize = fittedFontSizeInEm + 'em';
      }
    }

    function updateSnippetSizes() {
      var fontSizePerWidth = 0.1,
          itemSelector = '.js-look-book-sizer';
      var items = document.querySelectorAll(itemSelector);

      if (!items.length) {
        return;
      }

      items.forEach(function (item) {
        item.style.fontSize = 0;
      });
      items.forEach(function (item) {
        var width = item.offsetWidth,
            fontSize = width * fontSizePerWidth,
            title = item.querySelector('.lookbook-snippet__title'),
            keywords = item.querySelector('.lookbook-snippet__keywords');
        item.style.fontSize = fontSize + 'px';

        if (title) {
          fitFontSizeInEm(title, fontSize);
        }

        if (keywords) {
          fitFontSizeInEm(keywords, fontSize);
        }

        item.classList.remove('lookbook-snippet_state_not-loaded');
      });
    }

    callOnWindowLoad(function () {
      updateSnippetSizes();
      window.addEventListener('resize', function () {
        updateSnippetSizes();
      });
    }, 0);
  })();

  (function modal() {
    callOnWindowLoad(function () {
      window.fancyboxSettings = {
        dragToClose: false,
        autoFocus: false,
        touch: false,
        trapFocus: false,
        on: {
          init: function init() {
            Fancybox.close();
          },
          done: function done() {
            if (typeof initCaptcha !== 'undefined') {
              initCaptcha();
            }
          },
          reveal: function reveal() {
            var container = this.$container,
                modal = container.querySelector('.modal'),
                form = container.querySelector('form');

            if (modal) {
              modal.classList.remove('modal_type_form-sent');
            }

            if (form) {
              form.classList.remove('form_state_sent');
            }
          }
        }
      };

      window.openModal = function (id) {
        if (!id) {
          console.log('No id provided for modal to open');
          return;
        }

        Fancybox.show([{
          src: '#' + id
        }], window.fancyboxSettings);
      };

      Fancybox.bind('.js-modal', window.fancyboxSettings);
      document.body.addEventListener('click', function (e) {
        var trigger = e.target.matches('.js-fancybox-close') ? e.target : e.target.closest('.js-fancybox-close');

        if (trigger) {
          Fancybox.close();
        }
      });
    }, 0);
  })();

  (function nav() {
    callOnWindowLoad(function () {
      var triggerSelector = '.js-nav-parent-link',
          listSelector = '.nav__list',
          itemSelector = '.nav__item',
          itemOpenClass = 'nav__item_state_open';
      document.body.addEventListener('click', function (e) {
        if (window.innerWidth < 1025) {
          var trigger = e.target.closest(triggerSelector);

          if (trigger) {
            var item = trigger.closest(itemSelector);

            if (!item.classList.contains(itemOpenClass)) {
              e.preventDefault();
              var list = item.closest(listSelector),
                  itemSiblings = list.children;
              Array.from(itemSiblings).forEach(function (sibling) {
                sibling.classList.remove(itemOpenClass);
              });
              item.classList.add(itemOpenClass);
            }
          }
        }
      });
    }, 0);
  })();

  (function imageCarousel() {
    function initIfSlideable(swiper, carousel, slideSelector, containerSelector, inactiveClass) {
      if (!carousel || !swiper) {
        return;
      }

      var slides = carousel.querySelectorAll(slideSelector);

      if (slides.length > 1) {
        swiper.init();
      } else if (containerSelector && inactiveClass) {
        console.log(carousel);
        carousel.closest(containerSelector).classList.add(inactiveClass);
      }

      return slides.length > 1;
    }

    function renderOneBullet(swiper, index, className) {
      var slide = swiper.slides[index],
          labelText = slide.dataset['paginationLabel'] || 'Слайд №' + (index + 1);
      return '<button class="' + className + '" type="button">' + labelText + '</button>';
    }

    function applySlideOpacity(swiper) {
      var slides = swiper.slides,
          progress = swiper.progress,
          progressPerSlide = 1 / (slides.length - 1),
          index = Math.floor(progress / progressPerSlide),
          localProgress = (progress - index * progressPerSlide) / progressPerSlide,
          opacityProgress = localProgress / .2,
          currentSlideOpacity = 1 - opacityProgress;
      slides.forEach(function (slide, i) {
        slide.style.opacity = i === index ? currentSlideOpacity : Number(i > index);
        slide.style.transitionDuration = '';
      });
    }

    function applySlideOpacityTransition(swiper) {
      var activeSlide = swiper.slides[swiper.activeIndex];
      activeSlide.style.transitionDuration = '600ms';
      activeSlide.addEventListener('transitionend', function () {
        activeSlide.style.transitionDuration = '';
      }, {
        once: true
      });
    }

    callOnWindowLoad(function () {
      var carouselSelector = '.js-product-card-carousel',
          carouselSet = document.querySelectorAll(carouselSelector),
          myCarousel;

      if (carouselSet.length) {
        myCarousel = new Swiper(carouselSelector, {
          init: false,
          loop: true,
          speed: 600,
          slidesPerView: 1,
          slidesPerGroup: 1,
          autoHeight: true,
          allowTouch: true,
          shortSwipes: false,
          longSwipesMs: 50,
          spaceBetween: 0,
          touchReleaseOnEdges: true,
          pagination: {
            el: '.bullet-pagination',
            type: 'bullets',
            clickable: true,
            bulletEl: 'button',
            modifierClass: 'bullet-pagination_',
            bulletClass: 'bullet-pagination__button',
            bulletActiveClass: 'bullet-pagination__button_state_active',
            renderBullet: function renderBullet(index, className) {
              return renderOneBullet(this, index, className);
            }
          },
          on: {
            progress: function progress(swiper) {
              if (window.innerWidth >= 1025) {
                applySlideOpacity(swiper);
              }
            },
            beforeTransitionStart: function beforeTransitionStart(swiper) {
              if (window.innerWidth >= 1025) {
                applySlideOpacityTransition(swiper);
              }
            }
          }
        });

        if (!myCarousel.length) {
          myCarousel = [myCarousel];
        }

        var slideSelector = '.swiper-slide';
        var containerSelector = '.product-card-carousel';
        var inactiveClass = 'product-card-carousel_state_inactive';
        carouselSet.forEach(function (carousel, i) {
          var slideable = initIfSlideable(myCarousel[i], carousel, slideSelector, containerSelector, inactiveClass);

          if (slideable && carousel.ftSwiperNav) {
            carousel.ftSwiperNav.init();
          }
        });
      }
    }, 0);
  })();

  (function productCarousel() {
    callOnWindowLoad(function () {
      function init() {
        var carouselSelector = '.js-product-carousel',
            carouselSet = document.querySelectorAll(carouselSelector),
            // eslint-disable-next-line no-unused-vars
        myCarousel;

        if (carouselSet.length && !carouselSet[0].swiper) {
          myCarousel = new Swiper(carouselSelector, {
            speed: 600,
            slidesPerView: 1,
            slidesPerGroup: 1,
            touchReleaseOnEdges: true,
            spaceBetween: 40,
            breakpoints: {
              768: {
                slidesPerView: 2
              },
              1025: {
                slidesPerView: 3
              }
            }
          });
          carouselSet.forEach(function (carousel) {
            if (carousel.ftSwiperNav) {
              carousel.ftSwiperNav.init();
            }
          });
        }
      }

      init();

      if (typeof BX !== 'undefined') {
        BX.addCustomEvent('onAjaxSuccess', function () {
          init();
        });
      }
    });
  })();

  (function video() {
    callOnWindowLoad(function () {
      var triggerSelector = '.js-video-trigger',
          scopeSelector = '.js-video-scope',
          contentSelector = '.js-video-content',
          loadingClass = 'video_state_loading',
          loadedClass = 'video_state_loaded';

      function beginVideoOnCanplay(e) {
        var scope = e.target.closest(scopeSelector);
        scope.classList.add(loadedClass);
        scope.classList.remove(loadingClass);
        e.target.play();
      }

      function loadVideoFromSourceTags(scope, video, sources) {
        scope.classList.add(loadingClass);
        video.addEventListener('canplay', beginVideoOnCanplay, {
          once: true
        });
        sources.forEach(function (source) {
          source.setAttribute('src', source.dataset.src);
        });
        video.load();
      }

      function beginIframeOnLoad(e) {
        var scope = e.target.closest(scopeSelector);
        scope.classList.add(loadedClass);
        scope.classList.remove(loadingClass);
      }

      function loadIframe(scope, iframe) {
        scope.classList.add(loadingClass);
        iframe.addEventListener('load', beginIframeOnLoad, {
          once: true
        });
        iframe.setAttribute('src', iframe.dataset.src);
      }

      function initVideo(video, scope) {
        if (video && scope) {
          var sources = video.querySelectorAll('source');

          if (sources.length) {
            loadVideoFromSourceTags(scope, video, sources);
          } else if (video.tagName === 'IFRAME') {
            loadIframe(scope, video);
          }
        }
      }

      function initVideoFromTrigger(obj) {
        var objIsTrigger = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
        // objIstrigger: false - first argument is click event
        // objIsTrigger: true - first argument is trigger element
        var trigger = objIsTrigger ? obj : obj.target.closest(triggerSelector);

        if (trigger) {
          var scope = trigger.closest(scopeSelector) || null,
              target = scope ? scope.querySelector(contentSelector) : null;
          initVideo(target, scope);
        }
      }

      window.autoplayVideoInContainer = function (container) {
        if (!container) {
          return;
        }

        var videos = container.querySelectorAll(contentSelector);
        videos.forEach(function (video) {
          var scope = video.closest(scopeSelector);
          initVideo(video, scope);
        });
      };

      document.body.addEventListener('click', initVideoFromTrigger);
      var videos = document.querySelectorAll(contentSelector);

      if (videos.length) {
        videos.forEach(function (video) {
          if (video.autoplay || video.attributes.autoplay) {
            var scope = video.closest(scopeSelector);
            initVideo(video, scope);
          }
        });
      }

      if (window.autoplayContainerBuffer && window.autoplayContainerBuffer.length) {
        window.autoplayContainerBuffer.forEach(function (container) {
          window.autoplayVideoInContainer(container);
        });
      }
    }, 0);
  })();
})();