<template>
    <span>
        <Header></Header>
        <div class="container">
			<div style="margin-top: 30px;" v-if="Object.keys(getCartProducts().cartProducts).length === 0">
				<div class="alert alert-warning" role="alert">
					<h4>Your cart is empty</h4>
				</div>
			</div>
			<div class="table-responsive" style="margin-top: 30px;"
                 v-if="Object.keys(getCartProducts().cartProducts).length !== 0">
	        	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>

                        <tr v-for="product in getCartProducts().cartProducts" :key="product.id">
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img :src="product.attributes.photo"
                                                                         :alt="product.name"
                                                                         class="img-responsive"/></div>
									<div class="col-sm-10">
										<h3 class="nomargin">{{ product.name | shortLength(30, '...') }}</h3>
										<p>{{ product.attributes.short_description | shortLength(70, '...') }}</p>
									</div>
								</div>
							</td>
							<td data-th="Price">{{ price = product.price | currency}}</td>

							<td data-th="Quantity">
								<form class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="quantity" class="form-control text-center" style="height: 40px;" disabled
                                            :value="quantity = product.quantity">
                                    </div>
                                    <div class="col-md-6" style="padding-left: 0; padding-right: 0; margin-top: -8px;">
                                        <button @click.prevent="updateQuantity(product.id, Number(product.quantity), 'add')" class="btn" style="width: 20px; height: 20px; padding: 0"><b>+</b></button><br>
                                        <button @click.prevent="updateQuantity(product.id, Number(product.quantity), 'sub')" class="btn" style="width: 20px; height: 20px; padding: 0"><b>-</b></button>
                                    </div>
								</form>
							</td>

							<td data-th="Subtotal" class="text-center">{{ price * quantity | currency}}</td>
							<td class="actions" data-th="">
								<button @click.prevent="remove(product.id)" class="btn btn-danger btn-sm"
                                        style="color: white">Remove</button>
							</td>
						</tr>

						<tr>
							<td colspan="3"></td>
							<td class="hidden-xs text-center"><strong>Total: {{ subTotal = getCartProducts().subTotal | currency }}</strong></td>
							<td class="actions" data-th="">
								<button @click.prevent="remove()" class="btn btn-danger btn-sm" style="color: white">Remove All</button>
							</td>
						</tr>

					</tbody>

					<tfoot>
						<tr>
							<td><router-link to="/" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</router-link></td>
							<td colspan="3" class="hidden-xs"></td>
							<td><router-link to="/checkout" class="btn btn-success btn-block">Checkout <i
                                class="fa fa-angle-right"></i></router-link></td>
						</tr>
					</tfoot>

				</table>
			</div>
        </div>
    </span>
</template>

<script>
    import Header from "./include/HeaderComponent.vue"

    export default {
        data() {
            return {
                form: new Form({
                    quantity: ''
                })
            }
        },
        mounted() {
            console.log('Cart Component mounted.');
            this.$store.dispatch("cartProducts");
        },

        methods: {
            getCartProducts() {
                return this.$store.getters.getCartProducts;
            },

            updateQuantity(id, quantity, operation) {
                this.$Progress.start();
                switch (operation) {
                    case "add":
                        console.log("add");
                        console.log(quantity);
                        // this.form.reset();
                        this.form.quantity = quantity + 1;
                        console.log(this.form.quantity);
                        break;

                    case "sub":
                        console.log("sub");
                        console.log(quantity);
                        // this.form.reset();
                        this.form.quantity = quantity - 1;
                        console.log(this.form.quantity);
                        break;
                }

                 this.form.post("/cartUpdate/" + id);
                 this.$store.dispatch("cartProducts");
                //     .then(() => {
                //         this.$store.dispatch("cartProducts");
                //         const Toast = Swal.mixin({
                //             toast: true,
                //             position: 'top-end',
                //             showConfirmButton: false,
                //             timer: 5000
                //         });
                //
                //         Toast.fire({
                //             type: 'success',
                //             title: 'Your quantity has been updated'
                //         });
                //
                //         this.$Progress.finish();
                //     })
                //     .catch(() => {
                //         this.$Progress.fail();
                //     });
            },

            remove(id) {
                this.$Progress.start();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Remove it!'
                }).then((result) => {
                    if (result.value) {
                        if (id) {
                            axios.delete("/cartRemove/" + id)
                                .then(() => {
                                    Swal.fire(
                                        'Removed!',
                                        'Product is remove from your cat',
                                        'success'
                                    );
                                    this.$store.dispatch("cartProducts");
                                    this.$Progress.finish();
                                })
                                .catch(() => {
                                    this.$Progress.fail();
                                });
                        } else {
                            axios.delete("/cartRemoveAll")
                                .then(() => {
                                    Swal.fire(
                                        'Removed!',
                                        'Product is remove from your cat',
                                        'success'
                                    );
                                    this.$store.dispatch("cartProducts");
                                    this.$Progress.finish();
                                })
                                .catch(() => {
                                    this.$Progress.fail();
                                });
                        }

                    }
                })
            },
        },

        components: {
            Header
        }
    }
</script>
