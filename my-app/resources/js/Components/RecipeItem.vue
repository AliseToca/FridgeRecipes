<template>
  <Link :href="`/recipes/${slug}`">
    <div class="recipe-item">
      <div class="image-container">
        <img :src="img" alt="">
      </div>
      <div class="text-container">
        <div class="bookmark-container">
          <span
            class="material-symbols-outlined bookmark-icon"
            :class="{ active: isSaved, animate: isAnimating }"
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
              <StarRatingDisplay :rating="rating" :font-size="'17px'" />
            </div>
            <p class="ingredient-text">
              {{ userHasIngredients }} / {{ ingredients }}
              <span class="material-symbols-outlined">grocery</span>
            </p>
          </div>
        </div>
      </div>
      <div class="relbar-container">
        <RelBar :percentage="relbarPercentage" class="relbar" />
      </div>
    </div>
  </Link>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import StarRatingDisplay from './StarRatingDisplay.vue';
import RelBar from './Relbar.vue';
import axios from 'axios';

export default {
  components: {
    Link,
    StarRatingDisplay,
    RelBar,
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
    saved: Boolean,
  },
  data() {
    return {
      isAnimating: false,
    };
  },
  computed: {
    isSaved() {
      return this.saved;
    },
    relbarPercentage() {
      return this.ingredients
        ? Math.min((this.userHasIngredients / this.ingredients) * 100, 100)
        : 0;
    },
  },
  methods: {
    async toggleSave() {
      try {
        const response = await axios.post('/saved-recipes/toggle', {
          recipe_id: this.id,
        });

        const newState = response.data.status === 'saved';

        this.$emit('update-save-state', {
          recipeId: this.id,
          isSaved: newState,
        });

        this.isAnimating = true;
        setTimeout(() => {
          this.isAnimating = false;
        }, 300);
      } catch (error) {
        console.error('Failed to toggle save state:', error);
      }
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
    max-width: 320px;
    min-width: 250px;
    height: auto;
    
    background-color: rgb(255, 255, 255);

    border: #3a3a3a 1px solid;
    box-shadow: 5px 5px 0px 0px rgba(244,64,64,0.74);
    
    position: relative;
  }

  .ribbon {
    font-size: 28px;
    font-weight: bold;
    color: #f44040;
  }

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
    max-width: calc(100%-90px);
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
