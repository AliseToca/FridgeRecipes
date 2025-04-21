<template>
  <div class="fridge-sidebar">

    <h2>YOUR FRIDGE</h2>

    <div class="fridge-container">
      <!-- If not logged in -->
      <div v-if="!user">
        <p>Please <a href="/login" class="text-blue-500 underline">log in</a> to manage your fridge.</p>
      </div>

      <!-- If logged in -->
      <div v-else>
        <div class="ingredient-list" v-if="Object.keys(ingredientsByCategory).length">
          <div v-for="(ingredients, category) in ingredientsByCategory" :key="category" class="category-group">
            <h3 class="category-title">{{ category }}</h3>
            <ul>
              <li v-for="ingredient in ingredients" :key="ingredient.id">
                {{ ingredient.name }}
                <span v-if="ingredient.amount">({{ ingredient.amount }})</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="add-ingredient">
          <input
            v-model.trim="newIngredient"
            @keyup.enter="addIngredient"
            placeholder="Add an ingredient"
          />
          <input
            v-model.number="newAmount"
            type="number"
            min="0"
            step="any"
            placeholder="Amount (optional)"
          />
          <button @click="addIngredient">Add Ingredient</button>
          <p v-if="error" class="error">{{ error }}</p>
        </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

// Access global auth data
const page = usePage();
const user = computed(() => page.props.auth?.user);
const fridgeId = computed(() => user.value?.fridge?.id);


const fridgeIngredients = ref([]); 
const newIngredient = ref('');
const newAmount = ref(null); 
const error = ref(null); 


const ingredientsByCategory = computed(() => {
  const grouped = {};
  for (const ingredient of fridgeIngredients.value) {
    const categoryName = ingredient.category?.name || 'Uncategorized';
    if (!grouped[categoryName]) grouped[categoryName] = [];
    grouped[categoryName].push(ingredient);
  }
  return grouped;
});



function getFridgeIngredients() {
  axios
    .get(`/api/fridges/${fridgeId.value}/ingredients`)
    .then((response) => {
      fridgeIngredients.value = response.data.ingredients;
    })
    .catch((err) => {
      console.error('Failed to fetch ingredients:', err);
    });
}

function addIngredient() {
  error.value = null;

  if (!newIngredient.value) return; 

  // Make API request to add ingredient
  axios
    .post('/api/fridges/ingredient', {
      ingredients_name: newIngredient.value,
      fridges_id: fridgeId.value, // Use the correct fridge ID (you can bind this dynamically if needed)
      amount: newAmount.value,
    })
    .then((response) => {
      const ingredient = response.data.ingredient;

      if (!fridgeIngredients.value.some((i) => i.id === ingredient.id)) {
        fridgeIngredients.value.push(ingredient);
        console.log(ingredient);
      }

      newIngredient.value = '';
      newAmount.value = null;
    })
    .catch((err) => {
      if (err.response?.data?.message) {
        error.value = err.response.data.message;
      } else {
        error.value = 'Something went wrong. Please try again.';
      }
      console.error(err);
    });
}

onMounted(() => {
  if (user.value) {
    getFridgeIngredients();
  }
});

</script>


<style scoped>
.fridge-sidebar {
  position: sticky;
  top: 85px; 
  width: 30%;
  height: fit-content;
  height: calc(100vh - 85px); 
  background-color: #f4f4f4;
  padding: 15px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  flex-shrink: 0;

  display: flex;
  flex-direction: column;
  align-items: center;
}

.fridge-container {
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  padding: 10px;
  width: 100%;
  height: 70%;
  background-color: white;
  border-radius: 7px;
  text-transform: capitalize;
}

h2 {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 15px;
  color: #f44040;
  text-align: center;
}

.category-group {
  margin-bottom: 20px;
}

.category-title {
  font-size: 16px;
  font-weight: 600;
  color: #333;
  border-bottom: 1px solid #ccc;
  margin-bottom: 10px;
  padding-bottom: 5px;
}

.ingredient-list ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.ingredient-list li {
  padding: 6px 10px;
  background-color: #fff;
  margin-bottom: 6px;
  border-radius: 4px;
  border: 1px solid #ddd;
  font-size: 14px;
  display: flex;
  justify-content: space-between;
}

.add-ingredient {
  margin-top: 15px;
}

.add-ingredient input {
  padding: 5px;
  margin-right: 5px;
}

.add-ingredient button {
  padding: 5px 10px;
}

.error {
  color: red;
  margin-top: 5px;
}
</style>
