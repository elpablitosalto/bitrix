(function() {
  'use strict';

  if (!!window.JCCatalogSectionComponent)
    return;

  window.JCCatalogSectionComponent = function(params) {
    this.formPosting = false;
    this.siteId = params.siteId || '';
    this.ajaxId = params.ajaxId || '';
    this.template = params.template || '';
    this.componentPath = params.componentPath || '';
    this.parameters = params.parameters || '';

    if (params.navParams)
    {
      this.navParams = {
        NavNum: params.navParams.NavNum || 1,
        NavPageNomer: parseInt(params.navParams.NavPageNomer) || 1,
        NavPageCount: parseInt(params.navParams.NavPageCount) || 1
      };
    }

    this.bigData = params.bigData || {enabled: false};
    this.container = document.querySelector('[data-entity="' + params.container + '"]');
    this.showMoreButton = null;
    this.showMoreButtonMessage = null;

    if (this.bigData.enabled && BX.util.object_keys(this.bigData.rows).length > 0)
    {
      BX.cookie_prefix = this.bigData.js.cookiePrefix || '';
      BX.cookie_domain = this.bigData.js.cookieDomain || '';
      BX.current_server_time = this.bigData.js.serverTime;

      BX.ready(BX.delegate(this.bigDataLoad, this));
    }

    if (params.initiallyShowHeader)
    {
      BX.ready(BX.delegate(this.showHeader, this));
    }

    if (params.deferredLoad)
    {
      BX.ready(BX.delegate(this.deferredLoad, this));
    }

    if (params.lazyLoad)
    {
      this.showMoreButton = document.querySelector('[data-use="show-more-' + this.navParams.NavNum + '"]');
      this.showMoreButtonMessage = this.showMoreButton.innerHTML;
      BX.bind(this.showMoreButton, 'click', BX.proxy(this.showMore, this));
    }

    if (params.loadOnScroll)
    {
      BX.bind(window, 'scroll', BX.proxy(this.loadOnScroll, this));
    }
  };

  window.JCCatalogSectionComponent.prototype = {
    checkButton: function () {
      if (this.showMoreButton) {
        if (this.navParams.NavPageNomer == this.navParams.NavPageCount) {
          BX.remove(this.showMoreButton);
        }
        // else
        // {
        // 	this.container.appendChild(this.showMoreButton);
        // }
      }
    },

    enableButton: function () {
      if (this.showMoreButton) {
        BX.removeClass(this.showMoreButton, "button_state_loading");
        //this.showMoreButton.innerHTML = this.showMoreButtonMessage;

        // Меняем пагинацию
        let currentPage = this.navParams.NavPageNomer + 1;
        let totalPages = this.navParams.NavPageCount;
        this.updatePagination(currentPage, totalPages);
        this.updatePaginationUrlParam(currentPage);
      }
    },

    disableButton: function () {
      if (this.showMoreButton) {
        BX.addClass(this.showMoreButton, "button_state_loading");
        //this.showMoreButton.innerHTML = BX.message('BTN_MESSAGE_LAZY_LOAD_WAITER');
      }
    },

    loadOnScroll: function () {
      var scrollTop = BX.GetWindowScrollPos().scrollTop,
        containerBottom = BX.pos(this.container).bottom;

      if (scrollTop + window.innerHeight > containerBottom) {
        this.showMore();
      }
    },

    updatePaginationUrlParam: function (currentPage) {
      // Получаем текущий URL
      let url = new URL(window.location.href);

      // Обновляем или добавляем параметр PAGEN_1
      url.searchParams.set("PAGEN_1", currentPage);

      // Обновляем URL без перезагрузки страницы
      window.history.replaceState(null, "", url);

      // this.replacePaginationLink(url.pathname + url.search);
    },

    // Хранение активных страниц
    activePages: new Set(),

    // Функция для получения базового URL без параметра PAGEN_1
    getBaseUrl() {
      const currentUrl = new URL(window.location.href);
      currentUrl.searchParams.delete("PAGEN_1"); // Удаляем параметр PAGEN_1
      return currentUrl;
    },

    // Функция для обновления элемента "Предыдущая страница"
    updatePrevItem(prevItem, currentPage) {
      if (currentPage > 1 && !this.activePages.has(1)) {
        const prevLink = prevItem.querySelector("div");
        if (prevLink) {
          const array = Array.from(this.activePages);
          const min = array.length > 0 ? Math.min(...array) : 1;
          const newLink = document.createElement("a");
          newLink.classList.add("pagination__link");
          newLink.href = `${this.getBaseUrl().pathname}?PAGEN_1=${min - 1 || 1}`;
          newLink.textContent = prevLink.textContent;
          prevItem.replaceChild(newLink, prevLink);
        }
        const prevAnchor = prevItem.querySelector("a");
        prevAnchor.classList.remove("pagination__link_state_inactive");
        prevAnchor.href = `${this.getBaseUrl().pathname}?PAGEN_1=${
          currentPage - 1
        }`;
      } else {
        const prevLink = prevItem.querySelector("a");
        if (prevLink) {
          const newDiv = document.createElement("div");
          newDiv.classList.add(
            "pagination__link",
            "pagination__link_state_inactive"
          );
          newDiv.textContent = prevLink.textContent;
          prevItem.replaceChild(newDiv, prevLink);
        }
      }
    },

    // Функция для создания элемента пагинации (либо активного, либо с ссылкой)
    createPaginationItem(page, isActive) {
      const li = document.createElement("li");
      li.classList.add("pagination__item");

      if (isActive) {
        const activeDiv = document.createElement("div");
        activeDiv.classList.add(
          "pagination__label",
          "pagination__label_state_active"
        );
        activeDiv.textContent = page;
        li.appendChild(activeDiv);
      } else {
        const a = document.createElement("a");
        a.classList.add("pagination__link");
        a.href = `${this.getBaseUrl().pathname}?PAGEN_1=${page}`;

        const span = document.createElement("span");
        span.classList.add("pagination__label");
        span.textContent = page;

        a.appendChild(span);
        li.appendChild(a);
      }

      return li;
    },

    // Функция для обновления ссылок на номера страниц
    updatePageItems(paginationList, currentPage, totalPages) {
      const maxVisiblePages = 5;
      const range = 2; // Количество активных страниц с каждой стороны текущей страницы

      let startPage = Math.max(1, currentPage - range);
      let endPage = Math.min(totalPages, currentPage + range);

      // Корректировка диапазона для обеспечения максимального количества видимых страниц
      if (endPage - startPage + 1 < maxVisiblePages) {
        if (endPage === totalPages) {
          startPage = Math.max(1, endPage - maxVisiblePages + 1);
        } else if (startPage === 1) {
          endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        }
      }

      // Удаляем старые элементы пагинации, кроме prev и next
      const existingItems = Array.from(
        paginationList.querySelectorAll(
          ".pagination__item:not(.pagination__item_type_prev):not(.pagination__item_type_next)"
        )
      );
      existingItems.forEach((item) => paginationList.removeChild(item));

      // Создаем и вставляем новые элементы
      for (let i = startPage; i <= endPage; i++) {
        const isActive = i === currentPage || this.activePages.has(i);
        const item = this.createPaginationItem(i, isActive);
        paginationList.insertBefore(
          item,
          paginationList.querySelector(".pagination__item_type_next")
        );
      }

      // Обновляем активные страницы
      this.activePages.add(currentPage);
    },

    // Функция для обновления элемента "Следующая страница"
    updateNextItem(nextItem, currentPage, totalPages) {
      if (currentPage >= totalPages) {
        nextItem.classList.add("pagination__link_state_inactive");
        nextItem.removeAttribute("href");
      } else {
        nextItem.classList.remove("pagination__link_state_inactive");
        nextItem.href = `${this.getBaseUrl().pathname}?PAGEN_1=${
          currentPage + 1
        }`;
      }
    },

    // Основная функция обновления пагинации
    updatePagination(currentPage, totalPages) {
      const paginationList = document.querySelector(".pagination__list");
      const prevItem = paginationList.querySelector(
        ".pagination__item_type_prev"
      );
      const nextItem = paginationList.querySelector(
        ".pagination__item_type_next .pagination__link"
      );

      console.log("this.activePages", this.activePages);
      // Сначала сохраняем активные страницы до вызова функции
      if (!this.activePages.size) {
        const currentUrl = new URL(window.location.href);
        const params = new URLSearchParams(currentUrl.search);
        // Получаем значение параметра PAGEN_1, если он есть, иначе устанавливаем значение по умолчанию 1
        const pageNumber = params.get("PAGEN_1") || "1";
        this.activePages.add(parseInt(pageNumber, 10));
      }
      console.log("this.activePages next", this.activePages);

      // Обновляем элементы пагинации
      // this.updatePrevItem(prevItem, currentPage);
      this.updatePageItems(paginationList, currentPage, totalPages);
      this.updateNextItem(nextItem, currentPage, totalPages);

      // Восстанавливаем активные страницы
      this.activePages.add(currentPage);
    },

    showMore: function () {
      if (this.navParams.NavPageNomer < this.navParams.NavPageCount) {
        var data = {};
        data["action"] = "showMore";
        data["PAGEN_" + this.navParams.NavNum] =
          this.navParams.NavPageNomer + 1;

        if (!this.formPosting) {
          this.formPosting = true;
          this.disableButton();
          this.sendRequest(data);
        }
      }
    },

    bigDataLoad: function () {
      var url = "https://analytics.bitrix.info/crecoms/v1_0/recoms.php",
        data = BX.ajax.prepareData(this.bigData.params);

      if (data) {
        url += (url.indexOf("?") !== -1 ? "&" : "?") + data;
      }

      var onReady = BX.delegate(function (result) {
        this.sendRequest({
          action: "deferredLoad",
          bigData: "Y",
          items: (result && result.items) || [],
          rid: result && result.id,
          count: this.bigData.count,
          rowsRange: this.bigData.rowsRange,
          shownIds: this.bigData.shownIds,
        });
      }, this);

      BX.ajax({
        method: "GET",
        dataType: "json",
        url: url,
        timeout: 3,
        onsuccess: onReady,
        onfailure: onReady,
      });
    },

    deferredLoad: function () {
      this.sendRequest({ action: "deferredLoad" });
    },

    sendRequest: function (data) {
      var defaultData = {
        siteId: this.siteId,
        template: this.template,
        parameters: this.parameters,
      };

      if (this.ajaxId) {
        defaultData.AJAX_ID = this.ajaxId;
      }

      BX.ajax({
        url:
          this.componentPath +
          "/ajax.php" +
          (document.location.href.indexOf("clear_cache=Y") !== -1
            ? "?clear_cache=Y"
            : ""),
        method: "POST",
        dataType: "json",
        timeout: 60,
        data: BX.merge(defaultData, data),
        onsuccess: BX.delegate(function (result) {
          if (!result || !result.JS) return;

          BX.ajax.processScripts(
            BX.processHTML(result.JS).SCRIPT,
            false,
            BX.delegate(function () {
              this.showAction(result, data);
            }, this)
          );
        }, this),
      });
    },

    showAction: function (result, data) {
      if (!data) return;

      switch (data.action) {
        case "showMore":
          this.processShowMoreAction(result);
          break;
        case "deferredLoad":
          this.processDeferredLoadAction(result, data.bigData === "Y");
          break;
      }
    },

    processShowMoreAction: function (result) {
      this.formPosting = false;
      this.enableButton();

      if (result) {
        console.log("processShowMoreAction", result);
        this.navParams.NavPageNomer++;
        this.processItems(result.items);
        this.processPagination(result.pagination);
        this.processEpilogue(result.epilogue);
        this.checkButton();
      }
    },

    processDeferredLoadAction: function (result, bigData) {
      if (!result) return;

      var position = bigData ? this.bigData.rows : {};

      this.processItems(result.items, BX.util.array_keys(position));
    },

    processItems: function (itemsHtml, position) {
      if (!itemsHtml) return;

      var processed = BX.processHTML(itemsHtml, false),
        temporaryNode = BX.create("DIV");

      var items, k, origRows;

      temporaryNode.innerHTML = processed.HTML;
      items = temporaryNode.querySelectorAll(".product-grid__item");
      if (items.length) {
        this.showHeader(true);
        for (k in items) {
          if (items.hasOwnProperty(k)) {
            var lazyItems = items[k].querySelectorAll(".lazyload");
            origRows = position
              ? this.container.querySelectorAll(".product-grid__wrapper")
              : false;
            items[k].style.opacity = 0;

            if (origRows && BX.type.isDomNode(origRows[position[k]])) {
              origRows[position[k]].parentNode.insertBefore(
                items[k],
                origRows[position[k]]
              );
            } else {
              this.container.appendChild(items[k]);
            }

            if (lazyItems.length && window.LazyLoad) {
              lazyItems.forEach(function (lazyItem) {
                window.LazyLoad.load(lazyItem);
              });
            }
          }
        }

        new BX.easing({
          duration: 2000,
          start: { opacity: 0 },
          finish: { opacity: 100 },
          transition: BX.easing.makeEaseOut(BX.easing.transitions.quad),
          step: function (state) {
            for (var k in items) {
              if (items.hasOwnProperty(k)) {
                items[k].style.opacity = state.opacity / 100;
              }
            }
          },
          complete: function () {
            for (var k in items) {
              if (items.hasOwnProperty(k)) {
                items[k].removeAttribute("style");
              }
            }
          },
        }).animate();
      }

      if (!window.lazyLoadInstance) {
        window.lazyLoadInstance.update();
      }

      BX.ajax.processScripts(processed.SCRIPT);
    },

    processPagination: function (paginationHtml) {
      if (!paginationHtml) {
        var paginationEl = document.querySelector(".product-grid__pagination");

        if (paginationEl) {
          paginationEl.remove();
        }

        return;
      } else {
        var pagination = document.querySelectorAll(
          '[data-pagination-num="' + this.navParams.NavNum + '"]'
        );
        for (var k in pagination) {
          if (pagination.hasOwnProperty(k)) {
            pagination[k].innerHTML = paginationHtml;
          }
        }
      }
    },

    processEpilogue: function (epilogueHtml) {
      if (!epilogueHtml) return;

      var processed = BX.processHTML(epilogueHtml, false);
      BX.ajax.processScripts(processed.SCRIPT);
    },

    showHeader: function (animate) {
      var parentNode = BX.findParent(this.container, {
          attr: { "data-entity": "parent-container" },
        }),
        header;

      if (parentNode && BX.type.isDomNode(parentNode)) {
        header = parentNode.querySelector('[data-entity="header"]');

        if (header && header.getAttribute("data-showed") != "true") {
          header.style.display = "";

          if (animate) {
            new BX.easing({
              duration: 2000,
              start: { opacity: 0 },
              finish: { opacity: 100 },
              transition: BX.easing.makeEaseOut(BX.easing.transitions.quad),
              step: function (state) {
                header.style.opacity = state.opacity / 100;
              },
              complete: function () {
                header.removeAttribute("style");
                header.setAttribute("data-showed", "true");
              },
            }).animate();
          } else {
            header.style.opacity = 100;
          }
        }
      }
    },
  };
})();