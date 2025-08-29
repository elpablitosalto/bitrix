<template>
	<!-- begin .form-control-->
	<div class="form-control">
			<div class="form-control__holder">
					<span class="form-control__label">{{ label }}</span>
					<span class="form-control__radio-panels">
							<!-- begin .radio-panels-->
							<span class="radio-panels radio-panels_layout_auto radio-panels_type_classic">
									<span class="radio-panels__items">
											<span
												v-for="item, i in items"
												:key="i"
												class="radio-panels__item"
											>
													<label class="radio-panels__label">
															<input
																class="radio-panels__input"
																type="checkbox"
																:true-value="i"
																:false-value="null"
																v-model="value"
															>
															<span class="radio-panels__panel">{{ item.desc }}</span>
													</label>
											</span>
									</span>
							</span>
							<!-- end .radio-panels-->
					</span>
			</div>
	</div>
	<!-- end .form-control-->
</template>

<script>
export default {
	name: 'ServicePeriod',
	components: {},
	emits: ['selected', 'unselected'],
	props: {
		label: {
			type: String,
			default() {
				return ''
			}
		},
		items: {
			type: Object,
			default() {
				return {}
			}
		}
	},
	data() {
		return {
			value: null
		}
	},
	computed: {
		result() {
			let result = {
				id: this.currentService.id,
				quantity: typeof this.currentService.cost !== 'undefined' ? 1 : 0,
				cost: parseFloat(this.currentService.cost) || 0,
				serviceKey: this.value || ''
			};

			return result;
		},

		currentService() {
			let result = {};

			if (this.value !== null) {
				result = this.items[this.value];
			}

			return result;
		}
	},
	watch: {
		result(result) {
			if (result.quantity > 0) {
				this.$emit('selected', result);
			} else {
				this.$emit('unselected', result);
			}
		}
	},
	mounted() {
		document.addEventListener('resetForm', e => {
			this.reset();
		}, false);
	},
	methods: {
		reset() {
			this.value = null;
		}
	}
}
</script>