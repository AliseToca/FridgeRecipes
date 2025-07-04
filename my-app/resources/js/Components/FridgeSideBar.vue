<template>
  <div :class="['fridge-sidebar', { collapsed: !isExpanded }]">
    <div class="fridge-info" v-if="isExpanded">
      <h2><span class="material-symbols-outlined">grocery</span></h2>
      <div>
        <label class="switch">
          <input
            type="checkbox"
            :checked="useFridgeFilter"
            @change="toggleFridgeSearch"
          />
          <span class="slider"></span>
        </label>
        <p>Sort by <span>fridge ingredients</span></p>
      </div>
    </div>

    <div class="fridge-container" v-if="isExpanded">
      <div v-if="user">
        <div class="ingredient-list" v-if="Object.keys(ingredientsByCategory).length">
          <div
            v-for="(ingredients, category) in ingredientsByCategory"
            :key="category"
            class="category-group"
            :class="{ 'empty-category': ingredients.length === 0 }"
          >
            <h3 class="category-title"><span>{{ category }}</span></h3>
            <ul v-if="ingredients.length">
              <li v-for="ingredient in ingredients" :key="ingredient.id">
                {{ ingredient.name }}
                <span v-if="ingredient.amount">({{ ingredient.amount }})</span>
                <button @click="removeIngredient(ingredient)" class="remove-btn">
                  <span class="material-symbols-outlined">close</span>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="add-ingredient" v-if="user && isExpanded">
      <button @click="addIngredient">
        <span class="material-symbols-outlined">add_circle</span>
      </button>
      <input
        v-model.trim="newIngredient"
        @keyup.enter="addIngredient"
        placeholder="Add an ingredient"
      />
    </div>
  </div>

  <!-- Mobile toggle button (only visible on phones) -->
  <button class="mobile-toggle-btn" @click="isExpanded = !isExpanded">
    <span class="material-symbols-outlined">
      {{ isExpanded ? 'close' : 'grocery' }}
    </span>
  </button>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

const page = usePage();
const user = computed(() => page.props.auth?.user);
const fridgeId = computed(() => user.value?.fridge?.id);
const isExpanded = ref(true);

const fridgeIngredients = ref([]);
const categories = ref([]);

const newIngredient = ref('');
const newAmount = ref(null);
const error = ref(null);

const emits = defineEmits(['toggle-fridge-filter', 'ingredient-changed']);

const useFridgeFilter = ref(false);

function toggleFridgeSearch() {
  useFridgeFilter.value = !useFridgeFilter.value;
  emits('toggle-fridge-filter', useFridgeFilter.value);
}

const ingredientsByCategory = computed(() => {
  const grouped = {};

  for (const category of categories.value) {
    grouped[category.name] = [];
  }

  for (const ingredient of fridgeIngredients.value) {
    const categoryName = ingredient.category?.name || 'Other';
    if (!grouped[categoryName]) grouped[categoryName] = [];
    grouped[categoryName].push(ingredient);
  }

  return grouped;
});

function getFridgeIngredients() {
  axios
    .get(`/fridges/${fridgeId.value}/ingredients`)
    .then((response) => {
      fridgeIngredients.value = response.data.ingredients;
      categories.value = response.data.categories;
    })
    .catch((err) => {
      console.error('Failed to fetch ingredients:', err);
    });

  emits('ingredient-changed');
}

function addIngredient() {
  error.value = null;

  if (!newIngredient.value) return;

  axios.post('/fridges/ingredient', {
    ingredients_name: newIngredient.value,
    fridges_id: fridgeId.value,
    amount: newAmount.value,
  })
  .then(() => {
    getFridgeIngredients();
    emits('ingredient-changed');
    newIngredient.value = '';
    newAmount.value = null;
  })
  .catch((err) => {
    error.value = err.response?.data?.message || 'Something went wrong.';
    console.error(err);
  });
}

