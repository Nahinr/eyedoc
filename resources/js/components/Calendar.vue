<template>
  <FullCalendar :options="calendarOptions" />
  <div class="modal-overlay" :class="{ 'show': isModalVisible }" @click="closeModal"></div>
  <div class="modal-container" :class="{ 'show': isModalVisible }">
    <div class="container mx-auto p-4">
      <div class="bg-white rounded shadow-lg p-4 md:p-8">
        <vue-final-modal name="event-form-modal">
          <div class="grid gap-4">
            <!-- Barra de búsqueda para filtrar pacientes -->
            <label for="search" class="block text-sm font-medium text-gray-700">Buscar Paciente</label>
            <input v-model="searchTerm" @input="filteredPatients" type="text" id="search" placeholder="Buscar paciente" class="w-full p-2 border border-gray-300 rounded-md">

            <!-- Mostrar el resultado de la búsqueda directamente -->
            <label for="patient" class="block text-sm font-medium text-gray-700">Paciente</label>
            <div v-if="filteredPatients.length === 0">
              <p>No se encontraron pacientes</p>
            </div>
            <div v-else>
              <input v-model="selectedPatient.nombre_completo" type="text" id="patient" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Paciente" @change ="selectPatient(filteredPatients[0])">
            </div>

            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
            <input v-model="eventTitle" type="text" placeholder="Título" class="w-full p-2 border border-gray-300 rounded-md">

            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea v-model="eventDescription" placeholder="Descripción" class="w-full p-2 border border-gray-300 rounded-md"></textarea>

            <label for="date" class="block text-sm font-medium text-gray-700">Inicio</label>
            <input v-model="eventStartDate" type="datetime-local" class="w-full p-2 border border-gray-300 rounded-md">

            <label for="date" class="block text-sm font-medium text-gray-700">Fin</label>
            <input v-model="eventEndDate" type="datetime-local" class="w-full p-2 border border-gray-300 rounded-md">

            <div class="flex justify-end space-x-4">
              <button @click="createEvent" class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                Crear Cita
              </button>
              <button @click="closeModal" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">
                Cerrar
              </button>
            </div>
          </div>
        </vue-final-modal>
      </div>
    </div>
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import esLocale from "@fullcalendar/core/locales/es";
import axios from "axios";

export default {
  components: {
    FullCalendar,
  },

  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
        initialView: "dayGridMonth",
        headerToolbar: {
          right: "prev,next today",
          center: "title",
          left: "dayGridYear,dayGridMonth,timeGridWeek,timeGridDay",
        },
        locale: esLocale,
        events: this.fetchEvents,
        selectable: true,
      },
      showEventForm: false,
      selectedPatient: {
        id: "",
        nombre_completo: "",
      },
      eventTitle: "",
      patients: [],
      isModalVisible: false,
      searchTerm: "",
    };
  },

  computed: {
    filteredPatients() {
      return this.patients.filter((patient) =>
        patient.nombre_completo.toLowerCase().includes(this.searchTerm.toLowerCase())
      );
    },
  },

  mounted() {
    this.fetchPatients();
    this.calendarOptions.dateClick = this.handleDateClick;
  },

  methods: {
    handleDateClick() {
      this.selectedPatient = { id: "", nombre_completo: "" };
      this.eventTitle = "";
      this.eventDescription = "";
      this.eventStartDate = "";
      this.eventEndDate = "";
      this.isModalVisible = true;
    },

    fetchPatients() {
      axios
        .get("/patientsIndex")
        .then((response) => {
          console.log("Respuesta de pacientes:", response.data);
          this.patients = response.data;
        })
        .catch((error) => {
          console.error("Error al obtener los pacientes:", error);
        });
    },

    createEvent() {
      if (!this.selectedPatient.id) {
        // Puedes mostrar un mensaje de error o realizar alguna acción específica
        console.error("Por favor, selecciona un paciente antes de crear el evento.");
        return;
      }
      axios
        .post("/appointments/create", {
          patient_id: this.selectedPatient.id,
          title: this.eventTitle,
          description: this.eventDescription,
          start: new Date(this.eventStartDate).toISOString(),
          end: new Date(this.eventEndDate).toISOString(),
        })
        .then((response) => {
          console.log("Evento creado con éxito:", response.data);
          this.isModalVisible = false;
          this.fetchEvents();
        })
        .catch((error) => {
          console.error("Error al crear el evento:", error);
        });
    },

    fetchEvents() {
      axios
        .get("/appointments/show")
        .then((response) => {
          const events = response.data;

          // Actualiza los eventos del calendario
          this.calendarOptions.events = events;

          // También puedes intentar recargar el calendario después de obtener los eventos
          this.$refs.calendarRef.getApi().refetchEvents();
        })
        .catch((error) => {
          console.error("Error al obtener los eventos:", error);
        });
    },

    closeModal() {
      this.isModalVisible = false;
    },

    selectPatient(patient) {
      this.selectedPatient = patient;
    },
  },
};
</script>

<style>
.modal-container {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 9999;
  display: none;
}

.modal-container.show {
  display: block;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 9998;
  display: none;
}

.modal-overlay.show {
  display: block;
}
</style>
