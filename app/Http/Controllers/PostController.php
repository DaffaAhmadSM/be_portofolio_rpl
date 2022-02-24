<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            "judul" => 'required|string',
            "link" => 'required|url',
            "deskripsi" => 'required|string',
            'image'=> 'max:3',
            "image.*" => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240|unique:images,image'
        ]);

        $post = new Post;
        $post->judul = $request->judul;
        $post->slug = Str::slug($request->judul);
        $post->link = $request->link;
        $post->deskripsi = $request->deskripsi;
        $post->profile_siswa_id = Auth::user()->id;
        $post->divisi_id = Auth::user()->divisi_id;
        $post->save();

        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $name = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $name);
                $images[] = $name;
            }
        }
        $image = new Image;
        $image->image = json_encode($images);
        $image->post_id = $post->id;
        $image->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Post berhasil dibuat',
            'data' => $post,
            'image' => json_decode($image->image)
        ], 201);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::find($id);
       $image_model = Image::where('post_id', $id)->first();
        if ($post) {
            Post::destroy($id);
            Image::where('post_id', $id)->delete();
            $image = json_decode($image_model->image);
            foreach ($image as $img) {
                File::delete('images/' . $img);
            }
            return $image;
            return response()->json([
                'status' => 'success',
                'message' => 'Post berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Post tidak ditemukan'
            ], 404);
        }
 }
        
}
