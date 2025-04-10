<template>
    <div class="fridge-sidebar">
      <div class="fridge-container">
        <h2>Your Fridge</h2>
          <div class="ingredient-list">
            <ul>
              <li v-for="ingredient in fridgeIngredients" :key="ingredient">{{ ingredient }}</li>
            </ul>
          </div>
          <div class="add-ingredient">
            <input v-model="newIngredient" @keyup.enter="addIngredient" placeholder="Add an ingredient" />
            <button @click="addIngredient">Add Ingredient</button>
          </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        fridgeIngredients: [], // List of ingredients in the fridge
        newIngredient: '', // New ingredient to add
      };
    },
    methods: {
      addIngredient() {
        if (this.newIngredient.trim()) {
          this.fridgeIngredients.push(this.newIngredient.trim());
          this.newIngredient = ''; // Clear input field after adding
        }
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
  