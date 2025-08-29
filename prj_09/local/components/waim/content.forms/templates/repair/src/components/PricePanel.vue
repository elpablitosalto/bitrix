<template>
	<!-- begin .price-panel-->
	<div class="price-panel">
			<div class="price-panel__content">
					<div class="price-panel__title">
							Предварительная стоимость ремонта
					</div>
					<div class="price-panel__text">
							Для уточнения стоимости и оформления заявки нажмите кнопку
							“Отправить”
					</div>
			</div>
			<div
				class="price-panel__price"
				v-html="formatPrice(totalPriceValue, 'руб', 'от')"
			/>
	</div>
	<!-- end .price-panel-->
</template>

<script>
export default {
	name: 'PricePanel',
	components: {},
	emits: ['update:modelValue'],
	props: {
		totalPriceValue: {
			type: Number,
			default() {
				return 0
			}
		}
	},
	data() {
		return {}
	},
	computed: {},
	watch: {},
	mounted() {},
	methods: {}
}
</script>