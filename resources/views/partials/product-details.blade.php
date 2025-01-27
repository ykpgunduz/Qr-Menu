<div class="product-detail">
    <img src="{{ asset('img/cafe-logo.png') }}" alt="{{ $product->title }}" class="img-fluid mb-3 rounded">
    <h3 class="text-center">{{ $product->title }}</h3>
    <p class="text-muted">{{ $product->body }}</p>
    <h4 class="text-primary text-center">{{ $product->price }}₺</h4>
</div>
