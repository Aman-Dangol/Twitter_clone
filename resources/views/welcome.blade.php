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
    <section>
      <form action="/tweet" method="post">
        @csrf()
        <input type="text" name="tweet">
        <button>submit</button>
      </form>
    </section>
  </main>
</body>

</html>