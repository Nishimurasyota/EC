<p class="mb-4">{{ $user->ownerName }}sまの商品が注文されました</p>

<p class="mb-4">下記のご注文ありがとうございmす。</p>

@foreach($products as $product)
<ul class="mb-4">
    <li>商品名：{{ $product["name"] }}</li>
    <li>商品金額：{{ number_format($product["price"]) }}円</li>
    <li>商品数：{{ $product["quantity"] }}</li>
    <li>合計金額：{{ number_format($product["price"] * $product["quantity"])  }}</li>
</ul>

@endforeach

<div class="mb-4">
    購入者情報
</div>
<ul>
    <li>{{ $user->name }}様</li>
</ul>
