document.addEventListener("DOMContentLoaded", function() {
	var script = document.getElementById('10d7881d78e22f631a26a1a0e823aa372ac77308');
	
	var par = script.parentNode;
	script.parentNode.style.overflow = 'hidden';
	
	var iframe = document.createElement('iframe');
	iframe.src = '/widgets/widget-1.html';
	iframe.style.width = '100%';
	iframe.style.height = '0px';
	iframe.style.border = 'none';
	iframe.style.overflow = 'hidden';
	iframe.setAttribute('allowfullscreen', 'allowfullscreen');
	iframe.className = '489';
	iframe.id = '062fa5128e028e13524c41b3393485a18577c915' + '_' + iframe.className;
	// name можно получить изнутри iframe
	iframe.name = iframe.className;
	
	var iframeId = iframe.id;
	
	var gcEmbedOnMessage = function(e) {
		var insertedIframe = document.getElementById(iframeId);
		if (!insertedIframe) {
			return;
		}
		
		if (e.data.uniqName == '10d7881d78e22f631a26a1a0e823aa372ac77308') {
			if (e.data.height) {
				if (e.data.iframeName) {
					if (e.data.iframeName == iframe.name) {
						par.style.height = ( e.data.height ) + "px";
						insertedIframe.style.height = (e.data.height) + "px";
					}
				} else {
					par.style.height = ( e.data.height ) + "px";
					insertedIframe.style.height = (e.data.height) + "px";
				}
			}
		}
	};
	
	if (window.addEventListener) {
		window.addEventListener("message", gcEmbedOnMessage, false);
	}  else if (window.attachEvent) {
		window.attachEvent('onmessage', gcEmbedOnMessage)
	} else {
		window['onmessage'] = gcEmbedOnMessage
	}
	
	script.parentNode.insertBefore(iframe, script);
	par.removeChild( script )
});

var getLocation = function(href) {
	var l = document.createElement("a");
	l.href = href;
	return l;
};

var currentScript = document.currentScript || (function() {
	var scripts = document.getElementsByTagName('script');
	return scripts[scripts.length - 1];
})();

var domain = ( (getLocation( currentScript.src )).hostname );