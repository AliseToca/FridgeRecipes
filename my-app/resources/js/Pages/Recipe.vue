<template>
        <div class="recipe-container">
            <div class="short-info">
                <div>
                    <h1>{{ recipe.name }}</h1>
                    <p class="author">Author: will be name</p>
                    <p>{{recipe.content}}</p>
                    <StarRating :rating="recipe.rating" :font-size="'32px'" class="star-rating"/>
                </div>
                <img :src="recipe.img" alt="Recipe Image" class="recipe-image" />
            </div>

            <br>
            <div class="recipe-info">
            <p><strong>Cooking Time:</strong> {{ recipe.minutes }} minutes</p>
            </div>


            <div class="recipe-section">
                <h2 class="section-title">Ingredients</h2>

                <ul class="ingredient-list">
                <li
                    v-for="(ingredient, index) in recipe.ingredients"
                    :key="index"
                    class="ingredient-item"
                    :class="{ checked: checkedIngredients[index] }"
                    >
                    <label>
                        <input type="checkbox" v-model="checkedIngredients[index]" />
                        <span class="ingredient-text">{{ ingredient }}</span>
                    </label>
                </li>
                </ul>
            </div>

            <div class="recipe-section">
            <h2 class="section-title">Instructions</h2>
            <p>{{ recipe.instructions }}</p>
            </div>

            <div class="recipe-section">
            <h2 class="section-title">Reviews</h2>
            <p>No reviews yet. Be the first to leave a review!</p>
            </div>
        </div>
</template>
  
<script setup>
    import { defineProps } from 'vue';
    import DefaultLayout from '../Layouts/DefaultLayout.vue';
    import StarRating from '@/Components/StarRating.vue';
    import { ref, watch, onMounted } from 'vue'

    const props = defineProps({
        recipe: Object,
        auth: Object,
    });

    defineOptions({
        layout: DefaultLayout
    });


    const checkedIngredients = ref([])
        
    onMounted(() => {
        checkedIngredients.value = props.recipe.ingredients.map(() => false)
    })


</script>


<style scoped>
 .recipe-container {
    border: 2px solid #fcdcdc;
    padding: 20px;
    max-width: 800px;
    margin: 0 auto;
  }

 .short-info{
    display: flex;
    justify-content: center;
 }


 .short-info > div{
 
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-right: 20px;
      
 }

 .short-info  h1{
    font-size: 32px;
    font-weight: bold;
 }

 .short-info p{
    margin-bottom: 10px;
 }

 .star-rating{
    margin-bottom: 5px;
 }
.short-info img {
    aspect-ratio: 1 / 1;
    width: 30%;
    max-width: 30%;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}


.ingredient-list {
  list-style: none;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.ingredient-item {


  display: flex;
  align-items: center;

  transition: background-color 0.2s, color 0.2s;
}

/* INGREDIENTS U DONT HAVE WILL BE MARKED WITH THIS
.ingredient-item.checked {
  background-color: #fcdcdc;
} */

.ingredient-item input[type='checkbox'] {
  margin-right: 12px;
  transform: scale(1.2);
  cursor: pointer;
}

.ingredient-item .ingredient-text {
  font-size: 16px;
  transition: text-decoration 0.2s;
}

.ingredient-item.checked .ingredient-text {
  text-decoration: line-through;
  color: gray;
}


.recipe-info {
    margin-bottom: 20px;
    font-size: 1rem;
}

.recipe-section {
    margin-bottom: 30px;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.ingredient-list {
    padding-left: 20px;
    list-style-type: disc;
}

</style>
  