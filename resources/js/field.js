import vSelect from 'vue-select';

Nova.booting((Vue) => {
  Vue.component('index-nova-autofill', require('./components/IndexField'));
  Vue.component('detail-nova-autofill', require('./components/DetailField'));
  Vue.component('form-nova-autofill', require('./components/FormField'));
  Vue.component('v-select', vSelect);
});
