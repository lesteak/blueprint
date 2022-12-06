<template>
    <div
      v-if="locations"
      class="
        grid-cols-1
        md:grid-cols-2
        lg:grid-cols-3
        grid
        gap-5
      "
    >
      <div
        v-for="location in locations"
        :key="location.id"
      >
        <card :data="location"></card>
      </div>
    </div>
  </template>
  
  <script>
  import Api from "../../Services/api";
  import Card from "./LocationCard.vue";
  export default {
    components: {
      Card,
    },
    props: {
      classType: {
        required: false
      },
      trainer: {
        required: false
      }
    },
    data () {
      return {
        locations: null
      }
    },
    mounted() {
      this.load();
    },
    methods: {
      load() {
        Api.get("/api/locations")
          .then(res => {
            this.locations = res.data.data
            console.log(res)
          })
          .catch(err => {
            console.log(err);
          })
      }
    }
  }
  </script>