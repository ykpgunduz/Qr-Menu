<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Underground</title>
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
        .containerr{
            display: inline-block;
        }
        input[type="number"]{
            -moz-appearance: textfield;
            text-align: center;
            font-size: 15px;
            border: none;
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
            font-size: 17px;
            cursor: pointer;
            padding: 0px;
        }
    </style>
</head>
<body class="text-nav">
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
            <a href="{{ route('sepet', ['table' => $tableNumber]) }}"><i class="mt-3 me-4 fa-solid fa-xl fa-cart-shopping text-nav"></i></a>
        </nav>
        <!-- Navbar End -->

        <!-- Menu Start -->
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text fw-normal">Hoşgeldiniz</h5>
                <h1 class="mb-5">Ne İçmek İstersiniz?</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-center">
                    @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 mt-4 pb-3" data-bs-toggle="pill" href="#tab-{{ $category->id }}">
                            <i class="fa fa-coffee text" style="font-size: 1.5em;"></i>
                            <div class="ps-3">
                                <h6 class="mt-n1 mb-0">{{ $category->name }}</h6>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <hr>
                <div class="tab-content">
                    @foreach($categories as $category)
                    <div id="tab-{{ $category->id }}" class="tab-pane fade p-0">
                        <div class="row g-4">
                            @foreach($products->where('category_id', $category->id) as $product)
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="{{ asset('storage/' . $product->thumbnail) }}" alt="" style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <form class="add-to-cart-form" data-product-id="{{ $product->id }}" data-table-number="{{ request()->get('table') }}">
                                            @csrf
                                            <h6 class="d-flex justify-content-between border-bottom pb-2">
                                                <input type="hidden" name="table" value="{{ request()->get('table') }}">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <span>{{ $product->title }}</span>
                                                <span class="text">{{ $product->price }}₺</span>
                                            </h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="fst-italic text-black product-body">{{ Str::limit($product->body, 15) }} | devamını oku -></small>
                                                <div class="containerr">
                                                    <button type="button" onclick="minus(this)"> - </button>
                                                    <input type="number" name="quantity" min="1" max="20" step="1" value="1" readonly>
                                                    <button type="button" onclick="plus(this)"> + </button>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-cart-plus"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script>
            function plus(btn){
                let myInput = btn.parentElement.querySelector('input[type="number"]');
                let id = btn.getAttribute("id");
                let min = myInput.getAttribute("min");
                let max = myInput.getAttribute("max");
                let step = myInput.getAttribute("step");
                let val = myInput.getAttribute("value");
                let calcStep = (step * 1);
                let newValue = parseInt(val) + calcStep;

                if(newValue >= min && newValue <= max){
                    myInput.setAttribute("value", newValue);
                }
            }
            function minus(btn){
                let myInput = btn.parentElement.querySelector('input[type="number"]');
                let id = btn.getAttribute("id");
                let min = myInput.getAttribute("min");
                let max = myInput.getAttribute("max");
                let step = myInput.getAttribute("step");
                let val = myInput.getAttribute("value");
                let calcStep = (step * -1);
                let newValue = parseInt(val) + calcStep;

                if(newValue >= min && newValue <= max){
                    myInput.setAttribute("value", newValue);
                }
            }
        </script>
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

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function(){
            $('.add-to-cart-form').on('submit', function(event) {
                event.preventDefault(); // Formun normal submit işlemini engelle

                var form = $(this);
                var url = '{{ route('addToCart') }}'; // Route URL'sini burada belirleyin

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
                        $('#success-message').text('Bir hata oluştu.').show();
                        setTimeout(function() {
                            $('#success-message').fadeOut();
                        }, 3000);
                    }
                });
            });
        });
    </script>
</body>
</html>
