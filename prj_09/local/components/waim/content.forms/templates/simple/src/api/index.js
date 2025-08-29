const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const debug = urlParams.get('debug')
console.log('debug', debug);

export const api = {
	sendSimpleForm: async (params = {}) => {
		console.log('sendSimpleForm', params);
		if (debug) {
			return debugSendSimpleForm();
		} else {
			return window.BX.ajax.runComponentAction("waim:content.forms", "sendSimpleForm", {
				mode: 'class',
				data: params
			});
		}
	}
};

/* DEBUG */
const debugSendSimpleForm = async (params) => {
	console.log('debugSendSimpleForm');
	let result = {status: true};

	return new Promise((resolve) => {
		setTimeout(() => {
			resolve(result);
		}, 200);
	});
}