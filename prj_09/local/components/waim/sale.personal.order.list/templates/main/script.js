BX.namespace('BX.Sale.PersonalOrderComponent');

(function() {
	BX.Sale.PersonalOrderComponent.PersonalOrderList = {
		init : function(params)
		{
			var rowWrapper = document.getElementsByClassName('profile__order-group')[0];

			params.paymentList = params.paymentList || {};
			params.url = params.url || "";
			params.templateName = params.templateName || "";
			params.returnUrl = params.returnUrl || "";

            BX.bindDelegate(rowWrapper, 'submit', { 'class': 'js-order-search' }, BX.proxy(function(event)
            {
                event.preventDefault();
                BX.showWait();
                var form = rowWrapper.getElementsByClassName('js-order-search')[0];

                BX.ajax(
                    {
                        method: 'POST',
                        dataType: 'html',
                        url: params.url,
                        data:
                            {
                                order_search: form.getElementsByClassName("js-order-group-search")[0].value,
                                params: params,
                            },
                        onsuccess: BX.proxy(function(result)
                        {
                            BX.closeWait();
                            rowWrapper.outerHTML = result;
                        },this),
                        onfailure: BX.proxy(function()
                        {
                            BX.closeWait();
                            return false;
                        }, this)
                    }, this
                );
                return false;
            }, this));
		}
	};
})();
