<template>
  <nav>
    <div class="nav-content">
      <div class="logo">
        <a href="/">RecipeFridge</a>
      </div>
      <SearchBar @search="handleSearch" />
      <ul class="nav-links" :class="{ 'active': menuActive }">
        <li><a href="/">Recipes</a></li>
        <li><a href="/uhm">About</a></li>
        <li><a href="#">Skills</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <div class="hamburger" @click="toggleMenu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
    </div>
  </nav>
</template>

<script>
import SearchBar from './SearchBar.vue';

export default {
  components: {
    SearchBar,
  },
  data() {
    return {
      menuActive: false,
    };
  },
  methods: {
    handleSearch(query) {
      this.$emit('search', query);
    },
    toggleMenu() {
      this.menuActive = !this.menuActive;
    },
  },
};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  z-index: 1;
}

nav {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 20px;
  background-color: #ffffff; /* Change background to white */
  transition: all 0.4s ease;
  z-index: 10;
}

nav.sticky {
  padding: 15px 20px;
  background: #ffffff; /* Keep the sticky background white */
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

nav .nav-content {
  height: 100%;
  max-width: 1200px;
  margin: auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

nav .logo a {
  font-weight: 600;
  font-size: 35px;
  color: #000000; /* Keep the logo color black */
}

nav.sticky .logo a {
  color: #4070f4; /* Change logo color to blue on sticky */
}

.nav-content .nav-links {
  display: flex;
}

.nav-content .nav-links li {
  list-style: none;
  margin: 0 8px;
}

.nav-links li a {
  text-decoration: none;
  color: #0e2431; /* Dark text color */
  font-size: 18px;
  font-weight: 500;
  padding: 10px 4px;
  transition: all 0.3s ease;
}

.nav-links li a:hover {
  color: #f44040; /* Red hover color */
}

nav.sticky .nav-links li a {
  color: #0e2431; /* Dark text color on sticky */
}

nav.sticky .nav-links li a:hover {
  color: #4070f4; /* Blue hover color on sticky */
}

.hamburger {
  display: none;
  flex-direction: column;
  cursor: pointer;
  padding-right:20px;
}

.hamburger .bar {
  width: 30px;
  height: 4px;
  margin: 5px 0;
  background-color: #0e2431; /* Dark color for hamburger bars */
  transition: all 0.3s ease;
}

/* Responsive design */
@media (max-width: 900px) {
  .nav-content .nav-links {
    display: none;
    width: 100%;
    flex-direction: column;
    align-items: center;
    background-color: #ffffff; /* White background for mobile menu */
    position: absolute;
    top: 70px;
    left: 0;
    padding: 20px 0;
    z-index: 5;
  }

  .nav-content .nav-links.active {
    display: flex;
  }

  .nav-links li {
    margin: 10px 0;
  }

  .hamburger {
    display: flex;
  }
}
</style>
