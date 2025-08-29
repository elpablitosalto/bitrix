import {createStore} from 'vuex'

export const store = createStore({
	state() {
		return {
				loader: false,
				displayImages: true,
				categories: [],
				products: [],
				rootCategoryErrors: [],
				foundProducts: []
			}
	},
	getters: {
		orderInitData: state => state.orderInitData || {},
	},
	mutations: {
		setFoundProducts(state, payload) {
			console.log('setFoundProducts', payload);
			state.foundProducts = payload;
		},
		setRootCategryError(state, payload) {
			state.rootCategoryErrors.push(payload);
		},
		unsetRootCategryError(state, payload) {
			const index = state.rootCategoryErrors.indexOf(payload);
			if (index != -1) {
				state.rootCategoryErrors.splice(index, 1);
			}
		},
		setDisplayImages(state, payload) {
			state.displayImages = payload;
		},
		setLoader(state) {
			state.loader = true;
		},
		unsetLoader(state) {
			state.loader = false;
		},
		setCategories(state, payload) {
			payload.map(item => {
				if (typeof item.multiplicity === 'undefined') item.multiplicity = 0;
				if (typeof item.categories === 'undefined') item.categories = [];
				if (typeof item.hasError === 'undefined') item.hasError = false;
				if (typeof item.isOpen === 'undefined') item.isOpen = false;
			});

			state.categories = payload;
		},
		setProducts(state, payload) {
			payload.map(item => {
				if (typeof item.quantity === 'undefined') item.quantity = 0;
				if (typeof item.maxQuantity === 'undefined') item.maxQuantity = null;
				if (typeof item.sampleId === 'undefined') item.sampleId = null;
			});

			state.products = payload;
		},
		setProductProp(state, payload) {
			if (typeof payload.key !== 'undefined' && typeof payload.value !== 'undefined' && typeof payload.id !== 'undefined') {
				state.products.map(item => {
					if (typeof item[payload.key] !== 'undefined' && parseInt(item.id) === parseInt(payload.id)) {
						item[payload.key] = payload.value;
					}
				});
			}
		}
	}
});