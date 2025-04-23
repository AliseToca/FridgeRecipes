<template>
  <DefaultLayout>
    <div>
      <div class="main-container">
        <FridgeSidebar @toggle-fridge-filter="handleFridgeFilterToggle" />



        <div class="main-content">
          <div class="content-actions">
            <SearchBar @search="handleSearch" />
            <div class="temp-sort"></div>
          </div>

          <RecipeList :recipes="filteredRecipes" :searchQuery="searchQuery" />
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>


<script>
import SearchBar from '@/Components/SearchBar.vue';
import RecipeList from '@/Components/RecipeList.vue';
import FridgeSidebar from '@/Components/FridgeSideBar.vue'; 
import DefaultLayout from '../Layouts/DefaultLayout.vue';

export default {
  layout: DefaultLayout,

  components: {
    SearchBar,
    RecipeList,
    FridgeSidebar,
  },

  props: {
    auth: Object,
    recipes: Array,
  },

  data() {
    return {
      searchQuery: '',
      fridgeFilterEnabled: false, 
    };
  },

  computed: {
    filteredRecipes() {
      const recipesCopy = [...this.recipes];

      const fridgeIngredientIds = this.auth?.user?.fridge?.ingredients
        ? this.auth.user.fridge.ingredients.map(i => i.id)
        : [];

      // Attach match count to each recipe
      for (const recipe of recipesCopy) {
        recipe.matchCount = recipe.ingredients?.filter(ing =>
          fridgeIngredientIds.includes(ing.id)
        ).length || 0;
      }

      // Always apply name filter
      let result = recipesCopy.filter(recipe =>
        recipe.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );

      // If fridge toggle is ON → sort by matchCount DESC
      if (this.fridgeFilterEnabled) {
        result.sort((a, b) => b.matchCount - a.matchCount);
      }

      return result;
    }
  },
  methods: {
    handleSearch(query) {
      this.searchQuery = query;
    },
        handleFridgeFilterToggle(enabled) {
      this.fridgeFilterEnabled = enabled;
    },
  },
};
</script>

<style scoped>
.main-container {
  display: flex;
  align-items: flex-start;
}

.main-content {
  flex: 1;
}

.content-wrapper {
  padding: 30px;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.content-actions{
  padding: 20px;
  display: flex;
  justify-content: space-between;
}

/* .temp-sort{
  width: 10%;
  height: 50px;
  background-color: #ccc;
} */
</style>
