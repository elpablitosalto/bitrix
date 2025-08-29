function callOnWindowLoad(callback, delay) {
  delay = typeof delay === 'number' && !Number.isNaN(delay) ? delay : 0;

  if (document.readyState === 'complete') {
    setTimeout(function () {
      callback();
    }, delay);
  } else {
    window.addEventListener('load', function () {
      callback();
    });
  }
}

function dispatchCustomEvent(eventName, el, data, bubbles) {
  const event = new Event(eventName, {
    cancelable: false,
    bubbles: !!bubbles
  });

  event.data = data;

  el.dispatchEvent(event);
}

function stringToNode(str) {
  if (!str.trim()) return null; // Проверка на пустую строку

  const template = document.createElement('template');
  template.innerHTML = str.trim();

  return template.content.firstChild;
}

(function () {
  'use strict';
  console.log('helpers.js is ready');

  (function toggle() {
    let toggleLoaded = false;

    callOnWindowLoad(function () {
      if (toggleLoaded) {
        return;
      }

      toggleLoaded = true;

      function parseAtribute(str) {
        if (typeof str === 'undefined') {
          return null;
        }

        if (str) {
          var arrayItems = str.split(',');
          var clearArrayItems = arrayItems.map(function (classString) {
            return classString.trim();
          });

          return clearArrayItems;
        }
      }

      function applyFocus(parent, selector) {
        console.log(parent, selector)
        if (!selector) return;

        var target = parent.matches(selector) ? parent : parent.querySelector(selector);
        console.log(target);
        if (target) {
          target.focus();
        }
      }

      function operateClick(e) {
        var trigger = e.target.closest(triggerSelector);

        if (!trigger) {
          return;
        }

        var toggleScope = trigger.dataset['toggleScope'],
          toggleTarget = trigger.dataset['toggleTarget'],
          toggleClass = trigger.dataset['toggleClass'],
          toggleFocus = trigger.dataset['toggleFocus'],
          togglePreventDefault = trigger.dataset['togglePreventDefault'] || 'false',
          scopeList = false,
          targetList = false,
          classList = false,
          focusList = false,
          preventDefault = Boolean(JSON.parse(togglePreventDefault));

        if (preventDefault) {
          e.preventDefault();
        }


        // Scoped and targeted
        if (toggleScope && toggleTarget && toggleClass) {
          scopeList = parseAtribute(toggleScope);
          targetList = parseAtribute(toggleTarget);
          classList = parseAtribute(toggleClass);
          focusList = parseAtribute(toggleFocus);

          if (scopeList.length && targetList.length && classList.length) {
            targetList.forEach(function (item, i) {
              if (typeof classList[i] !== 'undefined') {
                var scope = trigger.closest(scopeList[i]),
                  targets = scope.querySelectorAll(targetList[i]);

                targets.forEach(function (target, targetIndex) {
                  target.classList.toggle(classList[i]);

                  if (toggleFocus) {
                    applyFocus(target, focusList[i]);
                  }
                });
              }
            });
          }
          // Targeted at parent
        } else if (toggleScope && toggleClass) {
          scopeList = parseAtribute(toggleScope);
          classList = parseAtribute(toggleClass);
          focusList = parseAtribute(toggleFocus);

          if (scopeList.length && classList.length) {
            scopeList.forEach(function (item, i) {
              if (typeof classList[i] !== 'undefined') {
                var target = trigger.closest(scopeList[i]);
                target.classList.toggle(classList[i]);

                if (toggleFocus) {
                  applyFocus(target, focusList[i]);
                }
              }
            });
          }
          // Not scoped
        } else if (toggleTarget && toggleClass) {
          targetList = parseAtribute(toggleTarget);
          classList = parseAtribute(toggleClass);
          focusList = parseAtribute(toggleFocus);

          if (targetList.length && classList.length) {
            targetList.forEach(function (item, i) {
              if (typeof classList[i] !== 'undefined') {
                var targets = document.querySelectorAll(targetList[i]);
                targets.forEach(function (target, targetIndex) {
                  target.classList.toggle(classList[i]);

                  if (toggleFocus) {
                    applyFocus(target, focusList[i]);
                  }
                });
              }
            });
          }
        }
      }

      var triggerSelector = '.js-toggle';

      document.body.removeEventListener('click', operateClick);
      document.body.addEventListener('click', operateClick);
    }, 0);
  })();
	(function goTo() {
		callOnWindowLoad(function () {
			const triggerSelector = '.js-go-to',
				fixedHeaderSelector = '.fixed-header';

			document.body.addEventListener('click', function (event) {
				const trigger = event.target.closest(triggerSelector);

				if (!trigger) {
					return;
				}

				const href = trigger.href ? trigger.attributes.href.value : '',
					isAnchor = href.match(/^#/),
					id = isAnchor ? href.replace(/^#/, '') : null,
					header = document.querySelector(fixedHeaderSelector);

				if (id) {
					event.preventDefault();

					let target = document.getElementById(id),
						top = target ? target.getBoundingClientRect().y + window.scrollY : 0,
						offset = header ? header.offsetHeight : 0,
						targetScroll = top - offset;

					window.scrollTo({
						top: targetScroll,
						left: 0,
						behavior: 'smooth'
					});
				}
			});
		}, 0);
	})();
	//Функция по кнопке скролла наверх
	(function scrollTop() {
		callOnWindowLoad(function () {
			function show(el, className) {
				if (el) {
					el.classList.remove(className);
				}
			};

			function hide(el, className) {
				if (el) {
					el.classList.add(className);
				}
			};

			function update() {
				if (window.scrollY > window.innerHeight * 0.5) {
					show(container, containerHiddenClass);
				} else {
					hide(container, containerHiddenClass);
				}
			}

			const containerSelector = '.js-scroller-container',
				containerHiddenClass = 'page__scroll-top_state_hidden';

			const container = document.querySelector(containerSelector);

			if (!container) {
				return;
			}

			update();
			window.addEventListener('scroll', () => {
				update();
			});
		}, 0);
	})();
  (function swiperCarousel() {
    window.swiperCarousel = {
      list: [],
      add: function (selector, rules, extraRules, navRules) {
        this.list.push({
          rules,
          selector,
          extraRules: this.setExtraDefaults(extraRules),
          navRules: navRules,
          carouselArray: []
        });
        this.update(true);
      },
      update: function (onlyLatest = false) {
        if (onlyLatest) {
          this.updateSpecific(this.list[this.list.length - 1]);
        } else {
          for (var i = 0; i < this.list.length; i++) {
            this.updateSpecific(this.list[i]);
          }
        }
      },
      updateSpecific: function (item) {
        const carouselSet = document.querySelectorAll(item.selector);

        carouselSet.forEach(function (carouselEl) {
          const localCarousel = new Swiper(carouselEl, item.rules);
          let initNav = typeof item.rules.init === 'boolean' ? item.rules.init : true;

          item.carouselArray.push(localCarousel);

          if (!item.rules.init && item.extraRules.checkIfSlideable) {
            initNav = initIfSlideable(localCarousel, item);
          }

          if (initNav && carouselEl.ftSwiperNav) {
            carouselEl.ftSwiperNav.init(item.navRules);
          }
        });
      },
      initIfSlideable: function (swiper, carouselData) {
        if (!carouselData || !swiper) {
          return;
        }

        const carousel = swiper.el,
          slides = carousel.querySelectorAll(carouselData.extraRules.slideSelector),
          isSlideable = slides.length > carouselData.extraRules.maxSlideCountBeforeInit;

        if (isSlideable) {
          swiper.init();
        } else if (carouselData.extraRules.scopeSelector && carouselData.extraRules.scopeInactiveClass) {
          carousel.closest(carouselData.extraRules.scopeSelector).classList.add(carouselData.extraRules.scopeInactiveClass);
        }

        return isSlideable;
      },
      getPropWithDefault: function (object, prop, value) {
        return object.hasOwnProperty(prop) ? object[prop] : value;
      },
      setExtraDefaults: function (rules) {
        rules = typeof rules !== 'object' ? {} : rules;

        rules['slideSelector'] = this.getPropWithDefault(rules, 'slideSelector', '.swiper-slide');
        rules['maxSlideCountBeforeInit'] = this.getPropWithDefault(rules, 'maxSlideCountBeforeInit', 1);

        return rules;
      },
      padZeroes: function (value, targetLength) {
        let result = value.toString();
        let length = result.length;

        if (length < targetLength) {
          while (result.length < targetLength) {
            result = '0' + result;
          }
        }

        return result;
      },
      renderOneBullet: function (swiper, index, className) {
        var slide = swiper.slides[index],
          labelText = slide.dataset['paginationLabel'] || this.padZeroes(index + 1, 2);

        return '<button class="' + className + '" type="button">' +
          labelText +
          '</button>';
      }
    }
  })();
})();