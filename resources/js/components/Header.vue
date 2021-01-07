<template>
     <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-container fluid>
            <router-link class="navbar-brand" to="/">Home</router-link>

            <b-navbar-nav class="ml-auto">
                
                    <template v-if="!currentUser">
                        <b-row>
    <b-col>
                            <router-link to="/login" class="nav-link">Login</router-link>
    </b-col>
                        <b-col>
                            <router-link to="/register" class="nav-link">Register</router-link>
                        </b-col>
                        </b-row>
                    </template>
                    <template v-else>
                         <b-row>
    <b-col >
                            <router-link to="/additem" class="nav-link">Add ToDo</router-link>
    </b-col><b-col >
                        <b-nav-item-dropdown  right>
                            <template #button-content>
                              <em>{{currentUser.name}}</em>
                              </template>
                            
                            <b-dropdown-item  href="#!" @click.prevent="logout" class="dropdown-item">Logout</b-dropdown-item>
                           
                        </b-nav-item-dropdown>
                        </b-col></b-row>
                    </template>
                
            </b-navbar-nav>
      </b-container>
     </b-navbar>
</template>

<script>
export default {
    name: 'app-header',
    methods:{
        logout(){
            this.$store.commit('logout');
            this.$router.push('/');
        }
    },
    computed:{
        currentUser(){
            return this.$store.getters.currentUser
        }
    }
}
</script>
<style  scoped>
span{ display: inline-block;}
</style>