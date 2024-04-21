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
        <!-- comment header -->
        <a href="{{route('home-page')}}">home</a>
        <section class="tweet">
            <div>{{$mainPost[0]->username}}</div>
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
                <div>{{$comment->username}}</div>
                <div>{{$comment->commentText}}</div>
                <div class="interactions">

                </div>
            </div>
            @endforeach
        </section>
    </main>
    <script src="/js/ajaxSetup.js" type="module"></script>
    <script src="/js/commentSection.js" type="module"></script>
</body>

</html>