<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
<!-- Bootstrapの定形コード… -->

<!-- ナビゲーションメニュー -->
<div class="container mt-2 mb-2">
        <ul class="nav nav-tabs">
            <il class="nav-item">
                <a href="" class="nav-link active">写真一覧</a>
            </il>
            <il class="nav-item">
                <a href="{{ route('photo.create') }}" class="nav-link">写真アップロード</a>
            </il>
            <il class="nav-item">
                <a href="{{ url('players') }}" class="nav-link">選手登録</a>
            </il>
        </ul>
</div>


<div class="container">
    <div class="row">
        <h3>選手ごとの写真へのリンク</h3>
        <div>
            @foreach ($players as $player)
                <a href="{{ route('player.show',$player->id)}}">{{ $player->nickname }}(#{{ $player->number }})</a>
            @endforeach
        </div>
    </div>
</div>

<hr>

<div class="container">
    <div class="row text-center">
        <div class="col">
            @foreach($photos->sortByDesc('date') as $photo)  <!--古いものから並べるにはsortBy()-->
                <a href="{{ route('photo.edit',$photo->id)}}"><img src="storage/uploads/{{ $photo->path }}" alt="IMage" class="col-lg-3 col-md-4 rounded m-1"></a>
            @endforeach
        </div>
    </div>
</div>

@endsection
