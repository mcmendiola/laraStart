<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">SQL TEST Component</div>
                     
                    <div class="card-body">
                        
                        {{$data.users1}}
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
                users1:{},
                message:  '',
                name1:  'testing'
                
                
            }
        },
        methods: {
            LoadUsers(){
              axios.get("api/sqltest").then(({ data }) =>  (this.users1 = data));
            }
        },
        created() {
          this.LoadUsers();
         // setInterval(() => this.LoadUsers(),3000);
        }
    }
</script>
