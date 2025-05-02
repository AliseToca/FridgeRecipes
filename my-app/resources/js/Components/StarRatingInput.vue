<template>
    <div class="star-rating">
      <span
        v-for="star in 5"
        :key="star"
        class="material-symbols-outlined"
        :class="{ filled: star <= modelValue, outlined: star > modelValue }"
        :style="{ fontSize: fontSize, cursor: 'pointer' }"
        @click="setRating(star)"
      >
        star
      </span>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      modelValue: Number,
      fontSize: {
        type: String,
        default: '16px'
      }
    },
    methods: {
      setRating(newRating) {
        this.$emit('update:modelValue', this.modelValue === newRating ? 0 : newRating);
      }
    }
  };
  </script>
  
  <style scoped>
  .material-symbols-outlined {
    font-variation-settings: 'FILL' 1;
  }

  .filled {
    color: #f44040;
  }
  .outlined {
    color: rgb(228, 210, 210);
  }
  </style>
  