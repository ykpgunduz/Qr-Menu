<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Anket Formu</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, #333333, #555555);
        }
        .rating-box {
            position: relative;
            background: #222;
            padding: 25px 50px 35px;
            border-radius: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }
        .error-message {
            color: #ff4d4d;
            font-size: 14px;
            margin-top: 5px;
        }
        .yes-no-options {
            display: flex;
            gap: 20px;
            justify-content: left;
            margin-top: 10px;
        }
        .yes-no-options label {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            padding: 10px;
            font-size: 16px;
            color: #555;
            background: #333;
            border-radius: 5px;
            border: 1px solid #555;
            cursor: pointer;
            transition: background 0.3s ease, color 0.3s ease;
        }
        .yes-no-options input {
            display: none;
        }
        .yes-no-options input:checked + label {
            color: #ffcc00;
            background: #444;
            border-color: #ffcc00;
        }
        .rating-box header {
            font-size: 22px;
            color: #fff;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
        }
        .rating-box .question {
            margin-bottom: 20px;
        }
        .rating-box .stars {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .stars i {
            color: #555;
            font-size: 35px;
            margin-top: 10px;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .stars i.active {
            color: #ffcc00;
        }
        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: #fff;
            background: #444;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #666;
        }
        textarea {
            background: #333;
            color: #fff;
            border: 1px solid #555;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            resize: none;
            margin-top: 10px;
        }
        textarea::placeholder {
            color: #bbb;
        }
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background: #333;
            border: 1px solid #555;
            border-radius: 5px;
            margin-top: 10px;
            appearance: none;
            cursor: pointer;
        }
        select option {
            background: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <form class="rating-box" action="{{ route('rating.store', ['orderNumber' => $orderNumber]) }}" method="POST">
        @csrf
        <header>Anket Formu</header>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input name="order_number" type="hidden" value="{{ $orderNumber }}">

        <div class="question">
            <p style="color: #fff;">Size verilen servisten memnun musunuz?</p>
            <div class="stars">
                <i class="fa-solid fa-star" data-value="1"></i>
                <i class="fa-solid fa-star" data-value="2"></i>
                <i class="fa-solid fa-star" data-value="3"></i>
                <i class="fa-solid fa-star" data-value="4"></i>
                <i class="fa-solid fa-star" data-value="5"></i>
            </div>
            <input type="hidden" name="service_rating" id="service_rating" required />
        </div>

        <div class="question">
            <p style="color: #fff;">Size servis edilen ürünlerden memnun musunuz?</p>
            <div class="stars">
                <i class="fa-solid fa-star" data-value="1"></i>
                <i class="fa-solid fa-star" data-value="2"></i>
                <i class="fa-solid fa-star" data-value="3"></i>
                <i class="fa-solid fa-star" data-value="4"></i>
                <i class="fa-solid fa-star" data-value="5"></i>
            </div>
            <input type="hidden" name="product_rating" id="product_rating" required />
        </div>

        <div class="question">
            <p style="color: #fff;">İşletmenin genel ambiansı (müzik, temizlik vs.) nasıl?</p>
            <div class="stars">
                <i class="fa-solid fa-star" data-value="1"></i>
                <i class="fa-solid fa-star" data-value="2"></i>
                <i class="fa-solid fa-star" data-value="3"></i>
                <i class="fa-solid fa-star" data-value="4"></i>
                <i class="fa-solid fa-star" data-value="5"></i>
            </div>
            <input type="hidden" name="ambiance_rating" id="ambiance_rating" required />
        </div>

        <div class="question">
            <p style="color: #fff;">Tekrar bu işletmeye gelir misiniz?</p>
            <div class="yes-no-options">
                <input type="radio" id="yes" name="return_response" value="yes" required />
                <label for="yes">Evet</label>

                <input type="radio" id="no" name="return_response" value="no" required />
                <label for="no">Hayır</label>
            </div>
        </div>

        <div class="question">
            <p style="color: #fff;">Eklemek istediğiniz bir şey var mı?</p>
            <textarea name="additional_comments" rows="4" placeholder="Düşüncelerinizi buraya yazabilirsiniz..."></textarea>
        </div>
        <button type="submit">Gönder</button>
    </form>

    <script>
        document.querySelectorAll(".stars").forEach((starGroup) => {
            const stars = starGroup.querySelectorAll("i");
            const input = starGroup.nextElementSibling;

            stars.forEach((star, index1) => {
                star.addEventListener("click", () => {
                    stars.forEach((s, index2) => {
                        index1 >= index2
                            ? s.classList.add("active")
                            : s.classList.remove("active");
                    });
                    input.value = index1 + 1;
                });
            });
        });
    </script>
</body>
</html>
