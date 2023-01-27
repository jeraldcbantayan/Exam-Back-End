<template>

    <div style="width:35%; margin: auto; text-align: left;">
      <center><h2>Employee Registration</h2></center>
    <form @submit.prevent="save">
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
          <input  type="text" v-model="employee.username" class="form-control"  placeholder="
         Username">
        </div>
        <div  class="col-6">
          <label >Password</label>
          <input  type="password" v-model="employee.password" class="form-control"  placeholder="
          Password ">
        </div>

      </div>



      <center><button type="submit"  class="btn btn-primary">Save</button></center>
    </form>
  </div>
</template>

<script>

  import Vue from 'vue';
  import axios from 'axios';

  Vue.use(axios);

  export default {
    name: 'RegisterView',
    data () {
      return {
        result:{},
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

    },

    methods:{
      save(){
          if(this.employee.id == ''){

            this.saveData();
          }
          else{

          }

        },
        saveData(){
          axios.post('http://127.0.0.1:8000/api/save/',this.employee)
          .then(
            ({data})=>{
              // this.EmployeeLoad();
              alert("saved successfully");
              this.$router.push('/')

            }
          )

        },



    }
  }
</script>

<!
