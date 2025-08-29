<template>
	<!-- begin .form-control-->
	<div class="form-control">
		<div class="form-control__holder">
			<div class="form-control__check-group form-control__check-group_type_unpadded">
				<div class="form-control__check-item">
					<!-- begin .check-elem-->
					<label class="check-elem check-elem_align_top">
						<input
							class="check-elem__input"
							type="checkbox"
							:checked="value"
							@change="changeValue"
						>
						<span class="check-elem__label">{{ label }}</span>
					</label>
					<!-- end .check-elem-->
				</div>
			</div>
			<div class="form-control__messages">
				<div style="display: none" class="form-control__message form-control__message_style_error">
					Ошибка поля
				</div>
			</div>
		</div>
	</div>
	<!-- end .form-control-->
</template>

<script>
export default {
	name: 'ServiceCheckbox',
	components: {},
	emits: ['selected', 'unselected'],
	props: {
		service: {
			type: Object,
			default() {
				return {}
			}
		},
		checked: {
			type: Boolean,
			default() {
				return false
			}
		}
	},
	data() {
		return {
			inited: false,
			value: 0
		}
	},
	computed: {
		label() {
			return this.service?.name + ' ' + this.service?.desc
		},

		result() {
			let result = {
				quantity: this.value,
				cost: parseFloat(this.service.cost) || 0
			};

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
		},
		checked(isChecked) {
			if (isChecked) {
				this.value = 1
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
			this.value = 0
		},
		changeValue(e) {
			 this.value = e.target.checked ? 1 : 0;
		}
	}
}
</script>