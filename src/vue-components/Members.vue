<template>
  <div>
  <div v-if="loggedIn">
    <p>Welcome, {{ user }}</p>
  </div>  
  </div>
</template>
<script>
import axios from "axios";
export default {
  data () {
    return {   
      user: "",
      loggedIn: false
    }
  },
  watch: {
  // : function () {
  // }
  },
  props: [
    "prName1"
  ],
  components: {
  },
  mounted: function () {
    // console.log("members.vue mounted");
    document.title = "Members";
    this.verifyMember();
  },
  methods: {    
    verifyMember: function() {
      let self = this;
      axios.get('./src/php/verify_member.php')
        .then(function (response) {

        self.user = response.data.user;
        self.loggedIn =  response.data.loggedIn;
      })
      .catch(function (error) {
        console.log(error);
      });
    }    
  }
}
</script>