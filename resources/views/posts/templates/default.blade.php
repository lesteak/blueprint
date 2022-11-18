@extends('layouts.app')

@section('content')
  <main class="section">
    <div class="md:max-w-2xl mx-auto px-5 my-10 md:my-12">
      @if ($post->categories->count() > 0)
        @foreach ($post->categories->sortBy('name') as $category)
          <a href="{{ route(config('enso.blog.public_route', 'posts') . '.index', [
            'category' => $category->slug
          ]) }}">{{ $category->name }}</a>
          @if (!$loop->last)
            &mdash;
          @endif
        @endforeach
      @endif
    </div>

    <h1 class="sr-only">{{ $post->name }}</h1>
    @flexibleField($post, 'content', 'content')

    <div class="md:max-w-2xl mx-auto px-5 my-10 md:my-12">
      <div class="flex">
        @if ($post->user->avatar)
          <img src="{{ $post->user->avatar->getResizeUrl() }}" alt="{{ $post->user->avatar->alt_text }}" class="flex-initial">
        @endif
        <div class="flex-initial">
          <p class="font-bold">
            {{ $post->user->display_name }}
          </p>
          <p class="font-sm mt-3">
            {{ $post->publish_at ? $post->publish_at->format('F j, Y') : $post->created_at->format('F j, Y') }}
          </p>
        </div>
      </div>
    </div>
  </main>

  @include('enso-blog::parts.related-posts')
@endsection
