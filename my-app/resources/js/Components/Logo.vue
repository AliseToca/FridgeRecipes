<template>
    <div class="logo">
        <Link href="/">FRIDGE<span>RECIPES</span></Link>
    </div>
</template>

<script>
    import { Link } from "@inertiajs/vue3";

    export default {
        components: {
            Link,
        }
    }
</script>

<style scoped>
.logo a {
  font-weight: 600;
  font-size: 35px;
  color: #f44040;
}

.logo{
  margin-right: 20px;
}

.logo span{
  color: #000;
}
</style>