<template>
  <div class="page__container">
    <div class="section">
      <div class="section__content">
        <div class="section__form-panel">
          <form
            class="form form_result_large"
            :class="{
              'form_state_sent': formSubmitted
            }"
            @submit.prevent="sendForm"
          >
            <!-- messages can be placed before or after the form-->
            <div class="form__messages">
                <!-- Modifiers-->
                <!-- form__message_style_error - red color-->
                <div class="form__message">Сообщение формы</div>
            </div>
            <div class="form__main">
                <!-- begin .form-panel-->
                <div class="form-panel">
                    <div class="form-panel__heading">
                        <!-- begin .title-->
                        <h2 class="title title_size_h1">Заказать услугу</h2>
                        <!-- end .title-->
                    </div>
                    <div class="form-panel__content">
                        <div class="form-panel__wrapper">
                            <div class="form-panel__column">
                                <div class="form-panel__line">
                                    <FormControl
                                      label="ФИО"
                                      :required="true"
                                      :error="hasValidationError('fio')"
                                      v-model="form['fio']"
                                    />
                                </div>
                                <div class="form-panel__multiline">
                                    <div class="form-panel__line">
                                        <FormControl
                                          label="Телефон"
                                          :required="true"
                                          mask="+7 (###) ###-##-##"
                                          placeholder="+7 (000) 000-00-00"
                                          :error="hasValidationError('phone')"
                                          v-model="form['phone']"
                                        />
                                    </div>
                                    <div class="form-panel__line">
                                       <FormControl
                                        label="E-mail"
                                        :required="true"
                                        :error="hasValidationError('email')"
                                        v-model="form['email']"
                                      />
                                    </div>
                                </div>
                                <div class="form-panel__line">
                                    <!-- begin .form-control-->
                                    <div class="form-control">
                                        <label class="form-control__holder">
                                            <span class="form-control__label">
                                                Выберите тип автомата*
                                            </span>
                                            <span class="form-control__radio-panels">
                                              <RadioPanel
                                                :items="data.vendingTypes"
                                                :error="hasValidationError('vendingType')"
                                                v-model="form['vendingType']"
                                                ref="vendingType"
                                              />
                                            </span>
                                            <span class="form-control__messages">
                                                <span style="display: none" class="form-control__message form-control__message_style_error">
                                                    Ошибка поля
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <!-- end .form-control-->
                                </div>
                                <div class="form-panel__line">
                                  <ServiceItem
                                    id="standart"
                                    service-key="perevozka"
                                    type="checkbox"
                                    :service="getServiceByCode('perevozka')"
                                    @setService="setService"
                                    @unsetService="unsetService"
                                    ref="standart"
                                  />
                                </div>
                                <div class="form-panel__line">
                                  <ServiceItem
                                    label="Подача машины"
                                    service-key="perevozka"
                                    type="period"
                                    :services="periodServices"
                                    @setService="setService"
                                    @unsetService="unsetService"
                                  />
                                </div>
                                <div class="form-panel__line">
                                  <ServiceItem
                                    service-key="avtomat"
                                    label="Добавить автомат к перевозке"
                                    type="quantity"
                                    :service="getServiceByCode('avtomat')"
                                    @setService="setService"
                                    @unsetService="unsetService"
                                    :disabled="starndartServiceSelected"
                                  />
                                </div>
                            </div>
                            <div class="form-panel__column">
                              <div class="form-panel__line">
                                  <!-- begin .form-control-->
                                  <div class="form-control">
                                      <label class="form-control__holder">
                                          <span class="form-control__label">
                                              Откуда забираем
                                          </span>
                                          <span class="form-control__address-input">
                                              <!-- begin .address-input-->
                                              <span class="address-input">
                                                  <span class="address-input__field">
                                                      <input
                                                        class="address-input__input form-control__input"
                                                        :class="{
                                                          'form-control__input_state_invalid': hasValidationError('fromAddress')
                                                        }"
                                                        type="text"
                                                        v-model="form['fromAddress']"
                                                      >
                                                  </span>
                                                  <ServiceItem
                                                    service-key="podem"
                                                    type="floor"
                                                    :service="getServiceByCode('podem')"
                                                    @setService="setService"
                                                    @unsetService="unsetService"
                                                  />
                                              </span>
                                              <!-- end .address-input-->
                                          </span>
                                      </label>
                                  </div>
                                  <!-- end .form-control-->
                              </div>
                              <div class="form-panel__line">
                                  <!-- begin .form-control-->
                                  <div class="form-control">
                                      <label class="form-control__holder">
                                          <span class="form-control__label">Куда везем</span>
                                          <span class="form-control__address-input">
                                              <!-- begin .address-input-->
                                              <span class="address-input">
                                                  <span class="address-input__field">
                                                      <input
                                                        class="address-input__input form-control__input"
                                                        :class="{
                                                          'form-control__input_state_invalid': hasValidationError('toAddress')
                                                        }"
                                                        type="text"
                                                        v-model="form['toAddress']"
                                                      >
                                                      <span class="address-input__control">
                                                          <!-- begin .button-->
                                                          <button
                                                            class="button button_type_icon-only button_style_outline"
                                                            type="button"
                                                            @click="extraAddress = !extraAddress"
                                                          >
                                                            <span class="button__holder">
                                                                <svg
                                                                  v-if="!extraAddress"
                                                                  class="button__icon"
                                                                  width="16"
                                                                  height="16"
                                                                  viewBox="0 0 16 16"
                                                                  fill="none"
                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                    <path d="M14.8571 9.14286H9.14286V14.8571C9.14286 15.1602 9.02245 15.4509 8.80812 15.6653C8.5938 15.8796 8.3031 16 8 16C7.6969 16 7.40621 15.8796 7.19188 15.6653C6.97755 15.4509 6.85714 15.1602 6.85714 14.8571V9.14286H1.14286C0.839753 9.14286 0.549063 9.02245 0.334735 8.80812C0.120408 8.5938 0 8.3031 0 8C0 7.6969 0.120408 7.40621 0.334735 7.19188C0.549063 6.97755 0.839753 6.85714 1.14286 6.85714H6.85714V1.14286C6.85714 0.839753 6.97755 0.549062 7.19188 0.334735C7.40621 0.120408 7.6969 0 8 0C8.3031 0 8.5938 0.120408 8.80812 0.334735C9.02245 0.549062 9.14286 0.839753 9.14286 1.14286V6.85714H14.8571C15.1602 6.85714 15.4509 6.97755 15.6653 7.19188C15.8796 7.40621 16 7.6969 16 8C16 8.3031 15.8796 8.5938 15.6653 8.80812C15.4509 9.02245 15.1602 9.14286 14.8571 9.14286Z"></path>
                                                                </svg>
                                                                <svg
                                                                  v-else
                                                                  class="button__icon"
                                                                  width="16"
                                                                  height="2"
                                                                  viewBox="0 0 16 2"
                                                                  fill="none"
                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                >
                                                                  <path d="M14.8571 2H1.14286C0.839753 2 0.549063 1.89464 0.334735 1.70711C0.120408 1.51957 0 1.26522 0 1C0 0.734784 0.120408 0.48043 0.334735 0.292893C0.549063 0.105357 0.839753 0 1.14286 0H14.8571C15.1602 0 15.4509 0.105357 15.6653 0.292893C15.8796 0.48043 16 0.734784 16 1C16 1.26522 15.8796 1.51957 15.6653 1.70711C15.4509 1.89464 15.1602 2 14.8571 2Z"/>
                                                                </svg>
                                                            </span>
                                                          </button>
                                                          <!-- end .button-->
                                                      </span>
                                                  </span>
                                                  <span
                                                    v-if="!extraAddress && services.adres"
                                                    class="address-input__note"
                                                  >{{ services.adres.desc }}</span>
                                                  <ServiceItem
                                                    service-key="podem"
                                                    type="floor"
                                                    :service="getServiceByCode('podem')"
                                                    @setService="setService"
                                                    @unsetService="unsetService"
                                                  />
                                              </span>
                                              <!-- end .address-input-->
                                          </span>
                                      </label>
                                  </div>
                                  <!-- end .form-control-->
                              </div>
                              <div
                                v-show="extraAddress"
                                class="form-panel__line"
                              >
                                  <!-- begin .form-control-->
                                  <div class="form-control">
                                      <label class="form-control__holder">
                                          <span class="form-control__label">
                                              Второй адрес
                                          </span>
                                          <span class="form-control__address-input">
                                              <!-- begin .address-input-->
                                              <span class="address-input">
                                                  <span class="address-input__field">
                                                      <input
                                                        class="address-input__input form-control__input"
                                                        type="text"
                                                        v-model="form['extraAddress']"
                                                      >
                                                  </span>
                                                  <span
                                                    v-if="services.adres"
                                                    class="address-input__note"
                                                  >{{ services.adres.desc }}</span>
                                                  <ServiceItem
                                                    service-key="podem"
                                                    id="extraAddress"
                                                    type="floor"
                                                    :service="getServiceByCode('podem')"
                                                    @setService="setService"
                                                    @unsetService="unsetService"
                                                  />
                                              </span>
                                              <!-- end .address-input-->
                                          </span>
                                          <span class="form-control__messages">
                                              <span style="display: none" class="form-control__message form-control__message_style_error">
                                                  Ошибка поля
                                              </span>
                                          </span>
                                      </label>
                                  </div>
                                  <!-- end .form-control-->
                              </div>
                              <div class="form-panel__line">
                                <ServiceItem
                                  service-key="hranenie_avtomata"
                                  type="checkbox"
                                  :service="getServiceByCode('hranenie_avtomata')"
                                  @setService="setService"
                                  @unsetService="unsetService"
                                />
                              </div>
                              <div class="form-panel__line">
                                  <FormControl
                                    label="Комментарий"
                                    type="textarea"
                                    :error="hasValidationError('message')"
                                    v-model="form['message']"
                                  />
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="form-panel__panel">
                        <PricePanel
                          :totalPriceValue="totalPriceValue"
                        />
                    </div>
                    <div class="form-panel__footer">
                        <div class="form-panel__footer-wrapper">
                            <div class="form-panel__confirmation-check">
                                <!-- begin .check-elem-->
                                <label class="check-elem check-elem_text-size_s">
                                    <input
                                      class="check-elem__input"
                                      type="checkbox"
                                      name="agreement"
                                      v-model="confirmationCheck"
                                    >
                                    <span class="check-elem__label">
                                        Я даю согласие на обработку
                                        <a
                                          class="link"
                                          :href="politikaLink"
                                          target="_blank"
                                        >
                                            персональных данных
                                        </a>
                                    </span>
                                </label>
                                <!-- end .check-elem-->
                            </div>
                            <div class="form-panel__controls">
                                <div class="form-panel__control">
                                    <!-- begin .button-->
                                    <button
                                      class="button button_width_full button_size_s"
                                      :class="{
                                        'button_state_loading': isLoading
                                      }"
                                      type="submit"
                                      :disabled="!confirmationCheck || isLoading"
                                    >
                                        <span class="button__holder">Отправить</span>
                                    </button>
                                    <!-- end .button-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end .form-panel-->
            </div>
            <div class="form__final">
                <div class="form__illustration">
                    <svg
                      width="100"
                      height="100"
                      viewBox="0 0 100 100"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      class="form__image"
                    >
                      <rect x="2" y="2" width="96" height="96" rx="48" fill="white"/>
                      <path d="M43.5379 60.4111L31.8845 48.7576L28 52.6421L43.5379 68.18L76.8335 34.8845L72.949 31L43.5379 60.4111Z" fill="#CF006F"/>
                      <rect x="2" y="2" width="96" height="96" rx="48" stroke="#CF006F" stroke-width="4"/>
                    </svg>

                </div>
                <div class="form__message-wrapper">
                    <div class="form__title">
                        <!-- begin .title-->
                        <div class="title title_size_h1">Ваша заявка отправлена</div>
                        <!-- end .title-->
                    </div>
                    <div class="form__text">
                        Наш менеджер свяжется с вами в течении часа и уточнит детали
                    </div>
                    <div class="form__controls">
                        <div class="form__control">
                            <!-- begin .button-->
                            <a class="button button_width_full button_size_l button_text-size_l" href="/">
                                <span class="button__holder">На главную</span>
                            </a>
                            <!-- end .button-->
                        </div>
                        <div class="form__control">
                            <!-- begin .button-->
                            <button
                              class="button button_width_full button_size_l button_text-size_l button_style_outline"
                              @click.prevent="clearForm"
                              >
                                <span class="button__holder">Отправить еще заявку</span>
                            </button>
                            <!-- end .button-->
                        </div>
                    </div>
                </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import FormControl from './components/FormControl.vue'
