<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<div id="rec604606306" class="r t-rec t-rec_pt_120 t-rec_pb_135" style="padding-top:120px;padding-bottom:135px;background-color:#ffffff; " data-record-type="259" data-bg-color="#ffffff">
	<!-- T230 -->
	<div class="t230">
		<div class="t-container">
			<div class="t-col t-col_6 ">
				<div class="t230__title t-title t-title_xxs" field="title">
					<div style="font-size: 34px;" data-customstyle="yes">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kkm/" . basename(__FILE__, '.php') . "_text_profi.php",
                            )
                        ); ?>
                    </div>
				</div>
				<div class="t230__text t-text t-text_md" field="text">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/kkm/" . basename(__FILE__, '.php') . "_text_profi2.php",
                        )
                    ); ?>
                </div>
			</div>
			<div class="t-col t-col_6 t230__videoblock">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/content/kkm/" . basename(__FILE__, '.php') . "_block_video.php",
                    )
                ); ?>
				<div class="t230__sectitle t-descr" field="imgtitle">
					<p style="text-align: left;">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kkm/" . basename(__FILE__, '.php') . "_text_profi3.php",
                            )
                        ); ?>
                    </p>
				</div>
				<div class="t230__secdescr t-descr" field="imgdescr"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		t_onReady(function() {
			var rec = document.getElementById('rec604606306');
			if (!rec) return;
			t_onFuncLoad('t230_setHeight', function() {
				t230_setHeight(rec);
				window.addEventListener(
					'scroll',
					t_throttle(function() {
						t230_setHeight(rec);
					}, 200)
				);
			});
			if (typeof jQuery !== 'undefined') {
				$('.t230').bind('displayChanged', function() {
					t_onFuncLoad('t230_setHeight', function() {
						t230_setHeight(rec);
					});
				});
			} else {
				var wrapperBlock = rec.querySelector('.t230');
				if (wrapperBlock) {
					wrapperBlock.addEventListener('displayChanged', function() {
						t_onFuncLoad('t230_setHeight', function() {
							t230_setHeight(rec);
						});
					});
				}
			}
		});
	</script>
</div>