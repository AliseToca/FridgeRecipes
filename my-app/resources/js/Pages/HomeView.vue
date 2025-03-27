<template>
  <div> 
    <Navbar @search="handleSearch" />
    <br />
    <br />
    <br />
    <br />
    <main>
      <RecipeList :recipes="filteredRecipes" :searchQuery="searchQuery" />
    </main>
    <Footer />
  </div>
</template>

<script>
import RecipeItem from '@/components/RecipeItem.vue';
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';
import SearchBar from '@/components/SearchBar.vue';
import RecipeList from '@/components/RecipeList.vue';

export default {
  components: {
    RecipeItem,
    Footer,
    Navbar,
    SearchBar,
    RecipeList,
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
 main {
   padding: 50px 50px 0 50px;
 }


</style>
