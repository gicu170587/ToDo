<template>
<div>
 <template v-if="!currentUser">
                       <div style="text-align:center; border:1px solid #f2f2f2;padding:50px 0px">
      <p>For viewing or adding your Todo list you need to login or register</p>
      <b-button variant="primary" :to="{ name: 'login' }">Login</b-button> or  <b-button variant="primary" :to="{ name: 'register' }">Register</b-button>
    
    </div>
                    </template>
                    <template v-else>
                        
                       <h4> My Todo list: <b-badge variant="primary">{{ items.length }} items</b-badge> </h4>
                             <list-items :items="items"  v-on:reloadlist="getList()" />
                            
                    </template>
</div>
</template>

<script>
import axios from 'axios'
import listItems from "./ListItems";
 export default {
   components: {
    listItems,
  },
 
  data: function () {
    return {
       
      items: [],
      userid: null
    };
  },
  methods: {
      getcurrentUserId(){
            if(this.$store.getters.currentUser){
                this.userid = this.$store.getters.currentUser.id;
            }
        } , 
    getList() {
   
      axios.get("/api/items/user/"+this.userid)
        .then((response) => {
          this.items = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  computed:{
        currentUser(){
            return this.$store.getters.currentUser
        }
        
       
    },
 
    
     created() {
     this.getcurrentUserId();     
    this.getList();
  }
 }
 </script>