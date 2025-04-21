<template>
<DefaultLayout>
  <div>
    <div class="main-container">
      <FridgeSidebar/>

      <div class="main">
        <RecipeList :recipes="recipes" :searchQuery="searchQuery" />
      </div>
    </div>
  </div>
</DefaultLayout>
</template>

<script>
  import SearchBar from '@/Components/SearchBar.vue';
  import RecipeList from '@/Components/RecipeList.vue';
  import FridgeSidebar from '@/Components/FridgeSideBar.vue'; 
  import DefaultLayout from '../Layouts/DefaultLayout.vue'

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
    align-items: flex-start;
    /* padding-inline: 50px; */
  }

  .main {
    flex: 1;
  }

</style>
