<template>
    <div class="nav-bar">
      <Logo></Logo>
      <Link :href="route('logout')" method="post" class="logout-btn"> LOG OUT </Link>
    </div>


  <div class="profile-page">
    <div class="card">
      <img class="profile-image" src="/images/profile-placeholder-square.png" alt="Profile"/>
      <h2 class="name">{{auth.user.username}}</h2>
      <p class="bio"> No bio yet. </p>
    </div>
  </div>

  <div class="recipe-grid-container">
    <div class="nav-line">
      <p>My Recipes</p>
      <p class="vertical-line">|</p>
        <p>Favorites</p> 
        <span class="material-symbols-outlined">bookmark</span>
      <p class="vertical-line">|</p>
      <p>Completed Recipes</p>
    </div>


    <!-- <div class="recipe-grid">
      <div class="placeholder"></div>
      <div class="placeholder"></div>
      <div class="placeholder"></div>
      <div class="placeholder"></div>
      <div class="placeholder"></div>
      <div class="placeholder"></div>
      <div class="placeholder"></div>
      <div class="placeholder"></div>
    </div> -->

    <RecipeList :recipes="savedRecipes" />
  </div>

</template>
  
<script>
import { Link } from '@inertiajs/vue3';
import Logo from '@/Components/Logo.vue';
import RecipeList from '@/Components/RecipeList.vue';

export default {
  components: {
    Link,
    Logo,
    RecipeList,
  },
  props: {
    auth: Object,
    savedRecipes: Array,
    searchQuery: {
      type: String,
      default: '',
    }, 
  },
  mounted() {
    console.log('Saved Recipes:', this.savedRecipes);
    if (Array.isArray(this.savedRecipes)) {
      console.log('Saved recipes are an array!');
    } else {
      console.error('Saved recipes are not an array:', this.savedRecipes);
    }
  },

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

    background-color: #f44040;
    border-radius: 3px;
    padding: 5px ;

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

  .material-symbols-outlined {
    color: #666666;
    padding: 0;
    margin: 0;
    font-size: 24px;
  }

  .recipe-grid-container{
    width: 90%;
    max-width: 1000px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .recipe-grid {
  width: 100%;
  border-top: 2px solid #d4d4d4;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 15px;
  justify-items: center;
  padding: 20px;
  padding-left: 5px;
  min-height: 500px;
}

.placeholder {
  aspect-ratio: 4 / 5;
  width: 100%;
  max-width: 250px;
  background: rgba(0, 0, 0, 0.05);
  border-radius: 8px;
}

@media (max-width: 1024px) {
  .recipe-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
  }

  .placeholder {
    min-width: 60%;
  }
}

@media (max-width: 768px) {
  .nav-bar {
    padding-inline: 30px;
  }

  .recipe-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
  }

  .placeholder {
    min-width: 30%;
  }
}

@media (max-width: 480px) {
  .recipe-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 5px;
  }

  .placeholder {
    min-width: 30%;
  }
}

</style>


  