<template>
  <FullCalendar :options="calendarOptions" />
  <!-- <button @click="openEventForm">Crear Cita</button> -->
  <div>
    <!-- <div v-if="showEventForm"> -->
      <div class="modal-container" :class="{ 'show': isModalVisible }">
        <vue-final-modal name="event-form-modal">

            <label for="patient">Paciente:</label>
            <select v-model="selectedPatient">
              <!-- Llena la lista de pacientes desde tu backend -->
              <option v-for="patient in patients" :key="patient.id" :value="patient.id">{{ patient.nombre_completo }}</option>
            </select>

            <label for="title">Título:</label>
            <input v-model="eventTitle" type="text" placeholder="Título">

            <label for="description">Descripción:</label>
            <textarea v-model="eventDescription" placeholder="Descripción"></textarea>

            <label for="date">Inicio</label>
            <input v-model="eventStartDate" type="datetime-local">

            <label for="date">Fin</label>
            <input v-model="eventEndDate" type="datetime-local">

            <button @click="createEvent">Crear Evento</button>
            <button @click="closeModal">Cerrar</button>

        </vue-final-modal>
    </div>
   </div>    
  <!-- </div> -->
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
      isModalVisible: false
    };
  },

  mounted(){
    this.fetchPatients();
    this.calendarOptions.dateClick = this.handleDateClick;
  },
  methods: {   
    handleDateClick() {
      this.selectedPatient = null;
      this.eventTitle = '';
      this.eventDescription = '';
      this.eventStartDate = '';
      this.eventEndDate = '';
      // this.showEventForm = true;

      this.isModalVisible= true;
    },

    fetchPatients() {
      axios.get('/patientsIndex')
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
          this.isModalVisible = false;
        })
        .catch(error => {
          console.error('Error al crear el evento:', error);
        });
   },
    fetchEvents() {
  
    },
    closeModal() {
      this.isModalVisible = false;
    }
  },
};
</script>

<style>
  .modal-container {
  position: fixed; /* O ajusta según sea necesario */
  top: 50%; /* Ajusta según sea necesario */
  left: 50%; /* Ajusta según sea necesario */
  transform: translate(-50%, -50%); /* Centra el modal */
  z-index: 9999; /* Ajusta aquí sea necesario */
  display: none;
  }

  .modal-container.show {
  display: block;
  }
</style>
