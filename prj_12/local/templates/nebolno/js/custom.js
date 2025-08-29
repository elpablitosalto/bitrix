$(document).ready(function () {
  InitPopupDoctorClick();

  InitPopupButtonsClicks();

  if (window.location.pathname === '/contacts/') {
    $('.nb-affiliated--phone').each((index, item) => {
      $(item).html(
        `<a href="${$(item).text()}" class="nb-affiliated--phone">${$(
          item
        ).text()}</a>`
      );
    });
  }
});

function InitPopupButtonsClicks() {
  BX.addCustomEvent('onAjaxSuccess', function () {
    modals();
  });
}

function InitPopupDoctorClick() {
  $('.js_popup_doctor').on('click', function (e) {
    var doctor_id = $(this).data('doctor-id');
    setTimeout(setDoctorId(doctor_id), 2000);
  });
}
function setDoctorId(doctor_id) {
  $('#HIDDEN_DOCTOR_ID').val(doctor_id);
}
