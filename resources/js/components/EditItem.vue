<template>
  <div>
    <h4>Edit ToDo</h4>
    <div class="addlist">
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

      <b-button @click="editItem()" variant="primary"> Edit Todo </b-button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data: function () {
    return {
      item: {
        name: "",
        desc: "",
      },
    };
  },
  methods: {
    editItem() {
      axios
        .put("/api/item/" + this.$route.params.id, {
          item: this.item,
        })
        .then((response) => {
          if (response.status == 200) {
            console.log(this.item);
            this.$emit("itemchange");
            this.$router.push({ name: "home" });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    axios
      .get("/api/item/" + this.$route.params.id)
      .then((response) => {
        if (response.status == 200) {
          this.item = response.data;
          //console.log(this.item);
          //this.$emit('itemchange');
        }
      })
      .catch((error) => {
        console.log(error);
      });
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