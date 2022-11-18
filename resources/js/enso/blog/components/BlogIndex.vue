<template>
  <div>
    <div class="md:max-w-2xl mx-auto px-5 my-10 md:my-12">
      <h1 class="text-4xl font-bold">Blog</h1>
    </div>
    <blog-category-list :category-url="categoryUrl" @select="onSelectCategory"></blog-category-list>
    <blog-post-list :category="category"></blog-post-list>
  </div>
</template>

<script>
import BlogCategoryList from './BlogCategoryList.vue';
import BlogPostList from './BlogPostList.vue';

export default {
  components: {
    BlogCategoryList,
    BlogPostList,
  },

  props: {
    categoryUrl: {
      type: String,
      default: '/json/categories',
    },
    defaultCategory: {
      type: String,
    },
  },

  data() {
    return {
      category: this.defaultCategory,
    };
  },

  methods: {
    onSelectCategory(slug) {
      this.category = slug;
    },
  },
};
</script>
