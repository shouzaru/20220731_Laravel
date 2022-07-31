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
    <div class="row text-center">
        <div class="col">
            <img src="/storage/uploads/{{ $photo->path }}"  class="col-md-6 img-fluid"/>
            <p>{{ $photo->date }}</p>
            <form action="{{ route('photo.update',$photo->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                <p>
                    @foreach ($playerList as $player)
                    <label class="checkbox">
                        <input type="checkbox" name="players[]" value="{{$player->id}}" @if(in_array($player->id,$players)) checked @endif>
                        {{ $player->nickname }}
                    </label>
                    @endforeach
                </p>
                <input type="submit" value="タグを編集する">
            </form>
        </div>
    </div>
</div>

<div class="container text-end">
    <div class="row">
        <div class="col">
        <h3>この写真を削除する</h3>
        <form action="{{ route('photo.destroy', $photo->id)}}" method="POST">
                @csrf
                @method('DELETE')
            <input type="submit" name="" value="削除">
        </form>
        </div>
    </div>
</div>










@endsection