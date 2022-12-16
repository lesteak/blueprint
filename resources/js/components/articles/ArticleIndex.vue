<template>
  <div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-10">
      <article-card
        v-for="article in articles"
        :key="article.id"
        :article="article">
      </article-card>
    </div>

    <a v-if="more_content === 'see_all'" href="/articles" class="button sign-post max-w-fit">
      View All Articles
    </a>
    <button
      v-else
      type="button"
      @click="getPosts"
      class="button sign-post max-w-fit"
    >
      Load More
    </button>
  </div>
</template>

<script>
  import Api from "../../Services/api";
  import ArticleCard from './ArticleCard.vue';
  export default {
    components: {
      ArticleCard,
    },
    props: {
      preloaded_articles: {
        type: Array,
        required: false,
      },
      more_content: {
        type: String,
        default: "see_all"
      },
      postsUrl: {
        type: String,
        default: '/json/articles',
      },
    },
    data() {
      return {
        articles: [],
        layout: localStorage.getItem('blog_layout') ? localStorage.getItem('blog_layout') : 'grid',
        loading_posts: false,
        error: null,
        page: 1,
      }
    },
    mounted() {
      if (this.preloaded_articles) {
        this.articles = this.preloaded_articles;
      } else {
        this.getPosts();
      }
    },
    methods: {
      load() {
        Api.get("/json/articles")
          .then(res => {
            this.articles = res.data.data
          })
          .catch(err => {
            console.log(err);
          })
      },

      getPosts() {
        this.loading_posts = true;
        this.error = null;

        const params = {
          page: this.page,
        };

        if (this.category) {
          params.category = this.category;
        }

        fetch(this.postsUrl + '?' + new URLSearchParams(Object.entries(params)), {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
          },
        })
          .then((response) => response.json())
          .then((response) => {
            this.articles = response.data;
          })
          .catch((error) => {
            this.error = 'Error getting posts.';
          })
          .then(() => {
            this.loading_posts = false;
          });
      },
    }
  }
</script>