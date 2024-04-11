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
    <!-- <hr> -->
    <section class="form-section">
      <form action="/signin" method="post">
        @csrf()
        <div class="form">
          <label for="email">email</label>
          <input type="email" name="email" required>
          <span></span>
          <span class="err" id="EmailErr"> </span>
          @error('email')
          <script>
            document.getElementById('EmailErr').innerText = "{{$message}}";
          </script>
          @enderror()
          <label for="password">password</label>
          <input type="password" name="password" required>
          <span></span>
          <span class="err" id="passErr"></span>
          @error('password')
          <script>
            document.getElementById('passErr').innerText = "{{$message}}";
          </script>
          @enderror()

        </div>

        <div class="button">
          <button>login</button>
        </div>
      </form>
    </section>
    <!-- <hr> -->
    <section>
      <p class="text-center">create account ? <a href="{{route('signup')}}">sign-up</a></p>
    </section>
  </main>

</body>

</html>