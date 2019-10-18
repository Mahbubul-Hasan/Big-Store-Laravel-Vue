<template>
  <span>

    <Header></Header>
    <Slider></Slider>
    <ShearchProducts></ShearchProducts>

    <div class="main">
        <div class="content_top">
            <div class="container">

                <Sidebar></Sidebar>
                <div class="col-md-9 content_right" v-if="!categoryProducts">
                    <div class="top_grid2" v-if="Object.keys(offerProducts()).length != 0">
                        <h4 class="head"><span class="m_2">Offer</span> Products Now</h4>
                        <div :key="offer.id" class="col-md-4 top_grid1-box1" style="margin-top: 20px"
                             v-for="offer in offerProducts()">
                            <router-link :to="`/singleProduct/${ offer.id }`">
                                <div class="grid_1">
                                    <div class="b-link-stroke b-animate-go  thickbox">
                                        <img :src="offer.photo" alt="" class="img-responsive"/>
                                        </div>
                                    <div class="grid_1 grid_2">
                                        <p>{{ offer.name | shortLength(40, '...')  }}</p>
                                    </div>
                                </div>
                            </router-link>
                            <div class="grid_1 grid_2">
                                    <ul class="grid_2-bottom">
                                            <li class="grid_2-left">
                                                <p v-if="offer.offer_price > 0">BDT {{ offer.offer_price}}</p>
                                                <p v-if="offer.offer_price === 0">BDT {{ offer.price}}</p>
                                            </li>
                                            <li class="grid_2-right">
                                                <form @submit.prevent="addToCart(offer.id)">
                                                    <input name="quantity" type="hidden" v-model="form.quantity"
                                                           value="1">
                                                    <button class="btn bt1 btn-primary btn-normal btn-inline"
                                                            type="submit">Add to cart</button>
                                                </form>
                                            </li>
                                            <div class="clearfix"> </div>
                                    </ul>
                             </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="top_grid2" v-if="Object.keys(popularProducts()).length !== 0">
                        <h4 class="head"><span class="m_2">Popular</span> Products Now</h4>
                        <div :key="popular.id" class="col-md-4 top_grid1-box1" style="margin-top: 20px"
                             v-for="popular in popularProducts()">
                            <router-link :to="`/singleProduct/${ popular.id }`">
                                <div class="grid_1">
                                    <div class="b-link-stroke b-animate-go  thickbox">
                                        <img :src="popular.photo" alt="" class="img-responsive"/> </div>
                                    <div class="grid_1 grid_2">
                                        <p>{{ popular.name | shortLength(40, '...') }}</p>
                                    </div>
                                </div>
                            </router-link>
                            <div class="grid_1 grid_2">
                                    <ul class="grid_2-bottom">
                                            <li class="grid_2-left">
                                                <p v-if="popular.offer_price > 0">BDT {{ popular.offer_price}}</p>
                                                <p v-if="popular.offer_price === 0">BDT {{ popular.price}}</p>
                                            </li>
                                            <li class="grid_2-right">
                                                <form @submit.prevent="addToCart(popular.id)">
                                                    <input name="quantity" type="hidden" v-model="form.quantity"
                                                           value="1">
                                                    <button class="btn bt1 btn-primary btn-normal btn-inline"
                                                            type="submit">Add to cart</button>
                                                </form>
                                            </li>
                                            <div class="clearfix"> </div>
                                    </ul>
                             </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>


                    <div class="top_grid2" v-if="Object.keys(products()).length !== 0">
                        <h4 class="head"><span class="m_2">All</span> Products Now</h4>
                        <div :key="product.id" class="col-md-4 top_grid1-box1" style="margin-top: 20px; float:left"
                             v-for="product in products()">
                            <router-link :to="`/singleProduct/${ product.id }`">
                                <div class="grid_1">
                                    <div class="b-link-stroke b-animate-go  thickbox">
                                        <img :src="product.photo" alt="" class="img-responsive"/> </div>
                                    <div class="grid_1 grid_2">
                                        <p>{{ product.name | shortLength(40, '...') }}</p>
                                    </div>
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
                                                    <input name="quantity" type="hidden" v-model="form.quantity"
                                                           value="1">
                                                    <button class="btn bt1 btn-primary btn-normal btn-inline"
                                                            type="submit">Add to cart</button>
                                                </form>
                                            </li>
                                            <div class="clearfix"> </div>
                                    </ul>
                             </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>

                <div class="col-md-9 content_right" v-if="categoryProducts">
                    <div :key="category.id" class="top_grid2" v-for="category in products()">
                        <h4 class="head">
                            <span class="m_2">{{ category.name }}</span>
                        </h4>
                        <div :key="product.id" class="col-md-4 top_grid1-box1" style="margin-top: 20px"
                             v-for="product in category.products">
                            <router-link :to="`/singleProduct/${ product.id }`">
                                <div class="grid_1">
                                    <div class="b-link-stroke b-animate-go  thickbox">
                                        <img :src="product.photo" alt="" class="img-responsive"/> </div>
                                    <div class="grid_1 grid_2">
                                        <p>{{ product.name | shortLength(40, '...')  }}</p>
                                    </div>
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
                                                    <input name="quantity" type="hidden" v-model="form.quantity"
                                                           value="1">
                                                    <button class="btn bt1 btn-primary btn-normal btn-inline"
                                                            type="submit">Add to cart</button>
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
    import Header from "./include/HeaderComponent.vue"
    import Slider from "./include/SliderComponent.vue"
    import ShearchProducts from "./include/ShearchProductsComponent.vue"
    import Sidebar from "./include/SidebarComponent.vue"

    export default {
        data() {
            return {
                categoryProducts: false,
                form: new Form({
                    quantity: '1',
                })
            }
        },

        mounted() {
            console.log("Home Component mounted.");
            this.productsURL();
        },

        components: {
            Header,
            Slider,
            ShearchProducts,
            Sidebar
        },

        methods: {
            productsURL() {
                if (!this.$route.params.id) {
                    this.categoryProducts = false;
                    this.$store.dispatch("products");
                } else {
                    this.categoryProducts = true;
                    this.$store.dispatch("categoryProducts", this.$route.params.id)
                }
            },
            offerProducts() {
                return this.$store.getters.getOfferProducts
            },
            popularProducts() {
                return this.$store.getters.getPopularProducts
            },
            products() {
                return this.$store.getters.getProducts
            },
            addToCart(id) {
                this.$Progress.start();
                this.form.post('/cart/' + id)
                    .then(() => {
                        if (id) {
                            this.form.reset();
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });

                            Toast.fire({
                                type: 'success',
                                title: 'Product successfully added into your cart'
                            });
                            this.$Progress.finish()
                        }
                    })
                    .catch(() => {
                        this.$Progress.fail()
                    })
            }
        },
        watch: {
            $route(to, from) {
                this.productsURL();
            }
        }
    };
</script>
