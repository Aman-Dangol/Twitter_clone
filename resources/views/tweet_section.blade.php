<section class="tweet-container">
  @php
  $arr =array();
  foreach($liked as $like){
  array_push($arr,$like->postID);
  }
  @endphp
  @foreach($data as $tweet)
  <div class="tweet">
    <div>{{$tweet->username}}</div>
    <div>{{$tweet->tweetText}}</div>
    <div class="interactions">
      @if (!in_array($tweet->id,$arr))
      <span>{{$tweet->likecount}}</span> <a href="/like?id={{$tweet->id}}">like</a>

      @else
      <span>{{$tweet->likecount}}</span> <a href="">unlike</a>
      @endif()
      <a href="">comments</a>
      @if(Auth::id() == $tweet->userID)
      <a href="">update</a>
      <a href="">delete</a>
      @endif
    </div>
  </div>
  @endforeach
</section>