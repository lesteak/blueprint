<template>
  <div
    class="
      rounded-lg
      overflow-hidden
      xl:aspect-square
      flex
      flex-col
      justify-between
      max-w-[460px]
      max-h-[434px]
      w-full
      m-auto
    "
  >
    <div>
      <img
        v-if="classInstance.thumbnail"
        :src="classInstance.thumbnail.url" alt=""
        class="
          max-h-[300px]
          w-full
          object-cover
        "
      >
      <div v-else> No Image </div>
    </div>
    <div class="bg-brand-grey-500 h-full text-white px-5 font-teko text-4xl flex justify-center items-center">
      {{ classInstance.name }}
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
      <a :href="classInstance.url" class="w-full text-center py-5 border-r border-black/30">
        More Info
      </a>
      <a href="/timetables" class="w-full text-center py-5">
        Book Class
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    classInstance: {
      type: Object,
      required: true
    }
  }
}
</script>