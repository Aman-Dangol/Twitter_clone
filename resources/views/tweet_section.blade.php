<section class="tweet-container">
  @foreach($content as $tweet)
  <div class="tweet">
    <div>{{$tweet->username}}</div>
    <div>{{$tweet->tweetText}}</div>
    <div class="interactions">
      <a href="/like?id={{$tweet->id}}">like</a>
      <a href="">comments</a>
      @if(Auth::id() == $tweet->userID)
      <a href="">update</a>
      <a href="">delete</a>
      @endif
    </div>
  </div>
  @endforeach
</section>