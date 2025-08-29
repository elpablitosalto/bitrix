<template>
	<!-- begin .form-control-->
	<div class="form-control">
			<label class="form-control__holder">
					<span class="form-control__field">
							<span class="form-control__file form-control__file_offset_l">
									<!-- begin .file-input-->
									<span class="file-input">
											<span class="file-input__panel">
													<!-- begin .file-panel-->
													<span class="file-panel file-panel_type_borderless">
															<label class="file-panel__wrapper">
																	<input
																		type="file"
																		class="file-panel__input"
																		:class="{
																			'file-panel__input_state_has-files': fileName
																		}"
																		:accept="acceptStr"
																		@change.prevent="fileChange"
																	>
																	<span class="file-panel__content">
																			<span class="file-panel__label">{{ fileName }}</span>
																	</span>
																	<span class="file-panel__note">Вы можете загрузить свой дизайн. Допустимые форматы: {{ extensionStr }}</span>
																	<span class="file-panel__control">
																			<!-- begin .button-->
																			<span class="button button_width_full button_size_s button_style_outline">
																					<span class="button__holder">
																							<svg class="button__icon" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																									<path d="M21.94 11.0499L12.75 20.2399C11.6241 21.3658 10.0972 21.9983 8.50498 21.9983C6.9128 21.9983 5.38583 21.3658 4.25998 20.2399C3.13414 19.1141 2.50165 17.5871 2.50165 15.9949C2.50165 14.4027 3.13414 12.8758 4.25998 11.7499L13.45 2.55992C14.2005 1.80936 15.2185 1.3877 16.28 1.3877C17.3414 1.3877 18.3594 1.80936 19.11 2.55992C19.8605 3.31048 20.2822 4.32846 20.2822 5.38992C20.2822 6.45138 19.8605 7.46936 19.11 8.21992L9.90998 17.4099C9.5347 17.7852 9.02571 17.996 8.49498 17.996C7.96426 17.996 7.45527 17.7852 7.07998 17.4099C6.7047 17.0346 6.49387 16.5256 6.49387 15.9949C6.49387 15.4642 6.7047 14.9552 7.07998 14.5799L15.57 6.09992" fill="transparent" stroke="currentColor" stroke-width="2" stroke-linecap="square"></path>
																							</svg>
																							<span class="button__text">
																									Прикрепить файл
																							</span>
																					</span>
																			</span>
																			<!-- end .button-->
																	</span>
															</label>
													</span>
													<!-- end .file-panel-->
											</span>
									</span>
									<!-- end .file-input-->
							</span>
					</span>
					<span
						class="form-control__messages"
						v-if="hasError"
					>
							<span class="form-control__message form-control__message_style_error">
									Недопустимый формат файла
							</span>
					</span>
			</label>
	</div>
	<!-- end .form-control-->
</template>

<script>
	import { vMaska } from "maska"
	export default {
			name: 'FormFile',
			components: {},
			directives: {maska: vMaska},
			emits: ['selectFile'],
			props: {
				label: {
					type: String,
					default() {
						return ''
					}
				},
				allowMimeTypes: {
					type: Array,
					default() {
						return []
					}
				},
				modelValue: {
					type: Object,
					default() {
						return {}
					}
				},
			},
			data() {
				return {
					file: {}
				}
			},
			computed: {
				fileName() {
					let result = '';

					if (typeof this.file.name !== 'undefined') {
						result = this.file.name;
					}

					return result;
				},
				fileType() {
					let result = '';

					if (typeof this.file.type !== 'undefined') {
						result = this.file.type;
					}

					return result;
				},
				fileExtensions() {
					let result = [];

					this.allowMimeTypes.map(mimeType => {
						const extension = mimeType.slice(mimeType.indexOf('/') + 1);
						result.push('.' + extension);
					})

					return result;
				},
				hasError() {
					if (this.fileType && this.allowMimeTypes.indexOf(this.fileType) < 0) {
						return true;
					} else {
						return false;
					}
				},
				acceptStr() {
					return this.fileExtensions.join(',');
				},
				extensionStr() {
					return this.acceptStr.replaceAll('.', ' ');
				}
			},
			watch: {
				file(file) {
					if(!this.hasError) this.$emit('selectFile', file);
				},
				modelValue(value) {
					if (value == null) {
						this.file = {};
					}
				}
			},
			mounted() {},
			methods: {
				fileChange(e) {
					const files = e.target.files || e.dataTransfer.files;

					if (files.length) {
						this.file = files[0];
					} else {
						this.file = {};
					}
				}
			}
	}
</script>