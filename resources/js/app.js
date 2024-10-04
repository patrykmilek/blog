import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import DashboardButtons from './components/DashboardButtons.vue';

const app = createApp({});
app.component('example-component', ExampleComponent);
app.component('dashboard-buttons', DashboardButtons);
app.mount('#app');
