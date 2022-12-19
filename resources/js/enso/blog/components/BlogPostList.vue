<template>
  <div class="md:max-w-2xl mx-auto px-5 my-10 md:my-12">
    <p v-if="loading_posts">Loading...</p>
    <p v-else-if="error">{{ error }}</p>
    <div v-else-if="posts.length > 0">
      <div v-for="post in posts" :key="post.slug" class="my-4">
        <a :href="post.url" v-if="post.thumbnail">
          <img :src="post.thumbnail.urls.default" :alt="post.thumbnail.alt_text" />
        </a>
        <p v-if="post.categories.length > 0">
          <span v-for="i in post.categories.length" :key="i">{{ post.categories[i-1].name }}&nbsp;</span>
        </p>
        <a :href="post.url" class="text-4xl hover:underline">{{ post.title }}</a>
      </div>
    </div>
    <p v-else>No posts.</p>
  </div>
</template>

<script>
export default {
  name: 'blog-post-list',

  props: {
    postsUrl: {
      type: String,
      default: '/json/articles',
    },
    category: {
      type: String,
    },
  },

  data() {
    return {
      layout: localStorage.getItem('blog_layout') ? localStorage.getItem('blog_layout') : 'grid',
      posts: [],
      loading_posts: false,
      error: null,
      page: 1,
    };
  },

  created() {
    this.getPosts();
  },

  methods: {
    setLayout(layout) {
      this.layout = layout;
      localStorage.setItem('blog_layout', layout);
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
          this.posts = response.data;
        })
        .catch((error) => {
          this.error = 'Error getting posts.';
        })
        .then(() => {
          this.loading_posts = false;
        });
    },
  },

  watch: {
    category(new_category) {
      this.getPosts();
    },
  },
};
</script>
