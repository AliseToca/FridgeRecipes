<template>
  <div class="home-wrapper">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-content-box">
        <h1 class="hero-title">SEARCH WITH YOUR <span>FRIDGE INGREDIENTS</span></h1>
        <p class="hero-description">
          Stock your virtual fridge with ingredients you already have, and we'll serve up recipes that match!
          Save money, cut waste, and discover what you can cook right now - no extra shopping needed.
        </p>
        <Link href="/recipes" class="cta-button">FIND RECIPES</Link>
      </div>
      <a href="#features" class="scroll-down">
        <span class="material-symbols-outlined" font-size="40px">keyboard_arrow_down</span>
      </a>
    </section>

    <!-- Step 1: Add to fridge -->
    <section id="features" class="feature-section">
      <div class="step-content icon-left">
        <span class="material-symbols-outlined step-icon">kitchen</span>
        <div class="step-text">
          <h2>Add What You Have</h2>
          <p>Use your virtual fridge to add ingredients you already own. The more you add, the better it matches.</p>
        </div>
      </div>
    </section>

    <!-- Step 2: Search, filter, sort -->
    <section class="feature-section">
      <div class="step-content icon-right">
        <div class="step-text">
          <h2>Search & Sort</h2>
          <p>Find what works for you. Have a personal experience with our many options: sorting by your fridge ingredient match, filtering by recipe categoriesand searching up yourself.</p>
        </div>
        <span class="material-symbols-outlined step-icon">manage_search</span>
      </div>
    </section>

    <!-- Step 3: Save recipes -->
    <section class="feature-section">
      <div class="step-content icon-left">
        <span class="material-symbols-outlined step-icon">bookmark</span>
        <div class="step-text">
          <h2>Save Your Favorites</h2>
          <p>Bookmark recipes you love or want to try later. View them in your profile later!</p>
        </div>
      </div>
    </section>

    <!-- Step 4: Cook and enjoy -->
    <section class="feature-section">
      <div class="step-content icon-right">
        <div class="step-text">
          <div>
            <h2>Cook & Enjoy</h2>
            <p>Follow clear instructions and enjoy meals made from what you already had. Smart, simple, satisfying.</p>
          </div>
          <Link href="/recipes" class="cta-button">TRY IT</Link>
        </div>
        <span class="material-symbols-outlined step-icon">restaurant</span>
      </div>
    </section>
  </div>
</template>


<script>
import DefaultLayout from '../Layouts/DefaultLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
  layout: DefaultLayout,
  components: { Link },
};
</script>

<style scoped>
.home-wrapper {
  width: 100%;
  margin: 0;
  padding: 0;
}
.scroll-down {
  position: absolute;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  color: #000000;
  cursor: pointer;
  animation: bounce 2s infinite;
  text-decoration: none;
}

@keyframes bounce {
  0%, 100% { transform: translateX(-50%) translateY(0); }
  50% { transform: translateX(-50%) translateY(10px); }
}

#features{
  padding-top: 150px;
}

.hero-section {
  position: relative;
  background-image: url('/images/background-food4.jpg');
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
  height: 80vh;
  max-height: 700px;
  padding: 1rem 5vw;
}

.hero-content-box {
  background: #fff;
  border: 1px solid #3a3a3a;
  box-shadow: 11px 11px 0px rgba(244, 64, 64, 0.74);
  padding: 40px;
  max-width: 500px;
  max-height: 900px;
  width: 100%;

  display: flex;
  flex-direction: column;
  justify-content: center;
}

.hero-title {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  color: #1d1d1d;
}

.hero-title span{
  font-weight: bold;
}

.hero-description {
  font-size: 1.1rem;
  line-height: 1.6;
  margin-bottom: 2rem;
  color: #3a3a3a;
}

.cta-button {
  background-color: #f44040;
  color: white;
  padding: 0.75rem 2rem;
  font-weight: bold;
  border: none;
  border-radius: 2px;
  text-decoration: none;
  transition: background-color 0.2s ease;
  display: inline-block;
  width: fit-content;
}


.cta-button:hover {
  background-color: #d32e2e;
}

/* Feature Section */
.feature-section {
  background: #fff;
  padding: 60px 5vw;
  border-top: 1px solid #3a3a3a;
}

.feature-section h2 {
  text-transform: uppercase;
  font-weight: 500;
  font-size: 2rem;
  margin-bottom: 20px;
  color: #1d1d1d;
}

.features {
  list-style: square;
  padding-left: 1rem;
  font-size: 1rem;
  line-height: 1.8;
}

/* How It Works */
.how-it-works {
  background: #f9f9f9;
  padding: 60px 5vw;
  border-top: 1px solid #3a3a3a;
}

.how-it-works h2 {
  font-size: 2rem;
  margin-bottom: 20px;
  color: #1d1d1d;
}

.how-it-works ol {
  padding-left: 1.2rem;
  font-size: 1rem;
  line-height: 1.8;
}

.step-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
  max-width: 1000px;
  margin: 0 auto;
}


.step-text {
  flex: 1;
}

.step-text div{
  margin-bottom: 20px;
}
.step-text h2 {
  font-size: 1.8rem;
  margin-bottom: 10px;
  color: #1d1d1d;
}

.step-text p {
  font-size: 1.1rem;
  line-height: 1.6;
  color: #3a3a3a;
}

.step-icon {
  font-size: 300px;
  color: #f44040;
  flex-shrink: 0;
}
/* Responsive */
@media (max-width: 768px) {
  .hero-section {
    padding: 2rem;
  }

  .hero-content-box {
    padding: 20px;
    box-shadow: 8px 8px 0px rgba(244, 64, 64, 0.74);
  }

  .hero-title {
    font-size: 2rem;
  }

  .hero-description {
    font-size: 1rem;
  }

  .feature-section,
  .how-it-works,
  .footer-note {
    padding: 40px 2rem;
  }

  .step-icon {
    font-size: 100px;
    color: #f44040;
    flex-shrink: 0;
  }
}
</style>
