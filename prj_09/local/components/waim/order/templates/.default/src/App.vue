<template>
  <form
    class="checkout"
    data-passed-validation="false"
    novalidate="novalidate"
    :class="{
      page__container: isDevMode,
      checkout_map_open: mapOpen
    }"
    @submit.prevent="preventForm"
  >
    <template v-if="isReady">
      <template v-if="!successSend">
        <div
          v-if="!isAuth"
          class="checkout__message"
          v-html="authMessage"
        />
        <div class="checkout__wrapper">
          <div class="checkout__main">
            <div
              v-if="profiles && profiles.length"
              class="checkout__section"
            >
              <div class="checkout__title">
                <!-- begin .title-->
                <h2 class="title title_size_h3">
                  Профили аккаунта
                </h2>
                <!-- end .title-->
              </div>
              <div class="checkout__inputs">
                <!-- begin .form-control-->
                <div class="form-control checkout__line">
                  <div class="form-control__holder">
                    <div class="form-control__check-group">
                      <div
                        v-for="profile, index in profiles"
                        :key="'profile-' + index"
                        class="form-control__check-item"
                      >
                        <!-- begin .check-elem-->
                        <label class="check-elem check-elem_text-size_l">
                          <input
                            v-model="order.profile"
                            class="check-elem__input"
                            name="profile"
                            type="radio"
                            :value="profile.id"
                            @change="setProfile"
                          >
                          <span class="check-elem__label">{{ profile.name }}</span>
                        </label>
                        <!-- end .check-elem-->
                      </div>
                    </div>
                    <div class="form-control__messages">
                      <div
                        style="display: none"
                        class="form-control__message form-control__message_style_error"
                      >
                        Ошибка поля
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end .form-control-->
              </div>
            </div>
            <div class="checkout__section">
              <div class="checkout__title">
                <!-- begin .title-->
                <h2 class="title title_size_h3">
                  Личные данные
                </h2>
                <!-- end .title-->
              </div>
              <div class="checkout__inputs">
                <!-- begin .form-control-->
                <div class="form-control checkout__line">
                  <label class="form-control__holder">
                    <span class="form-control__label">ФИО</span>
                    <span class="form-control__field">
                      <input
                        v-model="order.customer.fullName"
                        type="text"
                        class="form-control__input"
                        :class="{
                          'form-control__input_state_invalid': v$.order.customer.fullName.$errors.length
                        }"
                        name="name"
                        @focusout="v$.order.customer.fullName.$touch()"
                      >
                    </span>
                    <span class="form-control__messages">
                      <span
                        v-for="error of v$.order.customer.fullName.$errors"
                        :key="error.$uid"
                        class="form-control__message form-control__message_style_error"
                      >{{ getErrorMessage(error.$validator) }}</span>
                    </span>
                  </label>
                </div>
                <!-- end .form-control-->
                <!-- begin .form-control-->
                <div class="form-control checkout__line">
                  <label class="form-control__holder">
                    <span class="form-control__label">Телефон</span>
                    <span class="form-control__field">
                      <input
                        v-model="order.customer.phone"
                        type="text"
                        class="form-control__input"
                        :class="{
                          'form-control__input_state_invalid': v$.order.customer.phone.$errors.length
                        }"
                        v-maska
                        :data-maska="phoneMask"
                        @focusout="v$.order.customer.phone.$touch()"
                      />
                    </span>
                    <span class="form-control__messages">
                      <span
                        v-for="error of v$.order.customer.phone.$errors"
                        :key="error.$uid"
                        class="form-control__message form-control__message_style_error"
                      >{{ getErrorMessage(error.$validator) }}</span>
                    </span>
                  </label>
                </div>
                <!-- end .form-control-->
                <!-- begin .form-control-->
                <div class="form-control checkout__line">
                  <label class="form-control__holder">
                    <span class="form-control__label">E-mail</span>
                    <span class="form-control__field">
                      <input
                        v-model="order.customer.email"
                        type="email"
                        class="form-control__input js-email-input"
                        :class="{
                          'form-control__input_state_invalid': v$.order.customer.email.$errors.length
                        }"
                        name="email"
                        @focusout="v$.order.customer.email.$touch()"
                      >
                    </span>
                    <span class="form-control__messages">
                      <span
                        v-for="error of v$.order.customer.email.$errors"
                        :key="error.$uid"
                        class="form-control__message form-control__message_style_error"
                      >{{ getErrorMessage(error.$validator) }}</span>
                    </span>
                  </label>
                </div>
                <!-- end .form-control-->
                <!-- begin .form-control-->
                <div class="form-control checkout__line checkout__line_type_separated">
                  <div class="form-control__holder">
                    <div class="form-control__switch-group">
                      <div class="form-control__switch-item">
                        <!-- begin .switch-->
                        <label class="switch switch_type_padded">
                          <input
                            v-model="order.isCompany"
                            class="switch__input"
                            type="checkbox"
                            name="company-representitive"
                          >
                          <span class="switch__body">
                            <span class="switch__container">
                              <span class="switch__wrapper">
                                <span class="switch__knob">
                                                          &nbsp;
                                </span>
                              </span>
                            </span>
                            <span class="switch__label">
                              Для юрлиц и ИП
                            </span>
                          </span>
                        </label>
                        <!-- end .switch-->
                      </div>
                    </div>
                    <span class="form-control__messages">
                      <span
                        style="display: none"
                        class="form-control__message form-control__message_style_error"
                      >
                        Ошибка поля
                      </span>
                    </span>
                  </div>
                </div>
                <!-- end .form-control-->

                <template v-if="order.isCompany">
                  <div class="form-control checkout__line">
                    <label class="form-control__holder">
                      <span class="form-control__label">Название организции</span>
                      <span class="form-control__field">
                        <input
                          v-model="order.company.name"
                          type="text"
                          class="form-control__input"
                          :class="{
                            'form-control__input_state_invalid': v$.order.company.name.$errors.length
                          }"
                          name="company-name"
                          @focusout="v$.order.company.name.$touch()"
                        >
                      </span>
                      <span class="form-control__messages">
                        <span
                          v-for="error of v$.order.company.name.$errors"
                          :key="error.$uid"
                          class="form-control__message form-control__message_style_error"
                        >{{ getErrorMessage(error.$validator) }}</span>
                      </span>
                    </label>
                  </div>
                  <div class="form-control checkout__line">
                    <label class="form-control__holder">
                      <span class="form-control__label">Юридический адрес</span>
                      <span class="form-control__field">
                        <input
                          v-model="order.company.legalAdress"
                          type="text"
                          class="form-control__input"
                          :class="{
                            'form-control__input_state_invalid': v$.order.company.legalAdress.$errors.length
                          }"
                          name="company-address"
                          @focusout="v$.order.company.legalAdress.$touch()"
                        >
                      </span>
                      <span class="form-control__messages">
                        <span
                          v-for="error of v$.order.company.legalAdress.$errors"
                          :key="error.$uid"
                          class="form-control__message form-control__message_style_error"
                        >{{ getErrorMessage(error.$validator) }}</span>
                      </span>
                    </label>
                  </div>
                  <div class="checkout__multiline">
                    <!-- begin .form-control-->
                    <div class="form-control checkout__line">
                      <label class="form-control__holder">
                        <span class="form-control__label">ИНН</span>
                        <span class="form-control__field">
                          <!-- Modifiers-->
                          <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                          <input
                            v-model="order.company.inn"
                            type="text"
                            class="form-control__input"
                            :class="{
                              'form-control__input_state_invalid': v$.order.company.inn.$errors.length
                            }"
                            name="company-tin"
                            @focusout="v$.order.company.inn.$touch()"
                          >
                        </span>
                        <span class="form-control__messages">
                          <span
                            v-for="error of v$.order.company.inn.$errors"
                            :key="error.$uid"
                            class="form-control__message form-control__message_style_error"
                          >{{ getErrorMessage(error.$validator) }}</span>
                        </span>
                      </label>
                    </div>
                    <!-- end .form-control-->
                    <!-- begin .form-control-->
                    <div class="form-control checkout__line">
                      <label class="form-control__holder">
                        <span class="form-control__label">КПП (если есть)</span>
                        <span class="form-control__field">
                          <!-- Modifiers-->
                          <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                          <input
                            v-model="order.company.kpp"
                            type="text"
                            class="form-control__input"
                            name="company-cor"
                          >
                        </span>
                        <span class="form-control__messages">
                          <span
                            style="display: none"
                            class="form-control__message form-control__message_style_error"
                          >
                            Ошибка поля
                          </span>
                        </span>
                      </label>
                    </div>
                    <!-- end .form-control-->
                  </div>
                </template>
              </div>
            </div>
            <div
              v-if="deliveries"
              class="checkout__section"
            >
              <div class="checkout__title">
                <!-- begin .title-->
                <h2 class="title title_size_h3">
                  Способ доставки
                </h2>
                <!-- end .title-->
              </div>
              <div class="checkout__inputs">
                <div class="checkout__line">
                  <!-- begin .form-control-->
                  <div
                    class="form-control"
                    @keydown.down="nextSuggest"
                    @keydown.up="prevSuggest"
                    @keydown.enter="selectSuggest"
                  >
                    <label class="form-control__holder">
                      <span class="form-control__label">Населенный пункт</span>
                      <span class="form-control__field">
                        <input
                          v-model="order.address.city"
                          type="text"
                          class="form-control__input"
                          name="locality"
                          @keyup="locationInput"
                          @focusout="locationFocusout"
                        >
                        <span class="form-control__result form-control__result_state_shown">
                          <!-- search-results - no matches message shown-->
                          <!-- search-results_state_filled - search results shown-->
                          <!-- search-results_state_no-results - no matches message shown, priority over _state_filled-->
                          <!-- begin .search-results-->
                          <span class="search-results search-results_state_filled">
                            <span class="search-results__message">
                              Совпадений не найдено
                            </span>
                            <span class="search-results__matches">
                              <ul class="search-results__list">
                                <li
                                  v-for="location, index in locationSuggestions"
                                  :key="'location' + index"
                                  class="search-results__item"
                                  :class="{
                                    'search-results__item_selected': selectedSuggest === index
                                  }"
                                >
                                  <span
                                    class="search-results__link"
                                    @click="setLocation(location)"
                                  >{{ location.name }}</span>
                                </li>
                              </ul>
                            </span>
                          </span>
                          <!-- end .search-results-->
                        </span>
                      </span>
                      <span class="form-control__messages">
                        <span
                          style="display: none"
                          class="form-control__message form-control__message_style_error"
                        >
                          Ошибка поля
                        </span>
                      </span>
                    </label>
                  </div>
                  <!-- end .form-control-->
                </div>
                <div class="checkout__line">
                    <!-- begin .form-control-->
                    <div class="form-control">
                      <div class="form-control__holder">
                        <div class="form-control__switch-group">
                          <div
                            v-for="delivery, index in deliveries"
                            :key="'delivery' + index"
                            class="form-control__switch-item"
                            style="width: 100%"
                          >
                            <!-- begin .switch-->
                            <label class="switch">
                              <input
                                class="switch__input"
                                type="radio"
                                name="delivery"
                                :checked="currentDelivery.id === delivery.id"
                                @change="changeDelivery(delivery)"
                              >
                              <span class="switch__body">
                                <span class="switch__container">
                                  <span class="switch__wrapper">
                                    <span class="switch__knob">
                                                          &nbsp;
                                    </span>
                                  </span>
                                </span>
                                <span class="switch__label">{{ delivery.title }}</span>
                              </span>
                            </label>
                            <!-- end .switch-->
                          </div>
                        </div>
                        <span class="form-control__messages">
                          <span
                            style="display: none"
                            class="form-control__message form-control__message_style_error"
                          >
                            Ошибка поля
                          </span>
                        </span>
                      </div>
                    </div>
                    <!-- end .form-control-->
                </div>

                <template v-if="!isPickup">
                  <!-- begin .form-control-->
                  <div class="form-control checkout__line">
                    <label class="form-control__holder">
                      <span class="form-control__label">Улица</span>
                      <span class="form-control__field">
                        <input
                          v-model="order.address.street"
                          type="text"
                          class="form-control__input"
                          name="street"
                        >
                      </span>
                      <span class="form-control__messages">
                        <span
                          style="display: none"
                          class="form-control__message form-control__message_style_error"
                        >
                          Ошибка поля
                        </span>
                      </span>
                    </label>
                  </div>
                  <!-- end .form-control-->
                  <div class="checkout__multiline">
                    <!-- begin .form-control-->
                    <div class="form-control checkout__line">
                      <label class="form-control__holder">
                        <span class="form-control__label">Дом</span>
                        <span class="form-control__field">
                          <input
                            v-model="order.address.houseNumber"
                            type="text"
                            class="form-control__input"
                            name="building"
                          >
                        </span>
                        <span class="form-control__messages">
                          <span
                            style="display: none"
                            class="form-control__message form-control__message_style_error"
                          >
                            Ошибка поля
                          </span>
                        </span>
                      </label>
                    </div>
                    <!-- end .form-control-->
                    <!-- begin .form-control-->
                    <div class="form-control checkout__line">
                      <label class="form-control__holder">
                        <span class="form-control__label">Корпус</span>
                        <span class="form-control__field">
                          <input
                            v-model="order.address.building"
                            type="text"
                            class="form-control__input"
                            name="wing"
                          >
                        </span>
                        <span class="form-control__messages">
                          <span
                            style="display: none"
                            class="form-control__message form-control__message_style_error"
                          >
                            Ошибка поля
                          </span>
                        </span>
                      </label>
                    </div>
                    <!-- end .form-control-->
                    <!-- begin .form-control-->
                    <div class="form-control checkout__line">
                      <label class="form-control__holder">
                        <span class="form-control__label">Этаж</span>
                        <span class="form-control__field">
                          <input
                            v-model="order.address.floor"
                            type="number"
                            class="form-control__input"
                            name="floor"
                          >
                        </span>
                        <span class="form-control__messages">
                          <span
                            style="display: none"
                            class="form-control__message form-control__message_style_error"
                          >
                            Ошибка поля
                          </span>
                        </span>
                      </label>
                    </div>
                    <!-- end .form-control-->
                  </div>
                </template>

                <div
                  v-else
                  class="form-control checkout__line"
                >
                  <div class="form-control__holder">
                    <div class="form-control__label">
                      Выберите ПВЗ:
                    </div>
                    <div
                      v-if="pickupPoints.length"
                      class="form-control__check-group"
                    >
                      <div
                        v-for="point in pickupPoints"
                        :key="'point-' + point.id"
                        class="form-control__check-item"
                      >
                        <!-- begin .check-elem-->
                        <span class="check-elem check-elem_type_has-extra">
                          <input
                            :id="'point-' + point.id"
                            v-model="order.delivery.pvzId"
                            class="check-elem__input"
                            name="delivery-point"
                            type="radio"
                            :value="point.id"
                            @change="changePvz(point)"
                          >
                          <span
                            class="check-elem__label"
                          >
                            <label
                              :for="'point-' + point.id"
                              class="check-elem__text"
                            >{{ point.address }}</label>
                            <span class="check-elem__extra">
                              <span
                                class="link"
                                :title="point.schedule"
                                @click="showSchedule(point)"
                              >График работы ПВЗ</span>
                            </span>
                          </span>
                        </span>
                        <!-- end .check-elem-->
                      </div>
                    </div>
                    <div
                      v-else
                      class="form-control__messages"
                    >
                      <div сlass="form-control__message form-control__message_style_error">
                        Не удалось найти ПВЗ
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                v-if="isPickup && pickupPoints.length"
                class="checkout__map"
              >
                <div class="checkout__map-trigger">
                  <!-- begin .link-->
                  <button
                    class="link"
                    type="button"
                    @click="mapOpen = !mapOpen"
                    v-html="mapOpen ? 'Скрыть карту' : 'Показать на карте'"
                  />
                  <!-- end .link-->
                </div>
                <div class="checkout__map-panel">
                  <!-- begin .map-->
                  <div class="map map_size_s">
                    <YandexMap
                      class="map__panel"
                      map-type="map"
                      :settings="settings"
                      :coordinates="mapCoordinates"
                      :bounds="mapBounds"
                      @created="initMap"
                    >
                      <YandexMarker
                        v-for="point in pickupPoints"
                        :key="'marker-' + point.id"
                        :marker-id="point.id"
                        :coordinates="point.coordinates"
                        :options="{
                          iconLayout: 'default#image',
                          iconImageSize: [32, 32],
                          iconOffset: [-16, -16],
                          iconImageHref: mapMarker
                        }"
                      >
                        <template #component>
                          <div class="map-balloon map-balloon_type_modal">
                            <button
                              type="button"
                              class="map-balloon__close"
                              @click="closeModal"
                            >
                              Закрыть
                            </button>
                            <div class="map-balloon__fields">
                              <div
                                v-if="modal.address"
                                class="map-balloon__field"
                              >
                                {{ modal.address }}
                              </div>
                              <div
                                v-if="modal.schedule"
                                class="map-balloon__field"
                              >
                                <div class="map-balloon__field-title">
                                  Режим работы:
                                </div>
                                {{ modal.schedule }}
                              </div>
                              <div
                                v-if="modal.description"
                                class="map-balloon__field"
                              >
                                <div class="map-balloon__field-title">
                                  Как добраться:
                                </div>
                                {{ modal.description }}
                              </div>
                              <div
                                v-if="modal.email"
                                class="map-balloon__field"
                              >
                                <div class="map-balloon__field-title">
                                  E-mail:
                                </div>
                                {{ modal.email }}
                              </div>
                              <div
                                v-if="modal.phone"
                                class="map-balloon__field"
                              >
                                <div class="map-balloon__field-title">
                                  Телефон:
                                </div>
                                {{ modal.phone }}
                              </div>
                            </div>
                          </div>

                          <div class="marker">
                            <div
                              v-if="point.address"
                              class="marker__group"
                            >
                              {{ point.address }}
                            </div>
                            <div
                              v-if="point.schedule"
                              class="marker__group"
                            >
                              <div class="marker__label">
                                Режим работы:
                              </div>
                              {{ point.schedule }}
                            </div>
                            <div
                              v-if="point.description"
                              class="marker__group"
                            >
                              <div class="marker__label">
                                Как добраться:
                              </div>
                              {{ point.description }}
                            </div>
                          </div>
                        </template>
                      </YandexMarker>
                    </YandexMap>
                  </div>
                  <!-- end .map-->
                </div>
              </div>
            </div>
            <div
              v-if="payments"
              class="checkout__section 123"
            >
              <div class="checkout__title">
                <!-- begin .title-->
                <h2 class="title title_size_h3">
                  Способ оплаты
                </h2>
                <!-- end .title-->
              </div>
              <div class="checkout__inputs">
                <!-- begin .form-control-->
                <div class="form-control checkout__line">
                  <label class="form-control__holder">
                    <span class="form-control__radio-panels">
                      <!-- begin .radio-panels-->
                      <span class="radio-panels">
                        <span class="radio-panels__items">
                          <span
                            v-for="payment, index in payments"
                            :key="'payment' + index"
                            class="radio-panels__item"
                          >
                            <label class="radio-panels__label">
                              <input
                                v-model="order.payment"
                                class="radio-panels__input"
                                type="radio"
                                name="payment"
                                :value="payment.id"
                              >
                              <span class="radio-panels__panel">
                                {{ payment.title }}
                              </span>
                            </label>
                          </span>
                        </span>
                      </span>
                      <!-- end .radio-panels-->
                    </span>
                    <span class="form-control__messages">
                      <span
                        style="display: none"
                        class="form-control__message form-control__message_style_error"
                      >
                        Ошибка поля
                      </span>
                    </span>
                  </label>
                </div>
                <!-- end .form-control-->
              </div>
            </div>
            <div class="checkout__section">
              <!-- begin .form-control-->
              <div class="form-control checkout__line">
                <label class="form-control__holder">
                  <span class="form-control__label">Комментарий к заказу</span>
                  <span class="form-control__field">
                    <textarea
                      v-model="order.message"
                      class="form-control__textarea"
                      name="comment"
                    />
                  </span>
                  <span class="form-control__messages">
                    <span
                      style="display: none"
                      class="form-control__message form-control__message_style_error"
                    >
                      Ошибка поля
                    </span>
                  </span>
                </label>
              </div>
              <!-- end .form-control-->
            </div>

            <div
              v-if="!isAuth"
              class="checkout__section"
            >
              <!-- begin .check-elem-->
              <label class="check-elem check-elem_text-size_s">
                <input
                  v-model="agreement"
                  class="check-elem__input"
                  type="checkbox"
                  name="agreement"
                >
                <span class="check-elem__label">
                  Я даю согласие на обработку
                  <a
                    class="link"
                    href="/politika/"
                  >
                    персональных данных
                  </a>
                </span>
              </label>
              <!-- end .check-elem-->
            </div>
          </div>
          <div class="checkout__aside">
            <div class="checkout__panel">
              <div class="checkout__heading">
                <div class="checkout__title">
                  <!-- begin .title-->
                  <h2 class="title title_size_h3">
                    Состав заказа:
                  </h2>
                  <!-- end .title-->
                </div>
              </div>
              <div class="checkout__products">
                <div
                  v-for="item, index in orderItems"
                  :key="index"
                  class="checkout__product"
                >
                  <!-- begin .checkout-product-->
                  <div class="checkout-product">
                    <a
                      v-if="item.imageUrl"
                      :href="item.detailUrl"
                      class="checkout-product__illustration"
                    >
                      <picture class="checkout-product__picture">
                        <img
                          :src="item.imageUrl"
                          alt="image"
                          class="checkout-product__image lazyload lazyload_entered lazyload_loaded"
                          title=""
                          data-ll-status="loaded"
                        >
                      </picture>
                    </a>
                    <div class="checkout-product__info">
                      <div class="checkout-product__title">
                        <a
                          :href="item.detailUrl"
                          class="checkout-product__link"
                        >{{ item.title }}
                        </a>
                      </div>
                      <div class="checkout-product__props">
                        <!-- begin .props-->
                        <div
                          v-if="item.props"
                          class="props"
                        >
                          <div
                            v-for="prop in item.props"
                            :key="prop.value"
                            class="props__prop"
                          >
                            <div class="props__label">
                              {{ prop.label }}:
                            </div>
                            <div class="props__value">
                              {{ prop.value }}
                            </div>
                          </div>
                        </div>
                        <!-- end .props-->
                      </div>
                    </div>
                  </div>
                  <!-- end .checkout-product-->
                </div>
              </div>
            </div>
            <div class="checkout__panel">
              <div class="checkout__heading">
                <div class="checkout__title">
                  <!-- begin .title-->
                  <h2 class="title title_size_h3">
                    Итого:
                  </h2>
                  <!-- end .title-->
                </div>
                <div class="checkout__label">
                  {{ numberOfItems }} {{ getItemMorph(numberOfItems) }}
                </div>
              </div>
              <div
                v-if="orderTotal"
                class="checkout__final"
              >
                <!-- begin .props-->
                <div class="props props_size_l props_layout_spread">
                  <div
                    v-for="line, index in orderTotal"
                    :key="'total-' + index"
                    class="props__prop"
                    :class="{
                      props__prop_type_important: line.main
                    }"
                  >
                    <div class="props__label">
                      {{ line.label }}
                    </div>
                    <div class="props__value">
                      {{ line.value }}
                    </div>
                  </div>
                </div>
                <!-- end .props-->
              </div>
            </div>
          </div>
        </div>
        <div class="checkout__controls">
          <div class="checkout__control">
            <!-- begin .button-->
            <button
              class="button button_width_full button_size_l button_text-size_l"
              type="button"
              :disabled="!isAuth && !agreement"
              @click="createOrder"
            >
              <span class="button__holder">Оформить заказ</span>
            </button>
            <!-- end .button-->
          </div>
        </div>
      </template>
      <Loader
        class="checkout__loader"
        :class="{
          'checkout__loader_state_active': isLoading.setup
        }"
      />
    </template>
    <SuccessMessage
      v-if="successSend"
      :fields="success"
    />
    <div class="page__store-detail-modal">
      <button
        type="button"
        class="page__store-detail-backdrop"
        @click="closeModal"
      >
        Закрыть
      </button>
      <div class="page__store-detail-container">
        <!-- begin .map-balloon-->
        <div class="map-balloon map-balloon_type_modal">
          <button
            type="button"
            class="map-balloon__close"
            @click="closeModal"
          >
            Закрыть
          </button>
          <div class="map-balloon__fields">
            <div
              v-if="modal.address"
              class="map-balloon__field"
            >
              {{ modal.address }}
            </div>
            <div
              v-if="modal.schedule"
              class="map-balloon__field"
            >
              <div class="map-balloon__field-title">
                Режим работы:
              </div>
              {{ modal.schedule }}
            </div>
            <div
              v-if="modal.description"
              class="map-balloon__field"
            >
              <div class="map-balloon__field-title">
                Как добраться:
              </div>
              {{ modal.description }}
            </div>
            <div
              v-if="modal.email"
              class="map-balloon__field"
            >
              <div class="map-balloon__field-title">
                E-mail:
              </div>
              {{ modal.email }}
            </div>
            <div
              v-if="modal.phone"
              class="map-balloon__field"
            >
              <div class="map-balloon__field-title">
                Телефон:
              </div>
              {{ modal.phone }}
            </div>
          </div>
        </div>
        <!-- end .map-balloon-->
      </div>
    </div>
  </form>
