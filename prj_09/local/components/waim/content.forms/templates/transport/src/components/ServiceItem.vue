<template>
	<template
		v-if="type === 'checkbox'"
	>
		<ServiceCheckbox
			:checked="checked"
			:service="service"
			@selected="onSelected"
			@unselected="onUnselected"
		/>
	</template>

	<template
		v-else-if="type === 'period'"
	>
		<ServicePeriod
			:label="label"
			:items="services"
			@selected="onSelected"
			@unselected="onUnselected"
		/>

	</template>

	<template
		v-else-if="type === 'quantity'"
	>
		<ServiceQuantity
			:label="label"
			:service="service"
			@selected="onSelected"
			@unselected="onUnselected"
			:disabled="disabled"
		/>
	</template>
	<template
		v-else-if="type === 'floor'"
	>
		<ServiceLifting
			:label="label"
			:service="service"
			@selected="onSelected"
			@unselected="onUnselected"
		/>
	</template>
</template>

<script>
import ServiceCheckbox from './ServiceCheckbox.vue'
import ServicePeriod from './ServicePeriod.vue'
import ServiceQuantity from './ServiceQuantity.vue'
import ServiceLifting from './ServiceLifting.vue'

export default {
	name: 'ServiceItem',
	components: { ServiceCheckbox, ServicePeriod, ServiceQuantity, ServiceLifting },
	emits: ['setService', 'unsetService'],
	props: {
		id: {
			type: String,
			default() {
				return ''
			}
		},
		serviceKey: {
			type: String,
			default() {
				return ''
			}
		},
		label: {
			type: String,
			default() {
				return ''
			}
		},
		type: {
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
		services: {
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
		},
	},
	data() {
		return {
			inited: false,
			value: null,
			quantity: 0,
			checked: false
		}
	},
	computed: {
		placeId() {
			return this.makeID(12)
		},
		data() {
			return {
				quantity: this.quantity,
				cost: parseFloat(this.service.cost) || 0
			}
		}
	},
	watch: {},
	mounted() {},
	methods: {
		checkedService() {
			this.checked = true;
		},
		onSelected(service) {
			service.placeId = this.id || this.placeId;
			service.id = service.id || this.service.id;
			service.serviceKey = this.serviceKey || '';
			this.$emit('setService', service);
		},
		onUnselected(service) {
			service.placeId = this.id || this.placeId;
			service.id = service.id || this.service.id;
			service.serviceKey = this.serviceKey || '';
			this.$emit('unsetService', service);
		}
	}
}
</script>