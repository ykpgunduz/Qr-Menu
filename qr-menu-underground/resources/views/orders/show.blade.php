<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <h1>Sipariş Detayı</h1>
    <p><strong>Masa Numarası:</strong> {{ $order->table_number }}</p>
    <p><strong>Toplam Tutar:</strong> {{ $order->total_amount }}₺</p>

    <h3>Sipariş Ürünleri:</h3>
    <ul>
        @foreach($order->items as $item)
        <li>{{ $item->product->title }} - {{ $item->quantity }} x {{ $item->price }}₺</li>
        @endforeach
    </ul>
</div>
</body>
</html>
