<!DOCTYPE html>
<html lang="tr">

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="{{ asset('images/favicon.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Siparişler | Underground</title>
</head>

<body>
    <style>
        .containerr {
            background-color: #ffffff;
            border-radius: 45px;
            display: inline-block;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            text-align: center;
            font-size: 20px;
            border: none;
            background-color: #ffffff;
            color: #202030;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        button {
            color: #FEA116;
            background-color: #ffffff;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        #success-message {
            position: fixed;
            top: 70px;
            right: 20px;
            background-color: #28a745;
            color: white !important;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
            z-index: 9999;
            transition: opacity 0.5s, visibility 0.5s;
        }
    </style>
    <div class="container-fluid bg-white p-0">

        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Yükleniyor...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar Start -->
        <nav class="navbar d-flex align-items-center">
            <div class="d-flex justify-content-center align-items-center">
                <img class="logo-underground" src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 80px">
                {{-- <h2 class="text-nav mt-3">Underground</h2> --}}
            </div>
            <a href="{{ route('index', ['table' => $tableNumber]) }}"><i
                class="mt-3 me-4 fa-solid fa-xl fa-book-open text-nav"></i></a>
        </nav>
        <!-- Navbar End -->
        <div class="container py-5">
            @if ($order)
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text fw-normal">Siparişiniz alındı!</h5>
                    <h1 class="mb-3">Sipariş Bilgileriniz</h1>
                    <p class="mb-3">Siparişiniz kısa bir süre içerisinde hazırlanıp masanıza servis edilecektir, lütfen bu sekmeyi kapatmayın.</p>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                <p><strong>Masa Numarası:</strong> {{ $order->table_number }}</p>
                <h3>Sipariş Ürünleri:</h3>
                <ul>
                    @foreach ($order->orderItems as $item)
                        <li>{{ $item->quantity }} x {{ $item->product->title }} - {{ $item->price }}₺</li>
                    @endforeach
                </ul>
                <p><strong>Toplam Tutar:</strong> {{ $order->total_amount }}₺</p>
                @if ($order->note)
                    <p><strong>Sipariş Notu:</strong> {{ $order->note }}</p>
                @endif

                <div class="container">
                    @if ($order->status === 'Hesap')
                        <p>Hesap İstendi</p>
                    @else
                        <form action="{{ route('order.come', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark btn-sm">Hesabı İste</button>
                        </form>
                    @endif
                </div>
            @else
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text fw-normal">Siparişlerim</h5>
                    <h1 class="mb-5">Henüz Sipariş Vermediniz</h1>
                </div>
            @endif
            </div>
        </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-black text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-12 text-center">
                        <h4 class="section-title text-center text-white text fw-normal mb-4">İletişim Bilgilerimiz</h4>
                        <p class="mb-2"><i class="fa fa-phone me-2"></i>+90 (544) 278 35 43</p>
                        <p class="mb-2">
                            <i class="fa fa-map-marker-alt me-2"></i>
                            Kartaltepe Mah. Gençler Cd. No: 2B<br>Bakirköy/İstanbul</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-outline-light btn-social" target="_blank" href="https://www.instagram.com/undergroundcoffee.shop/">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <h4 class="section-title text-white fw-normal mb-4">Çalışma Saatlerimiz</h4>
                        <h6 class="text-light fw-normal">Her gün | 10.00 - 22.00</h6>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-12 text-center mb-3 mb-md-0">
                            <a href="https://harpysocial.com/" target="_blank">Harpy Social &copy; 2024</a> | Tüm hakları saklıdır.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
