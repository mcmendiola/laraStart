<style>
  .el-dropdown {
    vertical-align: middle;
  }
  .el-dropdown + .el-dropdown {
    margin-left: 15px;
  }
  .el-icon-arrow-down {
    font-size: 12px;
  }
</style>

<template>
    <div >
        
        <div class="col-md-12 mt-3">
        <el-row>
        <el-col :span="18">
          <button class="btn btn-success" >Add New <i class="fas fa-user-plus fa-fw"></i></button>
          
        </el-col>

        <el-col :span="6">
                    


                        <div class="form-group">
                        

                          <select class="form-control" v-model="keyItem" :required="true" @change="handleChange(this)">
                               
                                <option 
                                v-for="option in data" 
                                :value="option.ID"
                                :selected="keyItem === option.ID"
                                >{{ option.Value }}</option>
                                </select>
                         </div> 


        </el-col>
      </el-row>
    </div>
    </div>
</template>






<script>
var data

data = [{
    "ID": "1",
    "Value": "Water flood"
    }, {
    "ID": "2",
    "Value": "Lock broken"
    }, {
     "ID": "3", 
    "Value": "Help to buy some drinks"
  }];

    export default {
        
        data() {
            return {
                data,
                name:  'testing',
                name1:  'testing',
                keyItem: 2
                
            }
        },
        mounted() {
            
            console.log('Component mounted.')
        },
        methods: {
            handleChange() {
                console.log(this.keyItem);
            //  if(e.target.options.selectedIndex > -1) {
            //         alert(e.target.options[e.target.options.selectedIndex].dataset.foo);
            //     }
        }
        }
    }
</script>
