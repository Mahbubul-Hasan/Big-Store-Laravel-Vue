<template>
  <span>
    <Header></Header>
    <div class="container">
      <div class="row" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span
                class="badge badge-secondary badge-pill">{{ Object.keys(getCartProducts().cartProducts).length }}</span>
          </h4>
          <ul class="list-group mb-3">
            <li
                :key="product.id"
                class="list-group-item d-flex justify-content-between lh-condensed"
                v-for="product in getCartProducts().cartProducts">
              <div>
                <h6 class="my-0">{{ product.name }}</h6>
                <small
                    class="text-muted">{{ product.attributes.short_description | shortLength(70, '...') }}</small>
              </div>
              <span class="text-muted">{{ product.price * product.quantity | currency }}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Sub Total:</span>
              <strong>{{ subTotal = getCartProducts().subTotal | currency }}</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Tax:</span>
              <strong>{{ tax = subTotal * 0.15 | currency }}</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Delivery Charge:</span>
              <strong>{{ delivery = Number(form.location) | currency }}</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>{{ subTotal + tax + delivery | currency}}</strong>
            </li>
          </ul>

          <form class="card p-2">
            <div class="input-group row">
              <div class="col-md-6">
                <input class="form-control" placeholder="Promo code" type="text"/>
              </div>
              <div class="col-md-6 input-group-append">
                <button class="btn btn-primary btn-block" type="submit">Redeem</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-8 order-md-1">
          <h3 class="mb-3">Billing address</h3>
          <form @submit.prevent="checkout" class="needs-validation">
            <div style="margin-bottom: 30px;">
              <label for="name">Name</label>
              <input :class="{ 'is-invalid': form.errors.has('customer_name') }" class="form-control" name="customer_name" placeholder="Your Name" type="text" v-model="form.customer_name"/>
              <has-error :form="form" field="customer_name" style="color: red"></has-error>
            </div>

            <div style="margin-bottom: 30px;">
              <label for="email">Email </label><span> (Optional)</span>
              <input :class="{ 'is-invalid': form.errors.has('customer_email') }" class="form-control" name="customer_email" placeholder="you@example.com" type="email" v-model="form.customer_email"/>
              <has-error :form="form" field="customer_email" style="color: red"></has-error>
            </div>

            <div style="margin-bottom: 30px;">
              <label for="email">Phone Number</label>
              <input :class="{ 'is-invalid': form.errors.has('customer_phone') }" class="form-control" name="customer_phone" placeholder="01*********" type="text" v-model="form.customer_phone"/>
              <has-error :form="form" field="customer_phone" style="color: red"></has-error>
              <div class="invalid-feedback">Please enter a valid phone number for shipping updates.</div>
            </div>

            <div style="margin-bottom: 30px;">
              <label>Delivery Charge</label>
              <br/>

              <input id="one" name="location" type="radio" v-model="form.location" value="50"/>
              <label for="one">In side dhaka (50 TK)</label>
              <input id="two" name="location" style="margin-left: 20px" type="radio" v-model="form.location" value="100"/>
              <label for="two">Out side dhaka (100 TK)</label>
            </div>

            <div style="margin-bottom: 30px;">
              <label for="address">Address</label>
              <textarea :class="{ 'is-invalid': form.errors.has('customer_address') }" class="form-control" name="customer_address" placeholder="Please enter your shipping address" rows="3" style="resize: vertical" v-model="form.customer_address"></textarea>
              <has-error :form="form" field="customer_address" style="color: red"></has-error>
            </div>

            <hr class="mb-4"/>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
          </form>
        </div>
      </div>
    </div>
  </span>
</template>

<script>
    import Header from "./include/HeaderComponent.vue";

    export default {
        mounted() {
            console.log("Cart Component mounted.");
            this.$store.dispatch("cartProducts");
        },

        data() {
            return {
                form: new Form({
                    customer_name: "",
                    customer_email: "",
                    customer_phone: "",
                    customer_address: "",
                    location: 50,
                })
            };
        },

        methods: {
            getCartProducts() {
                return this.$store.getters.getCartProducts;
            },

            checkout() {
                this.$Progress.start();
                this.form.post("/checkout")
                    .then(() => {
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
                        this.$Progress.finish();
                        this.$router.push("/");
                    })
                    .catch(() => {
                        this.$Progress.fail()
                    })
            }
        },

        components: {
            Header
        }
    };
</script>
