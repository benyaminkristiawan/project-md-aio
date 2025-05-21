<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" type="image/png" href="/product-asset/assets/img/icon.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Axoma" />
  <meta name="keywords" content="Axoma" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <title>User Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="shortcut icon" type="image/x-icon" href="aio1.png" />
  <link
    href="static\plugin\bootstrap\css\bootstrap.min.css"
    rel="stylesheet" />
  <link
    href="static\plugin\font-awesome\css\fontawesome-all.min.css"
    rel="stylesheet" />
  <link href="static\plugin\et-line\style.css" rel="stylesheet" />
  <link
    href="static\plugin\themify-icons\themify-icons.css"
    rel="stylesheet" />
  <link
    href="static\plugin\owl-carousel\css\owl.carousel.min.css"
    rel="stylesheet" />
  <link href="static\plugin\magnific\magnific-popup.css" rel="stylesheet" />
  <link href="static\css\style.css" rel="stylesheet" />
  <link
    href="static\css\color\default.css"
    rel="stylesheet"
    id="color_theme" />
</head>

<body class="home-banner-03 theme-bg bg-effect-box">
  <!-- Main content -->
  <section id="home" style="background: linear-gradient(135deg, #d4f0f4, #d4f4ea); height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
              <div class="text-center mb-4">
                <img src="<?= base_url('images/aio-new.png') ?>" alt="logo AIO" style="width: 60px;">
                <h4 class="mt-3" style="font-weight: 700; color: #5e5ee3;">Login</h4>
                <!-- <p class="text-muted">Sign In</p> -->
              </div>
              <form id="loginForm" name="login" action="<?= base_url('/login/auth') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input id="username" type="text" name="username" class="form-control rounded-3" required autofocus placeholder="Enter your username">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input id="password" type="password" name="password" class="form-control rounded-3" required placeholder="Enter your password">
                </div>
                <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Remember this Device</label>
                  </div>
                  <a href="#" class="text-decoration-none" style="color:#5e5ee3;">Forgot Password ?</a>
                </div> -->
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary btn-lg rounded-3" style="background-color: #5e5ee3; border: none;">Sign in</button>
                </div>
                <div class="text-center mt-4">
                  <p>Belum memiliki akun? <a href="/register" class="text-decoration-none" style="color:#5e5ee3;">Buat akun</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script src="static\js\jquery-3.2.1.min.js"></script>
  <script src="static\js\jquery-migrate-3.0.0.min.js"></script>
  <script src="static\plugin\appear\jquery.appear.js"></script>
  <script src="static\plugin\bootstrap\js\popper.min.js"></script>
  <script src="static\plugin\bootstrap\js\bootstrap.js"></script>
  <script src="static\plugin\particles\particles.min.js"></script>
  <script src="static\plugin\particles\particles-app.js"></script>
  <script src="static\js\jquery.parallax-scroll.js"></script>
  <script src="static\js\custom.js"></script>