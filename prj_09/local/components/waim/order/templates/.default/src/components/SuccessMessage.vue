<template>
   <div class="content-panel content-panel_type_status-message" v-if="fields">
        <div class="content-panel__header">
            <div class="content-panel__title">
                <!-- begin .title-->
                <h1 class="title title_size_h1">{{ fields.order.title }}</h1>
                <!-- end .title-->
            </div>
        </div>
        <div class="content-panel__section">
            <div class="content-panel__status-illust">
                <picture class="content-panel__picture">
                    <img src="/local/templates/mirvendinga/mockup/dist/assets/blocks/content-panel/images/check.svg" data-src="assets/blocks/content-panel/images/check.svg" width="100" height="100" alt="Успех!" class="content-panel__image lazyload lazyload_entered lazyload_loaded" title="" data-ll-status="loaded">
                </picture>
            </div>
            <div class="content-panel__text" v-html="fields.order.message" />
        </div>
        <div class="content-panel__section" v-if=fields.payment>
            <div class="content-panel__subtitle">
                <!-- begin .title-->
                <h2 class="title title_size_h3">{{ fields.payment.title }}</h2>
                <!-- end .title-->
            </div>
            <div class="content-panel__text"><b v-html=fields.payment.info /></div>
            <div class="content-panel__text" v-html=fields.payment.message />
            <div class="content-panel__link-group">
                <div class="content-panel__link-item" v-if-fields.payment.check>
                    <!-- begin .link-item-->
                    <a class="link-item link-item_icon-size_m link-item_style_primary" :href=fields.payment.check.url>
                        <span class="link-item__icon-wrapper">
                            <svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.99967 13.3333L5.83301 9.16668L6.99967 7.95834L9.16634 10.125V3.33334H10.833V10.125L12.9997 7.95834L14.1663 9.16668L9.99967 13.3333ZM3.33301 16.6667V12.5H4.99967V15H14.9997V12.5H16.6663V16.6667H3.33301Z"></path>
                            </svg>
                        </span>
                        <span class="link-item__label">{{ href=fields.payment.check.text }}</span>
                    </a>
                    <!-- end .link-item-->
                </div>
            </div>
        </div>
        <div class="content-panel__controls" v-if=fields.nextLink>
            <div class="content-panel__control">
                <!-- begin .button-->
                <a class="button button_width_full button_size_s button_style_outline" :href=fields.nextLink.url>
                    <span class="button__holder">{{ fields.nextLink.text }}</span>
                </a>
                <!-- end .button-->
            </div>
        </div>
    </div>
</template>

<script>

import 'swiper/css';

export default {
    name: 'SuccessMessage',
    components: {},
    props: {
        fields: Object,
    },
    data() {
        return {
        }
    },
    watch: {
    },
    mounted() {
        let evt = new CustomEvent('order_success', { detail: {} });
        document.dispatchEvent(evt);
    },
    methods: {
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
