<template>
    <div
      v-if="trainers"
      class="
        grid-cols-1
        md:grid-cols-2
        lg:grid-cols-3
        grid
        gap-5
      "
    >
      <div
        v-for="trainer in trainers"
        :key="trainer.id"
      >
        <trainer-card
          :data="trainer"
        ></trainer-card>
      </div>
    </div>
  </template>
  
  <script>
  import Api from "../../Services/api";
  import TrainerCard from "./TrainerCard.vue";
  export default {
    components: {
      TrainerCard,
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
        trainers: null
      }
    },
    mounted() {
      this.load();
    },
    methods: {
      load() {
        Api.get("/api/trainers")
          .then(res => {
            this.trainers = res.data.data
            console.log(res)
          })
          .catch(err => {
            console.log(err);
          })
      }
    }
  }
  </script>