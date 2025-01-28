<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=72mm, initial-scale=1.0">
    <title>Adisyon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @page {
            size: 72mm auto;
            margin: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            width: 72mm;
            font-size: 12px;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            width: 100%;
            padding: 0 2mm;
            box-sizing: border-box;
            margin-top: 0;
        }

        .header {
            margin-top: 0;
            margin-bottom: 1mm;
        }

        .header h1 {
            font-size: 18px;
            margin: 7px 0 0 0;
            font-weight: bold;
        }

        .header-info {
            font-size: 9px;
            line-height: 1.3;
        }

        .info {
            margin: 3mm 0 0 0;
            border-top: 1px dashed #000;
            padding: 3mm 0 1.5mm 0;
            display: flex;
            justify-content: space-between;
        }

        .info span {
            font-size: 12px;
            font-weight: bold;
        }

        .info-two{
            margin: 0 0 5mm 0;
            border-bottom: 1px dashed #000;
            padding: 1.5mm 0 3mm 0;
            display: flex;
            justify-content: space-between;
        }

        .info-two span {
            font-size: 12px;
            font-weight: bold;
        }

        .items {
            margin: 5mm 0;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3mm;
            font-size: 12px;
        }

        .item-name {
            flex: 1;
            text-align: left;
        }

        .item-quantity {
            font-weight: bold;
            margin-right: 4mm;
        }

        .item-price {
            text-align: right;
            white-space: nowrap;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 14px;
            margin-top: 5mm;
            padding: 4mm 0;
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
        }

        .footer {
            margin-top: 3mm;
            font-size: 10px;
            margin-bottom: 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 2000);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('img/underground-siyah.png') }}" alt="Logo" style="width: 50px; height: 50px; border-radius: 8px; margin-right: 10px;">
                <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center;">
                    <h1>{{ $cafe_name }}</h1>
                    <div style="font-size: 12px; color: #444; margin: 2px 0 2px 1px; font-style: italic; font-weight: 500; letter-spacing: 0.5px;">COFFEE SHOP</div>
                </div>
            </div>
        </div>

        <div class="info">
            <span>{{ \Carbon\Carbon::parse($created_at)->format('H:i') }} - {{ date('H:i') }}</span>
            <span>{{ \Carbon\Carbon::parse($created_at)->translatedFormat('d F Y l') }}</span>
        </div>

        <div class="info-two">
            <span>{{ $table_number }}. Masa {{ !empty($customer) ? "| $customer Kişi" : "" }}</span>
            <span>{{ $order_number }}</span>
        </div>

        <div class="items">
            @foreach($order_items as $item)
            <div class="item-row">
                <div class="item-name">
                    <span class="item-quantity">{{ $item['quantity'] }}x</span>
                    {{ $item['product_name'] }}
                </div>
                <div class="item-price">{{ $item['price'] }}₺</div>
            </div>
            @endforeach
        </div>

        <div class="total">
            <span>TOPLAM</span>
            <span>{{ $total_amount }}₺</span>
        </div>

        <div class="footer">
            <div style="display: flex; justify-content: space-between; margin-top: 3px;">
                <div>
                    <i class="fa-solid fa-phone"></i> {{ $cafe_phone }}
                </div>
                <div>
                    <i class="fa-brands fa-instagram" style="font-weight: bold;"></i> {{ $cafe_insta_name }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
