<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Twitter Clone</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
  <main>
    <header>
      <h1>Twitter Clone</h1>
    </header>
    <section class="form-section">
      <form action="/tweet" method="post">
        @csrf()
        <textarea name="tweetText" id="" cols="30" rows="10" placeholder="{{Auth::id()}}"></textarea> <br>
        @error('tweetText')
        <div>{{$message}}</div>
        @endError()
        <button>submit</button>
      </form>
    </section>
    <section>
      <form action="/logout" method="get">
        <button>logout</button>
      </form>
    </section>
  </main>
</body>

</html>