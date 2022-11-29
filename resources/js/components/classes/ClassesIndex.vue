<template>
  <div>
    <!-- <div
      v-for="classInstance in classes"
      :key="classInstance.id"
    >
      {{ classInstance }}
    </div> -->
    <category-list v-if="category_group && classes" :classCategories="classes"></category-list>
  </div>
</template>

<script>
import Api from "../../Services/api";
import CategoryList from "./CategoryList.vue";
export default {
  components: {
    CategoryList,
  },
  props: {
    category_group: {
      default: false,
    },
    location: {
      required: false
    },
    trainer: {
      required: false
    }
  },
  data () {
    return {
      classes: null
    }
  },
  mounted() {
    this.load();
  },
  methods: {
    load() {
      Api.get("/api/classes")
        .then(res => {
          this.classes = res.data.data
        })
        .catch(err => {
          console.log(err);
        })
    }
  }
}
</script>