<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Twitter Login</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <main>
    <header>
      <h1>Twitter Clone</h1>
    </header>
    <section>
      <form action="/store" method="post">
        @csrf()
        <label for="user-name">user name :</label>
        <input type="user-name" name="username"><br>
        @error('username')
        <div>{{$message}}</div>
        @enderror()
        <label for="email">email</label>
        <input type="email" name="email"><br>
        @error('email')
        <div>{{$message}}</div>
        @enderror()

        <label for="password">password</label>
        <input type="password" name="password"><br>
        @error('password')
        <div>{{$message}}</div>
        @enderror()

        <button>sign up</button>
      </form>
    </section>
  </main>

</body>

</html>