<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div
      v-for="(card, index) in cards"
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
          :src="card.img" alt=""
          class="
            max-h-[300px]
            w-full
            object-cover
          "
        >
        <div v-else> No Image </div>
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
    hide: {
      type: String,
      required: false,
    }
  },
  data() {
    return {
      cards: [
        {
          name: "Trainers",
          img: "",
          url: "/trainers"
        },
        {
          name: "Timetable",
          img: "",
          url: "/timetable"
        },
        {
          name: "Classes",
          img: "",
          url: "/classes"
        }
      ],
      activePath: window.location.pathname,
    }
  },
  mounted() {
    // Simple function to remove active item from array
    this.cards.forEach((card, index) => {
      if (card.url === this.activePath || this.hide && card.url === this.hide) {
        this.cards.splice(index, 1);
      }
    })
  }
}
</script>