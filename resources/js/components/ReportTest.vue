<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">tEST Component</div>
                     
                    <div class="card-body">
                        {{$data.pdf}}
                        <button class="btn btn-default" @click="getReport()">Test</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="report" >
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 740px !important;">
                <div class="modal-header">
                    <h5 class="modal-title">Report title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="" frameborder="0" width="704" height="500" id="pdfFrame"></iframe>
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
                users1:{},
                message:  '',
                name1:  'testing',
                jasper:'',
                pdf: ''
                
            }
        },
        methods: {
            LoadUsers(){
              axios.get("api/showreport").then(({ data }) =>  (this.message = data));
            },
            getReport(){
                this.$Progress.start();
                var myDate = new Date().valueOf()
               
                axios.get("api/showreportRpt/jrpt/"+ this.message +"/" + myDate)
                .then(({ data }) =>  {
                        //alert(data);
                        $('#pdfFrame').attr('src', data);
                        $('#report').modal('show');
                        this.$Progress.finish();
                    })
                    .catch(() => {
                    this.$Progress.fail();
                    });
            }
        },
        created() {
        //alert('created');
          this.LoadUsers();
          
        // setInterval(() => this.LoadUsers(),3000);
        },
        mounted() {
            //this.getReport();
            //alert(this.message);
            //axios.get("api/showreportRpt/jrpt/"+ this.message);
        }

    }
</script>
