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
            margin-bottom: 0;
        }

        .payment-details {
            margin-top: 0;
            padding-top: 2mm;
            padding-bottom: 0;
            border-bottom: none;
        }

        .payment-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 3mm;
            margin-top: 2mm;
            text-align: center;
            padding-bottom: 1mm;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 2mm;
            align-items: center;
        }

        .payment-row span {
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
        }

        .payment-row i {
            margin-right: 2mm;
            font-size: 11px;
            width: 12px;
            text-align: center;
            display: inline-block;
        }

        .payment-row.total-paid {
            font-weight: bold;
            font-size: 13px;
        }

        .payment-row.ikram {
            color: #444;
            font-style: italic;
            font-weight: 500;
        }

        .payment-row.ikram i {
            color: #333;
            font-size: 12px;
        }

        .payment-divider {
            border-top: 1px dotted #ccc;
            margin: 2mm 0;
        }

        .payment-row:last-child {
            margin-bottom: 0;
        }

        .footer {
            display: none;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2mm;
            margin-bottom: 1mm;
        }

        .payment-row.grid-item {
            margin-bottom: 0;
            min-width: 70px;
        }

        .payment-row.grid-item.left {
            justify-content: flex-start;
        }

        .payment-row.grid-item.right {
            justify-content: flex-end;
        }

        .payment-row.grid-item span:first-child,
        .payment-row.grid-item span:last-child {
            margin: 0;
        }

        .payment-row.full-width {
            grid-column: 1 / -1;
            justify-content: space-between;
        }

        .contact-info {
            font-size: 10px;
            margin-top: 2mm;
            color: #444;
        }

        .contact-divider {
            margin: 0 2mm;
            color: #666;
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
            <div class="contact-info">
                <div>
                    <i class="fa-solid fa-phone"></i> {{ $cafe_phone }}
                    <span class="contact-divider">|</span>
                    <i class="fa-brands fa-instagram" style="font-weight: bold;"></i> {{ $cafe_insta_name }}
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
                @if(!isset($payment_info))
                    <div class="item-price">{{ $item['price'] }}₺</div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="total">
            <span>TOPLAM</span>
            <span>{{ $total_amount }}₺</span>
        </div>

        @if(isset($payment_info))
            <div class="payment-details">
                <div class="payment-title">ÖDEME DETAYLARI</div>

                <div class="payment-grid">
                    @if($payment_info['cash_money'] > 0)
                        <div class="payment-row grid-item left">
                            <span><i class="fa-solid fa-money-bill-1"></i>Nakit:</span>
                            <span>&nbsp;{{ $payment_info['cash_money'] }}₺</span>
                        </div>
                    @endif

                    @if($payment_info['credit_card'] > 0)
                        <div class="payment-row grid-item right">
                            <span><i class="fa-solid fa-credit-card"></i>Kart:</span>
                            <span>&nbsp;{{ $payment_info['credit_card'] }}₺</span>
                        </div>
                    @endif

                    @if($payment_info['iban'] > 0)
                        <div class="payment-row grid-item {{ !$payment_info['credit_card'] > 0 ? 'right' : 'left' }}">
                            <span><i class="fa-solid fa-university"></i>IBAN:</span>
                            <span>&nbsp;{{ $payment_info['iban'] }}₺</span>
                        </div>
                    @endif
                </div>

                <div class="payment-divider"></div>

                <div class="payment-row total-paid full-width">
                    <span>ÖDENEN TOPLAM:</span>
                    <span>&nbsp;{{ $payment_info['cash_money'] + $payment_info['credit_card'] + $payment_info['iban'] }}₺</span>
                </div>

                @if($payment_info['ikram'] > 0 || $payment_info['selfikram'] > 0)
                    <div class="payment-divider"></div>
                    <div class="payment-grid" style="margin-bottom: 2mm;">
                        @if($payment_info['ikram'] > 0)
                            <div class="payment-row grid-item ikram left">
                                <span><i class="fa-solid fa-gift"></i>İkram:</span>
                                <span>&nbsp;-{{ $payment_info['ikram'] }}₺</span>
                            </div>
                        @endif

                        @if($payment_info['selfikram'] > 0)
                            <div class="payment-row grid-item ikram right">
                                <span><i class="fa-solid fa-mug-hot"></i>Self İkram:</span>
                                <span>&nbsp;-{{ $payment_info['selfikram'] }}₺</span>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endif
    </div>
</body>
</html>
