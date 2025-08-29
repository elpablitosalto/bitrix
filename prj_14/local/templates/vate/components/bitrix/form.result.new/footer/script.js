"use strict";
function ajaxFooterFeedbackForm(link) {
  var feedbackForm = document.getElementById("footerFeedbackForm");

  if (feedbackForm) {
    var form = StandardForm();
    form.init(feedbackForm);

    form.onSuccess(function (e) {
      e.preventDefault();
      console.log("onSuccess");

      let xhr = new XMLHttpRequest();
      xhr.open("POST", link);

      xhr.onload = function () {
        if (xhr.status != 200) {
          alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
        } else {
          var json = JSON.parse(xhr.responseText);

          if (!json.success) {
            let errorStr = "";
            for (let fieldKey in json.errors) {
              errorStr += json.errors[fieldKey] + "<br>";
            }

            // Ошибки вывести в элемент с классом error-msg
            feedbackForm.getElementsByClassName("form__message")[0].innerHTML =
              errorStr;
          } else {
            // Показываем сообщение об успешной отправке
            feedbackForm.classList.add("form_state_sent");
          }
        }
      };

      xhr.onerror = function () {
        console.log("Запрос не удался");
      };

      xhr.send(new FormData(feedbackForm));
    });
  }
}