<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdmin()">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="showModal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody><tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.type | Uppercase }}</td>
                                <td>{{ user.created_at | DateFormat }}</td>
                                <td>
                                    <a href="#" @click="editModal(user)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    &nbsp;/&nbsp;
                                    <a href="#" @click="deleteUser(user.id)">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div v-if="!$gate.isAdmin()" class="mt-5">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="AddUserModal" tabindex="-1" role="dialog" aria-labelledby="AddUserModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="AddUserModalTitle">Add New User</h5>
                        <h5 class="modal-title" v-show="editmode" id="AddUserModalTitle">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="editmode ? updateUser() : createUser()">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="name" class="form-control" :class="{'is-valid':form.errors.has('name')}">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="text" name="email"
                                       placeholder="Email Address" class="form-control" :class="{'is-valid':form.errors.has('email')}">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                            <textarea v-model="form.bio" type="text" name="bio"
                                      placeholder="Shor Bio for user (Optional)" class="form-control" :class="{'is-valid':form.errors.has('bio')}">
                            </textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{
                            'is-valid':form.errors.has('type')}">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password"
                                       placeholder="Enter Password" class="form-control" :class="{'is-valid':form.errors.has('password')}">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                editmode:false,
                users:{},
                form:new Form({
                    id:'',
                    name:'',
                    email:'',
                    password:'',
                    type:'',
                    bio:'',
                    photo:''
                })
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
                    .then(()=>{
                        $('#AddUserModal').modal('hide');
                        Fire.$emit('AfterCreated');
                        swal(
                            'Updated!',
                            'User successfully updated.',
                            'success'
                        )
                        this.$Progress.finish();
                    }).catch(()=>{
                    this.$Progress.fail();
                });
            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#AddUserModal').modal('show');
                this.form.fill(user);
            },
            showModal(){
                this.editmode = false;
                this.form.reset();
                $('#AddUserModal').modal('show');
            },
            deleteUser(id){
                swal.fire({
                    title: 'Are you sure?',
                    text: "Delete this user permanently!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('api/user/' + id).then(() => {a
                            Fire.$emit('AfterCreated');
                            swal.fire(
                                'Deleted!',
                                'User successfully deleted.',
                                'success'
                            )
                        }).catch(() => {
                            swal.fire('Failed!', "There was something wrong", "warning")
                        });
                    }
                })
            },
            loadUsers() {
                if (this.$gate.isAdmin()) {
                    axios.get('api/user').then(({data}) => (this.users = data));
                }
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                    .then(()=>{
                        Fire.$emit('AfterCreated');
                        $('#AddUserModal').modal('hide');
                        Toast({
                            type: 'success',
                            title: 'User Created successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch({});
            }
        },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreated',()=>{
                this.loadUsers();
            })
        }
    }
</script>
