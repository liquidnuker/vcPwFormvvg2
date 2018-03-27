<template>
<div>
  <!-- login -->
  <div>
    <p>Login</p>
    <form class="form2" @submit="validate($event)">
      <!-- username -->
      <label for="l_username">username: required|alpha|max:6</label>
      <small v-show="errors.has('l_username')" role="alert">{{ errors.first('l_username') }}</small>
      <input id="l_username" v-validate="'required|alpha|max:12'" type="text" name="l_username" v-model="l_name">
      <!-- password -->
      <label for="l_password">Password</label>
      <small v-show="fields.failed('l_password')" role="alert">{{ errors.first('l_password') }}</small>
      <input id="l_password" v-validate="'required'" name="l_password" type="password" v-model="l_password">
      <button type="submit">Submit</button>
    </form>
  </div>
  <!-- /login -->
</div>
</template>
<script>
import axios from "axios";
import {router} from "../js/router.js";
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import { Validator } from 'vee-validate';
const validator = new Validator();

export default {
  data () {
    return {   
      l_name: "",
      l_password: "",
    }
  },
  watch: {
  // : function () {
  // }
  },
  props: [
  ],
  components: {
  },
  mounted: function () {
    // console.log("login.vue mounted");
    document.title = "Login";
  },
  methods: { 
    login: function () {
        let loginData = new FormData();
        loginData.append("l_name", this.l_name);
        loginData.append("l_password", this.l_password);
        console.log(loginData);

        // let self = this;
        axios.post("./src/php/validate_login.php", loginData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        }).then(function (response) {
          if (response.data.loggedIn) {
            console.log("login ok");
            router.push({path: "/members"});
          } else {
            console.log("wrong username/password");
          }
        }).catch(function () {
          console.log("error");
        });
      },
      validate: function (e) {
        e.preventDefault();

        this.$validator.validateAll().then(() => {
          // ok
        this.login();
        }).catch(() => {
          console.log("invalid");
        });

      }       
  }
}
</script>