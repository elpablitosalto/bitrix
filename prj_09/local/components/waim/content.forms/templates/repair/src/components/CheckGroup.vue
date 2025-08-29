<template>
	<div class="form-control__check-group form-control__check-group_type_padded">
		<div class="form-control__check-item">
				<!-- begin .check-elem-->
				<label class="check-elem check-elem_text-size_l">
						<input
							class="check-elem__input"
							:class="{
								'check-elem__input_state_error': error
							}"
							type="checkbox"
							@change="selectAll"
						>
						<span class="check-elem__label">
								Все
						</span>
				</label>
				<!-- end .check-elem-->
		</div>
		<div
			class="form-control__check-item"
			v-for="item, key in items"
			:key="key"
		>
			<!-- begin .check-elem-->
			<label class="check-elem check-elem_text-size_l">
					<input
						class="check-elem__input"
						:class="{
							'check-elem__input_state_error': error
						}"
						type="checkbox"
						:value="key"
						v-model="value"
					>
					<span class="check-elem__label">
							{{ item.name }}
					</span>
			</label>
			<!-- end .check-elem-->
		</div>
	</div>
</template>

<script>
export default {
	name: 'CheckGroup',
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
			type: Array,
			default() {
				return []
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
			value: []
		}
	},
	computed: {},
	watch: {
		value(newValue) {
			this.$emit('update:modelValue', newValue);
		},
		items() {
			// this.setValue(this.modelValue);
		}
	},
	mounted() {},
	methods: {
		selectAll(e) {
			if (e.target.checked) {
				this.value = Object.keys(this.items);
			} else {
				this.value = [];
			}
		},
		reset() {
			this.value = [];
		}
	}
}
</script>