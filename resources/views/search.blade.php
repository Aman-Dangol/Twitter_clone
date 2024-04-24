<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/css/style-home.css" />
  <link rel="stylesheet" href="/css/search.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

  <main>
    <section class="navigation">
      <div class="nav-content"><a class="profile" href="/profile/{{Auth::id()}}">{{Auth::user()->username}}</a></div>
      <div class="nav-content"><a href="{{route('home-page')}}">home</a></div>

      <div class="nav-content">settings</div>
      <div class="nav-content"><a href="/logout" class="logout">logout</a></div>
    </section>

    <section class="mid">

      <form class="search-page-form" action="/search" method="get">
        <input type="text" name="s" value="{{$s}}">
        <button>search</button>
      </form>
      @foreach($results as $user)
      <div class="search-result">
        <a href="/profile/{{$user->id}}">{{ $user->username}}</a>
      </div>
      @endforeach
    </section>
    <section></section>
  </main>
  <script src="/js/ajaxSetup.js" type="module"></script>
  <script src="/js/tweet.js" type="module"></script>

</body>

</html>