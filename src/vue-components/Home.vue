<template>
<div>
  <!-- register -->
  <div>
    <p>Register</p>
    <form class="form1"
      id="form" name="form" @submit="validate($event)" method="POST">
      <!-- username -->
      <label for="username">username: required|alpha|max:6</label>
      <small v-show="errors.has('username')" role="alert">{{ errors.first('username') }}</small>
      <input id="username" v-validate="'required|alpha|max:12'" type="text" name="username" v-model="name">
      <!-- password -->
      <label for="password">Password</label>
      <small v-show="fields.failed('password')" role="alert">{{ errors.first('password') }}</small>
      <input id="password" v-validate="'required|confirmed:password_confirm'" name="password" type="password" v-model="password">
      
      <!-- passwordconfirm -->
      <label for="password_confirm">Confirm Password</label>
      <input id="password_confirm" name="password_confirm" type="password" v-model="passwordconfirm">
      <button type="submit">Submit</button>
    </form>
  </div>
  <!-- /register -->
</div>
</template>
<script>
import axios from "axios";
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import { Validator } from 'vee-validate';
const validator = new Validator();

  export default {
    data () {
      return {
        name: "",
        password: "",
        passwordconfirm: "",  
      }
    },
    mounted: function () {
      document.title = "Home";
    },
    methods: {
      register: function () {
        let regData = new FormData();
        regData.append("f_name", this.name);
        regData.append("f_password", this.password);
        regData.append("f_passwordconfirm", this.passwordconfirm);

        // let self = this;
        axios.post("./src/php/validate_register.php", regData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        }).then(function (response) {
          console.log(response.data);
        }).catch(function () {
          console.log("error");
        });
      },
      validate: function(e) {
        e.preventDefault();

        this.$validator.validateAll().then(() => {
          // ok
          this.register();
        }).catch(() => {
          console.log("invalid");
        });
      }
    }
  }
</script>