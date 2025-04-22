<template>
  <DefaultLayout>
    <div>
      <div class="main-container">
        <FridgeSidebar/>

        <div class="main-content">
          <div class="content-actions">
            <SearchBar></SearchBar>
            <div class="temp-sort"></div>
          </div>
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
