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
                <a href="{{ route('photo.create') }}" class="nav-link">写真アップロード</a>
            </il>
            <il class="nav-item">
                <a href="{{ url('players') }}" class="nav-link active">選手登録</a>
            </il>
        </ul>
</div>


       <!-- バリデーションエラーの表示に使用-->
         <!-- resources/views/common/errors.blade.php -->
         @if (count($errors) > 0)
             <!-- Form Error List -->
             <div class="alert alert-danger">
                 <div><strong>正しく入力してください</strong></div> 
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


<div class="container">
    <div class="row">
        <div class="col">
            <div class="card-body">
            <!-- 本登録フォーム -->
                <form action="{{ url('players') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
             <!-- 選手名 -->
                <div class="form-group">
                    <label for="name_kanji">選手名（漢字）</label>
                    <div class="col-sm-6">
                        <input type="text" name="name_kanji" class="form-control">
                    </div>
                </div>
             <!-- 選手名 -->
                <div class="form-group">
                    <label for="name_kana">選手名（英字表記）</label>
                    <div class="col-sm-6">
                        <input type="text" name="name_kana" class="form-control">
                    </div>
                </div>
            <!-- 選手名 -->
                <div class="form-group">
                    <label for="nickname">ニックネーム</label>
                    <div class="col-sm-6">
                        <input type="text" name="nickname" class="form-control">
                    </div>
                </div>
            <!-- 背番号 -->
                <div class="form-group">
                    <label for="number">背番号</label>
                    <div class="col-sm-6">
                        <input type="text" name="number" class="form-control">
                    </div>
                </div>
             <!-- 登録ボタン -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>



     <!-- Book: 既に登録されてる本のリスト -->
     <!-- 現在の本 -->
     @if (count($players) > 0)
         <div class="card-body">
             <div class="card-body">
                 <table class="table table-striped task-table">
                     <!-- テーブルヘッダ -->
                     <thead>
                         <th>選手一覧</th>
                         <th>&nbsp;</th>
                     </thead>
                     <!-- テーブル本体 -->
                     <tbody>
                         @foreach ($players as $player)
                             <tr>
                                 <!-- 選手名 -->
                                 <td class="table-text">
                                     <div>{{ $player->name_kanji }}</div>
                                 </td>
                                 <!-- 選手名 -->
                                 <td class="table-text">
                                     <div>{{ $player->name_kana }}</div>
                                 </td>
                                 <!-- 選手名 -->
                                 <td class="table-text">
                                     <div>{{ $player->nickname }}</div>
                                 </td>
                                <!-- 選手名 -->
                                <td class="table-text">
                                     <div>{{ $player->number }}</div>
                                 </td>

 			                    <!-- 削除ボタン -->
                                 <td>
                                    <form action="{{ url('players/'.$player->id) }}" method="POST">
                                         {{ csrf_field() }}
                                         {{ method_field('DELETE') }}
                                         <button type="submit" class="btn btn-danger">
                                             削除
                                         </button>
                                    </form>
                                 </td>
                                 <td>
                                	<form action="{{ url('players/'.$player->id.'/edit') }}" method="GET"> {{ csrf_field() }}
                                	    <button type="submit" class="btn btn-primary">更新 </button>
                                	</form>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>		
    @endif
 @endsection