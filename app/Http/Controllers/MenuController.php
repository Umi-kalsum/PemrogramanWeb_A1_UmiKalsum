<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_menu = Menu::all();
        return view('menu.index',['title'=>'menu','list_menu'=>$list_menu]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create',['title'=>'Create Menu']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'          => 'required|min:3',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'type'         => 'required|min:3'
        ]);
        $image = $request->file('image');
        $image_name = $image->hashName();
        // dd($image_name);
        $image->storeAs('menu',$image_name );

        Menu::create([
            'image'         => $image_name,
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'type'          => $request->type
        ]);

        return redirect()->route('menu.index')->with(['success'=>'Data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('menu.detail');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('menu.edit');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
