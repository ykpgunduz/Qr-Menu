<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=72mm, initial-scale=1.0">
    <title>Adisyon</title>
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
            padding: 4mm;
            box-sizing: border-box;
        }

        .header {
            margin-bottom: 5mm;
        }

        .header h1 {
            font-size: 18px;
            margin: 0 0 3mm 0;
            font-weight: bold;
        }

        .header-info {
            font-size: 10px;
            line-height: 1.5;
        }

        .info {
            margin: 5mm 0;
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 4mm 0;
            display: flex;
            justify-content: space-between;
        }

        .info span {
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
            margin-top: 5mm;
            font-size: 10px;
        }

        .footer-text {
            margin-bottom: 2mm;
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

        // Yazdırma işleminden sonra sayfayı kapat
        setTimeout(function() {
            window.close();
        }, 2000);
    }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $cafe_name }}</h1>
            <div class="header-info">
                <div>{{ $cafe_address }}</div>
                <div>Tel: {{ $cafe_phone }}</div>
            </div>
        </div>

        <div class="info">
            <span>Masa No: {{ $table_number }}</span>
            <span>{{ date('H:i | d.m.Y') }}</span>
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
            <div class="footer-text">Bizi Tercih Ettiğiniz İçin Teşekkür Ederiz :)</div>
        </div>
    </div>
</body>
</html>
