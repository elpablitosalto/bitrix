export const getInitData = async (params = {}) => {
	return window.BX.ajax.runComponentAction("waim:order", "init", {
		mode: 'class',
		data: params
	});
}

export const sendOrderRequest = async (params = {}) => {
	return window.BX.ajax.runComponentAction("waim:order", "sendOrderRequest", {
		mode: 'class',
		data: params
	});
}

export const refresh = async (params = {}) => {
	return window.BX.ajax.runComponentAction("waim:order", "refresh", {
		mode: 'class',
		data: params
	});
}

export const getLocationSuggestions = async (params = {}) => {
	return window.BX.ajax.runComponentAction("waim:order", "getLocationSuggestions", {
		mode: 'class',
		data: params
	});
}