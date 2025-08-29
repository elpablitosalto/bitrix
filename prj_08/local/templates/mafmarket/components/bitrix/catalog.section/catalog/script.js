function CartAction(id, action) {
	if (CartAction.requestNow)
		return false;
	CartAction.requestNow = true;

	var dataRequest = {
		id: id,
		action: action,
		quantity: 1,
		ajax_basket: "Y"
	};

	var request = $.ajax({
		url: window.location.href,
		type: 'POST',
		data: dataRequest,
		dataType: 'html'
	});

	request.fail(function (jqXHR, textStatus) {
		console.log('fail: ' + textStatus);
		CartAction.requestNow = false;
	});
	request.statusCode(function (errorCode) {
		console.log('statusCode: ' + errorCode);
		CartAction.requestNow = false;
	});
	request.done(function (html) {
		var data = JSON.parse(html);
		alert(data.MESSAGE);
		CartAction.requestNow = false;
		//UpdateCart.isActual = false;
		//UpdateCart(true, true);
	});
}

$(function () {
	$("[data-offer-select] [type='radio']").on("change", function () {
		var popup = $(this).parents('[data-offer-select]');
		var currentButton = $("button[data-modal='#"+popup.attr("id")+"']");
		var imgLink = $(this).parent().find("img").attr("src");
		currentButton.find("span").html($(this).val() || "Не выбрано");
		currentButton.find("img").attr("src",imgLink)

		itemId = popup.data("offer-select");
		var data = {
			"id": itemId,
			"PROPERTY_VID_DREVESINY_BRUSKA_DOSKI": $("[name='"+itemId+"-tree']:checked").val() || "",
			"PROPERTY_METALL": $("[name='"+itemId+"-metal']:checked").val() || "",
			"PROPERTY_OKRAS_BRUSKA": $("[name='"+itemId+"-color']:checked").val() || "",
			"PROPERTY_TSVET_METALLICHESKOGO_POKRYTIYA": $("[name='"+itemId+"-ral']:checked").val() || "",
		}
		var request = $.ajax({
			url: "/local/ajax/search_offers.php",
			method: "POST",
			data: data,
			dataType: "json"
		});
		request.done(function( result ) {
			$( "[data-offer-select='"+itemId+"']" ).not( ".dp-modal_active" ).each(function() {
				var prop = $(this).data("property");
				if(result[prop]){
					$(this).find("[type='radio']").each(function() {
						if($(this).val()){
							if(result[prop].includes($(this).val())){
								$(this).next("label").show();
							} else {
								$(this).next("label").hide();
							}
						}
					});
				}
				if(result["ELEMENTS"]){
					$("[data-accept='"+itemId+"']").attr("data-value",result["ELEMENTS"][0])
				}
			});
		});
	});

	$("[data-accept]").on("click", function (e) {
		e.preventDefault();
		CartAction($(this).attr("data-value"),"ADD2BASKET");
	});
});

