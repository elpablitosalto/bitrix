(function ymap() {
	window.addEventListener('load', function () {
		const mapElement = document.querySelector('.js-map');

		if (!mapElement) {
			return;
		}

		window.ymap = null;

		async function load() {
			await ymaps3.ready;
			const {
				YMap,
				YMapDefaultSchemeLayer,
				YMapControls,
				YMapDefaultFeaturesLayer,
				YMapMarker
			} = ymaps3;

			const {YMapGeolocationControl, YMapZoomControl} = await ymaps3.import('@yandex/ymaps3-controls@0.0.1');
			const controlsRight = new YMapControls({position: 'right'});
			const controlsLeft = new YMapControls({position: 'left'});
			const geolocationControl = new YMapGeolocationControl();
			const zoomControl = new YMapZoomControl();
			controlsRight.addChild(geolocationControl);
			controlsLeft.addChild(zoomControl);

			window.ymap = new YMap(mapElement, {
				behaviors: ['drag', 'mouseRotate', 'mouseTilt', 'magnifier', 'pinchRotate', 'panTilt', 'scrollZoom'],
				camera: {
					azimuth: 0,
					tilt: 1
				},
				location: window.ymapSettings.props.location
			}, [new YMapDefaultSchemeLayer(), new YMapDefaultFeaturesLayer(), controlsRight, controlsLeft]);

			if (window.ymapSettings.markers && window.ymapSettings.markers.length) {
				window.ymapSettings.markers.forEach(function (markerSettings) {
					window.ymap.addChild(createMarker(markerSettings, YMapMarker));
				});
			}
		}

		function createMarker(settings, YMapMarker) {
			const el = document.createElement('IMG');
			const icon = {
				className: 'map__marker',
				src: '/assets/blocks/map/images/marker.png',
				...settings.icon
			};
			const position = settings.center || window.ymapSettings.props.location.center;

			el.classList.add(icon.className);
			el.src = icon.src;
			el.addEventListener('click', function () {
				panMapTo(position);
			});

			const marker = new YMapMarker({coordinates: position}, el);
			return marker;
		}

		function panMapTo(center, zoom, duration) {
			zoom = typeof zoom === 'number' ? zoom : 20;
			duration = typeof duration === 'number' ? duration : 500;
			window.ymap.update({
				location: {
					center,
					zoom,
					duration
				},
				camera: {
					azimuth: window.ymap.azimuth,
					tilt: window.ymap.tilt,
					duration
				},
			});
		}

		load();

		ymaps3.ready.then(() => {
			console.log('ymaps3 ready');
		});
	});
})();
