<template>
    <div
      :class="imageTrainer ? '' : 'xl:aspect-square max-h-[434px]'"
      class="
        rounded-lg
        overflow-hidden
        flex
        flex-col
        justify-between
        max-w-[460px]
        w-full
        m-auto
      "
    >
      <div>
        <img
          v-if="data.thumbnail"
          :src="data.thumbnail.url" alt=""
          :class="imageTrainer ? 'max-h-[460px]' : 'max-h-[300px]'"
          class="
            w-full
            object-cover
          "
        >
      </div>
      <div class="bg-brand-grey-500 h-full text-white px-5 font-teko text-4xl flex justify-center items-center">
        {{ data.name }}
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
        <a :href="data.url" class="w-full text-center py-5 border-r border-black/30">
          More Info
        </a>
        <a :href="`${data.url}/timetable`" class="w-full text-center py-5">
          Timetable
        </a>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      data: {
        type: Object,
        required: true
      },
      imageTrainer: {
        type: Boolean,
        default: false,
        required: false,
      }
    }
  }
  </script>