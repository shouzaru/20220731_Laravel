<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Player;
use Illuminate\Support\Str;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;  //画像ファイル削除機能のため追加

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        $players = Player::all();  //追加
        // return view('photo.index', compact('photos'));
        return view('photo.index', compact('players', 'photos'));  //修正
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $players = Player::all();
        $photos = Photo::all();  //追加
        // return view('photo.create', compact('players'));
        return view('photo.create', compact('players', 'photos'));  //修正
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = Photo::create($request->all());
        $photo->players()->attach(request()->players);
        return redirect()->route('photo.index')->with('success', '新規登録完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
        // $photos = Photo::all();
        $players = $photo->players->pluck('id')->toArray();
        $playerList = Player::all();
        return view('photo.edit', compact('photo', 'players', 'playerList'));
        // return view('photo.edit', compact('photo', 'photos', 'players', 'playerList'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $update = [
        //     'title' => $request->title,
        // ];
        // Book::where('id', $id)->update($update);
        $photo = Photo::find($id);
        $photo->players()->sync(request()->players);
        // return back()->with('success', '編集完了しました');
        return redirect()->route('photo.index')->with('success', '削除完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $photo = Photo::find($id);
        // アップロード済みの写真のパスを取得
        $path = $photo->path;
        // $target_path = public_path('/uploads/');
        // $npath = $target_path . $path;
        // dd($npath);
        
        // ファイルが登録されていれば削除
        if ($path !== '') {
          Storage::disk('public')->delete('uploads/' . $path);
        }

        $photo->delete();
        $photo->players()->detach();
        return redirect()->route('photo.index')->with('success', '削除完了しました');
    }

        // 画像アップロード処理
    public function upload(Request $request){

        //複数の画像ファイル取得
        $files = $request->file('photo');  //修正
        // dd($files);

        // バリデーション 
            //  $validator = $request->validate( [
            //      'photo' => 'required|file|image|max:20480', 
            //  ]);

            // 画像ファイル取得
            // $file = $request->photo;
            // $files = $request->file('photo');  //修正
            // dd($files);

            //画像ファイルのexifデータ取得、撮影日取得
            if ( !empty($files) ){
            foreach($files as $file){
             
                $exifdata=exif_read_data($file, 0, true);
                $dateTimeOriginal = isset($exifdata["EXIF"]['DateTimeOriginal']) ? $exifdata["EXIF"]['DateTimeOriginal'] : "";
             
                // if ( !empty($file) ) {
                    // ファイルの拡張子取得
                    $ext = $file->guessExtension();
                    //ファイル名を生成
                    $fileName = Str::random(32).'.'.$ext;
                    //  dd($fileName); 
            
                    //public/uploadフォルダを作成
                    // $target_path = public_path('/uploads/');
                    //ファイルをpublic/uploadフォルダに移動
                    // $file->move($target_path,$fileName);


                    //ファイルを cms/storage/app/public/uploadsに、$fileNameで保存。 storeAs('ディスク内のディレクトリー', 'ファイル名', 'ディスク');
                    $file->storeAs('uploads', $fileName , 'public');
            
                    // 画像のファイル名を任意のDBに保存
                    $photo = Photo::create([
                        "path" => $fileName,
                        "date" => $dateTimeOriginal,
                    ]);

                    $photo->players()->attach(request()->players); //追加 photoとplayerのリレーション
                    

            
            
                // }
                // else{
            
                //     return redirect('photo');
                // }
            
                // return redirect('photo');
            
            }}
            return redirect('photo');
        }
         
}
