<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Menü | Underground</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('images/favicon.png') }}" rel="icon">
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
    <link href="css/menu.css" rel="stylesheet">
    <meta name="add-to-cart-url" content="{{ route('addToCart') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="text-nav">
    <div class="container-fluid bg-white p-0">
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Yükleniyor...</span>
            </div>
        </div>
        <nav class="navbar d-flex justify-content-center">
            <img class="logo-underground" src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 80px">
        </nav>
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="mb-4">
                    <div class="search-container">
                        <input type="text"
                               id="search-bar"
                               class="form-control"
                               placeholder="Menüde ara..."
                               onkeyup="debouncedSearch()">
                        <div class="result-count" id="result-count"></div>
                    </div>
                </div>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-center">
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 mt-4 pb-3" data-bs-toggle="pill"
                                href="#tab-{{ $category->id }}">
                                <i class="{{ $category->icon }} fa-xl" style="color: {{ $category->color }};"></i>
                                <div class="ps-2 pt-1">
                                    <h6 class="mt-n1 mb-0">{{ $category->name }}</h6>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <hr>
                <div class="tab-content">
                    @foreach ($categories as $category)
                        <div id="tab-{{ $category->id }}" class="tab-pane fade p-0">
                            <div class="row g-4">
                                <div class="menu-grid">
                                @foreach ($products->where('category_id', $category->id) as $product)
                                @if($product->active)
                                    <form class="add-to-cart-form"
                                          data-product-id="{{ $product->id }}"
                                          data-table-number="{{ request()->get('table') }}">
                                        @csrf
                                        <div class="menu-item">
                                            <div class="position-relative">
                                                <span class="product-counter"
                                                      id="counter-{{ $product->id }}"
                                                      style="display: none;">0</span>
                                                <img class="flex-shrink-0 img-fluid"
                                                     src="https://kahhve.com/blog/wp-content/uploads/2022/06/filtre-kahve-cekirdegi-scaled.jpg">
                                            </div>
                                            <div class="item-info">
                                                <h3>{{ $product->title }}</h3>
                                                <h4>{{ $product->price }}₺</h4>
                                            </div>
                                            <div class="product-actions">
                                                <button type="button"
                                                        class="remove-btn"
                                                        onclick="decreaseQuantity({{ $product->id }})"
                                                        style="display: none;">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <button type="submit" class="btn-add-cart">
                                                    <div class="loading-spinner"></div>
                                                    <div class="button-content">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                        <span>Ekle</span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                @endforeach
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-black footer pt-4 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="contact-card">
                    <div class="contact-header">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="footer-logo">
                        <h4 class="contact-title">Underground Coffee</h4>
                    </div>
                    <div class="contact-info">
                        <a href="tel:+905442783543" class="contact-link">
                            <i class="fa fa-phone contact-icon"></i>
                            <span>+90 (544) 278 35 43</span>
                        </a>
                        <a href="https://g.co/kgs/xF1TGBg" target="_blank" class="contact-link">
                            <i class="fa fa-map-marker-alt contact-icon"></i>
                            <span>Kartaltepe Mah. Gençler Cd. No: 2B Bakirköy/İstanbul</span>
                        </a>
                        <div class="social-links">
                            <a class="social-link" target="_blank" href="https://www.instagram.com/undergroundcoffee.shop/" aria-label="Instagram">
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
    </div>

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
    <script src="js/main.js"></script>
    <script src="js/menu.js"></script>

    <script>
        $(document).ready(function() {
            $('.add-to-cart-form').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var url = '{{ route('addToCart') }}';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        $('#success-message').text(response.message).show();
                        setTimeout(function() {
                            $('#success-message').fadeOut();
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        $('#error-message').text('Sayfayı Yenileyiniz!').show();
                        setTimeout(function() {
                            $('#error-message').fadeOut();
                        }, 3000);
                    }
                });
            });
        });
    </script>

    <nav class="navbar navbar-expand-lg fixed-bottom">
        <div class="container d-flex justify-content-center">
            <p class="my-2 text-light"><i class="fa-solid fa-circle-info"></i> Sipariş vermek için onaya gitmelisiniz.</p>
            <div class="container d-flex justify-content-center mb-2">
                @if($orderItem)
                <a href="{{ route('order', ['table' => $tableNumber]) }}" class="btn btn-light btn-md me-2"><i class="fa-solid fa-receipt"></i> Siparişlerim</a>
                @endif
                <a href="{{ route('sepet', ['table' => $tableNumber]) }}" class="btn btn-primary btn-md ms-2"><i class="fa-solid fa-diamond-turn-right"></i> Sipariş Onayı</a>
            </div>
        </div>
    </nav>

</body>

</html>
