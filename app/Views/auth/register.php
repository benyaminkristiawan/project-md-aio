<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(94, 94, 227, 0.25);
            border-color: #5e5ee3;
        }

        label {
            color: #5e5ee3 !important;
        }
    </style>
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
    <!-- <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Poppins, sans-serif;
        }

        /* Center the form on the page */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f6f8;
        }

        /* Form container styling */
        form {
            background-color: #ffffff;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form title */
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form labels */
        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        /* Form inputs */
        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="tel"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            color: #555;
        }

        /* Textarea resizing */
        form textarea {
            resize: vertical;
        }

        /* Button styling */
        form button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Button hover effect */
        form button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Validation error styling */
        form .error {
            color: #d9534f;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 15px;
        }

        /* Responsive styling for mobile */
        @media (max-width: 480px) {
            form {
                padding: 20px;
            }
        }
    </style> -->
</head>

<body>
    <!-- Register Page -->
    <section id="register" style="background: linear-gradient(135deg, #d4f0f4, #d4f4ea); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5">
                    <div class="card shadow border-0 rounded-4" style="margin-top: 40px;margin-bottom: 40px;">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <img src="<?= base_url('static/img/aio.png') ?>" alt="logo AIO" style="width: 50px;">
                                <h4 class="mt-3" style="font-weight: 700; color: #5e5ee3;">Registrasi Akun</h4>
                                <!-- <p class="text-muted">Sign up to start</p> -->
                            </div>
                            <form action="<?= base_url('register/send') ?>" method="post">
                                <?= csrf_field() ?>

                                <?php
                                $fields = [
                                    'name' => 'Nama Lengkap',
                                    'username' => 'Username',
                                    'email' => 'Email',
                                    'password' => 'Password',
                                    'phone' => 'No. HP'
                                ];

                                foreach ($fields as $name => $label) {
                                    $type = ($name === 'password') ? 'password' : ($name === 'email' ? 'email' : 'text');
                                    echo "
                  <div class='form-floating mb-3'>
                    <input type='{$type}' class='form-control rounded-3' id='{$name}' name='{$name}' placeholder='{$label}' required>
                    <label for='{$name}'>{$label}</label>
                  </div>
                ";
                                }
                                ?>

                                <div class="form-floating mb-3">
                                    <textarea class="form-control rounded-3" placeholder="Alamat lengkap" name="address" id="address" style="height: 80px"></textarea>
                                    <label for="address">Alamat</label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-3" style="background-color: #5e5ee3; border: none;">
                                        Register
                                    </button>
                                </div>

                                <div class="text-center mt-4">
                                    <p>Sudah punya akun?<a href="/" class="text-decoration-none" style="color:#5e5ee3;">Login di sini</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>