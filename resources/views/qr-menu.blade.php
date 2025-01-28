<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Menü | Underground</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
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
            <img class="logo-underground" src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 80px">
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
                        <button type="button"
                                class="clear-search"
                                onclick="clearSearch()"
                                aria-label="Aramayı temizle">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="result-count" id="result-count"></div>
                    </div>
                </div>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-center">
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start" data-bs-toggle="pill"
                                href="#tab-{{ $category->id }}">
                                <i class="{{ $category->icon }}" style="color: {{ $category->color }};"></i>
                                <div class="">
                                    <h6>{{ $category->name }}</h6>
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
                                        <div class="menu-item" onclick="showProductDetails({{ $product->id }})">
                                            <div class="position-relative">
                                                <span class="product-counter"
                                                      id="counter-{{ $product->id }}"
                                                      style="display: none;">0</span>
                                                <img class="flex-shrink-0 img-fluid"
                                                src="{{ $product->thumbnail && file_exists(public_path('storage/img/' . $product->thumbnail)) ? asset('storage/img/' . $product->thumbnail) : asset('img/kafe-logo.png') }}"
                                                alt="{{ $product->title }}">
                                            </div>
                                            <div class="item-info">
                                                <h3>{{ $product->title }}</h3>
                                                <p class="product-description">{{ Str::limit($product->body, 25) }}</p>
                                                <h4>{{ $product->price }}₺</h4>
                                            </div>
                                            <div class="product-actions">
                                                <button type="button"
                                                        class="remove-btn"
                                                        onclick="event.stopPropagation(); decreaseQuantity({{ $product->id }})"
                                                        style="display: none;">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                @if($category->name !== 'Aksesuarlar' && $category->name !== 'Abur Cuburlar')
                                                <button type="submit" class="btn-add-cart" onclick="event.stopPropagation();">
                                                    <div class="loading-spinner"></div>
                                                    <div class="button-content">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                    </div>
                                                </button>
                                                @endif
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Ürün Detayları</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="productDetailContent">
                        <!-- Ürün detayları buraya yüklenecek -->
                    </div>
                </div>
            </div>
        </div>
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
