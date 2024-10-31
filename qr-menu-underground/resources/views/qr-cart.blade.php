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
    <link href="{{ asset('images/favicon.png') }}" rel="icon">
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
            <img class="logo-underground" src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 80px">
        </nav>
        <!-- Navbar End -->

        <form action="{{ route('store') }}" method="POST" id="form1">
            @csrf
            <input type="hidden" name="cart_items" value="{{ json_encode($cartItems) }}">
            <input type="hidden" name="table_number" value="{{ $tableNumber }}" class="form-control" required>
            <input type="hidden" name="session_id" value="{{ $sessionId }}" class="form-control" required>
            <input type="hidden" name="device_info" value="{{ $deviceInfo }}" class="form-control" required>
        <!-- Menu Start -->
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text fw-normal">Coffee Shop</h5>
                <h1 class="mb-5">Siparişinizdeki Ürünler</h1>

                <!-- Ana formu buraya ekliyoruz -->
                    <div id="cart-items">
                        @foreach ($cartItems as $cartItem)
                        <div class="col-lg-6 mb-3 cart-item" data-id="{{ $cartItem->id }}" data-price="{{ $cartItem->price }}">
                            <div class="d-flex align-items-center" style="border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 15px;">
                                <img class="flex-shrink-0 img-fluid" src="https://kahhve.com/blog/wp-content/uploads/2022/06/filtre-kahve-cekirdegi-scaled.jpg" style="width: 120px; border-radius: 10px;">
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                        <span>{{ $cartItem->product->title }}</span>
                                        <span class="text">{{ $cartItem->price }}₺</span>
                                    </h5>
                                    <div class="d-flex justify-content-between">
                                        <!-- Miktarı Artır/Azalt -->
                                        <div class="containerr">
                                            <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="update-cart-form">
                                                @csrf
                                                <div class="d-flex btn-group">
                                                    <button type="submit" name="quantity_change" value="-1" class="quantity-change-btn btn btn-dark btn-sm"> - </button>
                                                    <input type="number" name="quantity" min="1" max="20" step="1" disabled value="{{ $cartItem->quantity }}" readonly class="form-control text-center py-0 rounded-0" style="font-size: 17px">
                                                    <button type="submit" name="quantity_change" value="1" class="quantity-change-btn btn btn-dark btn-sm"> + </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Ürünü Sil -->
                                        <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="remove" value="true" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-close"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <!-- Sipariş Notu Girişi Burada -->
                                    <div class="mt-2">
                                        <input type="text" name="notes[{{ $cartItem->id }}]" placeholder="Sipariş Notu (opsiyonel)" class="form-control mb-2" value="{{ $cartItem->note ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-end mt-5">
                        <h5 class="mb-4" id="total-amount">Sipariş Tutarı: {{ $totalAmount }}₺</h5>
                    </div>
            </div>
        </div>
        <!-- Menu End -->

        <!-- Success Message -->
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

</body>
</html>
