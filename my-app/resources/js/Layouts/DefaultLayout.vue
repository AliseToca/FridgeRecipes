<template>
  <div>
    <Navbar @search="handleSearch" />

    <main>
      <slot></slot>
    </main>

    <!-- Wrap footer in full-width container -->
    <div class="footer-wrapper">
      <Footer />
    </div>
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
}

.footer-wrapper {
  width: 100vw;
  position: relative;
  left: 50%;
  right: 50%;
  margin-left: -50vw;
  margin-right: -50vw;
}
</style>
