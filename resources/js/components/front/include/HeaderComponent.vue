<template>
  <span>
    <div class="header">
      <div class="header_top">
        <div class="container">
          <div class="logo">
            <router-link to="/">
              <span style="color:red">BIG</span>
              <span style="color:black">STORE</span>
            </router-link>
          </div>
          <ul class="shopping_grid">
            <a href="#">
              <li>Join</li>
            </a>
            <a href="login.html">
              <li>Sign In</li>
            </a>
            <router-link to="/cart">
              <li>
                <span class="m_1">Shopping Bag</span>&nbsp;&nbsp;(0) &nbsp;
                <img src="front/images/bag.png" alt />
              </li>
            </router-link>
            <div class="clearfix"></div>
          </ul>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="h_menu4">
        <!-- start h_menu4 -->
        <div class="container">
          <a class="toggleMenu" href="#">Menu</a>
          <ul class="nav">
            <li class="active">
              <router-link to="/" data-hover="Home">Home</router-link>
            </li>
            <li>
              <a href="about.html" data-hover="About Us">About Us</a>
            </li>
            <li>
              <a href="careers.html" data-hover="Careers">Careers</a>
            </li>
            <li>
              <a href="contact.html" data-hover="Contact Us">Contact Us</a>
            </li>
            <li>
              <a href="404.html" data-hover="Company Profile">Company Profile</a>
            </li>
            <li>
              <a href="register.html" data-hover="Company Registration">Company Registration</a>
            </li>
            <li>
              <a href="wishlist.html" data-hover="Wish List">Wish List</a>
            </li>
          </ul>
          <!-- <script type="text/javascript" src="front/js/nav.js"></script> -->
        </div>
        <!-- end h_menu4 -->
      </div>
    </div>
  </span>
</template>

<script>
export default {
  mounted() {
    console.log("Header Component mounted.");
  }
};
</script>
