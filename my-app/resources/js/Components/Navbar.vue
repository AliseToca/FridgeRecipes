<template>
  <nav>
    <div class="nav-content">
      <Logo />

      <ul class="nav-links" :class="{ active: menuActive }">
        <li><Link href="/">Home</Link></li>
        <li><Link href="/recipes">Recipes</Link></li>
        <li v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'">
            <Link href="/users">Users</Link>
        </li>
        
        <li v-if="user">
          <Link href="/profile">
            <span class="material-icons">account_circle</span>
          </Link>
        </li>
        <li v-else>
          <button class="login-button">
            <Link href="/login">LOG IN</Link>
          </button>
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
import { computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import Logo from './Logo.vue';

export default {
  components: {
    Logo,
    Link,
  },

  data() {
    return {
      menuActive: false,
    };
  },

  computed: {
    user() {
      return usePage().props.auth?.user;
    },
  },

  methods: {
    toggleMenu() {
      this.menuActive = !this.menuActive;
    },
  },

  mounted() {
    this.menuActive = false;
  },
};
</script>



<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  z-index: 4;
}

nav {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 85px;
  padding: 20px 50px 20px 50px;
  background-color: #ffffff;
  border-bottom: 2px solid #f05c5c;
}


nav .nav-content {
  height: 100%;
  width: 100%;
  margin: auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.nav-content .nav-links {
  display: flex;
  align-items: center;
}

.nav-content .nav-links li {
  list-style: none;
  margin: 0 8px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.nav-links li a {
  display: flex;
  align-items: center;
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

.material-icons {
  font-size: 48px;
  color: #f13535;
}

/*----Mobile nav----*/
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

.login-button {
  display:flex;
  justify-content: center;
  align-items: center;
  background-color: #f44040;
  border-radius: 2px;
  padding: 5px ;
  width: 100px;
  height: 45px;
  cursor: pointer;
}

.login-button a{
  color: #ffffff !important;
  text-transform: uppercase;
}

.login-button:hover{
  background-color: #d32f2f;
  
}

.login-button a:hover{
  color: #ebebeb;
}

/*---Responsive design---*/
@media (max-width: 900px) {
  nav{
    padding-inline: 10px;
  }

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

.login-btn {
  padding: 8px;
  background: #f44040;
  color: white;
  border-radius: 5px;
  transition: 0.3s;
}
.login-btn:hover {
  background: #d32f2f;
}
</style>
