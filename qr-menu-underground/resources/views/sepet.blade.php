<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        #success-message {
        position: fixed;
        top: 70px;
        right: 20px;
        background-color: #28a745; /* Yeşil arka plan */
        color: white !important; /* Beyaz yazı rengi */
        padding: 10px 20px;
        border-radius: 5px;
        display: none;
        z-index: 9999;
        transition: opacity 0.5s, visibility 0.5s;
    }
    </style>
</head>
<body>
    <div class="container bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Yükleniyor...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
            <h1 class="text-primary m-0"><i class="fa fa-coffee me-3"></i>Underground</h1>
            <a href="{{ route('index', ['table' => $tableNumber]) }}">Menüye Git</a>
        </nav>
        <!-- Navbar & Hero End -->

        <!-- Menu Start -->
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text fw-normal">Coffee Shop</h5>
                <h1 class="mb-5">Sepetinizdeki Ürünler</h1>
                <div id="cart-items">
                    @foreach($cartItems as $cartItem)
                    <div class="col-lg-6 mb-3 cart-item" data-id="{{ $cartItem->id }}" data-price="{{ $cartItem->price }}">
                        <div class="d-flex align-items-center">
                            <img class="flex-shrink-0 img-fluid rounded" src="{{ asset('storage/' . $cartItem->product->thumbnail) }}" alt="" style="width: 80px;">
                            <div class="w-100 d-flex flex-column text-start ps-4">
                                <h5 class="d-flex justify-content-between border-bottom pb-2">
                                    <span>{{ $cartItem->product->title }}</span>
                                    <span class="text">{{ $cartItem->price }}₺</span>
                                </h5>
                                <p class="d-flex justify-content-between">
                                    <small class="fst-italic">{{ $cartItem->product->body }}</small>
                                    <small class="">{{ $cartItem->quantity }} Adet</small>
                                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST" class="remove-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"><i class="fa-solid fa-close"></i></button>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-end mt-5">
                    <h5 class="mb-5" id="total-amount">Sepet Tutar: {{ $totalAmount }}₺</h5>
                </div>
            </div>
        </div>
        <!-- Menu End -->

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-12 text-center">
                        <h4 class="section-title text-center text-white text fw-normal mb-4">İletişim Bilgilerimiz</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Bakırköy - İstanbul</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>iletisim@undergroundcoffe.com</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <h4 class="section-title text-white fw-normal mb-4">Çalışma Saatlerimiz</h4>
                        <h6 class="text-light fw-normal">Haftaiçi | 10.00 - 00.00</h6>
                        <h6 class="text-light fw-normal">Haftasonu | 10.00 - 02.00</h6>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-12 text-center mb-3 mb-md-0">
                            <a href="#">Harpy Social &copy; 2024</a> | Tüm hakları saklıdır.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

    </div>

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

    <script>
        $(document).ready(function () {
            $('.remove-form').on('submit', function (event) {
                event.preventDefault(); // Formun varsayılan gönderimini engelle
                var form = $(this);
                var formData = new FormData(this);
                var itemPrice = parseFloat(form.closest('.cart-item').data('price'));

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Başarılı olduğunda yapılacak işlemler
                        form.closest('.cart-item').remove(); // Ürünü kaldır

                        // Sepet toplamını güncelle
                        var currentTotal = parseFloat($('#total-amount').text().replace('Sepet Tutar: ', '').replace('₺', ''));
                        var newTotalAmount = currentTotal - itemPrice;
                        $('#total-amount').text('Sepet Tutar: ' + newTotalAmount.toFixed(2) + '₺');

                        // Başarı mesajını göster
                        $('#success-message').text('Ürün başarıyla silindi.').fadeIn().delay(3000).fadeOut();
                    },
                    error: function (response) {
                        // Hata durumunda yapılacak işlemler
                        $('#success-message').text('Bir hata oluştu.').fadeIn().delay(3000).fadeOut(); // Hata mesajını göster
                    }
                });
            });
        });
    </script>

    <!-- Success Message -->
    <div id="success-message"></div>
</body>
</html>
