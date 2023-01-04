<template>
  <vueper-slides class="no-shadow" :arrows="false">
    <vueper-slide
      v-for="(slide, i) in slides"
      :key="i"
      :image="slide">
    </vueper-slide>
  </vueper-slides>
</template>

<script>
  import { VueperSlides, VueperSlide } from 'vueperslides'
  import 'vueperslides/dist/vueperslides.css'

export default {
  components: {
    VueperSlides,
    VueperSlide
  },
  props: {
    slides: {
      type: Array
    }
  },
  mounted() {
    console.log(this.slides)
  }
}
</script>

<style>
  .vueperslides__bullets {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    justify-content: flex-start;
    align-items: flex-start;
  }
  .vueperslides__bullets::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 0;
    border-top: 60px solid white;
    border-right: 100vw solid transparent;
  }
  .vueperslides__bullet {
    margin: 1.5em 0.2em;
  }
  .vueperslides__bullet .default {
    background-color: #bdbfca;
    border: none;
    box-shadow: none;
    transition: 0.3s;
    width: 16px;
    height: 16px;
  }

  .vueperslides__bullet--active .default {background-color: #25272e;}

  .vueperslides__parallax-wrapper {
    min-height: 500px;
  }

  @media (max-width: 768px) {
    .vueperslides__bullets {
      position: absolute;
      top: -60px;
      left: 0;
      z-index: 1;
      justify-content: center;
      align-items: flex-start;
    }
    .vueperslides__bullets::after {
      content: '';
      position: absolute;
      top: -60px;
      left: 0;
      width: 0;
      height: 0;
      border-top: 60px solid white;
      border-right: 100vw solid white;
    }
  }
</style>