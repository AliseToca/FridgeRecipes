<template>
  <div class="page-wrap">
    <!-- Navbar -->
    <div class="nav-bar">
      <Logo></Logo>
      <Link :href="route('logout')" method="post" class="logout-btn"> LOG OUT </Link>
    </div>

    <!-- Profile card -->
    <div class="card">
      <img class="profile-image" :src="previewUrl" alt="Profile" />
      <div class="profile-info-container">
        <h2 class="name">{{ auth.user.username }}</h2>
        <button @click="enableEditing" class="edit-btn"><span class="material-symbols-outlined">edit</span></button>
      </div>
      <p class="bio">{{ auth.user.bio || 'No bio yet.' }}</p>
    </div>

    <!-- Saved recipes -->
    <div class="nav-line">
        <p>Saved Recipes</p> 
        <span class="material-symbols-outlined">bookmark</span>
    </div>

    <div class="recipe-grid">
        <RecipeList
          :key="recipeListKey"
          :recipes="localSavedRecipes"
          :searchQuery="searchQuery"
          no-recipes-message="You don't have any saved recipes."
          @update-save-state="handleSaveStateChange"
        />
    </div>

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
  },
  data() {
  return {
    searchQuery: '',
    previewUrl: this.auth.user.profile_image
      ? `/storage/${this.auth.user.profile_image}`
      : '/images/profile-placeholder-square.png',
    localSavedRecipes: this.savedRecipes.map(recipe => ({
      ...recipe,
      saved: true,
    })),
    recipeListKey: 0, // force re-render
  };
},
methods: {
  enableEditing() {
    this.editing = true;
  },
  handleSaveStateChange({ recipeId, isSaved }) {
  if (!isSaved) {
    this.localSavedRecipes = this.localSavedRecipes
      .filter(r => r.id !== recipeId)
      .slice(); // force new reference
  }
}

}

};
</script>

  
<style scoped>
  .page-wrap{
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column; 
  }

  /*Defining page buttons*/
  .logout-btn,
  .save-btn,
  .edit-btn{
    background-color: #f44040;
  }

  .logout-btn:hover,
  .save-btn:hover,
  .edit-btn:hover {
    background-color: #d32f2f;
  }

  /*-------Nav bar------*/
  .nav-bar{
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 20px 50px 20px 50px;
    background-color: #ffffff;
    transition: all 0.4s ease;
    /* border-bottom: 2px solid #f05c5c; */
  }

  .logout-btn {
    height: 45px;
    width: 100px;

    color: #fff;
    border-radius: 3px;
    padding: 5px ;

    font-size: 18px;
    font-weight: 500;

    transition: 0.3s;
  }
  
  /*----Profile card-----*/
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
    width: 175px;
    height: 175px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    margin-bottom: 15px;
  }

  .profile-info-container{
    display: flex;
    flex-direction: row;
    align-items: center;
  }

  .name {
    font-size: 24px;
    font-weight: bold;
    margin-top: 5px;
  }

  .bio {
    color: #666666;
    font-size: 16px;
    margin-bottom: 20px;
    text-wrap: pretty;
  }

  .edit-btn{
    margin-left: 10px;
    padding: 5px;
    background-color: #f44040;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    width: 30px;
    height: 30px;

    display: flex;
    justify-content: center;
    align-items: center;

  }

  .edit-btn span {
    color: #fff;
    font-size: 20px;
  }

  /*---Profile edit overlay---*/
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .modal-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    max-width: 500px;
    width: 90%;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .modal-edittable-content{
    padding-inline: 20px;
  }

  .modal-header{
    border-bottom: #ccc 2px solid;
  }

  .modal-header div{
    padding-bottom: 5px;
    display: flex;
    justify-content: space-between;
  }

  .modal-header h2{
    font-size: 20px;
  }

  
  .cancel-btn {
    border: none;
    border-radius: 4px;
  }

  .cancel-btn span{
    color: #000;
    font-size: 24px;
  }

  .modal-line{
    display: flex;
    margin-top: 7px;
    padding-bottom: 7px;
    width: 100%;
    border-bottom: #ccc 2px solid;
  }

  .modal-line h3{
    width: 30%;
  }

  .input-wrap {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100%;
  }

  .edit-field {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 2px;
    width: 250px;
    resize: vertical;
  }

  .save-btn{
    width: 17%;
    margin-top: 10px;
    padding: 10px;
    background-color: #f44040;
    font-weight: 600;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .image-upload {
    cursor: pointer;
  }

  .modal-actions {
    display: flex;
    justify-content: space-between;
  }

  .profile-preview {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-top: 10px;
  }
  .error {
    color: red;
    font-size: 14px;
  }


  /*-----Saved recipes----*/
  .nav-line{
    padding: 0 0px 10px 30px;
    width: 70%;
    display: flex;
    align-items: center;
    border-bottom:  2px solid #d4d4d4;
  }

  .recipe-grid{
    min-width: 50%;
  }
  .nav-line p{
    color: #555555;
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



/*------Responsivness----*/
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


  