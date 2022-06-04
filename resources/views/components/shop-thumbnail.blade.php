<div>
    @if(empty($filename))
    <img src="{{asset('images/noimage.jpg')}}" alt="No Image画像">
    @else
    <img src="{{asset('storage/shops/' . $filename)}}" alt="">
    @endif
</div>
