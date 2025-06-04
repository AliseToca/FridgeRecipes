<template>
  <div class="page-wrap">
    <!-- Navbar -->
    <div class="nav-bar">
      <Logo></Logo>
      <Link :href="route('logout')" method="post" class="logout-btn"> LOG OUT </Link>
    </div>

    <!--Edit profile overlay -->
    <div v-if="editing" class="modal-overlay"  @click="handleOutsideClick">
      <div class="modal-content"  ref="modal">
        <h2>Edit Profile</h2>
        <input
          v-model="form.username"
          placeholder="Username"
          @input="usernameTaken = false"
          @blur="checkUsername"
        />
        <p v-if="usernameTaken" class="error">This username is already taken.</p>

        <textarea
          v-model="form.bio"
          placeholder="Write your bio..."
          @input="validateBioLength"
          maxlength="90"
        />
        <p class="char-count" :class="{ 'error': bioError }">
          {{ form.bio.length }}/90 characters
        </p>
        <p v-if="bioError" class="error">Bio cannot exceed 90 characters.</p>

        <input type="file" @change="handleImageUpload" />
        <img v-if="previewUrl" :src="previewUrl" class="profile-preview" />
        
        <div class="modal-actions">
          <button @click="saveProfile" class="save-btn" :disabled="usernameTaken">Save</button>
          <button @click="editing = false" class="cancel-btn">Cancel</button>
        </div>
      </div>
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
    <div class="recipe-grid-container">
      <div class="nav-line">
        <!-- <p>My Recipes</p>
        <p class="vertical-line">|</p>
          <p>Favorites</p> 
          <span class="material-symbols-outlined">bookmark</span>
        <p class="vertical-line">|</p>
        <p>Completed Recipes</p> -->
        <p>Saved Recipes</p> 
        <span class="material-symbols-outlined">bookmark</span>
      </div>

      <RecipeList :recipes="savedRecipes" no-recipes-message="You don't have any saved recipes"/>
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
  data() {
  return {
    editing: false,
    usernameTaken: false,
    bioError: false, 
    maxBioLength: 90,
    form: {
      username: this.auth.user.username,
      bio: this.auth.user.bio || '',
      image: null,
    },
    previewUrl: this.auth.user.profile_image
      ? `/storage/${this.auth.user.profile_image}`
      : '/images/profile-placeholder-square.png',
  };
},

methods: {
  enableEditing() {
    this.editing = true;
    this.usernameTaken = false;
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
  }
  }
}
</script>
  
<style scoped>
  .page-wrap{
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column; 
  }

  .nav-bar{
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 20px 50px 20px 50px;
    background-color: #ffffff;
    transition: all 0.4s ease;
    /* border-bottom: 2px solid #f05c5c; */
  }

  .logout-btn,
  .save-btn,
  .edit-btn{
    background-color: #f44040;
  }

  .logout-btn,
  .save-btn,
  .edit-btn{
    background-color: #f44040;
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
  
  .logout-btn:hover,
  .save-btn:hover,
  .edit-btn:hover {
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
    margin-bottom: 15px;
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

  .nav-line{
    padding: 0 0px 10px 30px;
    width: 90%;
    display: flex;
    align-items: center;
    border-bottom: #666666 2px solid;
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

.input-wrap {
  display: flex;
  flex-direction: column;
  gap: 10px;
  width: 100%;
}

.input-wrap input,
.input-wrap textarea {
  padding: 8px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 6px;
  width: 100%;
  resize: vertical;
}

.save-btn{
  margin-top: 10px;
  padding: 10px;
  background-color: #f44040;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}



.image-upload {
  cursor: pointer;
}

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
  padding: 30px;
  border-radius: 10px;
  max-width: 400px;
  width: 90%;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.modal-actions {
  display: flex;
  justify-content: space-between;
}

.cancel-btn {
  background-color: #999;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 4px;
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

.profile-info-container{
  display: flex;
  flex-direction: row;
  align-items: center;
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


  