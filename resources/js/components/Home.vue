<template>
  <div>
    <template v-if="this.$route.query.verify">
      <div v-if="this.$route.query.verify == 1" style="text-align: center">
        <b-alert variant="success" show
          >Your e-mail is verified. You can now login.</b-alert
        >
      </div>
      <div v-if="this.$route.query.verify == 0" style="text-align: center">
        <b-alert variant="success" show
          >Sorry your email cannot be identified.</b-alert
        >
      </div>
      <div v-if="this.$route.query.verify == 2" style="text-align: center">
        <b-alert variant="success" show
          >Your e-mail is already verified. You can now login.</b-alert
        >
      </div>
    </template>
    <template v-if="!currentUser">
      <div
        style="text-align: center; border: 1px solid #f2f2f2; padding: 50px 0px"
      >
        <p>
          For viewing or adding your Todo list you need to login or register
        </p>
        <b-button variant="primary" :to="{ name: 'login' }">Login</b-button> or
        <b-button variant="primary" :to="{ name: 'register' }"
          >Register</b-button
        >
      </div>
    </template>
    <template v-else>
      <list-items />
    </template>
  </div>
</template>

<script>
import listItems from "./ListItems";
export default {
  components: {
    listItems,
  },

  data: function () {
    return {};
  },
  methods: {},
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    },
  },
};
</script>