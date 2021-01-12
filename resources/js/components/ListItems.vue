<template>
  <div>
    <h4>
      My Todo list: <b-badge variant="primary">{{ this.count }} items</b-badge>
    </h4>

    <div>
      <b-list-group v-for="(item, index) in this.items" :key="index">
        <list-item :item="item" class="item" />
      </b-list-group>
      <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </div>
  </div>
</template>

<script>
import listItem from "./ListItem";
import InfiniteLoading from "vue-infinite-loading";
import axios from "axios";

export default {
  data: function () {
    return {
      page: 1,
      items: [],
      userid: null,
      count: null,
    };
  },
  components: {
    listItem,
    InfiniteLoading,
  },
  methods: {
    getcurrentUserId() {
      if (this.$store.getters.currentUser) {
        this.userid = this.$store.getters.currentUser.id;
      }
    },
    getall() {
      axios.get("/api/items/user/" + this.userid + "/all").then((response) => {
        this.count = response.data;
      });
    },
    infiniteHandler($state) {
      axios
        .get("/api/items/user/" + this.userid + "/page/" + this.page + "/")
        .then((response) => {
          if (response.data.length > 0) {
            this.page += 1;
            response.data.forEach((item) => this.items.push(item));
            $state.loaded();
          } else {
            $state.complete();
          }
        });
    },
  },
  computed: {},
  created() {
    this.getcurrentUserId();

    this.getall();
  },
};
</script>