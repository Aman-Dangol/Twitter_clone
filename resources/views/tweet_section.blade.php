  @foreach($data as $tweet)
  @if(($tweet->userFollow == 1 || $tweet->userID == Auth::id()) || $type == 'foryou')

  <div class="tweet">
    <div class="username" id="{{$tweet->userID}}"><a href="profile/{{$tweet->userID}}">{{$tweet->username}}</a></div>
    @if(Auth::id() != $tweet->userID)
    @if( $tweet->userFollow == 0)
    <div><a href="/follow/{{$tweet->userID}}">follow</a></div>
    @else
    <div><a href="/unfollow/{{$tweet->userID}}" class="unfollow">unfollow</a></div>

    @endif
    @endif

    <div class="tweetText">{{$tweet->tweetText}}</div>
    <div class="interactions">
      @if (!$tweet->userLiked)
      <span>{{$tweet->likeCount}}</span> <a class="like " id="{{$tweet->id}}">like</a>

      @else
      <span>{{$tweet->likeCount}}</span> <a class="unlike " id="{{$tweet->id}}">unlike</a>
      @endif()
      <a href="/comment/{{$tweet->id}}">comments</a>
      @if(Auth::id() == $tweet->userID)
      <a href="/updateTweet?id={{$tweet->id}}">update</a>
      <a id="{{$tweet->id}}" class="post">delete</a>
      @endif
      @endif
    </div>
  </div>
  @endforeach