function removeIngredient(ingredient) {
  axios
    .delete(`/fridges/${fridgeId.value}/ingredient/${ingredient.id}`)
    .then(() => {
      getFridgeIngredients();
      emits('ingredient-changed');
    })
    .catch((err) => {
      console.error('Failed to remove ingredient:', err);
    });
}

onMounted(() => {
  getFridgeIngredients();
});
</script>

<style scoped>
.fridge-sidebar {
  transition: width 0.3s ease, transform 0.3s ease;
  position: sticky;
  top: 85px;
  width: 30%;
  height: calc(100vh - 85px);
  background-color: #fff;
  padding: 30px 20px 30px 30px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-right: 1px solid #3a3a3a;
  overflow: visible;
}

.fridge-sidebar.collapsed {
  width: 70px;
  padding: 30px 10px;
}

.fridge-info {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}

h2 span {
  font-size: 90px;
  font-weight: 300;
  padding-left: 10px;
  color: #585858;
  width: 50%;
  text-wrap: wrap;
}

.fridge-info div {
  display: flex;
  flex-direction: column;
  align-items: end;
}

.fridge-info div p {
  color: #3a3a3a;
  font-size: 13px;
}

.fridge-info div span {
  font-weight: 500;
}

/* Switch */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 34px;
  background-color: #ccc;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #f44040;
}

input:focus + .slider {
  box-shadow: 0 0 1px #f44040;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

.fridge-container {
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  padding: 15px;
  width: 100%;
  height: 70%;
  background-color: white;
  text-transform: capitalize;
}

.category-group {
  margin-bottom: 20px;
}

.category-title {
  width: 100%;
  text-align: left;
  border-bottom: 1px solid #f44040;
  color: #f44040;
  line-height: 0.1em;
  margin: 10px 0 20px;
}

.category-title span {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 10px;
  background: #fff;
  padding: 0 10px;
  margin-left: 7px;
  text-transform: uppercase;
}

.ingredient-list ul {
  list-style-type: square;
  margin: 0;
  padding-left: 15px;
}

.ingredient-list li {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 6px 10px;
  background-color: #fff;
  margin-bottom: 6px;
  font-size: 14px;
  color: #3a3a3a;
}

.empty-category {
  margin-bottom: 20px;
  min-height: 30px;
}

.remove-btn {
  background: none;
  border: none;
  color: #f44040;
  font-size: 24px;
  margin-left: 10px;
  cursor: pointer;
}

.add-ingredient {
  display: flex;
  align-items: center;
  margin-top: 30px;
}

.add-ingredient button {
  padding: 5px 10px;
}

.add-ingredient input {
  padding: 5px;
  margin-right: 5px;
  width: 10%;
}

.add-ingredient input:nth-child(2) {
  width: 40%;
}

.add-ingredient .material-symbols-outlined {
  color: #f44040;
  font-size: 32px;
  font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
}

/* --- MOBILE STYLES --- */
/* --- SMALL AND MEDIUM DEVICES (phones + iPads) --- */
.mobile-toggle-btn {
  display: none;
}

@media (max-width: 1024px) {
  .fridge-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100%;
    z-index: 1001;
    transform: translateX(-100%);
    transition: transform 0.3s ease;
    border-right: 2px solid #f44040;
    background-color: white;
  }

  .fridge-sidebar:not(.collapsed) {
    transform: translateX(0);
  }

  .mobile-toggle-btn {
    display: flex;
    position: fixed;
    top: 60px; /* moved lower */
    left: 5px;
    z-index: 1002;
    background-color: #ffffff;
    border: 2px solid #f44040;
    border-radius: 4px; /* square corners */
    width: 40px;
    height: 40px;
    align-items: center;
    justify-content: center;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
    cursor: pointer;
  }

  .mobile-toggle-btn .material-symbols-outlined {
    font-size: 28px;
    color: #f44040;
  }
}

</style>
