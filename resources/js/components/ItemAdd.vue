<template>
  <div class="addlist">
      <h5>Add new ToDo</h5>
    <b-form-group id="input-group-1" label="Todo title:" label-for="input-1">
      <b-form-input
        v-model="item.name"
        placeholder="Enter Todo title"
      ></b-form-input>
    </b-form-group>
    <b-form-group id="input-group-2" label="Description:" label-for="input-2">
      <b-form-textarea
        id="textarea"
        v-model="item.desc"
        placeholder="Enter description..."
        rows="3"
        max-rows="6"
      ></b-form-textarea>
    </b-form-group>

    <b-button :disabled="isDisabled" @click="addItem()" :variant="addclass">
      Add now
    </b-button>
  </div>
</template>

<script>
import {InsertItem} from '../partials/axiosController';

export default {
  data: function () {
    return {
      item: {
        user_id: this.$store.getters.currentUser.id,
        name: "",
        desc: "",
        btnDisable: true,
      },
    };
  },
  methods: {
    addItem() {
      if (this.item.desc == "") {
        return
      }
     InsertItem(this.$data.item)
            .then((response) => {
          if (response.status == 200) {
            this.item.name = "";
            this.item.desc = "";
            
           
            this.$emit("reloadlist");
          }
           this.$router.push({ name: "home" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  computed: {
    addclass() {
      return this.item.desc ? "success" : "outline-primary";
    },
    isDisabled() {
      if (this.item.desc != "") {
        return (this.btnDisable = false);
      } else {
        return (this.btnDisable = true);
      }
    },
  },
};
</script>
<style scoped>
.btn-outline-primary {
  cursor: initial !important;
}

.addlist {
  text-align: left;
}
.plus {
  background-color: #fff;
  border: 1px solid #007bff;
}
.active {
  color: #00ce25;
}
.inactive {
  color: #999;
}
</style>