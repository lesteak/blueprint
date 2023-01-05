<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div
      v-for="(card, index) in activeCards"
      :key="index"
      class="
        rounded-lg
        overflow-hidden
        flex
        flex-col
        justify-between
        max-h-[434px]
        w-full
      "
    >
      <div>
        <img
          v-if="card.img"
          :src="card.img.url" alt=""
          class="
            max-h-[300px]
            w-full
            object-cover
          "
        >
      </div>
      <div class="bg-brand-grey-500 h-full text-white px-5 font-teko text-4xl flex justify-center items-center">
        {{ card.name }}
      </div>
      <div
        class="
          bg-brand-blue
          flex
          text-white
          justify-between
          font-cabin
          uppercase
          tracking-[3.54px]
        "
      >
        <a :href="card.url" class="w-full text-center py-5">
          View {{ card.name }}
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    cards: {
      type: Array,
      required: true,
    },
    hide: {
      type: String,
      required: false,
    }
  },
  data() {
    return {
      activeCards: [],
      // cards: [
      //   {
      //     name: "Trainers",
      //     img: "",
      //     url: "/trainers"
      //   },
      //   {
      //     name: "Timetable",
      //     img: "",
      //     url: "/timetable"
      //   },
      //   {
      //     name: "Classes",
      //     img: "",
      //     url: "/classes"
      //   }
      // ],
      activePath: window.location.pathname,
    }
  },
  mounted() {
    // Simple function to remove active item from array
    this.activeCards = this.cards;
    this.activeCards.forEach((card, index) => {
      if (card.url === this.activePath || this.hide && card.url === this.hide) {
        this.activeCards.splice(index, 1);
      }
    })
  }
}
</script>