<template>
 <div>
     <div :per-page="perPage" :current-page="currentPage"  id="my-pg">
    <b-list-group v-for="(item, index) in itemsForList" :key="index" >
        <list-item :item="item" class="item" v-on:itemchange="$emit('reloadlist')" />
    </b-list-group>
     </div>
     <b-pagination
     v-if="rows>0"
     pills
     size="sm"
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="my-pg"
      align="center"
    ></b-pagination>
 </div>
    
</template>

<script>
import listItem from "./ListItem"
export default {
    
   props:['items'],
   data: function () {
    return {
        perPage: 3,
        currentPage: 1,
    };
  },
   components:{
       listItem
   } ,
   methods:{
  
   },
   computed: {
        itemsForList() {
    return this.items.slice(
      (this.currentPage - 1) * this.perPage,
      this.currentPage * this.perPage,
    );
  },
      rows() {
        return this.items.length
      }
    }
}
</script>
<style  scoped>
#my-pg{
margin-bottom: 20px;
}
</style>