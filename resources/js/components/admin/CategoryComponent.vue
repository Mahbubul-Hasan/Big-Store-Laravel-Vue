<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List</h3>
                <div class="card-tools">
                    <button class="btn btn-success" @click="addCategoryModal">Add Category
                    </button>
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
                                    <th>Name</th>
                                    <th>Active</th>
                                    <th>Date / Time </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd" role="row" v-for="(category, index) in categoryList()">
                                    <td class="sorting_1">{{ index+1 }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.active == 1 ? "Active": "Inactive" }}</td>
                                    <td>{{ category.created_at | time}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" @click.prevent="editCategoryModal(category)"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" @click.prevent="deleteCategory(category.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SL. NO</th>
                                    <th>Name</th>
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
        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!editModal">Add Category</h5>
                        <h5 class="modal-title" v-if="editModal">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editModal ? updateCategory() : addCategory()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" type="text" name="name" placeholder="Category Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Active</label><br/>

                                <input type="radio" id="one" value="1" v-model="form.active">
                                <label for="one">Active </label>

                                <input type="radio" id="two" value="2" v-model="form.active">
                                <label for="two">Inactive</label>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" v-if="!editModal">Add Category</button>
                            <button type="submit" class="btn btn-secondary" v-if="editModal">Update Category</button>
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
                editModal: false,
                form: new Form({
                    id: '',
                    name: '',
                    active: '1',
                })
            }
        },

        mounted() {
            console.log('Category Component mounted.');
            this.$store.dispatch("adminCategory");
        },

        methods: {
            categoryList() {
                return this.$store.getters.getCategories;
            },

            addCategoryModal(){
                this.editModal =  false;
                this.form.reset();
                $("#addCategory").modal("show");
            },

            editCategoryModal(category){
                this.editModal =  true;
                $("#addCategory").modal("show");
                this.form.fill(category);
            },

            addCategory() {
                this.$Progress.start();
                this.form.post('/admin/categories')
                    .then(() => {
                        $("#addCategory").modal("hide");

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });

                        Toast.fire({
                            type: 'success',
                            title: 'Category successfully added'
                        });

                        this.$store.dispatch("adminCategory");
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },

            updateCategory() {
                this.$Progress.start();
                this.form.put('/admin/categories/'+this.form.id)
                    .then(() => {
                        $("#addCategory").modal("hide");

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });

                        Toast.fire({
                            type: 'success',
                            title: 'Category successfully update'
                        });

                        this.$store.dispatch("adminCategory");
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },

            deleteCategory(id){
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
                        axios.delete("/admin/categories/"+id)
                            .then(() => {
                                Swal.fire(
                                    'Deleted!',
                                    'Category has been deleted.',
                                    'success'
                                );

                                this.$store.dispatch("adminCategory");
                                this.$Progress.finish();
                            })
                            .catch(() => {
                                this.$Progress.fail();
                            })
                    }
                });
            }
        }
    }
</script>
