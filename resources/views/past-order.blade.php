<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geçmiş Sipariş</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        .receipt {
            background-color: #fff;
            width: 320px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
        }

        .receipt h1 {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .receipt p {
            margin: 0;
            font-size: 13px;
            color: #777;
        }

        .divider {
            border-top: 1px dashed #ccc;
            margin: 15px 0;
        }

        .details {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            font-weight: 600;
            margin: 10px 0;
            color: #555;
        }

        .items {
            margin: 20px 0;
            text-align: left;
        }

        .items div {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .items div span {
            font-size: 14px;
        }

        .items div span:first-child {
            font-weight: bold;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: left;
            margin: 20px 0;
            color: #333;
        }

        .thank-you {
            font-size: 13px;
            color: #555;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>{{ $cafe->name }}</h1>
        <p>{{ $cafe->address }}</p>
        <p>Tel: {{ $cafe->phone }}</p>
        <div class="divider"></div>
        <div class="details">
            <span>Masa No: {{ $order->table_number }}</span>
            <span>{{ date('H:i | d.m.Y', strtotime($order->created_at)) }}</span>
        </div>
        <div class="divider"></div>
        <div class="items">
            @foreach (explode(', ', $order->products) as $product)
            <div>
                <span>{{ $product }}</span>
            </div>
            @endforeach
        </div>
        <div class="divider"></div>
        <div class="total">Toplam: {{ $order->total_amount }}₺</div>
        <div class="divider"></div>
        <p class="thank-you">Bizi Tercih Ettiğiniz İçin Teşekkür Ederiz :)</p>
    </div>
</body>
</html>
