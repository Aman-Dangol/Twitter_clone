<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Twitter Login</title>
</head>

<body>
  <main>
    <section>
      <form action="/sign-in" method="post">
        @csrf()
        <label for="email">email</label>
        <input type="email" name="email" required><br>
        <label for="password">password</label>
        <input type="password" name="password" required><br>
        <button>login</button>
      </form>
    </section>
  </main>

</body>

</html>