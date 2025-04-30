<template>
    <div class="comment-container">
        <div class="profile-info">
            <img class="profile-image" :src="image" alt="Profile"/>

            <div>
                <h3>{{author}}</h3>
                <StarRating :rating="starRating" :font-size="'15px'"/>
            </div>
        </div>
        
        <div class="content-container">
            <div class="content">
                <p>{{content}}</p>
            </div>
            <p class="date">{{date}}</p>
        </div>

        
    </div>
</template>

<script>
import StarRating from '@/Components/StarRating.vue';

export default {
 props:{
    image: String,
    author: String,
    starRating: Number,
    content: String,
    date: String,
 },

 components: {
    StarRating,
 },
}
</script>

<style scoped>

.profile-info{
    display: flex;
    gap: 10px;
}

.profile-info div{
    font-size: 15px;
    margin-bottom: 5px;
}

.profile-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.profile-info div h3{
    font-weight: bold;
}

.content{
    margin-bottom: 5px;
}

.content p{
    font-size: 15px;
}

.date{
    font-size: 12px;
    color: #818181;
}

</style>