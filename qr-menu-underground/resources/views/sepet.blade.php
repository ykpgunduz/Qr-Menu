<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .containerr{
            background-color: #ffffff;
            border-radius: 45px;
            display: inline-block;
        }
        input[type="number"]{
            -moz-appearance: textfield;
            text-align: center;
            font-size: 20px;
            border: none;
            background-color: #ffffff;
            color: #202030;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button{
            -webkit-appearance: none;
            margin: 0;
        }
        button{
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

        <!-- Navbar Start -->
        <nav class="navbar d-flex align-items-center">
            <div class="d-flex justify-content-center align-items-center">
                <img class="logo-underground" src="{{ asset('storage/img/logo.jpg') }}" alt="Logo">
                <h2 class="text-nav mt-3">Underground</h2>
            </div>
            <a href="{{ route('index', ['table' => $tableNumber]) }}"><i class="mt-3 me-4 fa-solid fa-xl fa-book-open text-nav"></i></a>
        </nav>
        <!-- Navbar End -->

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
                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST" class="remove-form" data-id="{{ $cartItem->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                        <span>{{ $cartItem->product->title }}</span>
                                        <span class="text">{{ $cartItem->price }}₺</span>
                                    </h5>
                                    <div class="d-flex justify-content-between align-items-center cart-item" data-id="{{ $cartItem->id }}">
                                        <small class="fst-italic text-black product-body">{{ Str::limit($cartItem->product->body, 20) }}</small>
                                        <div class="containerr">
                                            <button type="button" class="update-quantity" data-change="-1"> - </button>
                                            <input type="number" name="quantity" min="1" max="20" step="1" disabled value="{{ $cartItem->quantity }}" readonly>
                                            <button type="button" class="update-quantity" data-change="1"> + </button>
                                        </div>
                                        <button type="submit" class="btn btn-danger btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            <i class="fa-solid fa-close"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-end mt-5">
                    <h5 class="mb-5" id="total-amount">Sepet Tutarı: {{ $totalAmount }}₺</h5>
                </div>
                <div class="text-end">
                    <form action="{{ route('store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_items" value="{{ json_encode($cartItems) }}">
                        <div class="mb-3">
                            <input type="hidden" name="table_number" value="{{ $tableNumber }}" id="table_number" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-dark btn-sm">Sepeti Onayla</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Menu End -->

         <!-- Success Message -->
         <div id="success-message" class="text-center" style="display: none; color: green;"></div>

        <!-- Footer Start -->
        <div class="container-fluid bg-black text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-12 text-center">
                        <h4 class="section-title text-center text-white text fw-normal mb-4">İletişim Bilgilerimiz</h4>
                        <p class="mb-2"><i class="fa fa-phone me-2"></i>+90 (544) 278 35 43</p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-2"></i>Kartaltepe Mah. Gençler Cd. No: 2B Bakirköy/İstanbul</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
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
                            <a href="#">Harpy Social &copy; 2024</a> | Tüm hakları saklıdır.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        <!-- Custom JavaScript -->
        <script>
            function updateCartItemQuantity(cartItemId, newQuantity) {
                $.ajax({
                    url: `/cart/update/${cartItemId}`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: newQuantity
                    },
                    success: function(response) {
                        let cartItem = $(`[data-id='${cartItemId}']`);
                        let itemPriceElement = cartItem.find('.text');
                        let itemPrice = response.itemPrice;

                        // Güncellenmiş ürün fiyatını göster
                        itemPriceElement.text(`${itemPrice.toFixed(2)}₺`);

                        // Güncellenmiş toplam tutarı göster
                        updateTotalAmount(); // Her ürün güncellendiğinde toplamı tekrar hesapla
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            function updateQuantity(button, quantityChange) {
                let cartItem = button.closest('.cart-item');
                let input = cartItem.querySelector('input[name="quantity"]');
                let cartItemId = cartItem.getAttribute('data-id');
                let currentQuantity = parseInt(input.value, 10);
                let newQuantity = currentQuantity + quantityChange;

                if (newQuantity < 1) {
                    return;
                }

                input.value = newQuantity;
                updateCartItemQuantity(cartItemId, newQuantity);
            }

            function updateTotalAmount() {
                let totalAmount = 0;

                $('.cart-item').each(function () {
                    let itemPriceText = $(this).find('.text').text().replace('₺', '').trim();
                    let itemPrice = parseFloat(itemPriceText) || 0;
                    totalAmount += itemPrice;
                });

                $('#total-amount').text(`Sepet Tutarı: ${totalAmount.toFixed(2)}₺`);
            }

            $(document).ready(function () {
                // Ürün miktarını güncelleme butonlarına tıklama olayını ayarla
                $('.update-quantity').off('click').on('click', function () {
                    let quantityChange = parseInt($(this).data('change'), 10);
                    updateQuantity(this, quantityChange);
                });

                // Sepetten ürün kaldırma formunu gönderme olayını ayarla
                $('.remove-form').off('submit').on('submit', function (event) {
                    event.preventDefault();
                    var form = $(this);
                    var formData = new FormData(this);

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            form.closest('.cart-item').remove();
                            updateTotalAmount(); // Ürün kaldırıldığında toplamı tekrar hesapla
                            $('#success-message').text('Ürün başarıyla silindi.').fadeIn().delay(3000).fadeOut();
                        },
                        error: function (response) {
                            $('#success-message').text('Bir hata oluştu.').fadeIn().delay(3000).fadeOut();
                        }
                    });
                });

                // Sayfa yüklendiğinde toplam tutarı güncelle
                updateTotalAmount();
            });
        </script>

    </div>
</body>
</html>
