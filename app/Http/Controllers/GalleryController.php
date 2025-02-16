<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Intervention\Image\Laravel\Facades\Image;

class GalleryController extends Controller
{
    public function index()
    {
        $data = array(
            'id' => "posts",
            'menu' => 'Gallery',
            'galleries' =>
                Post::where('picture', '!=', '')
                    ->whereNotNull('picture')
                    ->orderBy('created_at', 'desc')
                    ->paginate(30)
        );

        return view('gallery.index')->with($data);
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('picture')) {
            $image = Image::read($request->file('picture'));
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid() . time();
            $smallFilename = "small_{$basename}.{$extension}";
            $mediumFilename = "medium_{$basename}.{$extension}";
            $largeFilename = "large_{$basename}.{$extension}";
            $filenameSimpan = "{$basename}.{$extension}";
            $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);
            $image->cover(300, 300, 'center')->save(storage_path("app/public/resized_posts_image/{$filenameSimpan}"));
        }

        $post = new Post;
        $post->picture = $filenameSimpan;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
    }

}
