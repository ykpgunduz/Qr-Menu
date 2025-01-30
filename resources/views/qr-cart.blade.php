<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Sipariş Ürünleri | Underground</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
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
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .cart-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .cart-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .cart-header h1 {
            color: #1a1a1a;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .service-options {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 30px;
        }

        .option {
            position: relative;
            width: 160px;
            height: 110px;
            background: #fff;
            border: 2px solid #e5e5e5;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 12px;
            opacity: 0.7;
        }

        .option i {
            font-size: 22px;
            color: #666;
            margin-bottom: 8px;
        }

        .option span {
            font-weight: 500;
            color: #666;
            font-size: 0.9rem;
        }

        .option small {
            color: #888;
            margin-top: 3px;
            font-size: 0.75rem;
        }

        .option.selected {
            background: #1a1a1a;
            border-color: #1a1a1a;
            opacity: 1;
        }

        .option.selected i,
        .option.selected span,
        .option.selected small {
            color: #fff;
        }

        .cart-item {
            background: #fff;
            border-radius: 12px;
            margin-bottom: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            border: 1px solid #eee;
            width: 100%;
        }

        .cart-item-content {
            display: flex;
            align-items: center;
            padding: 12px;
            gap: 12px;
        }

        .cart-item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-item-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .cart-item-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
        }

        .cart-item-price {
            font-size: 0.9rem;
            font-weight: 500;
            color: #1a1a1a;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-radius: 20px;
            padding: 2px;
            border: 1px solid #eee;
            width: fit-content;
            margin-left: auto;
        }

        .quantity-btn {
            width: 24px;
            height: 24px;
            border: none;
            background: #fff;
            color: #1a1a1a;
            font-size: 10px;
            cursor: pointer;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-input {
            width: 30px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 13px;
            padding: 0;
        }

        .note-input {
            width: 100%;
            margin-top: 8px;
            padding: 8px 12px;
            border: 1px solid #eee;
            border-radius: 8px;
            font-size: 0.85rem;
            background: #f8f9fa;
        }

        .cart-summary {
            background: #1a1a1a;
            border-radius: 12px;
            padding: 15px;
            margin: 15px 0;
        }

        .total-amount {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
        }

        .bottom-nav {
            background: #fff;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .nav-btn {
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .menu-btn {
            background: #f8f9fa;
            color: #1a1a1a;
            border: 1px solid #e5e5e5;
        }

        .menu-btn:hover {
            background: #1a1a1a;
            color: #fff;
            border-color: #1a1a1a;
        }

        .confirm-btn {
            background: #1a1a1a;
            color: #fff;
            border: none;
        }

        .confirm-btn:hover {
            background: #000;
        }

        #error-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc3545;
            color: #fff;
            padding: 12px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
            display: none;
            z-index: 9999;
        }

        /* Toast mesaj stilleri */
        .toast-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(-100%);
            background: white;
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .toast-message.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        .toast-success {
            border-left: 4px solid #28a745;
        }

        .toast-error {
            border-left: 4px solid #dc3545;
        }

        .toast-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toast-success i {
            color: #28a745;
        }

        .toast-error i {
            color: #dc3545;
        }

        .toast-message span {
            color: #333;
            font-size: 14px;
            font-weight: 500;
        }

        /* Sepet boş mesajı için stil */
        .empty-cart {
            text-align: center;
            padding: 30px;
            color: #666;
        }

        .empty-cart i {
            font-size: 40px;
            margin-bottom: 15px;
            color: #ddd;
        }

        @media (max-width: 480px) {
            .cart-container {
                padding: 10px;
            }

            .cart-item {
                margin-bottom: 10px;
            }

            .cart-item-content {
                padding: 10px;
            }

            .cart-item-title {
                font-size: 0.9rem;
            }

            .cart-item-price {
                font-size: 0.95rem;
            }

            .quantity-btn, .remove-btn {
                width: 24px;
                height: 24px;
            }

            .note-input {
                padding: 6px 10px;
            }
        }

        .service-selection-container {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 10px;
            border: 1px dashed #ddd;
            position: relative;
        }

        .service-selection-container.required::after {
            content: '*';
            color: #dc3545;
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 20px;
        }

        .service-header {
            margin-bottom: 20px;
        }

        .service-title {
            color: #1a1a1a;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .service-subtitle {
            color: #666;
            font-size: 0.9rem;
            margin: 0;
        }

        .service-subtitle .required-text {
            color: #dc3545;
            font-size: 0.8rem;
            margin-left: 5px;
        }

        .option::before {
            content: '';
            position: absolute;
            top: 10px;
            right: 10px;
            width: 18px;
            height: 18px;
            border: 2px solid #ddd;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .option.selected::before {
            background: #1a1a1a;
            border-color: #1a1a1a;
        }

        .option.selected::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            font-size: 10px;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .recommended-carousel {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 10px 0;
            scroll-behavior: smooth;
        }

        .recommended-product-card {
            min-width: 150px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #eee;
        }

        .recommended-product-card img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }

        .recommended-product-card .info {
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        .product-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .price-add {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
        }

        .product-price {
            font-size: 0.85rem;
            font-weight: 600;
            color: #666;
        }

        .add-to-cart-btn {
            font-size: 0.75rem;
            padding: 5px 10px;
        }

        .add-to-cart-btn:hover {
            background: #1a1a1a;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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

        <style>
            #error-message {
                position: fixed;
                top: 80px;
                right: 20px;
                background-color: #a72828;
                color: white !important;
                padding: 10px 20px;
                border-radius: 5px;
                display: none;
                z-index: 9999;
                transition: opacity 0.5s, visibility 0.5s;
            }
        </style>

        <div id="error-message" class="text-center" style="display: none; color: red;">Lütfen bir servis türü seçiniz!</div>


        <form action="{{ route('store') }}" method="POST" id="form1">
            @csrf
            <input type="hidden" name="cart_items" id="cart_items">
            <input type="hidden" name="table_number" value="{{ $tableNumber }}" class="form-control" required>
            <input type="hidden" name="session_id" value="{{ $sessionId }}" class="form-control" required>
            <input type="hidden" name="device_info" value="{{ $deviceInfo }}" class="form-control" required>
            <input type="hidden" name="status" id="status" value="service">
        <!-- Menu Start -->

        <div class="container py-3">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-selection-container required">
                    <div class="service-header">
                        <h6 class="service-title">Servis Türü Seçiniz</h6>
                        <p class="service-subtitle">
                            Siparişinizi nasıl almak istersiniz?
                        </p>
                    </div>

                    <div class="mb-3 d-flex justify-content-center">
                        <div class="option me-2" id="Masa">
                            <i class="fas mb-3 fa-2xl fa-concierge-bell"></i>
                            <span>Masaya Servis</span>
                        </div>
                        <div class="option ms-2" id="Self">
                            <i class="fas fa-2xl mt-2 mb-4 fa-shopping-bag"></i>
                            <span>Self Servis</span>
                            <small>%5 İndirimli</small>
                        </div>
                    </div>
                </div>

                <script>
                    const options = document.querySelectorAll('.option');
                    const status = document.getElementById('status');

                    function showToast(type, message) {
                        $('.toast-message').remove();

                        const toast = $(`
                            <div class="toast-message toast-${type}">
                                <div class="toast-content">
                                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                                    <span>${message}</span>
                                </div>
                            </div>
                        `);

                        $('body').append(toast);
                        setTimeout(() => toast.addClass('show'), 100);

                        setTimeout(() => {
                            toast.removeClass('show');
                            setTimeout(() => toast.remove(), 300);
                        }, 3000);
                    }

                    options.forEach(option => {
                        option.addEventListener('click', () => {
                            options.forEach(o => o.classList.remove('selected'));
                            option.classList.add('selected');
                            status.value = option.id;
                        });
                    });

                    document.getElementById('form1').addEventListener('submit', function (event) {
                        const status = document.getElementById('status').value;

                        if (!status || (status !== 'Masa' && status !== 'Self')) {
                            event.preventDefault();
                            showToast('error', 'Servis türü seçiniz.');
                        }
                    });

                    options.forEach(option => {
                        option.addEventListener('click', () => {
                            options.forEach(o => o.classList.remove('selected'));
                            option.classList.add('selected');
                            status.value = option.id;
                        });
                    });

                </script>
                    <div id="cart-items" class="cart-container">
                        @if(count($cartItems) == 0)
                        <div class="empty-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Sepetinizde ürün bulunmamaktadır.</p>
                        </div>
                        @else
                            @foreach ($cartItems as $cartItem)
                            <div class="cart-item" data-id="{{ $cartItem->id }}" data-price="{{ $cartItem->price }}">
                                <div class="cart-item-content">
                                    <img class="cart-item-image"
                                    src="{{ $cartItem->product->thumbnail && file_exists(public_path('storage/img/' . $cartItem->product->thumbnail)) ? asset('storage/img/' . $cartItem->product->thumbnail) : asset('img/cafe-logo.png') }}"
                                    alt="{{ $cartItem->product->title }}">
                                    <div class="cart-item-info">
                                        <h5 class="cart-item-title">{{ $cartItem->product->title }}</h5>
                                        <span class="cart-item-price">{{ $cartItem->price }}₺</span>
                                    </div>

                                    <div class="quantity-control">
                                        <button type="button" class="quantity-btn decrease-btn" data-id="{{ $cartItem->id }}">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" value="{{ $cartItem->quantity }}"
                                               class="quantity-input" id="quantity-{{ $cartItem->id }}" readonly>
                                        <button type="button" class="quantity-btn increase-btn" data-id="{{ $cartItem->id }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <input type="text"
                                       name="notes[{{ $cartItem->id }}]"
                                       class="note-input"
                                       placeholder="Sipariş notunuz... (opsiyonel)"
                                       value="{{ $cartItem->note ?? '' }}">
                            </div>
                            @endforeach

                            <div class="cart-summary">
                                <div class="total-amount">
                                    <span>Toplam Tutar</span>
                                    <span>{{ $totalAmount }}₺</span>
                                </div>
                            </div>
                        @endif

                        @if($products->where('star', true)->isNotEmpty())
                        <div class="recommended-products my-4">
                            <h5 class="text-center mb-3">Yanında İyi Gider...</h5>
                            <div class="recommended-carousel">
                                @foreach ($products->where('star', true) as $product)
                                <div class="recommended-product-card">
                                    <img src="{{ $product->thumbnail && file_exists(public_path('storage/img/' . $product->thumbnail)) ? asset('storage/img/' . $product->thumbnail) : asset('img/cafe-logo.png') }}" alt="{{ $product->title }}" style="max-width: 150px; height: auto; object-fit: cover;">
                                    <div class="info">
                                        <h6 class="product-title">{{ $product->title }}</h6>
                                        <div class="price-add">
                                            <span class="product-price">{{ $product->price }}₺</span>
                                            <button class="btn btn-sm btn-dark add-to-cart-btn" data-id="{{ $product->id }}"><i class="fa-solid fa-cart-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    </div>
            </div>
        </div>
        <!-- Menu End -->

        <div id="success-message" class="text-center" style="display: none; color: green;"></div>

    </div>

    <nav class="navbar navbar-expand-lg fixed-bottom">
        <div class="container d-flex justify-content-center my-2">
            <a href="{{ route('index', ['table' => $tableNumber]) }}" class="btn btn-light btn-md ms-2"><i class="fa-solid fa-book-open"></i> Menüye Dön</a>
            <button type="submit" form="form1" value="Submit" class="btn btn-success ms-3"><i class="fa-solid fa-circle-check"></i> Siparişi Onayla</button>
        </div>
    </nav>

</form>

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
    <script src="js/main.js"></script>

    <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form1').on('submit', function(e) {
            e.preventDefault();

            const selectedService = document.querySelector('.option.selected');
            if (!selectedService) {
                showToast('error', 'Servis türü seçiniz!');
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return false;
            }

            // Butonu devre dışı bırak
            $('button[type="submit"]').prop('disabled', true);

            updateCartItems().then(() => {
                this.submit();
            }).catch(() => {
                // Hata durumunda butonu tekrar etkinleştir
                $('button[type="submit"]').prop('disabled', false);
            });
        });

        $('.option').on('click', function() {
            $('.option').removeClass('selected');
            $(this).addClass('selected');
            $('#status').val($(this).attr('id'));
        });

        async function updateCartItems() {
            try {
                const response = await $.ajax({
                    url: '/cart/get-items',
                    type: 'GET',
                    data: {
                        table: '{{ $tableNumber }}',
                        session_id: '{{ $sessionId }}'
                    }
                });

                $('#cart_items').val(JSON.stringify(response.cartItems));
            } catch (error) {
                console.error('Cart items güncellenirken hata:', error);
                showToast('error', 'Sipariş gönderilemedi');
                return false;
            }
        }

        // Miktar güncelleme işlemleri
        $('.increase-btn, .decrease-btn').on('click', function() {
            const productId = $(this).data('id');
            const change = $(this).hasClass('increase-btn') ? 1 : -1;
            const tableNumber = '{{ $tableNumber }}';

            $.ajax({
                url: '/cart/update/' + productId,
                type: 'POST',
                data: {
                    quantity_change: change,
                    table: tableNumber
                },
                success: function(response) {
                    if (response.success) {
                        const quantityInput = $(`#quantity-${productId}`);
                        let newQuantity = parseInt(quantityInput.val()) + change;

                        if (newQuantity <= 0) {
                            $(`[data-id="${productId}"]`).closest('.cart-item').fadeOut(300, function() {
                                $(this).remove();
                                if ($('.cart-item').length === 0) {
                                    $('#cart-items').html(`
                                        <div class="empty-cart">
                                            <i class="fas fa-shopping-cart"></i>
                                            <p>Sepetinizde ürün bulunmamaktadır.</p>
                                        </div>
                                    `);
                                }
                            });
                        } else {
                            quantityInput.val(newQuantity);
                        }

                        if (response.totalAmount) {
                            $('.total-amount span:last-child').text(response.totalAmount + '₺');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                    showToast('error', 'İşlem gerçekleştirilemedi');
                }
            });
        });
    });

    $(document).ready(function () {
        $('.add-to-cart-btn').on('click', function () {
            const productId = $(this).data('id');
            $.ajax({
                url: '/cart/add',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    product_id: productId,
                },
                success: function (response) {
                    if (response.success) {
                        showToast('success', 'Ürün sepete eklendi!');
                    } else {
                        showToast('error', 'Ürün sepete eklenemedi.');
                    }
                },
                error: function () {
                    showToast('error', 'Bir hata oluştu.');
                },
            });
        });
    });
    </script>

</body>
</html>
