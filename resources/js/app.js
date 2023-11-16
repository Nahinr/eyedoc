import './bootstrap';
import { createApp } from 'vue';
import { Core, daygrid, InteractionPlugin, TimeGridPlugin } from '@fullcalendar/vue3';
import '@fullcalendar/common/main.css';
import '@fullcalendar/daygrid/index.js';
import '@fullcalendar/timegrid/index.js';

const app = createApp(App);
app.use(createDayGridPlugin());
app.use(createInteractionPlugin());
app.use(createTimeGridPlugin());
app.mount('#app');