<template>
    <div>
      <h1>Profile</h1>
      <p>Welcome, {{ auth.user.name }}</p>
  
      <!-- Log out link -->
      <Link :href="route('logout')" method="post" class="logout-btn">
        Log out
      </Link>
    </div>
</template>
  
<script>
  import { Link } from '@inertiajs/vue3';
  
  export default {
    components: {
      Link,
    },
    props: {
      auth: Object, // Make sure auth data is passed to this component
    }
  }
</script>
  
<style scoped>
  .logout-btn {
    padding: 8px 15px;
    background-color: #f44040;
    color: white;
    border-radius: 5px;
    transition: 0.3s;
  }
  
  .logout-btn:hover {
    background-color: #d32f2f;
  }
</style>
  