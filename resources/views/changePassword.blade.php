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
      <div class="nav-content">settings</div>
      <div class="nav-content"><a href="/logout" class="logout">logout</a></div>
    </section>
    <section>
      <form action="/changepass" id="password-change" method="post">
        @csrf()
        <label for="oldpass">enter previous password</label>
        <input type="text" name="oldPass">
        @error('oldPass')
        {{$message}}
        @endError()
        <label for="newpass">enter new password</label>
        <input type="text" name="newPass">
        @error('newPass')
        {{$message}}
        @endError()
        <button>submit</button>
      </form>
    </section>

    <section>
    </section>
  </main>
  <script src="/js/ajaxSetup.js" type="module"></script>
  <script src="/js/tweet.js" type="module"></script>

</body>

</html>