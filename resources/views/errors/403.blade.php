<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>403 Akses Ditolak</title>

  <link rel="icon" type="image/png" href="{{ asset('images/logo2.png') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <style>
    .container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    @media screen and (max-width: 768px) {
      .container {
        width: 90%; /* Sesuaikan dengan lebar yang diinginkan */
      }
    }
  </style>
</head>
<body>
	
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <img src="{{ asset('images/403.png') }}" alt="" style="max-width: 200px; display: block; margin: 0 auto;">
      </div>
      <div class="col-md-12 text-center">
        <h1 class="text-3xl font-medium">
          <strong>Access Denied</strong>
        </h1>
        <p class="text-xl mt-4 mb-0">
          The page you are trying to access has restricted access.
        </p>
        <p class="mt-0">Please refer to the system administrator.</p>
        <a href="https://admin.sipbaran.com" class="btn btn-success">Back Home</a>
      </div>
    </div>
  </div>

</body>
</html>
