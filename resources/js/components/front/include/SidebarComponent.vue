<template>
  <span>
    <div class="col-md-3 sidebar_box">
      <div class="sidebar">
        <div class="menu_box">
          <h3 class="menu_head">Products Menu</h3>
          <ul class="menu">
            <li class="item1" v-for="category in getCategories()">
              <router-link :to="`/categoryProducts/${category.id}`">
                <img class="arrow-img" src="front/images/f_menu.png" alt />
                {{ category.name }}
              </router-link>
            </li>
          </ul>
        </div>
        <!--initiate accordion-->
      </div>
      <div class="delivery">
        <img src="front/images/delivery.jpg" class="img-responsive" alt />
        <h3>Delivering</h3>
        <h4>World Wide</h4>
      </div>
      <div class="twitter">
        <h3>Latest From Twitter</h3>
        <ul class="twt1">
          <i class="twt"></i>
          <li class="twt1_desc">
            <span class="m_1">@Contrary</span> to popular belief, Lorem Ipsum
            is
            <span class="m_1">not simply</span>
          </li>
          <div class="clearfix"></div>
        </ul>
        <ul class="twt1">
          <i class="twt"></i>
          <li class="twt1_desc">
            <span class="m_1">There are many</span> variations of passages of
            Lorem Ipsum available, but the majority
            <span class="m_1">have suffered</span>
          </li>
          <div class="clearfix"></div>
        </ul>
        <ul class="twt1">
          <i class="twt"></i>
          <li class="twt1_desc">
            <span class="m_1">Lorem Ipsum</span> is simply dummy text of the
            printing and typesetting industry. Lorem Ipsum has
            <span class="m_1">
              been the industry's
              standard dummy text ever
            </span>
          </li>
          <div class="clearfix"></div>
        </ul>
      </div>
      <div class="clients">
        <h3>Our Happy Clients</h3>
        <h4>
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
          laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
          architecto beatae.
        </h4>
        <ul class="user">
          <i class="user_icon"></i>
          <li class="user_desc">
            <a href="#">
              <p>John Doe, Company Info</p>
            </a>
          </li>
          <div class="clearfix"></div>
        </ul>
      </div>
    </div>
  </span>
</template>

<script>
export default {

  mounted() {
    console.log("Sidebar Component mounted.");

    this.$store.dispatch("categories")
  },

  methods: {
    getCategories()
    {
      return this.$store.getters.getCategories;
    }
  }
};
</script>
