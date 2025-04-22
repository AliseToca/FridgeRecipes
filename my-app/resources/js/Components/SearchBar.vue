<template>
  <div class="search-bar">
    <input
      type="text"
      v-model="query"
      :placeholder="placeholder"
      @input="onSearch"
    />
    <button @click="onSearch">
      <span class="material-symbols-outlined">search</span>
    </button>
  </div>
</template>

<script>
export default {
  props: {
    placeholder: {
      type: String,
      default: 'Search recipes...',
    },
  },
  data() {
    return {
      query: '',
    };
  },
  methods: {
    onSearch() {
      this.$emit('search', this.query);
    },
  },
};
</script>

<style scoped>
.search-bar {
  display: flex;
  align-items: center;
  width: 100%;
  max-width: 600px;
  border: 1px solid #3a3a3a;
  border-radius: 3px;
  overflow: hidden; /* Makes button flush with input */
}

.search-bar input {
  flex: 1;
  padding: 12px;
  font-size: 16px;
  border: none;
  outline: none;
  box-sizing: border-box;
}

.search-bar button {
  height: 100%;
  aspect-ratio: 1/1;
  background-color: #f44040;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.search-bar button span {
  color: white;
  font-size: 24px;
}

/* Responsive tweaks */
@media (max-width: 600px) {
  .search-bar {
    max-width: 100%;
  }
}
</style>
