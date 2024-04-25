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
  <div class="followersList" id="followerList">
    @foreach( $followersList as $follower)
    <a href="/profile/{{$follower->id}}"> {{$follower->username}}
    </a>
    @endforeach
  </div>
  <div class="followingList" id="followingList">
    @foreach( $followingList as $follower)
    <a href="/profile/{{$follower->id}}"> {{$follower->username}}
    </a>
    @endforeach
  </div>
  <main>
    <section class="navigation">
      <div class="nav-content"><a class="profile" href="{{route('home-page')}}">Home</a></div>
      <div class="nav-content"><a href="/settings">Settings</a></div>
      <div class="nav-content"><a href="/logout" class="logout">logout</a></div>
    </section>
    <section>
      <section class="main-profile">
        <h1>Profile</h1>
        <div class="user-info-container">
          <div class="user-info">
            Name : {{$user->username}} <br>
            UID : <span id="userID">{{$user->id}}</span>
            <br>
            E-mail : {{$user->email}} <br>
            <div id="followers"> followers : {{$followers}}
            </div>
            <div id="following"> following : {{$following}}
            </div>
            @if(Auth::id()!= $user->id)
            @if($follows == 1)
            <a href="/unfollow/{{$user->id}}">unfollow</a>
            @else
            <a href="/follow/{{$user->id}}">follow</a>
            @endif
            @endif
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