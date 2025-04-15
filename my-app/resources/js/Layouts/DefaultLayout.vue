<!-- resources/js/Layouts/DefaultLayout.vue -->
<template>
  <div>
    <Navbar :auth="auth" @search="handleSearch" />
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
    },
    props: {
      auth: Object, 
    }
  }
</script>
  
<style scoped>
  main {
    margin-top: 90px;
    padding: 20px;
    /* background-color: #fdf3f3; */
  }
</style>
  