<template>
	<!-- begin .radio-panels-->
	<span class="radio-panels radio-panels_layout_auto radio-panels_type_classic">
		<span class="radio-panels__items">
			<span
				class="radio-panels__item"
				v-for="item, i in items"
				:key="i"
			>
				<label class="radio-panels__label">
					<input
						class="radio-panels__input"
						:class="{
							'radio-panels__input_state_invalid': error
						}"
						type="radio"
						:value="i"
						v-model="value"
					>
					<span class="radio-panels__panel">{{ item }}</span>
				</label>
			</span>
		</span>
	</span>
	<!-- end .radio-panels-->
</template>

<script>
export default {
	name: 'RadioPanel',
	components: {},
	emits: ['update:modelValue'],
	props: {
		items: {
			type: Object,
			default() {
				return {}
			}
		},
		modelValue: {
			type: String,
			default() {
				return ''
			}
		},
		error: {
			type: Boolean,
			default() {
				return false
			}
		}
	},
	data() {
		return {
			inited: false,
			value: null
		}
	},
	computed: {},
	watch: {
		value(newValue) {
			this.$emit('update:modelValue', newValue);
		},
		modelValue(newValue) {
			this.value = newValue;
		},
		items() {
			// this.setValue(this.modelValue);
		}
	},
	mounted() {},
	methods: {
		setValue(value = null) {
			if (value !== null) {
				this.value = value;
				this.inited = true;
			} else {
				if (typeof Object.values(this.items)[0] !== 'undefined') {
					this.value = Object.values(this.items)[0] || null;
				}
			}
		}
	}
}
</script>