export default {
	components: {},
	data() {
		return {}
	},
	beforeMount() {},
	methods: {
		/**
		 * Добавляет ноль в цифры от 0 до 9
		 */
		zeroPad(num) {
			return String(num).padStart(2, '0')
		},

		/**
		 * Возвращает слово с нужным окончаниеем в зависимости от числа
		 */
		declOfNum(n, textForms) {
			n = Math.abs(n) % 100;
			var n1 = n % 10;
			if (n > 10 && n < 20) { return textForms[2]; }
			if (n1 > 1 && n1 < 5) { return textForms[1]; }
			if (n1 == 1) { return textForms[0]; }
			return textForms[2];
		},

		/**
		 * Приводит к положительному числу переданное значение
		 */
		IDnormalization(id) {
			let result = id || null;
			result = parseInt(result);
			return !isNaN(result) && result >= 0 ? result : null;
		},

		/**
		 * Возвращает отформатированную цену
		 */
		formatPrice(value = '', unit = '') {
			return parseFloat(value).toLocaleString('ru') + "&nbsp;" + unit;
		},

	}
};
