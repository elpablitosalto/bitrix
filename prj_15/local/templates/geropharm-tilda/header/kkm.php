<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<!-- Assets -->
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-fallback-1.0.min.js" async charset="utf-8"></script>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-grid-3.0.min.css" type="text/css" media="all" onerror="this.loaderr='y';"/>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-blocks-page37418060.min.css" type="text/css" media="all" onerror="this.loaderr='y';"/>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-animation-2.0.min.css" type="text/css" media="all" onerror="this.loaderr='y';"/>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/highlight.min.css" type="text/css" media="all" onerror="this.loaderr='y';"/>
<?/*<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-popup-1.1.min.css" type="text/css" media="print" onload="this.media='all';" onerror="this.loaderr='y';" /><noscript>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-popup-1.1.min.css" type="text/css" media="all" /></noscript>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-forms-1.0.min.css" type="text/css" media="all" onerror="this.loaderr='y';" />*/?>
<script nomodule src="<?=SITE_TEMPLATE_PATH?>/js/tilda-polyfill-1.0.min.js" charset="utf-8"></script>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/custom.css" type="text/css" media="all" onerror="this.loaderr='y';"/>

<script type="text/javascript">
	function t_onReady(func) {
		if (document.readyState != 'loading') {
			func();
		} else {
			document.addEventListener('DOMContentLoaded', func);
		}
	}

	function t_onFuncLoad(funcName, okFunc, time) {
		if (typeof window[funcName] === 'function') {
			okFunc();
		} else {
			setTimeout(function() {
				t_onFuncLoad(funcName, okFunc, time);
			}, (time || 100));
		}
	}

	function t_throttle(fn, threshhold, scope) { return function() { fn.apply(scope || this, arguments); }; }

	function t396_initialScale(t) { var e = document.getElementById("rec" + t); if (e) { var r = e.querySelector(".t396__artboard"); if (r) { var a, i = document.documentElement.clientWidth,
		l = [],
		d = r.getAttribute("data-artboard-screens"); if (d) { d = d.split(","); for (var o = 0; o < d.length; o++) l[o] = parseInt(d[o], 10) } else l = [320, 480, 640, 960, 1200]; for (o = 0; o < l.length; o++) { var n = l[o];
		n <= i && (a = n) } var g = "edit" === window.allrecords.getAttribute("data-tilda-mode"),
		u = "center" === t396_getFieldValue(r, "valign", a, l),
		c = "grid" === t396_getFieldValue(r, "upscale", a, l),
		t = t396_getFieldValue(r, "height_vh", a, l),
		f = t396_getFieldValue(r, "height", a, l),
		e = !!window.opr && !!window.opr.addons || !!window.opera || -1 !== navigator.userAgent.indexOf(" OPR/"); if (!g && u && !c && !t && f && !e) { for (var s = parseFloat((i / a).toFixed(3)), _ = [r, r.querySelector(".t396__carrier"), r.querySelector(".t396__filter")], o = 0; o < _.length; o++) _[o].style.height = parseInt(f, 10) * s + "px"; for (var h = r.querySelectorAll(".t396__elem"), o = 0; o < h.length; o++) h[o].style.zoom = s } } } }

	function t396_getFieldValue(t, e, r, a) { var i = a[a.length - 1],
		l = r === i ? t.getAttribute("data-artboard-" + e) : t.getAttribute("data-artboard-" + e + "-res-" + r); if (!l)
		for (var d = 0; d < a.length; d++) { var o = a[d]; if (!(o <= r) && (l = o === i ? t.getAttribute("data-artboard-" + e) : t.getAttribute("data-artboard-" + e + "-res-" + o))) break }
		return l }
</script>

<?/*<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.10.2.min.js" charset="utf-8" onerror="this.loaderr='y';"></script>*/?>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-scripts-3.0.min.js" charset="utf-8" defer onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-blocks-page37418060.min.js?t=1705671611" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-lazyload-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-animation-2.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/highlight.min.js" charset="utf-8" onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-zero-1.1.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-video-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-video-processor-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<?/*<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-popup-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>*/?>
<?/*<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-forms-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>*/?>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-menu-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-zero-scale-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-zero-tooltip-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-zero-video-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-skiplink-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-events-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>

<script type="text/javascript">(function () {
        if ((/bot|google|yandex|baidu|bing|msn|duckduckbot|teoma|slurp|crawler|spider|robot|crawling|facebook/i.test(navigator.userAgent)) === false && typeof (sessionStorage) != 'undefined' && sessionStorage.getItem('visited') !== 'y' && document.visibilityState) {
            var style = document.createElement('style');
            style.type = 'text/css';
            style.innerHTML = '@media screen and (min-width: 980px) {.t-records {opacity: 0;}.t-records_animated {-webkit-transition: opacity ease-in-out .2s;-moz-transition: opacity ease-in-out .2s;-o-transition: opacity ease-in-out .2s;transition: opacity ease-in-out .2s;}.t-records.t-records_visible {opacity: 1;}}';
            document.getElementsByTagName('head')[0].appendChild(style);

            function t_setvisRecs() {
                var alr = document.querySelectorAll('.t-records');
                Array.prototype.forEach.call(alr, function (el) {
                    el.classList.add("t-records_animated");
                });
                setTimeout(function () {
                    Array.prototype.forEach.call(alr, function (el) {
                        el.classList.add("t-records_visible");
                    });
                    sessionStorage.setItem("visited", "y");
                }, 400);
            }

            document.addEventListener('DOMContentLoaded', t_setvisRecs);
        }
    })();
</script>