<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                <a href="/likeComment">like</a>
            </div>
        </section>
        <!-- input comment -->
        <section class="form-section">
            <form action="/addcomment">
                <input type="text" name="commentText" required autocomplete="off" autofocus />
                <input type="text" name="postID" value='{{$mainPost[0]->postID}}' hidden>
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
</body>

</html>