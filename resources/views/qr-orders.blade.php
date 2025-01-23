<!DOCTYPE html>
<html lang="tr">

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
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
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
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
        <nav class="navbar d-flex justify-content-center">
            <img class="logo-underground" src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 80px">
        </nav>
        <!-- Navbar End -->

        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-3 text-success">
                    @if ($order->status === 'Hesap')
                    <h1 class="mb-3 badge bg-primary" style="font-size: 25px">
                        <i class="fa-solid fa-credit-card"></i> Hesabınız İstendi!
                    </h1>
                    <p class="mb-5"><i class="fa-solid fa-circle-info"></i> Hesap isteğiniz alındı. Lüften bekleyiniz...</p>
                    @elseif ($order->orderItems->where('status', 'Yeni Sipariş')->count() > 0)
                    <h1 class="mb-3 badge bg-success" style="font-size: 25px">
                        <i class="fa-regular fa-circle-check"></i> Siparişinizi Aldık!
                    </h1>
                    <p class="mb-5"><i class="fa-solid fa-circle-info"></i> Siparişiniz bize ulaştı bir sonraki süreç için bu sekmeyi açık bırakınız.</p>
                    @elseif ($order->orderItems->where('status', 'Hazırlanıyor')->count() > 0)
                    <h1 class="mb-3 badge text-dark bg-warning" style="font-size: 25px">
                        <i class="fa-solid fa-spinner fa-spin"></i> Siparişiniz Hazırlanıyor
                    </h1>
                    <p class="mb-5"><i class="fa-solid fa-circle-info"></i> Siparişiniz şu an da hazırlanıyor...</p>
                    @elseif ($order->status === 'Self' && $order->orderItems->where('status', 'Teslim Edildi')->count() > 0)
                    <h1 class="mb-3 badge bg-success" style="font-size: 25px">
                        <i class="fa-solid fa-cookie-bite"></i> Siparişiniz Hazırlandı!
                    </h1>
                    <p class="mb-5"><i class="fa-solid fa-circle-info"></i> Kasaya gelip self servis olarak siparişinizi alabilirsiniz.</p>
                    @elseif ($order->orderItems->where('status', 'Teslim Edildi')->count() > 0)
                    <h1 class="mb-3 badge bg-primary" style="font-size: 25px">
                        <i class="fa-solid fa-cookie-bite"></i> Afiyet Olsun!
                    </h1>
                    <p class="mb-5"><i class="fa-solid fa-circle-info"></i> Farklı bir sipariş vermek için menüye dönebilirsiniz</p>
                    @else
                    <h1 class="mb-3 text-success">
                        <i class="fa-solid fa-info-circle"></i> Sipariş Durumunuz Belirsiz!
                    </h1>
                    <p class="mb-5"><i class="fa-solid fa-circle-info"></i> Siparişiniz onay bekliyor...</p>
                    @endif
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.1s">

            <div class="container text-dark">
                <div class="d-flex justify-content-between">
                    <p>Masa No: {{ $order->table_number }}</p>
                    <p>Saat: {{ $order->updated_at->format('H:i') }}</p>
                </div>
                <table class="table text-dark">
                    <thead>
                        <tr>
                            <th scope="col">Durum</th>
                            <th scope="col">Ürün</th>
                            <th scope="col">Fiyat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>
                                    @if ($item->status === 'Yeni Sipariş')
                                        <span class="badge bg-primary"><i class="fa-regular fa-star"></i> {{ $item->status }}</span>
                                    @elseif ($item->status === 'Hazırlanıyor')
                                        <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock-rotate-left"></i> {{ $item->status }}</span>
                                    @elseif ($item->status === 'Teslim Edildi')
                                        <span class="badge bg-success"><i class="fa-regular fa-circle-check"></i> {{ $item->status }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->quantity }} x {{ $item->product->title }}</td>
                                <td>{{ $item->price }}₺</td>
                            </tr>
                        @endforeach
                        <tr>
                            @if ($order->ikram > 0)
                                <td colspan="2" class="text-end"><strong>Self Servis İndirimli Tutarı:</strong></td>
                                <td colspan="3"><strong><span class="text-success">{{ $order->total_amount }}₺</span></strong></td>
                            @else
                                <td colspan="2" class="text-end"><strong>Toplam Tutar:</strong></td>
                                <td><strong>{{ $order->total_amount }}₺</strong></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-black footer pt-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="contact-card">
                <div class="contact-header">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="footer-logo">
                    <h4 class="contact-title">{{ $cafe->name }}</h4>
                </div>
                <div class="contact-info">
                    <a href="tel:{{ $cafe->phone }}" class="contact-link">
                        <i class="fa fa-phone contact-icon"></i>
                        <span>{{ $cafe->phone }}</span>
                    </a>
                    <a href="{{ $cafe->address_link }}" target="_blank" class="contact-link">
                        <i class="fa fa-map-marker-alt contact-icon"></i>
                        <span>{{ $cafe->address }}</span>
                    </a>
                    <div class="social-links">
                        <a class="social-link" target="_blank" href="{{ $cafe->insta_link }}" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <a href="https://harpysocial.com" target="_blank" class="copyright-link">
                    Harpy Social &copy; 2025
                </a>
                <span class="copyright-divider">|</span>
                <span>Tüm hakları saklıdır.</span>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <nav class="navbar navbar-expand-lg fixed-bottom">
        <div class="container d-flex justify-content-center">
            @if ($order->status === 'Hesap')
            <p class="text-light my-2"><i class="fa-solid fa-circle-info"></i> Hesap isteğiniz bize ulaştı teşekkür ederiz.</p>
            @else
            <p class="text-light my-2"><i class="fa-solid fa-circle-info"></i> Masanızdan kalkmadan hesabı isteyebilirsiniz.</p>
            @endif
            <div class="container d-flex justify-content-center mb-2">
            @if ($order->status === 'Hesap')
                <a class="btn btn-warning btn-md ms-2"><i class="fa-solid fa-clock"></i> Hesap İstendi</a>
            @else
            <form action="{{ route('order.come') }}" method="POST" onsubmit="return confirmSubmit();">
                @csrf
                <input type="hidden" name="table_number" value="{{ $order->table_number }}">
                <button type="submit" class="btn btn-light btn-md ms-2">
                    <i class="fa-solid fa-credit-card"></i> Hesabı İste
                </button>
            </form>

            <script>
                function confirmSubmit() {
                    return confirm("Hesabı istediğinize emin misiniz?");
                }
            </script>

            @endif
                <a href="{{ route('index', ['table' => $tableNumber]) }}" class="btn btn-light btn-md ms-2"><i class="fa-solid fa-book-open"></i> Menüye Dön</a>
            </div>
        </div>
    </nav>

    <script>
        setInterval(function() {
            location.reload();
        }, 15000);
    </script>

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
