$(document).ready(function () {

	var $body = $('body');

	var $modalPracticingDoctor = $('#modal-practicing-doctor');
	if ($modalPracticingDoctor.length) {
		$body.addClass("overflow-hidden");
		$modalPracticingDoctor .addClass("dp-modal_active").fadeIn(300);
	}

	var $modalCookies = $('#modal-cookies');
	if ($modalCookies.length) {
		$body.addClass("overflow-hidden");
		$modalCookies.addClass("dp-modal_active").fadeIn(300);
	}

	var $modalAdblock = $('#modal-adblock');
	if ($modalAdblock .length) {
		$body.addClass("overflow-hidden");
		$modalAdblock .addClass("dp-modal_active").fadeIn(300);
	}

});