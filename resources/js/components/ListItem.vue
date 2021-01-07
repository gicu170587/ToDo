<template>
  <b-list-group-item style="margin-bottom: 3px">
    <input type="checkbox" @change="updateCheck()" v-model="item.completed" />
    <span :class="[item.completed ? 'completed' : '', 'itemText']">{{item.name}}</span>
    <button @click="editItem()" class="trashcan">
      <b-icon-pencil-square></b-icon-pencil-square>
    </button>
    <button @click="removeItem()" class="trashcan">
      <b-icon-trash></b-icon-trash>
    </button>
  </b-list-group-item>
</template>

<script>
import axios from "axios";
export default {
  props: ["item"],
  methods: {
    editItem() {
      this.$router.push({ name: "edititem", params: { id: this.item.id } });
    },
    updateCheck() {
      axios
        .put("api/item/" + this.item.id, {
          item: this.item,
        })
        .then((response) => {
          if (response.status == 200) {
            this.$emit("itemchange");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    removeItem() {
      axios
        .delete("api/item/" + this.item.id)
        .then((response) => {
          if (response.status == 200) {
            this.$emit("itemchange");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style  scoped>
.completed {
  text-decoration: line-through;
  color: #999;
}
.itemText {
  width: 100%;
  margin-left: 20px;
  text-align: left;
}
.item {
  display: flex;
  justify-content: center;
  align-items: center;
}
.trashcan {
  background-color: #fff;
  border: none;
  color: #ff0000;
  outline: none;
}
</style>