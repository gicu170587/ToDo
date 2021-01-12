<template>
  <b-card
    title=""
    title-tag="h5"
    header="Registration"
    body-class="text-center"
    header-tag="header"
    header-bg-variant="dark"
    header-text-variant="white"
  >
    <b-card-text style="max-width: 80%; margin: auto; text-align: left">
      <form @submit.prevent="register">
        <div class="form-group row" v-if="regError">
          <p class="alert">
            {{ regError }}
          </p>
        </div>

        <div
          class="form-group row"
          :class="{ hasError: $v.formRegister.name.$error }"
        >
          <label for="name">Name</label>
          <input
            type="text"
            name="name"
            class="form-control"
            v-model="formRegister.name"
            placeholder="Name"
          />
          <div v-if="$v.formRegister.name.$error">
            <span
              v-if="!$v.formRegister.name.required"
              class="alert"
              role="alert"
              >Name is required</span
            >
          </div>
        </div>
        <div
          class="form-group row"
          :class="{ hasError: $v.formRegister.email.$error }"
        >
          <label for="email">Email</label>
          <input
            type="email"
            name="email"
            class="form-control"
            v-model="formRegister.email"
            placeholder="Email address"
          />
          <div v-if="$v.formRegister.email.$error">
            <span
              v-if="!$v.formRegister.email.required"
              class="alert"
              role="alert"
              >Email is required</span
            >
            <span v-if="!$v.formRegister.email.email" class="alert" role="alert"
              >Email not valid</span
            >
          </div>
        </div>
        <div
          class="form-group row"
          :class="{ hasError: $v.formRegister.password.$error }"
        >
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            class="form-control"
            v-model="formRegister.password"
            placeholder="password"
          />
          <div v-if="$v.formRegister.password.$error">
            <span
              v-if="!$v.formRegister.password.required"
              class="alert"
              role="alert"
              >Password is required</span
            >
            <span
              v-if="!$v.formRegister.password.min"
              class="alert"
              role="alert"
              >Password minim 5 characters</span
            >
          </div>
        </div>
        <div
          class="form-group row"
          :class="{ hasError: $v.formRegister.password2.$error }"
        >
          <label for="password2">Confirm Password</label>
          <input
            type="password"
            name="password2"
            class="form-control"
            v-model="formRegister.password2"
            placeholder="Confirm password"
          />

          <div v-if="$v.formRegister.password2.$error">
            <span
              v-if="!$v.formRegister.password2.required"
              class="alert"
              role="alert"
              >Confirm Password is required</span
            >
            <span
              v-if="!$v.formRegister.password2.sameAs"
              class="alert"
              role="alert"
              >Password not match</span
            >
          </div>
        </div>
        <div class="form-group row">
          <b-button type="submit" variant="primary">Register</b-button>
        </div>
      </form>
    </b-card-text>
  </b-card>
</template>

<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import { registerUser } from "../partials/axiosController";
export default {
  data() {
    return {
      formRegister: {
        name: "",
        email: "",
        password: "",
        password2: "",
      },
      error: [],
    };
  },
  validations: {
    formRegister: {
      name: { required },
      email: { required, email },
      password: { required, min: minLength(6) },
      password2: { required, sameAs: sameAs("password") },
    },
  },
  methods: {
    register() {
      this.$v.formRegister.$touch();
      if (this.$v.formRegister.$error) return;
      registerUser(this.$data.formRegister)
        .then((res) => {
          this.$store.commit("registerSuccess", res);
          this.$router.push({ path: "/login" });
        })
        .catch((error) => {
          this.$store.commit("registerFailed", { error });
        });
    },
  },
  computed: {
    regError() {
      return this.$store.getters.regError;
    },
  },
};
</script>

<style scoped>
.alert {
  color: red;
  width: 100%;
  margin-top: 5px;
  padding: 5px 10px;
}
.hasError input {
  border: 1px solid red;
}
</style>