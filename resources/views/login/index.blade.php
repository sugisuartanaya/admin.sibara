<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Admin Sibara</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="images/logo.svg" alt="logo" class="logo">
              </div>          
              <p class="login-card-description">Sign into your account</p>

              <form action="/login" method="post">
                @csrf
                  <div class="form-group mb-4">
                    @if (session()->has('loginError'))
                      <div class="alert alert-danger" role="alert">
                        {{ session('loginError') }}
                      </div>
                    @endif
                    <input type="username" name="username" id="username" class="form-control" placeholder="username" autofocus required >
                    <label for="username" class="sr-only">Username</label>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="password" required>
                  </div>
                  <button class="btn btn-block login-btn mb-4" type="submit"> Login </button>
              </form>
              
                <a href="#!" class="forgot-password-link">Forgot password?</a>
                <br><br>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </main>
</body>
</html>