</template>

<script>
import Loader from './components/Loader.vue'
import SuccessMessage from './components/SuccessMessage.vue'
import { getInitData, sendOrderRequest, refresh, getLocationSuggestions } from './api';
import { vMaska } from "maska"
import { Mask } from "maska"
import { useVuelidate } from '@vuelidate/core'
import { required, requiredIf, email, minLength} from '@vuelidate/validators'
// import { IMaskComponent } from 'vue-imask'
import { YandexMap, YandexMarker } from 'vue-yandex-maps'

export default {
  name: 'App',
  directives: { maska: vMaska },
  components: {
    // 'imask-input': IMaskComponent,
    Loader,
    SuccessMessage,
    YandexMap: YandexMap,
    YandexMarker: YandexMarker
  },
  setup() {
    return { v$: useVuelidate() }
  },
  data() {
    return {
      mapMarker: '/local/templates/mirvendinga/mockup/dist/assets/blocks/map/images/marker-2.svg',
      modal: {},
      map: null,
      mapBounds: [[0, 0], [0, 0]],
      objectManager: {},
      settings: {
        apiKey: '', // Индивидуальный ключ API
        lang: 'ru_RU', // Используемый язык
        coordorder: 'latlong', // Порядок задания географических координат
        debug: false, // Режим отладки
        version: '2.1' // Версия Я.Карт
      },
      coordinates: [55, 33],
      mapOpen: false,
      agreement: false,
      validationMessages: {
        required: 'Поле обязательно',
        email: 'Введите корректный email'
      },
      redirect: null,
      isReady: false,
      successSend: false,
      initData: {},
      storage: {},
      errorList: [],
      isLoading: {
        setup: false
      },
      personTypeOld: null,
      labels: {
        errorSystem: {
          message: 'Произошла ошибка'
        }
      },
      success: {},
      order: {
        payment: null,
        pickup: false,
        currentDelivery: {},
        profile: null,
        address: {
          legalAdress: null,
          city: null,
          floor: null,
          building: null,
          houseNumber: null,
          street: null
        },
        isCompany: false,
        company: {
          name: null,
          legalAdress: null,
          inn: null,
          kpp: null
        },
        customer: {
          email: null,
          fullName: null,
          phone: null,
        },
        delivery: {
          location: null,
          pvzName: null,
          pvzId: null,
        },
        message: null
      },
      locationList: [],
      userPhone: null,
      returnedUserPhone: false,
      defaultLocation: null,
      selectedSuggest: 0,
      phoneMask: '+#(###) ###-##-##'
    }
  },
  validations() {
    return {
      order: {
        customer: {
          email: { required, email },
          fullName: { required },
          phone: {
            required,
            minLength: minLength(17)
          },
        },
        company: {
          name: {
            required: requiredIf(this.order.isCompany)
          },
          legalAdress: {
            required: requiredIf(this.order.isCompany)
          },
          inn: {
            required: requiredIf(this.order.isCompany)
          }
        }
      }
    }
  },
  computed: {
    mapCoordinates() {
      return this.mapBounds[0] || [0, 0];
    },
    mapMarkers() {
      let result = [];
      this.pickupPoints.map((marker) => {
        result.push(this.reverseCoordinates(marker.coordinates));
      });
      return result;
    },
    locationSuggestions() {
      let result = this.locationList;
      return result.splice(0, 5);
    },
    isDevMode() {
      return process.env.VUE_APP_MODE === 'development'
    },

    orderData() {
      let result = {};

      return result;
    },

    orderItems() {
      let result = [];

      if (typeof this.initData.order !== 'undefined') {
        result = this.initData.order.items || [];
      }

      return result;
    },

    numberOfItems() {
      return this.orderItems.length
    },

    orderTotal() {
      let result = [];

      if (typeof this.initData.order !== 'undefined') {
        result = this.initData.order.total || [];
      }

      return result;
    },

    payment() {
      return this.initData.payment || {};
    },

    defaultPaySystem() {
      return this.payment.defaultPaySystem || null;
    },

    payments() {
      return this.payment.paySystems || [];
    },

    delivery() {
      return this.initData.delivery || {};
    },

    defaultDelivery() {
      return this.delivery.defaultDelivery || null;
    },

    deliveries() {
      return this.delivery.deliveries || [];
    },

    currentDelivery() {
      return this.order.currentDelivery || {};
    },

    isPickup() {
      return this.currentDelivery.isPickUp || false;
    },

    pickupPoints() {
      return this.currentDelivery.pickUpPoints || [];
    },

    profiles() {
      let result = [];

      result = this.initData.profiles || [];

      return result;
    },

    isAuth() {
      return this.initData.auth || false;
    },

    authMessage() {
      return this.initData.authMessage || '';
    },

    personType() {
        let type = null;

        if (typeof this.initData !== 'undefined') {
            const types = this.initData.personTypes || {};

            if (this.order.isCompany) {
                type = types.isCompany;
            } else {
                type = types.isNotCompany;
            }
        }

        return type;
      },

    propMatching() {
        let result = {};

        if (typeof this.initData !== 'undefined') {
            if (typeof this.initData.properties !== 'undefined') {
                result = this.initData.properties[this.personType] || {};
            }
        }

        return result;
    },

    orderProps() {
        let result = {};

        if (Object.keys(this.propMatching).length) {
            Object.keys(this.propMatching).map(key => {
                const group = this.propMatching[key];

              Object.keys(group).map(field => {
                const id = group[field];
                result['ORDER_PROP_' + id] = null;

                if (typeof this.order[key] !== 'undefined') {
                  if (typeof this.order[key][field] !== 'undefined') {
                    result['ORDER_PROP_' + id] = this.order[key][field];
                  }
                }

                if (this.order.pickup && key === 'address') {
                  delete (result['ORDER_PROP_' + id]);
                }
              });
            });
        }

        result['ORDER_DESCRIPTION'] = this.order.message || '';

        result['PERSON_TYPE'] = this.personType;
        result['PERSON_TYPE_OLD'] = this.personTypeOld;

        result['DELIVERY_ID'] = this.currentDelivery.id || null;
        result['PAY_SYSTEM_ID'] = this.order.payment || null;
        result['PROFILE_ID'] = this.order.profile || null;

        return result;
    }
  },
  watch: {
    selectedSuggest(value) {
      console.log('selectedSuggest', value)
    },
    mapOpen() {
      this.setBounds();
    }
  },
  mounted() {
    new Promise((resolve, reject) => {
      this.setLoader('setup', true);
      this.loadInitData().then((result) => {
        if (typeof result.redirect !== 'undefined') this.redirect = result.redirect;
        this.parseSetups(result);
      }).catch((result) => {
        if (typeof result.data !== 'undefined') {
          if (typeof result.data.ajaxRejectData !== 'undefined') {
            if (typeof result.data.ajaxRejectData.redirect !== 'undefined') this.redirect = result.data.ajaxRejectData.redirect;
          }
        }
        reject();
      }).finally(() => {
        resolve();
      });
    })
    .then(() => {
      if (this.redirect) window.location.href = this.redirect;
      return new Promise((resolve) => {
        this.setDefaultValues();
        resolve();
      });
    }).then(() => {
      return new Promise((resolve) => {
        this.setProfile();
        resolve();
      });
    }).then(() => {
      return new Promise((resolve) => {
        resolve();
      });
    }).then(() => {
      return new Promise((resolve) => {
        resolve();
      });
    }).finally(() => {
      if (this.orderItems.length === 0 && !this.isDevMode) location.href = '/';

      this.isReady = true;
      this.setPvz();
      this.setLoader('setup', false);
    });

    // this.loadInitData();
  },
  methods: {
    reverseCoordinates(coordinates = [0, 0]) {
      return coordinates.reverse();
    },
    setPvz() {
      if (this.isPickup && this.pickupPoints.length === 1) {
        this.changePvz(this.pickupPoints[0]);
      }
    },
    refresh() {
      this.setLoader('setup', true);
      this.refreshData().then((result) => {
        console.log('refreshData', result);
        if (typeof result.redirect !== 'undefined') this.redirect = result.redirect;
        this.parseSetups(result, true);
      }).catch((result) => {
        console.log('refresh catch', result);
      }).finally(() => {
        this.setLoader('setup', false);
      });
    },
    showSchedule(point) {
      console.log(point)
      this.modal = point;
      this.showModal();
    },
    showModal() {
      console.log('showModal');
      document.querySelector('body').classList.add('page__body_store-detail_open');
    },
    closeModal() {
      console.log('closeModal');
      document.querySelector('body').classList.remove('page__body_store-detail_open');
    },
    setBounds() {
      setTimeout(() => {
        this.mapBounds = this.map.getBounds();
        this.map.setBounds(this.map.geoObjects.getBounds(), { checkZoomRange: true, zoomMargin: 100 });
      }, 200);
    },
    async initMap(map) {
      this.map = map;
      this.mapBounds = this.map.getBounds();

      setTimeout(() => {
        this.setBounds();
      }, 500);
    },
    onAcceptUnmasked(value) {
      this.order.customer.phone = value.length > 1 ? value : null;
    },
    getErrorMessage(key) {
      return this.validationMessages[key] || '';
    },
    setLocation(item = {}) {
      console.log(item)
      if (typeof item.id !== 'undefined' && typeof window.selectCity !== 'undefined') {
        window.selectCity(item.id)
      }
      /*if (typeof item.name !== 'undefined') {
        this.order.address.city = item.name;
        this.order.delivery.location = item.id || this.order.delivery.location;
        this.locationList = [];
        this.refresh();
      }*/
    },
    locationInput(e) {
      let query = e.target.value || null;

      if (query) {
        query = query.trim();
        if (query.length) {
          getLocationSuggestions({
            query: query
          }).then((result) => {
            if (typeof result.data !== 'undefined') {
              this.locationList = result.data.list || [];
            }
          });
        }
      } else {
        this.locationList = [];
      }
    },
    locationFocusout() {
      setTimeout(() => {
        this.locationList = [];
      }, 300);
    },
    // Возвращает правильное окончание слова товар
    getItemMorph(int, array) {
      return (array = array || ['товар', 'товара', 'товаров']) && array[(int % 100 > 4 && int % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][(int % 10 < 5) ? int % 10 : 5]];
    },
    // Создает ошибку
    createError(error = {}, isFatal = false) {
      if (typeof error.message === 'undefined') error.message = this.labels.errorSystem.message;

      // Некритичные ошибки собираем
      this.errorList.push(error);

      // Если создали критичную то останавливаем все
      if (isFatal) {
        this.fatalError = true;
        throw new Error(error.message, { cause: error });
      }
    },

    // Включает или выключает определенный лоадер
    setLoader(type, value) {
      if (typeof type !== 'undefined' && typeof this.isLoading[type] !== 'undefined') {
        this.isLoading[type] = !!value;
      }
    },

    // Загружает начальные данные
    loadInitData() {
        this.setLoader('setup', true);

        return this.getInitData();
    },

    // Получает начальные даныне
    getInitData() {
      return this.dataRequest();
    },

    // Получает начальные даныне
    refreshData() {
      return this.dataRequest('refresh', this.orderProps);
    },

    // Отправляет заказ
    sendOrder() {
      return this.dataRequest('order', this.orderProps);
    },

    // Отправляет запрос API
    dataRequest(type = 'init', params = {}) {
      this.errorList = [];

      if (type === 'init') {
        return getInitData(params, 'success');
      }
      if (type === 'order') {
        return sendOrderRequest(params);
      }
      if (type === 'refresh') {
        return refresh(params);
      }
    },

    changeDelivery(delivery) {
      this.order.currentDelivery = delivery || {};
      this.refresh();
      this.setPvz();
    },

    changePvz(point) {
      this.order.delivery.pvzId = point.id || null;
      this.order.delivery.location = point.location || this.order.delivery.location;
      this.order.delivery.pvzName = point.address || null;
      this.refresh();
    },

    // Отключает отправку форму
    preventForm() {
      // Do Nothing
    },

    // Отправляет заказ
    createOrder() {
      this.v$.$touch();

      if (!this.v$.$invalid) {
        this.setLoader('setup', true);

        this.sendOrder().then((result) => {
          if (typeof result.data.order !== 'undefined' && 'undefined') {
            this.success = result.data;
            this.successSend = true;
          } else {
            this.createError();
          }
          // Ошибки
          if (result.errors.length) {
            this.errorList = result.errors;
          }
        }).catch(() => {
          this.createError({}, true);
          // Ошибки
        }).finally(() => {
          this.setLoader('setup', false);
        });
      }
    },

    parseSetups(data, refresh = false) {
      if (typeof data.data !== 'undefined') {
        this.initData = data.data;
        if (typeof this.initData.defaultProfile !== 'undefined') this.order.profile = this.initData.defaultProfile;
        if (typeof this.initData.mapMarker !== 'undefined') this.mapMarker = this.initData.mapMarker || this.mapMarker;
        if (!this.order.delivery.location && typeof this.initData.defaultLocation !== 'undefined') {
          console.log('Локация по умолчанию', refresh)
          this.order.delivery.location = this.initData.defaultLocation.id || null;
        }
        if (typeof this.initData.defaultLocation !== 'undefined') this.defaultLocation = this.initData.defaultLocation;
      }

      const currentRegion = this.defaultLocation || window.currentRegion || {};
      this.order.address.city = currentRegion.NAME || currentRegion.name || this.order.address.city;
      console.log('this.order.address.city', this.order.address.city);
      console.log('window.currentRegion', currentRegion);
    },

    setDefaultValues() {
      if (this.defaultDelivery) {
        this.deliveries.map(delivery => {
          if (delivery.id === this.defaultDelivery) {
            this.order.currentDelivery = delivery;
          }
        });
      }
      if (this.defaultPaySystem) {
        this.order.payment = this.defaultPaySystem;
      }
      // ПВЗ
      /*if (!this.order.delivery.pvzId && typeof this.pickupPoints[0] !== 'undefined') {
        this.order.delivery.pvzId = this.pickupPoints[0].id || null;
        this.order.delivery.pvzName = this.pickupPoints[0].address || null;
      }*/
      // Payment
      /*if (!this.order.payment && typeof this.payments[0] !== 'undefined') {
        this.order.payment = this.payments[0].id || null;
      }*/
    },

    setProfile() {
      let currentProfile = {};

      if (typeof this.order.profile !== 'undefined') {
        this.profiles.map(profile => {
          if(profile.id === this.order.profile) currentProfile = profile;
        });
      }

      if (Object.keys(currentProfile).length === 0) {
        if(typeof this.profiles[0] !== 'undefined') currentProfile = this.profiles[0];
        if(typeof currentProfile.id !== 'undefined') this.order.profile = currentProfile.id;
      }

      if (typeof currentProfile !== 'undefined' && Object.keys(currentProfile).length) {
        if (typeof currentProfile.customer !== 'undefined') this.order.customer = currentProfile.customer;
        if (typeof currentProfile.address !== 'undefined') this.order.address = currentProfile.address;
        if (typeof currentProfile.isCompany !== 'undefined') this.order.isCompany = currentProfile.isCompany;
        if (typeof currentProfile.company !== 'undefined') this.order.company = currentProfile.company;
        if (typeof currentProfile.pickup !== 'undefined') this.order.pickup = currentProfile.pickup;
        // if (typeof currentProfile.delivery !== 'undefined') this.order.deliveryId = currentProfile.delivery;
        if (typeof currentProfile.payment !== 'undefined') this.order.payment = currentProfile.payment;
        if (typeof currentProfile.isCompany !== 'undefined') {
            if (typeof this.initData !== 'undefined') {
                const types = this.initData.personTypes || {};

                if (currentProfile.isCompany) {
                    this.personTypeOld = types.isCompany;
                } else {
                    this.personTypeOld = types.isNotCompany;
                }
            }
        }
      }

      const mask = new Mask({ mask: this.phoneMask });
      this.order.customer.phone = mask.masked(this.order.customer.phone);
      this.v$.order.customer.phone.$touch();
      // console.log('this.order.customer.phone', this.order.customer.phone)

      // this.userPhone = this.order.customer.phone;
    },
    itemSelected(item) {
      this.item = item;
    },
    setLabel(item) {
      return item.name;
    },
    inputChange(text) {
      // your search method
      this.items = this.items.filter((item) => item.name.indexOf(text) > -1);
      // now `items` will be showed in the suggestion list
    },
    prevSuggest() {
      this.selectedSuggest--
      if (this.selectedSuggest < 0) {
        this.selectedSuggest = this.locationSuggestions.length - 1
      }
    },
    nextSuggest() {
      this.selectedSuggest++
      if (this.selectedSuggest > this.locationSuggestions.length - 1) {
        this.selectedSuggest = 0
      }
    },
    selectSuggest() {
      const location = this.locationSuggestions[this.selectedSuggest]
      console.log(location, this.selectedSuggest, this.locationSuggestions)
      this.setLocation(location)
    }
  }
}
</script>

<style src='./assets/styles.css'>

</style>
