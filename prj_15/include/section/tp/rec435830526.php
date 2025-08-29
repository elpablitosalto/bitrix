<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<div id="rec435830526" class="r t-rec t-rec_pt_45 t-rec_pb_120"
     style="padding-top:45px;padding-bottom:120px;background-color:#f7f5fa; " data-record-type="191"
     data-bg-color="#f7f5fa"><!-- T142 -->
    <div class="t142">
        <div class="t-container_100">
            <div class="t142__wrapone">
                <div class="t142__wraptwo">
					<a id="btn-scroll-to-prices-1" class="t-btn t142__submit t-btn_md" href="#rec435805837" style="color:#ffffff;background-color:#2b00ff;border-radius:30px; -moz-border-radius:30px; -webkit-border-radius:30px;">
						<span class="t142__text">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR . "include/content/tp/" . basename(__FILE__, '.php') . "_button.php",
								)
							);?>
                        </span>
					</a>
				</div>
            </div>
        </div>
    </div>
    <script>
		$(function () {
			$('#btn-scroll-to-prices-1').on('click', function (e) {
				e.preventDefault();
				scrollToTarget('#rec435805837');
			});
		});
		t_onReady(function () {
            t_onFuncLoad('t142_checkSize', function () {
                t142_checkSize('435830526');
            });
        });
        window.addEventListener('load', function () {
            t_onFuncLoad('t142_checkSize', function () {
                t142_checkSize('435830526');
            });
        });
	</script>
</div>

