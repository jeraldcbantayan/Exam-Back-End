<template>
  <div class="hello" >
    <div style="width:25%; margin: auto; text-align: left; padding:50px; border:1px solid grey; background-color:#d7d9d7;" >
      <center><h2>User Login</h2></center>
    <form >

      <div class="form-group row">
          <label >Username</label>
          <input  type="text" v-model="username"   class="form-control"  placeholder="
         Username">
          <label >Password</label>
          <input  type="password" v-model="password"  class="form-control"  placeholder="
          Password ">

      </div>
      <br>

      <!-- <router-link to="/empview">Register</router-link> -->

      <a :href="'/#/register'" style="float: right;">Register</a>
      <br>



      <center><button type="submit" @click="handleSubmit"  class="btn btn-primary">Login</button></center>
    </form>
  </div>



  </div>
</template>

<script>


import Vue from 'vue';
  import axios from 'axios';

  Vue.use(axios);

export default {
  name: 'LoginView',
  data () {
    return {

    }
  },
  methods:{
    handleSubmit(e){
      // e.preventDefault();
      if(this.password.length>0){
          axios.post('http://127.0.0.1:8000/api/login',{
            username:this.username,
            password:this.password
          })
          .then(response=>{
            console.log(response);
            // alert(response.data.success)
            if (response.data.success){
              // window.location.href="/#/empview";
              // this.$router.go('/empview');
              this.$router.push('/empview')
              // this.$router.go('/empview')

            }
          })

      }
    }
  }
}
</script>
