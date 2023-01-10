<template>
  <div>
    <div class="flex flex-col items-center justify-center w-full">
      <div>

      </div>
      <label
        for="timetableLocation"
        class="
          font-cabin
          uppercase
          tracking-[3.54px]
          text-sm
          py-5
        "
      >
        Timetable location
      </label>
      <div
        class="
          border-t
          border-gray-500
          border-b
          w-full
          flex
          justify-center
        "
      >
        <div class="select-arrows">
          <select
            v-model="selected_id"
            name="timetableLocation"
            id=""
            class="
              font-teko
              text-black
              front-bold
              border-l
              border-gray-500
              border-r
            "
          >
            <option value="null">Select Location</option>
            <option
              v-for="location in locations"
              :key="location.id"
              :value="location.slug"
            >
              {{ location.name }}
            </option>
          </select>
        </div>
      </div>
    </div>

    <section
      id=""
      class="p-10"
    >
      <div class="max-w-2xl m-auto flex w-full flex-col">
        <h2 class="text-5xl md:text-8xl">{{ activeLocation.name }}</h2>
        <p v-html="activeLocation.description"></p>
        <!-- <x-button-group :buttons="$row_data->buttons" class="mt-8"></x-button-group> -->
      </div>
    </section>

    <section>
      <div v-if="locationId" class="max-w-screen-2xl m-auto flex w-full flex-col">
        <iframe
          id="glofox_1"
          :src="`https://app.glofox.com/portal/#/branch/${locationId}/classes-week-view?header=classes,memberships,trainers,facilities`"
          width="100%"
          height="1200"
          scrolling="no"
          frameborder="0"
          ref="iframe"
        ></iframe>
        <div
    
        >
          powered by<a style="text-decoration: none; font-family: Arial, Helvetica, sans-serif; "
              href="https://www.glofox.com"><b>&nbsp;Glofox</b></a>
        </div>
      </div>
      <div v-else class="max-w-2xl m-auto flex w-full flex-col">
        <p>Timetable not available for this location.</p>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  props: {
    activeLocation: {
      type: Object,
      required: true,
    },
    trainerId: {
      type: String,
      required: false,
    },
    classId: {
      type: String,
      required: false,
    },
    locations: {
      type: Array,
      required: false,
    }
  },
  data() {
    return {
      locationId: this.activeLocation.glowfox_id,
      selected_id: this.activeLocation.slug,
    }
  },
  watch: {
    selected_id() {
      window.location = `/locations/${this.selected_id}/timetable`;
    }
  }
}
</script>