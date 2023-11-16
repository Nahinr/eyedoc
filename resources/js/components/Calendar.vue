<template>
  <FullCalendar :options="calendarOptions" />
</template>

<script>
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

export default {
  components: {
    FullCalendar,
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: this.fetchEvents, // Una función para obtener las citas del backend
        // Otras opciones del calendario
      },
    };
  },
  methods: {
    fetchEvents() {
      // Lógica para obtener las citas del backend
    },
  },
};
</script>
