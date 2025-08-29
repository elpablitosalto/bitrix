<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('631741084');
        });
    });
</script>
<script>
    mindbox("async", {
        operation: "Website.ViewProduct",
        data: {
            viewProduct: {
                product: {
                    ids: {
                        website: "GetCourse_4665137"
                    }
                }
            }
        }
    });
</script>
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
                    subscriptions: [{
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
</script>
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('604508706');
        });
    });
</script>
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('604508707');
        });
    });
</script>

<script>
    t_onReady(function() {
        t_onFuncLoad('t517_unifyHeights', function() {
            window.addEventListener('resize', t_throttle(function() {
                t517_unifyHeights('604508710');
            }));
            t517_unifyHeights('604508710');
            var rec = document.querySelector('#rec604508710');
            if (rec) {
                var wrapper = rec.querySelector('.t517');
                if (wrapper) {
                    wrapper.addEventListener('displayChanged', function() {
                        t517_unifyHeights('604508710');
                    });
                }
            }
        });
    });
</script>
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('604508712');
        });
    });
</script>
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('604508714');
        });
    });
</script>
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('604508715');
        });
    });
</script>
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('604508718');
        });
    });
</script>

<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('604594534');
        });
    });
</script>
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('604595628');
        });
    });
</script>
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
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('604614284');
        });
    });
</script>
<script type="text/javascript">
    if (!document.getElementById('t-phonemask-script')) {
        (function(d, w, o) {
            var n = d.getElementsByTagName(o)[0],
                s = d.createElement(o),
                f = function() {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.id = 't-phonemask-script';
            s.src = "<?= SITE_TEMPLATE_PATH ?>/js/tilda-phone-mask-1.1.min.js";
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, 'script');
    } else {
        t_onReady(function() {
            t_onFuncLoad('t_form_phonemask_load', function() {
                var phoneMasks = document.querySelectorAll('#rec604747828 [data-phonemask-lid="1674479077277"]');
                t_form_phonemask_load(phoneMasks);
            });
        });
    }
</script>


<script>
    t_onReady(function() {
        setTimeout(function() {
            t_onFuncLoad('t868_initPopup', function() {
                t868_initPopup('604836267');
            });
        }, 500);
    });
</script>

<script>
    t_onReady(function() {
        setTimeout(function() {
            t_onFuncLoad('t868_initPopup', function() {
                t868_initPopup('604837815');
            });
        }, 500);
    });
</script>
<script>
    t_onReady(function() {
        setTimeout(function() {
            t_onFuncLoad('t868_initPopup', function() {
                t868_initPopup('604849222');
            });
        }, 500);
    });
</script>
<script>
    t_onReady(function() {
        setTimeout(function() {
            t_onFuncLoad('t868_initPopup', function() {
                t868_initPopup('604850028');
            });
        }, 500);
    });
</script>
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('625093194');
        });
    });
</script>

<script type="text/javascript">
    if (!document.getElementById('t-phonemask-script')) {
        (function(d, w, o) {
            var n = d.getElementsByTagName(o)[0],
                s = d.createElement(o),
                f = function() {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.id = 't-phonemask-script';
            s.src = "<?= SITE_TEMPLATE_PATH ?>/js/tilda-phone-mask-1.1.min.js";
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, 'script');
    } else {
        t_onReady(function() {
            t_onFuncLoad('t_form_phonemask_load', function() {
                var phoneMasks = document.querySelectorAll('#rec625111680 [data-phonemask-lid="1495810410810"]');
                t_form_phonemask_load(phoneMasks);
            });
        });
    }
</script>

<script>
    t_onReady(function() {
        t_onFuncLoad('t702_initPopup', function() {
            t702_initPopup('625111680');
        });
    });
</script>
<script>
    window.addEventListener("load", function() {
        document.getElementById('ltForm2993110').addEventListener('submit', function() {
            ym(91491982, 'reachGoal', 'opalatit');
        });
    });
</script>

<script>
    t_onReady(function() {
        setTimeout(function() {
            t_onFuncLoad('t868_initPopup', function() {
                t868_initPopup('631740027');
            });
        }, 500);
    });
</script>
<script>
    t_onReady(function() {
        t_onFuncLoad('t396_init', function() {
            t396_init('631741084');
        });
    });
</script>

<?/*?>
<script id="159efd6a1eede44b75f74b0ea79ad8f707e23368" data-skip-moving="true" src="https://school.vrachbudushego.ru/pl/lite/widget/script?id=982142"></script>
<script id="5b193e86bad59b01b018e22cc42f110584990d1d" data-skip-moving="true" src="https://school.vrachbudushego.ru/pl/lite/widget/script?id=933472&&тариф_оптима_рассрочка"></script>
<script id="17a34ad6e1edfd23c886a29a183cb3d2d2b4a88c" data-skip-moving="true" src="https://school.vrachbudushego.ru/pl/lite/widget/script?id=933475&тариф_оптима_вся_сумма"></script>
<script id="f5667333e486c61a7df5cc2aa0e4ae17a5017d4a" data-skip-moving="true" src="https://school.vrachbudushego.ru/pl/lite/widget/script?id=933477&тариф_базовый_вся_сумма"></script>
<script id="3e41be8a820de8775a19ef746b15bda38b17e527" data-skip-moving="true" src="https://school.vrachbudushego.ru/pl/lite/widget/script?id=933468&тариф_базовый_рассрочка"></script>
<?*/ ?>