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
      // if (percentage < 30) {
      //   return '#e76f51'; // Red
      // } else if (percentage < 70) {
      //   return '#f4a261'; // Orange
      // } else {
      //   return '#4caf50'; // Green
      // }
      return '#f4a261';
    }
  }
};
</script>

<style scoped>

.relbar {
  width: 100%;
  height: 10px;
  border-radius: 1px;
  box-shadow: 0 0 1px #adadad;
}

.relbar-fill {
  height: 100%;
  border-radius: 1px;
  transition: background-color 0.3s ease;
}

</style>