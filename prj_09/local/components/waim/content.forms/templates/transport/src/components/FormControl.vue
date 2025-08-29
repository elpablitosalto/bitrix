<template>
		<!-- begin .form-control-->
		<div class="form-control">
				<label class="form-control__holder">
						<span class="form-control__label">
							{{ label }}<template v-if="required">*</template>
						</span>
						<span class="form-control__field">
							<template
								v-if="type === 'text'"
							>
								<!-- Modifiers-->
								<!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
								<input
									v-if="mask"
									type="text"
									class="form-control__input"
									:class="{
										'form-control__input_state_invalid': error
									}"
									v-model="currentValue"
									v-maska
									:data-maska="mask"
									:placeholder="placeholder"
								/>

								<input
									v-else
									type="text"
									class="form-control__input 123"
									:class="{
										'form-control__input_state_invalid': error
									}"
									:placeholder="placeholder"
									v-model="currentValue"
								/>
							</template>
							<template
								v-if="type === 'textarea'"
							>
								<textarea
									class="form-control__textarea"
									:class="{
										'form-control__textarea_state_invalid': error
									}"
									v-model="currentValue"
									:placeholder="placeholder"
								></textarea>
							</template>
						</span>
						<span class="form-control__messages">
								<span style="display: none"
										class="form-control__message form-control__message_style_error">
										Ошибка поля
								</span>
						</span>
				</label>
		</div>
		<!-- end .form-control-->
</template>

<script>
	import { vMaska } from "maska"
	export default {
			name: 'FormControl',
			components: {},
			directives: {maska: vMaska},
			emits: ['update:modelValue'],
			props: {
				label: {
					type: String,
					default() {
						return ''
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
				},
				required: {
					type: Boolean,
					default() {
						return false
					}
				},
				mask: {
					type: String,
					default() {
						return null
					}
				},
				placeholder: {
					type: String,
					default() {
						return null
					}
				},
				type: {
					type: String,
					default() {
						return 'text'
					}
				},
			},
			data() {
				return {
					currentValue: null
				}
			},
			computed: {},
			watch: {
				currentValue(newValue) {
					this.$emit('update:modelValue', newValue);
				},
				modelValue(newValue) {
					this.currentValue = newValue;
				},
			},
			mounted() {
				this.currentValue = this.modelValue;
			},
			methods: {}
	}
</script>