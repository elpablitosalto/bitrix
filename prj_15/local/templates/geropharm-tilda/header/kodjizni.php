<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-fallback-1.0.min.js" async charset="utf-8"></script>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-grid-3.0.min.css" type="text/css" media="all" onerror="this.loaderr='y';"/>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-blocks-page36907045.min.css" type="text/css" media="all" onerror="this.loaderr='y';"/>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-animation-2.0.min.css" type="text/css" media="all" onerror="this.loaderr='y';"/>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-menusub-1.0.min.css" type="text/css" media="all"/>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-feed-1.0.min.css" type="text/css" media="all"/>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-popup-1.1.min.css" type="text/css" media="all"/>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-slds-1.4.min.css" type="text/css" media="all"/>
<?/*<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-forms-1.0.min.css" type="text/css" media="all" onerror="this.loaderr='y';"/>*/?>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/tilda-zero-form-horizontal.min.css" type="text/css" media="all" onerror="this.loaderr='y';"/>

<script type="text/javascript">

    (function (d) {
        if (!d.visibilityState) {
            var s = d.createElement('script');
            s.src = '<?=SITE_TEMPLATE_PATH?>js/tilda-polyfill-1.0.min.js';
            d.getElementsByTagName('head')[0].appendChild(s);
        }
    })(document);

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
            setTimeout(function () {
                t_onFuncLoad(funcName, okFunc, time);
            }, (time || 100));
        }
    }

    function t_throttle(fn, threshhold, scope) {
        return function () {
            fn.apply(scope || this, arguments);
        };
    }

    function t396_initialScale(t) {
        t = document.getElementById("rec" + t);
        if (t) {
            t = t.querySelector(".t396__artboard");
            if (t) {
                var e, r = document.documentElement.clientWidth, a = [];
                if (i = t.getAttribute("data-artboard-screens")) for (var i = i.split(","), l = 0; l < i.length; l++) a[l] = parseInt(i[l], 10); else a = [320, 480, 640, 960, 1200];
                for (l = 0; l < a.length; l++) {
                    var o = a[l];
                    o <= r && (e = o)
                }
                var d = "edit" === window.allrecords.getAttribute("data-tilda-mode"),
                    n = "center" === t396_getFieldValue(t, "valign", e, a),
                    g = "grid" === t396_getFieldValue(t, "upscale", e, a), u = t396_getFieldValue(t, "height_vh", e, a),
                    c = t396_getFieldValue(t, "height", e, a),
                    f = !!window.opr && !!window.opr.addons || !!window.opera || -1 !== navigator.userAgent.indexOf(" OPR/");
                if (!d && n && !g && !u && c && !f) {
                    for (var h = parseFloat((r / e).toFixed(3)), s = [t, t.querySelector(".t396__carrier"), t.querySelector(".t396__filter")], l = 0; l < s.length; l++) s[l].style.height = Math.floor(parseInt(c, 10) * h) + "px";
                    for (var _ = t.querySelectorAll(".t396__elem"), l = 0; l < _.length; l++) _[l].style.zoom = h
                }
            }
        }
    }

    function t396_getFieldValue(t, e, r, a) {
        var i = a[a.length - 1],
            l = r === i ? t.getAttribute("data-artboard-" + e) : t.getAttribute("data-artboard-" + e + "-res-" + r);
        if (!l) for (var o = 0; o < a.length; o++) {
            var d = a[o];
            if (!(d <= r) && (l = d === i ? t.getAttribute("data-artboard-" + e) : t.getAttribute("data-artboard-" + e + "-res-" + d))) break
        }
        return l
    }

	function indexis_mb_event(id) {
		document.querySelector('#form' + id).addEventListener('tildaform:aftersuccess', function() {
			var emailInput = element.querySelectorAll('input[name="email"]');
			console.log(emailInput.value);
			mindboxSubscriptionLifeCode(emailInput.value);
		})
	}

</script>
<?/*<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.10.2.min.js" charset="utf-8" onerror="this.loaderr='y';"></script>*/?>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-scripts-3.0.min.js" charset="utf-8" defer onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-blocks-page36907045.min.js?t=1691483989" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/lazyload-1.3.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-animation-2.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-zero-1.1.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-menusub-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-menu-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-feed-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-slds-1.4.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/hammer.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-popup-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-animation-sbs-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-zero-scale-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-zero-fixed-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-skiplink-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/tilda-events-1.0.min.js" charset="utf-8" async onerror="this.loaderr='y';"></script>
<script type="text/javascript">window.dataLayer = window.dataLayer || [];</script>
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
    })();</script>
