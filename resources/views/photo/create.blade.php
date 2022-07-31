<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
<!-- Bootstrapの定形コード… -->

<!-- ナビゲーションメニュー -->
<div class="container mt-2 mb-2">
        <ul class="nav nav-tabs">
            <il class="nav-item">
                <a href="{{ route('photo.index') }}" class="nav-link">写真一覧</a>
            </il>
            <il class="nav-item">
                <a href="{{ route('photo.create') }}" class="nav-link active">写真アップロード</a>
            </il>
            <il class="nav-item">
                <a href="{{ url('players') }}" class="nav-link">選手登録</a>
            </il>
        </ul>
</div>


<div class="container">
    <div class="row">
        <div class="col">
            <h1>写真アップロード</h1>
            <div>
                <form action="{{ url('/photos/upload') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <!-- <input id="fileUploader" type="file" name="photo" accept='image/' enctype="multipart/form-data" multiple="multiple" required autofocus> -->
                        <input id="fileUploader" type="file" name="photo[]" accept='image/' enctype="multipart/form-data" multiple="multiple" required autofocus>  <!--複数ファイルのアップロード-->
                    </div>
                    <div>
                        @foreach($players as $player)
                            <label>
                                <input type="checkbox" name="players[]" value="{{ $player->id }}">{{ $player->nickname }}
                            </label>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>










<hr>




@endsection