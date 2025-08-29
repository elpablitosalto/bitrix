function GreatBalancer(block) {
	var wrapWidth = $(block).parent().width(), //Узнаем ширину карточки товара
		blockWidth = $(block).outerWidth(), //Узнаем ширину родительской обертки
		wrapDivide = Math.floor(wrapWidth / blockWidth), //Производим расчет — сколько карточек влезет по ширине в обертку
		cellArr = $(block);
	for (var arg = 1; arg <= arguments.length; arg++) { //Сколько и каких элементов необходимо уравнять по высоте в одной карточке
		for (var i = 0; i <= cellArr.length; i = i + wrapDivide) {
			var maxHeight = 0,
				heightArr = [];
			for (j = 0; j < wrapDivide; j++) { //Сравнивает эти высоты в каждой карточке имитируемого ряда, и находит наибольшее значение высоты сравниваемых элементов
				heightArr.push($(cellArr[i + j]).find(arguments[arg]));
				heightArr[j].outerHeight("");//очистить предыдущую работу скрипта //добавила 02.11.17
				if (heightArr[j].outerHeight() > maxHeight) {
					maxHeight = heightArr[j].outerHeight();
				}
			}
			for (var counter = 0; counter < heightArr.length; counter++) { //Назначает соответствующие высоты всем элементам которые попали в область сравнения.
				$(cellArr[i + counter]).find(arguments[arg]).outerHeight(maxHeight);
			}
		}
	}
}

$(window).resize(function () {
	GreatBalancer(".sp-offer-item", ".img-wrapper", ".title", ".descr");
});

$(document).ready(function () {
	$(document).one({
		'scroll touchstart mouseenter click': function () {
			GreatBalancer(".sp-offer-item", ".img-wrapper", ".title", ".descr");
		}
	});
});