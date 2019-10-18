<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">order List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap4" id="example1_wrapper">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="example1_length"><label>Show <select
                                aria-controls="example1"
                                class="custom-select custom-select-sm form-control form-control-sm"
                                name="example1_length">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries</label></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_filter" id="example1_filter"><label style="width: 100%">Search:<input
                                aria-controls="example1" class="form-control form-control-sm" placeholder=""
                                type="search"></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table aria-describedby="example1_info" class="table table-bordered table-striped dataTable"
                                   id="example1" role="grid">
                                <thead>
                                <tr role="row">
                                    <th>SL. NO</th>
                                    <th>Order ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Location</th>
                                    <th>Address</th>
                                    <th>Total Price</th>
                                    <th>Discount Price</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Date / Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd" role="row" v-for="(order, index) in orderList()">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ order.id }}</td>
                                    <td>{{ order.customer_name }}</td>
                                    <td>{{ order.customer_email }}</td>
                                    <td>{{ order.customer_phone }}</td>
                                    <td>{{ order.delivery == 50 ? "Inside Dhaka" : "Outside Dhaka" }}</td>
                                    <td>{{ order.customer_address }}</td>
                                    <td>{{ order.total_price | currency }}</td>
                                    <td>{{ order.discount_price | currency }}</td>
                                    <td>{{ order.payment_method }}</td>
                                    <td>{{ order.status }}</td>
                                    <td>{{ order.created_at | time }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" title="View Details"
                                                @click.prevent="viewOrderModal(order.id)"><i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm" title="Edit"
                                                @click.prevent="editOrderModal(order)"><i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" title="Delete"
                                                @click.prevent="deleteorder(order.id)"><i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SL. NO</th>
                                    <th>Order ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Location</th>
                                    <th>Address</th>
                                    <th>Total Price</th>
                                    <th>Discount Price</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Date / Time</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>

        <!--View Modal -->
        <div class="modal fade bd-example-modal-xl" id="viewOrderModal" tabindex="-1" role="dialog"
             aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ordered Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table aria-describedby="example1_info"
                                       class="table table-bordered table-striped dataTable"
                                       id="example1" role="grid">
                                    <thead>
                                    <tr role="row">
                                        <th>SL. NO</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr class="odd" role="row" v-for="(product, index) in OrderProducts">
                                        <td>{{ index+1 }}</td>
                                        <td>
                                            <img :src="product.product.photo" alt="" width="80">
                                        </td>
                                        <td>{{ product.product.name }}</td>
                                        <td>{{ product.product.code }}</td>
                                        <td>{{ price = product.product.offer_price > 0 ? product.product.offer_price :
                                            product.product.price | currency}}
                                        </td>
                                        <td>{{ quantity = product.quantity }}</td>
                                        <td>{{ price * quantity | currency}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="5"></td>

                                        <td> Sub Total</td>
                                        <td> {{ sub_Total = subTotal | currency }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="5"></td>

                                        <td> Tax</td>
                                        <td> {{ tax = subTotal * 0.15 | currency }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="5"></td>

                                        <td> Delivery Charge</td>
                                        <td> {{ deliveryC = delivery | currency }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="5"></td>

                                        <td><b>Grand Total</b></td>
                                        <td> {{ sub_Total + tax + deliveryC | currency }}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Edit Modal -->
        <div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ordered Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateProduct">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.customer_name" type="text" name="customer_name"
                                       placeholder="Category Name" disabled
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('customer_name') }">
                                <has-error :form="form" field="customer_name"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.customer_email" type="text" name="customer_email"
                                       placeholder="Category Name" disabled
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('customer_email') }">
                                <has-error :form="form" field="customer_email"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Phone Number</label>
                                <input v-model="form.customer_phone" type="text" name="customer_phone"
                                       placeholder="Category Name" disabled
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('customer_phone') }">
                                <has-error :form="form" field="customer_phone"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Location</label>
                                <select class="custom-select" v-model="form.delivery">
                                    <option value="" disabled>Select Your location</option>
                                    <option value="50.00">In side dhaka (50 TK)</option>
                                    <option value="100.00">Out side dhaka (100 TK)</option>
                                </select>

                                <has-error :form="form" field="delivery"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea v-model="form.customer_address" name="customer_address" rows="3"
                                          class="form-control"
                                          :class="{ 'is-invalid': form.errors.has('customer_address') }"></textarea>
                                <has-error :form="form" field="customer_address"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Total Price</label>
                                <input v-model="form.total_price" type="text" name="total_price"
                                       placeholder="Category Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('total_price') }">
                                <has-error :form="form" field="total_price"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Discount Price</label>
                                <input v-model="form.discount_price" type="text" name="discount_price"
                                       placeholder="Category Name" disabled
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('discount_price') }">
                                <has-error :form="form" field="discount_price"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Payment Method</label>
                                <input v-model="form.payment_method" type="text" name="payment_method"
                                       placeholder="Category Name" disabled
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('payment_method') }">
                                <has-error :form="form" field="payment_method"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="custom-select" v-model="form.status">
                                    <option value="" disabled>Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Success">Success</option>
                                </select>
                                <has-error :form="form" field="status"></has-error>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary">Update Order</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

    export default {

        data() {
            return {
                OrderProducts: [],
                delivery: 0,

                form: new Form({
                    id: '',
                    customer_name: '',
                    customer_email: '',
                    customer_phone: '',
                    customer_address: '',
                    total_price: '',
                    discount_price: '',
                    delivery: '',
                    payment_method: '',
                    status: '',
                })

            }
        },
        mounted() {
            console.log('order Component mounted.');
            this.$store.dispatch("adminOrder");
        },

        methods: {
            orderList() {
                return this.$store.getters.getOrders
            },

            viewOrderModal(id) {
                $("#viewOrderModal").modal("show");
                axios.get("/admin/orders/" + id)
                    .then(({data}) => {
                        this.OrderProducts = data.products;
                        this.delivery = Number(data.delivery.delivery);
                    })
            },

            editOrderModal(order) {
                $("#editOrderModal").modal("show");
                axios.get("/admin/orders/" + order.id + "/edit")
                    .then(({data}) => {
                        this.form.fill(data);
                    })

            },

            updateProduct() {
                this.$Progress.start();
                this.form.patch("/admin/orders/" + this.form.id)
                    .then(() => {
                        $("#editOrderModal").modal("hide");

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });

                        Toast.fire({
                            type: 'success',
                            title: 'Order successfully updated'
                        });

                        this.$store.dispatch("adminOrder");
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },

            deleteorder(id) {
                this.$Progress.start();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete("/admin/orders/" + id)
                            .then(() => {
                                Swal.fire(
                                    'Deleted!',
                                    'Order has been deleted.',
                                    'success'
                                );

                                this.$store.dispatch("adminOrder");
                                this.$Progress.finish();
                            })
                            .catch(() => {
                                this.$Progress.fail();
                            })
                    }
                })
            }
        },


        computed: {
            subTotal: function () {
                return this.OrderProducts.reduce(function (total, item) {
                    let price = item.product.offer_price > 0 ? item.product.offer_price : item.product.price;
                    return total + Number(price);
                }, 0);
            },
        }
    }
</script>
