<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="example">
                  
                    <!-- /table header -->
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Registered At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      <!-- /table Details -->
                      <tr v-for="user in users.data" :key="user.id">
                          <td>{{user.id}}</td>
                          <td>{{user.name}}</td>
                          <td>{{user.email}}</td>
                          <td>{{user.type | upText}}</td>
                          <td>{{user.created_at | myDate}}</td>

                          <!-- /table Details Action-->
                          <td>
                              <a href="#" @click="editModal(user)">
                                  <i class="fa fa-edit blue"></i>
                              </a>
                              /
                              <a href="#" @click="deleteUser(user.id)">
                                  <i class="fa fa-trash red"></i>
                              </a>
                              /
                              <a href="#" @click="printPreview(user.id)">
                                  <i class="fas fa-print yellow"></i>
                              </a>

                          </td>
                        </tr>
                  
                      </tbody>
                    </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>



        <!-- User window Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <!-- Dynamic change Modal Header Cpatiomn  using v-show="!editmode"-->
                <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editmode ? updateUser() : createUser()">
                <div class="modal-body">
                    {{this.$cookie.get('id')}}
                    <div class="form-group">
                      <input v-model="form.name" type="text" name="name"
                        placeholder="Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                      <has-error :form="form" field="name"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.email" type="email" name="email"
                        placeholder="Email Adddress"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                      <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group">
                          <textarea v-model="form.bio" name="bio" id="bio"
                          placeholder="Short bio for user (Optional)"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                          <has-error :form="form" field="bio"></has-error>
                      </div>


                      <div class="form-group">
                          <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                              <option value="">Select User Role</option>
                              <option value="admin">Admin</option>
                              <option value="user">Standard User</option>
                              <option value="author">Author</option>
                          </select>
                          <has-error :form="form" field="type"></has-error>
                      </div>

                      <div class="form-group">
                          <input v-model="form.password" type="password" name="password" id="password"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                          <has-error :form="form" field="password"></has-error>
                      </div>



                </div>
                <div class="modal-footer">
                  <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                  <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- report window Modal -->
        <div class="modal" tabindex="-1" role="dialog" id="report" data-toggle="modal" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="width: 740px !important;">
                <div class="modal-header">
                    <h5 class="modal-title">Report title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="" frameborder="0" width="704" height="440" id="pdfFrame"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
      data() {
            return {
                editmode: false,
                test: '',
                users : {},
                form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods: {
           newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            updateUser(){
                this.$Progress.start();
                console.log('Editing data ' + this.form.id);
                this.form.id = this.$cookie.get('id');
                this.form.put('api/user/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');
                     swal(
                        'Updatedxxx!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                        this.LoadUsers();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },  

           editModal(user){
                this.editmode = true;
                this.$cookie.set('id',user.id);
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            printPreview(id){
                this.$Progress.start();
                var myDate = new Date().valueOf()
               
                axios.get("api/showreportRpt/jrpt/"+ id +"/" + myDate)
                .then(({ data }) =>  {
                        //alert(data);
                        $('#pdfFrame').attr('src', data);
                        $('#report').modal({backdrop: 'static', keyboard: false})  
                        $('#report').modal('show');
                        this.$Progress.finish();
                    })
                    .catch(() => {
                    this.$Progress.fail();
                    });
            },
            deleteUser(id){ 
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/user/'+id).then(()=>{
                                        swal(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        )
                                    this.LoadUsers();
                                }).catch(()=> {
                                    swal("Failed!", "There was something wronge.", "warning");
                                });
                         }
                    })
            },

            LoadUsers(){
              axios.get("api/user").then(({ data }) => (this.users = data));
            },
            createUser(){
              this.$Progress.start();
              this.form.post('api/user')
              .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    this.LoadUsers();
                    toast({
                        type: 'success',
                        title: 'User Created in successfully'
                        })

                    this.$Progress.finish();
              })
              .catch(()=>{
              })
            }
        },
      created() {
          
          

          
          this.LoadUsers();
          
         // setInterval(() => this.LoadUsers(),3000);
      }
    }
</script>
