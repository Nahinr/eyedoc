<template>
  <FullCalendar :options="calendarOptions" />
  <button @click="openEventForm">Crear Cita</button>
  <div>
    <!-- Formulario/modal de creación de eventos -->
    <div v-if="showEventForm">
      <label for="patient">Paciente:</label>
      <select v-model="selectedPatient">
        <!-- Llena la lista de pacientes desde tu backend -->
        <option v-for="patient in patients" :key="patient.id" :value="patient.id">{{ patient.nombre_completo }}</option>
      </select>

      <label for="title">Título:</label>
      <input v-model="eventTitle" type="text" placeholder="Título del evento">

      <label for="description">Descripción:</label>
      <textarea v-model="eventDescription" placeholder="Descripción del evento"></textarea>

      <label for="date">Inicio</label>
      <input v-model="eventStartDate" type="datetime-local">

      <label for="date">Fin</label>
      <input v-model="eventEndDate" type="datetime-local">
     

      <!-- Otros campos del formulario -->

      <button @click="createEvent">Crear Evento</button>
    </div>
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';

export default {
  components: {
    FullCalendar,
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin,timeGridPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
          right: 'prev,next today',
          center: 'title',
          left: 'dayGridYear,dayGridMonth,timeGridWeek,timeGridDay',
        },
        locale : esLocale,
        events: this.fetchEvents,
        selectable: true,
      },
      showEventForm: false,
      selectedPatient: null,
      eventTitle: '',
      patients: [],
    };
  },

  mounted(){
    this.fetchPatients();
  },
  methods: {

    fetchPatients() {
      axios.get('/patients')
        .then(response => {
          console.log('Respuesta de pacientes:', response.data);
          this.patients = response.data;
        })
        .catch(error => {
          console.error('Error al obtener los pacientes:', error);
        });
    },

    openEventForm() {
      this.showEventForm = true;
    },
    createEvent() {
      console.log('Crear evento', this.selectedPatient, this.eventTitle);
  
        // Debes enviar esta información al backend para guardarla en la base de datos
        axios.post('/appointments/create', {
          patient_id: this.selectedPatient,
          title: this.eventTitle,
          description: this.eventDescription,
          start: new Date(this.eventStartDate).toISOString(),
          end: new Date(this.eventEndDate).toISOString(),
        })
        .then(response => {
          console.log('Evento creado con éxito:', response.data);
          this.showEventForm = false; // Cerrar el formulario después de crear el evento
        })
        .catch(error => {
          console.error('Error al crear el evento:', error);
        });
   },
    fetchEvents() {
      // Lógica para obtener las citas del backend
    },
  },
};
</script>
