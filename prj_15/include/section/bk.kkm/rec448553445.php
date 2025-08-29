<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<div id="rec448553445" class="r t-rec t-rec_pt_90 t-rec_pb_90"
     style="padding-top:90px;padding-bottom:90px;background-color:#1f0c2e; " data-record-type="4"
     data-bg-color="#1f0c2e"><!-- T121 -->
    <div class="t121">
        <center>
            <div class="t-video-lazyload t-width t-width_10" style="height:540px; "
                 data-videolazy-type="youtube"
                 data-videolazy-id="1IaWz0REXsE" data-blocklazy-id="448553445" data-videolazy-load="false"
                 data-videolazy-height="540px"></div>
        </center>
    </div>
    <script>t_onReady(function () {
            var rec = document.getElementById('rec448553445');
            if (!rec) return;
            t_onFuncLoad('t121_setHeight', function () {
                t121_setHeight('448553445');
                window.addEventListener('scroll', t_throttle(function () {
                    t121_setHeight('448553445');
                }));
            });
            window.onload = function () {
                t_onFuncLoad('t121_setHeight', function () {
                    t121_setHeight('448553445');
                });
            };
            window.addEventListener('resize', function () {
                var tableView = document.getElementById('allrecordstable');
                if (tableView) {
                    var videoLazyLoad = rec.querySelector('.t-video-lazyload');
                    if (!videoLazyLoad) return;
                    videoLazyLoad.style.height = '540px';
                    var videoLazyLoadIframe = videoLazyLoad.querySelector('iframe');
                    if (!videoLazyLoadIframe) return;
                    videoLazyLoadIframe.height = '540';
                } else {
                    t_onFuncLoad('t121_setHeight', function () {
                        t121_setHeight('448553445');
                    });
                }
            });
            var wrapperBlock = rec.querySelector('.t121');
            if (wrapperBlock) {
                t_onFuncLoad('t121_setHeight', function () {
                    wrapperBlock.addEventListener('displayChanged', function () {
                        t121_setHeight('448553445');
                    });
                });
            }
        });</script>
</div>

