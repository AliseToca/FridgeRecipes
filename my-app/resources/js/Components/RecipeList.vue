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
    recipes: Array,
    searchQuery: String,
  },
  computed: {
    filteredRecipes() {
      return this.recipes.filter((recipe) =>
        recipe.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
    // emptySlots() {
    //   const totalItems = this.filteredRecipes.length;
    //   const slotsNeeded = totalItems % 3 === 0 ? 0 : 3 - (totalItems % 4);
    //   return slotsNeeded;
    // },
  },
};
</script>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: all 0.3s ease;
}
.fade-slide-enter-from,
.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
.fade-slide-leave-from,
.fade-slide-enter-to {
  opacity: 1;
  transform: translateY(0);
}


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

