@php
    if($type === "shops"){
        $path = 'storage/shops/';
    }
    elseif($type === "products"){
        $path = 'storage/products/';
    }
@endphp

<div>
    @if(empty($filename))
    <img src="{{asset('images/noimage.jpg')}}" alt="No Image画像">
    @else
    <img src="{{asset($path . $filename)}}" alt="">
    @endif
</div>
