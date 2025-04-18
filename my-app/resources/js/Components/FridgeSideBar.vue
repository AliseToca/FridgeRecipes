<template>
  <div class="fridge-sidebar">
    <div class="fridge-container">
      <h2>Your Fridge</h2>

      <div class="ingredient-list">
        <ul>
          <li v-for="ingredient in fridgeIngredients" :key="ingredient.id">
            {{ ingredient.name }}
          </li>
        </ul>
      </div>

      <div class="add-ingredient">
        <input
          v-model="newIngredient"
          @keyup.enter="addIngredient"
          placeholder="Add an ingredient"
        />
        <button @click="addIngredient">Add Ingredient</button>
        <p v-if="error" class="error">{{ error }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'FridgeSidebar',
  props: {
    fridgesId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      fridgeIngredients: [], // List of ingredients in the fridge
      newIngredient: '',      // New ingredient to add
      error: null,            // Error message
    };
  },
  methods: {
    addIngredient() {
      this.error = null;

      const trimmed = this.newIngredient.trim();
      if (!trimmed) return; // Don't allow empty input

      // Make API request to add ingredient
      axios.post('/api/fridges/ingredient', {
        ingredients_name: trimmed,  // Ensure the correct parameter name
        fridges_id: this.fridgesId, // Correct prop usage
        })
        .then(response => {
          const ingredient = response.data.ingredient;  

          // Check if the ingredient exists in the fridge list before adding
          if (!this.fridgeIngredients.some(i => i.id === ingredient.id)) {
            this.fridgeIngredients.push(ingredient); 
            console.log(ingredient); // Use 'ingredient' here
          }

          // Reset the input field
          this.newIngredient = '';
        })
        .catch(error => {
          if (error.response && error.response.data && error.response.data.message) {
            this.error = error.response.data.message;
          } else {
            this.error = 'Something went wrong. Please try again.';
          }
          console.error(error);
        });
    },
  },
};
</script>
  
  <style scoped>
  .fridge-sidebar {
    display: flex;
    flex-direction: column;
    align-content: center;
    width: 40%;
    background-color: #f4f4f4;
    padding: 10px 5px 5px 5px;
    padding: 15px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  }
  
  .fridge-container{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 100%;
    background-color: rgb(255, 255, 255);
    border-radius: 2px;
  }

  h2 {
    align-self: center;
    margin-bottom: 10px;
  }
  
  .ingredient-list ul {
    list-style-type: none;
    padding: 0;
  }
  
  .ingredient-list li {
    margin: 5px 0;
  }
  
  .add-ingredient input {
    padding: 5px;
    margin-right: 5px;
  }
  
  .add-ingredient button {
    padding: 5px 10px;
  }
  </style>
  