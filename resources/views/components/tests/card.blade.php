@props([
    "title" =>"初期タイトル",
    'content'=> "初期本文",
    "message" => "初期メッセージ",
    ])

<div class="border-2 shadow-md w-1/4 p-2">
    <div>{{$title}}</div>
    <div>画像</div>
    <div>{{$content}}</div>
    <div>{{$message}}</div>
</div>
