<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>update</title>
</head>

<body>
  udpate query goes here
  <main>
    <section>
      <form action="/update" method="post">
        <input type="text" name="updatedText" value="{{$data[0]->tweetText}}" />
        <button>update</button>
      </form>
    </section>
  </main>
</body>

</html>