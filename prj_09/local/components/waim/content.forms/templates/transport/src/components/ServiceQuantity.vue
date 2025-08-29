<template>
	<!-- begin .form-control-->
	<!--  -->
	<div
		class="form-control"
		:class="{
			'form-control_state_force-disabled': disabled
		}"
	>
		<div class="form-control__holder">
			<span class="form-control__label">{{ label }}</span>
			<span class="form-control__quantity-input">
					<!-- begin .quantity-input-->
					<span class="quantity-input quantity-input_width_standard quantity-input_size_m">
							<span class="quantity-input__wrapper js-quantity-container">
									<span class="quantity-input__control">
											<button
												type="button"
												class="quantity-input__button quantity-input__button_type_decrease"
												:disabled="quantity == 0"
												@click="quantity--"
											>
												Убавить
											</button>
									</span>
									<span class="quantity-input__field">
											<input
												type="number"
												class="quantity-input__input"
												v-model="quantity"
											>
									</span>
									<span class="quantity-input__control">
											<button
												type="button"
												class="quantity-input__button quantity-input__button_type_increase"
												@click="quantity++"
											>
												Добавить
											</button>
									</span>
							</span>
							<span
								class="quantity-input__note"
								v-if="quantity >= 0"
							>
									Дополнительный автомат + 1000 рублей
							</span>
					</span>
					<!-- end .quantity-input-->
			</span>
			<span class="form-control__messages">
					<span style="display: none" class="form-control__message form-control__message_style_error">
							Ошибка поля
					</span>
			</span>
		</div>
	</div>
	<!-- end .form-control-->
</template>

<script>
export default {
	name: 'ServiceQuantity',
	components: {},
	emits: ['selected', 'unselected'],
	props: {
		label: {
			type: String,
			default() {
				return ''
			}
		},
		service: {
			type: Object,
			default() {
				return {}
			}
		},
		disabled: {
			type: Boolean,
			default() {
				return false
			}
		}
	},
	data() {
		return {
			quantity: 0
		}
	},
	computed: {
		result() {
			let result = {
				quantity: this.quantity,
				cost: parseFloat(this.service.cost) || 0
			};

			return result;
		},
	},
	watch: {
		disabled(isDisabled) {
			this.quantity = isDisabled ? 0 : 0;
		},
		result(result) {
			if (result.quantity > 0) {
				this.$emit('selected', result);
			} else {
				this.$emit('unselected', result);
			}
		}
	},
	mounted() { },
	methods: {}
}
</script>