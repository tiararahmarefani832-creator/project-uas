<?php

namespace App\Http\Controllers;

use App\Models\Category; 
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
   public function __construct()
    {
        // 1. User yang belum login tetap bisa LIHAT daftar mading (index) dan BACA LENGKAP (show)
        $this->middleware('auth')->except(['index', 'show']);

        // 2. PERUBAHAN DI SINI: Tambahkan 'index' agar user biasa bisa melihat halaman utama tanpa error "Bukan Admin"
        $this->middleware('isAdmin')->except(['index', 'show']);
    }


   public function index(\Illuminate\Http\Request $request)
{
    // 1. Ambil semua kategori dari database buat dipajang di tombol atas
    $categories = \App\Models\Category::all(); 

    // 2. Siapkan query untuk mengambil postingan mading
    $query = \App\Models\Post::query();

    // 3. JIKA ada tombol kategori yang diklik, saring beritanya berdasarkan ID kategori tersebut
    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 4. Ambil datanya dan urutkan dari yang terbaru
    $posts = $query->latest()->get();

    // === LOGIKA BARU: Cek apakah user yang login saat ini adalah Admin ===
    $isAdmin = false;
    if (auth()->check()) {
        // Cari data role yang namanya 'admin' di database seperti di middleware kamu
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        
        // Jika ketemu dan role_id user sama dengan id role admin, set jadi true
        if ($adminRole && auth()->user()->role_id == $adminRole->id) {
            $isAdmin = true;
        }
    }

    // 5. Kirim data posts, categories, dan status isAdmin ke halaman index
    return view('posts.index', compact('posts', 'categories', 'isAdmin'));
}
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

   public function store(Request $request)
{
    // 1. Validasi (Saran asdos dimasukin ke sini)
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required', 
        'category_id' => 'required|exists:categories,id', 
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Tambahan validasi khusus foto
    ]);

    // 2. Siapkan variabel untuk nama file (default null kalau tidak ada foto)
    $namaFile = null;

    // 3. Proses jika ada file yang diupload
    if ($request->hasFile('image')) {
        $namaFile = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $namaFile);
    }

    // 4. Simpan ke database
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
    
    // Default: pakai nama foto yang lama
    $namaFile = $post->image; 

    // Tapi kalau user masukin foto baru, baru kita ganti
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
