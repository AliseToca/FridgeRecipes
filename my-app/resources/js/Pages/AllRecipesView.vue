<template>
  <DefaultLayout>
    <LoadingOverlay :show="isLoading" message="Updating fridge..." />

    <div class="main-container">
      <FridgeSidebar
        v-if="user"
        @toggle-fridge-filter="handleFridgeFilterToggle"
        @ingredient-changed="handleIngredientChanged"
      />

      <GuestFridge v-else />

      <div class="main-content">
        <div class="content-actions">
          <SearchBar @search="handleSearch" />

          <div class="multi-select-dropdown">
            <button @click="toggleDropdown" class="dropdown-button">
              Filter by
              <span class="material-symbols-outlined">
                {{ isOpen ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}
              </span>
            </button>

            <div v-if="isOpen" class="dropdown-menu">
              <label
                v-for="category in categories"
                :key="category.id"
                class="dropdown-item"
              >
                <input
                  type="checkbox"
                  :value="category.name"
                  v-model="selectedCategories"
                />
                {{ category.name }}
              </label>
            </div>
          </div>
        </div>

        <RecipeList
          :key="recipes.length"
          :recipes="filteredRecipes"
          :searchQuery="searchQuery"
          @update-save-state="handleSaveStateChange"
        />
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
import LoadingOverlay from '@/Components/LoadingOverlay.vue';
import GuestFridge from '@/Components/GuestFridge.vue';

export default {
  layout: DefaultLayout,

  components: {
    SearchBar,
    RecipeList,
    FridgeSidebar,
    LoadingOverlay,
    GuestFridge,
  },

  props: {
    auth: Object,
    recipes: Array,
    categories: Array,
  },

  data() {
    return {
      searchQuery: '',
      selectedCategories: [],
      fridgeFilterEnabled: false,
      isOpen: false,
      isLoading: false,
    };
  },

  computed: {
    user() {
      return this.auth?.user;
    },
    filteredRecipes() {
      let recipes = [...this.recipes];
      const fridgeIngredientIds = this.auth?.user?.fridge?.ingredients?.map(i => i.id) || [];

      recipes.forEach(recipe => {
        recipe.matchCount = recipe.ingredients?.filter(ing =>
          fridgeIngredientIds.includes(ing.id)
        ).length || 0;
      });

      if (this.searchQuery.trim()) {
        recipes = recipes.filter(recipe =>
          recipe.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }

      if (this.selectedCategories.length > 0) {
        recipes = recipes.filter(recipe => {
          const recipeCategoryNames = recipe.categories?.map(cat => cat.name) || [];
          return this.selectedCategories.every(selected =>
            recipeCategoryNames.includes(selected)
          );
        });
      }

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
      this.isLoading = true;
      try {
        const response = await axios.get(`/fridges/${this.auth.user.fridge.id}/ingredients`);
        this.auth.user.fridge.ingredients = response.data.ingredients;
      } catch (error) {
        console.error('Failed to refresh fridge ingredients:', error);
      } finally {
        this.isLoading = false;
      }
    },

    handleSaveStateChange({ recipeId, isSaved }) {
      const index = this.recipes.findIndex(r => r.id === recipeId);
      if (index !== -1) {
        this.recipes[index].saved = isSaved;
      }
    },
    removeRecipeSavedFlag(event) {
    const recipeId = event.detail;
    this.recipes = this.recipes.map(recipe =>
      recipe.id === recipeId ? { ...recipe, saved: false } : recipe
    );
  },

    toggleDropdown() {
      this.isOpen = !this.isOpen;
    },

    handleClickOutside(event) {
      const dropdown = this.$el.querySelector('.multi-select-dropdown');
      if (dropdown && !dropdown.contains(event.target)) {
        this.isOpen = false;
      }
    },
  },

  mounted() {
    window.addEventListener('recipe-unsaved', this.removeRecipeSavedFlag);
  },
  beforeUnmount() {
    window.removeEventListener('recipe-unsaved', this.removeRecipeSavedFlag);
  },
};
</script>

<style scoped>

.main-container {
  display: flex;
  align-items: flex-start;
  padding-right: 50px;
}

.main-content {
  flex: 1;
}

.content-actions {
  padding: 20px;
  display: flex;

  align-items: center;
}

.multi-select-dropdown {
  position: relative;
  width: 200px;
  font-family: sans-serif;
}

.dropdown-button {
  width: 100%;
  height: 50px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 12px;
  font-size: 16px;
  color: #5c5b5b;
  background-color: #fff;
  border: 1px solid #585858;
  border-radius: 1px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.dropdown-button:hover {
  background-color: #f5f5f5;
}

.dropdown-menu {
  position: absolute;
  width: 100%;
  margin-top: 4px;
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  max-height: 180px;
  overflow-y: auto;
  z-index: 1000;
}

.dropdown-item {
  display: flex;
  align-items: center;
  padding: 8px 12px;
  font-size: 14px;
  cursor: pointer;
}

.dropdown-item:hover {
  background-color: #f0f0f0;
}

.dropdown-item input[type="checkbox"] {
  margin-right: 8px;
}

.material-symbols-outlined.icon {
  font-size: 20px;
}

@media (max-width: 768px) {
  .content-actions {
    flex-direction: column;
    align-items: stretch;
    gap: 12px;
  }

  .multi-select-dropdown,
  .dropdown-button {
    width: 100%;
  }
}

@media (max-width: 1024px){
  .multi-select-dropdown{
    margin-left: 15px;
  }
}
</style>
