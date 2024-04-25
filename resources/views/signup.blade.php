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
    <section class="form-section">
      <form action="/store" method="post">
        @csrf()

        <div class="form">
          <label for="user-name">user name :</label>
          <input type="user-name" name="username">
          @error('username')
          <span></span>
          <div class="err">{{$message}}</div>
          @enderror()
          <label for="email">email</label>
          <input type="email" name="email">
          @error('email')
          <span></span>
          <div class="err">{{$message}}</div>
          @enderror()
          <label for="password">password</label>
          <input type="password" name="password">
          @error('password')
          <span></span>
          <div class="err">{{$message}}</div>
          @enderror()
        </div>
        <div class="middle">
          <button>sign up</button>
        </div>
        <div class="middle">
          <a href="{{route('login')}}" class="click">go back</a>
        </div>
      </form>
    </section>
  </main>

</body>

</html>