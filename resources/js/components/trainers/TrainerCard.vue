<template>
    <div
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
          class="
            h-[460px]
            w-full
            object-cover
          "
        >
      </div>
      <div
        class="
          bg-brand-grey-500
          h-full
          text-white
          px-5
          font-teko
          text-5xl
          flex
          flex-col
          justify-center
          items-center
          py-5
        "
      >
        {{ data.name }}
        <div class="text-base font-cabin tracking-widest uppercase">
          {{ data.role }}
        </div>
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
          View Profile
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
    }
  }
  </script>