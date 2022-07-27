<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
<!-- Bootstrapの定形コード… -->

<div>
<h3>色々</h3>
<p><a href="{{ route('photo.create') }}">写真のアップロード</a></p>
<p><a href="{{ url('players') }}">選手の登録</a></p>


<table border="1">
    <tr>
        <th>path</th>
        <th>player</th>
        <th>編集</th>
        <th>削除</th>
    </tr>
    @foreach ($photos as $photo)
    <tr>
        <td>{{ $photo->path }}</td>
        <td>
        @foreach ($photo->players as $player)
            <a href="{{ route('player.show',$player->id)}}">{{ $player->nickname }}</a>
        @endforeach
        </td>
        <td><a href="{{ route('photo.edit',$photo->id)}}">編集</a></td>
        <td>
            <form action="{{ route('photo.destroy', $photo->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" name="" value="削除">
            </form>
        </td>
    </tr>
    @endforeach
</table>
</div>

<hr>
<h3>選手ごとの写真へのリンク</h3>
@foreach ($players as $player)
    <a href="{{ route('player.show',$player->id)}}">{{ $player->nickname }}(#{{ $player->number }})</a>
@endforeach
<hr>

<h3>写真一覧</h3>


    @foreach($photos->sortByDesc('date') as $photo)  <!--古いものから並べるにはsortBy()-->
    <div style="width: 18rem; float:left; margin: 1px;">
    <a href="{{ route('photo.edit',$photo->id)}}"><img src="/uploads/{{ $photo->path }}" style="width:100%;"/></a>
        <!-- <img src="/uploads/{{ $photo->path }}" style="width:100%;"/> -->
        <p>{{ $photo->date }}</p>
    </div>
    @endforeach






@endsection