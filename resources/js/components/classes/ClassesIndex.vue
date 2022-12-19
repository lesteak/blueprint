<template>
  <div>
    <category-list v-if="category_group == true && classes" :classCategories="classes"></category-list>
    <div v-else class="grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid gap-5">
      <class-card
        v-for="(classInstance, index) in classes"
        :key="index"
        :classInstance="classInstance"
      ></class-card>
    </div>
  </div>
</template>

<script>
import Api from "../../Services/api";
import CategoryList from "./CategoryList.vue";
import ClassCard from './ClassCard.vue';

export default {
  components: {
    CategoryList,
    ClassCard,
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
      const params = {};
      if (this.trainer) {
        params.trainer = this.trainer.slug;
      }
      if (this.location) {
        params.location = this.location.slug;
      }

      const queryString = new URLSearchParams(Object.entries(params));

      Api.get(`/api/classes?${queryString}`)
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