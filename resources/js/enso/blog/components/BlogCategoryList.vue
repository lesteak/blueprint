<template>
  <section class="md:max-w-2xl mx-auto px-5 my-10 md:my-12">
    <h2 class="text-3 font-bold leading-none mb-5">Categories</h2>
    <p v-if="loading_categories">...</p>
    <p v-else-if="error">{{ error }}</p>
    <ul v-else-if="categories.length > 0">
      <li class="inline">
        <a href="#" @click.prevent="onClick(null)">All</a>
        <span>&mdash;</span>
      </li>
      <li v-for="i in categories.length" :key="categories[i-1].slug" class="inline">
        <a href="#" @click.prevent="onClick(categories[i-1].slug)">{{ categories[i-1].name }}</a>
        &nbsp;
        <span v-if="i !== categories.length">&mdash;</span>
        &nbsp;
      </li>
    </ul>
    <p v-else>No categories.</p>
  </section>
</template>

<script>
export default {
  name: 'blog-category-list',

  props: {
    categoryUrl: {
      type: String,
      default: '/json/categories',
    },
  },

  data() {
    return {
      categories: [],
      error: null,
      loading_categories: false,
    };
  },

  created() {
    this.getCategories();
  },

  methods: {
    getCategories() {
      this.loading_categories = true;
      this.error = null;

      fetch(this.categoryUrl)
        .then((response) => response.json())
        .then((response) => {
          this.categories = response.data;
        })
        .catch((error) => {
          this.error = 'Error getting categories.';
        })
        .then(() => {
          this.loading_categories = false;
        });
    },

    onClick(slug) {
      this.$emit('select', slug);
    },
  },
};
</script>
