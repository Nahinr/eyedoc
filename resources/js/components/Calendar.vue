<template>
  <div>
    <FullCalendar :options="calendarOptions"></FullCalendar>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  setup() {
    const calendarOptions = ref({
      locale: 'es',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay',
      },
      initialView: 'dayGridMonth',
      events: [
        // Aquí puedes cargar las citas desde tu API o base de datos
        // por ejemplo: { title: 'Cita 1', start: '2022-01-01' },
        // ...
      ],
      // Aquí puedes configurar más opciones y eventos según tus necesidades
    });

    return {
      calendarOptions,
    };
  },
};
</script>