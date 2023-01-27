<template>
  <div class="hello">
    <h1>Welcome</h1>
    <h2></h2>

  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  data () {
    return {
      isLoggedIn :false,
     }
    },
    created(){
      if(window.Laravel.isLoggedIn){
        this.isLoggedIn= true;
      }

    },
    methods:{
      logout(e){
        e.preventDefault();
        this.$axios.get('/sacntum/csrf-cookie').then(response=>{
          this.$axios.post('/api/logout')
          .then(response=>{
              if(response.data.success){
                window.location.href="/empview";
              }
              else{
                console.log(response);
              }

          })
          .catch(function(err){
            console.log(err);
          })
        })
      }
    }

  }

</script>

<!
