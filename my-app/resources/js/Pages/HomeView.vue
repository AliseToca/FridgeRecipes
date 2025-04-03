<template>
  <div>
    <Navbar  :auth="auth" @search="handleSearch" />
    <div class="main-container">
      <!-- Sidebar with Fridge -->
      <FridgeSidebar />

      <!-- Main Content -->
      <div class="main">
        <RecipeList :recipes="filteredRecipes" :searchQuery="searchQuery" />
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import RecipeItem from '@/Components/RecipeItem.vue';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';
import SearchBar from '@/Components/SearchBar.vue';
import RecipeList from '@/Components/RecipeList.vue';
import FridgeSidebar from '@/Components/FridgeSideBar.vue'; // Import Fridge Sidebar

export default {
  components: {
    RecipeItem,
    Footer,
    Navbar,
    SearchBar,
    RecipeList,
    FridgeSidebar, // Add it here
  },
  props: {
    auth: Object, // Define the auth prop
  },
  data() {
    return {
      searchQuery: '',
      recipes: [
        { id: 1, name: 'Healthy Rich Salad', img: '/src/assets/images/salad.jpg', minutes: 12, rating: 3, ingredients: 6 },
        { id: 2, name: 'Butter chicken', img: '/src/assets/images/butter-chicken-test.jpg', minutes: 15, rating: 4, ingredients: 4 },
        { id: 3, name: 'Eggs and bacon', img: '/src/assets/images/bacon-and-eggs.jpg', minutes: 10, rating: 2, ingredients: 8 },
        { id: 4, name: 'Kikas special', img: '/src/assets/images/kika-special.jpg', minutes: 60, rating: 6, ingredients: 9 },
        { id: 5, name: 'Recipe A', img: '0', minutes: 0, rating: 0, ingredients: 0 },
        { id: 6, name: 'Recipe B', img: '0', minutes: 0, rating: 0, ingredients: 0 },
        { id: 7, name: 'Recipe C', img: '0', minutes: 0, rating: 0, ingredients: 0 },
      ],
    };
  },
  computed: {
    filteredRecipes() {
      return this.recipes.filter((recipe) =>
        recipe.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
  },
  methods: {
    handleSearch(query) {
      this.searchQuery = query;
    },
  },
};
</script>

<style scoped>
.main-container {
  display: flex;
  margin-top: 50px;
  padding: 50px;
  padding-left: 0;
}

.main {
  flex: 1;
  padding-left: 15px;
}

</style>
