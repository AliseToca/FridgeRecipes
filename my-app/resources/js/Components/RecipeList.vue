<!-- RecipeList.vue -->
<template>
  <div class="recipe-container">
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
      />
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
      default: () => [], // Ensure the recipes array is always initialized as an empty array
    },
    searchQuery: {
      type: String,
      default: '',  // default empty string if not passed
    },
  },
  computed: {
    filteredRecipes() {
      // Log the first recipe item to inspect its structure
      console.log('First recipe:', this.recipes[0]);

      return this.recipes.filter((recipe) => {
        console.log('Checking recipe:', recipe); // Log each individual recipe

        // Ensure that 'recipe' and 'name' are defined
        if (recipe && recipe.name) {
          return recipe.name.toLowerCase().includes(this.searchQuery.toLowerCase());
        }

        console.log('Skipping recipe due to missing name:', recipe); // Log if name is missing
        return false;  // Return false if recipe or name is missing
      });
    },
  },

};
</script>

<style scoped>
.recipe-container {
  width: 93%;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  column-gap: 25px;
  row-gap: 25px;
  justify-items: center;
  padding: 20px;
  padding-left: 25px;
  min-height: 500px;
}

/* .placeholder {
  aspect-ratio: 4 / 5;
  width: 100%;
  max-width: 250px;
  background: rgba(0, 0, 0, 0.05);
  border-radius: 8px;
} */

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

