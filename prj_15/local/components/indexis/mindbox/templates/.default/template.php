<?php
/**
 * Created by @copyright QSOFT.
 */

?>

<script>
    var mindboxQuiz = function (quizData) {
        var needMaterials = "Нет";
        if (quizData['PROPS']['MATERISLAS_DATE_ENUM']) {
            needMaterials = "Да";
        }
        var fields = {
            quizHowOften: quizData['PROPS']['MATERISLAS_DATE_ENUM'],
            quizInteractionWithPatient: quizData['PROPS']['PACIENT_TYPE_ENUM'],
            quizLaborActivity: quizData['PROPS']['WORK_ENUM'],
            quizNewKnowledge: quizData['PROPS']['HOW_GET_ENUM'],
            quizrRceiptMaterials: needMaterials,
            quizStrengthenCompetencies: quizData['PROPS']['STR1'],
            quizStrengthenCompetenciesResult: quizData['PROPS']['REASON_RESULT_ENUM'],
            quizStrengthenCompetenciesWhy: quizData['PROPS']['REASON2_ENUM'],
            quizStrengthenKnowledge: quizData['PROPS']['STR2'],
            quizStrengthenKnowledgeWhy: quizData['PROPS']['REASON_ENUM'],
            quizUsefulTopics: quizData['PROPS']['THEMES_ENUM']
        };
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.Quiz",
            data: {
                customerAction: {
                    customFields: fields
                },
                customer: {
                    ids: {
                        websiteID: quizData["USER"]
                    }
                }
            },
            onSuccess: function () {
                console.log("Quiz");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
        ym(88122786,'reachGoal','form-quiz');
        console.log('form-quiz');
    };

    var mindboxSubscriptionFormonSite = function (Data) {
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.SubscriptionFormonSite",
            data: {
                customer: {
                    email: Data["NAME"],
                    customFields: {
                        specialty: [
                            Data["PROPS"]["SPECIALITY_ENUM"],
                        ]
                    },
                    subscriptions: [
                        {
                            pointOfContact: "Email"
                        }
                    ]
                }
            },
            onSuccess: function () {
                console.log("SubscriptionFormonSite");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var mindboxSubscriptionForm = function (Data) {
    };

    var mindboxViewProduct = function (id) {
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.ViewProduct",
            data: {
                viewProduct: {
                    product: {
                        ids: {
                            website: id
                        }
                    }
                }
            },
            onSuccess: function () {
                console.log("ViewProduct");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var mindboxViewPageWebinar = function (id) {
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.ViewPageWebinar",
            data: {
                viewProduct: {
                    product: {
                        ids: {
                            website: "Webinar_" + id
                        }
                    }
                }
            },
            onSuccess: function () {
                console.log("ViewPageWebinar");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var mindboxViewMaterial = function (data) {
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.ViewMaterial",
            data: {
                customerAction: {
                    customFields: {
                        linkToMaterial: data.link,
                        materialSpecialization: data.specialization,
                        nameOfMaterial: data.name
                    }
                }
            },
            onSuccess: function () {
                console.log("ViewMaterial");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var mindboxClickOnReadAllArticles = function () {
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.ClickOnReadAllArticles",
            data: {},
            onSuccess: function () {
                console.log("ClickOnReadAllArticles");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var mindboxClickOnNewMaterialsAcademy = function (name) {
        //alert('!');
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.ClickOnNewMaterialsAcademy",
            data: {
                customerAction: {
                    customFields: {
                        topic: name
                    }
                }
            },
            onSuccess: function () {
                console.log("ClickOnNewMaterialsAcademy");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var mindboxSubscriptionFormCourse = function (data) {
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.SubscriptionFormCourse",
            data: {
                customerAction: {
                    customFields: {
                        courseName: data.name
                    }
                },
                customer: {
                    email: data.email,
                    customFields: {
                        specialty: [
                            data.speciality
                        ],
                    },
                    subscriptions: [
                        {
                            pointOfContact: "Email"
                        }
                    ]
                }
            },
            onSuccess: function () {
                console.log("SubscriptionFormCourse");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var mindboxViewCabinet = function (name) {
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.ViewCabinet",
            data: {
                customerAction: {
                    customFields: {
                        topic: name
                    }
                }
            },
            onSuccess: function () {
                console.log("ViewCabinet");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var mindboxSubscriptionLifeCode = function (fields) {
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.SubscriptionLifeCode",
            data: {
                customer: {
                    email: fields["NAME"],
                    subscriptions: [
                        {
                            pointOfContact: "Email"
                        }
                    ]
                }
            },
            onSuccess: function () {
                console.log("mindboxSubscriptionLifeCode");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var mindboxGetConsultKkm = function (fields) {
        console.log(fields);
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.b2bConsultation",
            data: {
                customerAction: {
                    customFields: {
                        courseName: "Калгари-Кембриджская модель"
                    }
                },
                customer: {
                    fullName: fields["NAME"],
                    email: fields["PROPS"]["EMAIL"],
                    mobilePhone: fields["PROPS"]["PHONE"],
                    subscriptions: [
                        {
                            "pointOfContact": "Email"
                        },
                        {
                            "pointOfContact": "SMS"
                        }
                    ]
                }
            },
            onSuccess: function () {
                console.log("mindboxGetConsultKkm");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        console.log(sendObj);
        mindbox("async", sendObj);
    };

    var mindboxGetMaterialsKkm = function (fields) {
        console.log(fields);
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.b2bForm",
            data: {
                customerAction: {
                    customFields: {
                        courseName: "Калгари-Кембриджская модель"
                    }
                },
                customer: {
                    fullName: fields["NAME"],
                    email: fields["PROPS"]["EMAIL"],
                    mobilePhone: fields["PROPS"]["PHONE"],
                    subscriptions: [
                        {
                            "pointOfContact": "Email"
                        },
                        {
                            "pointOfContact": "SMS"
                        }
                    ]
                }
            },
            onSuccess: function () {
                console.log("mindboxGetMaterialsKkm");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        console.log(sendObj);
        mindbox("async", sendObj);
    };

    var mindboxGetMaterialsCourse = function (fields) {
        console.log(fields);
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.GetMaterialsCourse",
            data: {
                customerAction: {
                    customFields: {
                        courseName: fields["PROPS"]["COURSE"]
                    }
                },
                customer: {
                    email: fields["PROPS"]["EMAIL"],
                    fullName: fields["PROPS"]["NAME"],
                    subscriptions: [
                        {
                            "pointOfContact": "Email"
                        },
                        {
                            "pointOfContact": "SMS"
                        }
                    ]
                }
            },
            onSuccess: function () {
                console.log("GetMaterialsCourse");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

    var ClickOnNewClosedMaterials = function (name) {
        var sendObj = {
            operation: "<?=Mindbox\Options::getPrefix()?>.ClickOnNewClosedMaterials",
            data: {
                customerAction: {
                    customFields: {
                        topic: name
                    }
                }
            },
            onSuccess: function () {
                console.log("ClickOnNewClosedMaterials");
            },
            onError: function (error) {
                console.log(error);
            }
        };
        mindbox("async", sendObj);
    };

</script>
