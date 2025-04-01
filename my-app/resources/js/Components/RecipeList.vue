<!-- RecipeList.vue -->
<template>
  <div class="recipe-container">
    <RecipeItem
      v-for="recipe in filteredRecipes"
      :key="recipe.id"
      :id="recipe.id"
      :name="recipe.name"
      :minutes="recipe.minutes"
      :rating="recipe.rating"
      :ingredients="recipe.ingredients"
      :img="recipe.img"
    />
    <!-- Placeholder items to maintain grid layout -->
    <div
      v-for="n in emptySlots"
      :key="'placeholder-' + n"
      class="placeholder"
    ></div>
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
    emptySlots() {
      const totalItems = this.filteredRecipes.length;
      const slotsNeeded = totalItems % 4 === 0 ? 0 : 4 - (totalItems % 4);
      return slotsNeeded;
    },
  },
};
</script>

<style scoped>
.recipe-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  column-gap: 10px;
  row-gap: 25px;
  justify-items: center;
  padding: 20px;
  padding-left: 5px;
  min-height: 500px;
}

.placeholder {
  width: 300px;
  height: 350px;
  background: rgba(0, 0, 0, 0.05);
  border-radius: 8px;
}

@media (max-width: 1200px) {
  .recipe-container {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 900px) {
  .recipe-container {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 600px) {
  .recipe-container {
    grid-template-columns: 1fr;
  }
}
</style>

