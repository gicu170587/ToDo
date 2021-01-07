<template>
    <b-container class="bv-example-row">
       <Header />
       <b-container style="padding:40px 0;">
           <router-view></router-view>
        </b-container>
    </b-container>
</template>

<script>

import Header from './Header.vue';
export default {
    name: 'main-App',
    components: { Header }
}
</script>