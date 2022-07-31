<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Photo;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();
        return view('players',compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'name_kanji' => 'required|max:255',
            'name_kana' => 'required|max:255',
            'nickname' => 'required|max:255',
            'number' => 'required',
        ]);
        $players = Player::create($storeData);
        return redirect('/players');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player = Player::find($id);
        $photos = Photo::all(); //追加
        $players = Player::all();  //追加
        return view('photo.show', compact('player', 'photos',));
        // return view('photo.index', compact('players', 'photos'));  //修正
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('playersedit',compact('player'));

        $player = Player::find($id);
        $photos = $player->photos->pluck('id')->toArray();
        $photoList = Photo::all();
        return view('playersedit', compact('player', 'photos', 'photoList'));

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
        $updateData = $request->validate([
            'name_kanji' => 'required|max:255',
            'name_kana' => 'required|max:255',
            'nickname' => 'required|max:255',
            'number' => 'required',
        ]);
        // $player->update($updateData);
        // return redirect('/players');

        $player = Player::find($id);
        $player->update($updateData);
        $player->photos()->attach(request()->photos); //attach()によって更新しても中間テーブルの情報を維持
        return redirect('/players');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = Player::find($id);
        $player->delete();
        $player->photos()->detach();
        return redirect('/players');
    }
}
