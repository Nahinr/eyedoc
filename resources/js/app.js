import './bootstrap';
import { createApp } from 'vue';
import Calendar from './components/Calendar.vue';
import  {VueFinalModal}  from 'vue-final-modal';
import axios from 'axios';


const app =createApp({
    components: {
        Calendar
    },
});

app.use(VueFinalModal);
app.mount('#app');

