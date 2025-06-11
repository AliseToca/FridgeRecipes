<template>
    <div class="forbidden-container">
      <div class="error-box">
        <h1 class="error-code">403</h1>
        <h2 class="error-message">Access Denied</h2>
        <p class="error-description">
          {{ message || 'You do not have permission to access this page.' }}
        </p>
        <Link href="/" class="back-link">← Go back home</Link>
      </div>
    </div>
</template>
  
  <script setup>
  defineProps({
    status: Number,
    message: String
  })
  </script>

<style scoped>
.forbidden-container {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 90vh;
  background-color: #fff;
}

.error-box {
  border: 1px solid #3a3a3a;
  box-shadow: 11px 11px 0px rgba(244, 64, 64, 0.74);
  color: #3a3a3a;
  padding: 40px;
  max-width: 600px;
  width: 90%;
  text-align: center;
  background-color: #ffffff;
}

.error-code {
  font-size: 60px;
  color: #f44040;
  margin-bottom: 10px;
}

.error-message {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 15px;
  text-transform: uppercase;
}

.error-description {
  color: #555;
  font-size: 16px;
  margin-bottom: 25px;
}

.back-link {
  color: #f44040;
  text-decoration: none;
  font-weight: bold;
  border: 1px solid #f44040;
  padding: 8px 16px;
  transition: all 0.2s ease;
}

.back-link:hover {
  background-color: #f44040;
  color: white;
}
</style>
  