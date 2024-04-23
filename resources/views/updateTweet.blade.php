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
        <input type="text" name="updatedText" value="{{$data[0]->tweetText}}"  autocomplete="off"/>
        <button>update</button>
      </form>
    </section>
  </main>
</body>

</html>