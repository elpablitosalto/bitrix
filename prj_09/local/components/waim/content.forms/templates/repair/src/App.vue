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
                            </div>
                            <div class="form-panel__column">
                                <div class="form-panel__line">
                                  <!-- begin .form-control-->
                                  <div class="form-control">
                                      <div class="form-control__holder">
                                          <div class="form-control__label">
                                              Выберите услуги
                                          </div>
                                          <CheckGroup
                                            ref="CheckGroup"
                                            :error="hasValidationError('repairServices')"
                                            :items="repairServices"
                                            v-model="form.repairServices"
                                          />
                                          <div class="form-control__messages">
                                              <div style="display: none" class="form-control__message form-control__message_style_error">
                                                  Ошибка поля
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- end .form-control-->
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
                                      type="submit"
                                      :disabled="!confirmationCheck"
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
import CheckGroup from './components/CheckGroup.vue'
import PricePanel from './components/PricePanel.vue'
import { api } from './api';
import { useVuelidate } from '@vuelidate/core'
import { required, email, minLength, maxLength } from '@vuelidate/validators'

const arrayIsNotEmpty = (list) => !!list.length;

export default {
  name: 'App',
  components: { FormControl, CheckGroup, RadioPanel, PricePanel },
  setup() {
    return { v$: useVuelidate() }
  },
  data() {
    return {
      data: {},
      formSubmitted: false,
      confirmationCheck: false,
      form: {
        fio: null,
        email: null,
        phone: null,
        vendingType: null,
        repairServices: []
      }
    }
  },
  validations() {
    return {
      form: {
        fio: { required },
        email: { required, email },
        phone: { required, minLength: minLength(18), maxLength: maxLength(18) },
        vendingType: { required },
        repairServices: { arrayIsNotEmpty }
      }
    }
  },
  computed: {
    formData() {
      let result = new FormData();

      Object.keys(this.form).map(key => {
        if (key !== 'file') {
          result.append('arFormData[' + key + ']', this.form[key]);
        } else {
          result.append('file', this.form[key]);
        }
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
    repairServices() {
      return this.data.repairServices || {};
    },
    totalPriceValue() {
      let result = 0;

      this.form.repairServices.map(key => {
        if (typeof this.repairServices[key] !== 'undefined') {
          const service = this.repairServices[key];

          result += parseFloat(service.cost) || 0;
        }
      });

      return result;
    }
  },
  watch: {
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
        api.sendRepairForm(this.formData).then((result) => {
          if (result.status) {
            this.formSubmitted = true;
          }
        }).catch((result) => {
          console.error(result);
        }).finally(() => {
        });
      }
    },

    clearForm() {
      this.formSubmitted = false;
      this.v$.$reset();
      this.$refs.CheckGroup.reset();

      Object.keys(this.form).map(key => {
        if (typeof this.userFields[key] === 'undefined') {
          if (Array.isArray(this.form[key])) {
             this.form[key] = [];
          } else {
            this.form[key] = null;
          }
        }
      });
    }
  }
}
</script>

<style scoped>
</style>
