<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/css/style-home.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
  <button onclick="ajax()">ajax</button>
  <main>
    <section class="navigation">
      <div class="nav-content">profile</div>
      <div class="nav-content">notification</div>
      <div class="nav-content">settings</div>
      <div class="nav-content"><a href="/logout">logout</a></div>
    </section>
    <section class="content-container">
      <form action="/tweet" class="flex-row" method="post">
        @csrf()
        <textarea name="tweetText" id="" cols="30" rows="2" placeholder="whats on your mind ?"></textarea><br />
        @error('tweetText')
        <div class="err">{{$message}}</div>
        @endError()<br />
        <button>post</button>
      </form>
      <section class="contents">
        <section class="hover">for you</section>
        <section class="hover">following</section>
      </section>
      <section class="tweet-container">
        @foreach($content as $tweet)
        <div class="tweet">
          <div>{{$tweet->username}}</div>
          <div>{{$tweet->tweetText}}</div>
          <div class="interactions">
            <a href="">like</a>
            <a href="">comments</a>
            @if(Auth::id() == $tweet->userID)
            <a href="">update</a>
            <a href="">delete</a>
            @endif
          </div>
        </div>
        @endforeach
      </section>
    </section>

    <section class="chats">
      <div>jojo</div>
      <div>dio</div>
    </section>
  </main>
  <script src="/js/ajaxSetup.js" type="module"></script>
  <script>
    function ajax() {
      console.log("button");
      $.ajax({
        type: "post",
        url: '/ajaxReq',
        data: {
          '1': 'asd'
        },
        success: function(data) {
          console.log(data);
          document.getElementsByClassName('tweet-container')[0].innerHTML = data;
        }
      })
    }
  </script>
</body>

</html>