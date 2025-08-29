<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//var_dump($arResult);
?>
<section class="quiz">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!--a(data-modal="#modal-quiz") Показать--><a id="quiz-open">
                    <u>Показать</u></a>
                <!--div(id="modal-quiz", class="modal modal-quiz")-->
                <div id="modal-quiz">
                    <div class="modal-quiz-wrapper">
                        <div class="modal-quiz__header">
                            <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/logo-full-red.svg" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
                            </picture>
                            <button id="quiz-close">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
                                    <use xlink:href="#close"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-quiz__content">
                            <div id="quizText" class="modal-quiz__text">text</div>
                            <div id="quizContent" class="modal-quiz__variants-line"></div>
                        </div>
                        <div class="modal-quiz__timeline">
                            <button id="quizPrev" class="btn btn-transparent">Назад</button>
                            <button id="quizNext" class="btn">Далее
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-stroke">
                                    <use xlink:href="#stroke"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-quiz__footer">
                            <div class="modal-quiz__bird">
                                <picture><img class="lazyload" src="images/loader.svg" data-src="images/bird.svg" loading="lazy" alt="" title="" />
                                </picture>
                            </div>
                            <!--.modal-quiz__paginator Вопрос<span class="modal-quiz__current-page" id="quizCurrentStage">1</span>из<span class="modal-quiz__all-page" id="quizStages">6</span>-->
                            <div class="modal-quiz__paginator">Анкета займёт примерно<span class="modal-quiz__current-page" id="quizCurrentStage">1</span>минуту</div>
                        </div>
                    </div>
                    <div class="modal-quiz__decor animate-svg-image">
                        <svg width="819" class="quiz-decor" height="297" viewBox="0 0 819 297" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="quiz-decor__ground" d="M843.001 194.997C745 157.997 572.631 135.111 458.003 147.997C317 163.847 197 189.997 3.00179 300.997" stroke="#FF5400" stroke-width="12" />
                            <path class="quiz-decor__home" fill-rule="evenodd" clip-rule="evenodd" d="M603.706 7.78507V1.78507L597.706 1.78507L570.147 1.78507L564.147 1.78507L564.147 7.78507L564.147 22.7268L540.481 3.16083L536.658 0L532.835 3.16083L443 77.4332L450.646 86.6816L462.46 76.9149L462.459 152.816L474.459 152.816L474.46 66.9938L536.658 15.5701L566.324 40.0966L593.883 62.881L598.573 66.7591L598.573 73.0585L598.573 96.8824L598.573 151.438H610.573L610.573 96.8824L610.573 76.6803L622.67 86.6816L630.317 77.4331L603.706 55.4323V7.78507ZM591.706 45.5111L576.147 32.6479L576.147 13.7851L591.706 13.7851L591.706 45.5111ZM565.202 86.6289V80.6289L559.202 80.6289H513.831H507.831V86.6289L507.831 150.068H519.831L519.831 92.6289H553.202L553.202 150.068H565.202L565.202 86.6289Z" fill="#FF5400" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?
$itemsPos = [];
$maxID = 0;
foreach ($arResult['ITEMS'] as $item) {
    //$intID = IntVal($item['ID']);
    //$intID = $pos+1;
    //if ($intID > $maxID) {$maxID = $intID;}    
    $maxID++;
    $itemsPos[$item['ID']] = $maxID;
}
$textareaID = $maxID + 1;
$contactID = $textareaID + 1;
$successID = $contactID + 1;
//$firstID = IntVal($arResult['ITEMS'][0]['ID']); // ID первого шага
if ($textareaID > 1) {
    $firstID = 1;
} else {
    $firstID = 0;
}

?>

