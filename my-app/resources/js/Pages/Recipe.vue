<template>
    <div class="p-4">
      <h1 class="text-2xl font-bold mb-4">{{ recipe.name }}</h1>
      <img :src="recipe.img" alt="" class="w-full max-w-md mb-4">
      <p><strong>Cooking Time:</strong> {{ recipe.minutes }} minutes</p>
      <p><strong>Rating:</strong> {{ recipe.rating }}</p>
      <!-- Add other recipe details here -->
    </div>
  </template>
  
  <script setup>
  defineProps({
    recipe: Object
  });
  </script>