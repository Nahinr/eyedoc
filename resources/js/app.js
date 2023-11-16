import './bootstrap';
import { createApp } from 'vue';
import Calendar from './components/Calendar.vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';


createApp({
    components: {
        Calendar
    },
}).mount('#app');