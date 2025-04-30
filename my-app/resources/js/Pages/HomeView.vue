<template>
  <DefaultLayout>
    <div>
      <div class="main-container">
        <FridgeSidebar @toggle-fridge-filter="handleFridgeFilterToggle" @ingredient-changed="handleIngredientChanged" />

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
import axios from 'axios';
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
      filterKey: 0, 
    };
  },

  computed: {
    filteredRecipes() {
      const recipesCopy = [...this.recipes];

      const fridgeIngredientIds = this.auth?.user?.fridge?.ingredients
        ? this.auth.user.fridge.ingredients.map(i => i.id)
        : [];

      for (const recipe of recipesCopy) {
        recipe.matchCount = recipe.ingredients?.filter(ing =>
          fridgeIngredientIds.includes(ing.id)
        ).length || 0;
      }

      let result = recipesCopy.filter(recipe =>
        recipe.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );

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

    async handleIngredientChanged() {
      try {
        const response = await axios.get(`/fridges/${this.auth.user.fridge.id}/ingredients`);
        this.auth.user.fridge.ingredients = response.data.ingredients; // update ingredients
      } catch (error) {
        console.error('Failed to refresh fridge ingredients:', error);
      }
    }
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

.sorting{
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 1px solid #3a3a3a;
  border-radius: 3px;
  width: 200px;
  padding: 7px 10px 7px 10px;
  color: #9B9B9B;
  margin-right: 7%;
}
/* .temp-sort{
  width: 10%;
  height: 50px;
  background-color: #ccc;
} */
</style>
