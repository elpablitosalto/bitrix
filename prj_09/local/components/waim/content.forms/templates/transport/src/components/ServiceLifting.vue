<template>
	<span
		class="address-input__details"
		:title="service.name"
	>
		<span class="address-input__detail">
			<span class="address-input__label">
				Какой этаж
			</span>
			<span class="address-input__mini-field">
				<input
					type="number"
					class="address-input__mini-input"
					:value="floors"
					@input="changeInput"
				>
			</span>
		</span>
		<span class="address-input__detail">
			<span class="address-input__label">
				Есть ступеньки/лестница
			</span>
			<span class="address-input__mini-field">
				<!-- begin .switch-->
				<label class="switch switch_size_s">
					<input class="switch__input" type="checkbox" v-model="steps">
					<span class="switch__body">
						<span class="switch__label">
							Нет
						</span>
						<span class="switch__container">
							<span class="switch__wrapper">
								<span class="switch__knob">
									&nbsp;
								</span>
							</span>
						</span>
						<span class="switch__label">
							Да
						</span>
					</span>
				</label>
				<!-- end .switch-->
			</span>
		</span>
	</span>
</template>

<script>
export default {
	name: 'ServiceLifting',
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
		}
	},
	data() {
		return {
			floors: 0,
			steps: false,
			oldFloorValue: 1,
			manualChange: false
		}
	},
	computed: {
		result() {
			let result = {
				quantity: parseInt(this.floors),
				cost: parseFloat(this.service.cost) || 0
			};

			return result;
		},
	},
	watch: {
		floors(newValue, oldValue) {
			this.oldFloorValue = oldValue;

			if (newValue <= 0) {
				this.floors = 0;
				this.steps = false;
			}
			if (newValue > 0) this.steps = true;
		},
		oldFloorValue(value) {
			if (value <= 0) {
				this.oldFloorValue = 1;
			}
		},
		steps(stepsExist) {
			if (stepsExist) {
				if (this.floors === 0) {
					this.floors = this.oldFloorValue;
				}
			} else {
				this.floors = 0;
			}
		},
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
		changeInput(e) {
			let value =  parseInt(e.target.value);

			if(isNaN(value)) {
				value = 0;
			}
			this.floors = value;
		},
		reset() {
			this.floors = 0;
			this.steps = false;
			this.oldFloorValue = 1;
		}
	}
}
</script>