<template>
    <div class="fridge-sidebar guest collapsed">
      <div class="fridge-container">
        <div class="fridge-login-message">
          <span class="material-symbols-outlined">lock</span>
          <p>To manage your fridge you must log into your account.</p>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  // No user logic or fridge interactions necessary for guest version
  </script>
  
  <style scoped>
  .fridge-sidebar {
    transition: width 0.3s ease;
    position: sticky;
    top: 85px;
    width: 15%;
    height: calc(100vh - 85px);
    background-color: #fff;
    padding: 30px 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-right: 1px solid #3a3a3a;
    overflow: visible;
  }
  
  .fridge-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 20px;
    text-align: center;
    background-color: #f9f9f9;
  }
  
  .fridge-login-message {
    color: #444;
  }
  
  .fridge-login-message span.material-symbols-outlined {
    font-size: 60px;
    color: #f44040;
    margin-bottom: 10px;
  }
  
  .fridge-login-message p {
    font-size: 14px;
    line-height: 1.5;
  }
  
  @media (max-width: 1024px) {
    .fridge-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      z-index: 1001;
      transform: translateX(-100%);
      transition: transform 0.3s ease;
      background-color: white;
      border-right: 2px solid #f44040;
    }
  
    .fridge-sidebar:not(.collapsed) {
      transform: translateX(0);
    }
  }
  </style>
  