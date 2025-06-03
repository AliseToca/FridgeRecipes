<template>
    <Logo></Logo>

    <div class="background">
        <div class="wrapper">
            <slot></slot>
        </div>
    </div>

    <div class="overlay"></div>
</template>

<script>
    import Logo from "../Components/Logo.vue";

    export default {
        components: {
            Logo,
        },
    }
</script>

<style scoped>
 .logo{
    position: absolute;
    top: 0;
    left: 0;
    margin: 10px;
    margin-left: 20px;
    z-index: 2;
    padding-inline: 10px;
    background-color: #fafafa;
    border: 1px solid #3a3a3a;
    box-shadow: 7px 7px 0px 0px rgba(244,64,64,0.74);
 }

 .background {
    position: relative;
    background-image: url('/images/background-food.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh; 
    width: 100vw;  
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
    box-sizing: border-box;
 }

 .overlay{
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(82, 82, 82, 0.4); /* semi-transparent white */
  z-index: 1;

 }

 .wrapper {
    background-color: #fafafa;
    padding: 30px;
    border: 1px solid #3a3a3a;
    box-shadow:11px 11px 0px 0px rgba(244,64,64,0.74);
    color: #3a3a3a;
    
    max-width: 400px;
    width: 100%;
    z-index: 2;
}

.wrapper input{
    background-color: #f0f0f0;
}
</style>