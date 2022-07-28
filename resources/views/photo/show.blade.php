<h1>{{ $player->nickname }}の写真一覧</h1>

<ul>
    @foreach ($player->photos->sortByDesc('date') as $photo)
    <div style="width: 18rem; float:left; margin: 1px;">
    <a href="{{ route('photo.edit',$photo->id)}}"><img src="/storage/uploads/{{ $photo->path }}" style="width:100%;"/></a>
    <!-- <img src="/uploads/{{ $photo->path }}" style="width:100%;"/> -->
    <p>{{ $photo->date }}</p>
    </div>
    @endforeach
</ul>

