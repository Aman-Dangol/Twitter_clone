<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>comments</title>
    <link rel="stylesheet" href="/css/commentCss.css" />
</head>

<body>
    <main>
        <section class="navigation">
            <div class="nav-content"><a class="profile" href="/profile/{{Auth::id()}}">{{Auth::user()->username}}</a></div>
            <div class="nav-content"><a href="{{route('home-page')}}">home</a></div>
            <div class="nav-content"><a href="/settings">Settings</a></div>
            <div class="nav-content"><a href="/logout" class="logout">logout</a></div>
        </section>
        <section>
            <section class="tweet">
                <div><a href="/profile/{{$mainPost[0]->userID}}">{{$mainPost[0]->username}}</a></div>
                <div></div>
                <div>{{$mainPost[0]->tweetText}}</div>
                <div>
                    <span>{{$mainPost[0]->likeCount}}</span>
                    @if($mainPost[0]->userLiked == 0)
                    <a class="like post" id="{{$mainPost[0]->id}}">like</a>
                    @else
                    <a class="unlike post" id="{{$mainPost[0]->id}}">unlike</a>
                    @endif
                </div>
            </section>
            <!-- input comment -->
            <section class="form-section">
                <form action="/addcomment">
                    <input type="text" name="commentText" required autocomplete="off" autofocus />
                    <input type="text" id="postID" name="postID" value='{{$mainPost[0]->id}}' hidden>
                    @error('commentText')
                    <span>{{$message}}</span>
                    @enderror()
                    <button>comment</button>
                </form>
            </section>
            <!-- comments -->
            <section>
                @foreach($comments as $comment)
                <div class="comment">
                    <div><a href="/profile/{{$comment->id}}">{{$comment->username}}</a></div>
                    <div>{{$comment->commentText}}</div>
                    <div class="interactions">

                    </div>
                </div>
                @endforeach
            </section>
        </section>
    </main>
    <script src="/js/ajaxSetup.js" type="module"></script>
    <script src="/js/commentSection.js" type="module"></script>
</body>

</html>