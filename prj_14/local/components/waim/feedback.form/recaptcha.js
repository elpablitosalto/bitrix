(() => {
  console.log("reCaptcha is ready");
  function initCaptcha() {
    if (!window.recaptchaSiteKey) return;

    grecaptcha.ready(() => {
      grecaptcha
        .execute(window.recaptchaSiteKey, { action: "sendForm" })
        .then((token) => {
          document
            .querySelectorAll("[name='recaptcha_response']")
            .forEach((field) => {
              field.value = token;
            });
        });
    });
  }

  function init() {
    initCaptcha();

    // Обновление капчи после AJAX-запросов, если используется Bitrix
    if (typeof BX !== "undefined") {
      BX.addCustomEvent("onAjaxSuccess", initCaptcha);
    }

    // Периодическое обновление капчи
    setInterval(initCaptcha, 100000);

    // Обновление капчи при кастомном событии
    document.addEventListener("recaptchaReloadEvent", initCaptcha);
  }

  document.addEventListener("DOMContentLoaded", () => {
    document.body.addEventListener("click", () => {
      if (typeof grecaptcha !== "undefined") {
        init();
      } else if (window.resourceLoader) {
        document.body.addEventListener("recaptcha-js-load", init);
        window.resourceLoader.load("recaptcha");
      }
    });
  });
})();
