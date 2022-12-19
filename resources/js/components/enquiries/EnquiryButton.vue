<template>
  <div>
    <button
      type="button"
      @click.prevent="openModal"
      class="button button-outlined hover:button-mutedpurple-700 has-icon"
    >
      <span>Enquiry</span>
    </button>

    <EnquiryForm
      v-if="modalOpen"
      @close="modalOpen = false"
      :locations="locations">
    </EnquiryForm>
  </div>
</template>

<script>
import EnquiryForm from './EnquiryForm.vue';

export default {
  components: {
    EnquiryForm,
  },
  props: {
    locations: {
      required: false,
    }
  },
  data() {
    return {
      modalOpen: false,
    }
  },
  methods: {
    openModal() {
      this.modalOpen = true;
    },

    closeModal() {
      this.modalOpen = false;
    },
  }
}
</script>