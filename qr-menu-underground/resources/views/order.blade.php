<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siparişiniz Alındı!</title>
</head>
<body>
    <div class="container">
        <h1>Sipariş Detayı</h1>
        <p><strong>Masa Numarası:</strong> {{ $order->table_number }}</p>
        <p><strong>Toplam Tutar:</strong> {{ $order->total_amount }}₺</p>

        <h3>Sipariş Ürünleri:</h3>
        <ul>
            @foreach($order->orderItems as $item)
                <li>{{ $item->product->title }} - {{ $item->quantity }} x {{ $item->price }}₺</li>
            @endforeach
        </ul>
        @if($order->note)
            <p><strong>Sipariş Notu:</strong> {{ $order->note }}</p>
        @endif
    </div>

    <div class="container">
        @if($order->status === 'Hesap')
            <p>Hesap İstendi</p>
        @else
            <form action="{{ route('order.come', $order->id) }}" method="POST">
                @csrf
                <button type="submit">Hesabı İste</button>
            </form>
        @endif
    </div>
</body>
</html>

