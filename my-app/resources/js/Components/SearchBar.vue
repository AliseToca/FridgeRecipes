<template>
  <div class="search-bar">
    <input
      type="text"
      v-model="query"
      :placeholder="placeholder"
      @input="onSearch"
    />
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
  justify-content: center;
  width: 100%;
  padding: 10px;
}

.search-bar input {
  width: 100%;
  max-width: 500px; /* Max width to prevent it from growing too large */
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box; /* Ensures padding doesn't affect width */
}

/* Optional: Add focus effect */
.search-bar input:focus {
  border-color: #4070f4;
  outline: none;
}

/* Responsive styling */
@media (max-width: 600px) {
  .search-bar input {
    max-width: 90%; /* Allows the input to be more flexible on small screens */
  }
}
</style>
