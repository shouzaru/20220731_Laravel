<!-- resources/views/books.blade.php -->
@extends('layouts.app')
 @section('content')

<!-- Bootstrapの定形コード… -->
<div class="card-body">
         <div class="card-title">
             写真アップロード
    </div>

<!-- バリデーションエラーの表示に使用-->
         <!-- resources/views/common/errors.blade.php -->
         @if (count($errors) > 0)
             <!-- Form Error List -->
             <div class="alert alert-danger">
                 <div><strong>入力した文字を修正してください。</strong></div> 
                 <div>
                     <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                     </ul>
                 </div>
             </div>
         @endif
<!-- バリデーションエラーの表示に使用-->


<form action="{{ url('/photos/upload') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <input id="fileUploader" type="file" name="photo" accept='image/' enctype="multipart/form-data" multiple="multiple" required autofocus>
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


<hr>
<div>
    <h1>アップロード済み写真一覧</h1>
@foreach($photos->sortByDesc('date') as $photo)  <!--古いものから並べるにはsortBy()-->
<div style="width: 18rem; float:left; margin: 1px;">
	<img src="/uploads/{{ $photo->path }}" style="width:100%;"/>
	<p>{{ $photo->date }}</p>
    

</div>
@endforeach
</div>

<div>




@endsection