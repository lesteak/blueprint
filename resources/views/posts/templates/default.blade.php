@extends('layouts.app')

<style>
  .mt-20 {
    margin-top: 20px !important;
  }
  .p-10 {
    padding: 10px !important;
  }
</style>

@section('content')
  <article class="max-w-[960px] m-auto mt-0 md:mt-10">
    <header>
      <div class="flex flex-col justify-center">
        @if ($post->hero)
          <img
            src="{{ $post->hero->getResizeUrl('post_hero', true) }}"
            alt="{{ $post->hero->alt_text }}"
            class="max-w-[960px] w-full h-auto m-auto"
          />
        @endif
      </div>
    </header>
    <div class="max-w-[720px] w-full m-auto">
      <h1 class="text-5xl md:text-8xl mt-10 px-10">{{ $post->title }}</h1>
      
      @flexibleField($post, 'content', 'content')

      <div>
        <p class="font-sm mt-3 text-brand-grey-500 text-right">
          Published {{ $post->publish_at ? $post->publish_at->format('F j, Y') : $post->created_at->format('F j, Y') }}
        </p>
      </div>

    </div>
  </article>

  @if (!empty($related_posts))
    <section class="max-w-screen-2xl m-auto md:p-10 p-5 mt-20">
      <h2 class="text-3 mb-5">Related Posts</h2>
      {{--  @if ($related_posts->count() > 0)  --}}
        <article-index :preloaded_articles='@json($related_posts)'></article-index>
      {{--  @endif  --}}
    </section>
  @endif
@endsection
