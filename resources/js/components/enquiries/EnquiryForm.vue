<template>
  <div class="fixed w-screen h-screen top-0 left-0 flex justify-center items-center z-50">
    <div v-if="submit_response" class="relative bg-brand-grey-500 w-full max-w-5xl p-20 rounded-lg">
      <span class="absolute text-white top-0 right-0 p-5 cursor-pointer" @click="close">X</span>

      <div>
        <h1 class="text-white text-5xl md:text-8xl">Contact</h1>
        <p class="text-white my-10">Thanks for your enquiry, one of the team will be in touch.</p>
      </div>

      <button type="button" class="mt-5 button sign-post max-w-fit" @click="close">Close</button>
    </div>
    <form
      v-else
      @submit.prevent="send()"
      class="relative bg-brand-grey-500 w-full max-w-5xl md:p-20 p-5 rounded-lg"
    >
      <span class="absolute text-white top-0 right-0 p-5 cursor-pointer" @click="close">X</span>

      <div>
        <h1 class="text-white text-5xl md:text-8xl">Contact</h1>
        <p class="text-white my-10">Get in touch with us to find out more about MMA group classes and private training at any of our Blueprint Martial Arts locations.</p>
      </div>

      <div class="flex flex-col gap-5">
        <div class="flex flex-col md:flex-row w-full gap-5">
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden w-full relative">
            <input class="w-full p-5" name="name" v-model="form.name" type="text" required placeholder="Name...">
            <label class="absolute text-xs top-0 left-0 px-5 uppercase tracking-widest" for="name">Name</label>
          </div>
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden w-full relative">
            <input class="w-full p-5" name="email" v-model="form.email" type="email" required placeholder="Email...">
            <label class="absolute text-xs top-0 left-0 px-5 uppercase tracking-widest" for="email">Email</label>
          </div>
        </div>

        <div class="flex flex-col md:flex-row w-full gap-5">
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden w-full relative">
            <input class="w-full p-5" name="phone_number" v-model="form.phone_number" type="text" placeholder="Phone Number...">
            <label class="absolute text-xs top-0 left-0 px-5 uppercase tracking-widest" for="phone_number">Phone Number</label>
          </div>
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden w-full relative h-full p-5">
            <select v-model="form.branch" class="w-full h-full" name="branch">
              <option value="null">Branch...</option>
              <option
                v-for="location in locations"
                :key="location.slug"
                :value="location.slug"
              >
                {{ location.name }}
              </option>
            </select>
            <label class="absolute text-xs top-0 left-0 px-5 uppercase tracking-widest" for="branch">Branch</label>
          </div>
        </div>

        <div class="flex flex-col md:flex-row w-full gap-5">
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden w-full relative h-full p-5">
            <select v-model="form.hear_about_us" class="w-full h-full h-full" name="hear_about_us">
              <option value="null">Where did you hear about us...</option>
              <option value="search_engine">Google / Search Engine</option>
              <option value="instagram">Instagram</option>
              <option value="facebook">Facebook</option>
              <option value="friend">Friend</option>
              <option value="outlet">Walked past outlet</option>
            </select>
            <label class="absolute text-xs top-0 left-0 px-5 uppercase tracking-widest" for="hear_about_us">Where did you hear about us?</label>
          </div>
        </div>

        <div class="flex flex-col md:flex-row w-full gap-5">
          <div class="bg-white text-brand-grey-500 rounded-md overflow-hidden relative w-full">
            <textarea name="name" class="w-full h-full p-5" v-model="form.message" required placeholder="Message..."></textarea>
            <label class="absolute text-xs top-0 left-0 px-5 uppercase tracking-widest" for="name">Message</label>
          </div>
        </div>
      </div>

      <button type="submit" class="mt-5 button sign-post max-w-fit">
        Send Message
      </button>
    </form>
  </div>
</template>

<script>
import Api from "../../Services/api";
export default {
  props: {
    locations: {
      required: false
    }
  },
  data() {
    return {
      submit_response: false,
      form: {
        type: "enquiry",
        name: "",
        email: "",
        phone_number: "",
        message: "",
        branch: null,
        hear_about_us: null,
      }
    }
  },
  methods: {
    close() {
      this.$emit('close')
    },
    send () {
      console.log(this.form);
      Api.post("/newsletters", this.form)
        .then(res => {
          this.submit_response = true;
        })
        .catch(err => {
          console.log(err);
        })
    }
  }
}
</script>
