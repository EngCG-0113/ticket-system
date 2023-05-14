import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const app = new Vue({
  el: '#app',
  components: {
    ExampleComponent
  }
});
