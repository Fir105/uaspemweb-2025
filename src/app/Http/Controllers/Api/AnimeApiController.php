<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimeApiController extends Controller
{
    // Ambil semua anime
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Anime::all(),
        ]);
    }

    // Simpan anime baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'cover_image'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'video_path'   => 'required|file|mimes:mp4,mkv|max:51200',
        ]);

        $coverPath = $request->file('cover_image')->store('covers', 'public');
        $videoPath = $request->file('video_path')->store('videos', 'public');

        $anime = Anime::create([
            'title'        => $validated['title'],
            'description'  => $validated['description'],
            'cover_image'  => $coverPath,
            'video_path'   => $videoPath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Anime berhasil ditambahkan.',
            'data'    => $anime,
        ], 201);
    }

    // Tampilkan satu anime
    public function show($id)
    {
        $anime = Anime::find($id);

        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $anime,
        ]);
    }

    // Hapus anime
    public function destroy($id)
    {
        $anime = Anime::find($id);

        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime tidak ditemukan.',
            ], 404);
        }

        // Hapus file video dan cover dari storage
        Storage::disk('public')->delete([$anime->cover_image, $anime->video_path]);

        $anime->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anime berhasil dihapus.',
        ]);
    }
}
