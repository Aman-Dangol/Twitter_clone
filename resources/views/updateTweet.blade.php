<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/css/update.css">
  <title>update</title>
</head>

<body>
  <main>
    <header style="text-align: center;">
      <a href="{{route('home-page')}}">
        <h1>Twitter Clone</h1>
      </a>
    </header>
    <section>
      <form action="/update" method="post">
        @csrf()
        <input type="text" name="id" value="{{$data[0]->id}}" hidden>
        <textarea name="updatedText" autocomplete="off" cols="30" rows="7">{{$data[0]->tweetText}}</textarea>
        <div>
          <button>update</button>

        </div>
      </form>
    </section>
  </main>
</body>

</html>