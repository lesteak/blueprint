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
      console.log("CLICKED");
      this.locationId = "6302ddec1f85c122836a5703";
      this.$refs["iframe"].contentWindow.location.reload();
    }
  }
}
</script>