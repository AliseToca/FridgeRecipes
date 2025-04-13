<template>
    <div class="star-rating">
      <span
        v-for="star in 5"
        :key="star"
        class="material-symbols-outlined"
        :class="{
          filled: star <= rating,
          outlined: star > rating
        }"
        :style="{ fontSize: fontSize }"
      >
        star
      </span>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      rating: Number,
      fontSize: {
        type: String,
        default: '16px' // You can use '1rem', '24px', etc.
      }
    },
    methods: {
      setRating(newRating) {
        this.$emit('update:rating', newRating);
      }
    }
  };
  </script>
  
  <style scoped>
  .star-rating{
    display: flex;
    flex-direction: row !important;
  }

  .material-symbols-outlined {
    font-variation-settings: 'FILL' 1;
  }
  
  .filled {
    color: #FFE500;
  }
  
  .outlined {
    color: gray;
  }
  </style>
  