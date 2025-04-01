<template>
  <nav :class="{ sticky: isSticky }">
    <div class="nav-content">
      <div class="logo">
        <Link href="/">FridgeRecipes</Link>
      </div>
      <SearchBar @search="handleSearch" />
      <ul class="nav-links" :class="{ active: menuActive }">
        <li><Link href="/Homeview">Recipes</Link></li>
        <li><Link href="/fridge">Fridge</Link></li>
        <li><Link href="/uhm">About</Link></li>
        <li><Link href="/services">Services</Link></li>
        <li>
          <Link href="/login">
            <span class="material-icons">account_circle</span>
          </Link>
        </li>
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
import { Link } from "@inertiajs/vue3";
import SearchBar from "./SearchBar.vue";

export default {
  components: {
    Link,
    SearchBar,
  },
  data() {
    return {
      menuActive: false,
      isSticky: false,
    };
  },
  methods: {
    handleSearch(query) {
      this.$emit("search", query);
    },
    toggleMenu() {
      this.menuActive = !this.menuActive;
    },
    handleScroll() {
      this.isSticky = window.scrollY > 50;
    },
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
  },
  beforeUnmount() {
    window.removeEventListener("scroll", this.handleScroll);
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
  background-color: #ffffff;
  transition: all 0.4s ease;
  z-index: 10;
}

nav.sticky {
  padding: 15px 20px;
  background: #ffffff;
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

.material-icons {
  font-size: 32px;
}

nav .logo a {
  font-weight: 600;
  font-size: 35px;
  color: #000000;
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
  color: #0e2431;
  font-size: 18px;
  font-weight: 500;
  padding: 0 5px;
  transition: all 0.3s ease;
}

.nav-links li a:hover {
  color: #f44040;
}

.hamburger {
  display: none;
  flex-direction: column;
  cursor: pointer;
  padding-right: 20px;
}

.hamburger .bar {
  width: 30px;
  height: 4px;
  margin: 5px 0;
  background-color: #0e2431;
  transition: all 0.3s ease;
}

/* Responsive design */
@media (max-width: 900px) {
  .nav-content .nav-links {
    display: none;
    width: 100%;
    flex-direction: column;
    align-items: center;
    background-color: #ffffff;
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
