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
      <form action="/signin" method="post">
        @csrf()
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
        <button>login</button>
       
      </form>
    </section>
  </main>

</body>

</html>