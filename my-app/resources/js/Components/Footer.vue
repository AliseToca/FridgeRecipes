<template>
  <footer class="site-footer">
    <div class="footer-container">
      <div class="footer-logo">
        <h2>Fridge<span>Recipes</span></h2>
        <p>&copy; {{ new Date().getFullYear() }} Fridge Recipes. All rights reserved.</p>
      </div>

      <nav class="footer-links">
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/contact">Contact</a>
        <a href="/terms">Terms</a>
      </nav>
    </div>
  </footer>
</template>


<style scoped>
footer {
  width: 100%;
  background-color: #ffffff;
  border-top: 2px solid #f44040;
  padding: 25px;
  font-size: 14px;
  color: #333;
  margin-top: 40px;
}

.footer-container {
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
}

.footer-logo h2 {
  margin: 0 0 4px;
  color: #f44040;
  font-weight: 500;
  font-size: 20px;
  text-transform: uppercase;
}

.footer-logo span{
  margin: 0 0 8px;
  color: #000;
  font-size: 20px;
  text-transform: uppercase;
}

.footer-links {
  display: flex;
  gap: 6px;
}

.footer-links a {
  text-decoration: none;
  color: #333;
  transition: color 0.2s;
}

.footer-links a:hover {
  color: #f44040;
}
</style>
