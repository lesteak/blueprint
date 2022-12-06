<template>
  <div>
    <div @click="test">CLICK ME</div>
    <div>
      <select name="" id="">
        <option value=""></option>
      </select>
    </div>
      <iframe
        id="glofox_1"
        :src="`https://app.glofox.com/portal/#/branch/${locationId}/classes-week-view?header=classes,memberships,trainers,facilities`"
        width="100%"
        height="0"
        scrolling="no"
        frameborder="0"
        class="h-screen"
        ref="iframe"
      ></iframe>
      <div
  
      >
        powered by<a style="text-decoration: none; font-family: Arial, Helvetica, sans-serif; "
            href="https://www.glofox.com"><b>&nbsp;Glofox</b></a>
      </div>
  </div>
</template>

<script>
export default {
  props: {
    activeLocationId: {
      type: String,
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
      locationId: null,
    }
  },
  mounted() {
    this.locationId = this.activeLocationId;
  },
  methods: {
    test() {
      const params = {
        // header: [
        //   "classes",
        //   "memberships",
        //   "trainers",
        //   "facilities",
        // ],
      };

      if (this.trainerId) {
        params.filters_trainers = this.trainerId;
      }
      if (this.classId) {
        params.filters_classes = this.classId;
      }

      console.log(this.trainerId, params);

      const queryString = new URLSearchParams(Object.entries(params));
      console.log(queryString);

      console.log("URL: ", `https://app.glofox.com/portal/#/branch/${this.locationId}/classes-week-view?${queryString}`);

      console.log("CLICKED");
      this.locationId = "6302ddec1f85c122836a5703";
      this.$refs["iframe"].contentWindow.location = `https://app.glofox.com/portal/#/branch/603301faca876728ed58a330/classes-day-view?filters_trainers=629869e2c1426b6fc81d00c7&header=classes`;
    }
  }
}
</script>