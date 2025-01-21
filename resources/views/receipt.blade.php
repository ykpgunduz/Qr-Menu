<!DOCTYPE html>
<html lang="en">
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
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 4mm;
            width: 72mm;
            font-size: 12px;
            line-height: 1.3;
        }

        .header {
            text-align: center;
            margin-bottom: 4mm;
            border-bottom: 2px solid #000;
            padding-bottom: 3mm;
        }

        .header h1 {
            font-size: 20px;
            margin: 0 0 3mm 0;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .header-info {
            font-size: 11px;
            line-height: 1.4;
            font-weight: 500;
        }

        .info {
            margin: 4mm 0;
            border-bottom: 1px solid #000;
            padding-bottom: 3mm;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2mm;
            font-size: 12px;
        }

        .info-row span:first-child {
            font-weight: bold;
            color: #000;
        }

        .items {
            margin: 4mm 0;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2.5mm;
            font-size: 12px;
            line-height: 1.2;
        }

        .item-name {
            flex: 1;
            padding-right: 3mm;
            font-weight: 500;
        }

        .item-quantity {
            font-weight: bold;
            margin-right: 2mm;
        }

        .item-price {
            text-align: right;
            white-space: nowrap;
            font-weight: 600;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 16px;
            margin-top: 4mm;
            padding: 3mm 0;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            letter-spacing: 0.5px;
        }

        .footer {
            text-align: center;
            margin-top: 5mm;
            font-size: 11px;
            font-weight: 500;
        }

        .footer-text {
            margin-bottom: 1.5mm;
            line-height: 1.3;
        }

        .stars {
            font-size: 14px;
            margin-bottom: 3mm;
            letter-spacing: 1px;
        }

        @media print {
            @page {
                margin: 0;
            }
            body {
                margin: 0;
                padding: 4mm;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>CAFE ADI</h1>
        <div class="header-info">
            <div>Örnek Mahallesi, Örnek Sokak No:1</div>
            <div>Tel: 0555 555 55 55</div>
            <div>www.cafeadi.com</div>
        </div>
    </div>

    <div class="info">
        <div class="info-row">
            <span>Masa No:</span>
            <span>#{{ $table_number }}</span>
        </div>
        <div class="info-row">
            <span>Fiş No:</span>
            <span>{{ $order_number }}</span>
        </div>
        <div class="info-row">
            <span>Tarih:</span>
            <span>{{ date('d.m.Y H:i') }}</span>
        </div>
    </div>

    <div class="items">
        @foreach($order_items as $item)
        <div class="item-row">
            <div class="item-name">
                <span class="item-quantity">{{ $item['quantity'] }}x</span>
                {{ $item['product_name'] }}
            </div>
            <div class="item-price">{{ number_format($item['price'], 2) }}₺</div>
        </div>
        @endforeach
    </div>

    <div class="total">
        <span>TOPLAM</span>
        <span>{{ number_format($total_amount, 2) }}₺</span>
    </div>

    <div class="footer">
        <div class="stars">★ ★ ★ ★ ★</div>
        <div class="footer-text">Bizi Tercih Ettiğiniz İçin</div>
        <div class="footer-text">Teşekkür Ederiz</div>
        <div class="footer-text">Yine Bekleriz</div>
    </div>
</body>
</html>