import RadioPanel from './components/RadioPanel.vue'
import PricePanel from './components/PricePanel.vue'
import ServiceItem from './components/ServiceItem.vue'
import { api } from './api';
import { useVuelidate } from '@vuelidate/core'
import { required, email, minLength, maxLength } from '@vuelidate/validators'

export default {
  name: 'App',
  components: { FormControl, RadioPanel, PricePanel, ServiceItem },
  setup() {
    return { v$: useVuelidate() }
  },
  data() {
    return {
      data: {},
      formSubmitted: false,
      confirmationCheck: false,
      extraAddress: false,
      form: {
        fio: '',
        email: '',
        phone: '',
        vendingType: '',
        message: '',
        fromAddress: '',
        toAddress: '',
        extraAddress: '',
        services: {}
      },
      selectedServices: {},
      isLoading: false
    }
  },
  validations() {
    return {
      form: {
        fio: { required },
        email: { required, email },
        phone: { required, minLength: minLength(18), maxLength: maxLength(18) },
        vendingType: { required },
        fromAddress: { required },
        toAddress: { required },
      }
    }
  },
  computed: {
    starndartServiceSelected() {
      return typeof this.selectedServices['standart'] === 'undefined';
    },
    periodServices() {
      return  {
        'podacha_18_23': this.getServiceByCode('podacha_18_23'),
        'podacha_23_9': this.getServiceByCode('podacha_23_9')
      }
    },
    formDataObj() {
      let result = { arFormData : {}};
      Object.keys(this.form).map(key => {
        if (key !== 'file') {
          result.arFormData[key] = this.form[key];
        }
      });

      result.arFormData['services'] = [];

      Object.keys(this.selectedServices).map(key => {
        let service = { ...this.selectedServices[key] };
        service.id = parseInt(service.id);
        service.cost = parseFloat(service.cost);
        service.code = service.serviceKey;
        delete service.placeId;
        delete service.serviceKey;
        result.arFormData['services'].push(service);
      });

      return result;
    },
    formData() {
      let i = 0,
        result = new FormData();
      Object.keys(this.form).map(key => {
        if (key !== 'file') {
          result.append('arFormData[' + key + ']', this.form[key]);
        } else {
          result.append('file', this.form[key]);
        }
      });

      result.append('arFormData[services]', []);

      Object.keys(this.selectedServices).map(key => {
        let service = { ...this.selectedServices[key] };
        service.id = parseInt(service.id);
        service.cost = parseFloat(service.cost);
        service.code = service.serviceKey;
        delete service.placeId;
        delete service.serviceKey;
        result.append('arFormData[services][' + i + ']', {});
        Object.keys(service).map(serviceKey => {
          result.append('arFormData[services][' + i + '][' + serviceKey + ']', service[serviceKey]);
        });
        i++;
      });

      return result;
    },
    userFields() {
      return this.data.user || {};
    },
    politikaLink() {
      let result = '/politika/';

      if (this.data.politikaLink) result = this.data.politikaLink;

      return result;
    },
    services() {
      return this.data.transportServices || {};
    },
    totalPriceValue() {
      let result = 0;

      Object.values(this.selectedServices).map(service => {
        let price = service.cost * service.quantity;
        if (service.placeId === 'extraAddress' && !this.extraAddress) price = 0
        result += price;
      });

      return result;
    }
  },
  watch: {
    selectedServices: {
      immediate: true,
      deep: true,
      handler(services) {
        // Если "Стандарт" выбран то отмечаем тип автомата "Все"
        if(typeof services.standart !== 'undefined' && this.form.vendingType === '') {
           if (typeof this.$refs.vendingType !== 'undefined') {
            this.$refs.vendingType.setAllValue();
          }
        }
      }
    },
    form: {
      immediate: true,
      deep: true,
      handler(form) {
        if (typeof form.vendingType !== 'undefined') {
          // Если выбрали "Тип автомата" то "Стандарт делаем активным"
          if (form.vendingType !== '' && typeof this.$refs.standart !== 'undefined') {
            this.$refs.standart.checkedService();
          }
        }
      }
    },
    extraAddress(isset) {
      const key = 'extra_address_service',
        extraAddressSerivce = this.getServiceByCode('adres'),
        service = {
          quantity: 1,
          cost: extraAddressSerivce.cost || 0,
          id: extraAddressSerivce.id,
          placeId: key,
          serviceKey: 'adres'
        };

      if (isset) {
        this.setService(service);
      } else {
         this.unsetService(service);
      }
    },
    data(newData) {
      if (typeof newData.user !== 'undefined') {
        Object.assign(this.form, newData.user);
      }
    }
  },
  mounted() {
    this.data = window.initData || this.data;
  },
  methods: {
    hasValidationError(key) {
      let result = false;

      if (typeof this.v$.form[key] !== 'undefined') {
        if (this.v$.form[key].$errors.length) {
          result = true;
        }
      }

      return result;
    },
    sendForm() {
      this.v$.$touch();
      if (!this.v$.$invalid) {
        this.isLoading = true;
        api.sendTransportForm(this.formData).then((result) => {
          if (result.status) {
            this.formSubmitted = true;
          } else {
            console.error(result);
            alert('Произошла ошибка. Попробуйте отправить форму позднее');
          }
        }).catch((result) => {
          console.error(result);
        }).finally(() => {
          this.isLoading = false;
        });
      }
    },
    clearForm() {
      this.formSubmitted = false;
      this.extraAddress = false;
      this.v$.$reset();

      Object.keys(this.form).map(key => {
        if (typeof this.userFields[key] === 'undefined') {
          if (Array.isArray(this.form[key])) {
             this.form[key] = [];
          } else {
            this.form[key] = '';
          }
        }
      });

     const resetFormEvent = new CustomEvent('resetForm', {
        bubbles: true,
        detail: { text: () => textarea.value },
      });
      document.dispatchEvent(resetFormEvent);
    },
    getServiceByCode(code = null) {
      let result = {};

      if (code && typeof this.services[code] !== 'undefined') {
        result = this.services[code];
      }

      return result;
    },
    setService(service) {
      if(typeof service.placeId !== 'undefined') this.selectedServices[service.placeId] = service;
    },
    unsetService(service) {
      if(typeof service.placeId !== 'undefined' && typeof this.selectedServices[service.placeId] !== 'undefined') {
        delete this.selectedServices[service.placeId];
      }
    }
  }
}
</script>

<style scoped>
</style>
