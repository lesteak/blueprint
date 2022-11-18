import Vue from 'vue';
import EnsoCarousel from 'enso-carousel';
import MainMenu from './enso/MainMenu.js';
import BlogIndex from './enso/blog/components/BlogIndex.vue';

new Vue({
  el: '#app',
  components: {
    BlogIndex,
    EnsoCarousel,
    MainMenu,
  },
});
