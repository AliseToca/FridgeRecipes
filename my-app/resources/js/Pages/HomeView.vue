<template>
  <div class="home-wrapper">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-content-box">
        <h1 class="hero-title">Smarter cooking starts here.</h1>
        <p class="hero-description">
          No fancy groceries. No food waste. Just real meals based on what’s in your kitchen.<br>
          Punch in your ingredients and we’ll show you recipes that work.
        </p>
        <Link href="/recipes" class="cta-button">Find recipes</Link>
      </div>
    </section>

    <!-- Features -->
    <section class="feature-section">
      <h2>Why this works</h2>
      <ul class="features">
        <li>No signup needed</li>
        <li>Zero food waste</li>
        <li>Ingredient-based discovery</li>
        <li>Clean, fast UI</li>
      </ul>
    </section>

    <!-- How it works -->
    <section class="how-it-works">
      <h2>How it works</h2>
      <ol>
        <li>Type in the ingredients you already have.</li>
        <li>We match them with real recipes.</li>
        <li>You cook. You eat. You win.</li>
      </ol>
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

.hero-section {
  min-height: 100vh;
  background-image: url('/images/background-food4.jpg');
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
  padding: 2rem 5vw;
}

.hero-content-box {
  background: #fff;
  border: 1px solid #3a3a3a;
  box-shadow: 11px 11px 0px rgba(244, 64, 64, 0.74);
  padding: 40px;
  max-width: 500px;
  width: 100%;
  height: auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.hero-title {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  color: #1d1d1d;
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
  border-radius: 0;
  text-decoration: none;
  box-shadow: 3px 3px 0 black;
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
}
</style>
