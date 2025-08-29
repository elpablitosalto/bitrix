<div id="rec594916057" class="r t-rec t-rec_pt_15" style="padding-top:15px; " data-animationappear="off"
     data-record-type="131"><!-- T123 -->
    <div class="t123">
        <div class="t-container_100 ">
            <div class="t-width t-width_100 ">

                <!--<script>
                function mySuccessFunction(form) {
                    console.log("mySuccessFunction");
                    if (!form) return;

                    const formData = {};
                    const formInputs = form.querySelectorAll('.t-input');
                    formInputs.forEach(input => {
                        formData[input.name] = input.value;
                    });
                    const resultData = {"customer": {"email": formData.email, "name": formData.name}};
                    console.log('r', resultData);
                    mindbox("async", {
                        operation: "Website.GetMaterialsCourse",
                        data: {
                            customerAction: {
                                customFields: {
                                    courseName: "Эмоциональное выгорание. Основы баланса"
                                }
                            },
                            customer: {
                                email: resultData.customer.email,
                                fullName: resultData.customer.name,
                                subscriptions: [
                                    {
                                        "pointOfContact": "Email"
                                    },
                                    {
                                        "pointOfContact": "SMS"
                                    }
                                ]
                            },
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
                    console.log("us_sendFormAfterSuccess");
                    var forms = document.querySelectorAll('.js-form-proccess');
                    if (forms.length === 0 && iterationIndex++ < ITERATION_COUNT) {
                        setTimeout(us_sendFormAfterSuccess, INTERVAL);
                        return;
                    }

                    if (forms.length === 0 && iterationIndex >= ITERATION_COUNT) {
                        console.error("we cannot find forms by '.js-form-proccess' class");
                        return;
                    }

                    forms.forEach(form => {
                        form.addEventListener('tildaform:aftersuccess', () => mySuccessFunction(form));
                    });
                }


            </script>-->


            </div>
        </div>
    </div>
</div>