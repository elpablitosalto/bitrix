// open & close buttons
$("#quiz-open").on("click", () => {
        $("#modal-quiz").addClass('open')
        document.body.style.overflow = 'hidden'
    }
)
$("#quiz-close").on("click", () => {
    $("#modal-quiz").removeClass('open')
    document.body.style.overflow = 'auto'
})

// init state

const initState = [
    {
        id: 1,
        type: 'question',
        text: 'Из какого вы города?',
        options: [
            {
                text: 'Вологодская область',
                goTo: 2
            },
            {
                text: 'Череповец',
                goTo: 2
            },
            {
                text: 'Волгоград',
                goTo: 2
            },
            {
                text: 'Костомукша',
                goTo: 2
            },
            {
                text: 'Воркута',
                goTo: 2
            },
            {
                text: 'Орёл',
                goTo: 2
            },
            {
                text: 'Оленегорск',
                goTo: 2
            },
            {
                text: 'Ярославль',
                goTo: 2
            },
            {
                text: 'Другой город',
                goTo: 2
            },
        ]
    },
    {
        id: 2,
        type: 'question',
        text: 'У вас есть гражданство РФ?',
        options: [
            {
                id: 0,
                text: 'Да',
                goTo: 3
            },
            {
                id: 1,
                text: 'Нет, мы в миграции',
                goTo: 3,
            },
            {
                id: 2,
                text: 'Нет, мы беженцы',
                goTo: 3
            }

        ]
    },
    {
        id: 3,
        type: 'question',
        text: 'Выберите вариант, описывающий вас',
        options: [
            {
                id: 0,
                text: 'Родитель/Родственник',
                goTo: 4
            },
            {
                id: 1,
                text: 'Мать одиночка',
                goTo: 5,
            },
            {
                id: 2,
                text: 'Беременная женщина',
                goTo: 9
            }

        ]
    },
    {
        id: 4,
        type: 'question',
        text: 'Возрастная категория ребёнка',
        options: [
            {
                text: 'Младенец (до 12 месяцев)',
                goTo: 6
            },
            {
                text: '1 - 5 лет',
                goTo: 7
            },
            {
                text: '5 - 12 лет',
                goTo: 7
            },
            {
                text: 'Больше 13 лет',
                goTo: 8
            },
        ]
    },
    { // Мать одиночка
        id: 5,
        type: 'question',
        text: 'Возрастная категория ребёнка',
        options: [
            {
                text: 'Младенец (до 12 месяцев)',
                goTo: 66
            },
            {
                text: '1 - 5 лет',
                goTo: 77
            },
            {
                text: '5 - 12 лет',
                goTo: 77
            },
            {
                text: 'Больше 13 лет',
                goTo: 89
            },
        ]
    },
    {
        id: 66,
        type: 'question',
        text: 'Ваша ситуация',
        options: [
            {
                text: 'Ребёнок с инвалидностью',
                goTo: 9
            },
            {
                text: 'Трудная жизненная ситуация',
                goTo: 9
            }
        ]
    },
    {
        id: 77,
        type: 'question',
        text: 'Ваша ситуация',
        options: [
            {
                text: 'Ребёнок с инвалидностью',
                goTo: 9
            },
            {
                text: 'Трудная жизненная ситуация',
                goTo: 9
            },
            {
                text: 'Ребенок в семье пережил психоэмоциональную травму, сексуальное насилие, жестокое обращение',
                goTo: 10
            }
        ]
    },
    {
        id: 89,
        type: 'question',
        text: 'Ваша ситуация',
        options: [
            {
                text: 'Ребёнок с инвалидностью',
                goTo: 9
            },
            {
                text: 'Трудная жизненная ситуация',
                goTo: 9
            },
            {
                text: 'Подросток склонен к саморазрушающему и суицидальному поведению ',
                goTo: 10
            },
            {
                text: 'Проблемный подросток',
                goTo: 88
            },
            {
                text: 'Ребенок в семье пережил психоэмоциональную травму, сексуальное насилие, жестокое обращение',
                goTo: 10
            },
        ]
    },
    {
        id: 6,
        type: 'question',
        text: 'Ваша ситуация',
        options: [
            {
                text: 'Ребёнок с инвалидностью',
                goTo: 9
            },
            {
                text: 'Трудная жизненная ситуация',
                goTo: 9
            },
            {
                text: 'Злоупотребление алкоголем в семье',
                goTo: 10
            }
        ]
    },
    {
        id: 7,
        type: 'question',
        text: 'Ваша ситуация',
        options: [
            {
                text: 'Ребёнок с инвалидностью',
                goTo: 9
            },
            {
                text: 'Трудная жизненная ситуация',
                goTo: 9
            },
            {
                text: 'Злоупотребление алкоголем в семье',
                goTo: 10
            },
            {
                text: 'Ребенок в семье пережил психоэмоциональную травму, сексуальное насилие, жестокое обращение',
                goTo: 10
            }
        ]
    },
    {
        id: 8,
        type: 'question',
        text: 'Ваша ситуация',
        options: [
            {
                text: 'Ребёнок с инвалидностью',
                goTo: 9
            },
            {
                text: 'Ребенок в семье пережил психоэмоциональную травму, сексуальное насилие, жестокое обращение',
                goTo: 10
            },
            {
                text: 'Подросток склонен к саморазрушающему и суицидальному поведению ',
                goTo: 10
            },
            {
                text: 'Проблемный подросток',
                goTo: 88
            },
            {
                text: 'Трудная жизненная ситуация',
                goTo: 9
            },
            {
                text: 'Злоупотребление алкоголем в семье',
                goTo: 10
            },

        ]
    },
    {
        id: 88,
        type: 'question',
        text: 'Какая ситуация описывает вашего ребёнка подростка?',
        options: [
            {
                text: 'Агрессивное поведение',
                goTo: 10
            },
            {
                text: 'Прогулы занятий',
                goTo: 10
            },
            {
                text: 'Нарушение комендантского часа',
                goTo: 10
            },
            {
                text: 'Употребление психоактивных веществ',
                goTo: 10
            }
        ]
    },
    {
        id: 9,
        type: 'question',
        text: 'В чем вы нуждаетесь в первую очередь?',
        options: [
            {
                text: 'Материальная поддержка',
                goTo: 10
            },
            {
                text: 'Психологическая поддержка',
                goTo: 10
            },
            {
                text: 'Юридическая/правовая поддержка',
                goTo: 10
            }
        ]
    },
    {
        id: 10,
        type: 'textarea',
        text: 'Опишите вашу ситуацию',
        placeholder: "Опишите, что случилось. Максимум 1000 символов.",
    },
    {
        id: 11,
        type: 'contact',
        text: 'Как с вами связаться',
        checked: false
    },
    {
        id: 12,
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
            if (this.currentStage === 10) {
                this.currentStage = 11
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
        if (this.currentStage !== 0 ) {
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
                    this.controls.content.insertAdjacentHTML('beforeend',`
                        <div class="quiz-loginform">
                            <input id="quiz-username" type="text" maxlength="40" placeholder="Ваше Имя" value="${item.username}">
                            <input id="quiz-phone" type="text" placeholder="Номер телефона" value="${item.phone}">
                            <input id="quiz-agreement" type="checkbox" name="mhi-6" ${(item.argeement) ? 'checked' : ''} class="custom-checkbox d-none">
                            <label class="custom-checkbox-label" for="quiz-agreement">Соглашаюсь на обработку моих <a href="" class="" target="_blank"><u>персональных данных</u></a><label>
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
                            }
                            else {
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

                if (this.currentStage === 11) {
                    this.controls.next.innerHTML= 'Отправить'
                    this.controls.next.addEventListener('click', () => {
                        let agreement = this.controls.content.querySelector('#quiz-agreement')
                        let phone = this.controls.content.querySelector('#quiz-phone')
                        let username = this.controls.content.querySelector('#quiz-username')
                        if (agreement.checked && phone.value && username.value) {
                            this.toPost(this.data)
                            this.currentStage = 12
                            this.render()
                        }
                    })
                } else {
                    this.controls.next.innerHTML= `Далее 
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-stroke">
                            <use xlink:href="#stroke"></use>
                        </svg>`
                }
                if (this.currentStage === 12) {
                    this.controls.next.style.display = 'none'
                }

                if (this.currentStage === 1 || this.currentStage === 12) {
                    this.controls.prev.style.display = 'none'
                }
                else {
                    this.controls.prev.style.display = 'inline-block'
                }
            }
        }
    }
}

let mainQuiz = new Quiz(initState)

mainQuiz.start()