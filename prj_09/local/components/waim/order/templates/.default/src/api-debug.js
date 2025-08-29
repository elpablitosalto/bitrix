export const getInitDat1 = async () => {
  let result = {
    "success": "N",
    "redirect": "/personal/cart/"
  };

  return new Promise((resolve) => {
    setTimeout(() => {
      resolve(result);
    }, 500);
  });
}

export const getInitData = async () => {
  let result = {
    "status": "success",
    "data": {
      "profiles": [
        {
          "id": "636",
          "name": "Юлия Евгеньевна Частушкина",
          "customer": {
            "fullName": "Юлия Евгеньевна Частушкина",
            "phone": "7985996930    2",
            "email": "ychastushkina@inbox.ru"
          },
          "company": {
            "name": "222222222",
            "legalAdress": "",
            "inn": "",
            "kpp": ""
          },
          "address": {
            "city": "",
            "street": "",
            "houseNumber": "",
            "building": "",
            "floor": ""
          },
          "delivery": {
            "location": "",
            "pvzId": "5280",
            "pvzName": "г. Ростов-на-Дону, ул. Пескова д. 74 И"
          },
          "isCompany": true
        },
        {
          "id": "650",
          "name": "ТЕСТОВЫЙ ЗАКАЗ",
          "customer": {
            "fullName": "ТЕСТОВЫЙ ЗАКАЗ",
            "phone": "79518599658",
            "email": "sergey.l@web-aim.ru"
          },
          "company": {
            "name": "",
            "legalAdress": "",
            "inn": "",
            "kpp": ""
          },
          "address": {
            "city": "",
            "street": "",
            "houseNumber": "",
            "building": "",
            "floor": ""
          },
          "delivery": {
            "location": "",
            "pvzId": "",
            "pvzName": ""
          },
          "isCompany": false
        }
      ],
      "defaultProfile": 0,
      "defaultLocation": {
        "id": "418",
        "name": "Санкт-Петербург"
      },
      "auth": true,
      "authMessage": "Заполните поля ниже или <a href=\"/auth/\">авторизуйтесь</a> на сайте",
      "payment": {
        "paySystems": [
          {
            "id": "8",
            "title": "Картой на сайте (онлайн)"
          },
          {
            "id": "2",
            "title": "Оплата по счету"
          },
          {
            "id": "3",
            "title": "Оплата при получении"
          }
        ],
        "defaultPaySystem": "8"
      },
      "delivery": {
        "deliveries": [
          {
            "id": "2",
            "title": "Самовывоз",
            "description": "(мкр. Северное Чертаново д. 5)",
            "price": 0,
            "isPickUp": true,
            "pickUpPoints": [
              {
                "id": "1",
                "name": "Основной",
                "location": "123",
                "address": "124565, Москва, микрорайон Северное Чертаново, д. 5 офис 203, склад 28",
                "description": "",
                "phone": "+74957747461",
                "schedule": "Будни дни с 09:00 до 18:00. Суббота с 10:00 - 15:00",
                "email": "",
                "coordinates": [
                  "55.338341",
                  "37.841756"
                ]
              },
              {
                "id": "2",
                "name": "Основной",
                "location": "321",
                "address": "124565, Москва, микрорайон Северное Чертаново, д. 5 офис 203, склад 28",
                "description": "",
                "phone": "+74957747461",
                "schedule": "Будни дни с 09:00 до 18:00. Суббота с 10:00 - 15:00",
                "email": "",
                "coordinates": [
                  "55.338341",
                  "37.841756"
                ]
              }
            ]
          },
          {
            "id": "3",
            "title": "Доставка по Москве (в пределах МКАД)",
            "description": "Доставка по Москве (в пределах МКАД)",
            "price": null,
            "isPickUp": false,
            "pickUpPoints": []
          },
          {
            "id": "5",
            "title": "Доставка по России",
            "description": "Производиться индивидуальный расчет стоимости доставки после согласования заказа.",
            "price": null,
            "isPickUp": false,
            "pickUpPoints": []
          }
        ],
        "defaultDelivery": "2"
      },
      "order": {
        "items": [
          {
            "id": "194022",
            "imageUrl": "/upload/resize_cache/iblock/c95/zgj3zy9653pzg3thwb05pxz4hnp1xken/180_140_1/ba7d69da4a3ce1d3ea8594587722760d.jpg",
            "title": "Вода газированная СВЯТОЙ ИСТОЧНИК 500мл 12шт/уп [6] [114]",
            "detailUrl": "/catalog/eda-i-napitki-optom/napitki/voda-gazirovannaya-svyatoy-istochnik-500ml-12sht-up-6-114/",
            "props": [
              {
                "label": "Количество",
                "value": "6 уп"
              },
              {
                "label": "Сумма",
                "value": "100.13 ₽"
              }
            ]
          }
        ],
        "total": [
          {
            "label": "Скидка",
            "value": "25.03 ₽"
          },
          {
            "label": "Доставка (примерный расчет)",
            "value": "0 ₽"
          },
          {
            "label": "Сумма",
            "value": "100.13 ₽",
            "main": true
          }
        ]
      },
      "properties": {
        "1": {
          "customer": {
            "fullName": "1",
            "email": "2",
            "phone": "3"
          },
          "address": {
            "street": "45",
            "houseNumber": "46",
            "building": "47",
            "floor": "48",
            "city": "40"
          },
          "delivery": {
            "pvzId": "50",
            "pvzName": "52",
            "location": "32"
          },
          "company": {
            "name": "35",
            "legalAdress": "36",
            "inn": "33",
            "kpp": "34"
          }
        },
        "5": {
          "customer": {
            "fullName": "25",
            "email": "26",
            "phone": "27"
          },
          "address": {
            "street": "41",
            "houseNumber": "42",
            "building": "43",
            "floor": "44",
            "city": "29"
          },
          "delivery": {
            "pvzId": "49",
            "pvzName": "51",
            "location": "30"
          }
        }
      },
      "personTypes": {
        "isCompany": 1,
        "isNotCompany": 5
      }
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ,
    "errors": [

    ]
  };

  return new Promise((resolve) => {
    setTimeout(() => {
      resolve(result);
    }, 500);
  });
}

export const sendOrderRequest = async (params) => {
  console.log('sendOrderRequest', params);

  let result = {
    'status': 'success',
    'data': {
      "order": {
        "id": 101,
        "title": "Спасибо за заказ!",
        "message": "Заказ успешно оформлен.<br>Номер вашего заказа 30059.<br>Все детали заказа были отправлены на ваш e-mail."
      },
      "payment": {
        "title": "Оплата заказа",
        "info": "Оплата по счету на р/сч компании (Без НДС)",
        "message": "Если окно с платежной информацией не открылось автоматически, нажмите на ссылку Оплатить заказ.<br>Для того, чтобы скачать счет в формате pdf, нажмите на ссылку",
        "check": {
          "url": "https://mirvendinga.wadev.ru/",
          "text": "Скачать счет"
        },
      },
      "nextLink": {
        "url": "https://mirvendinga.wadev.ru/",
        "text": "На главную"
      }
    },
    errors: []
  };

  return new Promise((resolve) => {
    setTimeout(() => {
      resolve(result);
    }, 500);
  });
}

export const refresh = async (params) => {
  console.log('refresh', params);

  let result = {
    "status": "success",
    "data": {
      "profiles": [
        {
          "id": "636",
          "name": "Юлия Евгеньевна Частушкина",
          "customer": {
            "fullName": "Юлия Евгеньевна Частушкина",
            "phone": "79859969308",
            "email": "ychastushkina@inbox.ru"
          },
          "company": {
            "name": "222222222",
            "legalAdress": "",
            "inn": "",
            "kpp": ""
          },
          "address": {
            "city": "",
            "street": "",
            "houseNumber": "",
            "building": "",
            "floor": ""
          },
          "delivery": {
            "location": "",
            "pvzId": "5280",
            "pvzName": "г. Ростов-на-Дону, ул. Пескова д. 74 И"
          },
          "isCompany": true
        },
        {
          "id": "650",
          "name": "ТЕСТОВЫЙ ЗАКАЗ",
          "customer": {
            "fullName": "ТЕСТОВЫЙ ЗАКАЗ",
            "phone": "79518599658",
            "email": "sergey.l@web-aim.ru"
          },
          "company": {
            "name": "",
            "legalAdress": "",
            "inn": "",
            "kpp": ""
          },
          "address": {
            "city": "",
            "street": "",
            "houseNumber": "",
            "building": "",
            "floor": ""
          },
          "delivery": {
            "location": "",
            "pvzId": "",
            "pvzName": ""
          },
          "isCompany": false
        }
      ],
      "defaultProfile": 0,
      "defaultLocation": {
        "id": "418",
        "name": "Санкт-Петербург"
      },
      "auth": true,
      "authMessage": "Заполните поля ниже или <a href=\"/auth/\">авторизуйтесь</a> на сайте",
      "payment": {
        "paySystems": [
          {
            "id": "8",
            "title": "Картой на сайте (онлайн)"
          },
          {
            "id": "2",
            "title": "Оплата по счету"
          },
          {
            "id": "3",
            "title": "Оплата при получении"
          }
        ],
        "defaultPaySystem": "8"
      },
      "delivery": {
        "deliveries": [
          {
            "id": "2",
            "title": "Самовывоз",
            "description": "(мкр. Северное Чертаново д. 5)",
            "price": 0,
            "isPickUp": true,
            "pickUpPoints": [
              {
                "id": "1",
                "name": "Основной",
                "address": "124565, Москва, микрорайон Северное Чертаново, д. 5 офис 203, склад 28",
                "description": "",
                "phone": "+74957747461",
                "schedule": "Будни дни с 09:00 до 18:00. Суббота с 10:00 - 15:00",
                "email": "",
                "coordinates": [
                  "55.338341",
                  "37.841756"
                ]
              }
            ]
          },
          {
            "id": "12",
            "title": "Самовывоз (г. Москва)",
            "description": "Самовывоз в Москве",
            "price": null,
            "isPickUp": true,
            "pickUpPoints": [
              {
                "id": "6",
                "name": "Мир вендинга (Москва / Белые Столбы)",
                "address": "Московская область, микрорайон Белые Столбы, Станционная улица, С2",
                "description": "",
                "phone": "8 495 131 56 78",
                "schedule": "09:00 - 20:00",
                "email": "",
                "coordinates": [
                  "55.338341",
                  "37.841756"
                ]
              }
            ]
          },
          {
            "id": "3",
            "title": "Доставка по Москве (в пределах МКАД)",
            "description": "Доставка по Москве (в пределах МКАД)",
            "price": null,
            "isPickUp": false,
            "pickUpPoints": []
          },
          {
            "id": "5",
            "title": "Доставка по России",
            "description": "Производиться индивидуальный расчет стоимости доставки после согласования заказа.",
            "price": null,
            "isPickUp": false,
            "pickUpPoints": []
          }
        ],
        "defaultDelivery": "2"
      },
      "order": {
        "items": [
          {
            "id": "194022",
            "imageUrl": "/upload/resize_cache/iblock/c95/zgj3zy9653pzg3thwb05pxz4hnp1xken/180_140_1/ba7d69da4a3ce1d3ea8594587722760d.jpg",
            "title": "Вода газированная СВЯТОЙ ИСТОЧНИК 500мл 12шт/уп [6] [114]",
            "detailUrl": "/catalog/eda-i-napitki-optom/napitki/voda-gazirovannaya-svyatoy-istochnik-500ml-12sht-up-6-114/",
            "props": [
              {
                "label": "Количество",
                "value": "6 уп"
              },
              {
                "label": "Сумма",
                "value": "100.13 ₽"
              }
            ]
          }
        ],
        "total": [
          {
            "label": "Скидка",
            "value": "25.03 ₽"
          },
          {
            "label": "Доставка (примерный расчет)",
            "value": "0 ₽"
          },
          {
            "label": "Сумма",
            "value": "100.13 ₽",
            "main": true
          }
        ]
      },
      "properties": {
        "1": {
          "customer": {
            "fullName": "1",
            "email": "2",
            "phone": "3"
          },
          "address": {
            "street": "45",
            "houseNumber": "46",
            "building": "47",
            "floor": "48",
            "city": "40"
          },
          "delivery": {
            "pvzId": "50",
            "pvzName": "52",
            "location": "32"
          },
          "company": {
            "name": "35",
            "legalAdress": "36",
            "inn": "33",
            "kpp": "34"
          }
        },
        "5": {
          "customer": {
            "fullName": "25",
            "email": "26",
            "phone": "27"
          },
          "address": {
            "street": "41",
            "houseNumber": "42",
            "building": "43",
            "floor": "44",
            "city": "29"
          },
          "delivery": {
            "pvzId": "49",
            "pvzName": "51",
            "location": "30"
          }
        }
      },
      "personTypes": {
        "isCompany": 1,
        "isNotCompany": 5
      }
    },
    "errors": [

    ]
  };

  return new Promise((resolve) => {
    setTimeout(() => {
      resolve(result);
    }, 500);
  });
}

export const getLocationSuggestions = async (params) => {
  console.log('getLocationSuggestions', params);

  let result = {
    'status': 'success',
    'data': {
      "list": [
        {
          "id": 101,
          "name": "Город 1"
        },
        {
          "id": 102,
          "name": "Город 2"
        },
        {
          "id": 103,
          "name": "Город 3"
        },
        {
          "id": 104,
          "name": "Город 4"
        },
        {
          "id": 105,
          "name": "Город 5"
        },
        {
          "id": 106,
          "name": "Город 6"
        },
        {
          "id": 107,
          "name": "Город 7"
        },
        {
          "id": 108,
          "name": "Город 8"
        },
        {
          "id": 109,
          "name": "Город 9"
        }
      ]
    },
    errors: []
  };

  return new Promise((resolve) => {
    setTimeout(() => {
      resolve(result);
    }, 500);
  });
}