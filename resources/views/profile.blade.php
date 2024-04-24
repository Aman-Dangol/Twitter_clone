<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/profile.css">
  <title>Document</title>
</head>

<body>
  <main>
    <section class="navigation">
      <div class="nav-content"><a class="profile" href="{{route('home-page')}}">Home</a></div>
      <div class="nav-content">settings</div>
      <div class="nav-content"><a href="/logout" class="logout">logout</a></div>
    </section>
    <section>
      <section class="main-profile">
        <h1>Profile</h1>
        <div class="user-info-container">
          <div class="user-info">
            Name : {{Auth::user()->username}} <br>
            UID : {{Auth::user()->id}} <br>
            E-mail : {{Auth::user()->email}} <br>
          </div>
        </div>
      </section>
      <section id="postsTab">
      </section>
    </section>
  </main>

  <script src="/js/ajaxSetup.js" type="module"></script>
  <script src="/js/profile.js" type="module"></script>
</body>

</html>