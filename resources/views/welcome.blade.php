<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/css/style-home.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

  <main>
    <section class="navigation">
      <div class="nav-content"><a class="profile" href="/profile/{{Auth::id()}}">{{Auth::user()->username}}</a></div>
      <div class="nav-content"><a href="{{route('home-page')}}">home</a></div>
      <div class="nav-content"><a href="/settings">Settings</a></div>
      <div class="nav-content"><a href="/logout" class="logout">logout</a></div>
    </section>
    <section class="content-container">
      <form action="/tweet" class="flex-row" method="post">
        @csrf()
        <textarea name="tweetText" id="" cols="30" rows="5" placeholder="whats on your mind ?"></textarea><br />
        @error('tweetText')
        <div class="err">{{$message}}</div>
        @endError()<br />
        <button>post</button>
      </form>
      <section class="contents">
        <section class="hover" id="forYou">for you</section>
        <section class="hover" id="following">following</section>
      </section>
      <section class="tweet-container">
      </section>
    </section>

    <section class="search">

      <form action="/search" class="search-form" method="get">
        <input type="text" name="s" placeholder="search user" required>
        <button>submit</button>
      </form>
    </section>
  </main>
  <script src="/js/ajaxSetup.js" type="module"></script>
  <script src="/js/tweet.js" type="module"></script>

</body>

</html>