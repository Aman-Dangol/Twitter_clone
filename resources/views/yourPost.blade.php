<div>
  @foreach($posts as $tweet)

  <div class="tweet">
    <div>{{$tweet->username}}</div>
    @if(Auth::id() != $tweet->userID)
  
    @endif
    <div class="tweetText">{{$tweet->tweetText}}</div>
    <div class="interactions">
      @if (!$tweet->userLiked)
      <span>{{$tweet->likeCount}}</span> <a class="like" id="{{$tweet->id}}">like</a>
      @else
      <span>{{$tweet->likeCount}}</span> <a class="unlike " id="{{$tweet->id}}">unlike</a>
      @endif()
      <a href="/comment/{{$tweet->id}}">comments</a>
      @if(Auth::id() == $tweet->userID)
      <a href="/updateTweet?id={{$tweet->id}}">update</a>
      <a id="{{$tweet->id}}" class="post">delete</a>
      @endif
    </div>

  </div>
  @endforeach
</div>