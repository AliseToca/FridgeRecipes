<template>
  <div class="recipe-container">
    <div class="short-info">
      <div>
        <div>
          <h1>{{ recipe.name }}</h1>
          <p class="author">Author: {{ recipe.user?.name ?? 'Unknown' }}</p>
        </div>
        <p>{{ recipe.bio }}</p>
        <StarRating :rating="recipe.rating" :font-size="'32px'" class="star-rating"/>
      </div>
      <img :src="recipe.img" alt="Recipe Image" class="recipe-image" />
    </div>

    <br>
    <div class="recipe-info">
      <p><strong>Prep Time:</strong> {{ recipe.minutes }} minutes</p>
      <p><strong>Cooking Time:</strong> {{ recipe.cookMinutes }} minutes</p>
      <p><strong>Total Time:</strong> {{ recipe.minutes + recipe.cookMinutes }} minutes</p>
    </div>

    <div class="recipe-section">
      <h2 class="section-title"><span>Ingredients</span></h2>

      <ul class="ingredient-list">
          <li
              v-for="(ingredient, index) in recipe.ingredients"
              :key="ingredient.id"
              class="ingredient-item"
              :class="{ checked: checkedIngredients[index] }"
          >
              <label>
                <input type="checkbox" v-model="checkedIngredients[index]" />
                <span class="ingredient-text">
                  <span v-if="ingredient.pivot.amount">{{ingredient.pivot.amount }} </span> 
                  <span v-if="ingredient.pivot.unit"> 
                    {{ingredient.pivot.unit }} 
                  </span>{{ingredient.name }} 
                </span>
              </label>
          </li>
      </ul>

    </div>

    <div class="recipe-section">
      <h2 class="section-title"><span>Instructions</span></h2>
      <ol class="instruction-list">
        <li v-for="(step, index) in recipe.instructions" :key="index">
          {{ step }}
        </li>
      </ol>
    </div>

    <div class="recipe-section">
      <h2 class="section-title"><span>Reviews</span></h2>

      <form v-if="user"  @submit.prevent="submitComment" class="comment-form">
        <textarea
          v-model="newComment"
          placeholder="Write your comment..."
          required
          class="comment-textarea"
        ></textarea>

        <button type="submit" class="comment-submit-button">
          POST
        </button>
      </form>

      <div v-for="comment in recipe.comments" :key="comment.id" class="comment-item">
        <Comment 
          :image="'/images/profile-placeholder-square.png'" 
          :author="comment.user.username" 
          :star-rating="3" 
          :content="comment.content" 
          :date="comment.created_at"/>
      </div>

    </div>

  </div>
</template>
  
<script>
import DefaultLayout from '../Layouts/DefaultLayout.vue';
import StarRating from '@/Components/StarRating.vue';
import Comment from '@/Components/Comment.vue';
import { router } from '@inertiajs/vue3';

export default {
  layout: DefaultLayout,

  props: {
    recipe: Object,
    auth: Object,
  },
  components: {
    StarRating,
    Comment,
  },
  data() {
    return {
      checkedIngredients: [],
      newComment: '',
    };
  },
  methods: {
    submitComment() {
      router.post('/comments', {
        content: this.newComment,
        recipes_id: this.recipe.id,
      }, {
        preserveScroll: true,
        onSuccess: () => {
          this.newComment = '';
        },
      });
    }
  },
  mounted() {
    if (this.recipe.ingredients && Array.isArray(this.recipe.ingredients)) {
      this.checkedIngredients = this.recipe.ingredients.map(() => false);
    } else {
      this.checkedIngredients = [];
    }
  },
};
</script>


 
<style scoped>
/* ----In general----*/

 .recipe-container {
    border: 1px solid #3a3a3a;
    box-shadow:11px 11px 0px 0px rgba(244,64,64,0.74);
    color: #3a3a3a;
    border-radius: 0px;
    background-color: #ffffff;
    padding: 20px;
    max-width: 800px;
    margin: 100px auto;
  }

  .recipe-section {
    margin-bottom: 30px;
 }

.section-title {
   width: 100%; 
   text-align: center; 
   border-bottom: 1px solid #f44040; 
   color: #f44040;
   line-height: 2px;
   margin: 10px 0 20px; 
} 

.section-title span{
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    background:#fff; 
    padding:0 10px; 
    text-transform: uppercase;
}

/* --About recipe-- */

 .short-info{
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding-inline: 10px;
 }


 .short-info > div{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-right: 20px;
 }

 .short-info  h1{
    font-size: 32px;
    font-weight: bold;
    color: #1d1d1d;
    width: 100%;
    text-transform: uppercase;
  
 }

 .short-info p{
    margin-bottom: 10px;
 }

 .star-rating{
    margin-bottom: 5px;
 }

.short-info img {
    aspect-ratio: 1 / 1;
    width: 30%;
    max-width: 30%;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.recipe-info {
    margin-bottom: 20px;
    font-size: 16px;
    padding-inline: 10px;
}

/* --Ingredients-- */

.ingredient-list {
  list-style: none;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.ingredient-item {
  display: flex;
  align-items: center;
  
  transition: background-color 0.2s, color 0.2s;
}

/* INGREDIENTS U DONT HAVE WILL BE MARKED WITH THIS
.ingredient-item.checked {
  background-color: #fcdcdc;
} */

.ingredient-item input[type='checkbox'] {
  margin-right: 12px;
  transform: scale(1.2);
  cursor: pointer;
}

.ingredient-list label{
  display: flex;
  align-items: center;
}

.ingredient-item .ingredient-text {
  font-size: 16px;
  transition: text-decoration 0.2s;
}

.ingredient-item.checked .ingredient-text {
  text-decoration: line-through;
  color: gray;
}

.ingredient-text span {
  margin-right: 5px; /* Adjust the spacing as needed */
}

.ingredient-list {
    padding-left: 20px;
    list-style-type: disc;
}

/* --Instructions-- */

.instruction-list {
    padding-left: 35px;
    list-style: none; /* Remove default list style */
    counter-reset: instruction-counter; /* Initialize the counter */
    margin-left: 10px;
}

.instruction-list li {
    margin-bottom: 15px;
    position: relative; /* To position the number correctly */
}

.instruction-list li::before {
    content: counter(instruction-counter) ". "; /* Display the current count */
    counter-increment: instruction-counter; /* Increment the counter for each li */
    position: absolute;
    left: -25px; /* Adjust the left position to place the number correctly */
    top: 0;
    font-weight: bold; /* Style the numbers */
    font-size: 1.1rem; /* Adjust the font size */
}

.comment-form {
  background-color: #fff;
  padding: 16px;

  margin-top: 24px;
}

.comment-textarea {
  width: 100%;
  height: 120px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  resize: none;
  font-size: 14px;
  font-family: inherit;

  box-sizing: border-box;
}

.comment-textarea:focus {
  border-color: #f44040;
  outline: none;
  
}
/*---Reviews---*/
.comment-submit-button {
  background-color: #f44040;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 2px;
  cursor: pointer;
  font-weight: 600;
  transition: background-color 0.2s ease;
}

.comment-submit-button:hover {
  background-color:rgb(228, 43, 43);
}


.comment-item{
  margin-bottom:20px;
}
</style>
  