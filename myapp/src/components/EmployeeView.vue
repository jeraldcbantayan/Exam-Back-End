<template>
  <div class="hello" style="padding: 50px;">

    <b-button class="float-right" v-b-modal.modal-no-backdrop >Add New User</b-button>
    <b-button class="float-left" @click="logout()">Logout</b-button>

    <br><br>

    <b-button v-if="Object.keys(deleteItems).length !== 0"  class="float-right" @click="remove()">Delete All</b-button>
    <div>

      <b-modal id="modal-no-backdrop" ref="modal-no-backdrop"  hide-backdrop content-class="shadow" title="User Registration">
        <div class="d-block text-center">
              <!-- <h3></h3> -->
              <div style="width:100%; margin: auto; text-align: left;">
              <b-form @submit.prevent="save">
                <div class="form-group row">
                  <div class="col-6">
                    <label for="fname">First Name</label>
                    <input id="fname" type="text" v-model="employee.firstname" class="form-control"  placeholder="
                    First Name">
                  </div>
                  <div  class="col-6">
                    <label for="lname">Last Name</label>
                    <input id="lname" type="text" v-model="employee.lastname" class="form-control"  placeholder="
                  Last Name">
                  </div>

                </div>

                <div class="form-group">
                  <label >Address</label>
                  <textarea name="" class="form-control"  v-model="employee.address"  id="" cols="30" rows="2"></textarea>
                  <!-- <input type="text" class="form-control"  placeholder="
                  Address"> -->
                </div>

                <div class="form-group row">
                  <div class="col-6">
                    <label >Postal code</label>
                    <input  type="text" v-model="employee.postcode" class="form-control"  placeholder="
                  Postal code">
                  </div>
                  <div  class="col-6">
                    <label >Mobile</label>
                    <input  type="text" v-model="employee.mobile" class="form-control"  placeholder="
                    Mobile ">
                  </div>

                </div>

                <div class="form-group">
                  <label >Email</label>
                  <input type="text" v-model="employee.email"  class="form-control"  placeholder="
                  Email">
                </div>

                <center><h3>Credentials</h3></center>
                <div class="form-group row">
                  <div class="col-6">
                    <label >Username</label>
                    <input  type="text" value="" autocomplete="off" v-model="employee.username" class="form-control"  placeholder="
                  Username">
                  </div>
                  <div  class="col-6">
                    <label >Password</label>
                    <input  type="password" value="" autocomplete="off" v-model="employee.password" class="form-control"  placeholder="
                    Password ">
                  </div>

                </div>



                <!-- <center><button type="submit"  class="btn btn-primary">Save</button></center> -->
              </b-form>
            </div>

            </div>

            <template #modal-footer="{ ok, cancel}">
              <b-button size="sm" variant="danger" @click="cancel()">
                Cancel
              </b-button>
              <b-button size="sm" data-dismiss="modal"    variant="success" @click="save()">
                Save
              </b-button>

            </template>
      </b-modal>



    </div>

    <br><br>
    <h2>List of All Users</h2>
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Address</th>
          <th scope="col">Postal Code</th>
          <th scope="col">Mobile</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in result" v-bind:key="employee.id">
          <th scope="row"> {{ employee.id }} </th>
          <td>{{ employee.firstname }}</td>
          <td>{{ employee.lastname }}</td>
          <td>{{ employee.address }}</td>
          <td>{{ employee.postcode }}</td>
          <td>{{ employee.mobile }}</td>
          <td>{{ employee.email }}</td>
          <td>
            <input type="checkbox" style="width: 20px;height: 20px;"  :value="`${employee.id}`" @change="selectUser"  v-model="deleteItems"> |
            <button type="button" v-b-modal.modal-no-backdrop @click="edit(employee)" class="btn btn-warning">Edit</button> |
            <button type="button" @click="removeSingle(employee)" class="btn btn-danger">Delete</button>
          </td>
        </tr>

      </tbody>
    </table>

  </div>
</template>

<script>

  import Vue from 'vue';
  import axios from 'axios';

  Vue.use(axios);

  export default {
    name: 'EmployeeView',
    data () {
      return {
        result:{},
        deleteItems: [],
        btnDeleteAll:false,
        all_select: false,
        employee:{
            id:'',
            firstname:'',
            lastname:'',
            address:'',
            postcode:'',
            mobile:'',
            email:''
        }

      }
    },

    created() {
      this.EmployeeLoad();
    },

    methods:{
        EmployeeLoad(){

            var page = "http://127.0.0.1:8000/api/employees";
            axios.get(page)
            .then(
              ({data})=>{
                console.log(data);
                this.result=data;
              }
            );
        },

        save(){
          if(this.employee.id == ''){

            this.saveData();
          }
          else{
            this.updateData();
          }

          this.$refs['modal-no-backdrop'].hide()

        },
        saveData(){
          axios.post('http://127.0.0.1:8000/api/save/',this.employee)
          .then(
            ({data})=>{
              this.EmployeeLoad();
              alert("saved successfully");
              this.employee.firstname='';
              this.employee.lastname='';
              this.employee.address='';
              this.employee.postcode='';
              this.employee.mobile='';
              this.employee.email='';
              this.employee.username='';
              this.employee.password='';
              this.id='';

            }
          )

        },

        edit(employee){
          this.employee =  employee;
          // alert(this.employee.id);
        },

        updateData(){
          var editRecords = 'http://127.0.0.1:8000/api/update/'+this.employee.id;
          axios.put(editRecords,this.employee)
          .then(
            ({data})=>{
              this.employee.firstname='';
              this.employee.lastname='';
              this.employee.address='';
              this.employee.postcode='';
              this.employee.mobile='';
              this.employee.email='';
              this.employee.username='';
              this.employee.password='';
              this.id='';
              alert("Data Successfully updated");
              this.EmployeeLoad();
            }
          )
        },

        remove(employee){
          console.log(this.deleteItems)
            // var employee = `http://127.0.0.1:8000/api/delete/${employee.id}`;
            var employee = 'http://127.0.0.1:8000/api/delete/'+this.deleteItems;
            axios.delete(employee);
            alert("Deleted Successfully");
            this.EmployeeLoad();
        },

        removeSingle(employee){
           var employee = `http://127.0.0.1:8000/api/delete/${employee.id}`;
          //  var employee = 'http://127.0.0.1:8000/api/delete/'+this.deleteItems;
            axios.delete(employee);
            alert("Deleted Successfully");
            this.EmployeeLoad();
        },



        showModal() {
          this.$refs['modal-no-backdrop'].show()
        },
        hideModal() {
          this.$refs['modal-no-backdrop'].hide()
        },


        deleteAll(){

        },
        selectUser(){


            this.btnDeleteAll=true;

        },

        logout(){
          // Session

          axios.get('http://127.0.0.1:8000/api/logout',{
            email:this.email,
            password:this.password
          })
          .then(response=>{
            // console.log(response);
            // alert(response.data.success)
            if (response.data.success){
              this.$router.push('/')
              // this.$router.go('/empview');

            }
          })
          // window.location.href="/#/login";
        }



    }
  }
</script>

