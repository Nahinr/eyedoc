<!-- resources/js/components/TestComponent.vue -->

<template>
    <div>
      <h2>Este es un componente de prueba</h2>
      <p>{{ message }}</p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        message: '¡Hola desde el componente de prueba!'
      };
    }
  };
  </script>
  
  <style scoped>
  /* Agrega estilos si es necesario */
  </style>
  