<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .footer {
            background: linear-gradient(to top, #0d2a46, #020020);
            /* Fades from your blue to black */
            color: #FFFFFF;
            padding: 20px;
            display: flex;
            justify-content: center;
            margin-top: 105px;
            flex-wrap: wrap;
            font-family: 'Poppins', sans-serif;
        }

        .footer-container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;

            align-items: flex-start;
            flex-wrap: wrap;
        }

        .footer-logo {
            flex: 1;
            max-width: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 70px 120px 70px 77px;
        }

        .footer-logo .logo {
            width: 200px;
            height: 91.5px;
        }

        .footer-section {
            flex: 1;
            max-width: 250px;
            margin: 0 58.5px;
            align-items: center;
            margin-top: 30px;
            text-align: left;
        }

        .footer-section h3 {
            font-size: 18px;
            font-weight: bold;

            margin-bottom: 20px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .footer-section ul li a {
            color: #FFFFFF;
            text-decoration: none;
            font-size: 12px;
        }

        .footer-section ul li a:hover {
            text-decoration: underline;
        }

        .social-links li {
            display: flex;
            align-items: start;
            margin-bottom: 10px;
        }

        .social-links li i {
            font-size: 1.6rem;
            margin-right: 10px;
        }

        .social-links li a {
            font-size: 14px;
            color: #FFFFFF;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .social-links li a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                align-items: center;
            }

            .footer-section {
                text-align: center;
                margin-bottom: 20px;
            }

            .footer-logo {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <footer class="footer">
        <div class="footer-container">
            <!-- Footer Logo -->
            <div class="footer-logo">
                <img src="/images/aio-white.png" alt="AIO Logo" class="logo">
            </div>

            <!-- Footer Section 1 -->
            <div class="footer-section">
                <h3>AIO STORE</h3>
                <ul>
                    <li><a href="https://www.aiostore.co.id/artikel/" target="_self">Artikel</a></li>
                    <li><a href="https://www.aiostore.co.id/pk-kalkulator/" target="_self">Kalkulator PK</a></li>
                    <li><a href="https://www.aiostore.co.id/karir/" target="_self">Karir</a></li>
                    <li><a href="/catalog" target="_self">Katalog Digital</a></li>
                    <li><a href="https://www.aiostore.co.id/tentang-kami/" target="_self">Tentang kami</a></li>
                </ul>
            </div>

            <!-- Footer Section 2 -->
            <div class="footer-section">
                <h3>INFORMASI</h3>
                <ul>
                    <li><a href="https://www.aiostore.co.id/belanja-online/" target="_self">Belanja Online</a></li>
                    <li><a href="https://www.aiostore.co.id/hubungi-kami/" target="_self">Hubungi Kami</a></li>
                    <li><a href="https://www.aiostore.co.id/lokasi-toko/" target="_self">Lokasi Toko</a></li>
                    <li><a href="https://www.aiostore.co.id/promo-toko/" target="_self">Promo Toko</a></li>
                </ul>
            </div>

            <!-- Footer Section 3 -->
            <div class="footer-section">
                <h3>IKUTI KAMI</h3>
                <ul class="social-links">
                    <li>
                        <a href="https://instagram.com/aiostore.co.id" target="_self">
                            <i class="fab fa-instagram"></i> aiostore.co.id
                        </a>
                    </li>
                    <li>
                        <a href="https://tiktok.com/@aiostore.co.id" target="_self">
                            <i class="fab fa-tiktok"></i> aiostore.co.id
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/aiostore.elektronik" target="_self">
                            <i class="fab fa-facebook"></i> AIO Store
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/@aiochannel8395" target="_self">
                            <i class="fab fa-youtube"></i> AIO Channel
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>