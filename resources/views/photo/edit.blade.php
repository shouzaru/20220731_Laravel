

<div style="width: 18rem; float:left; margin: 1px;">
    <img src="/storage/uploads/{{ $photo->path }}" style="width:100%;"/>
    <p>{{ $photo->date }}</p>
</div>

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


<h3>この写真を削除する</h3>
<form action="{{ route('photo.destroy', $photo->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" name="" value="削除">
</form>