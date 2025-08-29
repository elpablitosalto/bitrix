"use strict";
(() => {
  if (typeof window.feedbackFormHandler === "function") return

  window.feedbackFormHandler = (formId) => {
    const delay = 700
    if(typeof StandardForm === 'undefined' || !formId) return
    const formNode = document.getElementById(formId)
    if (!formNode) return

    const messageContainer = formNode.querySelector(".form__message")

    const formValidator = StandardForm()
    formValidator.init(formNode)

    formValidator.onSuccess((e) => {
      e.preventDefault()

      if (typeof BX.ajax === 'function') {
        formNode.classList.remove("form_has_errors")
        formNode.classList.add("form_is_loading")
        messageContainer.innerHTML = ''

        BX.ajax
          .runComponentAction("waim:feedback.form", "send", {
            mode: "class",
            data: new FormData(formNode),
          })
          .then((response) => {
            setTimeout(() => {
              const modalNode = formNode.closest(".modal")
              if (modalNode) {
                formNode.closest(".modal").classList.add("modal_state_sent");
              }
              formNode.classList.add("form_state_sent")
              formNode.classList.remove("form_is_loading")
              formNode.reset()
            }, delay)
          })
          .catch((error) => {
            const errors = error.errors || [],
              errorMessages = errors.map((error) => {
                if (error.message) return error.message
              })

            if (errorMessages.length) {
              if (messageContainer) {
                messageContainer.innerHTML = errorMessages.join("\n")
              }
              setTimeout(() => {
                formNode.classList.remove("form_is_loading")
                formNode.classList.add("form_has_errors")
              }, delay);
            } else {
              setTimeout(() => {
                formNode.classList.remove("form_is_loading")
              }, delay)
            }
          })
      }
    })
  }
})();