<!-- Updated RecipeItem.vue -->
<template>
  <Link :href="`/recipes/${slug}`">
  <div class="recipe-item">
        <div class="image-container">
          <img :src="img" alt="">
          <!-- <img src="/images/profile-placeholder-square.png" alt=""> -->
        </div>
        <div class="text-container">
          <div class="bookmark-container">
            <span  class="material-symbols-outlined bookmark-icon" 
              :class="{ active: saved, animate: isAnimating }" 
              @click.stop.prevent="toggleSave"
              >
              bookmark
            </span>
          </div>
          <div>
            <h1>{{ name }}</h1>
            <div class="recipe-info">
              <div class="recipe-details">
                  <span class="material-symbols-outlined">schedule</span>
                  <p>{{ minutes }} min</p>
                  <StarRating :rating="rating" :font-size="'17px'"/>
              </div>
              <!-- <p class="ingredient-text">{{ ingredientsMissing }} missing ingredient{{ ingredientsMissing !== 1 ? 's' : '' }}...</p> -->
              <p class="ingredient-text">{{userHasIngredients}} / {{ingredients}}  <span class="material-symbols-outlined">grocery</span></p>
            </div>
          </div>
        </div>
        <div class="relbar-container">
          <RelBar :percentage="relbarPercentage" class="relbar"/>
        </div>

  </div>
</Link>

</template>

<script>
import { Link } from "@inertiajs/vue3";
import StarRating from './StarRating.vue';
import RelBar from './Relbar.vue';
import axios from 'axios';

export default {
  data() {
    return {
      relbarPercentage: 0,
      saved: false,
      isAnimating: false,
    };
  },
  
  props: {
    id: Number,
    name: String,
    minutes: Number,
    ingredients: Number,
    rating: Number,
    img: String,
    slug: String,
    userHasIngredients: Number,
  },
  components: {
    StarRating,
    RelBar,
    Link
  },
  computed: {
    relbarPercentage() {
      return this.ingredients ? Math.min((this.userHasIngredients / this.ingredients) * 100, 100) : 0;
    },
    ingredientsMissing() {
      return Math.max(0, this.ingredients - this.userHasIngredients);
    }
  },
  methods: {
    async toggleSave() {
      try {
        const response = await axios.post('/saved-recipes/toggle', {
          recipe_id: this.id,
        });
        console.log('Toggled:', response.data.status);

        // Set local saved state
        this.saved = response.data.status === 'saved'; // or however your backend responds
      } catch (error) {
        console.error('Failed to save recipe:', error);
      }
    },

    calculateBarPercentage(userHas) {
      if (this.ingredients === 0) {
        return;
      }
      this.relbarPercentage = (userHas / this.ingredients) * 100;
      if (this.relbarPercentage > 100) {
        this.relbarPercentage = 100;
      }
    },
    updateMissingIngredients(userHas) {
      this.ingredientsMissing = Math.max(0, this.ingredients - userHas);
    },
  },
};
</script>

<style scoped>
  .recipe-item {
    z-index: 0;
    display: flex;
    flex-direction: column;

    aspect-ratio: 4 / 5;
    width: 100%;
    max-width: 360px;
    
    background-color: rgb(255, 255, 255);

    border: #3a3a3a 1px solid;
    box-shadow: 5px 5px 0px 0px rgba(244,64,64,0.74);
    
    position: relative;
  }
/* HTML: <div class="ribbon">Your text content</div> */
/* HTML: <div class="ribbon">Your text content</div> */
.ribbon {
  font-size: 28px;
  font-weight: bold;
  color: #f44040;
}
/* .bookmark-container {
  --r: .8em; 
  
  border-block: .5em solid #0000;
  padding-inline: calc(var(--r) + .25em) .5em;
  line-height: 1.8;
  clip-path: polygon(0 0,100% 0,100% 100%,0 100%,0 calc(100% - .25em),var(--r) 50%,0 .25em);
  background:
   #2699dc padding-box;
  width: fit-content;
} */
 
  .bookmark-container{
    width: 13%;
    position: absolute;
    top: -20px;
    right: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f44040;
    border: 1px;
  }

  .bookmark-container span{
    color: #ffffff;
    font-size: 32px;
  }

  .bookmark-icon {
    transition: transform 0.3s ease;
    cursor: pointer;
  }

  .bookmark-icon.animate {
    transform: scale(1.4);
  }

  .bookmark-icon.active {
    color:rgb(255, 255, 255);
    font-variation-settings: 'FILL' 1; /* yellow/orange */
  }

  .image-container img{
    object-fit: cover;
    aspect-ratio: 1 / 1;
    width: 100%;
    max-width: calc(100%-10px);
  }

  .text-container{
    position: relative;
    flex-grow: 1 1 auto;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-inline: 10px;
  }

  .text-container h1{
    text-transform: uppercase;
    background-color: #ffffff;
    font-size: 21px;
    font-weight: 700;
    margin: 5px 0 0px 0;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .recipe-info{
    display: flex;
    justify-content: space-between;
  }

  .recipe-details {
    background-color: #ffffff;
    margin: 0;
    font-size: 12px;

    display: flex;
    flex-direction: row;
    align-items: center;
    width: auto;
    
  }

  .recipe-details p {
    margin: 0 10px 0 0;
    /* font-size: 12px; */
    font-weight: 400;
    color: #9B9B9B;
  }

  .ingredient-text {
    display: flex;
    align-items: center;
    font-size: 14px;
    font-weight: 400;
    color: #9B9B9B;
  }

  .ingredient-text span{
    margin-left: 2px;
    padding: 0px;
  }

  .relbar-container{
    position: absolute;
    bottom: 0;
    margin-top: 5px;
    width: 100%;
    height: 17%;
  }

  .material-symbols-outlined {
    font-size: 20px;
    font-weight: 350;
    color: #9B9B9B;
  }

</style>
