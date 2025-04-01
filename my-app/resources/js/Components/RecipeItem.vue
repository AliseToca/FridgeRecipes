<!-- Updated RecipeItem.vue -->
<template>
  <div class="recipe-item">
    <div class="image-container">
      <img :src="img" alt="">
      <h1>{{ name }}</h1>
      <div class="recipe-details">
        <span class="material-icons">schedule</span>
        <p class="detail-text">{{ minutes }} min</p>
        <StarRating :rating="rating"/>
      </div>
    </div>
    <p class="ingredient-text">{{ ingredientsMissing }} missing ingredient{{ ingredientsMissing !== 1 ? 's' : '' }}...</p>
    <RelBar :percentage="relbarPercentage" />
  </div>
</template>

<script>
import StarRating from './StarRating.vue';
import RelBar from './Relbar.vue';

export default {
  data() {
    return {
      relbarPercentage: 0,
      ingredientsMissing: 0,
      userHasIngredients: 4,
    };
  },
  components: {
    StarRating,
    RelBar
  },
  computed: {
    relbarPercentage() {
      return this.ingredients ? Math.min((this.userHasIngredients / this.ingredients) * 100, 100) : 0;
    },
    ingredientsMissing() {
      return Math.max(0, this.ingredients - this.userHasIngredients);
    }
  },
  props: {
    id: Number,
    name: String,
    minutes: Number,
    ingredients: Number,
    rating: Number,
    img: String,
  },
  methods: {
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
  h1{
    padding-bottom: 5px;
  }

  .recipe-item {
    z-index: 0;
    display: flex;
    flex-direction: column;
    width: 300px;
    height: 350px;
    background-color: rgb(255, 255, 255);
    border: #fff 8px solid;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  }

  .image-container{
    position: relative;
    width: auto;
    height: 90%;
  }

  .image-container img{
    object-fit: cover;
    width: 100%;
    height: 100%;
  }

  .image-container h1{
    position: absolute;
    bottom: 20px;
    left: 7px;
    background-color: #ffffff;
    font-size: 24px;
    font-weight: 700;
    padding: 5px;
  }

  .recipe-details {
    position: absolute;
    bottom: 6px;
    left: 7px;

    background-color: #ffffff;
    margin: 0;
    padding-inline: 5px;
    display: flex;
    flex-direction: row;
    align-items: center;
    width: auto;
  }

  .detail-text {
    margin: 0 10px 0 0;
    font-size: 12px;
    font-weight: 400;
    color: #9B9B9B;
  }

  .ingredient-text {
    margin: 0;
    font-size: 12px;
    font-weight: 400;
    color: #9B9B9B;
  }

  .relbar-container {
    margin-top: 10px;
  }

  .relbar {
    width: 100%;
    height: 7px;
    border-radius: 3px;
    box-shadow: 0 0 1px #656565;
  }

  .relbar-fill {
    height: 100%;
    border-radius: 3px;
    transition: background-color 0.3s ease;
  }

  .material-icons {
    font-size: 16px;
    color: #9B9B9B;
  }
</style>
