<!-- resources/js/Layouts/DefaultLayout.vue -->
<template>
  <div>
    <Navbar @search="handleSearch" />
      <main>
         <slot></slot>
      </main>
      <Footer />
  </div>
</template>
  
<script>
  import Navbar from '../Components/Navbar.vue'
  import Footer from '../Components/Footer.vue'
  
  export default {
    name: 'DefaultLayout',
    components: {
      Navbar,
      Footer
    }
  }
</script>
  
<style scoped>
  main {
    margin: 85px 0 0 0;
    /* background-color: #fdf3f3; */
  }
</style>
  