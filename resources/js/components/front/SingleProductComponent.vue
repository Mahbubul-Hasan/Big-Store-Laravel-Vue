<template>
  <span>
    <Header></Header>

    <div class="main">
        <div class="content_top">
            <div class="container">
                <Sidebar></Sidebar>

                <div class="col-md-9 single_right" id="toolbar-chat" ref="toolbarChat">
                    <div class="single_top">
                        <div class="single_grid row">
                            <div class="col-md-4 flexslider">
                                <ul class="slides">
                                    <li :data-thumb="getSingleProduct().photo">
                                        <div class="thumb-image">
                                            <img :src="getSingleProduct().photo" data-imagezoom="true" class="img-responsive" alt="" />
                                        </div>
                                    </li>

                                    <li :data-thumb="getSingleProduct().photo">
                                        <div class="thumb-image">
                                            <img :src="getSingleProduct().photo" data-imagezoom="true" class="img-responsive" alt="" />
                                        </div>
                                    </li>

                                    <li :data-thumb="getSingleProduct().photo">
                                        <div class="thumb-image">
                                            <img :src="getSingleProduct().photo" data-imagezoom="true" class="img-responsive" alt="" />
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="desc1 span_3_of_2 col-md-8">
                                <h1>{{ getSingleProduct().name }}</h1>
                                <p class="availability" v-if="getSingleProduct().stock">
                                    Availability:
                                    <span class="color">In stock</span>
                                </p>
                                <p class="availability" v-if="!getSingleProduct().stock">
                                    Availability:
                                    <span class="color">Stock Out</span>
                                </p>
                                <div class="price_single" v-if="getSingleProduct().offer_price == 0">
                                    <span class="actual">$120.00</span>
                                </div>
                                <div class="price_single" v-if="getSingleProduct().offer_price > 0">
                                    <span class="reducedfrom">BDT {{ getSingleProduct().price }}</span>
                                    <span class="actual">BDT {{ getSingleProduct().offer_price }}</span>
                                    <a href="#">click for offer</a>
                                </div>
                                <h2 class="quick">Quick Overview:</h2>
                                <p class="quick_desc">{{ getSingleProduct().short_description }}</p>

                                <!-- <ul class="size">
                                    <h3>Length</h3>
                                    <li>
                                        <a href="#">32</a>
                                    </li>
                                    <li>
                                        <a href="#">34</a>
                                    </li>
                                </ul> -->
                            <form @submit.prevent="addToCart(getSingleProduct().id)">
                                <div class="quantity_box">
                                    <ul class="product-qty">
                                        <span>Quantity:</span>
                                        <select v-model="form.quantity" name="quantity"
                                            :class="{ 'is-invalid': form.errors.has('quantity') }">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <has-error :form="form" field="quantity" style="color: red"></has-error>
                                    </ul>

                                    <div class="clearfix"></div>
                                </div>
                                <!-- <a href="reservation.html" title="Online Reservation"
                                    class="btn bt1 btn-primary btn-normal btn-inline" target="_self">Add to cart
                                </a> -->
                                <button type="submit" class="btn bt1 btn-primary btn-normal btn-inline">Add to cart</button>
                            </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="sap_tabs">
                        <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                            <ul class="resp-tabs-list">
                                <li class="resp-tab-item resp-tab-active" aria-controls="tab_item-0" role="tab">
                                    <span>Product Description</span>
                                </li>
                                <li class="resp-tab-item" aria-controls="tab_item-1" role="tab">
                                    <span>Additional Information</span>
                                </li>
                                <li class="resp-tab-item" aria-controls="tab_item-2" role="tab">
                                    <span>Reviews</span>
                                </li>
                                <div class="clear"></div>
                            </ul>
                            <div class="resp-tabs-container">
                                <h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0">
                                    <span class="resp-arrow"></span>Product Description
                                </h2>
                                <div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0"
                                    style="display:block">
                                    <div class="facts">
                                        <ul class="tab_list">
                                            <li>
                                                <a href="#">{{ getSingleProduct().long_description }}</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <h2 class="resp-accordion" role="tab" aria-controls="tab_item-1">
                                    <span class="resp-arrow"></span>Additional Information
                                </h2>
                                <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
                                    <div class="facts">
                                        <ul class="tab_list">
                                            <li>
                                                <a href="#">augue duis dolore te feugait nulla facilisi. Nam liber
                                                    tempor cum soluta nobis eleifend option congue nihil imperdiet
                                                    doming id quod mazim placerat facer possim assum. Typi non habent
                                                    claritatem insitam; est usus legentis in iis qui facit eorum
                                                    claritatem. Investigatione</a>
                                            </li>
                                            <li>
                                                <a href="#">claritatem insitam; est usus legentis in iis qui facit eorum
                                                    claritatem. Investigationes demonstraverunt lectores legere me lius
                                                    quod ii legunt saepius. Claritas est etiam processus dynamicus, qui
                                                    sequitur mutationem consuetudium lectorum. Mirum est notare quam
                                                    littera gothica</a>
                                            </li>
                                            <li>
                                                <a href="#">Mirum est notare quam littera gothica, quam nunc putamus
                                                    parum claram, anteposuerit litterarum formas humanitatis per seacula
                                                    quarta decima et quinta decima. Eodem modo typi, qui nunc nobis
                                                    videntur parum clari, fiant sollemnes in futurum.</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <h2 class="resp-accordion" role="tab" aria-controls="tab_item-2">
                                    <span class="resp-arrow"></span>Reviews
                                </h2>
                                <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
                                    <ul class="tab_list">
                                        <li>
                                            <a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                                                diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
                                                volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                                ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
                                                consequat</a>
                                        </li>
                                        <li>
                                            <a href="#">augue duis dolore te feugait nulla facilisi. Nam liber tempor
                                                cum soluta nobis eleifend option congue nihil imperdiet doming id quod
                                                mazim placerat facer possim assum. Typi non habent claritatem insitam;
                                                est usus legentis in iis qui facit eorum claritatem. Investigatione</a>
                                        </li>
                                        <li>
                                            <a href="#">claritatem insitam; est usus legentis in iis qui facit eorum
                                                claritatem. Investigationes demonstraverunt lectores leg</a>
                                        </li>
                                        <li>
                                            <a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum
                                                claram, anteposuerit litterarum formas humanitatis per seacula quarta
                                                decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                                clari, fiant sollemnes in futurum.</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top_grid2" v-if="relatedProducts().length > 1">
                        <h4 class="head"><span class="m_2">Related</span> Products Now</h4>
                        <div class="col-md-4 top_grid1-box1" style="margin-top: 20px; float:left" v-for="product in relatedProducts()" :key="product.id">
                            <router-link :to="`/singleProduct/${ product.id }`">
                                <div class="grid_1">
                                    <div class="b-link-stroke b-animate-go  thickbox">
                                        <img :src="product.photo" class="img-responsive" alt="" />
                                    </div>
                                </div>
                                <div class="grid_1 grid_2">
                                    <p>{{ product.name | shortLength(40, '...') }}</p>
                                </div>
                            </router-link>
                            <div class="grid_1 grid_2">
                                    <ul class="grid_2-bottom">
                                            <li class="grid_2-left">
                                                <p v-if="product.offer_price > 0">BDT {{ product.offer_price}}</p>
                                                <p v-if="product.offer_price === 0">BDT {{ product.price}}</p>
                                            </li>
                                            <li class="grid_2-right">
                                                <form @submit.prevent="addToCart(product.id)">
                                                    <input v-model="form.quantity" type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn bt1 btn-primary btn-normal btn-inline">Add to cart</button>
                                                </form>
                                            </li>
                                            <div class="clearfix"> </div>
                                    </ul>
                             </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</span>
</template>

<script>
import Header from "./include/HeaderComponent.vue";
import Sidebar from "./include/SidebarComponent.vue";

export default {
 data () {
    return {
      form: new Form({
        quantity: '1',
      })
    }
  },
  mounted() {
    console.log("Single Product Component mounted.");

    this.singleProductURL();
    this.$store.dispatch("relatedProducts", this.$route.params.id);
    this.$refs.toolbarChat.$el.scrollTop = 0
  },

  methods: {
      singleProductURL(){
          this.$store.dispatch("singleProduct", this.$route.params.id);
      },
      getSingleProduct(){
          return this.$store.getters.getSingleProduct
      },
      relatedProducts(){
          return this.$store.getters.getRelatedProducts
      },

      addToCart(id) {
        this.$Progress.start();
        this.form.post('/cart/'+id)
        .then(() => {
            this.form.reset ()
            const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
            });

            Toast.fire({
                    type: 'success',
                    title: 'Product successfully added into your cart'
            })
            this.$Progress.finish()
        })
        .catch(() => {
            this.$Progress.fail()
        })
    }
  },

  watch: {
      $route(to, from){
          this.singleProductURL();
      }
  },

  components: {
    Header,
    Sidebar
  }
};
</script>
