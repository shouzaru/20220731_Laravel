@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
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
        <form action="{{ url('players/'.$player->id) }}" method="POST">
            @method('PATCH')
            <!-- item_name -->
            <div class="form-group">
                <label for="name_kanji">選手名（漢字）</label>
                <input type="text" name="name_kanji" class="form-control" value="{{$player->name_kanji}}">
            </div>
            <!-- item_name -->
            <div class="form-group">
                <label for="name_kana">選手名（英字表記）</label>
                <input type="text" name="name_kana" class="form-control" value="{{$player->name_kana}}">
            </div>
            <!--/ item_name -->
            <div class="form-group">
                <label for="nickname">ニックネーム</label>
                <input type="text" name="nickname" class="form-control" value="{{$player->nickname}}">
            </div>
            <!--/ item_name -->
            <div class="form-group">
                <label for="number">背番号</label>
                <input type="text" name="number" class="form-control" value="{{$player->number}}">
            </div>

            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}"> Back</a>
            </div>
            <!--/ Save ボタン/Back ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$player->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    </div>
</div>
@endsection