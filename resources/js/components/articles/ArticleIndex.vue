<template>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
    <div v-for="article in articles" :key="article.id">
      <article-card :article="article"></article-card>
    </div>
  </div>
</template>

<script>
  import ArticleCard from './ArticleCard.vue';
  export default {
    components: {
      ArticleCard,
    },
    props: {
      articles: {
        type: Array,
        required: true,
      }
    }
  }
</script>