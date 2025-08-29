// MAIN HELP ITEM WITH BIRD
/*$(SetBirdPosition);
$(document).on("reload", SetBirdPosition);
function SetBirdPosition() {
	var $el = $("#main-help-decor-bird");
	var $form = $el.closest('form');
	calcBirdPosition();
	if ($el.length > 0 && $form.length > 0) {
		if (!$form.is('.js-decor-initialized')) {
			$form.on('change', function () {
				calcBirdPosition();
			});
			$form.addClass('js-decor-initialized');
		}
	}
	
	function calcBirdPosition() {
		var vLength = $form.find('.sum-line input[type="radio"]').length - 1;
		var cvIndex = $form.find('.sum-line input[type="radio"]:checked').index('.sum-line input[type="radio"]');
		var t = 'calc(' + $el.attr('data-sy') + ' + (' + $el.attr('data-ey') + ' - ' + $el.attr('data-sy') + ')*(' + cvIndex + '/' + vLength  + '))';
		var l = 'calc(' + $el.attr('data-sx') + ' + (' + $el.attr('data-ex') + ' - ' + $el.attr('data-sx') + ')*(' + cvIndex + '/' + vLength + '))';
		$el.css({top: t, left: l});
	}
}*/
/*$(document).on("mousedown touchstart", 'a.main-help-item.bg-orange', function (evt) {
	evt.preventDefault();
	window.open('https://dorogakdomu.ru/need-help/bankovskoy-kartoy/', '_blank');
});*/
