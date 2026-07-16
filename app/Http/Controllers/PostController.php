<?php

namespace App\Http\Controllers;

use App\Models\Category; 
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
   public function __construct()
    {
        // User yang belum login tetap bisa LIHAT daftar mading (index) dan BACA LENGKAP (show)
        $this->middleware('auth')->except(['index', 'show']);

        // hanya admin yang bisa ubah,user hanya lihat
        $this->middleware('isAdmin')->except(['index', 'show']);
    }


  public function index(Request $request)
{
    // 1. Ambil data dengan filter kategori (jika ada)
    $posts = Post::query();

    if ($request->has('category_id')) {
        $posts->where('category_id', $request->category_id);
    }

    $posts = $posts->latest()->get();
    $categories = Category::all();

    return view('posts.index', compact('posts', 'categories'));
}
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required', 
        'category_id' => 'required|exists:categories,id', 
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // validasi khusus foto
    ]);

    // variabel untuk nama file (default null kalau tidak ada foto)
    $namaFile = null;

    // Proses jika ada file yang diupload
    if ($request->hasFile('image')) {
        $namaFile = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $namaFile);
    }

    // Simpan ke database
    Post::create([
        'title' => $request->title,
        'description' => $request->content, 
        'category_id' => $request->category_id, 
        'image' => $namaFile, // Yang disimpan cuma nama file-nya
    ]);

    return redirect()->route('posts.index')->with('success', 'Mading berhasil ditambah!');
}

    public function show($id)
    {
      $post = Post::with('comment.user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

 public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id', 
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $post = Post::findOrFail($id);
    
    // pakai nama foto yang lama
    $namaFile = $post->image; 

    // Tapi kalau user masukin foto baru, baru di ganti
    if ($request->hasFile('image')) {
        $namaFile = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $namaFile);
    }
    
    $post->update([
        'title' => $request->title,
        'description' => $request->content,
        'category_id' => $request->category_id, 
        'image' => $namaFile, // Simpan (bisa foto baru, bisa foto lama)
    ]);

    return redirect()->route('posts.index')->with('success', 'Mading berhasil diubah!');
}
   public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

  
    return redirect()->route('posts.index')->with('success', 'Mading berhasil dihapus!');
  }
}
