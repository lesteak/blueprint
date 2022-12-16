<template>
  <div class="fixed w-screen h-screen top-0 left-0 flex justify-center items-center z-10">
    <div class="relative bg-brand-grey-500 w-full max-w-5xl p-20 rounded-lg">
      <span class="absolute text-white top-0 right-0 p-5 cursor-pointer" @click="close">X</span>

      <div>
        <h1 class="text-white text-8xl">Contact</h1>
        <p class="text-white my-10">Content needed to explain expect time for response etc. Nam id suscipit elit. Nam sem elit, tristique ut blandit non, porttitor et diam. Vestibulum feugiat semper tellus, viverra vestibulum lectus tincidunt eu.</p>
      </div>
      
      <div class="flex flex-col gap-5">
        <div class="flex flex-col md:flex-row w-full gap-5">
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden w-full relative">
            <input class="w-full p-5" name="name" :value="form.name" type="text" placeholder="Name...">
            <label class="absolute top-0 left-0 px-5 uppercase tracking-widest" for="name">Name</label>
          </div>
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden w-full relative">
            <input class="w-full p-5" name="email" :value="form.email" type="email" placeholder="Email...">
            <label class="absolute top-0 left-0 px-5 uppercase tracking-widest" for="email">Email</label>
          </div>
        </div>

        <div class="flex flex-col md:flex-row w-full gap-5">
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden w-full relative">
            <input class="w-full p-5" name="phone_number" :value="form.phone_number" type="text" placeholder="Phone Number...">
            <label class="absolute top-0 left-0 px-5 uppercase tracking-widest" for="phone_number">Phone Number</label>
          </div>
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden w-full relative">
            <select :v-model="branch" class="w-full p-5" name="branch" :value="form.branch">
              <option value="null">Branch...</option>
              <option
                v-for="location in locations"
                :key="location.slug"
                :value="location.name"
              >
                {{ location.name }}
              </option>
            </select>
            <label class="absolute top-0 left-0 px-5 uppercase tracking-widest" for="branch">Branch</label>
          </div>
        </div>

        <div class="flex flex-col md:flex-row w-full gap-5">
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden relative w-full">
            <textarea name="name" class="w-full h-full p-5" :value="form.message" placeholder="Message..."></textarea>
            <label class="absolute top-0 left-0 px-5 uppercase tracking-widest" for="name">Message</label>
          </div>
        </div>
      </div>

      <div class="mt-5 button sign-post max-w-fit">
        Send Message
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    locations: {
      required: false
    }
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone_number: "",
        message: "",
        branch: null,
      }
    }
  },
  methods: {
    close() {
      this.$emit('close')
    }
  }
}
</script>