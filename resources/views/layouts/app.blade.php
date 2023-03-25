<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('enso-analytics::head')
    @include('enso-meta::display')
    <link href="https://fonts.googleapis.com/css2?family=Miriam+Libre:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#f8c848">
    <meta name="msapplication-TileColor" content="#3d363d">
    <meta name="theme-color" content="#3d363d">

    @if (EnsoSettings::get('pixel-code'))
      @include('parts.analytics.pixel-code')
    @endif

  </head>
  <body class="flex">
    @include('enso-analytics::body')
    <div id="app" class="flex flex-grow min-h-screen flex-col">
      @include('parts.nav')
      <div class="mt-10 md:mt-20 flex-grow flex-shrink-0 w-screen">
        @yield('content')
      </div>
      @include('parts.footer')
    </div>
    @includeWhen(config('enso.dev.show_responsive_helper'), 'enso-dev::responsive-helper')
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
