<template>
  <div class="recipe-container" v-if="filteredRecipes.length > 0">
    <RecipeItem
      v-for="recipe in filteredRecipes"
      :key="recipe.id"
      :id="recipe.id"
      :name="recipe.name"
      :minutes="recipe.cookMinutes"
      :rating="recipe.rating"
      :ingredients="recipe.ingredients.length"
      :userHasIngredients="recipe.matchCount || 0"
      :img="recipe.img"
      :slug="recipe.slug"
      :saved="recipe.saved"
      @update-save-state="updateSavedStatus"
    />
  </div>

  <div v-else class="no-recipes-message">
    <img src="/images/no-content.png" alt="">
    <p>{{ noRecipesMessage }}</p>
  </div>
</template>

<script>
import RecipeItem from '@/Components/RecipeItem.vue';

export default {
  components: {
    RecipeItem,
  },
  props: {
    recipes: {
      type: Array,
      default: () => [],
    },
    searchQuery: {
      type: String,
      default: '',
    },
    noRecipesMessage: {
      type: String,
      default: 'No recipes found.',
    },
  },
  computed: {
    filteredRecipes() {
      return this.recipes.filter((recipe) => {
        return recipe?.name?.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    },
  },
  methods: {

    updateSavedStatus(event) {
      this.$emit('update-save-state', event); // pass up to Profile.vue
    }
  

  }
};
</script>


<style scoped>
.recipe-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  column-gap: 25px;
  row-gap: 25px;
  justify-items:  start; 
  padding: 20px;
  padding-left: 25px;
  min-height: 500px;
}

.no-recipes-message{
  display: flex;
  align-items: center;
  flex-direction: column;
  padding: 20px;
  padding-left: 25px;
  width: 100%;
  min-height: 500px;
}

.no-recipes-message img{
  width: 30%;
  aspect-ratio: 1/1;
}

@media (max-width: 1200px) {
  .recipe-container {
    grid-template-columns: repeat(2, 1fr);
    width: 100%;
  }
}

@media (max-width: 900px) {
  .recipe-container {
    grid-template-columns: repeat(2, 1fr);
    width: 100%;
  }
}

@media (max-width: 600px) {
  .recipe-container {
    grid-template-columns: 1fr;
    width: 100%;
  }
}
</style>

