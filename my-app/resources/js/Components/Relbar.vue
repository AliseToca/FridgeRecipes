<template>
  <div class="relbar-container">
    <div class="relbar">
      <div
        class="relbar-fill"
        :style="{
          width: percentage + '%',
          backgroundColor: getColor(percentage)
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
      required: true
    }
  },
  methods: {
    getColor(percentage) {
      if (percentage < 30) {
        return '#e76f51'; // Red
      } else if (percentage < 70) {
        return '#f4a261'; // Orange
      } else {
        return '#4caf50'; // Green
      }
    }
  }
};
</script>

<style scoped>
.relbar-container {
  margin-top: 10px;
}

.relbar {
  width: 100%;
  height: 7px;
  border-radius: 3px;
  box-shadow: 0 0 1px #656565;
}

.relbar-fill {
  height: 100%;
  border-radius: 3px;
  transition: background-color 0.3s ease;
}
</style>