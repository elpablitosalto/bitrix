<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<div id="rec604508695" class="r t-rec" style="background-color:#ffffff; " data-animationappear="off" data-record-type="131" data-bg-color="#ffffff">
	<!-- T123 -->
	<div class="t123">
		<div class="t-container_100 ">
			<div class="t-width t-width_100 ">
				<script>
					function mySuccessFunction(form) {
						if (!form) return;

						const formData = {};
						const formInputs = form.querySelectorAll('.t-input');
						formInputs.forEach(input => {
							formData[input.name] = input.value;
						});
						const specialty = document.querySelector("[name='speciality_1']").value;
						console.log('r', specialty, formData.Email);
						mindbox("async", {
							operation: "Website.GetMaterialsCourse",
							data: {
								customerAction: {
									customFields: {
										courseName: "Общение с пациентом по Калгари-Кембрижской модели"
									}
								},
								customer: {
									email: formData.Email,
									customFields: {
										specialty: [
											specialty
										],
									},
									subscriptions: [
										{
											"pointOfContact": "Email"
										},
										{
											"pointOfContact": "SMS"
										}
									]
								}
							}
						});
					}
					if (document.readyState !== 'loading') {
						us_sendFormAfterSuccess();
					} else {
						document.addEventListener('DOMContentLoaded', us_sendFormAfterSuccess);
					}


					var ITERATION_COUNT = 10;
					var INTERVAL = 1000;
					var iterationIndex = 0;
					function us_sendFormAfterSuccess() {
						var forms = document.querySelectorAll('.js-form-proccess');
						if(forms.length === 0 && iterationIndex++ < ITERATION_COUNT){
							setTimeout(us_sendFormAfterSuccess, INTERVAL);
							return;
						}

						if(forms.length === 0 && iterationIndex >= ITERATION_COUNT){
							console.error("we cannot find forms by '.js-form-proccess' class");
							return;
						}

						forms.forEach(form => {
							form.addEventListener('tildaform:aftersuccess', ()=>mySuccessFunction(form));
						});
					}

				</script>
			</div>
		</div>
	</div>
</div>