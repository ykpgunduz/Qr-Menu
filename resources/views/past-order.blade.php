<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <title>Geçmiş Sipariş</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.7)),
                        url('{{ asset('img/background.jpg') }}') center/cover no-repeat fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }

        .receipt {
            background-color: #fff;
            width: 320px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            border-top: 1px dashed #ddd;
            margin: 12px 0;
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
            font-size: 13px;
            color: #444;
        }

        .items div span:first-child {
            font-weight: 500;
        }

        .items div span:last-child {
            font-weight: 600;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: left;
            margin: 20px 0;
            color: #333;
        }

        .thank-you {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin: 15px 0 10px 0;
        }

        .survey {
            font-size: 12px;
            color: #666;
        }

        .survey a {
            display: inline-block;
            background-color: #4a90e2;
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            margin: 10px 0;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        .survey a:hover {
            background-color: #357abd;
        }

        .payment-summary, .payment-details {
            margin: 10px 0;
            text-align: left;
        }

        .payment-details h3 {
            font-size: 14px;
            margin: 10px 0;
            color: #444;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #444;
            margin: 6px 0;
        }

        .payment-row span:first-child {
            font-weight: 500;
        }

        .payment-row span:last-child {
            font-weight: 600;
        }

        .payment-row.total {
            font-size: 15px;
            font-weight: bold;
            color: #222;
            margin-top: 10px;
        }

        .header {
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .info, .info-two {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #666;
            margin: 5px 0;
        }

        .info span, .info-two span {
            font-weight: 500;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('img/underground-siyah.png') }}" alt="Logo" style="width: 45px; height: 45px; border-radius: 8px; margin-right: 8px;">
                <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center;">
                    <h1 style="font-size: 20px; margin: 0; letter-spacing: 0.3px;">{{ $cafe->name }}</h1>
                    <div style="font-size: 11px; color: #666; margin: 2px 0 0 1px; font-style: italic; font-weight: 500;">COFFEE SHOP</div>
                </div>
            </div>
        </div>

        <div class="info">
            <span>{{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }} - {{ date('H:i') }}</span>
            <span>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y l') }}</span>
        </div>

        <div class="info-two">
            <span>{{ $order->table_number }}. Masa {{ !empty($order->customer) ? "| $order->customer Kişi" : "" }}</span>
            <span>#{{ $order->order_number }}</span>
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

        <div class="payment-summary">
            @if($order->ikram > 0 || $order->selfikram > 0)
            <div class="payment-row">
                <span>Personel İkram:</span>
                <span>-{{ $order->ikram }}₺</span>
            </div>
            <div class="payment-row">
                <span>Self İkram:</span>
                <span>-{{ $order->selfikram }}₺</span>
            </div>
            @endif
            <div class="payment-row total">
                <span>Genel Toplam:</span>
                <span>{{ $order->total_amount }}₺</span>
            </div>
        </div>

        <div class="divider"></div>

        <div class="payment-details">
            <h3 style="text-align: center; margin-bottom: 15px; font-size: 15px; color: #333;">ÖDEMELER</h3>
            @if($order->cash_money > 0)
            <div class="payment-row">
                <span>Nakit:</span>
                <span>{{ $order->cash_money }}₺</span>
            </div>
            @endif
            @if($order->credit_card > 0)
            <div class="payment-row">
                <span>Banka - Kredi Kartı:</span>
                <span>{{ $order->credit_card }}₺</span>
            </div>
            @endif
            @if($order->iban > 0)
            <div class="payment-row">
                <span>Havale/EFT:</span>
                <span>{{ $order->iban }}₺</span>
            </div>
            @endif
        </div>

        <div class="divider"></div>

        <div class="survey">
            @if($rating)
                <p style="color: #2d9900; font-weight: 500;">Anketimize katıldığınız için teşekkür ederiz!</p>
            @else
                <a href="{{ route('rating.show', $order->order_number) }}">Anketimize Katılın</a>
            @endif
        </div>
    </div>
</body>
</html>
