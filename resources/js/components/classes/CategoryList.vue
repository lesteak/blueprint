<template>
  <div>
    <div v-for="(category, key) in categories" :key="key">
      <div
        class="
          my-5
          font-cabin
          uppercase
          tracking-[3.54px]
          text-brand-grey-200
        "
      >
        {{key }}
      </div>
      <div class="grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid gap-5">
        <class-card
          v-for="(classInstance, index) in category"
          :key="index"
          :classInstance="classInstance"
        ></class-card>
      </div>
    </div>
  </div>
</template>

<script>
  import ClassCard from './ClassCard.vue';
  export default {
    components: {
      ClassCard,
    },
    props: {
      classCategories: {
        type: Array
      }
    },
    data () {
      return {
        categories: null,
      }
    },
    mounted () {
      this.categories = this.sortCategories(this.classCategories);
    },
    methods: {
      sortCategories (classCategories) {
        let categoriesArray = [];
        classCategories.forEach(classInstance => {
          if (classInstance.category) {
            if (!(classInstance.category.name in categoriesArray)) { categoriesArray[classInstance.category.name] = [] };
            categoriesArray[classInstance.category.name].push(classInstance);
          } else {
            if (!("uncategorised" in categoriesArray)) { categoriesArray["uncategorised"] = [] };
            categoriesArray["uncategorised"].push(classInstance);
          }
        });

        return Object.assign({}, categoriesArray);
      }
    }
  }
</script>