<template>
  <div class="comment-container">
    <div class="profile-info">
      <img class="profile-image" :src="previewUrl" alt="Profile" />
      <div>
        <h3>{{ author }}</h3>
        <StarRatingDisplay :rating="starRating" :font-size="'15px'" />
      </div>

      <button
        v-if="canDelete"
        @click="$emit('delete', id)"
        class="delete-button"
        title="Delete Comment"
      >
        <span class="material-symbols-outlined">delete</span>
      </button>

    </div>

    <div class="content-container">
      <div class="content">
        <p>{{ content }}</p>
      </div>
      <p class="date">{{ formattedDate }}</p>
    </div>
  </div>
</template>

<script>
import StarRatingDisplay from '@/Components/StarRatingDisplay.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

dayjs.extend(relativeTime);

export default {
  props: {
    id: Number,
    image: String,
    author: String,
    starRating: Number,
    content: String,
    date: String,
    authUserId: Number,
    commentUserId: Number,
    authUserRole: String, 
  },
  components: {
    StarRatingDisplay,
  },
  computed: {
    formattedDate() {
      return dayjs(this.date).fromNow();
    },
    previewUrl() {
      return this.image
        ? `/storage/${this.image}`
        : '/images/profile-placeholder-square.png';
    },
    canDelete() {
      const isOwner = this.authUserId === this.commentUserId;
      const isAdmin = this.authUserRole === 'admin';
      return isOwner || isAdmin;
    }
  },
};
</script>

<style scoped>
.comment-container {
  margin-bottom: 1rem;
}

.profile-info {
  display: flex;
  align-items: center;
  gap: 10px;
}

.profile-info div {
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

.profile-info div h3 {
  font-weight: bold;
  margin: 0;
}

.delete-button {
  background: none;
  border: none;
  cursor: pointer;
  color: #d9534f;
}

.content {
  margin-top: 5px;
  margin-bottom: 5px;
}

.content p {
  font-size: 15px;
  margin: 0;
}

.date {
  font-size: 12px;
  color: #818181;
}
</style>
