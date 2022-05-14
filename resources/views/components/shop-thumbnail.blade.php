<div>
    @if(empty($shop->filename))
    <img src="{{asset('images/noimage.jpg')}}" alt="No Image画像">
    @else
    <img src="{{asset('storage/shops/' . $shop->filename)}}" alt="">
    @endif
</div>
