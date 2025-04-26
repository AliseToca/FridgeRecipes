<template>
  <div class="relbar-container">
    <div class="relbar">
      <div
        class="relbar-fill"
        :style="{
          width: percentage + '%',
        }">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    percentage: {
      type: Number,
      required: true,
    },
  },
};
</script>

<style scoped>
.relbar-container {
  position: absolute;
  bottom: 0; /* Position it at the bottom of the .recipe-item */
  left: 0;
  width: 100%;
  height: 100%; /* 5% height of the parent .recipe-item */
}

.relbar {
  width: 100%;
  height: 100%; /* Fill the container */
  border-radius: 1px;
  box-shadow: 0 0 1px #adadad;
}

.relbar-fill {
  height: 100%; /* Fill the entire height of the .relbar */
  border-radius: 1px;
  background-color: #f4a261;
  transition: width 0.2s ease;
}
</style>
