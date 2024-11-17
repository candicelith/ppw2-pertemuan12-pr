<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['register', 'login', 'store', 'authenticate']);
    }

    public function index()
    {
        $data_buku = Buku::all()->sortBy('id');

        return view('buku.index', compact('data_buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'cover' => 'image|required|max:1999',
        ]);

        if ($request->hasFile('cover')) {
            $image = Image::read($request->file('cover'));
            $filenameWithExt = $request->file('cover')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover')->getClientOriginalExtension();
            $basename = uniqid() . time();
            $smallFilename = "small_{$basename}.{$extension}";
            $mediumFilename = "medium_{$basename}.{$extension}";
            $largeFilename = "large_{$basename}.{$extension}";
            $filenameSimpan = "{$basename}.{$extension}";
            $path = $request->file('cover')->storeAs('cover_book_images', $filenameSimpan);
            $image->cover(300, 300, 'center')->save(storage_path("app/public/cover_book_images_resized/{$filenameSimpan}"));
        }

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->photo = $filenameSimpan;

        $buku->save();

        return redirect('/buku')
            ->with('pesan', 'Data buku berhasil disimpan');
    }

    public function showCover(string $id)
    {
        $data_buku = Buku::find($id);
        return view('buku.detail', compact('data_buku'));
    }

    public function edit(string $id)
    {
        $buku = Buku::find($id);

        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->harga = $request->input('harga');
        $buku->tgl_terbit = $request->input('tgl_terbit');

        $buku->save();

        return redirect('/buku')->with('pesan', 'Data buku berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        if ($buku) {

            Storage::disk('public')->delete('cover_book_images_resized/' . $buku->photo);
            Storage::disk('public')->delete('cover_book_images/' . $buku->photo);

            $buku->delete();
        }

        return redirect('/buku')->with('pesan', 'Data buku berhasil dihapus');
    }
}
