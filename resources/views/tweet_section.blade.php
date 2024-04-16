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
      <span>{{$tweet->likecount}}</span> <a class="like " id="{{$tweet->id}}">like</a>

      @else
      <span>{{$tweet->likecount}}</span> <a class="unlike " id="{{$tweet->id}}">unlike</a>
      @endif()
      <a href="/comment/{{$tweet->id}}">comments</a>
      @if(Auth::id() == $tweet->userID)
      <a href="/updateTweet?id={{$tweet->id}}">update</a>
      <a id="{{$tweet->id}}" class="post">delete</a>
      @endif
    </div>
  </div>
  @endforeach