<template>
    <div class="loading-overlay" v-if="show">
      <div class="spinner"></div>
      <p>{{ message }}</p>
    </div>
</template>
  
<script>
  export default {
    props: {
      show: {
        type: Boolean,
        required: true,
      },
      message: {
        type: String,
        default: 'Loading...',
      },
    },
  };
</script>
  
<style scoped>
  .loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(255, 255, 255, 0.85);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    color: #333;
  }
  
  .spinner {
    width: 40px;
    height: 40px;
    border: 5px solid #ccc;
    border-top: 5px solid #f44040;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 15px;
  }
  
  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }
</style>
  