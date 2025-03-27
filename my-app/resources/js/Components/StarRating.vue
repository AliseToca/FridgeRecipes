<template>
    <div class="star-rating">
        <span
            v-for="star in 5"
            :key="star"
            class="material-symbols-outlined"
            :class="{
                 'filled': star <= rating,
                 'outlined': star > rating
            }"
            >
            star
        </span>
    </div>
</template>

<script>
    export default{
        props: {
            rating: Number
        },
        methods: {
            setRating(newRating){
                this.$emit('update:rating', newRating);
            }
        }
    }
</script>

<style scoped>

.material-symbols-outlined {
    font-size: 16px;
    font-variation-settings: 'FILL' 1, 'wght' 300, 'GRAD' 0, 'opsz' 24;
}

.filled{
    color: #FFE500;
}

.outlined{
    color: gray;
}

</style>