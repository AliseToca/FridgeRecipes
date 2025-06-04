<template>
  <div class="relbar-container">
    <div class="relbar">
      <div
        class="relbar-fill"
        :style="{
          width: fillWidth + '%',
        }"
      ></div>
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
  computed: {
    fillWidth() {
      return this.percentage === 0 ? 1 : this.percentage;
    },
  },
};
</script>


<style scoped>
.relbar-container {
  position: absolute;
  bottom: 0; 
  left: 0;
  width: 100%;
  height: 100%; 
}

.relbar {
  width: 100%;
  height: 100%; 
  box-shadow: 0 0 1px #adadad;
}

.relbar-fill {
  height: 100%;
  background-color: #f4a261;
  transition: width 0.2s ease;
}
</style>
