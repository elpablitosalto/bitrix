"use strict";
!function (o) {
  let t;
  const l = (t, l) => {
    const a = t.closest(".rs__modal__row"), d = e(a, l);
    a.find(".rs__modal__close_top").remove(), d && o.isFunction(d.modalOptions.beforeClose) && d.modalOptions.beforeClose(a), l.cache && n(a, l), setTimeout((() => {
      a.remove(), s("close");
    }), 10);
  }, e = (o, t) => {
    const l = t.container, e = !0 === l || "custom" === l ? ".rs__modal__cell > :first" : ".rs__modal__content > :first", n = o.find(e)[0];
    return !(!n || void 0 === n.modalOptions) && n;
  }, n = (t, l) => {
    o(".rs__modal__hidden").length || o("body").append(o('<div class="rs__modal__hidden is-hidden" style="display: none;"></div>'));
    const e = l.container, n = !0 === e || "custom" === e ? ".rs__modal__content" : ".rs__modal__cell";
    t.find("".concat(n, " > *")).appendTo(o(".rs__modal__hidden"));
  }, s = t => {
    "close" === t ? o(".rs__modal > div").length || (o(".rs__modal").remove(), o("body").removeClass("rs__modal-show")) : o(".rs__modal").length || (o('<div class="rs__modal">').appendTo("body"), setTimeout((() => {
      o("body").addClass("rs__modal-show");
    }), 100));
  }, a = {
    init: function (e) {
      return (() => {
        const t = o(document), l = o(window);
        if (t.height() > l.height()) {
          const o = window.innerWidth - t.width();
          document.documentElement.style.setProperty("--scroll-bar", "".concat(o, "px"));
        }
      })(), this.unbind("rs__modal"), this.each((function () {
        e = o.extend({cache: !1, afterOpen: !1, beforeClose: !1, closeButton: !0, bgClose: !0, bgColor: "", swipeClose: !1, container: !1, class: ""}, e), s();
        const n = {};
        n.modal = o(this).removeClass("hide"), n.modal[0].modalOptions = e;
        const a = e.container;
        n.html = o(!0 === a && "custom" !== a ? '<div class="rs__modal__row"><div class="rs__modal__cell"><div class="rs__modal__content '.concat(e.class, '"></div></div></div>') : '<div class="rs__modal__row"><div class="rs__modal__cell '.concat(e.class, '"></div></div>'));
        const d = !0 === a && "custom" !== a ? ".rs__modal__content" : ".rs__modal__cell";
        n.html.find(d).append(n.modal), n.html.prependTo(".rs__modal"), n.modal.show(), e.closeButton && (n.modal.append(o('<span class="rs__modal__close rs__modal__close_top"></span>')), n.html.find(".rs__modal__close").on("click", (function (t) {
          t.preventDefault(), l(o(this), e);
        }))), o.isFunction(e.afterOpen) && e.afterOpen(o(this)), e.bgClose && (o(".rs__modal").hasClass("init").length || o(".rs__modal").addClass("init").on("mousedown", (function (t) {
          o(t.target).hasClass("rs__modal__row") && !o(t.target).closest(".rs__modal__row").hasClass("loading") && (o(t.target).find(".rs__modal__cell").first().is(".rs__modal__content") ? l(o(t.target), o(t.target).find(".rs__modal__content > :first")[0].modalOptions) : l(o(t.target), o(t.target).find(".rs__modal__cell > :first")[0].modalOptions));
        }))), "" !== e.bgColor && o(".rs__modal__content").css("background-color", e.bgColor), t = e;
      }));
    }, close: function () {
      const e = this;
      setTimeout((() => {
        e.each((function () {
          l(o(this), t);
        }));
      }), 100);
    },
  };
  o.fn.modal = function (t, l) {
    return a[t] ? a[t].apply(this, Array.prototype.slice.call(arguments, 1), l) : "object" != typeof t && t ? void o.error("Метод ".concat(t, " не существует в jQuery.modal")) : a.init.apply(this, arguments);
  };
}(jQuery);