<script>
    // open & close buttons
    $("#quiz-open").on("click", () => {
        $("#modal-quiz").addClass('open')
        document.body.style.overflow = 'hidden'
    })
    $("#quiz-close").on("click", () => {
        $("#modal-quiz").removeClass('open')
        document.body.style.overflow = 'auto'
    })

    // init state

    const initState = [
        <? foreach ($arResult['ITEMS'] as $item) { ?> {
                id: <? echo $itemsPos[$item['ID']] ?>,
                type: 'question',
                text: '<? echo $item['NAME'] ?>',
                options: [

                    <? foreach ($item['PROPERTIES']['ANSWER']["VALUE"] as $answerPos => $answer) { ?> {
                            id: <? echo $answerPos; ?>,
                            text: '<? echo htmlspecialchars($answer["SUB_VALUES"]["ANSWER_TEXT"]["VALUE"]) ?>',
                            goTo: <? if (empty($itemsPos[$answer["SUB_VALUES"]["NEXT_QUESTION"]["VALUE"]])) {
                                        echo $textareaID;
                                    } else {
                                        echo $itemsPos[$answer["SUB_VALUES"]["NEXT_QUESTION"]["VALUE"]];
                                    } ?>
                        },
                    <? } ?>

                ]
            },
        <? } ?> {
            id: <? echo $textareaID ?>,
            type: 'textarea',
            text: 'Опишите вашу ситуацию',
            placeholder: "Опишите, что случилось. Максимум 1000 символов.",
        },
        {
            id: <? echo $contactID ?>,
            type: 'contact',
            text: 'Как с вами связаться',
            checked: false
        },
        {
            id: 1000 <?/* echo $successID; // странный глюк, если указать значение переменной, перестаёт работать. в виде константы - ок*/ ?>,
            type: 'success',
            text: 'Данные успешно отправлены.'
        }
    ]

    class Quiz {
        constructor(initState) {
            this.currentStage = '';
            this.history = []
            this.data = initState
            this.controls = {
                next: document.querySelector('#quizNext'),
                prev: document.querySelector('#quizPrev'),
                text: document.querySelector('#quizText'),
                content: document.querySelector('#quizContent'),
                currentStage: document.querySelector('#quizCurrentStage'),
                stages: document.querySelector('#quizStages'),
            }
            this.controls.next.addEventListener('click', () => {
                this.next()
            })
            this.controls.prev.addEventListener('click', () => {
                this.prev()
            })
        }
        setHistory(num) {
            this.history.push(num)
        }
        start() {
            this.currentStage = 1
            this.setHistory(1)
            this.render()
            this.currentStage = 0
        }
        next() {
            if (this.history.indexOf(this.currentStage) === this.history.length - 1) {
                if (this.currentStage === <? echo $textareaID ?>) {
                    this.currentStage = <? echo $contactID ?>
                }
            }
            if (this.currentStage !== 0 && this.history.indexOf(this.currentStage) !== this.history.length - 1) {
                if (this.history.includes(this.currentStage)) {
                    this.history.indexOf(this.currentStage)
                    this.currentStage = Number(this.history[this.history.indexOf(this.currentStage) + 1])
                } else {
                    this.setHistory(this.currentStage)
                }
                this.render()
            }
        }
        prev() {
            if (this.currentStage !== 0) {
                this.currentStage = Number(this.history[this.history.indexOf(this.currentStage) - 1])
                this.render()
            }
        }
        toPost(data) {
            let arr = data.map(e => {
                let result = {};
                result.text = e.text
                result.id = e.id
                if (e.type === 'question') {
                    for (let elem of e.options) {
                        if (elem.selected) {
                            result.answer = elem.text
                            if (elem.id !== undefined) {
                                result.answer_id = elem.id
                            }
                        }
                    }
                }
                if (e.type === 'textarea') {
                    result.answer = e.value
                }
                if (e.type === 'contact') {
                    result.answer = e.username
                    result.phone = e.phone
                }
                if (result.answer) return result
            })
            arr = arr.filter(function(x) {
                return x !== undefined;
            });

            $.ajax({
                type: "POST",
                url: "<?= $templateFolder ?>/ajax.php",
                data: {
                    quiz: arr,
                    contact: <?= $contactID ?>
                }
            });
            //console.log(arr) // Здесь ответы на все вопросы анкеты в удобном формате, для отправки на почту например.

        }
        render() {
            for (let item of this.data) {
                if (item.id === this.currentStage) {
                    this.controls.text.innerHTML = item.text
                    this.controls.content.innerHTML = ''

                    if (item.type === 'textarea') {
                        item.value = item.value || '';
                        this.controls.content.insertAdjacentHTML('beforeend', `<textarea maxlength="1000" placeholder="${item.placeholder}">${item.value}</textarea>`)
                        let quizText = this.controls.content.querySelector('textarea')
                        quizText.addEventListener('input', event => item.value = event.target.value)
                    }

                    if (item.type === 'contact') {
                        item.username = item.username || '';
                        item.phone = item.phone || '';
                        this.controls.content.insertAdjacentHTML('beforeend', `
                        <div class="quiz-loginform">
                            <input id="quiz-username" type="text" maxlength="40" placeholder="Ваше Имя" value="${item.username}">
                            <input id="quiz-phone" type="text" placeholder="Номер телефона" value="${item.phone}">
                            <input id="quiz-agreement" type="checkbox" name="mhi-6" ${(item.argeement) ? 'checked' : ''} class="custom-checkbox d-none">
                            <label class="custom-checkbox-label" for="quiz-agreement">Соглашаюсь на обработку моих <a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" class="" target="_blank"><u>персональных данных</u></a><label>
                        </div>`)
                        let username = this.controls.content.querySelector('#quiz-username')
                        let phone = this.controls.content.querySelector('#quiz-phone')
                        let agreement = this.controls.content.querySelector('#quiz-agreement')
                        username.addEventListener('input', event => item.username = event.target.value)
                        $(phone).mask("+7(999) 999-9999",
                            // {autoclear: false}
                        );
                        // phone.addEventListener('input', event => {
                        //     item.phone = event.target.value
                        // })
                        agreement.addEventListener('input', event => item.argeement = event.target.checked)
                        this.controls.next.addEventListener('click', () => {
                            item.phone = phone.value
                        })
                    }

                    if (item.type === 'question') {
                        for (let element of item.options) {
                            let htmlTag = document.createElement("button")
                            htmlTag.innerHTML = element.text
                            if (element.selected === true) {
                                htmlTag.className = "quiz__selected"
                                // this.currentStage = element.goTo
                            }
                            htmlTag.addEventListener('click', (event) => {
                                if (element.selected === true) {
                                    element.selected = false
                                    event.currentTarget.className = ''
                                    this.currentStage = 0
                                } else {
                                    this.currentStage = element.goTo
                                    element.selected = true
                                    $(event.currentTarget).siblings().removeClass('quiz__selected')
                                    event.currentTarget.className = "quiz__selected"
                                }
                            })
                            this.controls.content.appendChild(htmlTag)
                        }
                    }
                    // this.controls.currentStage.innerHTML = this.currentStage
                    // this.controls.stages.innerHTML = this.data.length

                    if (this.currentStage === <? echo $contactID ?>) {
                        this.controls.next.innerHTML = 'Отправить'
                        this.controls.next.addEventListener('click', () => {
                            let agreement = this.controls.content.querySelector('#quiz-agreement')
                            let phone = this.controls.content.querySelector('#quiz-phone')
                            let username = this.controls.content.querySelector('#quiz-username')
                            if (agreement.checked && phone.value && username.value) {
                                this.toPost(this.data)
                                this.currentStage = 1000
                                this.render()
                            }
                        })
                    } else {
                        this.controls.next.innerHTML = `Далее 
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-stroke">
                            <use xlink:href="#stroke"></use>
                        </svg>`
                    }
                    if (this.currentStage === 1000) {
                        this.controls.next.style.display = 'none'
                    }

                    if (this.currentStage === 1 || this.currentStage === 1000) {
                        this.controls.prev.style.display = 'none'
                    } else {
                        this.controls.prev.style.display = 'inline-block'
                    }
                }
            }
        }
    }

    let mainQuiz = new Quiz(initState)

    mainQuiz.start()
</script>