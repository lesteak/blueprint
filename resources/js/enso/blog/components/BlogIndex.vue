<template>
  <div class="max-w-screen-2xl m-auto md:p-10 p-5 mt-20">
    <h1 class="text-5xl md:text-8xl">Latest News</h1>
    <article-index :more_content="'other'"></article-index>
  </div>
</template>

<script>
import BlogCategoryList from './BlogCategoryList.vue';
import BlogPostList from './BlogPostList.vue';
import ArticleIndex from '../../../components/articles/ArticleIndex.vue';

export default {
  components: {
    BlogCategoryList,
    BlogPostList,
    ArticleIndex,
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
