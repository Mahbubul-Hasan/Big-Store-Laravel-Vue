<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product List</h3>
                <div class="card-tools">
                    <button class="btn btn-success" @click="addProductModal" >Add Product</button>
                </div>
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
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
                                    <th>Code</th>
                                    <th>Price</th>
                                    <th>Offer Price</th>
                                    <th>Short Description</th>
                                    <th>Long Description</th>
                                    <th>Stock</th>
                                    <th>Popular</th>
                                    <th>Active</th>
                                    <th>Date / Time </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd" role="row" v-for="(product, index) in productList()">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <img :src="product.photo" :alt="product.name" width="80">
                                    </td>
                                    <td><span :title="product.name">{{ product.name | shortLength(20, "...")}}</span></td>
                                    <td>{{ product.category.name }}</td>
                                    <td>{{ product.code }}</td>
                                    <td>{{ product.price | currency}}</td>
                                    <td>{{ product.offer_price | currency}}</td>
                                    <td><span :title="product.short_description">{{ product.short_description | shortLength(45, "...")}}</span></td>
                                    <td><span :title="product.long_description">{{ product.long_description | shortLength(90, "...")}}</span></td>
                                    <td>{{ product.stock === 1 ? "In Stock" : "Stock Out"}}</td>
                                    <td>{{ product.popular === 1 ? "Yes" : "No" }}</td>
                                    <td>{{ product.created_at | time}}</td>
                                    <td>{{ product.active === 1 ? "Active" : "Inactive"}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" @click.prevent="editProductModal(product)"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" @click.prevent="deleteProduct(product.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SL. NO</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
                                    <th>Code</th>
                                    <th>Price</th>
                                    <th>Offer Price</th>
                                    <th>Short Description</th>
                                    <th>Long Description</th>
                                    <th>Stock</th>
                                    <th>Popular</th>
                                    <th>Active</th>
                                    <th>Date / Time </th>
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

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!editModal">Add Product</h5>
                        <h5 class="modal-title" v-if="editModal">Edit Product</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editModal ? updateProduct() : addProduct()" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name" placeholder="Name"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="custom-select" v-model="form.category_id">
                                <option value="" disabled>Select Category</option>
                                <option v-for="category in categoryList()" :value="category.id">{{ category.name }}</option>
                            </select>
                            <has-error :form="form" field="category_id"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Code</label>
                            <input v-model="form.code" type="text" name="code" placeholder="Product Code"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('code') }">
                            <has-error :form="form" field="code"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input v-model="form.price" type="text" name="price" placeholder="Product Price"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                            <has-error :form="form" field="price"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Offer Price (Optional)</label>
                            <input v-model="form.offer_price" type="text" name="offer_price" placeholder="Product Offer Price (Optional)"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('offer_price') }">
                            <has-error :form="form" field="offer_price"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea v-model="form.short_description" name="short_description" rows="3" placeholder="Product Short Description"
                                      class="form-control" :class="{ 'is-invalid': form.errors.has('short_description') }"></textarea>
                            <has-error :form="form" field="short_description"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Long Description</label>
                            <vue-editor v-model="form.long_description" name="long_description" placeholder="Product Long Description"
                                        :class="{ 'is-invalid': form.errors.has('long_description') }"></vue-editor>
                            <has-error :form="form" field="long_description"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Stock</label><br>

                            <input type="radio" value="1" v-model="form.stock">
                            <label>In Stock</label>

                            <input type="radio" value="0" v-model="form.stock">
                            <label>Stock Out</label>

                        </div>

                        <div class="form-group">
                            <label>Popular</label><br>

                            <input type="radio" value="1" v-model="form.popular">
                            <label>Yes</label>

                            <input type="radio" value="0" v-model="form.popular">
                            <label>No</label>

                        </div>

                        <div class="form-group">
                            <label>Active</label><br>

                            <input type="radio" value="1" v-model="form.active">
                            <label>Active</label>

                            <input type="radio" value="0" v-model="form.active">
                            <label>Inactive</label>

                        </div>


                        <div class="form-group">
                            <label>Product Photo</label><br>
                            <input type="file" name="photo" @change="uploadImage"
                                   :class="{ 'is-invalid': form.errors.has('photo') }">
                            <img v-if="form.photo != '' " :src="form.photo" :alt="form.name" width="80">
                            <has-error :form="form" field="photo"></has-error>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" v-if="!editModal">Add Product</button>
                        <button type="submit" class="btn btn-secondary" v-if="editModal">Update Product</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import { VueEditor } from 'vue2-editor';

    export default {

        data () {
            return {

                editModal: false,

                form: new Form({
                    id: '',
                    name: '',
                    category_id: '',
                    code: '',
                    price: '',
                    offer_price: '0.00',
                    short_description: '',
                    long_description: '',
                    stock: '1',
                    popular: '0',
                    active: '1',
                    photo: '',
                }),
            }
        },
        mounted() {
            console.log('Product Component mounted.');
            this.$store.dispatch("adminProduct");
            this.$store.dispatch("adminCategory");
        },

        methods: {
            productList(){
                return this.$store.getters.getProducts;
            },

            categoryList() {
                return this.$store.getters.getCategories;
            },

            addProductModal(){
                this.editModal = false,
                this.form.reset();
                $("#addProduct").modal("show");
            },
            editProductModal(product){
                this.editModal = true;
                this.form.reset();
                this.form.clear();
                $("#addProduct").modal("show");

                this.form.fill(product);
            },

            uploadImage(element){
                let file = element.target.files[0];
                let reader = new FileReader();
                if(file["size"] <= 2097152){
                    reader.onloadend = () => {
                        this.form.photo = reader.result;
                    };
                    reader.readAsDataURL(file);
                }
                else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Your File size more then 2MB',
                    })
                }
            },

            addProduct(){
                this.$Progress.start();
                this.form.post("/admin/products")
                    .then(() => {
                        $("#addProduct").modal("hide");

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });

                        Toast.fire({
                            type: 'success',
                            title: 'Product successfully added'
                        });

                        this.$store.dispatch("adminProduct");
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },

            updateProduct(){
                this.$Progress.start();
                this.form.put("/admin/products/"+this.form.id)
                    .then(() => {
                        $("#addProduct").modal("hide");

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });

                        Toast.fire({
                            type: 'success',
                            title: 'Product successfully updated'
                        });

                        this.$store.dispatch("adminProduct");
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },

            deleteProduct(id){
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
                        axios.delete("/admin/products/"+id)
                            .then(() => {
                                Swal.fire(
                                    'Deleted!',
                                    'Products has been deleted.',
                                    'success'
                                );

                                this.$store.dispatch("adminProduct");
                                this.$Progress.finish();
                            })
                            .catch(() => {
                                this.$Progress.fail();
                            })
                    }
                });
            }
        },

        components: {
            VueEditor
        },
    }
</script>
