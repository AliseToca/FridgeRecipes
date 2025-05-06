<template>
  <DefaultLayout>
    <div class="main-container">
      <FridgeSidebar
        @toggle-fridge-filter="handleFridgeFilterToggle"
        @ingredient-changed="handleIngredientChanged"
      />

      <div class="main-content">
        <div class="content-actions">
          <SearchBar @search="handleSearch" />

          <select v-model="selectedCategory" class="category-filter">
            <option value="">All Categories</option>
            <option v-for="category in categories" :key="category.id" :value="category.name">
              {{ category.name }}
            </option>
          </select>
        </div>

        <RecipeList :recipes="filteredRecipes" :searchQuery="searchQuery" />
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
    categories: Array,
  },

  data() {
    return {
      searchQuery: '',
      selectedCategory: '',
      fridgeFilterEnabled: false,
    };
  },

  computed: {
    filteredRecipes() {
      let recipes = [...this.recipes];

      const fridgeIngredientIds = this.auth?.user?.fridge?.ingredients?.map(i => i.id) || [];

      // Add match count for sorting
      recipes.forEach(recipe => {
        recipe.matchCount = recipe.ingredients?.filter(ing => fridgeIngredientIds.includes(ing.id)).length || 0;
      });

      // Search filter
      if (this.searchQuery.trim()) {
        recipes = recipes.filter(recipe =>
          recipe.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }

      // Category filter
      if (this.selectedCategory) {
        recipes = recipes.filter(recipe =>
          recipe.categories?.some(cat =>
            cat.name.toLowerCase() === this.selectedCategory.toLowerCase()
          )
        );
      }


      // Sort by fridge match count
      if (this.fridgeFilterEnabled) {
        recipes.sort((a, b) => b.matchCount - a.matchCount);
      }

      return recipes;
    },
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
        this.auth.user.fridge.ingredients = response.data.ingredients;
      } catch (error) {
        console.error('Failed to refresh fridge ingredients:', error);
      }
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

.category-filter {
  border: 1px solid #3a3a3a;
  border-radius: 3px;
  padding: 7px 10px;
  background-color: white;
  color: #3a3a3a;
}

.category-filter option{
  text-transform: capitalize;
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
