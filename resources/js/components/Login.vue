<template>
    <div>
       
            <b-alert variant="success" v-if="registeredUser"  show >Thank you {{registeredUser.name}}.You can now login</b-alert>
             <b-card title="" title-tag="h5" header="Login" body-class="text-center" header-tag="header" header-bg-variant="dark" header-text-variant="white">
    

    <b-card-text style="max-width:80%; margin:auto;text-align:left; ">
                    <form @submit.prevent="authenticate">
                        <div class="form-group row" v-if="authError">
                            <b-alert variant="warning" show>
                                {{authError}}
                             </b-alert>
                        </div>
                        <div class="form-group row" :class="{ 'hasError': $v.formLogin.email.$error }">
                            
                            <label for="email">Email</label>
                            <input type="email" class="form-control" v-model="formLogin.email" placeholder="Email address">
                            <div  v-if="$v.formLogin.email.$error">
                           <span v-if="!$v.formLogin.email.required" class="alert2" role="alert">Email is required</span>
                           <span v-if="!$v.formLogin.email.email" class="alert2" role="alert">Email not valid</span>
                             </div>
                        </div>
                         <div class="form-group row" :class="{ 'hasError': $v.formLogin.password.$error }">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" v-model="formLogin.password" placeholder="password">
                            <span v-if="$v.formLogin.password.$error" class="alert2" role="alert">Password is required</span>
                        </div>
                        <div class="form-group row">
                             <b-button type="submit" variant="primary">Login</b-button>
                        </div>
                    </form>
    </b-card-text>
             </b-card>
        
    </div>
</template>

<script>

import { required, email } from "vuelidate/lib/validators";
import {login} from '../partials/axiosController';
export default {
    data(){
        return {
            formLogin: {
            email: '',
            password: ''
        },
        error: []
        }
    },
    validations: {
    formLogin: {
      password: { required },
      email: { required, email }
    }
  },
    methods:{
        authenticate(){
             this.$v.formLogin.$touch();
            if(this.$v.formLogin.$error) return
            this.$store.dispatch('login');
        login(this.$data.formLogin)
            .then(res => {
                this.$store.commit("loginSuccess", res);
                this.$router.push({path: '/'});
            })
            .catch(error => {
                this.$store.commit("loginFailed", {error});
            })
        }
    },
    computed:{
        authError(){
            return this.$store.getters.authError
        },
        registeredUser(){
            return this.$store.getters.registeredUser
        }
    }
}
</script>

<style scoped>
.alert{
    width: 100%;
    margin-top:5px;
}
.alert2{
   color: red;
    width: 100%;
    margin-top:5px;
    padding: 10px 0px;
}
.hasError input{
    border: 1px solid red;
}
</style>