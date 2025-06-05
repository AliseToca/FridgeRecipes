<template>
  <div class="page-wrap">
    <!-- Navbar -->
    <div class="nav-bar">
      <button @click="goBack" class="back-arrow">
        <span class="material-symbols-outlined">arrow_back</span>
      </button>
      <Link :href="route('logout')" method="post" class="logout-btn"> LOG OUT </Link>
    </div>

    <!-- Edit Profile Modal -->
    <div v-if="editing" class="modal-overlay" @click="handleOutsideClick">
      <div class="modal-content" ref="modal">
        <div class="modal-header">
          <div>
            <h2>Edit Profile</h2>
            <button @click="editing = false" class="cancel-btn">
              <span class="material-symbols-outlined">close</span>
            </button>
          </div>
        </div>

        <div class="modal-line">
          <h3>Profile Image</h3>
          <div>
            <img v-if="previewUrl" :src="previewUrl" class="profile-preview" />
            <input type="file" @change="handleImageUpload" />
          </div>
        </div>

        <div class="modal-line">
          <h3>Username</h3>
          <div>
            <input
              class="edit-field"
              v-model="form.username"
              placeholder="Username"
              @input="usernameTaken = false"
              @blur="checkUsername"
            />
            <p class="error" :style="{ visibility: usernameTaken ? 'visible' : 'hidden' }">
              This username is already taken.
            </p>
          </div>
        </div>

        <div class="modal-line">
          <h3>Bio</h3>
          <div>
            <textarea
              class="edit-field"
              v-model="form.bio"
              placeholder="Write your bio..."
              @input="validateBioLength"
              maxlength="90"
            />
            <p class="char-count" :class="{ 'error': bioError }">
              {{ form.bio.length }}/90 characters
            </p>
            <p v-if="bioError" class="error">Bio cannot exceed 90 characters.</p>
          </div>
        </div>

        <div class="modal-actions">
          <button @click="saveProfile" class="save-btn" :disabled="usernameTaken">SAVE</button>
        </div>
      </div>
    </div>

    <!-- Profile Card -->
    <div class="card">
      <img class="profile-image" :src="previewUrl" alt="Profile" />
      <div class="profile-info-container">
        <h2 class="name">{{ auth.user.username }}</h2>
        <button @click="enableEditing" class="edit-btn">
          <span class="material-symbols-outlined">edit</span>
        </button>
      </div>
      <p class="bio">{{ auth.user.bio || 'No bio yet.' }}</p>
    </div>

    <!-- Saved Recipes -->
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
import RecipeList from '@/Components/RecipeList.vue';
import axios from 'axios';

export default {
  components: {
    Link,
    RecipeList,
  },
  props: {
    auth: Object,
    savedRecipes: Array,
  },
  data() {
    return {
      editing: false,
      usernameTaken: false,
      bioError: false,
      maxBioLength: 90,
      searchQuery: '',
      recipeListKey: 0,
      form: {
        username: this.auth.user.username,
        bio: this.auth.user.bio || '',
        image: null,
      },
      previewUrl: this.auth.user.profile_image
        ? `/storage/${this.auth.user.profile_image}`
        : '/images/profile-placeholder-square.png',
      localSavedRecipes: [],
    };
  },
  mounted() {
    const fridgeIngredients = this.auth.user.fridge?.ingredients || [];
    this.localSavedRecipes = this.computeRecipeMatches(this.savedRecipes, fridgeIngredients);
  },
  methods: {
    enableEditing() {
      this.editing = true;
    },
    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.form.image = file;
        this.previewUrl = URL.createObjectURL(file);
      }
    },
    handleOutsideClick(event) {
      if (!this.$refs.modal.contains(event.target)) {
        this.resetForm();
        this.editing = false;
      }
    },
    validateBioLength() {
      this.bioError = this.form.bio.length > this.maxBioLength;
    },
    async checkUsername() {
      if (this.form.username !== this.auth.user.username) {
        try {
          const response = await axios.get(`/check-username?username=${this.form.username}`);
          this.usernameTaken = response.data.taken;
        } catch (err) {
          console.error('Username check failed:', err);
          this.usernameTaken = false;
        }
      } else {
        this.usernameTaken = false;
      }
    },
    async saveProfile() {
      if (this.usernameTaken) return;

      const formData = new FormData();
      formData.append('username', this.form.username);
      formData.append('bio', this.form.bio);
      if (this.form.image) {
        formData.append('profile_image', this.form.image);
      }

      try {
        await axios.post('/profile/update', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });
        location.reload();
      } catch (err) {
        if (err.response?.status === 422) {
          const errors = err.response.data.errors;
          if (errors.username) {
            this.usernameTaken = true;
          }
        } else {
          console.error('Failed to update profile:', err);
        }
      }
    },
    resetForm() {
      this.form.username = this.auth.user.username;
      this.form.bio = this.auth.user.bio || '';
      this.form.image = null;
      this.previewUrl = this.auth.user.profile_image
        ? `/storage/${this.auth.user.profile_image}`
        : '/images/profile-placeholder-square.png';
    },
    goBack() {
      window.history.back();
    },
    handleSaveStateChange({ recipeId, isSaved }) {
      if (!isSaved) {
        this.localSavedRecipes = this.localSavedRecipes
          .filter(r => r.id !== recipeId)
          .slice();

        axios.post(`/recipes/${recipeId}/unsave`).catch(err =>
          console.error('Failed to unsave recipe:', err)
        );

        // Notify global event
        window.dispatchEvent(new CustomEvent('recipe-unsaved', { detail: recipeId }));
      }
    },
    computeRecipeMatches(recipes, fridgeIngredients) {
      const fridgeIds = fridgeIngredients.map(i => i.id);
      return recipes.map(recipe => ({
        ...recipe,
        matchCount: recipe.ingredients?.filter(i => fridgeIds.includes(i.id)).length || 0,
        saved: true,
      }));
    },
  },
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

  .back-arrow {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
  }

  .back-arrow span {
    font-size: 32px;
    color: #444;
  }

  
  /*----Profile card-----*/
  .card {
    display: flex;
    align-items: center;
    flex-direction: column;
    background-color: #ffffff;
    border-radius: 16px;

    margin-top: 20px;
    padding: 30px;
    padding-bottom: 0;
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

  .modal-line div{
    display: flex;
    flex-direction: column;
    width: 100%;

  }

  .modal-line h3{
    width: 30%;
    padding-right: 15px;
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
    width: 100%;
    resize: vertical;
  }

  .save-btn{
    width: 100px;
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
    padding: 0 0px 10px 5px;
    width: 70%;
    display: flex;
    align-items: center;
    border-bottom:  2px solid #d4d4d4;
  }


  .nav-line p{
    color: #555555;
    font-size: 18px;
    margin-right: 5px;
  }

  /* .vertical-line{
    margin-inline: 15px;  
  } */

  .material-symbols-outlined {
    color: #666666;
    padding: 0;
    margin: 0;
    font-size: 24px;
  }
  .recipe-grid{
    min-width: 50%;
    width: 70%;
  }


/*------Responsivness----*/
@media (max-width: 1024px) {
  .recipe-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
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
}

@media (max-width: 480px) {
  .recipe-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 5px;
    width: 100%;
  }
}

</style>


  