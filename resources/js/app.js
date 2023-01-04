import Vue from 'vue';
import EnsoCarousel from 'enso-carousel';
import MainMenu from './enso/MainMenu.js';
import BlogIndex from './enso/blog/components/BlogIndex.vue';

import MoreLinks from './components/more/More.vue';
import ArticleIndex from './components/articles/ArticleIndex.vue';
import ClassesIndex from './components/classes/ClassesIndex.vue';
import LocationIndex from './components/locations/LocationIndex.vue';
import TrainerIndex from './components/trainers/TrainerIndex.vue';
import Timetable from './components/timetable/Timetable.vue';

import MapElement from './components/locations/Map.vue';
import EnquiryButton from './components/enquiries/EnquiryButton.vue';
import Carousel from './components/carousel/Carousel.vue';

new Vue({
  el: '#app',
  components: {
    BlogIndex,
    EnsoCarousel,
    MainMenu,
    MoreLinks,
    ArticleIndex,
    ClassesIndex,
    LocationIndex,
    TrainerIndex,
    Timetable,
    MapElement,
    EnquiryButton,
    Carousel,
  },
});
