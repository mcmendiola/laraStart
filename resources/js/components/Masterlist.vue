<style>
    .el-table th{
      padding: 12px 0px !important; 
    }

    .el-table td{
      padding: 0px 0px !important; 
    }

    .el-button {
      font-size: 12px !important;
    }
    </style>
<template>
  <div>
    <div style="margin-bottom: 10px">
      <el-row>
        <el-col :span="18">
          <el-button @click="onCreate">create 1 row</el-button>
          <el-button @click="onCreate100">create 100 row</el-button>
          <el-button @click="bulkDelete">bulk delete</el-button>
          <el-button @click="newModal">Create New</el-button>
        </el-col>

        <el-col :span="6">
          <el-input placeholder="search NO." v-model="filters[0].value"></el-input>
        </el-col>
      </el-row>
    </div>
    
    <!--<data-tables :data="data" :filters="filters" @selection-change="handleSelectionChange" :pagination-props="{ pageSizes: [5, 10, 15] }"> -->

    <el-table :data="data" height="500px"style="width: 100%" :filters="filters" layout="table" @current-change="handleCurrentChange" @selection-change="handleSelectionChange">
 
      <el-table-column v-for="title in titles" :width="title.width" :prop="title.prop" :label="title.label" :key="title.prop">
      </el-table-column>
      
       <el-table-column
      fixed="right"
      label="Operations "
      width="120">
      <template slot-scope="scope">
        <!--<el-button v-for="button in customButtonsForRow(scope.row)" :key="button.name" type="text">
        {{ button.name }}
         </el-button>-->
        
        <el-button @click="editModal(scope.$index,data)" type="text" size="small">Detail</el-button>
        <el-button type="text" size="small">Edit</el-button> 

      </template>
      </el-table-column>

    </el-table>



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

                    <div class="form-group">
                      <input v-model="form.flow_no" type="text" name="flow_no"
                        placeholder="flow_no"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('flow_no') }">
                      <has-error :form="form" field="flow_no"></has-error>
                    </div>

                    <div class="form-group">
                      <input v-model="form.content" type="text" name="content"
                        placeholder="Content "
                        class="form-control" :class="{ 'is-invalid': form.errors.has('content') }">
                      <has-error :form="form" field="content"></has-error>
                    </div>

                      <div class="form-group">
                          <select name="flow_type" v-model="form.flow_type" id="flow_type" class="form-control" :class="{ 'is-invalid': form.errors.has('flow_type') }">
                              <option value="">Select User Type</option>
                              <option value="Repair">Repair</option>
                              <option value="Help">Help</option>
                          </select>
                          <has-error :form="form" field="flow_type"></has-error>
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


  </div>
</template>

<script>


var data, titles,sampleAr

data = [{
    "ID": "1",
    "content": "Water flood",
    "flow_no": "FW201601010001",
    "flow_type": "Repair",
    "flow_type_code": "repair",
    }, {
    "ID": "2",
    "content": "Lock broken",
    "flow_no": "FW201601010002",
    "flow_type": "Repair",
    "flow_type_code": "repair",
    }, {
     "ID": "3", 
    "content": "Help to buy some drinks",
    "flow_no": "FW201601010003",
    "flow_type": "Help",
    "flow_type_code": "help"
  }];

  titles = [{
    prop: "ID",
    label: "#",
    width : "70",
    style:"display:none;"
    },{
    prop: "flow_no",
    label: "NO.",
    style: "style.display :" 
    }, {
    prop: "content",
    label: "Content",
    style: "style.display:" 
    }, {
    prop: "flow_type",
    label: "Type",
    style: "style.display :" 
  }]

  sampleAr = [{
    "content": "",
    "flow_no": "",
    "flow_type": "",
    "flow_type_code": ""
    }]

export default {
  data() {
    return {
      data,
      editmode: false,
      titles,
      sampleAr,
      selectedindex: 0,
      rowID: 4,
      small:true,
                form: new Form({
                    ID:'',
                    flow_no:'',
                    content : '',
                    flow_type: ''
                }),

      filters: [{
        prop: 'flow_no',
        value: ''
      }],
      actionCol: {
        props: {
          label: 'Actionssss',
        },
        buttons: [{
          props: {
            type: 'primary',
            icon: 'el-icon-edit',
            size: 'small'
          },
          handler: row => {
            this.$message('Edit clicked' + row.ID)
            
            row.flow_no = 'hello word' + Math.random()
            row.content = Math.random() > 0.5 ? 'Water flood' : 'Lock broken'
            row.flow_type = Math.random() > 0.5 ? 'Repair' : 'Help'
            
          },
          label: 'Edit'
        }, {
          handler: row => {
            this.data.splice(this.data.indexOf(row), 1)
            this.$message('delete success')
          },
          label: 'delete'
        }]
      },
      selectedRow: []
    }
  },
  methods: {
    newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
    updateUser(){
      //alert(this.form.content);
      this.data[this.selectedindex].content = this.form.content;

    },
    customButtonsForRow(row) {
         return [{
            name: 'repairing',
            handler: _ => {
               this.$message(`repairing ${row.flow_no}`)
            }
         }]
       
     },
       
     createUser(){
        let type = this.form.flow_type;
        
        //=='Repair' ? 'Repair' : 'Help';
        //alert(type)
        this.data.push({
          

          
          content: this.form.content,
          flow_no: this.form.flow_no,
          flow_type: this.form.flow_type,
          flow_type_code: type=='Repair' ? 'Repair' : 'Help'

        })
     },
     

      editModal(index,rows){
        //this.sampleAr = rows;
        //console.log(sampleAr);
        //alert(sampleAr.indexOf);
        this.selectedindex =index;
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.flow_no =rows[index].flow_no
                this.form.content =rows[index].content
                this.form.flow_type = rows[index].flow_type

                //this.form.fill(index);
            },

    onCreate() {
      //let i = this.rowID++;
      //alert(i);
      this.data.push({
        ID: this.rowID++,
        content: "new created",
        flow_no: "FW201601010003" + Math.floor(Math.random() * 100),
        flow_type: "Help",
        flow_type_code: "help"
        
      
        
      })
    },
    onCreate100() {

      //for (let i = 0; i < 100; i++) {
      //    this.onCreate()
     // }

      [...new Array(100)].map(_ => {
        this.onCreate()
      })
    },
    handleSelectionChange(val) {
      //this.$notify({
      //  message: `selection-change: ${val.map(row => row.flow_no).join(',')}`
      //})
    
    },
    handleCurrentChange(currentRow) {
      //this.$notify({
      //  message: `el-table current-change: ${currentRow.flow_no}`
      //})
    },
    bulkDelete() {
      this.selectedRow.map(row => {
        this.data.splice(this.data.indexOf(row), 1)
      })
      this.$message('bulk delete success')
    }
  }
}
</script>