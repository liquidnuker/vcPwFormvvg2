(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{35:function(e,a,s){"use strict";s.r(a);var r=s(7),o=s.n(r),t=s(1),n=s(6),l=s.n(n);Vue.use(l.a);new n.Validator;var i={data:function(){return{l_name:"",l_password:""}},watch:{},props:[],components:{},mounted:function(){document.title="Login"},methods:{login:function(){var e=new FormData;e.append("l_name",this.l_name),e.append("l_password",this.l_password),console.log(e),o.a.post("./src/php/validate_login.php",e,{headers:{"Content-Type":"multipart/form-data"}}).then(function(e){e.data.loggedIn?(console.log("login ok"),t.a.push({path:"/members"})):console.log("wrong username/password")}).catch(function(){console.log("error")})},validate:function(e){var a=this;e.preventDefault(),this.$validator.validateAll().then(function(){a.login()}).catch(function(){console.log("invalid")})}}},d=s(0),p=Object(d.a)(i,function(){var e=this,a=e.$createElement,s=e._self._c||a;return s("div",[s("div",[s("p",[e._v("Login")]),e._v(" "),s("form",{staticClass:"form2",on:{submit:function(a){e.validate(a)}}},[s("label",{attrs:{for:"l_username"}},[e._v("username: required|alpha|max:6")]),e._v(" "),s("small",{directives:[{name:"show",rawName:"v-show",value:e.errors.has("l_username"),expression:"errors.has('l_username')"}],attrs:{role:"alert"}},[e._v(e._s(e.errors.first("l_username")))]),e._v(" "),s("input",{directives:[{name:"validate",rawName:"v-validate",value:"required|alpha|max:12",expression:"'required|alpha|max:12'"},{name:"model",rawName:"v-model",value:e.l_name,expression:"l_name"}],attrs:{id:"l_username",type:"text",name:"l_username"},domProps:{value:e.l_name},on:{input:function(a){a.target.composing||(e.l_name=a.target.value)}}}),e._v(" "),s("label",{attrs:{for:"l_password"}},[e._v("Password")]),e._v(" "),s("small",{directives:[{name:"show",rawName:"v-show",value:e.fields.failed("l_password"),expression:"fields.failed('l_password')"}],attrs:{role:"alert"}},[e._v(e._s(e.errors.first("l_password")))]),e._v(" "),s("input",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"},{name:"model",rawName:"v-model",value:e.l_password,expression:"l_password"}],attrs:{id:"l_password",name:"l_password",type:"password"},domProps:{value:e.l_password},on:{input:function(a){a.target.composing||(e.l_password=a.target.value)}}}),e._v(" "),s("button",{attrs:{type:"submit"}},[e._v("Submit")])])])])},[],!1,null,null,null);a.default=p.exports}}]);