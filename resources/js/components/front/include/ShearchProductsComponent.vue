<template>
  <span>
    <div class="column_center">
      <div class="container">
        <div class="search">
          <div class="stay">Search Product</div>
          <div class="stay_right">
            <input
              type="text"
              value
              onfocus="this.value = '';"
              onblur="if (this.value == '') {this.value = '';}"
            />
            <input type="submit" value />
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </span>
</template>

<script>
export default {
  mounted() {
    console.log("ShearchProducts Component mounted.");
  }
};
</script>
