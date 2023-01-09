<template>
  <a :href="article.url">
    <div>
      <div
        class="
          relative
          overflow-hidden
        "
      >
        <img
          :src="article.thumbnail.urls.default || article.thumbnail.urls.post_thumbnail"
          :alt="article.thumbnail?.alt_text"
          class="
            w-full
            h-auto
            max-w-[460px]
            max-h-[300px]
            object-cover
            aspect-square
          "
        >
        <div
          class="
            absolute
            bottom-[-1rem]
            left-0
            h-24
            w-20
            bg-brand-grey-500
            flex
            justify-center
            items-center
            text-white
            skew-y-12
          "
        >
        <div class="-skew-y-12 flex flex-col justify-center items-center">
          <div class="font-teko text-4xl">{{ date.day }}</div>
          <div class="font-teko text-base">{{ date.month }}</div>
        </div>
        </div>
      </div>
      <div class="normal-case font-teko text-4xl border-l-4 border-brand-blue p-5">
        {{ article.title }}
      </div>
    </div>
  </a>
</template>

<script>
export default {
  props: {
    article: {
      type: Object,
      required: true
    }
  },
  computed: {
    /**
     * Date
     * 
     * Returns a zero led string date for when the article was published.
     * For example 3rd August would be returned as 03 Aug.
     * @returns Object
     */
    date() {
      const dateString = new Date(this.article.publish_at);
      return {
        day: dateString.getDate().toString().padStart(2, '0'),
        month: dateString.toLocaleString('en-US', {month: 'short'}),
      };
    }
  }
}
</script>