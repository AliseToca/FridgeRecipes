<template>
    <!-- <div>
      <h1>Profile</h1>
      <p>Welcome, {{ auth.user.name }}</p>
  

      <Link :href="route('logout')" method="post" class="logout-btn">
        Log out
      </Link>
    </div> -->

    <div class="nav-bar">
      <div class="logo">
        <Link href="/">FridgeRecipes</Link>
      </div>

      <Link :href="route('logout')" method="post" class="logout-btn"> Log out </Link>
    </div>


  <div class="profile-page">
    <div class="card">
      <img class="profile-image" src="/images/profile-placeholder-square.png" alt="Profile"/>
      <h2 class="name">{{auth.user.username}}</h2>
      <p class="bio"> No bio yet. </p>

      <!-- <div class="buttons">
        <button class="btn secondary">Follow</button>
      </div> -->
    </div>
  </div>

  <div class="nav-line">
    <p>My Recipes</p>
    <p class="vertical-line">|</p>
      <p>Favorites</p> 
      <span class="material-symbols-outlined">bookmark</span>
    <p class="vertical-line">|</p>
    <p>Completed Recipes</p>
  </div>

  <div class="recipe-grid">
    <div class="placeholder"></div>
    <div class="placeholder"></div>
    <div class="placeholder"></div>
    <div class="placeholder"></div>
    <div class="placeholder"></div>
    <div class="placeholder"></div>
    <div class="placeholder"></div>
    <div class="placeholder"></div>
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
  .nav-bar{
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 20px 50px 20px 50px;
    background-color: #ffffff;
    transition: all 0.4s ease;
  }

  .logo{
    font-weight: 600;
    font-size: 32px;
    color: #000000;
    width: 100%;
  }

  .logout-btn {
    height: 45px;
    width: 100px;
    padding: 8px 15px;
    background-color: #f44040;
    border-radius: 5px;

    color: white;
    font-size: 18px;
    font-weight: 500;

    transition: 0.3s;
  }
  
  .logout-btn:hover {
    background-color: #d32f2f;
  }

  .card {
    display: flex;
    align-items: center;
    flex-direction: column;
    background-color: #ffffff;
    border-radius: 16px;

    padding: 30px;
    max-width: 400px;
    width: 100%;
    text-align: center;
  }

  .profile-image {
    width: 128px;
    height: 128px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    margin-bottom: 20px;
  }

  .name {
    font-size: 24px;
    font-weight: bold;
    margin: 10px 0;
  }

  .bio {
    color: #666666;
    font-size: 16px;
    margin-bottom: 20px;
  }
/* 
  .buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
  } */

  .nav-line{
    padding: 0 0px 10px 30px;
    width: 90%;
    display: flex;
    align-items: center;
  }

  .nav-line p{
    color: #666666;
    font-size: 18px;
    margin-right: 5px;
  }

  .vertical-line{
    margin-inline: 15px;  
  }

  .recipe-grid{
    width: 90%;
    border-top: 2px solid #d4d4d4;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    column-gap: 10px;
    row-gap: 25px;
    justify-items: center;
    padding: 20px;
    padding-left: 5px;
    min-height: 500px;
  }

  .placeholder{
    width: 300px;
    height: 350px;
    background: rgba(0, 0, 0, 0.05);
    border-radius: 8px;
  }

  .material-symbols-outlined {
    color: #666666;
    padding: 0;
    margin: 0;
    font-size: 24px;
  }
</style>


  