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
        <section class="tweet">
            <div>userName</div>
            <div>{{$id}}</div>
            <div>context hello world</div>
            <div>interactions</div>
        </section>
        <!-- input comment -->
        <section class="form-section">
            <form action="/addcomment">
                <input type="text" name="commentText" required />
                <input type="text" name="postID" value="{{$id}}" hidden>
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
            </div>
            @endforeach
        </section>
    </main>
</body>

</html>