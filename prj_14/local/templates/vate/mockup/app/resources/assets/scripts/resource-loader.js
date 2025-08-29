(function () {
	'use strict';
	console.log('resource-loader.js is ready');

	const loggingEnabled = 0 <= window.location.search.indexOf('resourceLoaderLogging');

	function dispatchCustomEvent(eventName, el, data) {
		var evt = document.createEvent('HTMLEvents');

		if (el) {
			evt.initEvent(eventName, true, true);
			evt.data = data;
			el.dispatchEvent(evt);
		}
	}

	function createResourceElement(source) {
		const tag = source.type === 'js' ? 'script' : 'link';
		const element = document.createElement(tag);
		if (source.name) {
			element.dataset.sourceName
		}

		switch (source.type) {
			case 'css':
				element.href = source.src;
				element.rel = 'stylesheet';
				break;
			default:
				element.src = source.src;
		}

		return element;
	}

	function addResource(source) {
		if (source.src) {
			return new Promise(function (resolve, reject) {
				let element = createResourceElement(source);

				if (source.type === 'js') {
					element.addEventListener('load', function () {
						if (loggingEnabled) console.log(`${source.src} connected successfully`);
						resolve(element);
					});

					element.onerror = () => reject(new Error(`${source.src} loading error`));
				} else {
					if (loggingEnabled) console.log(`${source.src} connected successfully`);
					resolve(element);
				}

				document.head.append(element);
			});
		}

		return false;
	}

	async function setElements(sources) {
		let current = 0;
		const max = sources.length;

		for (current; current < max; current++) {
			await addResource(sources[current])
				.then(function () {
					dispatchCustomEvent(sources[current].name + '-load', document.body);
				});
		}
	}

	window.resourceLoader = {};
	window.resourceLoader.load = async function (name) {
		if (!appResources) return;
		if (!appResources.hasOwnProperty(name)) return;
		if (appResources[name].initiated) return;

		const group = appResources[name];
		const resources = group.items;

		group.initiated = true;

		if (!resources.length) {
			return;
		}

		if (group.delay) {
			setTimeout(function () {
				if (loggingEnabled) console.log(`Loading ${name} resources (${resources.length})...`);
				setElements(resources);
			}, group.delay);
		} else {
			if (loggingEnabled) console.log(`Loading ${name} resources (${resources.length})...`);
			setElements(resources);
		}
	}

	window.resourceLoader.launch = function (resourceName, eventName, keyVariable, callback) {
		if (!resourceName) {
			throw new Error('Supply a resource name to load as 1st argument');
		}

		if (!keyVariable && keyVariable !== undefined) {
			throw new Error('Supply a variable to check as 3rd argument');
		}

		if (!callback) {
			throw new Error('Supply a callback to execute as 4th argument');
		}

		if (typeof keyVariable !== 'undefined') {
			callback();
		} else {
			document.body.addEventListener(eventName, function () {
				callback();
			}, {
				once: true
			});

			window.resourceLoader.load(resourceName);
		}
	}
})();
